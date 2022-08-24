<?php

namespace app\models;

use rhertogh\Yii2Oauth2Server\interfaces\models\external\user\Oauth2UserInterface;
use rhertogh\Yii2Oauth2Server\models\traits\Oauth2UserIdentifierTrait;

class User extends \Da\User\Model\User implements Oauth2UserInterface
{
    use Oauth2UserIdentifierTrait;

    public function getIdentifier()
    {
        // TODO: Implement getIdentifier() method.
    }
}
