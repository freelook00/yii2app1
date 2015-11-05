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
<?= $form->field($model, 'group')->dropDownList($model->getGroups() ); ?>
<?= $form->field($model, 'comment'); ?>
<?php ActiveForm::end(); ?>

