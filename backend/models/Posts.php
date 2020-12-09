<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property string $author
 * @property string $image
 * @property int $category_id
 *
 * @property Category $category
 */
class Posts extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'category_id'], 'required'],
            [['title'],'unique'],
            [['category_id','status'], 'integer'],
            [['title', 'introduction'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2550],
            [['image'], 'file', 'extensions' => 'jpeg,jpg,png,gif', 'maxSize' => 1024 * 1024 * 10, 'maxFiles' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'intorduction'=>Yii::t('app','Introduction'),
            'description' => Yii::t('app', 'Description'),
            'date' => Yii::t('app', 'Date'),
            'author' => Yii::t('app', 'Author'),
            'file'=>Yii::t('app','Image'),
            'image' => Yii::t('app', 'Image'),
            'category_id' => Yii::t('app', 'Category'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'author']);
    }
}
