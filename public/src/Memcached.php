<?php

namespace App;

/**
 * A singleton wrapper for implementing requests to memcache
 */
class Memcached
{
    private static $instance;

    /**
     * Get the instance of Memcached.
     * @return \Memcached
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::initialize();
        }
        return self::$instance;
    }

    /**
     * Initialize the Memcached instance.
     */
    private static function initialize()
    {
        self::$instance = new \Memcached();
        self::$instance->addServer(Config::get('memcachedHost'), Config::get('memcachedPort'));
    }

    /**
     * Singletons should not be restorable from strings.
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a singleton.');
    }

    /**
     * Private constructor to prevent external instantiation.
     */
    private function __construct() {}

    /**
     * Private clone method to prevent cloning of the instance.
     */
    private function __clone() {}
}