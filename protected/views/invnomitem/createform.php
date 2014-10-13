<?php
return array(
 
    'elements'=>array(
        'type_id'=>array(
            'type'=>'dropdownlist',
            'items'=>InvnomItemType::model()->getTypeList(),
            'prompt'=>'Выберите значение:',
        ),
        'distribution'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'brand_id'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'item_model'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'quantity'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),


    ),
 
    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Create item',
        ),
    ),
);