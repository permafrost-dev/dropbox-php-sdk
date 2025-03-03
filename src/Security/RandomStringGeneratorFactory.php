<?php

namespace Permafrost\Dropbox\Security;

use InvalidArgumentException;
use Permafrost\Dropbox\Exceptions\DropboxClientException;

/**
 * Thanks to Facebook
 *
 * @link https://developers.facebook.com/docs/php/RandomStringGeneratorInterface
 */
class RandomStringGeneratorFactory
{
    /**
     * Make a Random String Generator
     *
     * @param  null|string|\Permafrost\Dropbox\Security\RandomStringGeneratorInterface  $generator
     * @return \Permafrost\Dropbox\Security\RandomStringGeneratorInterface
     *
     * @throws \Permafrost\Dropbox\Exceptions\DropboxClientException
     */
    public static function makeRandomStringGenerator($generator = null)
    {
        //No generator provided
        if (is_null($generator)) {
            //Generate default random string generator
            return static::defaultRandomStringGenerator();
        }

        //RandomStringGeneratorInterface
        if ($generator instanceof RandomStringGeneratorInterface) {
            return $generator;
        }

        // Mcrypt
        if ($generator === 'mcrypt') {
            return new McryptRandomStringGenerator;
        }

        //OpenSSL
        if ($generator === 'openssl') {
            return new OpenSslRandomStringGenerator;
        }

        //Invalid Argument
        throw new InvalidArgumentException('The random string generator must be set to "mcrypt", "openssl" or be an instance of Permafrost\Dropbox\Security\RandomStringGeneratorInterface');
    }

    /**
     * Get Default Random String Generator
     *
     * @return RandomStringGeneratorInterface
     *
     * @throws \Permafrost\Dropbox\Exceptions\DropboxClientException
     */
    protected static function defaultRandomStringGenerator()
    {
        //Mcrypt
        if (function_exists('mcrypt_create_iv') && version_compare(PHP_VERSION, '7.1', '<')) {
            return new McryptRandomStringGenerator;
        }

        //OpenSSL
        if (function_exists('openssl_random_pseudo_bytes')) {
            return new OpenSslRandomStringGenerator;
        }

        //Unable to create a random string generator
        throw new DropboxClientException('Unable to detect a cryptographically secure pseudo-random string generator.');
    }
}
