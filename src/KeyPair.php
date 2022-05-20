<?php

declare(strict_types=1);

namespace Haikara\SymbolKeySodium;

class KeyPair
{
    private function __construct(string $key_pair)
    {
        $this->key_pair = $key_pair;
    }

    /**
     * ランダムなキーペアを作成してインスタンス化
     *
     * @return static
     */
    public static function create(): static
    {
        $key_pair = sodium_crypto_sign_keypair();
        return new static($key_pair);
    }

    /**
     * シード値から固定のキーペアを作成してインスタンス化
     *
     * @param string $seed
     * @return void
     */
    public static function createFromSeed(string $seed): static
    {
        if (!static::is32byte($seed)) throw new \Exception;
        $key_pair = sodium_crypto_sign_seed_keypair($seed);
        return new static($key_pair);
    }

    /**
     * 秘密鍵と公開鍵からキーペアを作成する
     *
     * @param SecretKey $secret_key
     * @param PublicKey $public_key
     * @return void
     */
    public function createFromKeys(SecretKey $secret_key, PublicKey $public_key)
    {
        $key_pair = sodium_crypto_sign_keypair_from_secretkey_and_publickey($secret_key->getBin(), $public_key->getBin());
        return new static($key_pair);
    }

    public function getSecret(): SecretKey
    {
        return SecretKey::create($this->key_pair);
    }

    public function getPublic(): PublicKey
    {
        return PublicKey::create($this->key_pair);
    }

    /**
     * 文字列が32バイトであるか
     *
     * @param string $string
     * @return boolean
     */
    private static function is32byte(string $string): bool
    {
        return strlen($string) === 32;
    }
}
