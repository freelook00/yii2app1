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
    <div class="col-xs-4">
        <?= $form->field($model, 'date'     )->widget(
                \yii\widgets\MaskedInput::className(), [
                    'clientOptions' => [
                        'alias' => 'date',
                        'mask' => 'd.m.y'
                    ],
                ]
            )->label('Дата'); ?>
    </div>
    <div class="col-xs-4">
        <?= $form->field($model, 'total'    )->widget(\yii\widgets\MaskedInput::className(), [
                'clientOptions' =>
                    [
                        'alias' => 'decimal',
                        'groupSeparator' => ' ',
                        //'radixPoint' => ',',
                        'autoGroup' => true
                    ],
                //'mask' => '[99999]9[.99]',
                ])->label('Сумма'); ?>
    </div>
    <div class="col-xs-4">
        <?= $form->field($model, 'group_id' )->dropDownList( ArrayHelper::map(ExpenseGroup::find()->all(), 'id', 'name') )->label('Статья расходов'); ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <?= $form->field($model, 'comment'  )->label('Описание'); ?>

        <?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<?php yii\bootstrap\ActiveForm::end(); ?>


