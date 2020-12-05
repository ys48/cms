<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $staff_id;
    public $fullname;
    public $ic_no;
    public $tel_no;
    public $gender;
    public $status;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\backend\models\Staff', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\Staff', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['staff_id', 'required'],
            ['staff_id', 'trim'],
            ['staff_id', 'string', 'max' => 255],
            ['staff_id', 'unique', 'targetClass' => 'backend\models\Staff', 'message' => 'This staff has already been taken.'],

            ['fullname', 'required'],
            ['fullname', 'trim'],
            ['fullname', 'string', 'max' => 255],

            ['ic_no', 'required'],
            ['ic_no', 'trim'],
            ['ic_no', 'string', 'max' => 14],
            ['ic_no', 'unique', 'targetClass' => 'backend\models\Staff', 'message' => 'This IC number has already been taken.'],
            ['ic_no','match','pattern'=>'/^\d{6}-\d{2}-\d{4}$/','message'=>'Please follow the format (121212-12-1212)'],
            
            ['tel_no', 'required'],
            ['tel_no', 'trim'],
            ['tel_no', 'string', 'max' => 13],
            ['tel_no', 'unique', 'targetClass' => 'backend\models\Staff', 'message' => 'This phone number has already been taken.'],
            ['tel_no','match','pattern'=>'/^\d{10,11}$/','message'=>'Only 10/11 digit is acceptable'],
            
            ['gender','required'],
            ['gender', 'trim'],
            ['gender', 'string', 'max' => 255],

            ['status','required'],
            ['status', 'trim'],
            ['status', 'string', 'max' => 255],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $staff = new Staff();
        $staff->username = $this->username;
        $staff->email = $this->email;
        $staff->staff_id = $this->staff_id;
        $staff->fullname = $this->fullname;
        $staff->ic_no = $this->ic_no;
        $staff->tel_no = $this->tel_no;
        $staff->gender = $this->gender;
        $staff->status = $this ->status;
        $staff->setPassword($this->password);
        $staff->generateAuthKey();
        return $staff->save();
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
