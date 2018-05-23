<?php
/**
 * Created by PhpStorm.
 * User: liao
 * Date: 2018/3/29
 * Time: 下午4:23
 */

namespace build\controllers;


use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class IndexController extends Controller
{
    public $layout=false;
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            $exception = new NotFoundHttpException("页面未找到");
        }
        Yii::$app->request->isAjax and R($exception->getCode(),$exception->getMessage());

        die($exception->getMessage());

    }
    public function actionGetmenu()
    {
        die('{"status":200,"message":"","data":{"list":[{"id":"126","pid":"0","name":"\u751f\u6210","url":"index.php?r=#","icon_style":"","display":"1","sort":"0","iconfont":"&#xe637;","sub":[{"id":"128","pid":"126","name":"\u6a21\u5757","url":"index.php?r=build\/build-modules\/index","icon_style":"","display":"1","sort":"0","iconfont":"&#xe637;"},{"id":"129","pid":"126","name":"\u6a21\u578b","url":"index.php?r=build\/build-curd\/index","icon_style":"","display":"1","sort":"0","iconfont":"&#xe637;"}]}]}}');

    }
    public function actionHome()
    {
        die("ok");
    }
}