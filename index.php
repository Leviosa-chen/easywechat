<?php
/**
 * 第三方授权
 * User: Julian
 * Date: 2018/6/7
 */
include __DIR__ . '/vendor/autoload.php'; // 引入 composer 入口文件

use EasyWeChat\Foundation\Application;

include __DIR__ . '/config.php'; // 引入 配置 入口文件

$app          = new Application($options);
$openPlatform = $app->open_platform;
$callback     = $appurl.'callbackFromPlatform'; //授权成功回调地址
$response     = $openPlatform->pre_auth->redirect($callback);
$url          = $response->getTargetUrl();
header('Location:' . $url);
