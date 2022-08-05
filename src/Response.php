<?php

declare(strict_types=1);

namespace Visa;

use Psr\Http\Message\ResponseInterface;

class Response
{
    private int $statusCode;
    private ?string $body = null;
    private ?array $result = null;
    private ?array $payload = null;
    private ?array $metadata = null;

    public function __construct(ResponseInterface $response)
    {
        $this->statusCode = $response->getStatusCode();

        if ($this->statusCode === 204) {
            return;
        }

        $this->body = $response->getBody()->getContents();
        $this->result = json_decode($this->body, true);

        if (!array_key_exists('payload', $this->result)) {
            throw new \Exception('Response body is missing the `payload` key.');
        }

        $this->payload = $this->result['payload'];

        if (array_key_exists('meta', $this->result)) {
            $this->metadata = $this->result['meta'];
        }
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getBody(): ?string
    {
        return $this->body;
    }


    /**
     * @return array|null
     */
    public function getPayload(): ?array
    {
        return $this->payload;
    }

    /**
     * @return array|null
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     * @return array
     */
    public function getResult(): ?array
    {
        return $this->result;
    }
}
