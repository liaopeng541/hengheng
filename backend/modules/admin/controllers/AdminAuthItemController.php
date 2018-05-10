<?php
/**
* Created by 廖鹏
* Date: 2018年03月30日 17:18*/
namespace backend\modules\admin\controllers;
use backend\controllers\AdminController;
use backend\models\AdminAuthItem;
use backend\models\AdminAuthItemChild;

class AdminAuthItemController extends AdminController
{

    /**
    * AdminAuthItem 列表页
    */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['p']) ? intval($_GET['p']) : 0;
            $size = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : 10;
            $start = ($page - 1) * $size;
            $model = AdminAuthItem::find()->where(['type'=>1]);
            //筛选条件
          if (isset($_GET['name']) && $_GET['name']) {
                              $model->andWhere(['like', 'name', $_GET['name']]);
                     }
            //排序
            $sort = 'name desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort=str_replace('|'," ",$_GET['sort']);
                }
            }
            $total = $model->count();
                        $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                $auth=\Yii::$app->authManager;
                foreach ($data as $key => $v) {
                    $permission=$auth->getPermissionsByRole($v['name']);
                    if($permission)
                    {
                        $permission=array_keys($permission);
                        $data[$key]['role']=implode(",",$permission);
                    }

                }
            }
            $redata['status'] = 200;
            $redata['pages'] = ceil($total / $size);
            $redata['total'] = $total;
            $redata['data']['list'] = $data;
            R($redata);
        }
        $page_data=[];
        
        return $this->render('index',$page_data);
    }

    /**
    * AdminAuthItem 添加数据
    */
    public function actionAdd()
    {
        AdminAuthItem::findOne($_POST['name']) and R(['status' => 100, 'msg' => "角色名己经存在，添加失败"]);
        $auth = \Yii::$app->authManager;
        $author = $auth->createRole($_POST['name']);
        $author->description=$_POST['description'];
        $auth->add($author);
        $model=AdminAuthItem::findOne($_POST['name']);
        R(['status' => 200, 'msg' => "添加成功", "data" => $model->attributes]);
    }



    /**
    * AdminAuthItem 更新数据
    */
    public function actionUpdate()
    {
        $has=AdminAuthItem::find()->where(['name'=>$_POST['new_name'],])->andWhere(['<>',"created_at",$_POST['created_at']])->one();
        $has and R(['status' => 100, 'msg' => "角色名重复，请改更"]);
        AdminAuthItem::updateAll(['description'=>$_POST['description'],"name"=>$_POST['new_name']],['name'=>$_POST['name'],'type'=>1]);
        $auth=\Yii::$app->authManager;
        $role=$auth->getRole($_POST['new_name']);
        $auth->removeChildren($role);
        if(isset($_POST['role'])){
        foreach ($_POST['role'] as $val)
        {
            if($val) {
                $author = $auth->getPermission($val);
                if (!$author) {
                    $author = $auth->createPermission($val);
                    $auth->add($author);
                }
                $has = AdminAuthItemChild::find()->where(['parent'=>$role->name])->andWhere(['child'=>$author->name])->one();
                $has or $auth->addChild($role, $author);
            }
        }}
        $data=AdminAuthItem::find()->where(['type'=>1,"name"=>$_POST['new_name']])->asArray()->one();
        $permissions=$auth->getPermissionsByRole($_POST['new_name']);
        if($permissions){
            $permissions=array_keys($permissions);
            $data['role']=implode(",",$permissions);
        }
        R(['status' => 200, 'msg' => "修改成功", "data" => $data]);
    }

    /**
    * AdminAuthItem 删除数据
    */
    public function actionDelete()
    {
        $idarr = explode(',', $_GET['created_at']);
        if($num=AdminAuthItem::deleteAll(['in', "created_at", $idarr]))
        {
            $this->addLog("删除了AdminAuthItem中".$num."条数据");
            R(['status' => 200, 'msg' => "删除成功"]);
        }
        R(['status' => 100, 'msg' => "删除失败"]);
    }

    /**
    * AdminAuthItem 设置某数据状态
    */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_GET['name']);
        $title = "启用成功";
        $key=$_GET['k'];
        $val=$_GET[$key.'_v'];
        $val== 0 and $title = "禁用成功";
        (isset($_GET['type']) && $_GET['type']=="set") and $title="设置成功";
        AdminAuthItem::updateAll([$key => $val], ['in', "name", $idarr]);
        $data=AdminAuthItem::find()->where(['in','name',$idarr])->asArray()->all();
        $this->addLog("设置AdminAuthItem表中id:[".$_GET['name']."]的属性[".$key."=>".$val."]");
        R(['status' => 200, 'msg' => $title,"data"=>$data]);
    }
    public function actionEdit()
    {
        $data=AdminAuthItem::find()->where(['created_at'=>$_GET['created_at'],'type'=>1])->one();


        return $this->render('edit',['data'=>$data]);
    }
}
