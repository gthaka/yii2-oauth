<?php

namespace app\models;

use rhertogh\Yii2Oauth2Server\interfaces\models\external\user\Oauth2UserInterface;
use rhertogh\Yii2Oauth2Server\models\traits\Oauth2UserIdentifierTrait;

/**
 *
 * @property-read void $identifier
 */
class User extends \Da\User\Model\User implements Oauth2UserInterface
{
    use Oauth2UserIdentifierTrait;
    public function fields(): array
    {
        return [
            'id',
            'username',
            // ... (Define other fields here that are safe to share)
        ];
    }
    public function getIdentifier(): string
    {
        return 'id';
    }
}
