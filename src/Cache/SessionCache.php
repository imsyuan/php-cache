<?php

namespace Steven\Cache;

use Doctrine\Common\Cache\Cache;

/**
 * Class SessionCache
 * @package Steven\Cache
 */
class SessionCache implements Cache{

    private $sessionPrefix = 'ST_';

    public function fetch($id)
    {
        if (isset($_SESSION[$this->sessionPrefix . $id])) {
            return $_SESSION[$this->sessionPrefix . $id];
        }

        return null;
    }

    public function contains($id)
    {
        // TODO: Implement contains() method.
    }

    public function save($id, $data, $lifeTime = 0)
    {
        $_SESSION[$this->sessionPrefix . $id] = $data;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getStats()
    {
        // TODO: Implement getStats() method.
    }
}