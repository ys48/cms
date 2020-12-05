<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "staff".
 *
 * @property int $id
 * @property string $staff_id
 * @property string $username
 * @property string $fullname
 * @property string $ic_no
 * @property string $password
 * @property string $email
 * @property string $tel_no
 * @property string $gender
 * @property int $status
 * @property string $created_at
 */
class Staff extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['staff_id', 'username', 'fullname', 'ic_no', 'password_hash', 'email', 'tel_no', 'gender', 'status'], 'required'],
            [['status'], 'integer'],
            [['staff_id', 'username', 'fullname', 'password', 'gender'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['tel_no'],'match','pattern'=>'/^\d{10,11}$/','message'=>'Only 10/11 digit is acceptable'],
            [['ic_no'],'match','pattern'=>'/^\d{6}-\d{2}-\d{4}$/','message'=>'Please follow the format (121212-12-1212)'],
            [['tel_no'], 'string', 'max' => 13],
            [['ic_no'], 'string', 'max' => 14],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'staff_id' => Yii::t('app', 'Staff ID'),
            'username' => Yii::t('app', 'Username'),
            'fullname' => Yii::t('app', 'Fullname'),
            'ic_no' => Yii::t('app', 'Ic No'),
            'password_hash' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'tel_no' => Yii::t('app', 'Tel No'),
            'gender' => Yii::t('app', 'Gender'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => 10]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => 10]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => 10,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => 0
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function getPassword()
    {
        return null;
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
