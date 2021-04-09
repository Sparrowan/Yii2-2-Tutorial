<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property int $branches_id
 * @property string $name
 * @property int $companies_id
 * @property string $created_at
 * @property string $status
 *
 * @property Branches $branches
 * @property Companies $companies
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branches_id', 'name', 'companies_id', 'created_at', 'status'], 'required'],
            [['branches_id', 'companies_id'], 'integer'],
            [['created_at'], 'safe'],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['branches_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branches_id' => 'id']],
            [['companies_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['companies_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branches_id' => 'Branches ID',
            'name' => 'Name',
            'companies_id' => 'Companies ID',
            'created_at' => 'Created At',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Branches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasOne(Branches::className(), ['id' => 'branches_id']);
    }

    /**
     * Gets query for [[Companies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompanies()
    {
        return $this->hasOne(Companies::className(), ['id' => 'companies_id']);
    }
}
