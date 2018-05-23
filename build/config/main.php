<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-build',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'build\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => '/index/index',
    'modules' => [
        'build' => [
            'class' => 'build\modules\build\Build',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'admin_auth_item',
            'assignmentTable' => 'admin_auth_assignment',
            'itemChildTable' => 'admin_auth_item_child',
            'ruleTable' => 'admin_auth_rule',
        ],
        'request' => [
            'csrfParam' => '_csrf-build',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-build', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the build
            'name' => 'advanced-build',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'index/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
