<?php

namespace App\Services;

use Exception;

class PaymentGatewayService
{
    protected static $accessToken = "TEST-4919606436347993-061717-a9ed5d26dbfe47dc0f21188d95421990-1619730587";
    protected $publicKey;


    public static function gerarPix()
    {
        $curl = curl_init();

        // Gerar um ID único para o cabeçalho X-Idempotency-Key
        $idempotencyKey = uniqid();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mercadopago.com/v1/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "description": "Payment for product",
                "external_reference": "MP0001",
                "notification_url": "https://google.com",
                "payer": {
                    "email": "test_user_123@testuser.com",
                    "identification": {
                        "type": "CPF",
                        "number": "95749019047"
                    }
                },
                "payment_method_id": "pix",
                "transaction_amount": 58.8
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . self::$accessToken,
                'X-Idempotency-Key: ' . $idempotencyKey
            )
        ));

        $response = curl_exec($curl);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            throw new Exception('Erro ao executar a requisição cURL: ' . $error);
        }

        curl_close($curl);

        $obj = json_decode($response);

        if(isset($obj->id)){
            $copy = $obj->point_of_interaction->transaction_data->qr_code;
            $img_qrcode = $obj->point_of_interaction->transaction_data->qr_code_base64;
            $external_link = $obj->point_of_interaction->transaction_data->ticket_url;

            return [
                "copy" => $copy,
                "img_qrcode" => $img_qrcode,
                "external_link" => $external_link
            ];
        }

        return null;
    }
}
