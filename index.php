<?
include("config.php");
session_start();
$con= mysql_connect(DB_HOST, DB_USER_NAME,DB_PASSWORD); 
if(!$con)
{
		die('Could not connect: ' . mysql_error());
}	
mysql_select_db(DB_NAME);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">

<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<!-- basic meta tags -->
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow" />



<!-- title -->
<title>ATTAKKA</title>

<script type="text/javascript" src="chromejs/chrome.js"></script>
<link rel="stylesheet" type="text/css" href="css/chromestyle.css" />


<!-- stylesheets -->
<link rel="stylesheet" href="css/style-fresh.css" type="text/css" media="screen" />
<link rel="stylesheet" href="global/styles/base.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

<link rel="stylesheet" href="css/style1.css" type="text/css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="css/style3.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#search').addClass('load');
			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >10) {
					//alert(data.length);
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#search').removeClass('load');
				}
				else
				{
					$('#suggestions').fadeOut();
				}	
			});
		}
	}

	function fill(thisValue) {
		$('#search').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}

</script>
<style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	padding:3px;
	border:1px #CCC solid;
	font-size:17px;
}
.suggestionsBox {
	position: absolute;
	left: 0px;
	top:10px;
	margin: 26px 0px 0px 0px;
	width: 200px;
	padding:0px;
	background-color: #000;
	border-top: 3px solid #000;
	color: #fff;
	left:158px;
	z-index: 1000;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
	color:#C51700;
	bacground-color:#000;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:CalibriRegular;
	font-size:15px;
	color:#000;
	padding:0;
	margin:0;
}

.load{
background-image:url(image/loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}

</style>
<!-- scripts -->

<!-- Internet Explorer 6 PNG Transparency Fix for all elements with class 'ie6fix' -->	
<!--[if IE 6]>
<script type='text/javascript' src='http://www.kriesi.at/themes/newscast/wp-content/themes/newscast/js/dd_belated_png.js'></script>
<script>DD_belatedPNG.fix('.ie6fix');</script>
<style>#footer ul li a, .sidebar ul li a {zoom:1;} #head #searchform, #head #searchform div {position:static;}
</style>
<![endif]-->

<!--[if IE 8]>
	<style>	 .search-back {
    background: url("../images/search-back.png") no-repeat scroll 0 0 transparent;
    float: left;
    height: 66px;
    margin-top: 10px;
    width: 960px;
}
</style>
<![endif]-->

<meta name='robots' content='noindex,nofollow' />

<script type='text/javascript' src='jquery/jquery.js?ver=1.7.2'></script>
<script type='text/javascript' src='jquery/jquery.prettyPhoto.js?ver=3.4'></script>
<script type='text/javascript' src='jquery/custom.js?ver=3.4'></script>




<!-- Debugging help, do not remove -->
<meta name="Framework" content="Kpress" />
<meta name="Theme Version" content="2.0" />
<meta name="Framework Version" content="2.1" />
<meta name="CMS Version" content="3.4" />




	
<!-- meta tags, needed for javascript -->
<meta name="autorotate" content="1" />
<meta name="autorotateDelay" content="5" />
<meta name="autorotateSpeed" content="500" />
<meta name="temp_url" content="http://www.kriesi.at/themes/newscast/wp-content/themes/newscast" />
  <script>

    // placeholder polyfill
    $(document).ready(function(){
        function add() {
            if($(this).val() == ''){
                $(this).val($(this).attr('placeholder')).addClass('placeholder');
            }
        }

        function remove() {
            if($(this).val() == $(this).attr('placeholder')){
                $(this).val('').removeClass('placeholder');
            }
        }

        // Create a dummy element for feature detection
        if (!('placeholder' in $('<input>')[0])) {

            // Select the elements that have a placeholder attribute
            $('input[placeholder], innput[placeholder]').blur(add).focus(remove).each(add);

            // Remove the placeholder text before the form is submitted
            $('form').submit(function(){
                $(this).find('input[placeholder], input[placeholder]').each(remove);
            });
        }
    });
</script>
</head>


<body id='top' class="home blog" >
<div id="main-wrapper">
  <div id="right-panel"><img src="images/intro-icon.png" alt="#" class="intro-icon" /> <a href="#" class="top-links">intro video</a> 
  <?php
  if(@$_SESSION['user_id']!="")
  {
  ?>
  <a href="logout.php" title="Offerings" class="top-links" style="background:none"><img src="images/logout-btrn.png" alt="#" style="margin-top:3px; margin-right:5px;" border="0"/> LogOUT</a>
  <?php
  	}
  else
  {
	?>
	<img src="images/login-icon.png" alt="#" class="login-icon" /> <a href="login.php" class="top-links-login">Login</a> <img src="images/register-icon.png" alt="#" class="register-icon" /> <a href="register.php" class="top-links-register">Register</a>
 <?php 
	}
 ?>
  </div>
  <div class="clear"></div>
<div class="logo"><a href="index.php"><img src="images/logo-attakka1.png" alt="#" border="0" style="margin-top:20px;margin-left:-110px;" /></a></div>
  <div class="clear"></div>
  <div class="search-back">
  <form action="main.php" method="POST" style="background:none;">
    <input name="search" id="search" onkeyup="suggest(this.value);" onblur="fill();" type="text" class="search-input" placeholder="Search"/>
 <input type="submit" class="search" value="" > <a href="create_rev.php"><img src="images/review-btrn.png" alt="#" style="margin-top:19px;" border="0" /></a></div>

 <?php
                if (isset($_GET['msg'])=='veracc')
                {
					$msg1="A verification link has been sent to your email. Please click there to login and activate your account.";
					echo '<div class="white-wrapper-error" style="width:800px;margin-left:300px">'.$msg1.'</div>';
				}
				
				$sql9="select review_cat_id from tbl_review where review_cat_id in (select cat_id from tbl_category where cat_parent_id=0 ) group by review_cat_id ORDER BY count(review_cat_id) DESC limit 0,4";
//echo $sql;
$rs9=mysql_query($sql9);
//echo mysql_num_rows($rs);

?>
 
  <div id="site_content">
      <ul id="images" style="margin:auto;">
        <li><a href="general_category.php">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				
					<div style="background:url(images/general-bar.png) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content">GENERAL</div>
					</a>
					<div class="content-panel-new">
					<?php
					$sql10="select review_cat_id from tbl_review where review_cat_id in (select cat_id from tbl_category where cat_parent_id!=0 ) group by review_cat_id ORDER BY AVG(review_rate) DESC limit 0,5";
					//echo $sql;
					$rs10=mysql_query($sql10);
					while($row10=mysql_fetch_assoc($rs10))
					{
						$sql4="select cat_name, cat_thumb_img from tbl_category where cat_id=".$row10['review_cat_id'];
						//echo $sql4;
						$rs4=mysql_query($sql4);
						$row4=mysql_fetch_array($rs4);
						if($row4['cat_thumb_img']=="")
						{
							$src="images/norevimage.jpg";
						}
						else
						{	
							$src="cat_images/".$row4['cat_thumb_img'];
						}	
						$sql13="SELECT AVG(review_rate) as rate FROM tbl_review where review_cat_id=".$row10['review_cat_id'];
						$rs13=mysql_query($sql13);
						$row13=mysql_fetch_array($rs13);
						$rate=ceil($row13['rate']);
						//echo $rate;
						?>
				<div class="homepanel-left"><img src="<?php echo $src?>" alt="#" />
				<div class="nametop-heading-box-horror-small1"><?php echo $row4['cat_name']?></div>
				</div>
				<div class="homepanel-right"><img src="images/rate/smallrate<?php echo $rate?>.png" /></div>
				<div class="clear"></div>
						<?php
					}
					?>
				</div>
				</div>
				</li>
        <?php
        while($row9=mysql_fetch_assoc($rs9))
	{
		$sql4="select cat_name from tbl_category where cat_id=".$row9['review_cat_id'];
			//echo $sql4;
		$rs4=mysql_query($sql4);
		$row4=mysql_fetch_array($rs4);
		
			$sql5="select rev_img from tbl_review_image where rev_cat_id=".$row9['review_cat_id']." order by RAND() limit 0,1";
			$rs5=mysql_query($sql5);
			$row5=mysql_fetch_array($rs5);
			//$image=substr($row5['rev_img'],4);
			$image=$row5['rev_img'];
			$cat_id=$row9['review_cat_id'];
			//echo $image;
	?>
        <li><a href="category_detail.php?cat_id=<?php echo $cat_id?>">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				
					<div style="background:url(review_images/<?php echo $image?>) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content"><?php echo $row4['cat_name']?></div>
					</a>
					<div class="content-panel-new">
				<?php
				
					$sql11="select review_cat_id, count(review_cat_id) as total from tbl_review where review_cat_id in (select cat_id from tbl_category where cat_parent_id=$cat_id) group by review_cat_id ORDER BY count(review_cat_id) DESC limit 0,5";
					
					$rs11=mysql_query($sql11);
					while($row11=mysql_fetch_assoc($rs11))
					{
						$sql4="select cat_name, cat_thumb_img from tbl_category where cat_id=".$row11['review_cat_id'];
						//echo $sql4;
						$rs4=mysql_query($sql4);
						$row4=mysql_fetch_array($rs4);
						$src="cat_images/".$row4['cat_thumb_img'];
						$sql13="SELECT SUM(review_rate) as rate FROM tbl_review where review_cat_id=".$row11['review_cat_id'];
						$rs13=mysql_query($sql13);
						$row13=mysql_fetch_array($rs13);
						$rate=ceil($row13['rate']/$row11['total']);
						//echo $rate;
						if($rate=="-0")
						{
							$rate="0";
						}	
						?>
				<div class="homepanel-left"><img src="<?php echo $src?>" alt="#" />
				<div class="nametop-heading-box-horror-small1"><?php echo $row4['cat_name']?></div>
				</div>
				<div class="homepanel-right"><img src="images/rate/smallrate<?php echo $rate?>.png" /></div>
				<div class="clear"></div>
						<?php
					}
					?>
					</li>
			<?php
		
	}
			?>
        <li><a href="all_category.php">
						<span class='feature_excerpt'>
							<span class='sliderheading'></span></span>				
					<div style="background:url(images/black-city.png) no-repeat; width:700px; height:370px;">
					<div class="leftpanel-content">MOSAIC</div>
					</a>
					<div class="content-panel-new">
				<?php
					$sql10="select review_cat_id from tbl_review where review_cat_id in (select cat_id from tbl_category where cat_parent_id=0 ) group by review_cat_id ORDER BY count(review_cat_id) DESC limit 0,5";
					//echo $sql;
					$rs10=mysql_query($sql10);
					while($row10=mysql_fetch_assoc($rs10))
					{
						$sql4="select cat_name from tbl_category where cat_id=".$row10['review_cat_id'];
						//echo $sql4;
						$rs4=mysql_query($sql4);
						$row4=mysql_fetch_array($rs4);

						$sql5="select rev_img from tbl_review_image where rev_cat_id=".$row10['review_cat_id']." order by RAND() limit 0,1";
						$rs5=mysql_query($sql5);
						$row5=mysql_fetch_array($rs5);
						$src="review_images/".$row5['rev_img'];
						$sql13="SELECT AVG(review_rate) as rate FROM tbl_review where review_cat_id=".$row10['review_cat_id'];
						$rs13=mysql_query($sql13);
						$row13=mysql_fetch_array($rs13);
						$rate=ceil($row13['rate']);
						//echo $rate;
						?>
				<div class="homepanel-left"><img src="<?php echo $src?>" alt="#" />
				<div class="nametop-heading-box-horror-small1"><?php echo $row4['cat_name']?></div>
				</div>
				<div class="homepanel-right"><img src="images/rate/smallrate<?php echo $rate?>.png" /></div>
				<div class="clear"></div>
						<?php
					}
					?>
				</div>
				</div>
					</li>
      </ul>
   </div>
</div>

<div class="clear"></div>
<div id="footer-wrapper">
  <div class="footer-panel-left">
    <div class="footer-text"><a href="index.php" class="footer-text">Home</a> &nbsp;|&nbsp; <a href="about-us.html" class="footer-text">About Us</a> &nbsp;|&nbsp; <a href="terms-conditions.html" class="footer-text">Terms &amp; Conditions</a> &nbsp;|&nbsp; <a href="login.php" class="footer-text" >Login</a> &nbsp;|&nbsp;    <a href="register.php" class="footer-text" > Register</a></div>
    <div class="footer-text">© 2012 Attakka, All rights reserved.</div>
  </div>
  <div class="footer-panel-right"><a href="#"><img src="images/facebook-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/twitter-icon.png" alt="#" border="0" /></a> <a href="#"><img src="images/gplus-icon.png" alt="#"  border="0"/></a></div>
</div>
<div class="suggestionsBox" id="suggestions" style="display: none;margin-left:60px;margin-top:225px;"> <img src="images/arrow1.png" style="position: relative; top: -12px; left: 6px;" alt="upArrow" />
 <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/jquery.kwicks-1.5.1.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#images').kwicks({
        max : 600,
        spacing : 2
      });
      $('ul.sf-menu').sooperfish();
    });
  </script>

</body>
</html>
