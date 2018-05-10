<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

/**
 * Created by 廖鹏
 * Date: 2018年03月29日 13:35*/
class AdminController extends Controller
{

    public  $layout=false;
    public $enableCsrfValidation=false;
    public function init()
    {

        parent::init();
    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function beforeAction($action)
    {
        $modulesId=$this->module->id;
        $controllerId = $action->controller->id;
        $actionId = $action->id;
        $role="";
        $modulesId and $role.=$modulesId."/";
        $role.=$controllerId."/";
        $role.=$actionId;
        $norole=['admin/admin-menu/getmenu','admin/admin/error','admin/admin-user/index',"index/upload"];
        if(strpos($role,'app-backend')===false) {
            if (!isset(Yii::$app->user->identity) || !Yii::$app->user->identity->status) {
                Yii::$app->request->isAjax and R(9,"请重新登录");
                Throw new HttpException(200, "请重新登录",9);
            }
            if (!in_array($role, $norole)) {

                if (!Yii::$app->user->can($role)&& !Yii::$app->user->identity->admin_is_super) {
                    Yii::$app->request->isAjax and R(8,"您没有访问权限");
                    Throw new HttpException(200, "您没有访问权限",8);
                }
            }
        }
        return parent::beforeAction($action);
    }
    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new NotFoundHttpException("页面未找到");
        }
        return $this->render('error',['code'=>$exception->getCode(),'message'=>$exception->getMessage()]);
    }
    public function actionUpload()
    {
        $file=$_FILES['file'];
        $file_name=explode('.',$file['name']);
        $hz=$file_name[1];
        $file_path="upload/";
        $file_name=$file_path.date("YmdHis").rand(10000,99999).".".$hz;
        move_uploaded_file($file['tmp_name'],$file_name);
        $msg['status'] =200;
        $msg['url'] =$file_name;
        R($msg);
    }
    public function actionLpupload()
    {
        $fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
        if ($fn) {
            $fn=urldecode($fn);
            $hz=explode(".",$fn);
            $name=time().mt_rand(1000,9999).".".$hz[1];
            is_dir('uploads/') or mkdir('uploads/');
            file_put_contents(
                'uploads/' . $name,
                file_get_contents('php://input')
            );
            echo "uploads/$name";
            exit();
        }
    }

    public function addLog($desc)
    {
        $data = [
            'route' => Url::to(),
            'description' => Yii::$app->user->identity->admin_name.$desc,
            'user_id' => Yii::$app->user->id,
            'created_at'=>time(),
        ];
        $model = new \backend\models\AdminLog();
        $model->setAttributes($data);
        $model->save();
    }

}
