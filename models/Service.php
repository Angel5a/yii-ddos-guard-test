<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $ip
 * @property string $domain
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'type', 'ip', 'domain'], 'required'],
            [['user_id'], 'integer'],
            [['type'], 'string', 'max' => 10],
            [['ip'], 'string', 'max' => 16],
            [['domain'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('service', 'ID'),
            'user_id' => Yii::t('service', 'User ID'),
            'type' => Yii::t('service', 'Type'),
            'ip' => Yii::t('service', 'Ip'),
            'domain' => Yii::t('service', 'Domain'),
        ];
    }
}
