<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\i18n\Formatter;
use yii\bootstrap\Nav;
?>

<?php

$columns = [
    //'id',
    [
        'class' => DataColumn::className(),
        'attribute' => 'date',
        'format' => ['date', 'php:d.m.Y'],
        'label' => 'Дата',
    ],

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
    'group:text:Группа расходов',
    'comment:text:Примечание',
];

?>

<?= Nav::widget([
    'items' => [
        [
            'label' => 'Добавить',
            'url' => ['expenses/new'],
        ],
    ],
    'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
]); ?>

<br />

<?= GridView::widget([
    'dataProvider' => $expenses,
    'columns' => $columns,
]) ?>


<?= var_export($xgroups, true) ?>