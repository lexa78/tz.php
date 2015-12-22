<?php

namespace app\models;

use DateTime;
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
    private static $monthes = [
      'января' => 'January',
      'январь' => 'January',
      'февраля' => 'February',
      'февраль' => 'February',
      'марта' => 'March',
      'март' => 'March',
      'апреля' => 'April',
      'апрель' => 'April',
      'мая' => 'May',
      'май' => 'May',
      'июня' => 'June',
      'июнь' => 'June',
      'июля' => 'July',
      'июль' => 'July',
      'августа' => 'August',
      'август' => 'August',
      'сентября' => 'September',
      'сентябрь' => 'September',
      'ноября' => 'November',
      'ноябрь' => 'November',
      'октября' => 'October',
      'октябрь' => 'October',
      'декабря' => 'December',
      'декабрь' => 'December',
    ];

    public static function getEnglishMonth($key) {
        return self::$monthes[$key];
    }

    public static function getIntDate($strDate) {
        $dateStringToArr = explode(' ', $strDate);
        $dateStringToArr[1] = self::getEnglishMonth(strtolower($dateStringToArr[1]));
        $strDate = implode(' ', $dateStringToArr);
        $date = DateTime::createFromFormat('d F Y', $strDate);
        return strtotime($date->format('d F Y'));
    }

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
            'after_date' => 'по',
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
