<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name . ' - About';
$this->breadcrumbs = array('About', );
Yii::app()->clientScript->registerPackage('jquery');
if (!Yii::app()->user->isGuest) {
    print_r(Yii::app()->user->getGroups());
}
if (Yii::app()->user->checkAccess('requestCreator')) {
    echo "----mod-----";
}

?>
<h1>About</h1>
http://habrahabr.ru/post/177873/
<p>This is a "static" page. You may change the content of this page
by updating the file <code><?php echo __file__; ?></code>.</p>
