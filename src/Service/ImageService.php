<?php

namespace Greendot\ImagePullerClient\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService
{
    private string $src;

    public function __construct(string $src, string $projectRoot)
    {
        $this->src = $src;
        if (!str_starts_with($src, $projectRoot)) {
            $this->src = $projectRoot.$src;
        }
    }

    /**
     * @param $file UploadedFile
     */
    public function uploadImage(UploadedFile $file)
    {
        $name = md5(uniqid());
        $extension = $file->guessExtension();
        $file->move($this->src, $name . '.' . $extension);
        $link = $this->src . '/' . $name . '.' . $extension;
        list($width, $height, $type) = getimagesize($link);
        $image = $this->load_image($link, $type);
        $imageLg = $this->resizeMaxWidth(1000, $image, $width, $height);
        $this->save_image($imageLg, $this->src . '/' . $name . '.lg.' . $extension);
        $imageMd = $this->resizeMaxWidth(300, $image, $width, $height);
        $this->save_image($imageMd, $this->src . '/' . $name . '.md.' . $extension);
        $imageSm = $this->resizeMaxWidth(150, $image, $width, $height);
        $this->save_image($imageSm, $this->src . '/' . $name . '.sm.' . $extension);
    }

    private function load_image($filename, $type)
    {
        $image = false;
        if ($type == IMAGETYPE_JPEG) {
            $image = \imagecreatefromjpeg($filename);
        } elseif ($type == IMAGETYPE_PNG) {
            $image = \imagecreatefrompng($filename);
        } elseif ($type == IMAGETYPE_GIF) {
            $image = \imagecreatefromgif($filename);
        }
        return $image;
    }

    private function resizeMaxWidth($newMaxWidth, $image, $width, $height)
    {
        if ($width <= $newMaxWidth) {
            return $image;
        }
        return $this->resize_image($newMaxWidth, floor($newMaxWidth * $height / $width), $image, $width, $height);
    }

    private function resize_image($new_width, $new_height, $image, $width, $height)
    {
        $new_image = \imagecreatetruecolor($new_width, $new_height);
        \imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        return $new_image;
    }

    private function save_image($new_image, $new_filename, $new_type = 'jpeg', $quality = 80)
    {
        if ($new_type == 'jpeg') {
            imagejpeg($new_image, $new_filename, $quality);
        } elseif ($new_type == 'png') {
            imagepng($new_image, $new_filename);
        } elseif ($new_type == 'gif') {
            imagegif($new_image, $new_filename);
        }
    }

    private function scale_image($scale, $image, $width, $height)
    {
        $new_width = $width * $scale;
        $new_height = $height * $scale;
        return $this->resize_image($new_width, $new_height, $image, $width, $height);
    }

}