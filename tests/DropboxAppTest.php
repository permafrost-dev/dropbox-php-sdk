<?php

use Permafrost\Dropbox\DropboxApp;

it('can be instantiated with clientId, clientSecret, and accessToken', function () {
    $clientId = 'test-client-id';
    $clientSecret = 'test-client-secret';
    $accessToken = 'test-access-token';

    $app = new DropboxApp($clientId, $clientSecret, $accessToken);

    expect($app)->toBeInstanceOf(DropboxApp::class);
    expect($app->getClientId())->toBe($clientId);
    expect($app->getClientSecret())->toBe($clientSecret);
    expect($app->getAccessToken())->toBe($accessToken);
});

it('can be instantiated without accessToken', function () {
    $clientId = 'test-client-id';
    $clientSecret = 'test-client-secret';

    $app = new DropboxApp($clientId, $clientSecret);

    expect($app)->toBeInstanceOf(DropboxApp::class);
    expect($app->getClientId())->toBe($clientId);
    expect($app->getClientSecret())->toBe($clientSecret);
    expect($app->getAccessToken())->toBeNull();
});

it('returns the correct clientId', function () {
    $clientId = 'test-client-id';
    $app = new DropboxApp($clientId, 'test-client-secret');

    expect($app->getClientId())->toBe($clientId);
});

it('returns the correct clientSecret', function () {
    $clientSecret = 'test-client-secret';
    $app = new DropboxApp('test-client-id', $clientSecret);

    expect($app->getClientSecret())->toBe($clientSecret);
});

it('returns the correct accessToken', function () {
    $accessToken = 'test-access-token';
    $app = new DropboxApp('test-client-id', 'test-client-secret', $accessToken);

    expect($app->getAccessToken())->toBe($accessToken);
});

it('accessToken is null when not provided', function () {
    $app = new DropboxApp('test-client-id', 'test-client-secret');

    expect($app->getAccessToken())->toBeNull();
});
