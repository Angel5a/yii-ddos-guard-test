<?php

namespace app\models;
use kdn\yii2\validators\DomainValidator;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property int $user_id
 * @property int $type_id
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
            [['user_id', 'type_id', 'ip', 'domain'], 'required'],
            [['user_id'], 'exist', 'targetRelation' => 'user'],
            [['type_id'], 'integer', 'min' => 1, 'max' => 2],
            [['ip'], 'ip', 'ipv6' => false],
            [['domain'], 'string', 'max' => 255],
            [['domain'], DomainValidator::class, 'allowURL' => false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('service', 'ID'),
            'user_id' => Yii::t('service', 'User'),
            'type_id' => Yii::t('service', 'Type'),
            'ip' => Yii::t('service', 'IP'),
            'domain' => Yii::t('service', 'Domain'),
            'typeName' => Yii::t('service', 'Type'),
            'userName' => Yii::t('service', 'User')
        ];
    }

    /**
     * Returns all available service types
     */
    public static function allTypeNames()
    {
        return [
            1 => 'Hosting',
            2 => 'Proxy'
        ];
    }

    /**
     * Getter for service type name
     */
    public function getTypeName()
    {
        return self::allTypeNames()[$this->type_id];
    }

    /**
     * Related user
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('service');
    }

    /**
     * Getter for user name
     */
    public function getUserName() {
        return $this->user->fullName;
    }
}
