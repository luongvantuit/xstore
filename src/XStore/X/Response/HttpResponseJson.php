<?php

namespace XStore\X\Response;

class HttpResponseJson
{
    private bool $success;

    private string|array $message;

    private array| null $data;

    private int|null $total;

    private array|null $meta;

    public function __construct(
        bool $success = true,
        string|array $message = "success",
        array|null $data = null,
        int| null $total = null,
        array|null $meta = null
    ) {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
        $this->total = $total;
        $this->meta = $meta;
    }

    public function toJson(): array
    {
        $json = [
            "success" => $this->success,
            "message" => $this->message
        ];
        if ($this->data != null) {
            $json = array_merge($json, ["data" => $this->data]);
        }
        if ($this->total != null) {
            $json = array_merge($json, ["total" => $this->total]);
        }
        if ($this->meta != null) {
            $json = array_merge($json, ["meta" => $this->meta]);
        }
        return $json;
    }


    public function getSuccess(): bool
    {
        return $this->success;
    }

    public function getMessage(): string|array
    {
        return $this->message;
    }

    public function getData(): array|null
    {
        return $this->data;
    }

    public function getTotal(): int|null
    {
        return $this->total;
    }

    public function getMeta(): array|null
    {
        return $this->meta;
    }

    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
    public function setData(array|null $data): void
    {
        $this->data = $data;
    }
    public function setTotal(int|null $total): void
    {
        $this->total = $total;
    }
    public function setMeta(array|null $meta): void
    {
        $this->meta = $meta;
    }
}
