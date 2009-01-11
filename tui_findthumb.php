<?php
  /*
  Plugin Name: Tui's Find Thumb
  Plugin URI:  http://www.stephenbaugh.com/blog/wordpress-plugins/find-thumb/
  Version:     1.02
  Description: Selects a random image from a specified folder, this folder is selected on the basis 
  of the category slug and provides various options for using it.  Current supported methods generate an
  Image Tag, A URL only option, and a "background" entry for use in a stylesheet. This plugin is based on Random Image Selector by Keith Murray http://kdmurray.net
  Author:      Stephen Baugh
  Author URI:  http://www.stephenbaugh.com/
  */

  /*
    Copyright 2009-2010 Stephen Baugh  (email : stephen@stephenbaugh.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 3 of the License, or
    (at your option) any later version.

http://www.gnu.org/licenses/quick-guide-gplv3.html

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
  */

//Check to see if user has sufficient privileges
function tui_ft_is_authorized() 
{
        global $user_level;
        if (function_exists("current_user_can")) {
                return current_user_can('activate_plugins');
        } else {
                return $user_level > 5;
        }
}


// Hook for adding admin menus
add_action('admin_menu', 'tui_ft_add_pages');

// action function for above hook
function tui_ft_add_pages() {

    // Add a new submenu under Options:
    add_options_page("Find Thumbs", "Find Thumbs", 8, 'tui_findthumbs', 'tui_ft_options_page');

}

function tui_ft_options_page() {

        global $ol_flash, $_POST;
        if (tui_ft_is_authorized()) {
                if (isset($_POST['tui_findthumb_url'])) {
                        update_option('tui_findthumb_url',$_POST['tui_findthumb_url']);
                        $ol_flash = "Your settings have been saved.";
                }
                if (isset($_POST['tui_findthumb_path'])) {
                        update_option('tui_findthumb_path',$_POST['tui_findthumb_path']);
                        $ol_flash = "Your settings have been saved.";
                }
                if (isset($_POST['tui_findthumb_scaleopt'])) {
                        update_option('tui_findthumb_scaleopt',$_POST['tui_findthumb_scaleopt']);
                        $ol_flash = "Your settings have been saved.";
                }
                if (isset($_POST['tui_findthumb_width'])) {
                        update_option('tui_findthumb_width',$_POST['tui_findthumb_width']);
                        $ol_flash = "Your settings have been saved.";
                }
                if (isset($_POST['tui_findthumb_height'])) {
                        update_option('tui_findthumb_height',$_POST['tui_findthumb_height']);
                        $ol_flash = "Your settings have been saved.";
                }
                if (isset($_POST['tui_findthumb_class'])) {
                        update_option('tui_findthumb_class',$_POST['tui_findthumb_class']);
                        $ol_flash = "Your settings have been saved.";
                }
                if (isset($_POST['tui_findthumb_metathumbname'])) {
                        update_option('tui_findthumb_metathumbname',$_POST['tui_findthumb_metathumbname']);
                        $ol_flash = "Your settings have been saved.";
                }
                // initialize or capture variable
                $tui_ft_scaleopt_postval = !isset($_POST['tui_findthumb_scaleopt'])? NULL : $_POST['tui_findthumb_scaleopt'];

        }       else {
              $ol_flash = "You don't have sufficient privilges.";
        }
        
echo '<div class="wrap">';
echo '<table width="100%" border="0" cellpadding="0">';
echo '<tr>';
echo '<td align="left" valign="top" width="70%"><h2>Set up your Tui&#8217;s Find Thumb Options</h2></td>';
echo '<td align="left" valign="top" width="5%">&nbsp;</td>';
echo '<td align="left" valign="top" width="25%">&nbsp;</td>';
echo '</tr>';
echo '<tr>';
echo '<td align="left" valign="top">';

        if (tui_ft_is_authorized()) {
        
 
                echo '<p>&nbsp;</p>';
                echo '<p>This plugin gives you the ability to add a random image to any part of your wordpress installation, for example in the header of your theme or page.';
                echo 'By pointing the plugin at a folder in your WordPress directory, it will select at random one image from that folder and display it wherever you need.';
                echo 'For more detailed information and installation information please visit this plugins <A HREF="http://www.stephenbaugh.com/blog/wordpress-plugins/find-thumb/" target="_blank">home page</A></p>';
                echo '<p>&nbsp;</p>';
                echo '<p><input type="submit" value="Save Settings" /></p></form>';
                echo '<p>&nbsp;</p>';
				echo '<form action="" method="post">';
                echo '<input type="hidden" name="redirect" value="true" />';
                echo '<p><strong>Path of the folder you would like to pull the images from</strong> (<b>e.g.</b> <i>/home/myuser/mydomain.com/wp-content/randomimages</i>)<br/></p>';
                echo '<p>'.ABSPATH;
                echo '<input type="text" name="tui_findthumb_path" size="65" value="'.get_option('tui_findthumb_path').'" /></p>';
                echo '<p><strong>Corresponding URL path (full  path) of the folder in #1</strong> (<b>e.g.</b> <i>http://mydomain.com/wp-content/randomimages</i>)</p>';
                echo '<input type="text" name="tui_findthumb_url" size="65" value="'.get_option('tui_findthumb_url').'" /></li>';
				echo '<p><strong>Default css class to use if not defined when used</strong></p>';
				echo '<input type="text" name="tui_findthumb_class" size="30" value="'.get_option('tui_findthumb_class').'" /> (<b>e.g.</b> <i>thumbnail-div</i>) </p>';
				echo '<p><strong>Name of the feature thumb used in your theme</strong></p>';
				echo '<p><input type="text" name="tui_findthumb_metathumbname" size="30" value="'.get_option('tui_findthumb_metathumbname').'" /> (<b>e.g.</b> <i>Thumbnail</i>) </p>';

			$tui_ft_scaleopt_postval = get_option('tui_findthumb_scaleopt');

		switch ($tui_ft_scaleopt_postval)
		{
		  case 'orig':
		    $tui_ft_scaleopt_text = "Leave the image as-is";
		    break;
		  case 'high':
		    $tui_ft_scaleopt_text = "Scale to a specific HEIGHT";
		    break;
		  case 'wide':
		    $tui_ft_scaleopt_text = "Scale to a specific WIDTH";
		    break;
		  case 'spec':
		    $tui_ft_scaleopt_text = "Constrain both height & width";
		    break;
		  default:
		    break;
		}
		
				echo '<p><strong>By default how would you like your thumbnails scaled?</strong></p>';
                echo '<p><select name="tui_findthumb_scaleopt">';
                echo '       <option value="'.$tui_ft_scaleopt_postval.'" SELECTED>'.$tui_ft_scaleopt_text.'</option>';
                echo '       <option value="orig">Leave the image as-is</option>';
                echo '       <option value="high">Scale to a specific HEIGHT</option>';
                echo '       <option value="wide">Scale to a specific WIDTH</option>';
                echo '       <option value="spec">Constrain both height & width</option>';
				echo '    </select> </p>';
				echo '<p>Height: <input type="text" name="tui_findthumb_height" size=20 value="'.get_option('tui_findthumb_height').'" /></p>';
				echo '<p>Width: <input type="text" name="tui_findthumb_width" size=20 value="'.get_option('tui_findthumb_width').'" /></p>';
                echo '<p>&nbsp;</p>';
                echo '<p><input type="submit" value="Save Settings" /></p></form>';
                echo '<p>&nbsp;</p>';
                echo '<p><strong>Once thats done, use one of the following function codes on anyone of your pages, or in the header.</strong></p>';   
                echo '<code>&lt;?php<br />';
                echo "&nbsp;&nbsp;&nbsp;if (function_exists('tui_GeneratePostThumb'))<br/>";
                echo '&nbsp;&nbsp;&nbsp;{<br/>';
                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;tui_GeneratePostThumb($post->ID,150,150,"thumbnail-div");<br/>';
                echo '&nbsp;&nbsp;&nbsp;}<br/>';
                echo '?&gt;<br/></code></p>';
                echo '<p>&nbsp;</p>';
                echo '<p>There are five functions available</p>';
                echo '<code>tui_findRandomBackgroundSTYLE()</code><br />';
                echo '<code>tui_findRandomThumbURL()</code><br />';
                echo '<code>tui_findRandomThumbIMG("Height","Width","Class","Title","Alt")</code><br />';
				echo '<code>tui_findPostThumbURL("thepostID")</code><br />';                
				echo '<code>tui_findPostThumbIMG("thepostID","Height","Width","Class","Title","Alt")</code><br />';                
                echo '<p>&nbsp;</p>';
                echo '</div>';
        }
        else {
              $ol_flash = "You don't have sufficient privilges.";
        }
        
        
	echo '</td>';
	echo '<td align="left" valign="top" width="5%">&nbsp;</td>';
	echo '<td align="left" valign="top">';
    echo '<p><strong>Additional Puggin Information</strong></p>';
    				echo '<p></p>';

  echo 'Plugin Home Page : <A HREF="http://www.stephenbaugh.com/blog/wordpress-plugins/find-thumb/" target="_blank">Click Here</A><br />';
  echo 'To Donate : <A HREF="http://www.stephenbaugh.com/donation.php" target="_blank">Click Here (thanks)</A><br />';
  echo 'Plugin Author : <A HREF="http://www.stephenbaugh.com" target="_blank">Stephen Baugh</A><br />';
  echo '<p>&nbsp;</p>';
  echo 'Rate this plugin : <A HREF="http://wordpress.org/extend/plugins/tui-find-thumb" target="_blank">Click Here (thanks)</A><br />';
  echo '<p>&nbsp;</p>';
  echo "<a href='http://secure.hostgator.com/cgi-bin/affiliates/clickthru.cgi?id=tui701' target='_blank'><img src='http://secure.hostgator.com/~affiliat/banners/hostgator2-220x240.gif' /></a>";

  echo '</tr>';
    echo '</table>';
        
}


  

  function tui_findRandomBackgroundSTYLE()
  {

	$filenamewithpath = tui_findImageBasedOnSlug('backgroundimages');
    echo "background-image: url('.$filenamewithpath.');";

  }





  
  
  function tui_findRandomThumbURL()
  {
   
	$filenamewithpath = tui_findImageBasedOnSlug();  
    return $filenamewithpath;
  
  }




  function tui_findRandomThumbIMG($scaleHeight=100,$scaleWidth=100,$classOption='',$thumb_title='',$thumb_alt='')
  {

	$scaleOption = get_option('tui_findthumb_scaleopt');
 	if($scaleHeight == 0) {
		$scaleHeight = get_option('tui_findthumb_height');
	}
	if($scaleWidth == 0) {
		$scaleWidth = get_option('tui_findthumb_width');
	}
 	if($classOption == 0) {
		$classOption = get_option('tui_findthumb_class');
	}
	
	$filenamewithpath = tui_findImageBasedOnSlug();
  	$ImageDetails = tui_getFileInfo($filenamewithpath);
   	$physHeight = $ImageDetails['height'];
	$physWidth = $ImageDetails['width'];
    
   	switch($scaleOption)
   	{
   	case 'high':
		$ratio = $physHeight / $scaleHeight;
       	$physWidth = $physWidth / $ratio;
       	$physHeight = $scaleHeight;
		break;
   	case 'wide':
		$ratio = $physWidth / $scaleWidth;
       	$physHeight = $physHeight / $ratio;
       	$physWidth = $scaleWidth;
		break;
   	case 'spec':
		$physHeight = $scaleHeight;
		$physWidth = $scaleWidth;
		break;
	default:
		break;
   	}
    
	$pathparts=pathinfo($filenamewithpath);
  	$filename = $pathparts['basename'];
			
	if($thumb_title == '') {
		$thumb_title = $filename;
	}
	if($thumb_alt == '') {
		$thumb_alt = $filename;
	}
   	
	echo '<img src="'.$filenamewithpath.'" title="'.$thumb_title.'" alt="'.$thumb_alt.'" height="'.$physHeight.'" width="'.$physWidth.'" class="'.$classOption.'"/>';
    
  }


function tui_findPostThumbURL($thepostID='')
{
	// check for thumbnail based on MetaName
	if ($thepostID !== '') {
		$thumbnailmetaname = get_option('tui_findthumb_metathumbname');
		if($thumbnailmetaname == '') {
			$thumbnailmetaname = 'Thumbnail';
		}
		$filenamewithpath = get_post_meta($thepostID, $thumbnailmetaname, $single = true);
	} else {
		$filenamewithpath = '';
	}
		
	if ($filenamewithpath == '') {
	
		if ($thepostID !== '') {
		$filenamewithpath = tui_findImageBasedOnAttachment($thepostID);
		}
		
		if ($filenamewithpath == '') {
		
			$categories = get_the_category(); 
			$categorySlug = $categories[0]->slug;
			$filenamewithpath = tui_findImageBasedOnSlug($categorySlug);
		
			if ($filenamewithpath == '') {
		
				$filenamewithpath = tui_findImageBasedOnSlug();
	
				if ($filenamewithpath == '') { 
				// Maybe should return error message
				}
			}
		}
	}
	
	return $filenamewithpath;

}







function tui_findPostThumbIMG($thepostID='',$scaleHeight=100,$scaleWidth=100,$classOption='',$thumb_title='',$thumb_alt='')
{

 	$scaleOption = get_option('tui_findthumb_scaleopt');
 	if($scaleHeight == 0) {
		$scaleHeight = get_option('tui_findthumb_height');
	}
	if($scaleWidth == 0) {
		$scaleWidth = get_option('tui_findthumb_width');
	}
		
	// check for thumbnail based on MetaName
	if ($thepostID !== '') {
		$thumbnailmetaname = get_option('tui_findthumb_metathumbname');
		if($thumbnailmetaname == '') {
			$thumbnailmetaname = 'Thumbnail';
		}
		$filenamewithpath = get_post_meta($thepostID, $thumbnailmetaname, $single = true);
	} else {
		$filenamewithpath = '';
	}

	if ($filenamewithpath !== '') {
	
		$thumb_alt = get_post_meta($thepostID, 'Thumbnail Alt', $single = true); // check for thumbnail alt text
		$thumb_title = get_post_meta($thepostID, 'Thumbnail Title', $single = true);
		$thumb_class = get_post_meta($thepostID, 'Thumbnail Class', $single = true); // check for thumbnail class

	} else {
	
	if ($thepostID !== '') {

	$filenamewithpath = tui_findImageBasedOnAttachment($thepostID);

		}
	
		if ($filenamewithpath == '') {
		
			$categories = get_the_category(); 
			$categorySlug = $categories[0]->slug;
			$filenamewithpath = tui_findImageBasedOnSlug($categorySlug);
		
			if ($filenamewithpath == '') {
		
				$filenamewithpath = tui_findImageBasedOnSlug();
	
				if ($filenamewithpath == '') { 
				// Maybe should return error message
				}
			}
		}
	}
		
	if($classOption == '') {
 	
		if($thumb_class == '') {
			$classOption = get_option('tui_findthumb_class');
		} else {
			$classOption = $thumb_class;
		}
	}
			
	$pathparts=pathinfo($filenamewithpath);
  	$filename = $pathparts['basename'];
			
	if($thumb_title == '') {
		$thumb_title = $filename;
	}
	if($thumb_alt == '') {
		$thumb_alt = $filename;
	}
		
	$ImageDetails = tui_getFileInfo($filenamewithpath);
   	$physHeight = $ImageDetails['height'];
	$physWidth = $ImageDetails['width'];

    switch($scaleOption)
    	{
      	case 'high':
			$ratio = $physHeight / $scaleHeight;
        	$physWidth = $physWidth / $ratio;
        	$physHeight = $scaleHeight;
			break;
      	case 'wide':
			$ratio = $physWidth / $scaleWidth;
        	$physHeight = $physHeight / $ratio;
        	$physWidth = $scaleWidth;
			break;
      	case 'spec':
			$physHeight = $scaleHeight;
			$physWidth = $scaleWidth;
			break;
      	default:
			break;
    	}
    	    	
    	echo '<img src="'.$filenamewithpath.'" title="'.$thumb_title.'" alt="'.$thumb_alt.'" height="'.$physHeight.'" width="'.$physWidth.'" class="'.$classOption.'"/>';
    	    	

}





function tui_findImageBasedOnAttachment($thepostID) {


$theargs = 'post_parent='.$thepostID.'&post_type=attachment&post_mime_type=image';

	$attachments =& get_children( 'post_parent='.$thepostID.'&post_type=attachment&post_mime_type=image' );

	if ($attachments == TRUE) {
		foreach($attachments as $image) {
		// Use the first image
		$imageurl=wp_get_attachment_url($image->ID);
		break;
		}
	}

	return $imageurl;

}








function tui_findImageBasedOnSlug($categorySlug='')
{

    $physicalPath = get_option('tui_findthumb_path');
	$vPath = get_option('tui_findthumb_url');
	
	if ($categorySlug !== "") {
		$physicalPath = $physicalPath.'/'.$categorySlug.'/';
		$vPath = $vPath.'/'.$categorySlug.'/';
	}
	
	if (is_dir($physicalPath)) {
		// That's a directory lets proceed.
	} else {
		$vPath = get_option('tui_findthumb_url');
	}

	$image_directory = opendir($physicalPath);
    $image_types = array('jpg','png','gif'); // Array of valid image types  
    
    while($image_file = readdir($image_directory))
    {
      if(in_array(strtolower(substr($image_file,-3)),$image_types))
      {
         $image_array[] = $image_file;
         sort($image_array);
         reset ($image_array);
      }
    }
    
    if ($image_array !== Null) {
    $filename = $image_array[rand(1,count($image_array))-1];
	} else {
	$filename = '';
	}

    if ($filename !== '') {
    $filenamewithpath = $vPath.'/'.$filename;
	}

	return $filenamewithpath;
	
}



function tui_getFileInfo($filenamewithpath)
{
	    
    $imageInfo = getimagesize($filenamewithpath);  	
	$myFileInfo['namewithpath'] = $filenamewithpath;
	$myFileInfo['width'] = $imageInfo[0];
	$myFileInfo['height'] = $imageInfo[1];
   	  	 
	return $myFileInfo;  

}

?>
