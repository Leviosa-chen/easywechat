
<?php
/**
 * 授权事件接收地址
 * User: Julian
 * Date: 2018/6/7
 */

include __DIR__ . '/vendor/autoload.php'; // 引入 composer 入口文件

use EasyWeChat\Foundation\Application;

include __DIR__ . '/config.php'; // 引入 配置 入口文件

$app = new Application($options);
$openPlatform = $app->open_platform;
// 默认处理方式
$openPlatform->server->serve();

// 自定义处理

$openPlatform->server->setMessageHandler(function($event ) use ($openPlatform){
    // 事件类型常量定义在 \EasyWeChat\OpenPlatform\Guard 类里
    $myfile = fopen("log.txt", "a");

    switch ($event->InfoType) {
        case 'authorized':
            $authorizationInfo = $openPlatform->getAuthorizationInfo($event->AuthorizationCode)->authorization_info;
            $txt = "授权成功！appid:" . $authorizationInfo["authorizer_appid"] . '  token'.$authorizationInfo["authorizer_access_token"];
            fwrite($myfile, $txt."\n");
            break;
        case 'unauthorized':
            $txt = "授权取消！\n";
            fwrite($myfile, $txt);
            break;
        case 'updateauthorized':
            $authorizationInfo = $openPlatform->getAuthorizationInfo($event->AuthorizationCode)->authorization_info;
            $txt = "更新授权！appid:" . $authorizationInfo["authorizer_appid"] . '  token'.$authorizationInfo["authorizer_access_token"];
            fwrite($myfile, $txt."\n");
            break;
        case 'component_verify_ticket':
            $txt = "component_verify_ticket！\n";
            fwrite($myfile, $txt);
            break;
        default:
            $txt = "default！\n";
            fwrite($myfile, $txt);
            break;
    }
    fclose($myfile);
});

$openPlatform->server->serve();
