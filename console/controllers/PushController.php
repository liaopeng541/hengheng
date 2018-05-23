<?php
namespace console\controllers;
use yii\console\Controller;
use yii\xingeapp\XingeApp;
use yii\xingeapp\libs\Message;
use yii\xingeapp\libs\MessageIOS;
use yii\xingeapp\libs\TagTokenPair;
use yii\xingeapp\libs\ClickAction;
use yii\xingeapp\libs\Style;

use common\models\HhPushQueue;

/**
 * 腾讯信鸽推送
 */
class PushController extends Controller 
{
	const ACCESS_ID = "2100292674";
	const ACCESS_KEY = "A2S29W9A8DDE";
	const SECRET_KEY = "4e6432585207ea88e15a609832444729";

	const UNACTIVE_STATUS = 0;
	const LIMIT = 10;

	public function actionIndex()
	{
		$list = HhPushQueue::find()
			->where(['status' => self::UNACTIVE_STATUS])
			->orderBy('id DESC')
			->limit(self::LIMIT)
			->all();

		while ($list) {
			echo '-------'."\n";
			foreach ($list as $k => $res) {
				$push = new XingeApp(self::ACCESS_ID, self::SECRET_KEY);
				$mess = new Message();
				$mess->setType(Message::TYPE_NOTIFICATION);
				$mess->setTitle($res->title);
				$mess->setContent($res->desc);
				$custom = [
					'type'  => $res->type,
					'title' => $res->title,
					'id' 	=> $res->goods_id,
					'url'   => $res->url,
					//'pics'  => $res->image
				];
				$mess->setCustom($custom);
				if ($res->user_id) {
					$ret = $push->PushSingleAccount(0, 'user-'.$res->user_id, $mess);
				} else if ($res->level_id) {
					$ret = $push->PushTags(0, ['user-'.$res->level_id], 'OR', $mess);
				} else {
					$ret = $push->PushAllDevices(0, $mess);	
				}
				$res->status = 1;
				$res->save();
				usleep(50);
			}

			$list = HhPushQueue::find()
			->where(['status' => self::UNACTIVE_STATUS])
			->orderBy('id DESC')
			->limit(self::LIMIT)
			->all();
		}
		echo "complete";
	}

	public function actionPushAllIos()
	{
		$list = HhPushQueue::find()
			->where(['status' => self::UNACTIVE_STATUS])
			->orderBy('id DESC')
			->limit(self::LIMIT)
			->all();

		foreach ($list as $k => $res) {
			$push = new XingeApp(self::ACCESS_ID, self::SECRET_KEY);
			$mess = new MessageIOS();
			$mess->setAlert($res->title);
			$mess->setType(self::TYPE_APNS_NOTIFICATION);
			$mess->setBadge(1);
			$mess->setContent($res->desc);
			$custom = [
				'type'  => $res->type,
				'title' => $res->title,
				'id' 	=> $res->goods_id,
				'url'   => $res->url,
				//'pics'  => $res->image
			];
			$mess->setCustom($custom);
			if ($res->user_id) {
				$ret = $push->PushSingleAccount(0, 'user-'.$res->user_id, $mess, XingeApp::IOSENV_DEV);
			} else if ($res->level_id) {
				$ret = $push->PushTags(0, ['user-'.$res->level_id], 'OR', $mess, XingeApp::IOSENV_DEV);
			} else {
				$ret = $push->PushAllDevices(0, $mess, XingeApp::IOSENV_DEV);	
			}
			$res->status = 1;
			$res->save();
		}
	}

	public function actionPushAllAndroid()
	{
		die;
	}

	//查询设备数量
	public function actionQueryDeviceCount()
	{
		$push = new XingeApp(self::ACCESS_ID, self::SECRET_KEY);
		$ret = $push->QueryDeviceCount();
		return ($ret);
	}

	//查询消息推送状态
	public function actionQueryPushStatus()
	{
		$push = new XingeApp(self::ACCESS_ID, self::SECRET_KEY);
		$pushIdList = array('31','32');
		$ret = $push->QueryPushStatus($pushIdList);
		return ($ret);
	}
	
}

?>