<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Titik */

$this->title = $model->titik_id;
$this->params['breadcrumbs'][] = ['label' => 'Titiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titik-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->titik_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->titik_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titik_id',
            'area_id',
            'titik_name',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
