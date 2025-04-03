<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
	 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?$APPLICATION->ShowTitle()?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/common.css" />
	
	<?$APPLICATION->ShowHead();?>
	
	<!--[if lte IE 6]>
	<style type="text/css">
		
		#support-question { 
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='./images/question.png', sizingMethod = 'crop'); 
		}
		
		#support-question { left: -9px;}
		
		#banner-overlay {
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='./images/overlay.png', sizingMethod = 'crop');
		}
		
	</style>
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/colors.css" />
		
</head>
<body>
		<div id="page-wrapper">
		
			<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	
			<div id="header">
				<table>
					<tr>
						<td id="logo"><a href="<?=SITE_DIR?>" title="<?=GetMessage("HDR_GOTO_MAIN")?>"><?$APPLICATION->IncludeFile(
									SITE_DIR."include/company_name.php",
									Array(),
									Array("MODE"=>"html")
								);?></a></td>
						<td id="slogan"><?$APPLICATION->IncludeFile(
									SITE_DIR."include/company_slogan.php",
									Array(),
									Array("MODE"=>"html")
								);?></td>
					</tr>
				</table>

				
				<div id="search">
				<?$APPLICATION->IncludeComponent("bitrix:search.form", "flat", array(
					"PAGE" => "#SITE_DIR#search/index.php"
					),
					false
				);?>
				</div>
			</div>

<?$APPLICATION->IncludeComponent("bitrix:menu", "top", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "Y",
	"MENU_CACHE_TIME" => "36000000",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "1",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
				
		
			<div id="content-wrapper">
				<div id="content">
				<?if($APPLICATION->GetCurPage(false)==SITE_DIR):?>
					<div id="banner">
						<div id="banner-image"><?$APPLICATION->IncludeFile(
									SITE_DIR."include/banner.php",
									Array(),
									Array("MODE"=>"html")
								);?></div>
						<table cellspacing="0" id="banner-text">
							<tr>
								<td width="35%">&nbsp;</td>
								<td>
								<?$APPLICATION->IncludeFile(
									SITE_DIR."include/banner_text.php",
									Array(),
									Array("MODE"=>"text")
								);?>
								</td>
							</tr>
						</table>
						<div id="banner-overlay"></div>
					</div>
				<?else:?>
					<div id="breadcrumb">
						<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", array(
	"START_FROM" => "1",
	"PATH" => "",
	"SITE_ID" => SITE_ID
	),
	false
);?>
					</div>					
				<?endif?>					
					<div id="workarea-wrapper">
						<div id="left-menu">
						<?$APPLICATION->IncludeComponent("bitrix:menu", "tree", array(
							"ROOT_MENU_TYPE" => "leftfirst",
							"MENU_CACHE_TYPE" => "Y",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(
							),
							"MAX_LEVEL" => "4",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "N",
							"ALLOW_MULTI_SELECT" => "N"
							),
							false
						);?>
						</div>						
						<div id="workarea">
							<div id="workarea-inner">
							<h5><?$APPLICATION->ShowTitle(false);?></h5> 

