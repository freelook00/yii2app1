<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
?>

<?php

$form = ActiveForm::begin(
    [
        'action' => ['expenses/save'],

    ]
)
?>
<?= $form->field($model, 'date'); ?>
<?= $form->field($model, 'total'); ?>
<?= $form->field($model, 'group_id')->dropDownList($model->getGroups() ); ?>
<?= $form->field($model, 'comment'); ?>
<?php ActiveForm::end(); ?>

<?= var_export($model->getGroups(), true); ?>

