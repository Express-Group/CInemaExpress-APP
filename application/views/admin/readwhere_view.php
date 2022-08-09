<?php header ("Content-Type:text/xml");?>
<rss version="2.0" xml:base="<?php echo $baseUrl.$sectionDetails['URLSectionStructure']; ?>">
<channel>
<?php
$page_title = strip_tags(str_replace(['&', '&#39;'], ['&amp;', "'"] , $sectionDetails['MetaTitle']));
$page_title = preg_replace("|&([^;]+?)[\s<&]|","&amp;$1 ",$page_title);

$page_description = strip_tags(str_replace(['&', '&#39;'], ['&amp;', "'"] , $sectionDetails['MetaDescription']));
$page_description = preg_replace("|&([^;]+?)[\s<&]|","&amp;$1 ",$page_description);

?>
<title><?php echo $page_title; ?></title>
<link><?php echo $baseUrl.$sectionDetails['URLSectionStructure']; ?></link>
<description><?php echo $page_description; ?></description>
<language>en</language>
<?php
foreach($content as $articles){
$title = strip_tags(html_entity_decode($articles['title'],ENT_QUOTES,"UTF-8"));
/* $title = strip_tags(str_replace(['&', '&#39;'], ['&amp;', "'"] , $title));
$title = preg_replace("|&([^;]+?)[\s<&]|","&amp;$1 ",$title); */
$summary = strip_tags(html_entity_decode($articles['summary_html'],ENT_QUOTES,"UTF-8"));
//$summary = str_replace(['zwj;'],[''],preg_replace("|&([^;]+?)[\s<&]|","&amp;$1 ",$summary));
$thumbimage = image_url.imagelibrary_image_path.'logo/nie_logo_150X150.jpg';
$fullimage = image_url.imagelibrary_image_path.'logo/nie_logo_600X300.jpg';
$publishDate = new DateTime(@$articles['publish_start_date']);
//$updatedDate = date('Y-m-d H:i:s', strtotime('+19 minutes', strtotime(@$articles['last_updated_on'])));
$updatedDate = new DateTime(@$articles['last_updated_on']);
//$updatedDate = new DateTime(@$updatedDate);

$authorNname = strip_tags(str_replace(['&', '&#39;'], ['&amp;', "'"] , $articles['author_name']));
$tags = strip_tags(str_replace(['&', '&#39;'], ['&amp;', "'"] , $articles['tags']));
if($contentType==1){
	//$content = str_replace(['&', '#39;','&amp;','&nbsp;','nbsp;','<br>','</br>','<br />'], ['&amp;', "'",' ',' ',' ','','',''] , $articles['article_page_content_html']);
	$content = html_entity_decode($articles['article_page_content_html'],ENT_QUOTES,"UTF-8");
	if($articles['article_page_image_path']!=''){
		$thumbimage = image_url.imagelibrary_image_path.str_replace('original/','w150X150/',$articles['article_page_image_path']);
		$fullimage = image_url.imagelibrary_image_path.$articles['article_page_image_path'];
	}
}else if($contentType==3){
	$content = html_entity_decode($articles['summary_html'],ENT_QUOTES,"UTF-8");
	if($articles['first_image_path']!=''){
		$thumbimage = image_url.imagelibrary_image_path.str_replace('original/','w150X150/',$articles['first_image_path']);
		$fullimage = image_url.imagelibrary_image_path.$articles['first_image_path'];
	}
}else if($contentType==4){
	$content = html_entity_decode($articles['video_script'],ENT_QUOTES,"UTF-8");
	if($articles['video_image_path']!=''){
		$thumbimage = image_url.imagelibrary_image_path.str_replace('original/','w150X150/',$articles['video_image_path']);
		$fullimage = image_url.imagelibrary_image_path.$articles['video_image_path'];
	}
}

?>
<item>
<Articleid><?php echo $articles['content_id']; ?></Articleid>
<title><![CDATA[<?php echo $title; ?>]]></title>
<excerpt><![CDATA[<?php echo $summary; ?>]]></excerpt>
<description><![CDATA[<?php echo $content; ?>]]></description>
<thumbimage><?php echo $thumbimage; ?></thumbimage>
<?php if($contentType!=3): ?>
<fullimage><?php echo $fullimage; ?></fullimage>
<?php endif; ?>
<?php 
if($contentType==3): 
$galleryImages = $this->widget_model->widget_article_content_by_id($articles['content_id'], $contentType, "");
foreach($galleryImages as $images):
//$galleryCaption = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $images['gallery_image_title']);
$galleryCaption = html_entity_decode($images['gallery_image_title'],ENT_QUOTES,"UTF-8");
//$galleryCaption = strip_tags(str_replace(['&', '&#39;'], ['&amp;', "'"] , $galleryCaption));
$galleryImage= str_replace(' ', "%20",$images['gallery_image_path']);
?>
<gallery>
<gallery_url><?php echo image_url.imagelibrary_image_path.$galleryImage; ?></gallery_url>
<gallery_caption><![CDATA[<?php echo $galleryCaption; ?>]]></gallery_caption>
</gallery>
<?php endforeach; endif; ?>
<?php if($contentType==4): ?>
<video_url></video_url>
<?php endif; ?>
<pubDate><?php echo $publishDate->format('D, d M Y H:i:s +0530') ?></pubDate>
<authorname><?php echo $authorNname; ?></authorname>
<link><?php echo $baseUrl.html_entity_decode($articles['url'],null,"UTF-8"); ?></link>
<tags><?php echo $tags; ?></tags>
<updatedDate><?php echo $updatedDate->format('D, d M Y H:i:s +0530') ?></updatedDate>
<?php if($contentType!=3 && $contentType!=4 && ($articles['section_id']==4 || $articles['parent_section_id']==4)):
$movieDetails = $this->live_db->query("SELECT movie_name , movie_director , movie_cast FROM review_master WHERE content_id='".$articles['content_id']."'")->row_array();
 ?>
<review>
<itemtype>CreativeWork</itemtype>
<reviewauthor><?php echo $authorNname; ?></reviewauthor>
<reviewdate><?php echo $publishDate->format('Y-m-d') ?></reviewdate>
<reviewname></reviewname>
<reviewbody></reviewbody>
<worstRating>5</worstRating>
<bestRating>5</bestRating>
<ratingValue><?php echo $articles['review']; ?></ratingValue>
</review>
<?php if(count($movieDetails) >0):
$actorDetails = json_decode($movieDetails['movie_cast']);
if(count($actorDetails) > 0){
	$castDetails= implode(',' ,$actorDetails);
}else{
	$castDetails='';
}
 ?>
<movie>
<moviename><![CDATA[<?php echo trim(html_entity_decode($movieDetails['movie_name'],ENT_QUOTES,"UTF-8")); ?>]]></moviename>
<genre></genre>
<director><![CDATA[<?php echo html_entity_decode($movieDetails['movie_director'],ENT_QUOTES,"UTF-8"); ?>]]></director>
<actor><![CDATA[<?php echo html_entity_decode($castDetails,ENT_QUOTES,"UTF-8"); ?>]]></actor>
<description></description>
</movie>
<?php else: ?>
<movie>
<moviename><![CDATA[]]></moviename>
<genre></genre>
<director><![CDATA[]]></director>
<actor><![CDATA[]]></actor>
<description></description>
</movie>
<?php endif; ?>
<?php endif; ?>
</item>		
<?php } ?>
</channel>
</rss>