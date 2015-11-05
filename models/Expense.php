<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "expense".
 *
 * @property integer $id
 * @property string $date
 * @property string $total
 * @property string $comment
 */
class Expense extends \yii\db\ActiveRecord
{

    public static function primaryKey()
    {
        return ['id'];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expense';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'total', 'group', 'comment'], 'required'],
            [['date'], 'safe'],
            [['total'], 'number'],
            [['group_id'], 'number'],
            [['comment'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function getGroup()
    {
        return $this->hasOne(ExpenseGroup::className(), ['id'=>'group_id'])->one()->name;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'total' => 'Total',
            'group_id' => 'Group',
            'comment' => 'Comment',
        ];
    }

    public function getGroups()
    {
        $groups = new ExpenseGroup();

        return $groups->find()->asArray(true)->all();
    }

    /**
     *
     */
    public static function find()
    {
        return new ExpenseQuery(get_called_class());
    }
}
