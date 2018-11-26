<?php

namespace common\models;

use Imagine\Image\Box;
use Imagine\Image\Point;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "productImages".
 *
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property string $title
 * @property int $rank
 * @property $uploadImage
 * @property $crop_info
 * @property $directory
 *
 * @property Product $product
 */
class ProductImages extends \yii\db\ActiveRecord
{
    public $crop_info;
    public $directory;
    public $uploadImage;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productImages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//            [['uploadImage'], 'required'],
            [
                'uploadImage',
                'image',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
            ],
            [['crop_info', 'directory'], 'safe'],
            [['product_id'], 'required'],
            [['product_id', 'rank'], 'integer'],
            [['rank'], 'default', 'value' => 1],
            [['image', 'title'], 'string', 'max' => 255],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'image' => 'Image',
            'title' => 'Title',
            'rank' => 'Rank',
            'uploadImage' => 'Изображение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @param UploadedFile $file
     * @param $currentImage
     * @param $cropInfo
     * @param $dir
     * @return bool
     * @throws \yii\base\ErrorException
     * @throws \yii\base\Exception
     */
    public function saveProductImage(UploadedFile $file, $currentImage, $cropInfo, $dir)
    {
        $this->image = $this->uploadFile($file, $currentImage, $cropInfo, $dir);

        if ($this->image){
            $this->setMainImage($this->product_id, $this->image);
            return $this->save(false);
        }
        return false;
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function getImage()
    {
        return ($this->image) ? '/uploads/images/product/'.$this->product_id.'/'.$this->image : "/no_image.png";
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function getThumbImage()
    {
        return ($this->image) ? '/uploads/images/product/'.$this->product_id.'/'. 'thumb_' .$this->image : "/no_image.png";
    }

    /**
     * @throws \yii\base\ErrorException
     * @throws \yii\base\Exception
     */
    public function deleteImage()
    {
        $this->directory = $this->product_id;
        if ($this->image === $this->product->main_image){
            $this->product->main_image = null;
            $this->product->save(false);
        }
        $this->deleteCurrentImage($this->image);
    }

    public function setMainImage($prod_id, $image = null)
    {
        $models = $this::find()->where(['product_id' => $prod_id])->all();
        if ($models){
            if (!$models[0]->product->main_image) {
                $models[0]->product->main_image = $models[0]->image;
                $models[0]->product->save();
            }
        }
        if ($image){
            $product = Product::findOne($prod_id);
            if ($product){
                if (!$product->main_image){
                    $product->main_image = $image;
                    $product->save(false);
                }
            }

        }
    }

    /**
     * @return bool
     * @throws \yii\base\ErrorException
     * @throws \yii\base\Exception
     */
    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }

    public function afterDelete()
    {
        $this->setMainImage($this->product_id);
        parent::afterDelete();
    }

    /**
     * @param UploadedFile $file
     * @param $currentImage
     * @param $cropInfo
     * @param $dir
     * @return bool|string
     * @throws \yii\base\ErrorException
     * @throws \yii\base\Exception
     */
    public function uploadFile(UploadedFile $file, $currentImage, $cropInfo, $dir)
    {
        $this->uploadImage = $file;
        $this->crop_info = $cropInfo;
        $this->directory = $dir;

        if ($this->validate())
        {
            $this->deleteCurrentImage($currentImage);

            return $this->saveImage();
        }
        return false;
    }


    /**
     * @return string
     * @throws \yii\base\Exception
     */
    private  function getFolder()
    {
        $folder = Yii::getAlias('@uploads') . '/images/product/' . $this->directory . '/';

        if (!is_dir($folder)){
            FileHelper::createDirectory($folder);
        }

        return $folder;
    }


    private function generateFileName()
    {
        return strtolower(md5(uniqid($this->uploadImage->tempName, false)) . '.' . $this->uploadImage->extension);
    }


    /**
     * @param $currentImage
     * @throws \yii\base\ErrorException
     * @throws \yii\base\Exception
     */
    public function deleteCurrentImage($currentImage)
    {
        if ($this->fileExists($currentImage))
        {
            unlink($this->getFolder() . $currentImage);
        }
        if ($this->fileExists('thumb_'. $currentImage))
        {
            unlink($this->getThumbImagePath() . $currentImage);
        }
        $dir = glob($this->getFolder().'*');
        if (empty($dir))
        {
            FileHelper::removeDirectory($this->getFolder());
        }
    }


    /**
     * @param $currentImage
     * @return bool
     * @throws \yii\base\Exception
     */
    public function fileExists($currentImage)
    {
        if (!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getFolder() . $currentImage);
        }
        return false;
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function saveImage()
    {
        $fileName = $this->generateFileName();

        $this->saveThumbnailImage($fileName);

        $this->uploadImage->saveAs($this->getFolder() . $fileName);

        return $fileName;
    }

    /**
     * @param $fileName
     * @throws \yii\base\Exception
     */
    private function saveThumbnailImage($fileName)
    {
        // open image
        $image = Image::getImagine()->open($this->uploadImage->tempName);

        // rendering information about crop of ONE option
        $cropInfo = $this->getCropInfo();

        //saving thumbnail
        $newSizeThumb = new Box($cropInfo['dWidth'], $cropInfo['dHeight']);
        $cropSizeThumb = new Box($cropInfo['width'], $cropInfo['height']); //frame size of crop
        $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);

        $image->resize($newSizeThumb)
            ->crop($cropPointThumb, $cropSizeThumb)
            ->save($this->getThumbImagePath() . $fileName, ['quality' => 100]);
    }

    /**
     * @return mixed
     */
    private function getCropInfo()
    {
        $cropInfo = Json::decode($this->crop_info)[0];
        $cropInfo['dWidth'] = (int)$cropInfo['dWidth']; //new width image
        $cropInfo['dHeight'] = (int)$cropInfo['dHeight']; //new height image
        $cropInfo['x'] = (int)$cropInfo['x']; //begin position of frame crop by X
        $cropInfo['y'] = (int)$cropInfo['y']; //begin position of frame crop by Y
        $cropInfo['width'] = (int)$cropInfo['width']; //width of cropped image
        $cropInfo['height'] = (int)$cropInfo['height']; //height of cropped image

        return $cropInfo;
    }

    /**
     * @return string
     * @throws \yii\base\Exception
     */
    public function getThumbImagePath()
    {
        return $this->getFolder() . '/thumb_';
    }
}
