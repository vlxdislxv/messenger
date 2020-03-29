<?php


namespace app\modules\user\models;

use yii\base\Exception;
use yii2mod\user\models\SignupForm as BaseSignupForm;
use app\models\User;

class SignupForm extends BaseSignupForm
{
    /**
     * @var User
     */
    protected $user;

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $this->user = new User();
        $this->user->setAttributes($this->attributes);
        $this->user->setPassword($this->password);
        $this->user->setLastLogin(time());
        $this->user->generateAuthKey();
        $this->user->generateAccessToken();

        return $this->user->save() ? $this->user : null;
    }
}