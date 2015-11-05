<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\i18n\Formatter;
use yii\bootstrap\Nav;
?>

<?php

$columns = [
    [
        'class' => DataColumn::className(),
        'attribute' => 'total',
        'format' => ['decimal', '2' ],
        'label' => 'Сумма',
        'contentOptions' =>
            [
                'style' => 'text-align: right;',
            ],
    ],
    'group:text:Группа расходов'
];

?>

<?=

    /*Button::widget([
        'label' => 'Action',
        'options' => ['class' => 'btn-primary'], // produces class "btn btn-primary"
    ]);*/

Nav::widget([
    /*'items' => [
          [
              'label' => 'Добавить',
              'url' => ['expense/new'],
          ],
     ],*/
     'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
]);

?>

<?= GridView::widget([
    'dataProvider' => $expenses,
    'columns' => $columns,
]) ?>


<?
//var_export($activePeriod, true)
?>
