<?php

namespace App\Models\MessagesSender;

class SenderResponse
{
    protected static $response = [];

    /**
     * Sets the value of a key in the response array.
     *
     * @param string $key The key of the value to be set.
     * @param mixed $value The value to be set.
     *
     * @return void
     */
    public static function setResponse(string $key, $value)
    {
        self::$response[$key] = $value;
    }

    /**
     * Get the response for the given key.
     *
     * @param string $key The key to retrieve the response.
     *
     * @return mixed|null The response for the given key, or null if the key does not exist.
     */
    public static function getResponse(string $key)
    {
        if (!array_key_exists($key, self::$response)) {
            return null;
        }
        return self::$response[$key];
    }
}