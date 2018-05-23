<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class Login extends Model
{
    public $username;
    public $password;
    public $verify;
    private $user;
    public function rules()
    {
        return[
            ['username','string'],
            ['password','string'],
            ['verify','captcha','captchaAction'=>'/index/captcha','message'=>'验证码不正确！']
        ];
    }
    public function login()
    {
        if ($this->validate()) {
            if(!$this->getUser()){
                ThrowError(1,"用户不存在");
                return false;
            }elseif (!$this->user->validatePassword($this->password)) {
                ThrowError(1,"密码错误");
                return false;
            }elseif(!$this->user->status) {
                ThrowError(1,"用户己被停用");
                return false;
            }else{
                return Yii::$app->user->login($this->user,0);
            }
        }else{
            $e=$this->getErrors();
            foreach ($e as $v)
            {
                ThrowError(1,$v[0]);
            }

        }
    }
    public function getUser()
    {
        $this->user or $this->user = AdminUser::findByUsername($this->username);
        return $this->user;
    }

}
