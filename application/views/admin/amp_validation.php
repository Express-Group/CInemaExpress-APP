<!doctype html>
<html amp>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
		<title><?php print strip_tags($content['meta_Title']); ?> - The New Indian Express</title>
		<script async src="https://cdn.ampproject.org/v0.js"></script>
		<script async custom-element="amp-image-lightbox" src="https://cdn.ampproject.org/v0/amp-image-lightbox-0.1.js"></script>
		<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
		<script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
		<script async custom-element="amp-twitter" src="https://cdn.ampproject.org/v0/amp-twitter-0.1.js"></script>
		<script async custom-element="amp-instagram" src="https://cdn.ampproject.org/v0/amp-instagram-0.1.js"></script>
		<link rel="canonical" href="<?php print base_url($content['url']); ?>">
		<link rel="shortcut icon" href="<?php print image_url; ?>images/FrontEnd/images/favicon.ico" type="image/x-icon" />
		<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
		<style amp-custom>
			@font-face{ font-family:fjord; src:url("<?php print image_url ?>css/FrontEnd/fonts/FjordOne-Regular.ttf"); }
			@font-face{ font-family:georgia; src:url("<?php print image_url ?>css/FrontEnd/fonts/georgia.ttf"); }
			 body { font-family: fjord, sans-serif; }
			.header{padding:2px;text-align:center;display: table;width:100%;background: linear-gradient(to bottom, rgba(56,2,9,1) 0%, rgba(56,2,9,1) 2%, rgba(214,23,58,1) 29%, rgba(227,12,55,1) 34%, rgba(227,12,55,1) 37%, rgba(214,23,58,1) 43%, rgba(56,2,9,1) 82%, rgba(56,2,9,1) 100%);}
			.cx-logo{display: inline-table;float: left;padding: 7px 11px 0px;}
			.article{padding:10px;/* background: rgba(236, 235, 235, 0.41); */}
			.articleImageContainer{position:relative; margin: 0 0 13px;}
			amp-image-lightbox.ampimagecontainer{background:white;}
			figcaption{font-size:11px;padding: 5px;background: rgba(158, 158, 158, 0.31);}
			.article_heading{margin-top: 10px;margin-bottom: 13px;color: #000;font-size: 20px;line-height: 1.5;}
			.social-icons{margin-bottom:9px;}
			.author-details{margin: 0;font-size: 12px;margin-bottom: 5px;color: #FF5722;}
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
			 figcaption{background: rgba(2, 0, 0, 0.38); color: #fff;position: absolute;bottom: 0;width: 97%;border-bottom-left-radius: 8px;   border-bottom-right-radius: 8px;}
			 amp-sidebar{background: linear-gradient(to bottom, rgba(56,2,9,1) 0%, rgba(56,2,9,1) 2%, rgba(214,23,58,1) 29%, rgba(227,12,55,1) 34%, rgba(227,12,55,1) 37%, rgba(214,23,58,1) 43%, rgba(56,2,9,1) 82%, rgba(56,2,9,1) 100%); margin-top: 17%;}
			 .sticky{position:fixed;top:0;width:100%;background:#fff;z-index: 9999;-webkit-transition: width 2s;  -webkit-transition-timing-function: linear; transition: width 2s; transition-timing-function: linear;}
			 .articleImageContainer img{border-radius: 8px;}
			 .article p{font-family: georgia, sans-serif;line-height: 1.5;font-size: 18px;}
			 figure.image{position:relative;}
			 .cx-logo amp-img{margin-top: -14px;margin-bottom: -8px;}
			 .menu-icon{background: #fff;border-radius: 21px;}
			 .review-stars{margin-bottom:10px;}
			 .review-stars i{margin : 0 3px 0;}
			 .review-stars i.star-success{color:#ffb72e;}
			 .review-stars i.star-failure{color:#ddd;}
		</style>
	</head>
	<body>
		<div class="header">
			<a href="<?php print BASEURL; ?>"><amp-img alt="CX logo"
				src="<?php print image_url; ?>images/FrontEnd/images/NIE-logo21.png"
				width="200"
				height="30">
			</amp-img></a>
		</div>
		<article class="article">
			<h2 class="article_heading"><?php print strip_tags($content['title']); ?></h2>
			<?php
				if($content['author_name']!=''){
					print '<span class="author-details">By '.$content['author_name'].'| </span>';
				}
				if($content['agency_name']!=''){
					print '<span class="author-details">'.$content['agency_name'].' |</span>';
				}
				$published_date = date('dS  F Y h:i A' , strtotime($content['publish_start_date']));
				if ($content['article_page_image_path'] != '' && getimagesize(image_url_no . imagelibrary_image_path . $content['article_page_image_path'])){
					$imagedetails = getimagesize(image_url_no . imagelibrary_image_path.$content['article_page_image_path']);
					$imagewidth   = $imagedetails[0];
					$imageheight  = $imagedetails[1];
					if ($imageheight > $imagewidth){
						$Image 	= $content['article_page_image_path'];
					}else{				
						$Image 	= str_replace("original","w600X390", $content['article_page_image_path']);
					}
					$image_path = '';
					$image_path = image_url. imagelibrary_image_path . $Image;
				}else{
					$image_path	   = image_url. imagelibrary_image_path.'logo/nie_logo_600X390.jpg';
					$imagewidth   = 600;
					$imageheight  = 390;
					$image_caption = '';	
				}
				$article= preg_replace('#(<[a-z ]*)(style=("|\')(.*?)("|\'))([a-z ]*>)#', '\\1\\6', $content['article_page_content_html']);
				$article=str_replace(['<img','</img>'],['<amp-img width="320" height="200" layout="responsive"','</amp-img'],$article);
				$article = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $article);
				$article = preg_replace('/style=\\"[^\\"]*\\"/', '', $article);
				$Content = preg_replace('/data-src=\\"[^\\"]*\\"/', '', $Content);
				$article = preg_replace('/(<[^>]+) onclick=".*?"/i', '$1', $article);
				$article = preg_replace('/<g[^>]*>/i', '', $article);
				$article = str_replace(['<pm.n>','<itc.ns>','</pm.n>','</itc.ns>'],'',$article);
				$article = str_replace(['<p sourcefrom="ptitool">' , '<p sourcefrom=ptitool>'],'<p>',$article); 
				$article = str_replace(['<iframe allowtransparency="true"','</iframe>'] ,['<amp-iframe layout="responsive" sandbox="allow-scripts allow-same-origin allow-popups"','</amp-iframe>'],$article);
				$article = str_replace('<iframe' ,'<amp-iframe layout="responsive" sandbox="allow-scripts allow-same-origin allow-popups"',$article);
				$article = str_replace('width="100%"' , 'width="320px"' ,$article);
				$article = str_replace(['<script async="" src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>' ,'<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>','<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>' , '<script async="" src="//platform.instagram.com/en_US/embeds.js"></script>' ,'<script async src="//www.instagram.com/embed.js">'] ,['','','','',''],$article);
								
				$html = new domDocument;
				$html->loadHTML($article);
				$html->preserveWhiteSpace = false; 
				$twitter = $html->getElementsByTagName('blockquote');
				foreach ($twitter as $twitterTweet){
					$className = $twitterTweet->getAttribute('class');
					if($className=='twitter-tweet'){
						$aTag = $twitterTweet->getElementsByTagName('a');
						foreach($aTag as $TagId){
							$tweetId = $TagId->getAttribute('href');
							if($tweetId!=''){
								$ID = explode('?',substr($tweetId , strripos($tweetId ,'/') + 1 , strlen($tweetId)));
								$ID = $ID[0];
								if(is_numeric($ID)){
									$elementhtml = $html->saveHTML($twitterTweet);
									$titleNode = $html->createElement("amp-twitter");
									$titleNode->setAttribute('width','356');
									$titleNode->setAttribute('height','415');
									$titleNode->setAttribute('data-tweetid',$ID);
									$twitterTweet->nodeValue = '';
									$twitterTweet->appendChild($titleNode);
								}
								
							}
							
						}
					}else if($className=='instagram-media'){
						$instaId = explode('/' , str_replace('https://www.instagram.com/p/','',$twitterTweet->getAttribute('data-instgrm-permalink')));
						$instaId = $instaId[0];
						$titleNode = $html->createElement("amp-instagram");
						$titleNode->setAttribute('width','400');
						$titleNode->setAttribute('height','400');
						$titleNode->setAttribute('layout','responsive');
						$titleNode->setAttribute('data-shortcode',$instaId);
						$twitterTweet->nodeValue = '';
						$twitterTweet->appendChild($titleNode);
					}
				}
				$flourish = $html->getElementsByTagName('div');
				foreach ($flourish as $flourishElement){
					$className = $flourishElement->getAttribute('class');
					if($className=='flourish-embed flourish-chart' ||$className =='flourish-embed'){
						$flourishElement->setAttribute('class','none');
						$flourishElement->nodeValue = '';
					}
				} 
				$flourish = $html->getElementsByTagName('p');
				foreach ($flourish as $flourishElement){
					$className = $flourishElement->getAttribute('class');
					if($className=='flourish-embed flourish-chart'){
						$flourishElement->setAttribute('class','none');
						$flourishElement->nodeValue = '';
					}
				}
				$article = $html->saveHTML();
				$article = str_replace(['<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">' ,'<html><body>' , '</body></html>'] ,['','',''] , $article);
			?>
			<span class="author-details">Published: <?php print $published_date; ?></span>
			<figure class="articleImageContainer">
				<amp-img on="tap:artilceImage" role="button" tabindex="0" src="<?php print $image_path; ?>" width=320 height=200 layout="responsive"></amp-img>
				<figcaption><?php print $content['article_page_image_title']; ?></figcaption>
			</figure>			
			<amp-image-lightbox class="ampimagecontainer" id="artilceImage" layout="nodisplay"></amp-image-lightbox>
			<?php echo $article; ?>
		</article>
	</body>
</html> 