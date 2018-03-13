<?php
if(!defined("ABSPATH"))exit;
if(!is_user_logged_in())
{
	return;
}
else
{
	$access_granted = false;
	foreach ($user_role_permission as $permissions) {
		if(current_user_can($permissions))
		{
			$access_granted = true;
			break;
		}
	}
	if(!$access_granted)
	{
		return;
	}
	else
	{

		setting_page();

		//****************************START GOOGLE REVIEWS**********************//

		echo "<h1>GOOGLE REVIEWS</h1>";
		$arrContextOptions=array(
		    "ssl"=>array(
		        "verify_peer"=>false,
		        "verify_peer_name"=>false,
		    ),
		);  
		$placeid = 'ChIJQ0MizyGTDzkRsmpN7ZM96_I';
		$googleapi = 'AIzaSyAUy00JGj2tZT9SqRdbSQNNqcWN6Dju54A';

		$get_google_reviews = file_get_contents("https://maps.googleapis.com/maps/api/place/details/json?placeid=$placeid&key=$googleapi", false, stream_context_create($arrContextOptions));
		
		$result = json_decode($get_google_reviews, true);
		// echo "<pre>";
		// //print_r($result);
		// echo "</pre>";
		// //$json_errors = array();
		$address = array_column($result, 'reviews');
		echo "<pre>";
		//print_r($address);
		?>
		<table border='1' width='100' height='300'>
			<thead>
				<tr>
					<th>Author Name</th>
					<th>Rating</th>
					<th>Description</th>
					<th>Time</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($address as $value) 
				{
					foreach($value as $val2)
					{
						?>
						<tr>
						<td><?php echo $val2['author_name']; ?></td>
						<td><?php echo $val2['rating']; ?></td>
						<td><?php echo $val2['text']; ?></td>
						<td><?php echo $val2['time']; ?></td>
						</tr>
						<?php
					}
				}
				?>
			</tbody>
		</table>

		<!****************************END GOOGLE REVIEWS**********************>

		<?php

		//****************************START FACEBOOK REVIEWS**********************//

		echo "<h1>FACEBOOK REVIEWS</h1>";
		$results = file_get_contents('https://graph.facebook.com/1959577107701565/ratings?access_token=EAACLZBQt0aGgBAOqeNnFta6tcJ2rTKlBuqHRc0yjhTLpNFO6ErIOL9kYQekuZBs42nfT4NAKzloaJjSGAihqaLNxilYZBNxd3qXoczaBIi2MtrEyYwzWVBeY9WEZADy0N9r2OCMcguDlkwUIJTB1ZAbwQpOg0BUebz5ejk32ETwZDZD');

		$result=json_decode($results,true); 
		$result_fb = array($result);
		echo "<pre>";
		print_r($result_fb);
		 // $reviewers = array_column($result_fb, 'data');
		 // print_r($reviewers);
		 // foreach ($reviewers as $ke => $sto) {
		 // 	foreach ($sto as $ptt => $bds) {
		 // 		foreach ($bds as $vus) {
		 // 			foreach ($vus as $vss) {
		 // 			echo $vss;
		 // 			}
		 // 		}
		 // 	}
		 // }
		?>
	 	<table border= 1 width="600" height="300" class="wp-list-table widefat fixed striped pages"> 
		 	<thead>
			 <tr>
			 	<th scope="col" id="review-text" class="manage-column column-title column-primary sortable desc"><a href="http://localhost/reviews/wp-admin/admin.php?page=reviews_listing&amp;orderby=review-text&amp;order=asc"><span>Review Text</span><span class="sorting-indicator"></span></a></th>
			 	<th scope="col" id="author-name" class="manage-column column-comments num sortable desc"><a href="http://localhost/reviews/wp-admin/admin.php?page=reviews_listing&amp;orderby=author-name&amp;order=asc"><span>Author Name</span><span class="sorting-indicator"></span></a></th>
			 	<th scope="col" id="ratings" class="manage-column column-date sortable asc"><a href="http://localhost/reviews/wp-admin/admin.php?page=reviews_listing&amp;orderby=ratings&amp;order=asc"><span>Rating</span><span class="sorting-indicator"></span></a></th>
			 	<th scope="col" id="page-id" class="manage-column column-author"><a href="http://localhost/reviews/wp-admin/admin.php?page=reviews_listing&amp;orderby=page-id&amp;order=asc"><span>Page ID</span><span class="sorting-indicator"></span></a></th>
			 </tr>
		 	</thead>
		 	<tbody id="the-list">
			 	<?php
					foreach ($result_fb as $key) 
					{
					 	foreach ($key as $vas) 
					 	{
					 		foreach ($vas as $for) 
					 		{
					 			?>
				 				<tr class="iedit author-self level-0 post-15 type-page status-publish hentry">
					 				<td class="title column-title has-row-actions column-primary page-title"><?php echo $for['review_text'];?></td>
					 				<td class="comments column-comments"><?php echo $for['reviewer']['name'];?></td>
					 				<td class="date column-date"><?php echo $for['rating'];?></td>
					 				<td class="author column-author"><?php echo $for['reviewer']['id'];?></td>
				 				</tr>
					 			<?php
					 		}
					 	}
					}
				?>
			</tbody>
		</table>

		<!***********************END FACEBOOK REVIEWS*************************>


		<?php

		//****************************START YELP REVIEWS**********************//

		echo "<h1>YELP REVIEWS</h1>";
		require_once (ONLINE_REVIEWS_DIR_PATH."lib/hhb_.inc.php");
		// $postData = "grant_type=client_credentials&".
		//             "client_id=qn0ddURvMvLitPMc8MnWsg&".
		//             "client_secret=3_zRanVES7XBdDBE5Cfahxyq1aJkHkZP2kmMXxpbA2ElIIGHdHYueF_1P-rDPFUeL1HPPug9sNUWhuqfbXnaUQHuBbXG3OF672PDz_w_Y6MkEsDVdMqN07DdcAqmWnYx";
		// $ch = curl_init();
		$hc = new hhb_curl ( 'https://api.yelp.com/oauth2/token', true );
		$hc->setopt_array ( array (
		        CURLOPT_POST => true,
		        CURLOPT_POSTFIELDS => http_build_query ( array (
		                'grant_type' => 'client_credentials', // << hardcoded
		                'client_id' => 'iW-6oIOQ_r4EFFbuAuVkUg',
		                'client_secret' => 'Ho6vgpNhWkOlPmmOr8knbc6SAFgt2g8tc_CPWHQxQLe0UW5hsKTOXcMjLFc7VjAU23Y22esOi5wAZabJFDVDXFNXcYBFKgsIcYZaegc5EZ3mHXPD9qKUBbZrOUymWnYx' 
		        ) ) 
		) );
		$hc->exec ();

		// hhb_var_dump ( $hc->getStdErr (),  );
		// $json = $hc->getResponseBody ();
		$result = $hc->getStdOut ();

		if($result)
		{
		        $data = json_decode($result);
		        echo "<pre>";
		        print_r($data);
		}
	}
}

?>
<!***********************END YELP REVIEWS*************************>