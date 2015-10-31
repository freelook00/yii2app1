<?php

namespace app\controllers;

class ExpensesController extends \yii\web\Controller
{
    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionExpense()
    {
        return $this->render('expense');
    }

    public function actionGetmonth()
    {
        return $this->render('getmonth');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionNew()
    {
        return $this->render('new');
    }

    public function actionReport()
    {
        return $this->render('report');
    }

}
