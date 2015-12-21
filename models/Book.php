<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $preview
 * @property integer $date
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $author_id
 *
 * @property Author $author
 */
class Book extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'class' => TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date', 'author_id'], 'required'],
            [['created_at', 'updated_at', 'author_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            ['date', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'preview' => 'Превью',
            'date' => 'Дата выхода книги',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Updated At',
            'author_id' => 'Автор',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }
}
