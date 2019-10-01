<?php

namespace SeebeezPHP;

use GuzzleHttp\Client;

/**
 * PHP Client library for Seebeez Services API.
 *
 * @category Library
 *
 * @author   Kazi Lotus <kazilotus@hotmail.com>
 * @license  https://www.apache.org/licenses/LICENSE-2.0.txt Apache-2.0
 *
 * @version  Release: @1.0@
 *
 * @link     https://seebeez.com
 */
final class Services extends Helper
{
    protected $api_url = 'https://service.seebeez.com/apps';

    /**
     * Seebeez Services Class constructor.
     *
     * @param string $api_url API url for seebeez
     */
    public function __construct($api_url = null)
    {
        if ($api_url != null) {
            $this->api_url = $api_url;
        }
    }

    /**
     * YoutubeDL API service.
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
        string $method = 'POST'
    ): array {
        $app_endpoint = '/youtube-dl/json';

        $params = [
            'link'   => $url,  //todo: validate ytdl url
            'format' => $format,
        ];

        $json = $this->request($method, $app_endpoint, $params);
        $body = json_decode($json, true);

        return $body;
    }

    /**
     * Set API endpoint.
     *
     * @param string $url ID of seebeez instance
     *
     * @return void
     */
    public function setAPI(string $url): void
    {
        $this->api_url = $url;
    }
}
