<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use app\models\Expense;

class ExpenseQuery extends ActiveQuery
{

    public static function tableName()
    {
        return 'expense';
    }

}