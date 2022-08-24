<?php

namespace app\modules\api\controllers;

use Yii;

class UserController extends base\BaseController
{
    public function actionMe()
    {
        // Warning: when returning a model make sure you implement its `field()` method (see Exposing data in the Installing the Yii2-Oauth2-Server guide).
        return Yii::$app->user->identity;
    }
}