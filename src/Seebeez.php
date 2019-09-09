<?php

namespace SeebeezPHP;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Scalar\String_;

/**
 * PHP Client library for Seebeez API.
 * 
 * @category Library
 * @package  SeebeezPHP
 * @author   Kazi Lotus <kazilotus@hotmail.com>
 * @license  https://www.apache.org/licenses/LICENSE-2.0.txt Apache-2.0
 * @version  Release: @1.0@
 * @link     https://seebeez.com
 */
final class Seebeez
{

    private $_exception;

    private $_api_url;
    private $_api_token;

    private $_job_id;

    /**
     * Seebeez Class constructor
     * 
     * @param string $api_url   API url for seebeez
     * @param string $api_token API token
     */
    public function __construct($api_url = '', $api_token = '')
    {

        if (filter_var($api_url, FILTER_VALIDATE_URL) === false) {
            // $exception = $this->_exception;
            // $exception(new Exception('Seebeez API URL is invalid'));
            throw new Exception('Seebeez API URL is invalid');
        }

        $this->_api_url = $api_url;
        $this->_api_token = $api_token;

    }

    /**
     * Callable for forwarding exceptions
     * 
     * @param callable $exception Exception is passed in here
     * 
     * @return null
     */
    // public function exception(callable $exception)
    // {
    //     $this->_exception = $exception;
    // }

    /**
     * Create and dispatch a job
     *
     * @param string $config Encoded parameters body for the API
     *
     * @return array
     */
    public function create(string $config): array
    {
        $options = json_decode($config, true);
        $json = $this->_request("POST", "/job", $options);

        $body = json_decode($json, true);
        if (isset($body['id'])) {
            $this->_job_id = $body['id'];
        }

        return $body;
    }


    /**
     * Get current job progress from API
     * 
     * @param string $id Seebeez job ID
     * 
     * @return array
     */
    public function get(string $id): array
    {

        $json = $this->_request("GET", "/job/$id");

        $response = json_decode($json, true);
        if (isset($response['data'])) {
            $data = $response['data'];
            return $data;
        }

        $id = $this->_job_id;
        $response = $this->_request("GET", "/job/$id");

        if (isset($response['data'])) {
            $data = $response['data'];
            return $data;
        }

        return [];

    }

    /**
     * Make the authenticated HTTP request to seebeez API
     * 
     * @param string $method HTTP request type  
     * @param string $uri    API endpoint
     * @param array  $params API param body
     * 
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     */
    private function _request(string $method, string $uri, array $params = [])
    {

        $uri = (strpos($uri, '/') === 0) ? $this->_api_url . $uri : $this->_api_url . '/' . $uri ;

        $options = [
            'body' => json_encode($params),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->_api_token,
                'User-Agent'    => 'SeebeezClient/1.0',
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Cache-Control' => 'no-cache',
            ],
            'verify' => false
        ];

        $client = new Client();
        // try {
            $res = $client->request($method, $uri, $options);
            return $res->getBody()->getContents();
        // } catch (Exception | GuzzleException $e) {
        //     $exception = $this->_exception;
        //     $exception($e);
        //     return null;
        // }

    }

    /**
     * Set ID of current job instance
     * 
     * @param string $id ID of seebeez instance
     * 
     * @return void
     */
    public function setId(string $id): void
    {
        $this->_job_id = $id;
    }

    /**
     * Get ID of current job instance
     * 
     * @return string
     */
    public function getId(): string
    {
        return $this->_job_id;
    }
}
