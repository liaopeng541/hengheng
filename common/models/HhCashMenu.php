<?php

namespace common\models;
use Yii;

/**
 * This is the model class for table "{{%hh_cash_menu}}".
 *
 * @property int $id
 * @property string $name
 */
class HhCashMenu extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%hh_cash_menu}}';
    }
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }


    public function giishow()
    {
        return null;
    }

}
