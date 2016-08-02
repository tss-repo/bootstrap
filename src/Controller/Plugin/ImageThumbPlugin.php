<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 23/07/2015
 * Time: 09:57 AM
 */

namespace TSS\Bootstrap\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ImageThumbPlugin extends AbstractPlugin
{
    /**
     * @var string
     */
    protected $defaultImageThumb;

    /**
     * @var int
     */
    protected $defaultThumbWidth;

    /**
     * @var int
     */
    protected $defaultThumbHeight;

    /**
     * ImageThumbPlugin constructor.
     * @param string $defaultImage
     * @param int $defaultThumbWidth
     * @param int $defaultThumbHeight
     */
    public function __construct($defaultImage, $defaultThumbWidth = 128, $defaultThumbHeight = 128)
    {
        $this->defaultImageThumb = $defaultImage;
        $this->defaultThumbWidth = $defaultThumbWidth;
        $this->defaultThumbHeight = $defaultThumbHeight;
    }

    public function process($file, $thumbWidth = null, $thumbHeight = null)
    {
        if ($file['error'] == 0) {
            $path = $file['tmp_name'];
        } else {
            return $this->getDefaultImageThumb();
        }

        if ($thumbWidth == null) {
            $thumbWidth = $this->defaultThumbWidth;
        }

        if ($thumbHeight == null) {
            $thumbHeight = $this->defaultThumbHeight;
        }

        //File Resize Crop to Blob All in One
        switch (exif_imagetype($path)) {
            case IMAGETYPE_GIF :
                $image = imagecreatefromgif($path);
                break;
            case IMAGETYPE_JPEG :
                $image = imagecreatefromjpeg($path);
                break;
            case IMAGETYPE_PNG :
                $image = imagecreatefrompng($path);
                break;
            default :
                throw new \Exception('Invalid image type');
        }
        $width = imagesx($image);
        $height = imagesy($image);
        $original_aspect = $width / $height;
        $thumb_aspect = 1.0;

        if ($original_aspect >= $thumb_aspect) {
            $new_height = $thumbHeight;
            $new_width = $width / ($height / $thumbHeight);
        } else {
            $new_width = $thumbWidth;
            $new_height = $height / ($width / $thumbWidth);
        }

        $thumb = imagecreatetruecolor($thumbWidth, $thumbHeight);

        imagecopyresampled($thumb,
            $image,
            0 - ($new_width - $thumbWidth) / 2, // Center the image horizontally
            0 - ($new_height - $thumbHeight) / 2, // Center the image vertically
            0, 0,
            $new_width, $new_height,
            $width, $height);

        ob_start();
        imagepng($thumb);
        $content = base64_encode(ob_get_contents());
        ob_end_clean();
        return $content;
    }

    /**
     * @return string
     */
    public function getDefaultImageThumb()
    {
        return $this->defaultImageThumb;
    }

    /**
     * @param string $defaultImageThumb
     */
    public function setDefaultImageThumb($defaultImageThumb)
    {
        $this->defaultImageThumb = $defaultImageThumb;
    }
}
