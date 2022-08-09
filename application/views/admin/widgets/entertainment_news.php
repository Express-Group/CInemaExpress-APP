<?php
/*
Finame 		: 	entertainment_news
Created On 	: 	15-10-2015
Purpose for	:	Display the Sunday Standard Region 3 
*/
// widget config block Starts - This code block assign widget background colour, title and instance id. Do not delete it 
$widget_bg_color 		=	$content['widget_bg_color'];
$widget_custom_title 	=	$content['widget_title'];
$widget_instance_id 	=	$content['widget_values']['data-widgetinstanceid'];
$widgetsectionid 		= 	$content['sectionID'];
$main_sction_id 		= 	"";
$widget_section_url     = $content['widget_section_url'];
$is_home                = $content['is_home_page'];
$is_summary_required    = $content['widget_values']['cdata-showSummary'];
$widget_section_url     = $content['widget_section_url'];
$view_mode              = $content['mode'];
$max_article            = $content['show_max_article'];
$render_mode            = $content['RenderingMode'];
$GetRating=$this->widget_model->getReviews($get_content['content_id']);
// widget config block ends
// Here the Design Start 
if($widget_custom_title=='')
{
	$widget_custom_title="News";
}
$domain_name 		    =  base_url();
$show_simple_tab 	    = 	"";
$show_simple_tab 	   .=	' <div class="row">'; // Row Started 
$show_simple_tab 	   .=	'<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
$show_simple_tab 	   .=	'<div class="EnterNews">';
// Start Field set Section 
$show_simple_tab 	  .=	'<fieldset class="FieldTopic">';

if($content['widget_title_link'] == 1)
{
//$show_simple_tab.=	' <legend class="topic"><a href="'.$widget_section_url.'" >'.$widget_custom_title.'</a></legend>';
}
else
{
//$show_simple_tab.=	' <legend class="topic">'.$widget_custom_title.'</legend>';
}

$show_simple_tab.= ' </fieldset>';
// End for Field Section 
$content_type = $content['content_type_id'];  // auto article content type
$widget_contents = array();
    //getting content block - getting content list based on rendering mode
	//getting content block starts here . Do not change anything
if($render_mode == "manual")	{
	$widget_instance_contents 	= $this->widget_model->get_widgetInstancearticles_rendering($widget_instance_id , " " ,$content['mode'], $max_article); 
	$GetRating=$this->widget_model->getReviews($get_content['content_id']);
	$get_content_ids = array_column($widget_instance_contents, 'content_id'); 
	$get_content_ids = implode("," ,$get_content_ids); 

	if($get_content_ids!='')
	{
		$widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
		foreach ($widget_instance_contents as $key => $value) {
			foreach ($widget_instance_contents1 as $key1 => $value1) {
				if($value['content_id']==$value1['content_id']){
					$widget_contents[] = array_merge($value, $value1);
				}
			}
		}
	}	
	
} else {
	//$widget_instance_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode']);
	$widget_contents = $this->widget_model->get_all_available_articles_auto($max_article, $content['sectionID'] , $content_type ,  $content['mode'], $is_home);
}
	//getting content block ends here
	//Widget code block - code required for simple tab structure creation. Do not delete
	//Widget code block Starts here
	// content list iteration block - Looping through content list and adding it the list
	// content list iteration block starts here

	/*
	if (function_exists('array_column')) 
				{
			$get_content_ids = array_column($widget_instance_contents, 'content_id');  
				}else
				{
			$get_content_ids = array_map( function($element) { return $element['content_id']; }, $widget_instance_contents);
				}
		    $get_content_ids = implode("," ,$get_content_ids);

if($get_content_ids!='')
	{
		   $widget_instance_contents1 = $this->widget_model->get_contentdetails_from_database($get_content_ids, $content_type, $is_home, $view_mode);	
		   $widget_contents = array();
			foreach ($widget_instance_contents as $key => $value) 
			{
				foreach ($widget_instance_contents1 as $key1 => $value1) 
				{
					if($value['content_id']==$value1['content_id'])
					{
					   $widget_contents[] = array_merge($value, $value1);
					}
				}
			} */

$i =1;
if(count($widget_contents)>0)
{
	foreach($widget_contents as $get_content) // For Get Content Start Here 
	{
		// Code Block B - if rendering mode is manual then if custom image is available then assigning the imageid to a variable
		// Code Block B starts here - Do not change
			                              
		$original_image_path = "";
		$imagealt            = "";
		$imagetitle          = "";
		$custom_title        = "";
		if($render_mode == "manual")
		{
			if($get_content['custom_image_path'] != '')
			{
			$original_image_path = $get_content['custom_image_path'];
			$imagealt            = $get_content['custom_image_title'];	
			$imagetitle          = $get_content['custom_image_alt'];												
			}
			$custom_title   = $get_content['CustomTitle'];
			$custom_summary = $get_content['CustomSummary'];
		}
		if($original_image_path =="")                                                // from cms || live table    
		{
		$original_image_path  = $get_content['ImagePhysicalPath'];
		$imagealt             = $get_content['ImageCaption'];	
		$imagetitle           = $get_content['ImageAlt'];	
		}
		$show_image="";
		if($original_image_path !='' && get_image_source($original_image_path, 1))
		{
			$imagedetails = get_image_source($original_image_path, 2);
			$imagewidth = $imagedetails[0];
			$imageheight = $imagedetails[1];	
		
			if ($imageheight > $imagewidth)
			{
				$Image600X300 	= $original_image_path;
			}
			else
			{
				$Image600X300  = str_replace("original","w600X300", $original_image_path);
			}
			if (get_image_source($Image600X300, 1) && $Image600X300 != '')
			{
			$show_image = image_url. imagelibrary_image_path . $Image600X300;
			}
			else 
			{
			$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X300.jpg';
			}
			$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X300.jpg';
		}
		else
		{
		$show_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X300.jpg';
		$dummy_image	= image_url. imagelibrary_image_path.'logo/nie_logo_600X300.jpg';
		}
		
		$content_url = $get_content['url'];
		$param = $content['close_param'];
		$live_article_url = $domain_name.$content_url.$param;
		if( $custom_title == '')
		{
		$custom_title = $get_content['title'];
		}	
		$display_title = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1',$custom_title);   //to remove first<p> and last</p>  tag
		$Rating=$this->widget_model->getReviews($get_content['content_id']);
		$display_title = '<a  href="'.$live_article_url.'" class="article_click" >'.$display_title.'</a>';
		//  Assign article links block ends hers
		// Assign summary block - creating links for  article summary
		$section_name= $get_content['section_name'];
		
		if($view_mode == "adminview")
{
		$url_section_value = $domain_name.$get_content['URLStructure'];
		}else {
			
			$url_array = explode('/', $content_url);
$get_seperation_count = count($url_array)-4;

$sectionURL = ($get_seperation_count==1)? $domain_name.$url_array[0] : (($get_seperation_count==2)? $domain_name.$url_array[0]."/".$url_array[1] : $domain_name.$url_array[0]."/".$url_array[1]."/".$url_array[2]);
$url_section_value = $sectionURL;
		}
		// Assign summary block starts here
		
		////////  For first Article  /////////			
		
		
		
		
			if($i%3==1 || $i==1)
			{
			
			//$show_simple_tab.= '<div class="WidthFloat_L" '.$widget_bg_color.'>'; 
			$show_simple_tab.= '<div class="WidthFloat_L">'; 
			} 
			if($Rating != 0)
			{

				$show_simple_tab.= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 EnterNews_1">';
				$show_simple_tab.= '<div class="hovereffect"><h4 class="TopicBack topic"><a href="'.$url_section_value.'" >'.$section_name.'</h4>';
				$show_simple_tab.= '<a  href="'.$live_article_url.'" class="article_click" ><div class="zoom">
				<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></div></a>';
				if($Rating!=0){
					$show_simple_tab.= '<div class="overlay"><div class="review-stars">';
					$review=[];
					$review['0.5']='<i class="fa fa-star-half-o star-success" aria-hidden="true"></i>';
					$review['1']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
					$review['1.5']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star-half-o star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
					$review['2']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
					$review['2.5']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star-half-o star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
					$review['3']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
					$review['3']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
					$review['3.5']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star-half-o star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
					$review['4']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-failure" aria-hidden="true"></i>';
					$review['4.5']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star-half-o star-success" aria-hidden="true"></i>';
					$review['5']='<i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i><i class="fa fa-star star-success" aria-hidden="true"></i>';
					$show_simple_tab.= '<span class="info">Rating:'.$review[$Rating].'</span></div></div>';
			
				}
				$show_simple_tab .='</div><p>'.$display_title.'</p>';
				
				$show_simple_tab.= '</div>';
			}
			else
			{
			$show_simple_tab.= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 EnterNews_1">';
			$show_simple_tab.= '<h4 class="TopicBack topic"><a href="'.$url_section_value.'" >'.$section_name.'</h4>';
			$show_simple_tab.= '<a  href="'.$live_article_url.'" class="article_click" ><div class="zoom">
			<img src="'.$dummy_image.'" data-src="'.$show_image.'" title = "'.$imagetitle.'" alt = "'.$imagealt.'"></div></a>';
			$show_simple_tab .='<p>'.$display_title.'</p>';
			
			$show_simple_tab.= '</div>';
				
			}
			
		    if($i%3==0)
			{ 
			
			$show_simple_tab.=  '</div>'; //  WidthFloat_L For innernal 
			}
		
		
		if($i==count($widget_contents))
		{
			if($i%3!==0)
			{
				
				$show_simple_tab.=  '</div>';
			}
			
			/*if()
			{
			}*/
		}
		// display title and summary block ends here					
		//Widget design code block 1 starts here																
		//Widget design code block 1 starts here
		//echo $i;exit;			
		$i =$i+1;							  
	} // For Get Content Start Here 	
	
 // }// content list iteration block ends here
}
 elseif($view_mode=="adminview")
{
$show_simple_tab .='<div class="margin-bottom-10">'.no_articles.'</div>';
}
  //  // Get Section End

// Adding content Block ends here
if($content['widget_title_link'] == 1)
{
$colorcode=str_replace(array("style='background-color:",";'"),"",$widget_bg_color );
if($colorcode==" "){
	$color="#ab6020";
}else{
	$color=$colorcode;
}
$show_simple_tab .=' <div class="custom_arrow"><a style="color:'.$colorcode.'" href="'.$widget_section_url.'">More '.strtolower($section_name).' >></a></div>';
}
$show_simple_tab .='</div>';// EnterNews
$show_simple_tab .='</div>';// col-lg-12
$show_simple_tab .='</div>';// Row End 

echo $show_simple_tab;
?>