<?php

namespace SeebeezPHP;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

use Exception;

/**
 * Helper Class for Seebeez library files.
 * 
 * @category Library
 * @package  SeebeezPHP
 * @author   Kazi Lotus <kazilotus@hotmail.com>
 * @license  https://www.apache.org/licenses/LICENSE-2.0.txt Apache-2.0
 * @version  Release: @1.0@
 * @link     https://seebeez.com
 */
class Helper
{

    protected $api_url;
    protected $api_token;

    protected $exception;

    /**
     * Callable function to return exceptions
     * 
     * @param callable $exception Callable anonymous function
     * 
     * @return void
     */
    public function exception(callable $exception)
    {
        $this->exception = $exception;
    }

    /**
     * Make the authenticated HTTP request to seebeez API
     * 
     * @param string $method HTTP request type  
     * @param string $ept    API endpoint
     * @param array  $params API param body
     * 
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     */
    protected function request(string $method, string $ept, array $params = [])
    {
        $api = $this->api_url;
        $uri = (strpos($ept, '/') === 0) ? "$api$ept" : "$api/$ept";

        $options = [
            'body' => json_encode($params),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->api_token,
                'User-Agent'    => 'SeebeezClient/1.0',
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Cache-Control' => 'no-cache',
            ],
            'verify' => false
        ];

        $client = new Client();
        try {
            $res = $client->request($method, $uri, $options);
            return $res->getBody()->getContents();
        } catch (Exception | GuzzleException $e) {
            if (is_callable($this->exception)) {
                call_user_func($this->exception, $e);
            }
            return null;
        }
    }

}
