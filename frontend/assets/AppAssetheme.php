<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        "vendor/fontawesome-free/css/all.min.css",
        "theme/vendor/owl-carousel/css/owl.carousel.min.css",
        "theme/vendor/owl-carousel/css/owl.theme.default.min.css",
        "theme/vendor/jqvmap/css/jqvmap.min.css",
        "theme/css/style.css",
    
        
    ];
    public $js = [
        'theme/js/dashboard/dashboard-1.js',
        'theme/vendor/jqvmap/js/jquery.vmap.min.js',
        'theme/vendor/jqvmap/js/jquery.vmap.usa.js',
        'theme/vendor/jquery.counterup/jquery.counterup.min.js',
        'theme/vendor/global/global.min.js',
        'theme/js/quixnav-init.js',
        'theme//js/custom.min.js',
        'theme/vendor/raphael/raphael.min.js',
        'theme/vendor/morris/morris.min.js',
        'theme/vendor/circle-progress/circle-progress.min.js',
        'theme/vendor/chart.js/Chart.bundle.min.js',
        'theme/vendor/gaugeJS/dist/gauge.min.js',
        'theme/vendor/flot/jquery.flot.js',
        'theme/vendor/flot/jquery.flot.resize.js',
        'theme/vendor/owl-carousel/js/owl.carousel.min.js',
    
    
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        'rmrevin\yii\fontawesome\CdnProAssetBundle',
    ];
}
