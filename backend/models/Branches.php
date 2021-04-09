<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property int $id
 * @property int $companies_id
 * @property string $name
 * @property string $address
 * @property string $created_at
 * @property string $status
 *
 * @property Departments[] $departments
 */
class Branches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['companies_id', 'name', 'address', 'created_at', 'status'], 'required'],
            [['companies_id'], 'integer'],
            [['created_at'], 'safe'],
            [['status'], 'string'],
            [['name', 'address'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'companies_id' => 'Companies Name',
            'name' => 'Name',
            'address' => 'Address',
            'created_at' => 'Created At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['branches_id' => 'id']);
    }

    public function getCompanies()
    {
        return $this->hasOne(Companies::className(), ['id' => 'companies_id']);
    }
}
