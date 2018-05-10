<?php

namespace build\modules\build\controllers;


class BuildModulesController extends BuildController
{

    public $module;
    public $generator;

    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $model = $this->getallmodules();
            $page = isset($_GET['p']) ? intval($_GET['p']) : 0;
            $size = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : 10;
            $start = ($page - 1) * $size;
            $total = count($model);
            $data = array_slice($model, $start, $size, true);
            $redata['status'] = 200;
            $redata['pages'] = ceil($total / $size);
            $redata['total'] = $total;
            $redata['data']['list'] = $data;
            R($redata);
        }


        $prj = $this->getproject();
        $arr = [];
        foreach ($prj as $key => $value) {
            $arr[] = str_replace('@', '', $key);
        }
        return $this->render('index', ['prj' => $arr]);
    }

    public function actionAddmudule()
    {
        $app = P("app");
        $modules = P("modules");
        $menu = P("menu");
        $prjpath = \Yii::getAlias('@' . $app);
        $modeles_arr = $this->getprojModules($prjpath);
        in_array($modules, $modeles_arr) and R(['status' => 100, 'msg' => "添加失败，此模块己经存在"]);
        //修改配置文件
        $config = file_get_contents($prjpath . "/config/main.php");
        strpos($config, "'modules' => [") or R(['status' => 100, 'msg' => "添加失败，此项目不能添加模块"]);
        //添加菜单
        if ($menu) {
            $menu_name = P("menu_name");
            $display = P("display");
            $sort = P("sort");
            $menu_name or R(['status' => 100, 'msg' => "添加失败，请输入菜单名称"]);
            $menu_icon = P("menu_icon");
            $this->buildmenu($menu_name, $modules, 0, $display, $menu_icon, $sort) or R(['status' => 100, 'msg' => "添加失败，添加菜单失败"]);
        }
        $module_class = $app . "\\modules\\" . strtolower($modules) . "\\$modules";

        $generator = $this->loadGenerator("module", ['Generator' => ['moduleClass' => $module_class, "moduleID" => strtolower($modules)]]);
        if ($generator->validate()) {
            $generator->saveStickyAttributes();
            $files = $generator->generate();
            $answers = [];
            foreach ($files as $val) {
                $answers[$val->id] = 1;
            }
            $results = null;
            if ($generator->save($files, $answers, $results)) {
                $str = "'modules' => [
        '" . $generator->moduleID . "'=>[
                'class' => '" . $generator->moduleClass . "'
        ],";
                $config = str_replace("'modules' => [", $str, $config);
                file_put_contents($prjpath . "/config/main.php", $config);
            }

        }
        R(['status' => 200, 'msg' => "添加成功", "url" => "reload", "data" => ["id" => strval(0)]]);
    }
    public function actionIcon()
    {

        return $this->render('icon');
    }
}
