<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%lp_mobile_window_item}}".
 *
 * @property int $id
 * @property int $window_id
 * @property string $name
 * @property string $image
 * @property string $type
 * @property string $url
 * @property int $goods_id
 * @property string $order
 */
class LpMobileWindowItem extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%lp_mobile_window_item}}';
    }
    public function rules()
    {
        return [
            [['window_id', 'goods_id'], 'integer'],
            [['name', 'image'], 'string', 'max' => 256],
            [['type', 'url', 'order'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'window_id' => 'Window ID',
            'name' => 'Name',
            'image' => 'Image',
            'type' => 'Type',
            'url' => 'Url',
            'goods_id' => 'Goods ID',
            'order' => 'Order',
        ];
    }


    public function giishow()
    {
        return null;
    }

}
