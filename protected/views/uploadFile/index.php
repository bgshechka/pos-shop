<div>
		<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
	…
		<?php echo CHtml::activeFileField($uploadFile, 'xls'); ?>
	…
		<?php echo CHtml::endForm(); ?>
</div>