<?php
/* @var $this CartrigesTypeController */
/* @var $model CartrigesType */

$this->breadcrumbs=array(
Yii::t("cartriges", 'Cartriges')=>array('/cartriges'),
	Yii::t("cartriges", 'Cartriges Types')=>array('index'),
	Yii::t("cartriges", 'Manage CartrigesType'),
);

$this->menu=array(
	array('label'=>Yii::t("cartriges", 'List CartrigesType'), 'url'=>array('index')),
	array('label'=>Yii::t("cartriges", 'Create CartrigesType'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cartriges-type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php echo CHtml::link(Yii::t("yii",'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cartriges-type-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'type_id',
		'model_name',
		array(
			'class'=>'CButtonColumn',
            'template' => '{view}{update}',
		),
	),
)); ?>
