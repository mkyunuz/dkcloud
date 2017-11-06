<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;
use backend\models\Hor;

/* @var $this yii\web\View */
/* @var $model backend\models\Area */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="area-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area_id')->textInput(['maxlength' => true]) ?>
    <?php
        $hor_list = ArrayHelper::map(Hor::find()->all(), 'hor_id','hor_name');
        echo $form->field($model, 'hor_id')->widget(Select2::classname(), [
                'data' => $hor_list,
                'language' => 'en',
                'options' => ['placeholder' => 'Select HOR'],
                'pluginOptions' => [
                        'allowClear' => true
                    ],
            ]);

   ?>

    <?= $form->field($model, 'area_name')->textInput(['maxlength' => true]) ?>

 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
