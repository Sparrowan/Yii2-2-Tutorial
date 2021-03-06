<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string|null $start_date
 * @property string $created_at
 * @property string $status
 *
 * @property Departments[] $departments
 */
class Companies extends \yii\db\ActiveRecord
{


    public $logo_file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'address', 'created_at', 'start_date','status'], 'required'],
            [['start_date', 'created_at'], 'safe'],
            [['logo_file'], 'file'],
            [['status'], 'string'],
            [['name', 'email', 'logo','address'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'address' => 'Address',
            'start_date' => 'Start Date',
            'created_at' => 'Created At',
            'status' => 'Status',
            'logo_file' => 'Logo',
        ];
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['companies_id' => 'id']);
    }
}
