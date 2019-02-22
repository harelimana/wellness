<?php
/**
 * Created by PhpStorm.
 * User: axxahretz
 * Date: 17.01.19
 * Time: 19:45
 */

namespace App\Services;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $uploadsdirectory;

    /**
     * FileUploader constructor
     * @param $uploadsdirectory
     * @param UploadedFile $uploadedFile
     */
    public function __construct($uploadsdirectory)
    {
        $this->uploadsdirectory = $uploadsdirectory;

    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file){
        $filename = $this->getFilename($file);
        $file->move($this->uploadsdirectory, $filename);
        return $filename;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function getFilename(UploadedFile $file){

        return sprintf("%s.%s", sha1(uniqid(mt_rand()), $file->guessExtension()));
    }

    /**
     * @return mixed
     */
    public function getTargetDirectory()
    {
        return $this->uploadsdirectory;
    }
}