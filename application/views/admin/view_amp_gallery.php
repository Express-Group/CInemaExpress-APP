<!doctype html>
<?php
$Details = $article_details[0];
$Url=$this->uri->uri_string();
$CI = &get_instance();
$this->live_db = $CI->load->database('live_db', TRUE);
$Section=$this->live_db->query("SELECT `Section_id`, `MenuVisibility`,`Sectionname`, `SectionnameInHTML`, `DisplayOrder`,`Section_landing`, `IsSeperateWebsite`, `URLSectionStructure` FROM `sectionmaster` WHERE `Status` =  1 and `MenuVisibility`=1 AND `ParentSectionID` is NULL ORDER BY `DisplayOrder` ASC;")->result();
$SectionID = @$Details['section_id'];
if($content_from=="live"){
	$content_details = $this->widget_model->widget_article_content_by_id($content_id, $content_type, "");
		$MoreArticle=$this->live_db->query("SELECT title,url,first_image_path FROM gallery WHERE Section_id='".$SectionID."' AND content_id!='".$content_id."' AND publish_start_date <=NOW() AND status='P' ORDER BY  last_updated_on DESC LIMIT 5")->result();
		$prev_id =$this->live_db->query("CALL select_section_previous_article('".$content_id."','".$SectionID."', '".$content_type."', 'ORDER BY content_id DESC LIMIT 1')")->row_array();
}
if($content_from=="archive"){
	$table = "gallery_".$year.","."gallery_related_images_".$year;
	$content_details = $this->widget_model->widget_archive_article_content_by_id($content_id, $content_type, $Details['url'], $table, "");
	$archive_db = $this->load->database('archive_db', TRUE);
	$TableName='gallery_'.$year;
	$MoreArticle=$archive_db->query("SELECT title,url,first_image_path FROM ".$TableName." WHERE Section_id='".$SectionID."' AND content_id!='".$content_id."' AND publish_start_date <=NOW() AND status='P' ORDER BY  last_updated_on DESC LIMIT 5")->result();
	$prev_id=array();
		
}
if(count($Details) > 0):
$published_date = date('dS  F Y h:i A' , strtotime($Details['publish_start_date']));
		$Updated_date = date('dS  F Y h:i A' , strtotime($Details['last_updated_on']));
		if ($Details['first_image_path'] != '' && getimagesize(image_url_no . imagelibrary_image_path . $Details['first_image_path'])){
			$imagedetails = getimagesize(image_url_no . imagelibrary_image_path.$Details['first_image_path']);
			$imagewidth   = $imagedetails[0];
			$imageheight  = $imagedetails[1];
			if ($imageheight > $imagewidth){
				$Image 	= $Details[0]->article_page_image_path;
			}else{				
				$Image 	= str_replace("original","w600X390", $Details['first_image_path']);
			}
		$image_path = '';
		$image_path = image_url. imagelibrary_image_path . $Image;
		}else{
			$image_path	   = image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
			$imagewidth   = 600;
			$imageheight  = 390;
			$image_caption = '';	
		}
		$OriginalUrl    = base_url().$Details['url'];
?>
<html amp>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
		<title><?php print strip_tags($Details['title']); ?>- Cinemaexpress</title>
		<link rel="shortcut icon" href="<?php echo image_url ?>images/FrontEnd/images/favicon.ico" type="image/x-icon" />
		<script async src="https://cdn.ampproject.org/v0.js"></script>
		<script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>
		<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
		<script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
		<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>  
		<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script> 
		<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
		<script async custom-element="amp-twitter" src="https://cdn.ampproject.org/v0/amp-twitter-0.1.js"></script>
		<script async custom-element="amp-instagram" src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js"></script>
		<link rel="canonical" href="<?php print $OriginalUrl; ?>">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
		<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
		

			<script type="application/ld+json">
			{
				"@context": "http:\/\/schema.org",
				"@type": "NewsArticle",
				"mainEntityOfPage": {
					"@type": "WebPage",
						"@id": "<?php print $OriginalUrl; ?>"
				},
				"headline": "<?php print strip_tags($Details['title']); ?>",
				"description": "<?php print strip_tags($Details['summary_html']); ?>",
				"datePublished": "<?php print $published_date; ?>",
				"dateModified": "<?php  print $Updated_date; ?>",
				"publisher": {
					"@type": "Organization",
					"name": "Cinemaexpress",
					"logo": {
						"@type": "ImageObject",
						"url": "<?php print image_url; ?>images/FrontEnd/images/NIE-logo21.png",
						"width": "462",
						"height": "27"
					}
				},
				"image": {
					"@type": "ImageObject",
					"url": "<?php print $image_path ?>",
					"width": "<?php print @$imagewidth ?>",
					"height": "<?php print @$imageheight ?>"
				}	
			}		
			</script>
		<style amp-custom>
			@font-face{ font-family:fjord; src:url("<?php print image_url ?>css/FrontEnd/fonts/FjordOne-Regular.ttf"); }
			@font-face{ font-family:georgia; src:url("<?php print image_url ?>css/FrontEnd/fonts/georgia.ttf"); }
			 body { font-family: fjord, sans-serif; }
			.header{padding:2px;text-align:center;display: table;width:100%;background: linear-gradient(to bottom, rgba(56,2,9,1) 0%, rgba(56,2,9,1) 2%, rgba(214,23,58,1) 29%, rgba(227,12,55,1) 34%, rgba(227,12,55,1) 37%, rgba(214,23,58,1) 43%, rgba(56,2,9,1) 82%, rgba(56,2,9,1) 100%);}
			.cx-logo{display: inline-table;float: left;padding: 7px 11px 0px;}
			.article{padding:10px;/* background: rgba(236, 235, 235, 0.41); */}
			.articleImageContainer{position:relative; margin: 0 0 13px;}
			amp-image-lightbox.ampimagecontainer{background:white;}
			.article_heading{margin-top: 10px;margin-bottom: 13px;color: #000;font-size: 20px;line-height: 1.5;}
			.social-icons{margin-bottom:8px;}
			.author-details{margin: 0;font-size: 12px;margin-bottom: 14px;color: #FF5722;display: block;} 
			.menu-icon{margin-top:11px;margin-right: 18px;float:right;display: inline-table;}
			#sidebar ul {margin: 0;padding: 0;list-style-type: none;}
			#sidebar ul li{padding: 10px 31px 7px;border-bottom: 1px solid rgba(82, 79, 79, 0.13);}
			#sidebar ul li a,#sidebar ul li a:hover,#sidebar ul li a:active,#sidebar ul li a:focus{color:#fff;text-decoration:none;}
			.close-event{float: right; width: 100%;text-align: right;padding: 9px;}
			.tag_element{margin-left:8px;background: #fff;padding: 3px 13px 3px;border-radius: 12px;float:left;margin-bottom:6px;}
			.tag_element,.tag_element:active,.tag_element:focus,.tag_element:hover{text-decoration:none;color:#000;}
			.tag_heading,.tags,.more_article{float:left;}
			.tags{padding:10px;background: #f9f9f9;width: 100%; font-size: 14px;}
			.more_article,.footer{padding:10px;}
			.more_article_row{width:100%;float:left;margin-bottom: 7px;border-bottom: 1px solid #e1e1e1;padding-bottom: 10px;}
			.more_article_row amp-img{float:left;margin-right: 9px;border-radius:8px;}
			.more_article_row a,.more_article_row a:hover,.more_article_row a:active,.more_article_row a:focus{color:#7b7a7a;text-decoration:none;font-size: 15px;}
			.socialicons{margin-top: 5px;text-align:left;}
			.socialicons  amp-social-share{border-radius:50%;}
			.footer{background: #505050;color:#55acee;float:left;font-size:13px;}
			.footer_copyright{text-align:center;float:center;width:100%;margin-top:4px;}
			.footer a{text-decoration:none;color:#ccc;}
			 figcaption{background: #000; color: #fff;border-bottom-left-radius: 8px;   border-bottom-right-radius: 8px;font-size:11px;padding: 5px;}
			 .imageContainer1 img{border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;}
			 amp-sidebar{background: linear-gradient(to bottom, rgba(56,2,9,1) 0%, rgba(56,2,9,1) 2%, rgba(214,23,58,1) 29%, rgba(227,12,55,1) 34%, rgba(227,12,55,1) 37%, rgba(214,23,58,1) 43%, rgba(56,2,9,1) 82%, rgba(56,2,9,1) 100%); margin-top: 17%;}
			 .sticky{position:fixed;top:0;width:100%;background:#fff;z-index: 9999;-webkit-transition: width 2s;  -webkit-transition-timing-function: linear; transition: width 2s; transition-timing-function: linear;}
			 .articleImageContainer img{border-top-left-radius: 8px;border-top-right-radius: 8px;}
			 .article p{font-family: georgia, sans-serif;line-height: 1.5;font-size: 18px;}
			 figure.image{position:relative;}
			 .cx-logo amp-img{margin-top: -14px;margin-bottom: -8px;}
			 .menu-icon{background: #fff;border-radius: 21px;}
			 .review-stars{margin-bottom:10px;}
			 .review-stars i{margin : 0 3px 0;}
			 .review-stars i.star-success{color:#ffb72e;}
			 .review-stars i.star-failure{color:#ddd;}
			 .gallery-count{position: absolute;color: #fff;top: 6px;left: 5px;padding: 2px 8px 2px;font-size: 12px;}
			 .gallery-count b{font-size: 22px;}
		</style>
	</head>
	<body>
		<amp-analytics type="googleanalytics">
			<script type="application/json">
			{
				"vars": {
				"account": "UA-101011425-1"
				},
				"triggers": {
					"trackPageview": {
						"on": "visible",
						"request": "pageview"
					}
				}
			}
			</script>
		</amp-analytics>
		<amp-sidebar id="sidebar" layout="nodisplay"  side="left" >
			<div class="close-event">
			<amp-img class="amp-close-image"
			src="<?php print image_url; ?>images/FrontEnd/images/close_btn.png?v=2"	width="28"	height="29"		alt="close sidebar"	on="tap:sidebar.close"	role="button" tabindex="0"></amp-img>
			</div>
			<ul class="">
				<?php
					foreach($Section as $SectionDetails):
						if(strip_tags($SectionDetails->SectionnameInHTML)=='Sex & Health'){
							break;
						}
						if($SectionDetails->URLSectionStructure=="Home"){
							$SectionUrl=BASEURL;
						}else{
							$SectionUrl=BASEURL.$SectionDetails->URLSectionStructure;
						}
						print '<li><a href="'.$SectionUrl.'">'.strip_tags($SectionDetails->SectionnameInHTML).'</a></li>';
					endforeach;
				?>
			</ul>
		</amp-sidebar>
		<amp-image-lightbox class="ampimagecontainer" id="artilceImage" layout="nodisplay"></amp-image-lightbox>
		<div class="header" id="header">
		<a href="<?php print BASEURL; ?>" class="cx-logo"><amp-img alt="Cinemaexpress logo"	src="<?php print image_url; ?>images/FrontEnd/images/NIE-logo21.png"	width="119"	height="70">
		</amp-img><a/>
		<amp-img class="menu-icon" alt="NIE menu"
			on="tap:sidebar.toggle"
			src="<?php print image_url; ?>images/FrontEnd/images/hamburger_menu.png?gh=1" width="35"	height="33"	role="image"	tabindex="1"class="menu-icon">	</amp-img>
		</div>
		<article class="article">
			<h2 class="article_heading"><?php print strip_tags($Details['title']); ?></h2>
			<div class="socialicons">
				<amp-social-share type="email" width="37" height="37" class="social-icons"></amp-social-share>
				<amp-social-share type="facebook" data-param-app_id="272592156694146" width="37" height="37" class="social-icons"></amp-social-share>
				<amp-social-share type="gplus" width="37" height="37" class="social-icons"></amp-social-share>
				<amp-social-share type="twitter" width="37" height="37" class="social-icons"></amp-social-share>
			</div>
			<?php
			if($Details['author_name']!=''){
				print '<span class="author-details">By '.$Details['author_name'].'| </span>';
			}
			if($Details['agency_name']!=''){
				print '<span class="author-details">'.$Details['agency_name'].' |</span>';
			}
			?>
			<span class="author-details">Published: <?php print $published_date; ?></span>			
			<?php
			$i=1;
			$ads =['<amp-ad	layout="responsive"	width=300 height=250 type="adsense"	data-ad-client="ca-pub-4861350176551585" data-ad-slot="7682260557"></amp-ad>' ,'<amp-ad			layout="responsive"	width=300 height=250 type="adsense"	data-ad-client="ca-pub-4861350176551585" data-ad-slot="7682260557"></amp-ad>'];
			$advcount=0;
			$galleryfullcount = count($content_details);
			foreach($content_details as $gallery_image){
				$gallery_caption = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $gallery_image['gallery_image_title']);
				$gallery_alt =  $gallery_image['gallery_image_alt'];
				$Image600X390= str_replace(' ', "%20",$gallery_image['gallery_image_path']);
				$imagewidth = 600;
				$imageheight = 390;
				 if(getimagesize(image_url_no . imagelibrary_image_path . $Image600X390) && $Image600X390 != ''){
					  $imagedetails = getimagesize(image_url_no . imagelibrary_image_path.$Image600X390);
					  $imagewidth = $imagedetails[0];
                      $imageheight = $imagedetails[1];
					  $show_gallery_image = image_url. imagelibrary_image_path . $Image600X390;
				 }else{
					 $show_gallery_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
				 }
				 $clsname = ($gallery_caption=='') ? ' imageContainer1 ' : '';
				 echo '<figure class="articleImageContainer '.$clsname.'">';
				 echo '<amp-img  tabindex="0" src="'.$show_gallery_image.'" width='.$imagewidth.' height='.$imageheight.' layout="responsive"></amp-img>';
				 if($gallery_caption!=''){
					 echo '<figcaption>'.$gallery_caption.'</figcaption>';
				 }
				 echo '<span class="gallery-count"><b>'.$i.'</b><span> / '.$galleryfullcount.'</span></span>';
				 echo '</figure>';
				 if($i%2==0){
					 if(isset($ads[$advcount]) && $ads[$advcount]!=''){
						 echo '<figure class="articleImageContainer">'.$ads[$advcount].'</figure>';
					 }
					$advcount++;
				 }
				 $i++;
			}
			?>	
			
		</article>
		<?php
		if($Details['tags']!=''):
				$Tags=explode(',',$Details['tags']);
				print '<div class="tags">';
					print '<a class="tag_heading"> Tags : </a>';
				for($i=0;$i<count($Tags);$i++):
					if($Tags[$i]!=''):
						$tag_title = join( "_",( explode(" ", trim($Tags[$i]) ) ) );
						$tag_url_title = preg_replace('/[^A-Za-z0-9\_]/', '', $tag_title); 
						$TagUrl=BASEURL.'topic/'.$tag_url_title;
						print '<a class="tag_element" href="'.$TagUrl.'">'.$Tags[$i].'</a>';
					endif;
				endfor;
				print '</div>';
			endif;
			print '<div class="more_article">';
			if(count($MoreArticle) > 0){
				print '<h3>More from this section</h3>';
				foreach($MoreArticle as $MoreArticleDetails):
					if($MoreArticleDetails->first_image_path==""){
						$Image=image_url. imagelibrary_image_path.'logo/nie_logo_600X300.jpg';
					}else{
						$Image=image_url . imagelibrary_image_path.$MoreArticleDetails->first_image_path;
					}
					?>
						<div class="more_article_row">
						<amp-img on="tap:artilceImage" role="button" tabindex="0" src="<?php print $Image; ?>" width=121 height=77 ></amp-img>
						<span><a href="<?php print BASEURL.str_replace('.html','.amp',$MoreArticleDetails->url); ?>"><?php print strip_tags($MoreArticleDetails->title); ?></a></span>
						</div>
					<?php
				endforeach;
			}
			print '</div>';
			?>
			
			<div class="footer">
				<div class="footer_copyright">Copyrights Cinemaexpress.<?php print date('Y'); ?></div>
				
				<div class="footer_copyright"><a href="http://www.newindianexpress.com" target="_blank">The New Indian Express | </a><a href="http://www.dinamani.com" target="_blank">Dinamani | </a><a href="http://www.kannadaprabha.com" target="_blank">Kannada Prabha | </a><a href="http://www.samakalikamalayalam.com" target="_blank">Samakalika Malayalam | </a><a href="http://www.malayalamvaarika.com" target="_blank">Malayalam Vaarika  | </a><a href="http://www.indulgexpress.com" target="_blank">Indulgexpress  | </a><a href="http://www.cinemaexpress.com" target="_blank">Cinema Express  | </a><a href="http://www.eventxpress.com" target="_blank">Event Xpress </a></div>
				
				<div class="footer_copyright"><a href="<?php print BASEURL?>contact-us">Contact Us | </a><a href="<?php print BASEURL?>careers">About Us | </a><a href="<?php print BASEURL?>privacy-policy">Privacy Policy | </a><a href="<?php print BASEURL?>topic">Search |  </a><a href="<?php print BASEURL?>terms-of-use">Terms of Use | </a><a href="<?php print BASEURL?>advertise-with-us">Advertise With Us </a></div>
			</div>
	</body>
</html>
<?php endif; ?>

 