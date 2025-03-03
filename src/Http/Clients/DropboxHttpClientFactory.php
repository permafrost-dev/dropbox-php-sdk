<?php

namespace Permafrost\Dropbox\Http\Clients;

use GuzzleHttp\Client as Guzzle;
use InvalidArgumentException;

/**
 * DropboxHttpClientFactory
 */
class DropboxHttpClientFactory
{
    /**
     * Make HTTP Client
     *
     * @param  \Permafrost\Dropbox\Http\Clients\DropboxHttpClientInterface|\GuzzleHttp\Client|null  $handler
     * @return \Permafrost\Dropbox\Http\Clients\DropboxHttpClientInterface
     */
    public static function make($handler)
    {
        //No handler specified
        if (! $handler) {
            return new DropboxGuzzleHttpClient;
        }

        //Custom Implementation, maybe.
        if ($handler instanceof DropboxHttpClientInterface) {
            return $handler;
        }

        //Handler is a custom configured Guzzle Client
        if ($handler instanceof Guzzle) {
            return new DropboxGuzzleHttpClient($handler);
        }

        //Invalid handler
        throw new InvalidArgumentException('The http client handler must be an instance of GuzzleHttp\Client or an instance of Permafrost\Dropbox\Http\Clients\DropboxHttpClientInterface.');
    }
}
