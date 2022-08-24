<?php

use rhertogh\Yii2Oauth2Server\Oauth2Module;
use yii\symfonymailer\Mailer;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'oauth-server',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'oauth2',
        'log'
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'atzMTLMwAw9QbMbEqYhb5e_zYk6-SFlz',
        ],
        'authManager' => [
            'class' => 'Da\User\Component\AuthDbManagerComponent',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                ],
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
            // ...other configs from here: [Configuration Options](installation/configuration-options.md), e.g.
            // 'administrators' => ['admin'], // this is required for accessing administrative actions
            // 'generatePasswords' => true,
            // 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
        ],
        'oauth2' => [
            'class' => rhertogh\Yii2Oauth2Server\Oauth2Module::class,
            'identityClass' => app\models\User::class, // The Identity Class of your application (most likely the same as the 'identityClass' of your application's User Component)
            'privateKey' => $_ENV['PRIVATE_KEY_PATH'], // Path to the private key generated in step 1. Warning: make sure the path is outside the web-root.
            'publicKey' => $_ENV['PUBLIC_KEY_PATH'], // Path to the public key generated in step 1.
            'privateKeyPassphrase' => $_ENV['YII2_OAUTH2_SERVER_PRIVATE_KEY_PASSPHRASE'], // The private key passphrase (if used in step 1).
            'codesEncryptionKey' => $_ENV['YII2_OAUTH2_SERVER_CODES_ENCRYPTION_KEY'], // The encryption key generated in step 2.
            'storageEncryptionKeys' => [ // For ease of use this can also be a JSON encoded string.
                // The index represents the name of the key, this can be anything you like.
                // However, for keeping track of different keys using (or prefixing it with) a date is advisable.
                '2021-01-01' => $_ENV['YII2_OAUTH2_SERVER_STORAGE_ENCRYPTION_KEY'], // The encryption key generated in step 2.
            ],
            'defaultStorageEncryptionKey' => '2021-01-01', // The index of the default key in storageEncryptionKeys
            'grantTypes' => [ // For more information which grant types to use, please see https://oauth2.thephpleague.com/authorization-server/which-grant/
                Oauth2Module::GRANT_TYPE_AUTH_CODE,
                Oauth2Module::GRANT_TYPE_REFRESH_TOKEN,

                // Other possibilities are:
                // Oauth2Module::GRANT_TYPE_CLIENT_CREDENTIALS,

                // Legacy possibilities (not recommended, but still supported) are:
                // Oauth2Module::GRANT_TYPE_IMPLICIT, // Legacy Grant Type, see https://oauth.net/2/grant-types/implicit/
                // Oauth2Module::GRANT_TYPE_PASSWORD, // Legacy Grant Type, see https://oauth.net/2/grant-types/password/
            ],
            'migrationsNamespace' => 'app\\migrations\\oauth2', // The namespace with which migrations will be created (and by which they will be located).
            'enableOpenIdConnect' => true, // Only required if OpenID Connect support is required
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
