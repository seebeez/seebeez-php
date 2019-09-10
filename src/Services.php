<?php

namespace SeebeezPHP;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * PHP Client library for Seebeez Services API.
 * 
 * @category Library
 * @package  SeebeezPHP
 * @author   Kazi Lotus <kazilotus@hotmail.com>
 * @license  https://www.apache.org/licenses/LICENSE-2.0.txt Apache-2.0
 * @version  Release: @1.0@
 * @link     https://seebeez.com
 */
final class Services
{

    private $_api_url = 'https://service.seebeez.com/apps';

    /**
     * Seebeez Services Class constructor
     * 
     * @return void
     */
    public function __construct()
    {
        return;
    }

    /**
     * YoutubeDL API service
     *
     * @param string $url    Link to be used for youtube-dl
     * @param string $format File format for youtube-dl info
     * @param string $method HTTP request method
     *
     * @return array
     */
    public function youtubeDL(
        string $url, 
        string $format, 
        string $method = "POST"
    ): array {
        $app_endpoint = '/youtube-dl/json';
        
        $params = [
            'link' => $url,  //todo: validate ytdl url
            'format' => $format
        ];

        $json = $this->_request($method, $app_endpoint, $params);
        $body = json_decode($json, true);

        return $body;
    }

    /**
     * Make the HTTP request to Seebeez services API
     * 
     * @param string $method HTTP request type  
     * @param string $uri    API endpoint
     * @param array  $params API param body
     * 
     * @return mixed|null|\Psr\Http\Message\ResponseInterface
     */
    private function _request(string $method, string $uri, array $params = [])
    {
        $uri = (strpos($uri, '/') === 0) 
        ? $this->_api_url . $uri 
        : $this->_api_url . '/' . $uri;

        $options = [
            'body' => json_encode($params),
            'headers' => [
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
     * Set API endpoint
     * 
     * @param string $url ID of seebeez instance
     * 
     * @return void
     */
    public function setAPI(string $url): void
    {
        $this->_api_url = $url;
    }

}
