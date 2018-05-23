<?php
namespace console\controllers;
use yii\console\Controller;

use yii\xmpush\libs\Builder;
use yii\xmpush\libs\HttpBase;
use yii\xmpush\libs\Sender;
use yii\xmpush\libs\Constants;
use yii\xmpush\libs\Stats;
use yii\xmpush\libs\Tracer;
use yii\xmpush\libs\Feedback;
use yii\xmpush\libs\DevTools;
use yii\xmpush\libs\Subscription;
use yii\xmpush\libs\TargetedMessage;
use yii\xmpush\Xmpush;

/**
 * 小米推送
 */
class XmPushController extends Controller 
{
	const SECRET = 'p4J0HEBgALGz2JMJUOKVKQ==';
	const PACKAGE = 'com.rnbase';
	//AppID 2882303761517708946
	//AppKey 5991770865946
	//APPSECRET p4J0HEBgALGz2JMJUOKVKQ==
	//主包名 com.rnbase
	//U:18907431868 P:VoD884488
	//
	const UNACTIVE_STATUS = 0;
	const LIMIT = 10;

	public function actionPush()
	{
		$list = HhPushQueue::find()
			->where(['status' => self::UNACTIVE_STATUS])
			->orderBy('id DESC')
			->limit(self::LIMIT)
			->all();

		foreach ($list as $k => $val) {
			Constants::setPackage(self::PACKAGE);
			Constants::setSecret(self::SECRET);
			$title = $val->title;
			$desc = $val->desc;

			$payload = json_encode([
					'type'  => $val->type,
					'title' => $val->title,
					'id' 	=> $val->goods_id,
					'url'   => $val->url,
					//'pics'  => $val->image
			]);
			$message = new Builder();
			$message->title($title);  // 通知栏的title
			$message->description($desc); // 通知栏的descption
			$message->passThrough(0);  
			$message->payload($payload);
			$message->extra(Builder::notifyForeground, 1);
			$message->notifyId(2);
			$message->build();

			if ($val->user_id) {
				$targetMessage = new TargetedMessage();
				$targetMessage->setTarget($val->user_id, TargetedMessage::TARGET_TYPE_REGID); // 设置发送目标。可通过regID,alias和topic三种方式发送
				$targetMessage->setMessage($message);
			}

			$sender = new Sender();
			$res = $sender->broadcastAll($message)->getRaw();
			if ($res['result'] == 'ok') {
				$val->status = 1;
				$val->save();
				usleep(100);
			}
		}
	}

	public function actionTest()
	{
		Constants::setPackage(self::PACKAGE);
		Constants::setSecret(self::SECRET);

		$aliasList =  [
			'type'  => 3,
			'title' => "推送传参",
			'id' 	=> 12,
			'url'   => "http://www.hengheng.cn",
			//'pics'  => $res->image
		];
		$title = '亨亨养车#1';
		$desc = '这是一条推送测试消息';
		$payload = json_encode([
			'type'  => 3,
			'title' => "推送传参",
			'id' 	=> 12,
			'url'   => "http://www.hengheng.cn",
			//'pics'  => $res->image
		]);

		// message1 演示自定义的点击行为
		$message = new Builder();
		$message->title($title);  // 通知栏的title
		$message->description($desc); // 通知栏的descption
		$message->passThrough(0);  // 这是一条通知栏消息，如果需要透传，把这个参数设置成1,同时去掉title和descption两个参数
		$message->payload($payload); // 携带的数据，点击后将会通过客户端的receiver中的onReceiveMessage方法传入。
		$message->extra(Builder::notifyForeground, 1); // 应用在前台是否展示通知，如果不希望应用在前台时候弹出通知，则设置这个参数为0
		$message->notifyId(2); // 通知类型。最多支持0-4 5个取值范围，同样的类型的通知会互相覆盖，不同类型可以在通知栏并存
		$message->build();
		//$targetMessage = new TargetedMessage();
		//$targetMessage->setTarget('alias1', TargetedMessage::TARGET_TYPE_ALIAS); // 设置发送目标。可通过regID,alias和topic三种方式发送
		//$targetMessage->setMessage($message1);

		$sender = new Sender();
		print_r($sender->broadcastAll($message)->getRaw());
	}
}

?>