<?php

namespace app\modules\user\models;

use yii2mod\user\models\LoginForm as BaseForm;
use Yii;
use yii2mod\user\models\UserModel;

class LoginForm extends BaseForm
{
    public $login;

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['login', 'string'],
            ['password', 'validatePassword'],
            ['rememberMe', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => Yii::t('yii2mod.user', 'Login'),
            'password' => Yii::t('yii2mod.user', 'Password'),
            'rememberMe' => Yii::t('yii2mod.user', 'Remember Me'),
        ];
    }

    public function getUser()
    {
        if ($this->user === false) {
            $this->user = UserModel::find()->where('email = :login or username = :login', [
                ':login' => $this->login
            ])->one();
        }

        return $this->user;
    }
}