
<?php
$arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
 
if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
  echo "false#";
  return;
}
 
if (!file_exists('uploads')) {
  mkdir('uploads', 0777);
}
$nameFile= 'uploads/' . time() . '_' . $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], $nameFile);

?>

<?php


function generateThumbnail($img, $width, $height, $quality = 90)
{
    if (is_file($img)) {

    	$source_image = imagecreatefromjpeg($img);
    	$width1 = imagesx($source_image);
    	$height1 = imagesy($source_image);

    	/* find the "desired height" of this thumbnail, relative to the desired width  */
    	$desired_height = floor($height1 * ($width / $width1));
        
        $imagick = new Imagick(realpath($img));
        $imagick->setImageFormat('jpeg');
        $imagick->setImageCompression(Imagick::COMPRESSION_JPEG);
        $imagick->setImageCompressionQuality($quality);
        $imagick->thumbnailImage($width, $desired_height, false, false);
        $filename_no_ext = reset(explode('.', $img));
        if (file_put_contents($filename_no_ext . '_thumb' . '.jpg', $imagick) === false) {
            throw new Exception("Could not put contents.");
        }
        return $filename_no_ext . '_thumb' . '.jpg';
    }
    else {
        throw new Exception("No valid image provided with {$img}.");
    }
}

function make_thumb($src, $dest, $desired_width) {

    /* read the source image */
    $source_image = imagecreatefromjpeg($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

   	//echo "w=".$width."-h=".$height;

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

 	if (function_exists('exif_read_data')) {
    	
    	$exif = exif_read_data($src);
    	//die($exif);
    	 if($exif && isset($exif['Orientation'])) {
	      	$orientation = $exif['Orientation'];
	      	if($orientation != 1){
	      		$deg = 0;
		        switch ($orientation) {
		          case 3:
		            $deg = 180;
		            break;
		          case 6:
		            $deg = 270;
		            break;
		          case 8:
		            $deg = 90;
		            break;
		        }
		        if ($deg) {
		          $virtual_image = imagerotate($virtual_image, $deg, 0);        
		        }
	      	}
	    }
	}else{
		//echo "1234";
	}

    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $dest,70 );
}

$src=$nameFile;

$dest='uploads/thumb_' . time() . '_' . $_FILES['file']['name'];
$desired_width="1920";
//make_thumb($src, $dest, $desired_width);


$dest=generateThumbnail($src, 1920, 50, 65);

unlink($src);
echo $dest;
?>