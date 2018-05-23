<?php
/**
 * Created by 廖鹏
 * Date: 2018年03月29日 17:19*/

namespace backend\modules\admin\controllers;

use backend\controllers\AdminController;
use backend\models\AdminMenu;
use backend\models\AdminAuthItem;
use backend\models\Tree;
use Yii;

class AdminMenuController extends AdminController
{

    /**
     * AdminMenu 列表页
     */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['p']) ? intval($_GET['p']) : 0;
            $size = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : 10;
            $start = ($page - 1) * $size;
            list($total,$data)=$this->getMenuGrid();
            $list=[];
            if(isset($_GET['name'])&& $_GET['name'])
            {
                foreach ($data as $val)
                {
                    if(strpos($val['name'],$_GET['name'])!==false)
                    {
                        $list[]=$val;
                    }
                }
                $data=$list;
                $total=count($data);
            }


            $data=array_slice($data,$start,$size);
            $redata['status'] = 200;
            $redata['pages'] = ceil($total / $size);
            $redata['total'] = $total;
            $redata['data']['list'] = $data;
            R($redata);
        }
        list($total,$list)=$this->getShowMenuGrid();
        return $this->render('index', ["list"=>$list]);
    }
    public function actionIcon()
    {

        return $this->render('icon');
    }
    public function getMenuGrid()
    {
        $menu = AdminMenu::find()->select("*,name as sub_name")->where(['is_menu'=>1]);
        $total=$menu->count();
        $data=$menu->orderBy('sort')->asArray()->all();
        $treeObj = new Tree($data);
        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
        $menulist=array_values($treeObj->getGridTree());
        return [$total,$menulist];
    }
    public function getShowMenuGrid()
    {
        $menu = AdminMenu::find()->select("*,name as sub_name")->where(['display'=>1]);
        $total=$menu->count();
        $data=$menu->orderBy('sort asc')->asArray()->all();
        $treeObj = new Tree($data);
        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│', '&nbsp;&nbsp;&nbsp;├─', '&nbsp;&nbsp;&nbsp;└─'];
        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
        $menulist=array_values($treeObj->getGridTree());
        return [$total,$menulist];
    }
    public function getOneMenuGrid($id)
    {
        list($total,$list)=$this->getMenuGrid();
        foreach ($list as $val)
        {
            if($val['id']==$id)
            {
                return $val;
            }
        }

    }

    public function actionGetmenu()
    {
        if(Yii::$app->user->identity->admin_is_super)
        {
            $menu = AdminMenu::find()->where(['display'=>1])->orderBy('sort asc')->asArray()->all();
        }else{
            $auth=Yii::$app->authManager;
            $author=$auth->getPermissionsByUser(Yii::$app->user->id);
            $author=array_keys($author);
            $menu=AdminMenu::find()->where(['or',['pid'=>0],['in','url',$author]])->andWhere(['display'=>1])->asArray()->all();
        }


        foreach ($menu as $key=>$val)
        {
            $menu[$key]['url']="index.php?r=".$val['url'];
        }
        $menu = new Tree($menu);
        $menu=$menu->getTreeArray('id','pid','sub',0);
        R(200,"",['list'=>$menu]);
    }

    public function actionGetallmenu()
    {
        $menu = AdminMenu::find()->orderBy('sort asc')->asArray()->all();
        $menu = new Tree($menu);
        $menu=$menu->getTreeArray('id','pid','sub',0);
        R(200,"",['list'=>$menu]);
    }


    /**
     * AdminMenu 添加数据
     */
    public function actionAdd()
    {
        $model = new AdminMenu();
        //数据转换
        $_POST['name']=$_POST['sub_name'];
        $data = ['AdminMenu' => $_POST];
        if ($model->load($data) && $model->save()) {
            //日志
            $this->addLog("添加了AdminMenu中id:[".$model->id."]的数据:".json_encode($model->attributes));
            //授权
            $model->url and $this->auth($model->url,$model->name);
            $data=$this->getOneMenuGrid($model->id);
            list($total,$list)=$this->getShowMenuGrid();
            R(['status' => 200, 'msg' => "添加成功", "data"=>$data,"menu"=>$list]);
        }
        R(['status' => 100, 'msg' => "添加失败"]);
    }

    /**
     * AdminMenu 更新数据
     */
    public function actionUpdate()
    {
        $model = AdminMenu::findOne($_POST['id']);
        //数据转换
        $_POST['name']=$_POST['sub_name'];
        isset($_POST['display']) or $_POST['display'] = 0;
        $data = ['AdminMenu' => $_POST];
        if ($model->load($data) && $model->save()) {
            $model->url and $this->auth($model->url,$model->name);
            $data=$this->getOneMenuGrid($model->id);
            list($total,$list)=$this->getShowMenuGrid();
            R(['status' => 200, 'msg' => "修改成功", "data" => [$data],"menu"=>$list]);
        }
        //重新添加权限

        R(['status' => 100, 'msg' => "修改失败"]);
    }

    /**
     * AdminMenu 删除数据
     */
    public function actionDelete()
    {
        $idarr = explode(',', $_GET['id']);
        if(AdminMenu::deleteAll(['in', "id", $idarr]))
        {
            $this->addLog("删除了AdminMenu中id:[".$_GET['id']."]的数据");
            $group_list=AdminMenu::find()->where(['in','group_id',$idarr])->all();
            if($group_list)
            {
                foreach($group_list as $val)
                {
                    $this->addLog("删除了AdminMenu中id:[".$val->id."]的数据");
                    $val->delete();
                }
            }
            list($total,$list)=$this->getShowMenuGrid();
            R(['status' => 200, 'msg' => "删除成功","menu"=>$list]);
        }
        R(['status' => 100, 'msg' => "删除失败"]);
    }

    /**
     * AdminMenu 设置某数据状态
     */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_GET['id']);
        $title = "启用成功";

        $key=$_GET['k'];
        $val=$_GET[$key.'_v'];
        $val== 0 and $title = "禁用成功";
        (isset($_GET['type']) && $_GET['type']=="set") and $title="设置成功";
        AdminMenu::updateAll([$key => $val], ['in', "id", $idarr]);
        $data=AdminMenu::find()->where(['in','id',$idarr])->asArray()->all();
        $this->addLog("设置AdminMenu表中id:[".$_GET['id']."]为".$_GET[$key.'_v']);
        list($total,$list)=$this->getShowMenuGrid();
        R(['status' => 200, 'msg' => $title,"data"=>$data,"menu"=>$list]);
    }

    public function auth($url,$description)
    {
        $auth=\Yii::$app->authManager;
        $author=$auth->getPermission($url);
        if(!$author)
        {
            $author=$auth->createPermission($url);
            $author->description=$description;
            $auth->add($author);
        }else{
            if($description){
                AdminAuthItem::updateAll(['description'=>$description],['name'=>$url,'type'=>2]);
            }
        }
    }

}
