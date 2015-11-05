<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expensegroups".
 *
 * @property integer $id
 * @property string $name
 */
class ExpenseGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expensegroups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 254]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public static function find()
    {
        return new ExpenseGroupQuery(get_called_class());
    }

    public static function getGroups()
    {
        
    }
}
