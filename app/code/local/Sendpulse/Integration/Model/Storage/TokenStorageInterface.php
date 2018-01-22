<?php

/**
 * Interface TokenStorageInterface
 */

//namespace Sendpulse\RestApi\Storage;

interface Sendpulse_Integration_Model_Storage_TokenStorageInterface
{
    /**
     * @param $key string
     * @param $token
     *
     * @return mixed
     */
    public function set($key, $token);

    /**
     * @param $key string
     *
     * @return mixed
     */
    public function get($key);
}
