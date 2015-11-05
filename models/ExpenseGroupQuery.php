<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use app\models\ExpenseGroup;

class ExpenseGroupQuery extends ActiveQuery
{

    public static function tableName()
    {
        return 'expensegroups';
    }



}