<?php
/* @var $this yii\web\View */
use yii\helpers\ArrayHelper;
use app\models\ExpenseGroup;
use yii\helpers\Html;
?>

<?php
$form = yii\bootstrap\ActiveForm::begin(['action' => ['expenses/save'], 'options' => [], ] )
?>
<div class="row">
    <div class="col-xs-3">
        <?= $form->field($model, 'date')->widget(
                \yii\jui\DatePicker::className(), [
                'dateFormat' => 'yyyy-MM-dd',
                'language' => 'russian',
                'options' => [
                    'class' => 'form-control'
                ]
            ]
            )->label('Дата'); ?>
    </div>
    <div class="col-xs-2">
        <?= $form->field($model, 'total')->widget(\yii\widgets\MaskedInput::className(), [
                'clientOptions' =>
                    [
                        'alias' => 'decimal',
                        'autoGroup' => true
                    ],
                ])->label('Сумма'); ?>
    </div>
    <div class="col-xs-3">
        <?= $form->field($model, 'group_id')->dropDownList(
            ArrayHelper::merge(
                array('0' => 'Статьи расходов'),
                ArrayHelper::map(ExpenseGroup::find()->orderBy(
                    ['name' => SORT_ASC])->all() , 'id', 'name'
                )
            ),
            [
                'options' =>
                [
                    0 => ['disabled' => true],
                ]
            ]
        )->label('Статья расходов'); ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-8">
        <?= $form->field($model, 'comment')->label('Описание'); ?>

        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php yii\bootstrap\ActiveForm::end(); ?>