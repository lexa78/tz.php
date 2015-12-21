<?php

namespace app\models;

use yii\base\NotSupportedException;
use Yii;
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    //хелперы
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function generateToken()
    {
        $this->token = Yii::$app->security->generateRandomString() . '_' . time();
    }

/*    public static function isUserAdmin($username)
    {
        if (static::findOne(['username' => $username, 'role' => self::ROLE_ADMIN]))
        {
            return true;
        } else {
            return false;
        }
    }

    public static function isUserUser($username)
    {
        if (static::findOne(['username' => $username, 'role' => self::ROLE_MANAGER]))
        {
            return true;
        } else {
            return false;
        }
    }*/

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
	{
		return static::findOne(['id' => $id]);
	}

    /**
     * @inheritdoc
     */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Эл. почта',
            'password' => 'Пароль',
            'role' => 'Роль',
        ];
    }
}