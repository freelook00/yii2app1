<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\i18n\Formatter;
?>

<?php

if($selectType == 'list')
{
    $columns = [
        'id',
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

}
elseif($selectType == 'total')
{
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
}
?>

<?= GridView::widget([
    'dataProvider' => $expenses,
    'columns' => $columns,
]) ?>
