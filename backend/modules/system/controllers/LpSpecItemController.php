<?php
/**
* Created by 廖鹏
* Date: 2018年05月14日 05:27*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\LpSpecItem;

class LpSpecItemController extends AdminController
{
    public function actionAjaxDelete()
    {
        if (\Yii::$app->request->isAjax) {
            $spec_id = (int)\Yii::$app->request->get('id');
            if (!$spec_id) {
                R(['status' => 1, 'msg' => "无法获得到对应ID~"]);
            } else {
                $model = LpSpecItem::findOne($spec_id);
                $model->delete();
                R(['status' => 0, 'msg' => "删除操作成功~"]);
            }
        }
    }

}
