<body>
<div id="main-wrapper">
<div align="center"><img src="images/logo-big.png" alt="#" /></div>
<div class="white-wrapper">
<div style="padding:15px;">
<div class="red-color-heading">Edit <span class="black-color-heading">Category</span>

<div align="right"><a href="user/category_list">Category List</a></div>

</div>
<div class="clear"></div>
<span style="color:green"><?php if(isset($message)) { echo $message;  }?></span>
<div id="left-panelform">
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="operation" value="create_category_by_user">
<div class="formpanel-text form-text">Category Name: </div>
<div class="inputpanel-rightCategory"><input type="text" class="input" style="width:263px;" name="category_name" value="<?php echo $category_data['category_name'];?>" />
<span style="color:red"><?php if(isset($err['category_name'])) { echo $err['category_name'];  }?></span>
</div>
<div class="clear"></div>
<div class="formpanel-text form-text">Category Image:</div>
<div class="inputpanel-rightCategory"><input type="file" class="input" name="category_image"/>
<?php 
 $image_path = "upload_image/".$category_data['category_image'];		
	if(file_exists($image_path))
	{?>
<a target="_blank" href="<?php echo $image_path;?>" >View</a>
	
	<?php 
	}
?>

</div>
<div class="clear"></div>
<div class="formpanel-text form-text">Is your category:</div>
<div class="inputpanel-rightCategory">
  <select   class="input" style="width:200px;" name="sub_category_type">
    <option value="1" <?php if($category_data['category_type']==1) {?> selected="selected" <?php } ?>>Regional</option>
     <option value="2" <?php if($category_data['category_type']==2) {?> selected="selected" <?php } ?>>Globla</option>
  </select>
</div>
<div class="clear"></div>

<div class="formpanel-text form-text">Review Defaults: </div>
<div class="inputpanel-rightCategory"><input name="review_default" type="text" class="input" style="width:263px;"  value="<?php echo $category_data['review_default'];?>" />

 <span style="color:red"><?php if(isset($err['review_default'])) { echo $err['review_default'];  }?></span> 
 
</div>
<div class="clear"></div>



<?php
  if(!empty($category_image_data))
  {
	  $i = 1;
	  foreach($category_image_data as $image_detail)
	  {
  ?>
	
       
                        
<div class="formpanel-text form-text">Review Defaults pics :</div>
<div class="inputpanel-rightCategory"><input type="file" class="input" name="category_image_name[]"/>
<?php		
$image_path = "upload_image/".$image_detail['category_image_name'];		
if(file_exists($image_path))
{	
?>
	<a href="<?php echo $image_path;?>" target="_blank">View</a>
<?php 
}
?>

<div class="clear"></div>
</div>
<?php
$i++; }
}
?>
<div class="clear"></div>




</div>


<div id="right-panelform"><div class="formpanel-text-rightCategory form-text">Category Rules:</div>
  <div class="inputpanel-rightCategory2"> <textarea name="category_rules" rows="8" class="textarea" style="width:270px;"><?php echo $category_data['category_rules'];?></textarea> 
  <span style="color:red"><?php if(isset($err['category_rules'])) { echo $err['category_rules'];  }?></span>
  </div>
  <div class="clear"></div>
  <div id="right-panelform"><div class="formpanel-text-rightCategory form-text"> Category Descripition:</div>
  <div class="inputpanel-rightCategory2"> <textarea name="category_description" rows="8" class="textarea" style="width:270px;"><?php echo $category_data['category_description'];?></textarea>
   <span style="color:red"><?php if(isset($err['category_description'])) { echo $err['category_description'];  }?></span> 
  </div>
</div>





</div>
<div class="clear"></div>

<div><img src="images/line-flip.png" alt="#" /></div>
<div class="clear"></div>
<div align="center"><span style="margin-bottom:20px;">
<input name="Submit" type="submit" class="submit-buttons-round" value="Submit" />
&nbsp;
<input name="Clear" type="reset" class="clear-button" value="Clear" />
</span></div>

</form>
</div></div>
<div class="clear"></div>







			

