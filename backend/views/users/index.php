<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use backend\models\jabatan;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nik',
            
            [
                    'attribute' => 'jabatan_id',
                    'filter' => ArrayHelper::map(Jabatan::find()->all(), 'jabatan_name','jabatan_name'),
                    'value'=>'jabatan.jabatan_name',
                    ],
            // [
            // 'attribute' => 'jabatan_id',
            // 'filter' => Select2::widget([
            //                 'data' => ArrayHelper::map(Jabatan::find()->all(), 'jabatan_name','jabatan_name'),
            //                 'name' =>'jabatan_name',
            //                 'language' => 'en',
            //                 'options' => ['placeholder' => 'Select Jabatan'],
            //                 'pluginOptions' => [
            //                         'allowClear' => true
            //                     ],
            //             ]),
            // 'value'=>'jabatan.jabatan_name',
            // ],
            'nama',
            // 'tanggal_masuk',
            ['attribute' => 'tanggal_masuk',
                     'label' =>'DATE' ,
                     'filter' => DatePicker::widget([
                                'model' => $searchModel, 
                                'name' => 'tanggal_masuk', 
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pickerButton' => false,
                                'attribute' => 'tanggal_masuk',
                                'pluginOptions' => [
                                  'format' => 'yyyy-mm-dd',
                                  'autoclose' => true,
                                ]
                              ]),
                      'format' => 'raw',
                      'value' => function ($model, $key, $index) { 
                        return date('d-m-Y', strtotime($model->tanggal_masuk));
                      },
                    ],
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            'level',
            // 'status',
            // 'photo:ntext',
            'no_telp',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
