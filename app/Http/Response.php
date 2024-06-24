<?php

namespace App\Http;

class Response
{
    private int $httpCode;
    private array $headers;
    private string $contentType;
    private $content;

    public function __construct(int $httpCode, $content, string $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->contentType = $contentType;
        $this->headers = [];
        $this->addHeader('Content-Type', $contentType);
    }

    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    private function sendHeaders(): void
    {
        http_response_code($this->httpCode);

        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }
    }

    public function sendResponse(): void
    {
        $this->sendHeaders();

        switch ($this->contentType) {
            case 'application/json':
                echo json_encode($this->content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                break;

            case 'text/html':
            default:
                echo $this->content;
                break;
        }

        exit;
    }
}
