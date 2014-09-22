<? 
error_reporting(0);
include_once('../../inc/general_func.inc.php');
include_once('../../inc/paths_info.inc.php');

if( wt_is_valid($params, 'array')  ) {
	thumbImage($params);
} else {
	thumbImage($_GET);
}

function thumbImage($params) {
	clearstatcache();
	$commpress = '70';
	$show_blank = '0';
	$watermark = '0';
	foreach($params as $_key => $_val) {
		switch($_key) {
			case 'src':
			case 'height':
			case 'width':
			case 'show_blank':
			case 'watermark':
			case 'compress':
			case 'tr':
			case 'nt':
				$$_key = $_val;
				break;
			default:
				if(!is_array($_val)) {
					$extra .= ' '.$_key.'="'.wt_clear_string($_val).'"';
				}
				break;
		}
	}
	
	if ( wt_is_valid($tr,'int','0') ) {
		$transparency = true;
	} 
	
	$src = CFGF_DIR_FS_MEDIA . $src;
	list($imageWidth, $imageHeight, $imageType) = GetImageSize($src);
	if ($transparency == true) {
		header("Content-type: image/png");
	} else {
		switch($imageType) {
			case 1 : header("Content-type: image/png"); break;
			case 3 : header("Content-type: image/png"); break;
			case 6 : header("Content-type: image/x-ms-bmp"); break;
			case 7 :
			case 8 : header("Content-type: image/tiff"); break;
			case 2 :
			default: header("Content-type: image/jpeg"); break;
		}
	}
	//$thumbPath = dirname($src) . DIRECTORY_SEPARATOR . 'th_' . $width . 'x' . $height . 'x' . $commpress . '_w' . $watermark . '_' . basename($src);
	$thumbPath = dirname($src) . DIRECTORY_SEPARATOR . 'th_' . $width . 'x' . $height . 'x' . $commpress . '_w' . $watermark . ($transparency==true ? '_t_' : '') . basename($src);
	$imageModified = @filemtime($src);
	
	if($width == $imageWidth && $height == $imageHeight && !wt_not_null($watermark))  {
		header("Last-Modified: ".gmdate("D, d M Y H:i:s",$imageModified)." GMT");
		readfile($src);
		exit;
	}
	$thumbModified = @filemtime($thumbPath);
	if($imageModified<$thumbModified) {
		header("Last-Modified: ".gmdate("D, d M Y H:i:s",$thumbModified)." GMT");
		readfile($thumbPath);
		exit;
	}
	switch($imageType) {
		case 1 :
			$image = ImageCreateFromGIF($src);
			break;
		case 3 :
			$image = ImageCreateFromPNG($src);
			break;
		case 2 :
		default:
			$image = ImageCreateFromJPEG($src);
			break;
	}
	$thumb = ImageCreateTrueColor($width,$height);
	
	if( $transparency === true ) {
	imagesavealpha($thumb, true);
   $trans_colour = imagecolorallocatealpha($thumb, 0, 0, 0, 127);
   imagefill($thumb, 0, 0, $trans_colour);
	}
	 
	$dst_x = 0;
	$dst_y = 0;
	if( $width > $imageWidth && $height > $imageHeight) {
		$twidth = $imageWidth;
		$theight = $imageHeight;
	} elseif( $imageHeight <= $imageWidth ) {
		if( $imageWidth > $width ) {
			$twidth = $width;
			$theight = round(($width / $imageWidth) * $imageHeight);
			while($theight > $height) {
				$theight = $imageHeight / ($imageWidth / $twidth);
				$twidth--;
			}
		} else {
			$theight = $height;
			$twidth = round(($height / $imageHeight) * $imageWidth);
		}
	} elseif( $imageHeight > $imageWidth ) {
		if( $imageHeight > $height ) {
			$theight = $height;
			$twidth = round(($width / $imageWidth) * $imageHeight);
			while($twidth > $width) {
				$twidth = $imageWidth / ($imageHeight / $theight);
				$theight--;
			}
		} else {
			$theight = $imageHeight;
			$twidth =  round(($width / $imageWidth) * $height);
			while($twidth > $width) {
				$twidth = $imageWidth / ($imageHeight / $theight);
				$theight--;
			}
		}
	}
	if( $twidth < $width ) {
		$dst_x = round(($width-$twidth)/2, 0);
	}
	if( $theight < $height ) {
		$dst_x = round(($width-$twidth)/2, 0);
		$dst_y = round(($height-$theight)/2, 0);
	}
	/*
	echo 'w' . $imageWidth . '-' . $twidth . '<br />';
	echo 'h' . $imageHeight . '-' . $height . '<br />';
	die();
	*/
 

	if( $transparency !== true ) {
	$white = imagecolorallocate($thumb, 255, 255, 255);
	imagefill($thumb, 0, 0, $white);
	}

	ImageCopyResampled($thumb,$image,$dst_x,$dst_y,0,0,$twidth,$theight,$imageWidth,$imageHeight);
	
	if(wt_not_null($watermark) && basename($src) != 'no_image.png') {
		$watermark = CFGF_DIR_FS_MEDIA . $watermark;
		if(file_exists($watermark)) {
			list($w, $h, $t) = getimagesize($watermark);
			switch($t) {
				case 1 :
					$image2 = ImageCreateFromGIF($watermark);
					break;
				case 3 :
					$image2 = ImageCreateFromPNG($watermark);
					break;
				case 2 :
				default:
					$image2 = ImageCreateFromJPEG($watermark);
					break;
			}
		 		  
		ImageCopy($thumb,$image2,10,10,0,0,$w,$h);
			//right_down corner
		  //	ImageCopy($thumb,$image2,$rwW,$rwH,0,0,$w,$h);
			//right_top corner
			//  ImageCopy($thumb,$image2,$rwW,10,0,0,$w,$h);
			//left_down corner
			//  ImageCopy($thumb,$image2,10,$rwH,0,0,$w,$h);
		}
	}
	if ($transparency == true) {
		$tcolor = imagecolorallocate($thumb,$tr,$tg,$tb);
		imagecolortransparent($thumb,$tcolor);
		if( $nt != '1' ) {
		ImagePNG($thumb,$thumbPath);
		}
		ImagePNG($thumb);
	} else {
		switch($imageType) {
			case 1 :
			case 3 :
				if( $nt != '1' ) {
				ImagePNG($thumb,$thumbPath);
				}
				ImagePNG($thumb);
				break;
			case 2 :
			default:
				if( $nt != '1' ) {
				ImageJPEG($thumb,$thumbPath,$commpress);
				}
				ImageJPEG($thumb,'',$commpress);
				break;
		}
	}
	ImageDestroy($image);
	ImageDestroy($thumb);
}

function wt_fit_area($sw, $sh, &$dw, &$dh, $tw, $th) {

	if($sw <= $tw && $sh <= $th  ) {
		$dw = $sw;
		$dh = $sh;
	} else {

		if($sw >= $sh) {

			if( $sw > $tw ) {
				$dw = $tw;
				$dh = round(($dw / $sw) * $sh);
			} else {
				$dw = $sw;
				$dh = round(($dw / $sw) * $sh);
			}
		}
	}

}
?>