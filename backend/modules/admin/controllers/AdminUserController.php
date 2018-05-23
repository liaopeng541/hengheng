<?php
/**
 * Created by 廖鹏
 * Date: 2018年03月30日 16:14*/

namespace backend\modules\admin\controllers;

use backend\controllers\AdminController;
use backend\models\AdminUser;
use backend\models\AdminAuthItem;

class AdminUserController extends AdminController
{

    /**
     * AdminUser 列表页
     */
    public function actionIndex()
    {
        if (\Yii::$app->request->isAjax) {
            $page = isset($_GET['p']) ? intval($_GET['p']) : 0;
            $size = isset($_GET['pagesize']) ? intval($_GET['pagesize']) : 10;
            $start = ($page - 1) * $size;
            $model = AdminUser::find();
            //筛选条件
            if (isset($_GET['role_name']) && $_GET['role_name']) {
                $model->andWhere(['role_name' => $_GET['role_name']]);
            }
            if (isset($_GET['admin_name']) && $_GET['admin_name']) {
                $model->andWhere(['like','admin_name',$_GET['admin_name']]);
            }
            //排序
            $sort = 'admin_id desc';
            if (isset($_GET['sort'])) {
                if ($_GET['sort']) {
                    $sort = str_replace('|', " ", $_GET['sort']);
                }
            }
            $total = $model->count();
            $model = $model->with("admin_auth_item_name");
            $admin_auth_item_name = AdminAuthItem::find()->asArray()->all();
            $page_data["admin_auth_item_name"] = \yii\helpers\ArrayHelper::map($admin_auth_item_name, "name", "name");
            $data = $model->orderBy($sort)->offset($start)->limit($size)->asArray()->all();
            //处理列表显示内容
            if ($data) {
                foreach ($data as $key => $v) {

                }
            }
            $redata['status'] = 200;
            $redata['pages'] = ceil($total / $size);
            $redata['total'] = $total;
            $redata['data']['list'] = $data;
            R($redata);
        }
        $page_data = [];
        $admin_auth_item_name = AdminAuthItem::find()->where(['type' => 1])->asArray()->all();
        $page_data["admin_auth_item_name"] = \yii\helpers\ArrayHelper::map($admin_auth_item_name, "name", "name");
        return $this->render('index', $page_data);
    }

    /**
     * AdminUser 添加数据
     */
    public function actionAdd()
    {
        $model = new AdminUser();
        $model->setPassword($_POST['admin_password']);
        $_POST['admin_password'] = $model->admin_password;
        //数据转换
        $data = ['AdminUser' => $_POST];
        if ($model->load($data) && $model->save()) {
           $this->auth($model->role_name,$model->admin_id);
            $this->addLog("添加了AdminUser中admin_id:[" . $model->admin_id . "]的数据:" . json_encode($model->attributes));
            R(['status' => 200, 'msg' => "添加成功", "data" => $model->attributes]);
        }
        R(['status' => 100, 'msg' => "添加失败"]);
    }

    public function auth($role,$user_id)
    {
        $auth=\Yii::$app->authManager;
        $auth->revokeAll($user_id);
        $roles=$auth->getRole($role);
        $auth->assign($roles,$user_id);
    }

    /**
     * AdminUser 更新数据
     */
    public function actionUpdate()
    {
        $model = AdminUser::findOne($_POST['admin_id']);
        //数据转换
        isset($_POST['admin_is_super']) or $_POST['admin_is_super'] = 0;
        isset($_POST['status']) or $_POST['status'] = 0;
        if ($_POST['admin_password'] != $model->admin_password) {
            $model->setPassword($_POST['admin_password']);
            $_POST['admin_password'] = $model->admin_password;
        }
        $data = ['AdminUser' => $_POST];
        if ($model->load($data) && $model->save()) {
            $this->auth($model->role_name,$model->admin_id);
            R(['status' => 200, 'msg' => "修改成功", "data" => [$model->attributes]]);
        }
        R(['status' => 100, 'msg' => "修改失败 "]);
    }

    /**
     * AdminUser 删除数据
     */
    public function actionDelete()
    {
        $idarr = explode(',', $_GET['admin_id']);
        if (AdminUser::deleteAll(['in', "admin_id", $idarr])) {
            $this->addLog("删除了AdminUser中id:[" . $_GET['admin_id'] . "]的数据");
            R(['status' => 200, 'msg' => "删除成功"]);
        }
        R(['status' => 100, 'msg' => "删除失败"]);
    }

    /**
     * AdminUser 设置某数据状态
     */
    public function actionSetstatus()
    {
        $idarr = explode(',', $_GET['admin_id']);
        $title = "启用成功";
        $key = $_GET['k'];
        $val = $_GET[$key . '_v'];
        $val == 0 and $title = "禁用成功";
        (isset($_GET['type']) && $_GET['type'] == "set") and $title = "设置成功";
        AdminUser::updateAll([$key => $val], ['in', "admin_id", $idarr]);
        $data = AdminUser::find()->where(['in', 'admin_id', $idarr])->asArray()->all();
        $this->addLog("设置AdminUser表中id:[" . $_GET['admin_id'] . "]的属性[" . $key . "=>" . $val . "]");
        R(['status' => 200, 'msg' => $title, "data" => $data]);
    }
}
