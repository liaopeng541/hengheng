<?php
namespace backend\controllers;
use backend\models\Login;
use common\service\ErrorServer;
use Yii;

class IndexController extends AdminController
{
    public  $layout=false;
    public function actions()
    {
        return  [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'height'=>50,//高度
                'width' => 165,  //宽度
                'maxLength'=>4,
                'offset' =>20,
                'minLength'=>4,
                'testLimit'=>9999,
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index/login']);
        }
        return $this->render('index');
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index/index']);
        }
        return $this->render('login');
    }
    public function actionHome()
    {
        return $this->render('home');
    }
    public function actionDologin()
    {
        $login=new Login();
        if($login->load(Yii::$app->request->post()))
        {
            try{
                $login->login();
            }catch (ErrorServer $e)
            {
                $e->ShowError();
            }
            R(0);
        }else{
            R(3,"登录失败，请重试");
        }
    }
    public function actionLoginout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['index/login']);
    }
}
