<!-- Container -->
<div id="container">
	<div class="shell">		
		<?php 
        if($this->session->flashdata('add')) {
			     $msg = $this->session->flashdata('add');
				 display_error($msg,"Notice:");
	         }?>
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			<!-- Content -->
			<div id="content">
            <div  align="right">
				<!--<a href="category/add_category">Add Category</a>-->
            </div>    
            <br/>
				<!-- Box -->
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Review List </h2>
					</div>
					<!-- End Box Head -->	
					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
                            	<th>S.no</th>									
								<th>Name</th>	
                                <th>Email</th>	
                                <th>Topic</th>	
                                <th>Rate</th>	
                                <th>View Detail</th> 
							</tr>
                            <?php							
							//pr($site_data);							
							if(!empty($site_data))
							{
								foreach($site_data as $site_data_detail)
								{
									$user_info = get_user_detail_by_user_id($site_data_detail['creator_id']);
									
									//pr($user_info);
							?>
							<tr>	
                                <td><?php echo ++$offset;?></td>								
								<td><h3><?php echo $user_info['user_first_name']." ".$user_info['user_last_name'];?></h3></td>
								<td> <h3><?php echo $user_info['user_email'];?></h3>                          </td>
                        <td><?php 
						// category_or_subcategory 
						
						if($site_data_detail['category_or_subcategory']==1)
						{ // get category name
							echo get_sub_category_name($site_data_detail['topic_id']);
							// echo get_category_name($site_data_detail['topic_id']);
						}
						
						if($site_data_detail['category_or_subcategory']==2)
						{ // get sub category name
						
							echo get_sub_category_name($site_data_detail['topic_id']);
							//echo get_category_name($site_data_detail['topic_id']);
							
						}
						
						//echo ++$offset;
						
						
						?></td>
                        <td><?php echo $site_data_detail['rate'];?></td>
                        <td><a href="admin/view_topic_review_deatil/<?php echo $site_data_detail['review_id'];?>"title="Active">View Detail</a>                     </td>
							</tr>
                            <?php
								}

							}?>
						</table>
						<!-- Pagging -->
						<div class="paggingwew" align="right" style="font-size:24px;">
							<!--<div class="left">Showing 1-12 of 44</div>
							<div class="right">
								<a href="#">Previous</a>
								<a href="#">1</a>
								<a href="#">2</a>
								<a href="#">3</a>
								<a href="#">4</a>
								<a href="#">245</a>
								<span>...</span>
								<a href="#">Next</a>
								<a href="#">View all</a>
							</div>-->
                            <?php
									echo $site_data_pagination;
							?>
						</div>
						<!-- End Pagging -->
						
					</div>
					<!-- Table -->
				</div>
				<!-- End Box -->

			</div>
			<!-- End Content -->
			
			<!-- Sidebar -->
			
			<!-- End Sidebar -->
			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>
</div>
<!-- End Container -->