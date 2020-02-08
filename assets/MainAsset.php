<?php
namespace app\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://use.fontawesome.com/releases/v5.11.2/css/all.css',
        'public/css/bootstrap.min.css',
        'public/css/mdb.min.css',
        'public/css/style-main.css',
    ];
    public $js = [
        'public/js/popper.min.js',
        'public/js/bootstrap.min.js',
        'public/js/mdb.min.js',
    ];
    public $depends = [
    ];
}
