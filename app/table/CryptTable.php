<?php
namespace raouf\table;
use core\table\Table; 
class CryptTable extends Table{
    public function crypt($message, $encryption_key){
        $key=hex2bin($encryption_key);
        $nonceSize=openssl_cipher_iv_length('aes-256-ctr');
        $nonce=openssl_random_pseudo_bytes($nonceSize);
        $ciphertext=openssl_encrypt(
            $message,
            'aes-256-ctr',
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );
        return base64_encode($nonce.$ciphertext);
    }
    //openssl_get_cipher_methods():
    public function decrypt($message, $encryption_key){
        $key=hex2bin($encryption_key);
        $message=base64_decode($message);
        $nonceSize=openssl_cipher_iv_length('aes-256-ctr');
        $nonce=mb_substr($message, 0, $nonceSize, '8bit');
        $ciphertext=mb_substr($message, $nonceSize, null, '8bit');
        $plainttext=openssl_decrypt(
            $ciphertext,
            'aes-256-ctr',
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );
        return $plainttext;
    }
}
?>