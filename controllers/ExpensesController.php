<?php

namespace app\controllers;

use app\models\ExpenseGroup;
use yii\BaseYii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use app\models\Expense;
use yii\web\Request;
use yii\bootstrap\ActiveForm;

class ExpensesController extends \yii\web\Controller
{
    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionReport()
    {
        $q = Expense::find();

        $req = BaseYii::$app->request;
        $get = $req->get();

        if( !isset( $get['year'] ) AND !isset( $get['month'] ) )
        {
            $year  = date('Y');
            $month = date('m');
        }
        else
        {
            $year  = $get['year'];
            $month = $get['month'];
        }

        $activePeriod = array( 'year' => $year, 'month' => $month );

        $btwFrom = $year.'-'.$month.'-01';
        $btwTo   = $year.'-'.$month.'-'.date('t', strtotime($btwFrom) );


        $q->select(['tgroup', 'SUM(`total`) as `total`']);
        $q->where( ['between', 'date', $btwFrom, $btwTo] );
        $q->groupBy('tgroup');
        $q->orderBy('tgroup');

            //SELECT `group`, SUM(`total`) as 'total' FROM `expense` WHERE `date` BETWEEN '2015-01-01' AND '2015-01-30' GROUP BY `group`


        $dataProvider = new ActiveDataProvider(
            [
                'query' => $q,
                'pagination' => [
                    'pageSize' => 50,
                ],
            ]
        );

        return $this->render('report', [
            'expenses' => $dataProvider,
            'activePeriod' => $activePeriod,
            ]
        );
    }

    public function actionIndex()
    {
        $model = new Expense();

        $q = $model->find();

        $req = BaseYii::$app->request;
        $get = $req->get();

        if( !isset( $get['year'] ) AND !isset( $get['month'] ) )
        {
            $year  = date('Y');
            $month = date('m');
        }
        else
        {
            $year  = $get['year'];
            $month = $get['month'];
        }

        $activePeriod = array( 'year' => $year, 'month' => $month );

        $btwFrom = $year.'-'.$month.'-01';
        $btwTo   = $year.'-'.$month.'-'.date('t', strtotime($btwFrom) );

        $q->where( ['between', 'date', $btwFrom, $btwTo] );

        $dataProvider = new ActiveDataProvider(
             [
                 'query' => $q,
                 'pagination' => [
                     'pageSize' => 50,
                 ],
             ]
        );

        return $this->render('index', [
                'expenses' => $dataProvider,
                'selectType' => 'list',
                'xgroups' => $model->getGroups(),
                'activePeriod' => $activePeriod,
            ]
        );
    }

    public function actionNew()
    {
        $model = new Expense();

        return $this->render('new', [ 'model' => $model ]);
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
