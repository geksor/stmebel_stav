<?php

namespace common\models;


use Imagine\Image\Box;
use Imagine\Image\Point;
use yii\base\Model;
use yii\helpers\Json;
use yii\imagine\Image;
use yii\web\UploadedFile;
use Yii;

class DocumentUpload extends Model
{
    public $document;

    public function rules()
    {
        return [
            [['document'], 'required'],
            [['document'], 'file', 'extensions' => ['pdf']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'document' => 'Документ',
        ];
    }

    public function uploadFile(UploadedFile $file, $currentDocument)
    {
        $this->document = $file;

        if ($this->validate())
        {
            $this->deleteCurrentDocument($currentDocument);

            return $this->saveDocument();
        }
        return false;
    }


    private  function getFolder()
    {
        return Yii::getAlias('@uploads') . '/documents/';
    }


    private function generateFileName()
    {
        return strtolower(md5(uniqid($this->document->tempName, false)) . '.' . $this->document->extension);
    }


    public function deleteCurrentDocument($currentDocument)
    {
        if ($this->fileExists($currentDocument))
        {
            unlink($this->getFolder() . $currentDocument);
        }
    }


    public function fileExists($currentDocument)
    {
        if (!empty($currentDocument) && $currentDocument != null)
        {
            return file_exists($this->getFolder() . $currentDocument);
        }
        return false;
    }

    public function saveDocument()
    {
        $fileName = $this->generateFileName();

        $this->document->saveAs($this->getFolder() . $fileName);

        return $fileName;
    }

}