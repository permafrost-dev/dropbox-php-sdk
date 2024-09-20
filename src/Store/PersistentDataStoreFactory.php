<?php

namespace Permafrost\Dropbox\Store;

use InvalidArgumentException;

/**
 * Thanks to Facebook
 *
 * @link https://developers.facebook.com/docs/php/PersistentDataInterface
 */
class PersistentDataStoreFactory
{
    /**
     * Make Persistent Data Store
     *
     * @param  null|string|\Permafrost\Dropbox\Store\PersistentDataStoreInterface  $store
     * @return \Permafrost\Dropbox\Store\PersistentDataStoreInterface
     *
     * @throws InvalidArgumentException
     */
    public static function makePersistentDataStore($store = null)
    {
        if (is_null($store) || $store === 'session') {
            return new SessionPersistentDataStore;
        }

        if ($store instanceof PersistentDataStoreInterface) {
            return $store;
        }

        throw new InvalidArgumentException('The persistent data store must be set to null, "session" or be an instance of use \Permafrost\Dropbox\Store\PersistentDataStoreInterface');
    }
}
