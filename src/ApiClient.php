<?php

namespace KeihartOnline\JouwHoesjeApi;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use KeihartOnline\JouwHoesjeApi\Contracts\TokenResolverInterface;
use KeihartOnline\JouwHoesjeApi\Exceptions\ApiException;
use Throwable;

readonly class ApiClient
{
    public function __construct(
        private TokenResolverInterface $tokenResolver
    ) {}

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
            return Cache::driver('array')
                ->rememberForever(
                    'jouw-hoesje-api-request-' . md5($endpoint . json_encode($data)),
                    function () use ($method, $endpoint, $data) {
                        return $this->client()
                            ->$method($endpoint, $data)
                            ->throw();
                    }
                );
        } catch (Throwable $e) {
            Log::error("API {$method} error: {$e->getMessage()}", [
                'endpoint' => $endpoint,
                'data' => $data,
            ]);

            throw $e;
        }
    }

    /**
     * @throws ApiException
     */
    protected function getToken(): string
    {
        $token = $this->tokenResolver->resolveToken();

        if (! $token) {
            throw new ApiException('Geen geldig API-token gevonden');
        }

        return $token;
    }

    /**
     * @throws Exception
     */
    private function client(): PendingRequest
    {
        return Http::withToken($this->getToken())
            ->baseUrl(config('jouwhoesje-api.base_url'))
            ->acceptJson();
    }
}
