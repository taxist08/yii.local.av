<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->
baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->
baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->
baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->
baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->
baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode(Yii::t("main", 'New AVMG Site')); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
        <div id="logo"><?php echo Yii::t("main", 'New AVMG Site'); ?></div>
		<!--<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>-->
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('ext.CDropDownMenu.CDropDownMenu', array(
    'style' => 'navbar', // or default or navbar
    'items' => array(
        array('label' => Yii::t("main", 'Home'), 'url' => array('/site/index')),
        array(
            'label' => 'About',
            'url' => array('/site/page', 'view' => 'about'),
            'visible' => Yii::app()->user->checkAccess('invnomCreator'),
            'items' => array(
/*                array(
                    'label' => Yii::t("main", 'Browse demos'),
                    'url' => array('//index.php?r=site/page&view=about'),
                    ),
                array(
                    'label' => Yii::t("main", 'Create new Demo'),
                    'url' => array('//index.php?r=site/page&view=about'),
                    ),
                array(
                    'label' => Yii::t("main", 'Demos'),
                    'url' => array('//index.php?r=site/page&view=about', 'owner' => true),
                    ),
 */               ),
            ),
        array(
            'label' => Yii::t("sk", 'SK'),
            'url' => array('/queuesk/index'),
            'visible' => Yii::app()->user->checkAccess('skViewer'),
            'items' => array(
                array(
                    'label' => Yii::t("sk", 'queue sk'),
                    'url' => array('/queuesk/index'),
                    ),
                array(
                    'label' => Yii::t("ProfnastilModule.profnastil", 'queue profnastil'),
                    'url' => array('/profnastil/profnastil/index'),
                    ),                    
                ),
            ),            
//        array('label' => 'Contact', 'url' => array('/site/contact')),
        array('label' => Yii::t("main", 'Directory'), 'url' => array('/directory')),
        array(
            'label' => Yii::t("invnom", 'Inventory numbers'),
            'url' => array('/invnomitem'),
            'items' => array(
                array(
                    'label' => Yii::t("invnom", 'Create item'),
                    'url' => array('/invnomitem/create'),
                    'visible' => Yii::app()->user->checkAccess('invnomCreator'),
                    ),
                ),
            ),
        array(
            'label' => Yii::t("cartriges", 'Cartriges'),
            'url' => array('/cartriges'),
            'visible' => Yii::app()->user->checkAccess('cartrigeManager'),
            'items' => array(
                array(
                    'label' => Yii::t("cartriges", 'ADD cartrige'),
                    'url' => array('/cartriges/create'),
                    'visible' => Yii::app()->user->checkAccess('cartrigeAdmin'),
                    ),
                array(
                    'label' => Yii::t("cartriges", 'Manage CartrigesType'),
                    'url' => array('/cartrigesType/admin'),
                    'visible' => Yii::app()->user->checkAccess('cartrigeAdmin'),
                    ),                    
                ),
            ),
        array(
            'label' => 'Login',
            'url' => array('/site/login'),
            'visible' => Yii::app()->user->isGuest),
        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
        ),
    )); ?>
	</div><!-- mainmenu -->
	<?php if (isset($this->breadcrumbs)): ?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array('links' => $this->
        breadcrumbs, )); ?><!-- breadcrumbs -->
	<?php endif ?>
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> ООО "АВ металл групп".<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
