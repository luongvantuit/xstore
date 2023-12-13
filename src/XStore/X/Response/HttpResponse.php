<?php

namespace XStore\X\Response;


class HttpResponse
{

    private array $headers;

    private int| null $statusCode;

    private ?HttpResponseJson $json;


    public function __construct()
    {
        $this->headers = [];
        $this->statusCode = null;
        $this->json = null;
    }

    public function headers(array $headers = []): HttpResponse
    {
        $this->headers = $headers;
        return $this;
    }

    public function statusCode(int $code): HttpResponse
    {
        $this->statusCode = $code;
        return $this;
    }

    public function json(?HttpResponseJson $json = null): HttpResponse
    {
        $this->json = $json;
        return $this;
    }


    public function build(): void
    {
        if (!empty($this->headers)) {
            foreach ($this->headers as $header) {
                header($header);
            }
        }
        if ($this->statusCode != null) {
            http_response_code($this->statusCode);
        }
        if ($this->json != null) {
            header("Content-Type: application/json");
            echo json_encode($this->json->toJson());
        }
    }
}
