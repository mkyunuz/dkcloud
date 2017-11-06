<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Hor */

$this->title = 'Create Hor';
$this->params['breadcrumbs'][] = ['label' => 'Hors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
