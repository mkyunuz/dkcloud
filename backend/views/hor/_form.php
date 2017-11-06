<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Hor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hor_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hor_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
