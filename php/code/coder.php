<?php

    class Coder{

        function coding($data, $methode){
            
            $output = false;

            $mencrypt = 'AES-256-CBC';

            $ksecret = 'Some_Key#MyFirst_Key/*-+Key#~é&(_çç^à@)°+=!';

            $ivsecret = 'Some_worDs@_$2-Secrets';

            $key = hash('sha256', $ksecret);
            
            $iv = substr(hash('sha256', $ivsecret), 0, 16);
            
            if( $methode == 'encrypt' ) {
                $output = openssl_encrypt($data, $mencrypt, $key, 5, $iv);
                $output = base64_encode($output);
            }
            else if( $methode == 'decrypt' ){
                $output = openssl_decrypt(base64_decode($data), $mencrypt, $key, 5, $iv);
            }
            
            return $output;

        }

    }
    
?>