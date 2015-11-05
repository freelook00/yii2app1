<?php

namespace app\controllers;

use yii\BaseYii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use app\models\Expense;
use yii\web\Request;

class ExpensesController extends \yii\web\Controller
{
    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionTotal()
    {
        $q = Expense::find();

        $req = BaseYii::$app->request;
        $get = $req->get();

        if( isset( $get['year'] ) )
        {
            if (isset( $get['month'] ) )
            {
                $btwFrom = $get['year'].'-'.$get['month'].'-01';
                $btwTo   = $get['year'].'-'.$get['month'].'-'.date('t', strtotime($btwFrom) );

                $q->select(['group', 'SUM(`total`) as `total`']);
                $q->where( ['between', 'date', $btwFrom, $btwTo] );
                $q->groupBy('group');
                $q->orderBy('group');

                //SELECT `group`, SUM(`total`) as 'total' FROM `expense` WHERE `date` BETWEEN '2015-01-01' AND '2015-01-30' GROUP BY `group`
            }
        }

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $q,
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]
        );

        return $this->render('index', [ 'expenses' => $dataProvider, 'selectType' => 'total' ]);
    }

    public function actionIndex()
    {
        $q = Expense::find();

        $req = BaseYii::$app->request;
        $get = $req->get();

        if( isset( $get['year'] ) )
        {
            if (isset( $get['month'] ) )
            {
                $btwFrom = $get['year'].'-'.$get['month'].'-01';
                $btwTo   = $get['year'].'-'.$get['month'].'-'.date('t', strtotime($btwFrom) );

                $q->where( ['between', 'date', $btwFrom, $btwTo] );
            }
        }

        $dataProvider = new ActiveDataProvider(
             [
                 'query' => $q,
                 'pagination' => [
                     'pageSize' => 50,
                 ],
             ]
        );

        return $this->render('index', [ 'expenses' => $dataProvider, 'selectType' => 'list']);
    }

    public function actionNew()
    {
        return $this->render('new');
    }

    public function actionSave()
    {
        return $this->render('save');
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
