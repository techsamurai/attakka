
<div class="internal-wrapper">
<div style="margin-top:100px;">
  <img src="images/movie-banner.png" alt="" class="image-border" />
  <h7 style="padding-left:10px;">Movies</h7>
			   </div>
			 
			 <div style="margin-top:40px; margin-bottom:20px;" ><img src="images/createfree-banner.png" alt="#"  class="image-border"/></div>
			 
			 <div class="clear"></div>
			 
 <!--slider content-->
             <script type="text/javascript">
/* RSID: */
var s_account="applebrglobal"
</script>


<script type="text/javascript" src="global/metrics/js/s_code_h.js"></script>


<div id="main" data-hires="true" style="z-index:15000;">
		<div class="productbrowser content grey-back-new" id="pb-mac">
        <div class="pb-pageindicator roundedbottom" id="pb-pi-mac"><div>
		<b class="caret"></b>
		<!--<a class="page">Genres</a>-->
	
		
	</div></div>
	<!--<div class="pb-slider">
		<div class="pb-slide">
			<ul class="ul-slider">
				<li class="pb-macbookair"><a href="#">Animation</a></li>
				<li class="pb-macbookpro"><a href="#">Action</a></li>
				<li class="pb-macmini"><a href="#">Adventure</a></li>
				<li class="pb-imac"><a href="#">Comedy</a></li>
				<li class="pb-macpro"><a href="#">Crime</a></li>
				<li class="pb-macosx"><a href="Subcategory-Page-Horror1stnov-newversion2.html">Horror</a></li>
                <li class="pb-macosx"><a href="#">Science Fiction</a></li>
                <li class="pb-macosx"><a href="#">Art</a></li>
                <li class="pb-macosx"><a href="#">Thriller</a></li>
                <li class="pb-macosx"><a href="#">Black Comedy</a></li>
                <li class="pb-macosx"><a href="#">Drama</a></li>
			</ul>

			

			
			
		</div>
	</div>-->

	
</div>
<script src="global/scripts/productbrowser.js" type="text/javascript" charset="utf-8"></script>

	<!--/showcase-->


	</div>
             <!--slider content-->
     
      
        
       <!-- <div class="clear"></div>
        <div class="bestfive-panel">
  <h12>Best Five</h12>
</div>

       <div class="worsefive-panel">
  <h13>worse Five</h13>
</div>
        <div id="left-panel-restaurantcategories-24nov"><iframe src="scroller-left-movie.html" allowtransparency="0" width="482" height="520" frameborder="0"></iframe></div>
 
  <div id="right-panel-restaurantcategories-24nov"><iframe src="scroller-right-movie.html" allowtransparency="0" width="515" height="520" frameborder="0"></iframe></div> 
  <div class="clear"></div>-->
  
  
  <div class="grey-round-bar heading-black">
  <div style="padding-left:5px;">
  
<!--  <a style="text-decoration:none;" class="black-button" href="#">HOT</a> <a style="text-decoration:none; padding-right:20px;" class="heading-black" href="#">NEW</a> <a style="text-decoration:none; padding-right:20px;" class="heading-black" href="#">RANK</a> <a style="text-decoration:none; padding-right:20px;" class="heading-black" href="#">FANS</a>-->
  
  </div> 
  </div>
                
        <div class="clear"></div>
                
                <div class="heading-nov19">
  <h8>Name</h8>
</div>

<div class="notes-panelnov19">
  <h10>Notes</h10>
</div>

<div class="rates-panelnov19">
  <h11>Rates</h11>
</div>
                
                
                <div class="clear"></div>
                
               
                  
                    <?php
			//	pr($site_data);
			
			if(!empty($site_data))
			{
				foreach($site_data as $detail_topic)
				{
				?>
	
			<!--row 2-->
			<a href="user/topicdetail/<?php echo $detail_topic["sub_category_id"];?>/s"> <div class="border-round">
			  <div class="images-left-panel views-field round-img">
              
              <?php 

	$image_path = "upload_image/".$detail_topic['sub_category_image'];		
	if(file_exists($image_path))
	{?>
              
     <img src="create_thumbnail_image.php?file=<?php echo $image_path;?>&maxw=287&maxh=157"  border="0"  alt="#" />
     <?php
	}else{
	 ?>
              <img src="images/thedark.png"  border="0"  alt="#" />
          
     <?php
	}
	 ?>
          
              
              <h6 style="padding-left:80px; margin-top:-68px;"><?php echo $detail_topic['sub_category_name'];?> </h6></div>
			<!--  <div class="top-image-panel"><img src="images/movie.png" alt="#"  border="0" /></div>-->
			  <div class="notes-panelnew20cot middle-text"><div class="internal-panel">
<div class="panel">
<p style=" position: relative; top: -50%; margin-top:45px;"><?php echo $detail_topic['sub_category_description'];?></p>
</div>
</div> </div>
<!--<div class="medal-panel"><img src="images/gold-icon.png" alt="#"  border="0"/></div>-->

<?php
	$topic_id = $detail_topic['sub_category_id'];
	$rate = get_topic_rate($topic_id); 
	$rate_image = find_image_name_review($rate,2);	// sub category 
?>

<div class="rate-panel" align="right"><img src="images/rate/<?php echo $rate_image;?>" alt="#" class="rate-img" border="0" /></div>
			  	  
  </div></a>
<!--row 2-->

	<?php
		}
	}
?>
	
		
		

      
	</div>
			 </div></section>
			</div> 	
				
		<div class="clear"></div>
        <div class="internal-wrapper">