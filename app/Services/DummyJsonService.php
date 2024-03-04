<?php
declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class DummyJsonService
{
    protected $client;

    private static $instance = null;

    private function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.dummy.url')
        ]);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function createPost(array $data)
    {
        $endpoint = '/posts/add';
        return $this->send($endpoint, 'POST', $data);
    }

    public function getPostById(int $id)
    {
        $endpoint = sprintf('/posts/%d', $id);

        return $this->send($endpoint);
    }

    public function send(string $endpoint, string $method = 'GET', array $data = [])
    {
        if (in_array($method, ['GET', 'DELETE'])) {
            $options = ['query' => $data];
        } else {
            $options['json'] = $data;
        }

        try {
            $response = $this->client->request($method, $endpoint, $options);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Throwable $e) {
            Log::error(sprintf('Error sending request to %s: %s', $endpoint, $e->getMessage()));
            return [];
        }
    }
}
