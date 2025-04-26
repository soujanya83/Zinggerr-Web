<?php

namespace App\Services;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BigBlueButtonService
{
    protected $client;
    protected $baseUrl;
    protected $secret;
    protected $hashingAlgorithm;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('bbb.server_base_url') . 'api/';
        $this->secret = config('bbb.secret');
        $this->hashingAlgorithm = config('bbb.hashing_algorithm');
    }

    /**
     * Generate checksum for BBB API calls
     */
    protected function generateChecksum($action, $params)
    {
        $queryString = http_build_query($params, '', '&', PHP_QUERY_RFC3986);
        $stringToHash = $action . $queryString . $this->secret;
        return hash($this->hashingAlgorithm, $stringToHash);
    }

    /**
     * Create a new meeting
     */
    public function createMeeting($meetingName, $meetingID, $options = [])
    {
        $action = 'create';
        $params = array_merge([
            'name' => $meetingName,
            'meetingID' => $meetingID,
            'attendeePW' => 'ap', // Attendee password
            'moderatorPW' => 'mp', // Moderator password
            'welcome' => 'Welcome to ' . $meetingName,
            'record' => 'true', // Enable recording
            'autoStartRecording' => 'false',
            'allowStartStopRecording' => 'true',
        ], $options);

        $params['checksum'] = $this->generateChecksum($action, $params);

        try {
            $response = $this->client->get($this->baseUrl . $action, [
                'query' => $params,
            ]);

            $xml = simplexml_load_string($response->getBody()->getContents());
            return [
                'returncode' => (string) $xml->returncode,
                'message' => (string) $xml->message,
                'meetingID' => (string) $xml->meetingID,
            ];
        } catch (\Exception $e) {
            Log::error('BBB Create Meeting Error: ' . $e->getMessage());
            return ['returncode' => 'FAILED', 'message' => $e->getMessage()];
        }
    }

    /**
     * Generate a join URL for a meeting
     */
    public function joinMeeting($fullName, $meetingID, $password, $isModerator = false)
    {
        $action = 'join';
        $params = [
            'fullName' => $fullName,
            'meetingID' => $meetingID,
            'password' => $password,
            'redirect' => 'true',
        ];

        $params['checksum'] = $this->generateChecksum($action, $params);
        return $this->baseUrl . $action . '?' . http_build_query($params);
    }

    /**
     * End a meeting
     */
    public function endMeeting($meetingID, $moderatorPassword)
    {
        $action = 'end';
        $params = [
            'meetingID' => $meetingID,
            'password' => $moderatorPassword,
        ];

        $params['checksum'] = $this->generateChecksum($action, $params);

        try {
            $response = $this->client->get($this->baseUrl . $action, [
                'query' => $params,
            ]);

            $xml = simplexml_load_string($response->getBody()->getContents());
            return [
                'returncode' => (string) $xml->returncode,
                'message' => (string) $xml->message,
            ];
        } catch (\Exception $e) {
            Log::error('BBB End Meeting Error: ' . $e->getMessage());
            return ['returncode' => 'FAILED', 'message' => $e->getMessage()];
        }
    }

    public function getRecordings($meetingID)
    {
        $action = 'getRecordings';
        $params = ['meetingID' => $meetingID];
        $params['checksum'] = $this->generateChecksum($action, $params);

        try {
            $response = $this->client->get($this->baseUrl . $action, [
                'query' => $params,
            ]);

            $xml = simplexml_load_string($response->getBody()->getContents());
            $recordings = [];
            if ($xml->recordings && $xml->recordings->recording) {
                foreach ($xml->recordings->recording as $recording) {
                    $recordings[] = [
                        'recordID' => (string) $recording->recordID,
                        'meetingID' => (string) $recording->meetingID,
                        'name' => (string) $recording->name,
                        'published' => (string) $recording->published,
                        'playbackUrl' => (string) $recording->playback->format->url,
                    ];
                }
            }

            return [
                'returncode' => (string) $xml->returncode,
                'recordings' => $recordings,
            ];
        } catch (\Exception $e) {
            Log::error('BBB Get Recordings Error: ' . $e->getMessage());
            return ['returncode' => 'FAILED', 'message' => $e->getMessage()];
        }
    }
}
