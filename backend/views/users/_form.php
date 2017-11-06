<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;
use kartik\date\DatePicker;

use backend\models\Jabatan;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nik')->textInput(['maxlength' => true]) ?>
     <?php
            $jabatan_list = ArrayHelper::map(Jabatan::find()->all(), 'jabatan_id','jabatan_name');
            echo $form->field($model, 'jabatan_id')->widget(Select2::classname(), [
                    'data' => $jabatan_list,
                    'language' => 'en',
                    'options' => ['placeholder' => 'Select Jabatan'],
                    'pluginOptions' => [
                            'allowClear' => true
                        ],
                ]);

       ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

   <!--  <?= $form->field($model, 'tanggal_masuk')->textInput() ?> -->

     <?= $form->field($model, 'tanggal_masuk')->widget(

                                    DatePicker::className(),[
                                        'value' => date('Y-m-d'),
                                        'options' => ['placeholder' => 'Select Join Date'],
                                        'pluginOptions' => [
                                            'format' => 'yyyy-mm-dd',
                                            'todayHighlight' => true
                                        ]
                                    ]
                );


    ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->dropDownList([ 'superuser' => 'Superuser','adminnistrator' => 'Adminnistrator', 'support' => 'Support', 'member' => 'Member', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([ '10' => 'Active', '-1' => 'In Active' ], ['prompt' => '']) ?>


    <?= $form->field($model, 'photo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'no_telp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
