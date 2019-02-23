<?php

namespace App\Controller;

use App\Entity\Image;
use App\EventListener\FileUploadListener;
use App\Form\ImageType;
use App\Form\PrestataireType;
use App\Services\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * @Route("/image", name="image")
     */
    public function index()
    {
        return $this->render('image/index.html.twig', [
            'controller_name' => 'ImageController',
        ]);
    }

    /**
     * @Route("/fileUpload", name="fileUpload")
     * @param Request $request
     * @param FileUploader $file
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */

    public function editProfile(Request $request,FileUploader $file){

        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
           /* echo "<pre>";
            var_dump($request); die;

            /* redefine the file using the hash Key and save it */
            $filename = $image->getImage();
            $fileName = $this->generateUniqueFileName(). '.' . $this->$file->guessExtension();
            try{
                $file->uploader->move($this->getParameter('uploadsdirectory'), $filename);
                /* save the file in the directory before persist */
               /* $file->setImage($imagefile); */
            }
            catch(FileException $e){
                // TODO
            }

            return $this->redirectToRoute('home');
        }
        return $this->render('home/imageUploader.html.twig',array('imgUpload'=>$form->createView(),));
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() or sha1() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return sha1(uniqid(mt_rand(), true));
    }


    /**
     *
     */
    public function preUpload()
    {
        if (null !== $image->getImage()) {
            // do whatever you want to generate a unique name
            $filename = $this->generateUniqueFileName();
            $this->path = $filename . $image->getImage()->guessExtension();
        }
    }

    /**
     *
     */
    public function upload()
    {
        if (null === $image->getImage()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $image->getImage()->move($file->getTargetDirectory(), $this->$path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($file->getTargetDirectory() . '/' . $this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

}