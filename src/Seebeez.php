<?php

namespace SeebeezPHP;

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
final class Seebeez extends Helper
{

    protected $api_url = "https://beta.seebeez.com/api/v1";

    private $_job_id;

    /**
     * Seebeez Class constructor
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
     * Create and dispatch a job
     *
     * @param string $config Encoded parameters body for the API
     *
     * @return array
     */
    public function create(string $config): array 
    {
        $options = json_decode($config, true);
        $json = $this->request("POST", "/job", $options);

        $body = json_decode($json, true);
        if (isset($body['id'])) {
            $this->_job_id = $body['id'];
        }

        return $body;
    }

    /**
     * Get current job progress from API
     * 
     * @return array
     */
    public function get(): array 
    {
        $jid = $this->_job_id;
        $json = $this->request("GET", "/job/$jid");

        $body = json_decode($json, true);
        if (isset($body['data'])) {
            $data = $body['data'];
            return $data;
        }

        return [];
    }

    /**
     * Cancel current job progress from API
     * 
     * @return array
     */
    public function cancel(): array 
    {
        $jid = $this->_job_id;
        $json = $this->request("DELETE", "/job/$jid");

        return json_decode($json, true);
    }

    /**
     * Set Seebeez Auth Token of current job instance
     * 
     * @param string $token API token
     * 
     * @return void
     */
    public function setToken(string $token): void
    {
        $this->api_token = $token;
    }

    /**
     * Set a new ID for job instance
     * 
     * @param string $jid ID of seebeez instance
     * 
     * @return void
     */
    public function setId(string $jid): void
    {
        $this->_job_id = $jid;
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
