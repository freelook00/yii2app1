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
    [
        'class' => DataColumn::className(),
        'attribute' => 'group',
        'format' => 'text',
        'label' => 'Группа расходов',
    ],
    'comment:text:Примечание',
];

?>

<?= Nav::widget([
    'items' => [
        [
            'label' => 'Добавить',
            'url' => ['expenses/new'],
        ],
        [
            'label' => 'Период ('.$activePeriod['year'].' '.$activePeriod['month'].')',
            'items' => [
                ['label' => 'Текущий '.date('F').' - '.date('Y'), 'url' => '?year='.date('Y').'&month='.date('m')],
                '<li class="divider"></li>',
                '<li class="dropdown-header">Другие Периоды</li>',
                [
                    'label' => 'Прошлый месяц - '.date('F Y', strtotime("-1 month") ).'',
                    'url' => '?year='.date('Y', strtotime("-1 month")).'&month='.date('m', strtotime("-1 month"))
                ],
                [
                    'label' => 'Позапрошлый месяц - '.date('F Y', strtotime("-2 month") ).'',
                    'url' => '?year='.date('Y', strtotime("-2 month")).'&month='.date('m', strtotime("-2 month"))
                ],

            ],
        ],
    ],
    'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
]); ?>

<br />

<?= GridView::widget([
    'dataProvider' => $expenses,
    'columns' => $columns,
]) ?>


<?/* var_export($activePeriod, true) ?>
