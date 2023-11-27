<?php
namespace App\Repositories\File;
use App\Models\Config as ModelConfig;
class EloquentFile implements FileRepository {
    protected $image;
    protected $thumbPath = 'thumbs';
    protected $isCheck = true;
    public $isFile = false;
    function checkFile($size,$image,$md5) {
        $subPath = $this->thumbPath.'/'.$size;
        if(!is_dir($subPath)) {
            mkdir($subPath);
            chmod($subPath,0777);
        }
        if(!$md5 || strlen($md5) != 32) {
            $md5 = md5($image);
        }
        $subPath .= '/'.$md5[0];
        if(!is_dir($subPath)) {
            mkdir($subPath);
            chmod($subPath,0777);
        }
        $subPath .= '/'.$md5[1];
        if(!is_dir($subPath)) {
            mkdir($subPath);
            chmod($subPath,0777);
        }
        $arrImage = explode('/',$image);
        $pathFile = $subPath.'/'.$arrImage[count($arrImage)-1];
        $cdnUrl = \Config::get('app.cdn_url');
        if($this->isCheck === false) {
            if($this->isFile) {
                return $pathFile;
            }
            return $cdnUrl.$pathFile;
        }
        //var_dump($pathFile);die;
        if(file_exists($pathFile)) {
            if($this->isFile) {
                return $pathFile;
            }
            return $cdnUrl.$pathFile;
        }
        $fileSrc = \Config::get('site.files').'/'.$image;
        $height = 0;
        $width = 0;
        $config = ModelConfig::getAllValue();
        if(isset($config['VIVVO_'.strtoupper($size).'_IMAGE_WIDTH'])) {
            $width = $config['VIVVO_'.strtoupper($size).'_IMAGE_WIDTH'];
        }
        if(isset($config['VIVVO_'.strtoupper($size).'_IMAGE_HEIGHT'])) {
            $height = $config['VIVVO_'.strtoupper($size).'_IMAGE_HEIGHT'];
        }
        $this->createThumbnail($fileSrc,$pathFile,$width,$height);
        if(file_exists($pathFile)) {
            //dd($cdnUrl.$pathFile);
            if($this->isFile) {
                return $pathFile;
            }
            return $cdnUrl.$pathFile;
        }
        //return 'thumbnail.php?file='.$image.'&size='.$size;
        return '/admin/assets/img/no-image.png';

    }
    function getLarge($image,$checkExisting=true,$md5='') {
        $this->isCheck = $checkExisting;
        return $this->checkFile("article_large",$image,$md5);
    }
    function getMedium($image,$checkExisting=true,$md5='') {
        $this->isCheck = $checkExisting;
        return $this->checkFile('article_medium',$image,$md5);
    }
    function getSmall($image,$checkExisting=true,$md5='') {
        $this->isCheck = $checkExisting;
        return $this->checkFile('article_small',$image,$md5);
    }
    function getSummaryLarge($image,$checkExisting=true,$md5='') {
        $this->isCheck = $checkExisting;
        return $this->checkFile('summary_large',$image,$md5);
    }
    function getSummaryMedium($image,$checkExisting=true,$md5='') {
        $this->isCheck = $checkExisting;
        return $this->checkFile('summary_medium',$image,$md5);
    }
    function getSummarySmall($image,$checkExisting=true,$md5='') {
        $this->isCheck = $checkExisting;
        return $this->checkFile('summary_small',$image,$md5);
    }
    function getThumbview($image,$checkExisting=true,$md5='') {
        $this->isCheck = $checkExisting;
        return $this->checkFile('thumbview',$image,$md5);
    }
    public function createAllThumbs($filename,$md5='') {
        $this->getSummaryLarge($filename,true,$md5);
        $this->getSummarySmall($filename,true,$md5);
        $this->getSummaryMedium($filename,true,$md5);
        $this->getSmall($filename,true,$md5);
        $this->getLarge($filename,true,$md5);
        $this->getMedium($filename,true,$md5);
        $this->getThumbview($filename,true,$md5);
    }
    function getDesktopUrl($image) {
        $cdnUrl = \Config::get('app.cdn_url');
        return $cdnUrl."themes/akhbarona210/".$image;
    }
    function getMobileUrl($image) {
        $cdnUrl = \Config::get('app.cdn_url');
        return $cdnUrl."themes/mobile/".$image;
    }
    function getImage($image) {
        return \Config::get('app.cdn_url').'files/'.$image;
    }
    protected function createThumbnail( $fileSrc, $thumbDest, $thumb_width = 100, $thumb_height = 70 )
    {
        //echo $thumb_width.'||'.$thumb_height;die;
        $ext = strtolower( substr($fileSrc, strrpos($fileSrc, ".")) );

        if(!file_exists($fileSrc)) {
            return '';
        }
        $base_img = '';
        try {
            if( $ext == ".png" )
            {
                $base_img = ImageCreateFromPNG($fileSrc);
            }
            else if( ($ext == ".jpeg") || ($ext == ".jpg") )
            {
                $base_img = ImageCreateFromJPEG($fileSrc);
            }
            else if( ($ext == ".gif") )
            {
                $base_img = imagecreatefromgif($fileSrc);
            }
        } catch (\Exception $e) {
            return '';
        }


        // If the image is broken
        if ( !$base_img) {
            echo 'Image is broken';
            return false;
        }


        // Get image sizes from the image object we just created
        $img_width = imagesx($base_img);
        $img_height = imagesy($base_img);


        // Work out which way it needs to be resized
        $img_width_per  = $thumb_width / $img_width;
        if ($thumb_height == 0){
            $img_height_per = $thumb_width / $img_width;
            $thumb_height = (int) $img_height_per * $thumb_width;
        }else{
            $img_height_per = $thumb_height / $img_height;
        }

        if ($img_width_per <= $img_height_per)
        {
            $thumb_width = $thumb_width;
            $thumb_height = intval($img_height * $img_width_per);
        }
        else
        {
            $thumb_width = intval($img_width * $img_height_per);
            $thumb_height = $thumb_height;
        }
        try {
            $thumb_img = ImageCreateTrueColor($thumb_width, $thumb_height);
            if(!$thumb_img) {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }

        ImageCopyResampled($thumb_img, $base_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $img_width, $img_height);


        $fc = @fopen($thumbDest, "w");
        if ($fc){
            fclose($fc);
        }
        if( $ext == ".png" )
        {
            @ImagePNG($thumb_img, $thumbDest);
        }
        else if( ($ext == ".jpeg") || ($ext == ".jpg") )
        {
            @ImageJPEG($thumb_img, $thumbDest);

        }else if($ext == ".gif"){

            @ImageGIF($thumb_img, $thumbDest);

        }

        // Clean up our images
        ImageDestroy($base_img);
        ImageDestroy($thumb_img);

        return true;
    }
}
