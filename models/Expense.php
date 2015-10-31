<?php

namespace app\models;

use Yii;

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
            [['date', 'total', 'comment'], 'required'],
            [['date'], 'safe'],
            [['total'], 'number'],
            [['comment'], 'string']
        ];
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
            'comment' => 'Comment',
        ];
    }

    /**
     * @inheritdoc
     * @return ExpenseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExpenseQuery(get_called_class());
    }
}
