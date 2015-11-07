<?php
/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\i18n\Formatter;
use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

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

$navWg = yii\bootstrap\Nav::begin();

$form = yii\bootstrap\ActiveForm::begin(['layout' => 'inline', 'method' => 'get', 'action' => ['expenses/report']]);
?>

<?= $form->field($ReportRange, 'dateStart')->widget(
    \yii\jui\DatePicker::className(), [
        'dateFormat' => 'yyyy-MM-dd',
        'language' => 'russian',
        'options' => [
            'class' => 'form-control ',
        ],
    ]
)->label('От'); ?>

<?= $form->field($ReportRange, 'dateEnd')->widget(
    \yii\jui\DatePicker::className(), [
        'dateFormat' => 'yyyy-MM-dd',
        'language' => 'russian',
        'options' => [
            'class' => 'form-control'
        ]
    ]
)->label('По'); ?>

<?= yii\helpers\Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>


<?php yii\bootstrap\ActiveForm::end(); ?>
<?php yii\bootstrap\Nav::end(); ?>

<?= GridView::widget([
    'dataProvider' => $expenses,
    'columns' => $columns,
]) ?>

