<?php

namespace App\Api;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class ApiClient
{
    private string $baseUrl;

    private array $tokens;

    private string $token;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url');
        $this->tokens = config('services.api.tokens');
    }

    /**
     * @throws Throwable
     */
    public function get(string $endpoint, array $query = []): Response
    {
        return $this->request('get', $endpoint, $query);
    }

    /**
     * @throws Throwable
     */
    public function post(string $endpoint, array $data = []): Response
    {
        return $this->request('post', $endpoint, $data);
    }

    /**
     * @throws Throwable
     */
    public function put(string $endpoint, array $data = []): Response
    {
        return $this->request('put', $endpoint, $data);
    }

    /**
     * @throws Throwable
     */
    public function delete(string $endpoint): Response
    {
        return $this->request('delete', $endpoint);
    }

    /**
     * @throws Throwable
     */
    private function request(string $method, string $endpoint, array $data = []): Response
    {
        try {
            $response = $this->client()->$method($endpoint, $data);
            $response->throw();

            return $response;
        } catch (Throwable $e) {
            Log::error("API {$method} error: {$e->getMessage()}", [
                'endpoint' => $endpoint,
                'data' => $data,
                'domain' => $this->getDomain(),
            ]);

            throw $e;
        }
    }

    private function getDomain(): string
    {
        return Str::replace(
            ['www.', '.test'],
            '',
            request()->getHost()
        );
    }

    /**
     * @throws Exception
     */
    private function getToken(): string
    {
        if (isset($this->token)) {
            return $this->token;
        }

        $domain = $this->getDomain();

        if (! isset($this->tokens[$domain])) {
            throw new Exception("Geen API-token geconfigureerd voor domein: {$domain}");
        }

        return $this->token = $this->tokens[$domain];
    }

    /**
     * @throws Exception
     */
    private function client(): PendingRequest
    {
        return Http::withToken($this->getToken())
            ->baseUrl($this->baseUrl)
            ->acceptJson();
    }
}
