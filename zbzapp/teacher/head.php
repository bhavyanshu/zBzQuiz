<?php
function getpageTitle($titleset){
		$title=ucfirst($titleset)." | zBzQuiz Web Application";
			return $title;
	}
?>
<!DOCTYPE html>
<html lang="de"><!-- use class="debug" here if you develope a template and want to check-->
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
   	<!-- some meta tags, important for SEO"--> 
    <meta name="description" content="zBzQuiz Web Application" />
    <meta name="keywords" content="zBzQuiz Web Application Online/LAN Quiz Application in php Open source" />
    <meta name="revisit-after" content="7 days" />
    <meta name="robots" content="index,follow" />
	
	<title><?php echo getpageTitle($titleset); ?></title>
			
            
            <link rel="stylesheet" href="../css/inuit.css" />
            <link rel="stylesheet" href="../css/fluid-grid16-1100px.css" />
            <link rel="stylesheet" href="../css/eve-styles.css" />
            <link rel="stylesheet" href="../css/buttons/buttons.css"
            <link rel="shortcut icon" href="../icon.png" />
            <link rel="apple-touch-icon-precomposed" href="../img/icon.png" />
            <link rel="stylesheet" href="../css/form-style.css">
  								<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
            <script src="../js/respond-min.js" type="text/javascript"></script>
            <script src="../js/jquery.shorten.1.0.js" type="text/javascript"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
            <script>window.jQuery || document.write('<script src="../scripts/jquery164min.js">\x3C/script>')</script><!--local fallback for JQuery-->
								<script src="../js/jquery.flexslider-min.js" type="text/javascript"></script>
            <link rel="stylesheet" href="../css/flexslider.css" />
            <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
								<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
								<script src="http://malsup.github.com/jquery.form.js"></script>
            <script type="text/javascript">
				  				$(window).load(function() {
												$('.flexslider').flexslider({
						  					animation: "slide",<!--you can also choose fade here-->
						  					directionNav: false,<!--Attention: if you choose true here, the nav-buttons will also appear in the ticker! -->
						  					keyboardNav: true,
						  					mousewheel: true
										});
				  				});
								</script>
               
                    <!--Hide the hr img because of ugly borders in IE7. You can change the color of border-top to display a line -->
                    <!--[if lte IE 7]>

                        <style>
                    		hr { display:block; height:1px; border:0; border-top:1px solid #fff; margin:1em 0; padding:0; }
                            .grid-4{ width:22% }
                        </style>
                    <![endif]-->

</head>