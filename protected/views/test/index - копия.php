<!--div class="form">
<?php echo CHtml::beginForm(); ?>
<table>
<tr><th>id</th><th>item_name</th></tr>
<!--?php foreach($items as $i=>$item): ?>
<tr>
<td><?php echo CHtml::activeTextField($item,"[$i]id"); ?></td>
<td><?php echo CHtml::activeTextField($item,"[$i]name"); ?></td>
</tr>
<?php endforeach; ?>
</table>
 
<!--?php echo CHtml::submitButton('Save'); ?-->
<!--?php echo CHtml::endForm(); ?>
</div><!-- form -->

<!--div class="form">
	<?php echo CHtml::beginForm(); ?>
	<!--?php echo CHtml::activeTextField($items, "[1]name"); ?-->
	<!--?php echo CHtml::endForm(); ?>
</div><!-- form -->

<!--div class="form">
<?php echo CHtml::beginForm(); ?>
<table>
<tr><th>id</th><th>property_name</th></tr>
<?php foreach($properties as $i=>$property): ?>
<tr>
<td><?php echo CHtml::activeTextField($property,"[$i]id"); ?></td>
<td><?php echo CHtml::activeTextField($property,"[$i]name"); ?></td>
</tr>
<?php endforeach; ?>
</table>
 
<div class="form">
<?php echo CHtml::beginForm(); ?>
<table>
<tr><th>item_id</th><th>property_id</th><th>value</th></tr>
<?php foreach($values as $i=>$value): ?>
<tr>
<td><?php echo CHtml::activeTextField($value,"[$i]item_id"); ?></td>
<td><?php echo CHtml::activeTextField($value,"[$i]property_id"); ?></td>
<td><?php echo CHtml::activeTextField($value,"[$i]value"); ?></td>
</tr>
<?php endforeach; ?>
</table>
 
<!--?php echo CHtml::submitButton('Save'); ?-->
<!--?php echo CHtml::endForm(); ?>
</div><!-- form -->