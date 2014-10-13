<?php
/* @var $this InvnomitemController */
/* @var $model InvnomItem */

$this->breadcrumbs=array(
	'Invnom Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List InvnomItem', 'url'=>array('index')),
	array('label'=>'Create InvnomItem', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#invnom-item-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Invnom Items</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invnom-item-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'item_id',
		'type_id',
		'date_add',
		'distribution',
		'inv_nom',
		'item_model',
		/*
		'item_sn',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
