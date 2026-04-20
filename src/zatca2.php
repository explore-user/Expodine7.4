<?php
require __DIR__ . '/vendor/autoload.php'; 




use GuzzleHttp\Client;

$client = new Client();

$client = new Client([
    'base_uri' => 'https://gw-apic-gov.stg.sa/e-invoicing/core/',
    'verify' => false // If you face SSL issues, but ideally use proper CA
]);

try {
    $response = $client->post('invoices/clear', [
        'headers' => [
            'Authorization' => 'Bearer ' . $yourAccessToken,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json'
        ],
        'json' => [
            "invoiceHash" => $invoiceHash,
            "uuid"        => $invoiceUUID,
            "invoice"     => base64_encode($xmlInvoice) // UBL XML encoded
        ]
    ]);

    $body = json_decode($response->getBody(), true);
    print_r($body);

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>