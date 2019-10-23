<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'first_name' => Yii::t('user', 'First Name'),
            'last_name' => Yii::t('user', 'Last Name'),
        ];
    }


    public function getFullName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getService()
    {
        return $this->hasMany(Service::className(), ['user_id' => 'id'])->inverseOf('user');
    }
}
