<?php

namespace build\modules\build\controllers;

use backend\models\AdminMenu;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class BuildController extends Controller
{

    public $module;
    public $generator;
    public $layout = false;
    public $enableCsrfValidation = false;

    /**
     * 加载生成模块
     * @param $id
     * @param array $data
     * @return mixed
     */
    protected function loadGenerator($id, $data = [])
    {
        if (isset($this->module->generators[$id])) {
            $this->generator = $this->module->generators[$id];
            $this->generator->loadStickyAttributes();
            $this->generator->load($data);

            return $this->generator;
        } else {
            throw new NotFoundHttpException("没找到生成模块: $id");
        }
    }

    /**
     * 创建菜单
     * @param $menu_name
     * @param $modules
     * @param int $pid
     * @param int $display
     * @param string $menu_icon
     * @param int $sort
     * @return bool
     */
    public function buildmenu($menu_name, $modules, $pid = 0, $display = 1, $menu_icon = '&#xe637;', $sort = 50)
    {
        $menumodel = new AdminMenu();
        $menumodel->pid = $pid;
        $menumodel->name = $menu_name;
        $menumodel->url = $modules;
        $menumodel->display = $display;
        $menumodel->sort = $sort;
        $menumodel->iconfont = $menu_icon;
        return $menumodel->save();
    }

    public function getallmodules()
    {
        $app = $this->getproject();
        $data = [];
        $i = 0;
        foreach ($app as $key => $val) {
            $modules = $this->getprojModules($val);
            if ($modules) {
                foreach ($modules as $k => $v) {
                    $data[] = [
                        'id' => $i,
                        'app' => str_replace('@', '', $key),
                        'path' => $val . "/modules/" . $v,
                        'modules' => $v
                    ];
                    $i++;
                }
            }
        }

        return $data;
    }
    public function getmodelatt($table_name)
    {
        $data['tableName'] = $table_name;
        $data['modelClass'] = $this->getModelClass($data['tableName']);
        $data['ns'] = 'common\models';
        $data['baseClass'] = 'yii\db\ActiveRecord';
        $data['db'] = 'db';
        $data['useTablePrefix'] = 1;
        $data['generateRelations'] = 'all';
        $data['generateRelationsFromCurrentSchema'] = 1;
        $data['generateLabelsFromComments'] = 1;
        $data['generateQuery'] = 0;
        $data['queryNs'] = 'common\models';
        $data['queryBaseClass'] = 'yii\db\ActiveQuery';
        $data['enableI18N'] = 0;
        $data['messageCategory'] = 'app';
        $data['useSchemaName'] = 1;
        $data['template'] = 'default';
        $data['show'] = null;
        $generator = $this->loadGenerator("model", ['Generator' => $data]);
        return $generator->getatt($table_name);

    }
    public function buildmodel($table_name, $show = null)
    {
        $data['tableName'] = $table_name;
        $data['modelClass'] = $this->getModelClass($data['tableName']);
        $data['ns'] = 'common\models';
        $data['baseClass'] = 'yii\db\ActiveRecord';
        $data['db'] = 'db';
        $data['useTablePrefix'] = 1;
        $data['generateRelations'] = 'all';
        $data['generateRelationsFromCurrentSchema'] = 1;
        $data['generateLabelsFromComments'] = 1;
        $data['generateQuery'] = 0;
        $data['queryNs'] = 'common\models';
        $data['queryBaseClass'] = 'yii\db\ActiveQuery';
        $data['enableI18N'] = 0;
        $data['messageCategory'] = 'app';
        $data['useSchemaName'] = 1;
        $data['template'] = 'default';
        $data['show'] = $show;
        $generator = $this->loadGenerator("model", ['Generator' => $data]);
        if ($generator->validate()) {
            $generator->saveStickyAttributes();
            $files = $generator->generate();
            $answers = [];
            foreach ($files as $val) {
                $answers[$val->id] = 1;
            }
            $results = null;
            $generator->save($files, $answers, $results);
        }
        if(!file_exists(Yii::getAlias("@common") . "/models/" . $data['modelClass'] . ".php"))
        {
            return false;
        }
        $model_class = $data['ns'] . "\\" . $data['modelClass'];
        return $model_class;

    }

    /**
     * 获取项目路径下所有modules
     * @param $projpath
     * @return array
     */
    public function getprojModules($projpath)
    {
        $projpath .= '/modules';
        $filesnames = [];
        if (is_dir($projpath)) {
            $filesnames = scandir($projpath);
            foreach ($filesnames as $key => $v) {
                if ($v == "." || $v == "..") {
                    unset($filesnames[$key]);
                }
            }
            $filesnames = array_values($filesnames);
        }
        return $filesnames;
    }

    /**
     * 获取所有项目
     * @return array
     */
    public function getproject()
    {
        $a = \Yii::$aliases;
        foreach ($a as $k => $v) {
            if (is_array($v)) {
                unset($a[$k]);
                continue;
            }
            if (strpos($v, 'vendor')) {
                unset($a[$k]);
                continue;
            }
            $sys = ["@web", "@webroot", "@runtime", "@app","@build"];
            if (in_array($k, $sys)) {
                unset($a[$k]);
                continue;
            }

        }
        return $a;
    }

    public function getModelClass($table_name)
    {

        $generator = $this->loadGenerator("model", []);
        return $generator->generateClassName($table_name);

    }

    public function getTables()
    {
        $db = Yii::$app->getDb();
        $data=$db->getSchema()->getTableNames();
        return $data;
    }

    public function getFields($table)
    {
        $db=Yii::$app->getDb();
        $r=$db->getSchema()->getTableSchema($table);//获取表字段名
        $fields=\yii\helpers\ArrayHelper::getColumn($r->columns, 'name', false);
        return $fields;
    }


    public function T_L($camelCaps,$separator='-')
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
    }
    public function L_T($camelCaps,$separator='-')
    {
        $array = explode($separator, $camelCaps);
        $result = ucfirst($array[0]);
        $len=count($array);
        if($len>1)
        {
            for($i=1;$i<$len;$i++)
            {
                $result.= ucfirst($array[$i]);
            }
        }
        return $result;

    }
}
