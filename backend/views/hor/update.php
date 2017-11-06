<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hor */

$this->title = 'Update Hor: ' . $model->hor_id;
$this->params['breadcrumbs'][] = ['label' => 'Hors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hor_id, 'url' => ['view', 'id' => $model->hor_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
