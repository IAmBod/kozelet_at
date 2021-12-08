<?php

declare(strict_types=1);

namespace App\Integration\Pek;

use App\Integration\Pek\Requests\Users\UsersResponse;
use RuntimeException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class PekHttpClient implements PekClientInterface
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private SerializerInterface $serializer
    ) {

    }

    public function getUsersWithSocialPoints(): array
    {
        /** @var UsersResponse $response */
        $response = $this->get('users', UsersResponse::class);

        return $response->getUsers();
    }

    private function get(string $path, ?string $type = null): mixed
    {
        return $this->request('GET', $path, $type);
    }

    private function request(string $method, string $path, ?string $type = null): mixed
    {
        $response = $this->httpClient->request($method, $path);

        $this->checkResponse($response);

        if ($type === null) {
            return $response->getContent();
        }

        return $this->serializer->deserialize($response->getContent(), $type, 'json');
    }

    private function checkResponse(ResponseInterface $response): void
    {
        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException();
        }

        if ($response->getHeaders()['content-type'][0] !== 'application/json') {
            throw new RuntimeException();
        }
    }
}