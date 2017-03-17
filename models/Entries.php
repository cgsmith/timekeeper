<?php

namespace app\models;

use dektrium\user\models\Profile;
use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "entries".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $hours
 * @property string $entry_date
 * @property string $date_created
 * @property string $date_modified
 */
class Entries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'hours', 'entry_date'], 'required'],
            [['user_id'], 'integer'],
            [['hours'], 'number'],
            [['entry_date', 'date_created', 'date_modified'], 'safe'],
            [['title'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'hours' => Yii::t('app', 'Hours'),
            'entry_date' => Yii::t('app', 'Entry Date'),
            'date_created' => Yii::t('app', 'Date Created'),
            'date_modified' => Yii::t('app', 'Date Modified'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }
}
