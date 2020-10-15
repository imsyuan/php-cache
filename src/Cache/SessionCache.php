<?php

namespace Steven\Cache;

//use Doctrine\Common\Cache\Cache;
//use Doctrine\Common\Cache\CacheProvider;
use Steven\PersistentData\PersistentDataInterface;

/**
 * Class SessionCache
 * @package Steven\Cache
 */
class SessionCache implements PersistentDataInterface{

    protected $sessionPrefix = 'STxxx_';

    public function get($key)
    {
        if (isset($_SESSION[$this->sessionPrefix . $key])) {
            return $_SESSION[$this->sessionPrefix . $key];
        }

        return null;
    }

    public function set($key, $value)
    {
        $_SESSION[$this->sessionPrefix . $key] = $value;
    }
}