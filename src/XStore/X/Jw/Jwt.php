<?php


namespace XStore\X\Jw;

use Exception;
use Firebase\JWT\JWT as FirebaseJwt;
use Firebase\JWT\Key;
use XStore\X\Jw\Exceptions\InvalidTokenException;

class Jwt extends AbstractJwt
{
    private string $secret_key;

    private string $algorithm;

    private Key $key;

    public function __construct(string $secret_key, string $algorithm = 'HS256')
    {
        $this->secret_key = $secret_key;
        $this->algorithm = $algorithm;
        $this->key = new Key($this->secret_key, $this->algorithm);
    }

    public function encode(array $payload): string
    {
        return FirebaseJwt::encode($payload, $this->secret_key, $this->algorithm);
    }

    public function decode(string $jwt): array
    {
        try {
            $payload = FirebaseJwt::decode($jwt, $this->key);
            return (array) $payload;
        } catch (Exception) {
            throw new InvalidTokenException();
        }
        return [];
    }
}
