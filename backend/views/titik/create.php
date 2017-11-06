<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Titik */

$this->title = 'Create Titik';
$this->params['breadcrumbs'][] = ['label' => 'Titiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
