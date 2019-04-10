<?php
/**
 * 公众号授权回调地址
 * User: Julian
 * Date: 2018/6/7
 */

include __DIR__ . '/vendor/autoload.php'; // 引入 composer 入口文件
include __DIR__ . '/config.php'; // 引入 配置 入口文件

use EasyWeChat\Foundation\Application;


$app          = new Application($options);
$openPlatform = $app->open_platform;

//使用授权码换取公众号的接口调用凭据和授权信息
$authorizer = $openPlatform->authorizer;
// Optional: $authorizationCode 不传值时会自动获取 URL 中 auth_code 值
$authorizer->getAuthorizationInfo($authorizationCode = null);

//获取授权方的公众号帐号基本信息
$authorizer = $openPlatform->authorizer;

$authorizer      = \EasyWeChat\OpenPlatform\Authorizer::find($id);
$authorizerAppId = $authorizer->app_id;
$info =  $authorizer->getAuthorizerInfo($authorizerAppId);
var_dump($info);

//获取授权方的选项设置信息
$setting = $authorizer = $openPlatform->authorizer;
var_dump($setting);
