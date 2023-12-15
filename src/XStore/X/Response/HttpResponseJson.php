<?php

namespace XStore\X\Response;

class HttpResponseJson
{
    private bool $success;

    private string $message;

    private array| null $data;

    private int|null $total;

    private array|null $meta;

    public function __construct(
        bool $success = true,
        string $message = "success",
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


    public function get_success(): bool
    {
        return $this->success;
    }

    public function get_message(): string
    {
        return $this->message;
    }

    public function get_data(): array|null
    {
        return $this->data;
    }

    public function get_total(): int|null
    {
        return $this->total;
    }

    public function get_meta(): array|null
    {
        return $this->meta;
    }

    public function set_success(bool $success): void
    {
        $this->success = $success;
    }
    public function set_message(string $message): void
    {
        $this->message = $message;
    }
    public function set_data(array|null $data): void
    {
        $this->data = $data;
    }
    public function set_total(int|null $total): void
    {
        $this->total = $total;
    }
    public function set_meta(array|null $meta): void
    {
        $this->meta = $meta;
    }
}
