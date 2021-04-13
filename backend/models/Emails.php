<?php


namespace backend\models;

use Yii;

/**
 * This is the model class for table "emails".
 *
 * @property int $id
 * @property string $receiver_name
 * @property string $receiver_email
 * @property string $subject
 * @property string $content
 * @property string $attachment
 * @property int $user_id
 * @property string $time
 * @property int $branches_id
 * @property int $companies_id
 *
 * @property Branches $branches
 * @property Companies $companies
 * @property User $user
 */
class Emails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'emails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receiver_name', 'receiver_email', 'subject', 'content', 'attachment', 'user_id', 'branches_id', 'companies_id'], 'required'],
            [['content'], 'string'],
            [['user_id', 'branches_id', 'companies_id'], 'integer'],
            [['time'], 'safe'],
            [['receiver_name', 'receiver_email', 'subject', 'attachment'], 'string', 'max' => 255],
            [['branches_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branches_id' => 'id']],
            [['companies_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['companies_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'receiver_name' => 'Receiver Name',
            'receiver_email' => 'Receiver Email',
            'subject' => 'Subject',
            'content' => 'Content',
            'attachment' => 'Attachment',
            'user_id' => 'User ID',
            'time' => 'Time',
            'branches_id' => 'Branches ID',
            'companies_id' => 'Companies ID',
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getBranchesList($id){
        $list = Branches::find()->where(['companies_id'=>$id])->all();
        return $list;
       }
}
