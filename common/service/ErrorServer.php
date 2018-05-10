<?php
/**
 * Created by PhpStorm.
 * User: liao
 * Date: 2017/12/4
 * Time: 上午10:22
 */

namespace common\service;
use yii\base\Exception;
class ErrorServer extends Exception
{
    private $data=null;
    public function __construct($message = "", $code = 0, $data=null)
    {
        $this->data=$data;
        parent::__construct($message, $code, null);
    }
    public function ShowError()
    {
        R($this->getCode(),$this->getMessage(),$this->data);
    }
    public function saveError($content='')
    {
        /*
        $excption=new HhExcption();
        $content and $excption->event=$content;
        $excption->time=time();
        $excption->code=$this->getCode();
        $excption->message=$this->getMessage();
        $excption->save();
        */

    }
}