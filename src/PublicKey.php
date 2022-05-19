<?php

declare(strict_types=1);

namespace Haikara\SymbolKeySodium;

class PublicKey extends Key
{
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

    public static function createFromKeyPair(string $key_pair)
    {
        if (!self::is96byte($key_pair)) throw new \Exception();

        $pk_str = sodium_crypto_sign_publickey($key_pair);
        return new static($pk_str);
    }

    public static function createFromSecret(SecretKey $s_key)
    {
        $pk_str = sodium_crypto_sign_publickey_from_secretkey($s_key->getBin());
        return new static($pk_str);
    }
}
