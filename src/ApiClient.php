<?php

namespace KeihartOnline\JouwHoesjeApi;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use KeihartOnline\JouwHoesjeApi\Contracts\TokenResolverInterface;
use KeihartOnline\JouwHoesjeApi\Exceptions\ApiException;
use Throwable;

class ApiClient
{
    private ?string $cartToken = null;

    private ?string $orderToken = null;

    private bool $throwError = true;

    private ?UploadedFile $file = null;

    private ?int $timeout = null;

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
            return $this->client()
                ->$method($endpoint, $data)
                ->throwIf($this->throwError);
        } catch (Throwable $e) {
            Log::error("API {$method} error: {$e->getMessage()}", [
                'endpoint' => $endpoint,
                'data' => $data,
            ]);

            throw $e;
        }
    }

    public function setCartToken(?string $cartToken = null): void
    {
        $this->cartToken = $cartToken;
    }

    public function setOrderToken(?string $orderToken = null): void
    {
        $this->orderToken = $orderToken;
    }

    public function throwError(bool $value = true): self
    {
        $this->throwError = $value;

        return $this;
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

    public function setAttachment(UploadedFile $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @throws Exception
     */
    private function client(): PendingRequest
    {
        return Http::withToken($this->getToken())
            ->when(
                $this->cartToken !== null,
                fn ($client) => $client->withHeader(
                    'X-Cart-Token',
                    $this->cartToken
                )
            )
            ->when(
                $this->orderToken !== null,
                fn ($client) => $client->withHeader(
                    'X-Order-Token',
                    $this->orderToken
                )
            )
            ->when(
                $this->timeout !== null,
                fn ($client) => $client->timeout($this->timeout)
            )
            ->when(
                isset($this->file),
                function ($client) {
                    $file = $this->file;
                    $this->file = null;

                    return $client->attach(
                        'file',
                        $file->get(),
                        $file->getClientOriginalName(),
                        [
                            'Content-Type' => $file->getMimeType(),
                        ]
                    );
                }
            )
            ->baseUrl(config('jouwhoesje-api.base_url'))
            ->acceptJson();
    }
}
