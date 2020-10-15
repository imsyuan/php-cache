<?php

namespace Steven\PersistentData;

use InvalidArgumentException;
use Psr\SimpleCache\CacheInterface;

class PersistentDataFactory
{
    private function __construct()
    {
        // a factory constructor should never be invoked
    }

    /**
     * PersistentData generation.
     *
     * @param PersistentDataInterface|string|null $handler
     *
     * @throws InvalidArgumentException If the persistent data handler isn't "session", "memory", or an instance of Psr\SimpleCache\CacheInterface.
     *
     * @return PersistentDataInterface
     */
    public static function createPersistentDataHandler($handler)
    {

        if (!$handler) {
            return session_status() === PHP_SESSION_ACTIVE
                ? new SDKSessionPersistentDataHandler()
                : new SDKMemoryPersistentDataHandler();
        }

        if ($handler instanceof CacheInterface) {
            return $handler;
        }

        if ('session' === $handler) {
            return new FacebookSessionPersistentDataHandler();
        }
        if ('memory' === $handler) {
            return new FacebookMemoryPersistentDataHandler();
        }

        throw new InvalidArgumentException('The persistent data handler must be set to "session", "memory", or be an instance of Psr\SimpleCache\CacheInterface');
    }
}
