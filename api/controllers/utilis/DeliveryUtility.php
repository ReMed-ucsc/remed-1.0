<?php

require_once BASE_PATH . '/app/models/DeliveryView.php';
require_once BASE_PATH . '/app/models/Driver.php';

class DeliveryUility
{
    private $accessToken;
    private $fcmUrl = 'https://fcm.googleapis.com/v1/projects/remednotification/messages:send';

    public function sendDetailstoDriver($orderId)
    {
        $orderModel = new OrderView();

        $columns = ['orderview.destination', 'pharmacy.address'];
        $data = ['OrderID' => $orderId];

        $orderModel->setLimit(1);

        $deliveryData = $orderModel->join(
            'pharmacy',
            'orderview.PharmacyID = pharmacy.PharmacyID',
            $data,
            [],
            $columns
        );

        // Check if the result exists and return a valid response
        if ($deliveryData) {
            // Return the result as a JSON response
            echo json_encode($deliveryData);
            echo json_encode(["destination" => $deliveryData[0]['destination']]);
        } else {
            // If no data found, return an error response
            echo json_encode(['error' => 'Data not found']);
        }

        $driverModel = new Driver();

        $columns = ['fcmToken'];

        $result = $driverModel->selectWhere($columns, [], []);

        $fcmTokens = [];

        if ($result) {

            foreach ($result as $item) {
                if (isset($item['fcmToken'])) {
                    $fcmTokens[] = $item['fcmToken'];
                }
            }

            echo json_encode($fcmTokens);
            return;
        } else {
            echo json_encode("No token found");
        }

        if ($fcmTokens) {
            $payload = [
                'message' => [
                    'token' => $result['fcmToken'],
                    'data' => [
                        'title' => 'New delivery Request',
                        'body' => 'You have a new delivery',
                        'action' => 'popup',
                        'pharmacyAddress' => $deliveryData[0]['destination'],
                        'deliveryAddress' => $deliveryData[0]['address'],
                        'orderId' =>  strval($orderId),
                    ],
                ],
            ];

            return $this->fcmSender($payload);
        } else {
            return [
                "status" => "error",
                "message" => "No driver found"
            ];
        }
    }


    private function fcmSender($payload)
    {
        if (!$payload) {
            error_log("payload not found");
        } else {
            error_log("Payload " . print_r($payload));
        }

        $this->accessToken =  $this->generateAccessToken();

        if (!$this->accessToken) {
            return [
                "status" => "error",
                "message" => "token not found"
            ];
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->fcmUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->accessToken,
            'Content-Type: application/json'
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);

            return [
                'status' => 'error',
                'message' => 'cURL error: ' . $error
            ];
        }

        curl_close($ch);

        $responseDecoded = json_decode($response, true);

        if ($responseDecoded === null) {
            return [
                'status' => 'error',
                'message' => 'Failed to decode response'
            ];
        }

        error_log("server response " . print_r($responseDecoded));

        return $responseDecoded;
    }

    function generateAccessToken()
    {
        // Read the service account JSON file
        $serviceAccount = json_decode(file_get_contents($GLOBALS['serviceAccountPath']), true);

        // Extract required fields
        $privateKey = $serviceAccount['private_key'];
        $clientEmail = $serviceAccount['client_email'];

        // Prepare the JWT header
        $header = [
            'alg' => 'RS256',
            'typ' => 'JWT',
        ];

        // Prepare the JWT payload
        $now = time();
        $payload = [
            'iss' => $clientEmail,
            'sub' => $clientEmail,
            'aud' => 'https://www.googleapis.com/oauth2/v4/token',
            'iat' => $now,
            'exp' => $now + 3600, // 1 hour expiration
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
        ];

        // Encode the header and payload
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($header)));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));

        // Create the signature
        $signatureInput = $base64UrlHeader . '.' . $base64UrlPayload;
        openssl_sign($signatureInput, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Form the final JWT
        $jwt = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;

        // Exchange the JWT for an access token
        $response = file_get_contents('https://www.googleapis.com/oauth2/v4/token', false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query([
                    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                    'assertion' => $jwt,
                ]),
            ],
        ]));

        $responseData = json_decode($response, true);
        return $responseData['access_token'] ?? null;
    }
}
