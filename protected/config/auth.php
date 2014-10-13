<?php

return array(

    /************************************
    ***************ROLES****************
    ************************************/
    'newsReader' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array(0 => 'readNews', ),
        ),
    'newsAuthor' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'newsReader',
            'createNews',
            'updateOwnNews',
            'deleteOwnNews'),
        ),

    'newsManager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'newsReader',
            'createNews',
            'updateNews',
            'deleteNews',
            ),
        ),
    // Инвентарные номера
    'invnomReader' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Просмотр инвентарных номеров',
        'bizRule' => null,
        'data' => null,
        'children' => array('readInvnom'),
        ),    
    'invnomCreator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Добавление мат. ценностей инвентарных номеров',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'invnomReader',
            'invnomManager',
            ),
        ),        
    'invnomManager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Создавать перемещение',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'invnomReader',
            ),
        ),    

    //Строительный крепеж
    'authorized' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Просмотр очереди',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'skViewer'
            ),
        ),
    'skViewer' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Просмотр очереди',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            ),
        ),             
    'skManager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Добавление распоряжения',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'skAddComment',
            ),
        ),  
    'skSklad' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Изменение статуса',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'skAddComment',
            ),         
        ), 
    'skTopmanager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Изменение приоритета',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'skManager',
            'skAddComment',
            ),        
        ), 
    'skBuhgalter' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Добавления инфо по машинам',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'skAddComment',
            ),        
        ),        
    'skAddComment' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Добавление комментариев',
        'bizRule' => null,
        'data' => null,       
        ),  
    // Картриджы
    'cartrigeAdmin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Добавления картриджей',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'cartrigeManager',
            ),        
        ),        
    'cartrigeManager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Управление картриджами',
        'bizRule' => null,
        'data' => null,       
        ),                                  
    //Заявки
    'requestCreator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array(0 => 'createRequest', ),
        ),

    'requestManager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'createRequest',
            'viewRequests',
            'manageRequests',
            ),
        ),


    /************************************
    **********ROLES ASSIGMENTS**********
    ************************************/
    'video.avmg.com.ua_user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array(
            'newsManager',
            'requestManager',
            ),
        ),

    'Пользователи домена' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array('authorized', ),
        ),
    'www_invnom_viewer' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array('invnomReader', ),
        ),  
    'www_invnom_moderate' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array('invnomManager', ),
        ),  
    'www_invnom_admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array('invnomCreator', ),
        ),  
    'www_sk_manager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array('skManager', ),
        ),
    'www_sk_sklad' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array('skSklad', ),
        ),
    'www_sk_topmanager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array('skTopmanager', ),
        ),   
    'www_sk_buhgalter' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array('skBuhgalter', ),
        ),  
    'www_cartrige_admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array('cartrigeAdmin', ),
        ), 
    'www_cartrige_manager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => '',
        'bizRule' => null,
        'data' => null,
        'children' => array('cartrigeManager', ),
        ),                                                                
    ); //И т.д.
