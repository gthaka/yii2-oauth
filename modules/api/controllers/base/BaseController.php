<?php

namespace app\modules\api\controllers\base;

use rhertogh\Yii2Oauth2Server\filters\auth\Oauth2HttpBearerAuth;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;

class BaseController extends Controller
{
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'authenticator' => [
                // Use Oauth2HttpBearerAuth. To support multiple authentication methods please see:
                // https://www.yiiframework.com/doc/guide/2.0/en/rest-authentication#authentication
                'class' => Oauth2HttpBearerAuth::class,
            ],
        ]);
    }
}