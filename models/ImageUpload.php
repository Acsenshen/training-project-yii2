<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg, png'],
        ];
    }

    // Основная функция
    public function upload(UploadedFile $file, $oldNameFile)
    {
        $this->image = $file;

        if ($this->validate() && $this->checkFolder()) {
            $this->deleteOldImage($oldNameFile);
            return $this->saveImage();
        }
    }

    // Путь до папки
    public function getFolder()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }


    // Проверка существования папки
    public function checkFolder()
    {
        $folder = $this->getFolder();

        if (!file_exists($folder)) {
            return mkdir($folder, 0777, true);
        } else {
            return true;
        }
    }

    // Проверка на существования файла
    public function fileExist($oldNameFile)
    {
        if (!empty($oldNameFile) && $oldNameFile != null) {
            return file_exists($this->getFolder() . $oldNameFile);
        }
    }

    // Генерация уникального названия
    private function generateFileName()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    // Удаление старой картинки
    public function deleteOldImage($oldNameFile)
    {
        if ($this->fileExist($oldNameFile)) {
            unlink($this->getFolder() . $oldNameFile); // Удаляем старую картинку
        }
    }

    // Функция сохрания
    private function saveImage()
    {
        $newfileName = $this->generateFileName();
        $this->image->saveAs($this->getFolder() . $newfileName);
        return $newfileName;
    }
}
