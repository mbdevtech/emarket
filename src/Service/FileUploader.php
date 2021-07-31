<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $pictureDirectory;
    private $coverDirectory;
    private $slugger;

    public function __construct($pictureDirectory, $coverDirectory, SluggerInterface $slugger)
    {
        $this->pictureDirectory = $pictureDirectory;
        $this->coverDirectory = $coverDirectory;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file, $picture)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            if ($picture)  // the target is picture directory
              { $file->move($this->getPictureDirectory(), $fileName); }
            else
              { $file->move($this->getCoverDirectory(), $fileName);}
            
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function getPictureDirectory()
    {
        return $this->pictureDirectory;
    }
    public function getCoverDirectory()
    {
        return $this->coverDirectory;
    }
}
