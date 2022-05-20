<?php

declare(strict_types=1);

namespace Haikara\SymbolKeySodium;

class PublicKey extends Key
{
    protected readonly string $key;

    private function __construct(string $key)
    {
        if (!static::is32Byte($key)) throw new \Exception();
        $this->key = $key;
    }

    /**
     * 署名を検証し、成功すれば文字列を返す。
     * 失敗すれば例外を投げる。
     *
     * @param string $signed_message
     * @return string
     * @throws \Exception
     */
    public function verify(string $signed_message): string
    {
        $opend_message = sodium_crypto_sign_open($signed_message, $this->key);

        return (is_string($opend_message)) ? $opend_message : throw new \Exception();
    }

    public static function create(string $key_pair): static
    {
        return new static(sodium_crypto_sign_publickey($key_pair));
    }

    public static function createFromSecret(SecretKey $s_key): static
    {
        $pk_str = sodium_crypto_sign_publickey_from_secretkey($s_key->getBin());
        return new static($pk_str);
    }

    private static function is32byte(string $string): bool
    {
        return strlen($string) === 32;
    }
}
