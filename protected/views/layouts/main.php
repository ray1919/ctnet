<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainMbMenu">
		<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Primer', 'url'=>array('/primer'),
                                  'items'=>array(
                                    array('label'=>'Plate', 'url'=>array('/plate')),
                                    array('label'=>'Store Type', 'url'=>array('/StoreType')),
                                    array('label'=>'Position', 'url'=>array('/position')),
                                    array('label'=>'Gene DB', 'url'=>array('/gene')),
                                    array('label'=>'miRNA DB', 'url'=>array('/mirna')),
                                    array('label'=>'Species', 'url'=>array('/species')),
                                    ),
                                ),
                                array('label'=>'Contacts', 'url'=>array('/customer'),
                                  'items'=>array(
                                    array('label'=>'Communication', 'url'=>array('/visit')),
                                    array('label'=>'Order', 'url'=>array('/CustomerOrder')),
                                    /*array('label'=>'Gene Order', 'url'=>array('/GeneOrder')),*/
                                    ),
                                ),
                                array('label'=>'PCR Service', 'url'=>array('/PCRService'),
                                  'items'=>array(
                                    array('label'=>'PCR Sample', 'url'=>array('/PCRSample')),
                                    ),
                                ),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact Us', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/userGroups'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                                array('label'=>'('.Yii::app()->user->name.')', 'url'=>array('/userGroups'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by CT Bioscience.<br/>
		All Rights Reserved.<br/><?php echo Yii::app()->user->returnUrl; ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
