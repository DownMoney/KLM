<?php

function smarty_function_wt_thumb_image($params, &$smarty)
{
 require_once $smarty->_get_plugin_filepath('shared','escape_special_chars');

    $border = '0';
    $show_blank = '0';
    $watermark = '0';
    $compress = '75';


    foreach($params as $_key => $_val) {
        switch($_key) {
            case 'src':
            $wwwSRC = $_val;
            $$_key = CFGF_DIR_FS_MEDIA . str_replace('\\', DIRECTORY_SEPARATOR, $_val);
            break;
            case 'border':
            case 'height':
            case 'width':
            case 'scale':
            case 'pos':
            case 'MAXheight':
            case 'MAXwidth':
            case 'show_blank':
            case 'watermark':
            case 'compress':
            case 'nt':
            case 'transparency':
				case 'full_path':
				case 'blank_src':
				case 'path_return':
				case 'wmpos':
                $$_key = $_val;
                break;

            case 'alt':
            case 'title':
                if(!is_array($_val)) {
                    $$_key = smarty_function_escape_special_chars($_val);
                } else {
                    $smarty->trigger_error("html_image: extra attribute '$_key' cannot be an array", E_USER_NOTICE);
                }
                break;

            case 'link':
            case 'href':
                $prefix = '<a href="' . $_val . '">';
                $suffix = '</a>';
                break;


            default:
                if(!is_array($_val)) {
                    $extra .= ' '.$_key.'="'.smarty_function_escape_special_chars($_val).'"';
                } else {
                    $smarty->trigger_error("html_image: extra attribute '$_key' cannot be an array", E_USER_NOTICE);
                }
                break;
        }
    }



	 if(!file_exists($src) || !wt_not_null($src) || @filesize($src) == 0 || is_dir($src)) {

  if($show_blank == '0') {
  return;
  }

  if( isset($blank_src) && wt_not_null($blank_src) && file_exists(CFGF_DIR_FS_MEDIA . $blank_src) ) {
	$no_image = true;
   $src = CFGF_DIR_FS_MEDIA . $blank_src;
   $wwwSRC = $blank_src;
  }  else {
	$no_image = true;
   $src = CFGF_DIR_FS_MEDIA . 'no_image.png';
   $wwwSRC = 'no_image.png';
  }


  }

  if( $no_image === true ) {
  		unset($scale, $pos);
  }


  list($imageWidth, $imageHeight, $imageType) = GetImageSize($src);


  if(wt_not_null($width) || wt_not_null($height)) {
        if (empty($width) && wt_not_null($height)) {
          $ratio = $height / $imageHeight;
          $width = $imageWidth * $ratio;
        } elseif (wt_not_null($width) && empty($height)) {
          $ratio = $width / $imageWidth;
          $height = $imageHeight * $ratio;
      }


    } else {
    $width = $imageWidth;
    $height = $imageHeight;
    }


    if((wt_not_null($MAXwidth) && ($MAXwidth < $width) ) || (wt_not_null($MAXheight)  && ($MAXheight < $height) ) ) {



if(wt_not_null($MAXwidth) && wt_not_null($MAXheight)  ) {

if ($imageHeight < $MAXheight ) {
	$MAXheight = $imageHeight;
}

if ($imageWidth < $MAXwidth ) {
	$MAXwidth = $imageWidth;
}

  }  else {


		if (wt_not_null($MAXwidth) && empty($MAXheight)) {
          $ratio = $MAXwidth / $width;
          $MAXheight = $height * $ratio;
      }

     if (empty($MAXwidth) && wt_not_null($MAXheight)) {
          $ratio = $MAXheight / $height;
          $MAXwidth = $width * $ratio;
        }

  }


    $width = $MAXwidth;
    $height = $MAXheight;

    }

	 $width = round($width, 0);
    $height = round($height, 0);
  if( $full_path ) {
	$wwwPath = CFG_WS_FULL_PATH_TO_DOCUMENT_ROOT;
	} else {
	$wwwPath .= CFG_WS_PATH_TO_DOCUMENT_ROOT;
	}
	$wwwPath .= 'modules/free_files/thumbImage.php?src=' . $wwwSRC;
	if(wt_is_valid($scale,'int','0')) {
		$wwwPath .= '&scale='.$scale;
	}
	if(wt_is_valid($width,'int','0')) {
		$wwwPath .= '&width='.$width;
	}
	if(wt_is_valid($height,'int','0')) {
		$wwwPath .= '&height='.$height;
	}
	if(wt_is_valid($compress,'int','0')) {
		$wwwPath .= '&compress='.$compress;
	}
	if(wt_is_valid($show_blank,'int')) {
		$wwwPath .= '&show_blank='.$show_blank;
	}
	if(wt_not_null($watermark)) {
		$wwwPath .= '&watermark='.$watermark;
	}
	if(wt_not_null($wmpos)) {
		$wwwPath .= '&wmpos='.$wmpos;
	}
  	if( wt_is_valid($nt, 'int', '0') ) {
  		$wwwPath .= '&nt=1';
  	}
  	if( wt_not_null($pos) ) {
	  	$wwwPath .= '&pos='.$pos;
	}

  if (wt_not_null($transparency)) {
  	switch ($transparency) {
  		case 'black':$tarray = array('0','0','0');
  					 break;
  		case 'white':$tarray = array('255','255','255');
  					 break;
  		default: $tarray = explode(',',trim($transparency,'()'));
  				 break;

  	}
  	$wwwPath .= '&tr='.$tarray[0].'&tg='.$tarray[1].'&tb='.$tarray[2];
  }

  if( $params['array_return'] === true ) {
  	return array('src' => $wwwSRC,
  					 'width' => $width,
  					 'height' => $height,
  					 );
  } elseif( $params['path_return'] === true ) {
	 return $wwwPath;
  } elseif($imageType == 13) {
  	echo '<span id="flash_'.md5($wwwSRC.$width.$height).'"></span>';
  	echo '<script type="text/javascript">
		loadLogo = new FlashObject(
		"'.CFGF_DIR_WS_MEDIA.$orgSRC.'", "flash_'.md5($wwwSRC.$width.$height).'", "'.$width.'", "'.$height.'", 8, "#ffffff");
		loadLogo.addParam("wmode", "transparent");
		loadLogo.write("flash_'.md5($wwwSRC.$width.$height).'");
	</script>';
	return;
  } else {
 $thumbPath = dirname($wwwSRC) . DIRECTORY_SEPARATOR . 'th_' . $width . 'x' . $height . 'x' . $compress . '_w' . ($watermark ? $watermark : '0') . ($transparency==true ? '_t_' : '') . ($scale ? 's_' . $scale . $pos : '') . basename($wwwSRC);
	$thumbModified = @filemtime(CFGF_DIR_FS_MEDIA.$thumbPath);
	$imageModified = @filemtime($src);

   if((wt_is_valid($thumbModified, 'int', 0) && wt_is_valid($imageModified, 'int', 0) &&  $imageModified<$thumbModified)) {
		return $prefix . '<img src="'.(($full_path == true) ? CFGF_HTTP_SERVER : '').CFGF_DIR_WS_MEDIA.$thumbPath.'" alt="'.$alt.'" title="'.$title.'" width="'.$width.'" height="'.$height.'"'.$extra.' />' . $suffix;
	} elseif ($width == $imageWidth && $height == $imageHeight && !wt_not_null($watermark)) {
		return $prefix . '<img src="'.(($full_path == true) ? CFGF_HTTP_SERVER : '').CFGF_DIR_WS_MEDIA.$wwwSRC.'" alt="'.$alt.'" title="'.$title.'" width="'.$width.'" height="'.$height.'"'.$extra.' />' . $suffix;
   } else {
		return $prefix . '<img src="'.$wwwPath.'" alt="'.$alt.'" title="'.$title.'" width="'.$width.'" height="'.$height.'"'.$extra.' />' . $suffix;
	}

 }
}
/* vim: set expandtab: */

?>
