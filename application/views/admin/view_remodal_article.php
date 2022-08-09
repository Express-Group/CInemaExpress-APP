<?php
$css_path 		= image_url."css/FrontEnd/";
$js_path 		= image_url."js/FrontEnd/";
$images_path	= image_url."images/FrontEnd/";
///if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
$content_id      = @$content_id;
$content_from    = $content_from;
$content_type_id = @$content_type;
$viewmode        = $viewmode;
$settings = $this->widget_model->select_setting($viewmode);
//$page_det = $this->widget_model->widget_article_content_by_id($content_id, $content_type_id);
$page_det        = $article_details;
$page_det        = $page_det[0];
$Image600X390    = "";
$Image600X390 	 = ($content_type_id==1)? $page_det['article_page_image_path']: (($content_type_id==3)? $page_det['first_image_path']: (($content_type_id==4)? $page_det['video_image_path']: $page_det['audio_image_path']));
if ($Image600X390 != '' && getimagesize(image_url_no . imagelibrary_image_path . $Image600X390))
	{
	$imagedetails = getimagesize(image_url_no . imagelibrary_image_path.$Image600X390);
	$imagewidth   = $imagedetails[0];
	$imageheight  = $imagedetails[1];
	
	if ($imageheight > $imagewidth)
	{
		$Image600X390 	= $Image600X390;
	}
	/* else
	{				
		$Image600X390 	= str_replace("original","w600X390", $Image600X390);
	} */
	$image_path = '';
	$image_path = image_url. imagelibrary_image_path . $Image600X390;
	}
else
{
	$image_path	   = image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
	$image_caption = '';	
}
$content      = strip_tags($page_det['summary_html']);
$current_url  = explode('?', Current_url());
$share_url    = base_url().$page_det['url'];
$index        = ($page_det['no_indexed']==1)? 'NOINDEX' : 'INDEX';
$follow       = ($page_det['no_follow'] == 1) ? 'NOFOLLOW' : 'FOLLOW';
$Canonicalurl = $share_url;//($page_det['canonical_url']!='') ? $page_det['canonical_url'] : '';
$AMP=0;

$ampUrl = $mobileArticleUrl='';
/* $uri = urldecode($this->uri->segment($this->uri->total_segments()));
$uriPos = strrpos($uri, "-");
$uri = substr($uri , 0 , $uriPos);
$ampUrl = MOBILEURL.'article/'.$uri.'/'.$content_id.'/amp';
if($content_type_id==3):
	$mobileArticleUrl = MOBILEURL.'article/'.$uri.'/'.$content_id;
else:
	$mobileArticleUrl = MOBILEURL.'article/'.$this->uri->segment(1).'/'.$uri.'/'.$content_id;
endif; */
$ampUrl = MOBILEURL. str_replace('.html' , '.amp' , $page_det['url']);
$meta_title   = stripslashes(str_replace('\\', '', $page_det['meta_Title']));//($page_det['meta_Title']);
$meta_description = stripslashes($page_det['meta_description']);
if($meta_description==''):
	$meta_description = stripslashes(strip_tags($page_det['summary_html']));
endif;
$tags         = count($page_det['tags'])? $page_det['tags'] : '';
$seo_tags	= ($seotags !='')? $seotags :$tags;
$query_string = ($_SERVER['QUERY_STRING']!='') ? "?".$_SERVER['QUERY_STRING'] : "";
$pubDate = date_format(date_create($page_det['publish_start_date']),"Y-m-d\TH:i:s\+05:30");
$LastUpDate = date_format(date_create($page_det['last_updated_on']),"Y-m-d\TH:i:s\+05:30");
?>
<?php
    //$ExpireTime = ($content_from=="live") ? 120 : 86400; // seconds (= 2 mins)
    $ExpireTime = ($content_from=="live") ? 240 : 86400; // seconds (= 4 mins)
	//$this->output->set_header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	$this->output->set_header("Cache-Control: cache, must-revalidate");
	$this->output->set_header("Cache-Control: max-age=".$ExpireTime);
	$this->output->set_header("Pragma: cache");
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<noscript>
	<div class="no-script-ce">Enable Javscript for better performance</div>
 </noscript>
<link rel="alternate" href="<?php echo Current_url().$query_string;?>" hreflang="en"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="title" content="<?php echo strip_tags($meta_title);?>" />
<meta name="description" content="<?php echo $meta_description;?>">
<meta name="keywords" content="<?php echo $tags;?>">
<meta name="news_keywords" content="<?php echo $seo_tags;?>">
<meta name="msvalidate.01" content="E3846DEF0DE4D18E294A6521B2CEBBD2" />
<link rel="canonical" href="<?php echo $share_url; ?>" />
<?php if($ampUrl!=''):?>
<link rel="amphtml" href="<?php echo $ampUrl;?>" />
<?php endif; ?>
<meta name="robots" content="<?php echo $index;?>, <?php echo $follow;?>">
<meta property="og:url" content="<?php echo $share_url;?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo strip_tags($page_det['title']);?>"/>
<meta property="og:image" content="<?php echo $image_path;?>"/>
<meta property="og:image:width" content="450"/>
<meta property="og:image:height" content="298"/>
<meta property="og:site_name" content="The New Indian Express"/>
<meta property="og:description" content="<?php echo $content;?>"/>
<meta name="twitter:creator" content="CinemaExpress" />
<meta name="twitter:site" content="@cinemaexpress.com" />
<meta name="twitter:title" content="<?php echo strip_tags($page_det['title']);?>" />
<meta name="twitter:description" content="<?php echo $content;?>" />
<meta name="twitter:image" content="<?php echo $image_path;?>" />
<meta name="twitter:card" content="summary_large_image" /> 
<!--<meta name="twitter:card" content="<?php echo str_replace('w600X390' , 'original' , $image_path);?>" />-->
<title><?php echo strip_tags($meta_title);?>- Cinema express</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ if (window.scrollY == 0) window.scrollTo(0,1); }; </script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Noticia+Text:wght@400;700&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="<?php echo $images_path; ?>images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo $css_path; ?>css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo $css_path; ?>css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo $css_path; ?>css/bundle.css?v=3.2" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo $js_path; ?>js/slider-custom-lazy.min.js?v=1.5" type="text/javascript"></script>
<script type="text/javascript">
<?php 
	  $section_id              = $page_det['section_id'];
	  $parent_section_id       = $page_det['parent_section_id'];
	  $grand_parent_section_id = $page_det['grant_section_id'];
	  $mode = $viewmode; ?>
	  var Section_id = '<?php echo $section_id;?>';
	  var PSection_id = '<?php echo $parent_section_id;?>';
	  var GPSection_id = '<?php echo $grand_parent_section_id;?>';
	  var view_mode = '<?php echo $mode;?>';
	  <?php if(isset($html_header)&& $html_header==true){ ?>
	   var call_active_menu = 1;
	   <?php }else{ ?>
	   var call_active_menu = 0;
	   <?php }  
	   if(isset($html_rightpanel)&& $html_rightpanel==true){ ?>
	    var call_otherstories = 1;
	  <?php }else{ ?>
	    var call_otherstories = 0;
	<?php  }?>
$(document).ready(function () {
<!--replace slick preview as arrow-->
$('.slick-prev').addClass('fa fa-chevron-left');
$('.slick-next').addClass('fa fa-chevron-right');	
});
</script>
<?php
$schematitle = strip_tags($page_det['title']);
$schematitle = (count($schematitle) >= 110) ? $schematitle : substr($schematitle , 0 , 107).'...';
if($content_from!='live'){
	$articleDescription = str_replace(['"' , "'"] ,['\u0022' ,'\u0027'],stripslashes($page_det['summary_html']));
	$articleDescription = stripslashes(html_entity_decode($articleDescription));	
}else{
	$articleDescription = stripslashes(html_entity_decode($page_det['summary_html']));	
}
$articleDescription = strip_tags($articleDescription);
$schemadata["@context"] = "http://schema.org";
$schemadata["@type"] = "NewsArticle";
$schemadata["mainEntityOfPage"] = [
	"@type" => "WebPage",
	"@id" => $content_id
];
$schemadata["headline"] = $schematitle;
$schemadata["image"] = [];
$schemadata["image"]["@type"] = "ImageObject";
$schemadata["image"]["url"] = $image_path.'?w=1200&h=800&dpr=1.3';
$schemadata["image"]["width"] = 1200;
$schemadata["image"]["height"] = 800;
$schemadata["datePublished"] = $pubDate;
$schemadata["dateModified"] = $LastUpDate;
$schemadata["inLanguage"] = "en";
$schemadata["keywords"] = strip_tags($page_det['tags']);
$schemadata["author"] = [
	"@type" => "Person",
	"name" => $page_det['author_name']
];
$schemadata["publisher"] = [
	"@type" => "Organization",
	"name" => "CinemaExpress",
	"logo" => [
		"@type" => "ImageObject",
		"url" => image_url."images/FrontEnd/images/NIE-logo21.png",
	]
];
$schemadata["description"] = $articleDescription;
$schemadata = json_encode(utf8ize($schemadata));
$schemadata = str_replace(["\\n" ,'\"' ,'/"',"\\t"], ["" ,"\u0022","\u0022",""], $schemadata);
?>
<script type="application/ld+json">
<?php echo $schemadata; ?>
</script>
<?php 
if(($section_id== 4|| $parent_section_id==4) && $content_type_id==1):
if($content_from!='live'){
	$articleBody = str_replace(['"' , "'"] ,['\u0022' ,'\u0027'],$page_det['article_page_content_html']);
	$articleBody = stripslashes(html_entity_decode($articleBody));	
}else{
	$articleBody = stripslashes(html_entity_decode($page_det['article_page_content_html']));	
}
$articleBody = strip_tags($articleBody);
$ratingschema = [];
$ratingschema["@context"] = "https://schema.org";
$ratingschema["@type"] = "Review";
$ratingschema["datePublished"] = $pubDate;
$ratingschema["description"] = $articleDescription;
$ratingschema["url"] = $share_url;
$ratingschema["reviewBody"] = $articleBody;
$ratingschema["author"] = [
	"@type" => "Person",
	"name" => $page_det['author_name'],
	"sameAs" => "https://www.cinemaexpress.com"
];
$ratingschema["inLanguage"] = "en";
$ratingschema["itemReviewed"] = [
	"@type" => "Movie",
	"name" => @$reviewdetails[0],
	"datePublished" => $pubDate,
	"image" => $image_path,
	"sameAs" => "https://www.cinemaexpress.com",
	"director" => [
		"@type" => "Person",
		"name" => @$reviewdetails[1]
	]
];
if(count($reviewdetails[3]) > 0){
	$ratingschema["itemReviewed"]["actor"]=[];
	for($t=0;$t<count($reviewdetails[3]);$t++){
		$ratingschema["itemReviewed"]["actor"][]=[
			"type" => "Person",
			"name" => $reviewdetails[3][$t]
		];
	}
}
$ratingschema["publisher"] =[
	"@type" => "Organization",
	"name" => "CinemaExpress",
	"sameAs" => "https://www.cinemaexpress.com"
];
$ratingschema["reviewRating"] =[
	"@type" => "Rating",
	"bestRating" => "5",
	"worstRating" => "1",
	"ratingValue" => $reviewdetails[2]
];
$ratingschema = json_encode(utf8ize($ratingschema));
$ratingschema = str_replace(["\\n" ,'\"' ,'/"',"\\t"], ["" ,"\u0022","\u0022",""], $ratingschema);
?>
<script type="application/ld+json">
<?php echo $ratingschema; ?>
</script>
<?php endif; ?>

<!-- Start Advertisement Script -->
<?php echo urldecode($header_ad_script); ?>
<?php echo rawurldecode(stripslashes($settings['article_header_script'])); ?> 
<!-- End Advertisement Script -->
<!-- <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
	<script>
	  var OneSignal = window.OneSignal || [];
	  OneSignal.push(function() {
		OneSignal.init({
		  appId: "<?php echo ONE_SIGNAL_APP_ID; ?>",
		});
	  });
	</script> -->

<!-- Begin comScore Tag -->
<script>
  var _comscore = _comscore || [];
  _comscore.push({ c1: "2", c2: "16833363" });
  (function() {
    var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
    s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
    el.parentNode.insertBefore(s, el);
  })();
</script>
<noscript>
  <img src="https://sb.scorecardresearch.com/p?c1=2&c2=16833363&cv=2.0&cj=1" />
</noscript>
<!-- End comScore Tag -->
<script type="text/javascript">
	window.GUMLET_CONFIG = {
		hosts: [{
			current: "images.cinemaexpress.com",
			gumlet: "images.cinemaexpress.com"
		}],
		lazy_load: true
	};
	(function(){d=document;s=d.createElement("script");s.src="https://cdn.gumlet.com/gumlet.js/2.0/gumlet.min.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();
</script>
</head>
<?php
$content_url = $page_det['url'];

$url_array = explode('/', $content_url);
$get_seperation_count = count($url_array)-4;

$sectionURL = ($get_seperation_count==1)? $url_array[0] : (($get_seperation_count==2)? $url_array[0]."/".$url_array[1] : $url_array[0]."/".$url_array[1]."/".$url_array[2]);
$section_url = base_url().$sectionURL."/";
/*if($content_from=="live"){
$section_url =  $section_url; 
}*/
?>
<body class="article_body" itemscope itemtype="<?php echo $section_url;?>">
<?php 
	if($viewmode == "live")
	{
	?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-101011425-1', 'auto');
  ga('send', 'pageview');
  setTimeout("ga('send','event','adjusted bounce rate','page visit 30 seconds or more')",30000);

</script>
<?php	
	}
?>
<?php echo  $header.$body .$footer; ?>
<?php 
if(isset($_GET['pm'])!=0 && is_numeric($_GET['pm'])){
$section_details = $this->widget_model->get_sectionDetails($_GET['pm'], $viewmode); //live db
$close_url       = (count($section_details)>0)? base_url().$section_details['URLSectionStructure']: "home";
}else{
$close_url ="home";
}

?>
<!--<script src="<?php echo $js_path; ?>js/remodal_custom.min.js" type="text/javascript"></script>
--> 
<script src="<?php echo $js_path; ?>js/jquery.csbuttons.js" type="text/javascript"></script> 
<script src="<?php echo $js_path; ?>js/remodal.js" type="text/javascript"></script>
<?php if($content_type_id==1){ ?>
<script src="<?php echo $js_path; ?>js/article-pagination.js" type="text/javascript"></script>
<?php } ?>
<?php if($content_type_id==1 || $content_type_id==3){ ?>
<script src="<?php echo $js_path; ?>js/jquery.twbsPagination.min.js" type="text/javascript"></script>
<?php } ?>
<script>
var close_url = "<?php echo $close_url;?>";
$( document ).ready(function() {
<?php if($this->uri->segment(1)!='adcheck' && $this->uri->segment(1)!='test'): ?>
var inst = $('[data-remodal-id=article]').remodal();
inst.open();

$(document).on('opened', '.remodal', function () {
  console.log('Modal is opened');
   $('.SectionContainer').append('<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>');
 $('.CenterMarginBg').hide();
  $('#load_spinner').hide();
  $('.side-bar-overlay').show();
   $('.menu').affix({
	offset: {
	top: $('header').height()
	}
	});	
	$('.remodal-close').affix({
	offset: {
	top: $('header').height()
	}
	});
});

   $(document).on('closed', '.remodal', function () {	
	 window.location.href = (localStorage.getItem("callback_section")!="null")? localStorage.getItem("callback_section"): window.location.origin;
   });

$('.remodal-main-overlay:not(.container)').click(function(){
inst.close();
});
  $('.LeftArrow').click(function(){
  //inst.close();
  $('#load_spinner').show();
 });
  $('.RightArrow').click(function(){
  //inst.close();
  $('#load_spinner').show();
 });
 <?php endif; ?>
});
</script>
<?php
$countryCode = ['US','EU'];
if(in_array(@$_SERVER['HTTP_CLOUDFRONT_VIEWER_COUNTRY'] , $countryCode)):
?>
<!--<script type="text/javascript">
    (function (){ var s,m,n,h,v,se,lk,lk1,bk; n=false; s= decodeURIComponent(document.cookie); m = s.split(';'); for(h=0;h<m.length;h++){ if(m[h]==' cookieagree=1'){n=true;break;}}if(n==false){v = document.createElement('div');v.setAttribute('style','position: fixed;left: 0px;right: 0px;height: auto;min-height: 15px;z-index: 2147483647;background: linear-gradient(to bottom, rgb(178, 8, 30) 0%, rgb(172, 21, 41) 2%, rgba(214,23,58,1) 29%, rgba(227,12,55,1) 34%, rgba(227,12,55,1) 37%, rgba(214,23,58,1) 43%, rgb(180, 11, 33) 82%, rgb(147, 9, 27) 100%);line-height: 15px;padding: 8px 18px;font-size: 14px;text-align: left;bottom: 0px;opacity: 1;color: #fff;');v.setAttribute('id','ckgre');se = document.createElement('span');se.setAttribute('style','padding: 5px 0 5px 0;float:left;');lk =document.createElement('button');lk.setAttribute('onclick','ckagree()');lk.setAttribute('style' , 'float: right;display: block;padding: 5px 8px;min-width: 100px;margin-left: 5px;border-radius: 25px;cursor: pointer;color: #000;background: rgb(241, 214, 0);text-align: center;border: none;font-weight: bold;outline: none;');lk.appendChild(document.createTextNode("Agree"));	se.appendChild(document.createTextNode("We use cookies to enhance your experience. By continuing to visit our site you agree to our use of cookies."));lk1 = document.createElement('a');lk1.href=document.location.protocol+"//"+document.location.hostname+"/cookies-info";lk1.setAttribute('style','text-decoration: none;color: rgb(241, 214, 0);margin-left: 5px;');lk1.setAttribute('target','_BLANK');lk1.appendChild(document.createTextNode("More info"));se.appendChild(lk1);v.appendChild(se);v.appendChild(lk);bk = document.getElementsByTagName('body')[0];bk.insertBefore(v,bk.childNodes[0]);}})();function ckagree(){ document.cookie = "cookieagree=1;path=/";$('#ckgre').hide(1000, function(){ $(this).remove();});}
</script>-->
<?php
endif;
?>
</body>
</html>
