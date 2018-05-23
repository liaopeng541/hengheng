<?php
/**
* Created by 廖鹏
* Date: 2018年05月12日 04:14*/
namespace backend\modules\system\controllers;
use backend\controllers\AdminController;
use common\models\LpPush;
use common\models\HhPushQueue;

use yii\xingeapp\XingeApp;
use yii\xingeapp\libs\Message;
use yii\xingeapp\libs\MessageIOS;
use yii\xingeapp\libs\TagTokenPair;
use yii\xingeapp\libs\ClickAction;
use yii\xingeapp\libs\Style;

class MessagePushController extends AdminController
{
	const ACCESS_ID = "2100292674";
	const ACCESS_KEY = "A2S29W9A8DDE";
	const SECRET_KEY = "4e6432585207ea88e15a609832444729";

	/**
	 * @Author      fall1ng丶
	 * @DateTime    2018-05-17
	 * @Description [Description]
	 * @return      [type]        [description]
	 * @param type = 1：转入线下订单详情 =>id 2：转入账户流水 3：转入后备箱使用记录
	 * @param type = 4：转到充值  5：转到我的洗车卡
	 * @param type = 6：转到商品详情 =>id 7：转到会员详情 =>id
	 * @param type = 8：转到员工详情 =>id 9: 转到网页  => url
	 * @param $custom[title]  custom参数
	 * @param $custom[id] 	  custom参数
	 * @param $custom[url]    custom参数
	 * @param $custom[title]  custom参数
	 */
	//txt:0=未读,1=已读
	//txt:1=线下订单详情,2=账户流水,3=后备箱使用记录,4=充值,5=我的洗车卡,6=商品详情,7=会员详情,8=员工详情,9=网页跳转

	public function actionPush()
	{
		$messageID = (int)\Yii::$app->request->get('id');
		$res = LpPush::findOne($messageID);

		$res or R(['status' => 1, 'msg' => "推送内容没有查询出来"]);

		//user-user_id推送 
		$data = ['HhPushQueue' => [
			'type'     => $res->type,
			'url'      => $res->url,
			'goods_id' => $res->goods_id,
			'title'    => $res->title,
			'image'    => $res->thumb,
			'desc'     => $res->desc,
			'time'	   => time(),
		]];

		$model = new HhPushQueue();

		if ($model->load($data) && $model->save()) {
			R(['status' => 0, 'msg' => "消息推送已进入推送队列~"]);
		} else {
			R(['status' => 1, 'msg' => "无法进入推送队列~"]);
		}

	
		//XingeApp::PushAccountAndroid(10000, "secretKey", "title", "content", "account")
	}


}