<?php

namespace App\EventListener;

use App\Entity\Image;
use App\Services\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;

class FileUploadListener
{
    private $uploader;
   // private $logger;


    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    /**
     * @param LifecycleEventArgs $file
     */
    public function prePersist(LifecycleEventArgs $file)
    {
        $image = $file->getEntity();
        $this->uploadFile($image);
    }

    /**
     * @param PreUpdateEventArgs $file
     *
     */
    public function preUpdate(PreUpdateEventArgs $file)
    {
        $image = $file->getEntity();
        $this->uploadFile($image);

        // Check which fields were changes
        $changes = $file->getEntityChangeSet();

        // Declare a variable that will contain the name of the previous file, if exists.
        $previousImage = null;

        // Verify if the image field was changed
        if (array_key_exists("image", $changes)) {
            // Update previous file name
            $previousImage = $changes["image"][0];
        }

        // If no new image file was uploaded
        if (is_null($image->getImage())) {
            // Let original imageFilename in the entity
            $image->setImage($previousImage);

            // If a new image was uploaded in the form
        } else {
            // If some previous file exist
            if (!is_null($previousImage)) {
                $pathPreviousImage = $this->uploader->getTargetDirectory() . "/" . $previousImage;

                // Remove it
                if (file_exists($pathPreviousImage)) {
                    unlink($pathPreviousImage);
                }
            }

            // Upload new file
            $this->uploadFile($image);
        }

    }

    /**
     * @param $image
     */
    private function uploadFile($image)
    {
        if (!$image instanceof Image) {
            return;
        }

        $file = $image->getImage();

        // upload new files only
        if ($file instanceof UploadedFile) {
            $filename = $this->uploader->upload($file);
            $image->setImage($filename); //hydrate the Entity
        }
    }

}
