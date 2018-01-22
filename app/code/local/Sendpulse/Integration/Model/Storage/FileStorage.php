<?php

/**
 * File token storage
 * Class File
 */

//namespace Sendpulse\RestApi\Storage;

class Sendpulse_Integration_Model_Storage_FileStorage implements Sendpulse_Integration_Model_Storage_TokenStorageInterface
{

    /**
     * @var string
     */
    protected $storageFolder = '';

    /**
     * File constructor.
     *
     * @param string $storageFolder
     */
    public function __construct($storageFolder = '')
    {
        $this->storageFolder = $storageFolder;
    }

    /**
     * @param $key string
     * @param $token
     *
     * @return void
     */
    public function set($key, $token)
    {
        $tokenFile = fopen($this->storageFolder . $key, 'wb');
        fwrite($tokenFile, $token);
        fclose($tokenFile);
    }

    /**
     * @param $key string
     *
     * @return mixed
     */
    public function get($key)
    {
        //
        $filePath = $this->storageFolder . $key;
        if (file_exists($filePath)) {
            return file_get_contents($filePath);
        }

        return null;
    }
}
