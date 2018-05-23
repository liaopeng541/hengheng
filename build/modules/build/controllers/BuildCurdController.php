<?php

namespace build\modules\build\controllers;


use backend\models\Tree;
use backend\models\AdminMenu;
use Yii;

class BuildCurdController extends BuildController
{

    public $module;
    public $generator;
    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionTest()
    {

        die($this->L_T("admin-menu-user"));
    }

    public function actionIndex()
    {
        $lables = null;
        $giishow = null;
        $controller=null;
        if (Yii::$app->request->post() && P("table_name")) {
            $tableName = P("table_name");
            $modelClass = $this->getModelClass($tableName);
            $controller=$modelClass."Controller";
            $ns = 'common\models';
            $model_file = Yii::getAlias("@common") . "/models/" . $modelClass . ".php";
            file_exists($model_file) or $this->buildmodel($tableName);
            file_exists($model_file) or die("生成数据模型失败");
            list($lables, $rules) = $this->getmodelatt($tableName);
            $model_class = $ns . "\\" . $modelClass;
            $model = new $model_class();
            $giishow = $model->giishow();
            $model_lables = $model->attributeLabels();
            $newlables = [];
            $newgiishow = [];
            if ($lables) {
                foreach ($lables as $key => $val) {
                    if (isset($model_lables[$key])) {
                        $newlables[$key] = $model_lables[$key];
                    } else {

                        $newlables[$key] = $val;

                    }
                    if (isset($giishow['table'][$key])) {
                        $newgiishow[$key] = $giishow['table'][$key];

                    } else {
                        $newgiishow[$key] = [
                            'sort' => '100',
                            'show_name' => strval($val),
                            'show_mode' => '不展示',
                            'add_mode' => '不新增',
                            'search_mode' => '不搜索',
                            'f_key' => ''
                        ];
                    }
                }
            }
            $lables = $newlables;
            $giishow['table'] = $newgiishow;


        }
        $app = $this->getproject();
        $data = [];
        foreach ($app as $key => $val) {
            $key_ = str_replace('@', '', $key);
            $modules = $this->getprojModules($val);
            if ($modules) {
                foreach ($modules as $k => $v) {
                    $data[$key_][] = $v;
                }
            }
        }
        $tables = $this->getTables();
        $menu = AdminMenu::find()->where(['display' => 1])->orderBy('sort asc')->asArray()->all();
        foreach ($menu as $key => $val) {
            $menu[$key]['url'] = "index.php?r=" . $val['url'];
        }
        $menu = new Tree($menu);
        $menu = $menu->getTree();
        return $this->render('index', ['table' => $tables, 'lables' => $lables, 'prj' => json_encode($data), 'menu' => $menu, 'giishow' => $giishow,"controller"=>$controller]);
    }

    public function actionSavemodel()
    {
        $tableName = P("table_name");
        $table = P("table");
        //删除原有模型
        $modelClass = $this->getModelClass($tableName);
        $modelFile = Yii::getAlias("@common") . "/models/" . $modelClass . ".php";
        file_exists($modelFile) and unlink($modelFile);

        //生成新模型
        $c = array_column($table, 'sort');
        array_multisort($c, SORT_ASC, SORT_NUMERIC, $table);
        foreach ($table as $key=>$val)
        {
            foreach ($val as $k=>$v)
            {
                $table[$key][$k]=filter_utf8_char($v);
            }
        }
        $_POST['table'] = $table;
        $modelClass = $this->buildmodel($tableName, $_POST);
        R(0);

    }

    public function actionBuildpage()
    {
        $tabla_name = P('table_name');
        $build = P("build");
        $controller=P("controller");
        if (!$build['module'] || !$build['app']) {
            R(1, "请选择生成路径");
        }
        $build_type = P("build_type");
        $c_path = $build['app'] . "\\modules\\" . $build['module'];
        $v_path = $build['app'] . "/modules/" . $build['module'];
        $modelClass = $this->getModelClass($tabla_name);
        $viewdir = $this->T_L(str_replace("Controller","",$controller));
        $data['modelClass'] = "common\\models\\" . $modelClass;
        $data['controllerClass'] = $c_path . "\\controllers\\" . $controller;
        $data['viewPath'] = "@" . $v_path . "/views/" . $viewdir;
        $generator = $this->loadGenerator($build_type, ['Generator' => $data]);
        $modeltest = new $data['modelClass']();
        $modeltest->giishow() or R(0, "请先保存模型");
        $giishow = $modeltest->giishow();
        $has_add = false;
        $has_edit = false;
        $has_delete = false;
        foreach ($giishow['table'] as $val) {
            if ($val['add_mode'] != "不新增") {
                $has_add = true;
            }
        }
        if (isset($giishow['top_btn']['del_btn']) || isset($giishow['column_btn']['del_btn'])) {
            $has_delete = true;
        }
        if (isset($giishow['column_btn']['edt_btn'])) {
            $has_edit = true;
        }
        if ($generator->validate()) {
            $generator->saveStickyAttributes();
            $files = $generator->generate();
            $answers = [];
            foreach ($files as $val) {
                $answers[$val->id] = 1;
            }
            $results = null;
            $generator->save($files, $answers, $results);
            $menu = ['AdminMenu' => P("menu")];
            if ($menu['AdminMenu']['name']) {
                $menu_name = $menu['AdminMenu']['name'];
                //列表
                $menu['AdminMenu']['url'] = $build['module'] . "/" . $viewdir . "/index";
                $auth = \Yii::$app->authManager;
                $hasMenu = AdminMenu::find()->where(['name' => $menu_name])->andWhere(['url' => $menu['AdminMenu']['url']])->one();
                if (!$hasMenu) {
                    $menumodle = new AdminMenu();
                    $menumodle->load($menu);
                    $menumodle->save();
                    //添加权限

                    $permission = $auth->getPermission($menu['AdminMenu']['url']);
                    if (!$permission) {
                        $permission = $auth->createPermission($menu['AdminMenu']['url']);
                        $permission->description = $menu_name;
                        $auth->add($permission);
                    }
                }else{
                    $menumodle=$hasMenu;
                }
                //添加
                $menu['AdminMenu']['group_id'] = $menumodle->id;
                if ($has_add) {
                    $menu['AdminMenu']['url'] = $build['module'] . "/" . $viewdir . "/add";
                    $menu['AdminMenu']['display'] = 0;
                    $menu['AdminMenu']['is_menu'] = 0;
                    $menu['AdminMenu']['name'] = $menu_name . "-添加";
                    $hasMenu = AdminMenu::find()->where(['name' =>  $menu['AdminMenu']['name']])->andWhere(['url' => $menu['AdminMenu']['url']])->one();
                    if (!$hasMenu) {
                        $menumodle = new AdminMenu();
                        $menumodle->load($menu);
                        $menumodle->save();
                        $permission = $auth->getPermission($menu['AdminMenu']['url']);
                        if (!$permission) {
                            $permission = $auth->createPermission($menu['AdminMenu']['url']);
                            $permission->description = $menu['AdminMenu']['name'];
                            $auth->add($permission);
                        }
                    }

                }

                //删除
                if ($has_delete) {
                    $menu['AdminMenu']['url'] = $build['module'] . "/" . $viewdir . "/delete";
                    $menu['AdminMenu']['display'] = 0;
                    $menu['AdminMenu']['is_menu'] = 0;
                    $menu['AdminMenu']['name'] = $menu_name . "-删除";
                    $hasMenu = AdminMenu::find()->where(['name' =>  $menu['AdminMenu']['name']])->andWhere(['url' => $menu['AdminMenu']['url']])->one();
                    if (!$hasMenu) {
                        $menumodle = new AdminMenu();
                        $menumodle->load($menu);
                        $menumodle->save();
                        $permission = $auth->getPermission($menu['AdminMenu']['url']);
                        if (!$permission) {
                            $permission = $auth->createPermission($menu['AdminMenu']['url']);
                            $permission->description = $menu['AdminMenu']['name'];
                            $auth->add($permission);
                        }
                    }
                }
                //修改
                if ($has_edit) {
                    $menu['AdminMenu']['url'] = $build['module'] . "/" . $viewdir . "/update";
                    $menu['AdminMenu']['display'] = 0;
                    $menu['AdminMenu']['is_menu'] = 0;
                    $menu['AdminMenu']['name'] = $menu_name . "-修改";
                    $hasMenu = AdminMenu::find()->where(['name' =>  $menu['AdminMenu']['name']])->andWhere(['url' => $menu['AdminMenu']['url']])->one();
                    if (!$hasMenu) {
                        $menumodle = new AdminMenu();
                        $menumodle->load($menu);
                        $menumodle->save();
                        $permission = $auth->getPermission($menu['AdminMenu']['url']);
                        if (!$permission) {
                            $permission = $auth->createPermission($menu['AdminMenu']['url']);
                            $permission->description = $menu['AdminMenu']['name'];
                            $auth->add($permission);
                        }
                    }
                }
            }
        }
        R(0, "生成成功");
    }

    public function actionGetfield()
    {
        $table = P('table');
        $fields = $this->getFields($table);
        R($fields);
    }


}
