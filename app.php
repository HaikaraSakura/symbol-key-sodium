<?php

declare(strict_types=1);

require_once './vendor/autoload.php';

// $key_pair = \Haikara\SymbolKeySodium\KeyPair::create();

// $sk = $key_pair->getSecret();
// $pk = $key_pair->getPublic();

// // メッセージに秘密鍵で署名
// $message = 'PHPerでもブロックチェーンでなんかしたい！';
// $signed_message = $sk->sign($message);

// // 署名済みメッセージを公開鍵で検証
// $opend_message = $pk->verify($signed_message);

// // 
// var_dump($message === $opend_message);
$pk = '2e834140fd66cf87b254a693a2c7862c819217b676d3943267156625e816ec6f';
// $pk = '3f9f8c791f4b55c84278c10c7596f959a43a71dc35888d16e3d26a33456b6df2';
$id = '98';
// $id = '68';
$address = 'TATNE7Q5BITMUTRRN6IB4I7FLSDRDWZA37JGO5UW';

const SHA3_256 = 'sha3-256';
const RIPEMD160 = 'ripemd160';

// $hash1 = hash('sha3-256', hex2bin($pk)); // SHA3-256する
$hash1 = hash(SHA3_256, $pk); // SHA3-256する
echo $hash1 . PHP_EOL;

$hash2 = hash(RIPEMD160, $hash1); // RIPEMD160する
echo $hash2 . PHP_EOL;

$raw_address = $id . $hash2;
echo $raw_address . PHP_EOL;

$checksum = substr(hash(SHA3_256, $raw_address), 0, 8);
echo $checksum . PHP_EOL;

$raw_address = $raw_address . $checksum;
echo $raw_address . PHP_EOL;

'9826d27e1d0a26ca4e316f901e23e55c8711db20dfd2677696';
'98eded5009b16c3acdba173371c3a9d7d546377677f3d5baa0';
