<?php

return [
    'saman' => [
        'username'     => 'your-username',
        'password'     => 'your-password',
        'merchant_id'     => 'your-merchant-id',
        'redirect_url' => 'http://example.com/payment/callback',
        'webservice'   => [
            'general'      => 'https://acquirer.samanepay.com/payments/referencepayment.asmx?WSDL',
            'token'        => 'https://sep.shaparak.ir/Payments/InitPayment.asmx',
            'gateway'      => 'https://sep.shaparak.ir/Payment.aspx',
            'soap_options' => null
        ]
    ]
];
