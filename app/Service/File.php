<?php

namespace Service;

use Base\Service;

class File extends Service
{
    private $extensionArray = ['jpg', 'jpeg', 'png'];

    protected function __construct()
    {
    }

    public function uploadFile($fileArray, $adId)
    {
        $info = new \SplFileInfo($fileArray['name']);
        $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

        if (!in_array($extension, $this->extensionArray)) {
            return '';
        }

        $fileName = str_pad($adId, 8, 0, STR_PAD_LEFT).'.'.$extension;

        $targetPath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$fileName;

        if (!move_uploaded_file($fileArray['tmp_name'], $targetPath)) {
            return '';
        }

        return $fileName;
    }
}