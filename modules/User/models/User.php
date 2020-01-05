<?php


namespace app\modules\user\models;

use yii2mod\user\models\UserModel;
use Yii;

/**
 * Class User
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $last_login
 * @property string $password write-only password
 */
class User extends UserModel
{
    
}
