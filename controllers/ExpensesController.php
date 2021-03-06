<?php

namespace app\controllers;

use app\models\ExpenseGroup;
use app\models\ReportRange;
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
        $model = new Expense();

        $q = $model->find();

        $req = BaseYii::$app->request;
        $get = $req->get();

        $rrange = new ReportRange();

        if( isset($get['ReportRange']) )
        {
            $rrange->dateStart = strtotime($get['ReportRange']['dateStart']);
            $rrange->dateEnd   = strtotime($get['ReportRange']['dateEnd']  );
        }
        else
        {
            $rrange->dateStart = strtotime( date('Y-m-01') );
            $rrange->dateEnd   = strtotime( date('Y-m-').date('t') );
        }

        if( $rrange->dateEnd === false OR $rrange->dateEnd < $rrange->dateStart)
        {
            $rrange->dateEnd = time();
        }

        $btwFrom = date('Y-m-d', $rrange->dateStart);
        $btwTo   = date('Y-m-d', $rrange->dateEnd);


        $q->select(['group_id', 'SUM(`total`) as `total`']);
        $q->where( ['between', 'date', $btwFrom, $btwTo] );
        $q->groupBy('group_id');
        $q->orderBy('group_id');

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
            'model' => $model,
            'ReportRange' => $rrange,
                'exp' => $get,
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
        $model = new Expense(BaseYii::$app->request->post()['Expense']);

        $model->date = date('Y-m-d' ,strtotime(BaseYii::$app->request->post()['Expense']['date']));

        $model->save();

        return $this->render('save', [ 'model' => $model ]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
