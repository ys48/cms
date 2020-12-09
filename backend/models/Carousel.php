<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "carousel".
 *
 * @property int $id
 * @property string $image
 * @property int $status
 */
class Carousel extends \yii\db\ActiveRecord
{
    public $files;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carousel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'status'], 'required'],
            [['status'], 'string'],
            [['image'], 'string', 'max' => 255],
            [['files'], 'file', 'extensions' => 'jpeg,jpg,png,gif', 'maxFiles' => 5],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image' => 'Image',
            'status' => 'Status',
            'files' => 'Images',
        ];
    }
}
