<?php
/**
 * 授权给第三方平台之后的回调
 * User: Julian
 * Date: 2018/6/7
 */

include __DIR__ . '/vendor/autoload.php'; // 引入 composer 入口文件
include __DIR__ . '/config.php'; // 引入 配置 入口文件

use EasyWeChat\Foundation\Application;


$app          = new Application($options);
$openPlatform = $app->open_platform;

//第三方必须使用 authorizer_access_token 而不是原来的 access_token 来调用 API。替换原来的 access token:
$app->access_token = $app->open_platform->authorizer_token;
// 加载授权方信息，比如 $authorizer = Authorizer::find($id);
$authorizer = \EasyWeChat\OpenPlatform\Authorizer::find($id);
$authorizerAppId = $authorizer->app_id;

$app->open_platform->authorization->setAuthorizerAppId($authorizerAppId);
//获取预授权网址
$callback     = $appurl.'callbackFromAccounts'; //授权成功回调地址
$openPlatform->pre_auth->setRedirectUri($callback)->getAuthLink();