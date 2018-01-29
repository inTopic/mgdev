<?php

/**
 * Class Sendpulse_Integration_Model_Authorization
 */
class Sendpulse_Integration_Model_Authorization extends Sendpulse_Integration_Model_CLient
{

    private $apiUrl = 'https://api.sendpulse.com';

    private $userId;
    private $secret;
    private $token;

    private $refreshToken = 0;

    /**
     * @var null|TokenStorageInterface
     */
    private $tokenStorage;


    /**
     * Sendpulse API constructor
     *
     * @param TokenStorageInterface $tokenStorage
     *
     * @throws Exception
     */
    public function __construct(TokenStorageInterface $tokenStorage = null)
    {
        if ($tokenStorage === null) {
            $tokenStorage = Mage::getModel('sendpulseintegration/storage_fileStorage', Mage::getBaseDir() . '/app/code/local/Sendpulse/Integration/src/');
        }
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Get token and store it
     *
     * @return bool
     */
    private function getToken()
    {
        $data = array(
            'grant_type' => 'client_credentials',
            'client_id' => $this->userId,
            'client_secret' => $this->secret,
        );

        $requestResult = $this->sendRequest('oauth/access_token', 'POST', $data, false);

        if ($requestResult->http_code !== 200) {
            return false;
        }

        $this->refreshToken = 0;
        $this->token = $requestResult->data->access_token;

        $hashName = md5($this->userId . '::' . $this->secret);
        /** Save token to storage */
        $this->tokenStorage->set($hashName, $this->token);

        return true;
    }

    /**
     * Form and send request to API service
     *
     * @param        $path
     * @param string $method
     * @param array $data
     * @param bool $useToken
     *
     * @return stdClass
     */
    private function sendRequest($path, $method = 'GET', $data = array(), $useToken = true)
    {
        $url = $this->apiUrl . '/' . $path;
        $method = strtoupper($method);
        $curl = curl_init();

        if ($useToken && !empty($this->token)) {
            $headers = array('Authorization: Bearer ' . $this->token);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }

        switch ($method) {
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, count($data));
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                break;
            case 'PUT':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                break;
            case 'DELETE':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                break;
            default:
                if (!empty($data)) {
                    $url .= '?' . http_build_query($data);
                }
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 15);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);

        $response = curl_exec($curl);
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $headerCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $responseBody = substr($response, $header_size);

        curl_close($curl);

        if ($headerCode === 401 && $this->refreshToken === 0) {
            ++$this->refreshToken;
            $this->getToken();
            $retval = $this->sendRequest($path, $method, $data);
        } else {
            $retval = new stdClass();
            $retval->data = json_decode($responseBody);
            $retval->http_code = $headerCode;
        }

        return $retval;
    }

    /**
     * Process results
     *
     * @param $data
     *
     * @return stdClass
     */
    private function handleResult($data)
    {
        if (empty($data->data)) {
            $data->data = new stdClass();
        }
        if ($data->http_code !== 200) {
            $data->data->is_error = true;
            $data->data->http_code = $data->http_code;
        }

        return $data->data;
    }

    /**
     * Process errors
     *
     * @param null $customMessage
     *
     * @return stdClass
     */
    private function handleError($customMessage = null)
    {
        $message = new stdClass();
        $message->is_error = true;
        if (null !== $customMessage) {
            $message->message = $customMessage;
        }

        return $message;
    }


    /*
     * API interface implementation
     */

    /**
     * @param $email
     *
     * @return stdClass
     */
    public function authorization($email){
        $data['email'] = $email;
        $data['app'] = 'magento1';
        $data['hash'] = $this->fromDynamicHashString(array());

        $requestResult = $this->sendRequest('userapi/credential', 'GET', $data);
        return $this->handleResult($requestResult);
    }


    /**
     * has generator
     *
     * @param $params
     *
     * @return mixed
     */
    public static function fromDynamicHashString($params)
    {
        $keyStr = implode(',', $params);
//        $keyStr = self::paramsToString($params);
        $length = strlen($keyStr);
        $str = '';

        for ($i = 0; $i < $length; ++$i) {
            if (($i + 1) % 2 === 0) {
                $str .= $keyStr[$i];
            }
        }
        return strtoupper(hash('sha256', $str));
    }

}
