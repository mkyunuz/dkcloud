<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Jabatan;
use backend\models\TitikAssignment;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Point Assigmnet', ['point-assignment', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <!-- <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nik',
            'jabatan_id',
            'nama',
            'tanggal_masuk',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'level',
            'status',
            'photo:ntext',
            'no_telp',
            'created_at',
            'updated_at',
        ],
    ]) ?> -->
    <?php
        $status = 'Inactive';
        if($model->status =="10"){
            $status = "Active";
        }

        // $titik_list = TitikAssignment::find()->where(['nik'=>$model->nik])->all();
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand('select titik.titik_name from titik_assignment JOIN titik ON titik_assignment.titik_id=titik.titik_id where titik_assignment.nik=:nik', [':nik'=> $model->nik ] );
        $titik_list = $command->queryAll();

        $titik = '';
        if(count($titik_list)>0){
            $html_titik = '<ul style="padding-left:25px; margin-top:-20px;">';
            foreach ($titik_list as $tkey) {
                $html_titik .='<li>'.$tkey['titik_name'].'</li>';
            }
            $html_titik .= '</ul>';
        }
    ?>
    <table class="table table-striped no-border">
        <tr>
            <td>Nik</td>
            <td>: <?= $model->nik;?></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>: <?= $model->nama;?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: <?= Jabatan::find()->where(['jabatan_id'=> $model->jabatan_id])->one()->jabatan_name; ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: <?= $status; ?></td>
        </tr>
        <tr>
            <td>Tanggal Masuk</td>
            <td>: 
                <?php
                    echo date_format(date_create($model->tanggal_masuk), 'd M Y');
                ?>
            </td>
        </tr>
        
        <tr>
            <td>Titik</td>
            <td>: <?= $html_titik; ?></td>
        </tr>

    </table>

</div>
