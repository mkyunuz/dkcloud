
<style type="text/css">
	.row-assigment{
		background: rgba(0,0,0,.01);
		box-shadow: none;
		background: none;
		border: none;
	}
	.row-assigment > .col-sm-4 > .checkbox label{
		font-weight: 600;
		/*margin: 0px;*/
		padding: 0px;
	}


	.subcheckbox{
		border-left:1px dashed rgba(0,0,0,.1);
		margin:0px;
		margin-left:20px;
		padding:5px 0px;
	}
	.subcheckbox > .line{
		border-top: 1px dashed rgba(0,0,0,.1);
		width:15px;
		margin-top: 10px;
		height: 0px !important;
		float: left;

	}
	.sidebar-custom{
		background: rgba(0,0,0,.01);
		background: none;
		border: none;
		box-shadow: none;
	}

	.custom-thumb{
		/*border:1px solid red;*/
	}
	.custom-thumb .image{
		width:100px;
		height:100px;
		border: 1px solid gray;
		margin:auto;
		border-radius: 50%;
	}
	.nav-list.custom{
		margin-top: 30px;
	}
	.nav-list.custom li{
		text-align: center;
	}
</style>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\select2\Select2;
use kartik\date\DatePicker;

use backend\models\Jabatan;
use backend\models\Hor;
use backend\models\Area;
use backend\models\Titik;
use backend\models\TitikAssignment;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'User Assignment (Titik)';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$status = "Inactive";
if( $userModel->status == 10){
	$status = 'Active';
}
?>

<div class="user-form">
	<div class="row">
		
		<div class="col-md-3">
	      <div class="well sidebar-nav sidebar-custom">
	      	<div class="custom-thumb">
	      		<div class="image">
	      		</div>      		
	      	</div>
	        <ul class="nav nav-list custom">
	          <li class="active"><?= $userModel->nama; ?></li>
	          <li class="active"><?= Jabatan::find()->where(['jabatan_id' => $userModel->jabatan_id])->one()->jabatan_name; ?></li>
	          <li class="active"><?= $status; ?></li>
	        </ul>
	      </div>
	    </div>
	    <div class="col-md-9">
	    	 <?= Yii::$app->session->getFlash('success'); ?>
	    	 <?= Yii::$app->session->getFlash('danger'); ?>
		    <?php $form = ActiveForm::begin(); ?>
		    <?= $form->field($model, 'nik')->hiddenInput(['maxlength' => true, 'value'=> $userModel->nik, 'readonly'=>true])->label(false); ?>
		    <div class="well row-assigment">
		    	<?php 
				$hor_list  = HOR::find()->all();
				$i = 1;
				foreach ($hor_list as $hkey) { ?>

		    	<div class="col-lg-6">
		    		<div class="panel panel-default">
					    <div class="panel-heading">
					      <h4 class="panel-title">
					        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i ?>">
					        <?= $hkey->hor_name; ?></a>
					      </h4>
					    </div>
					    <div id="collapse<?= $i ?>" class="panel-collapse collapse">
					      <div class="panel-body">
					      		<?php
					      			$area_list =Area::find()->where(['hor_id' => $hkey->hor_id])->all();
					      			foreach ($area_list as $akey) {?>
					      				<div class="checkbox">
											<div class="line"></div>
											<label><input type="checkbox" name="TitikAssignment[area_id][]" class="ch_area"  value="<?= $akey->area_id?>"><?= $akey->area_name?></label>
										</div>
					      			<?php 
					      				$titik_list =Titik::find()->where(['area_id' => $akey->area_id])->all(); 
										foreach ($titik_list as $tkey) { 
											$checked = TitikAssignment::find()->where(['titik_id' => $tkey->titik_id,'nik'=>$userModel->nik])->all();
											$checkedItem = "";
											if(count($checked)=="1"){
												$checkedItem = 'checked';
											}
											?>
											<div class="checkbox subcheckbox">
												<div class="line"></div>
												<label><input type="checkbox" <?= $checkedItem; ?> name="TitikAssignment[titik_id][]" class="<?= $akey->area_id; ?>" value="<?= $tkey->titik_id?>"><?= $tkey->titik_name?></label>
											</div>	
									<?php	}


					      			}
					      		?>
					      </div>
					    </div>
					 </div>  
		    	</div>

		    	<?php $i++; } ?>
			
			<div class="col-lg-12 form-group">
		        <button type="submit" class="btn btn-success">Save</button>
		    </div>
			<div class="clearfix"></div>
		</div>

		    <?php ActiveForm::end(); ?>
		</div>
    </div>
</div>
<?php

$script = <<< JS
	$(".ch_area").click(function(){
		var values = $(this).attr('value');
		$('.'+values).prop('checked', this.checked);
	});
JS;
$this->registerJs($script);
?>