<?php

namespace app\modules\api;

use Yii;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // Only allow "stateless" access to the api, for more information see
        // https://www.yiiframework.com/doc/guide/2.0/en/rest-authentication#authentication.
        Yii::$app->user->enableSession = false;
    }
}
