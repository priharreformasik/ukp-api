<?php

namespace App\Providers;

use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\PasswordGrant;
use Laravel\Passport\PassportServiceProvider as BasePassportServiceProvider;
use Laravel\Passport\Passport;

class PassportServiceProvider extends BasePassportServiceProvider
{
    /**
     * Create and configure a Password grant instance.
     *
     * @return PasswordGrant
     */
    protected function makePasswordGrant()
    {
        $grant = new PasswordGrant(
            $this->app->make(\App\Repositories\PassportUserRepository::class),
            $this->app->make(\Laravel\Passport\Bridge\RefreshTokenRepository::class)
        );

        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());

        return $grant;
    }

}