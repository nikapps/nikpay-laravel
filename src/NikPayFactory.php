<?php
namespace Nikapps\NikPayLaravel;

class NikPayFactory
{

    /**
     * Get payment provider
     *
     * @param string $bank
     * @return \Nikapps\NikPay\PaymentProviders\PaymentProvider
     */
    public function bank($bank)
    {
        return app('nikapps:nikpay:' . strtolower($bank));
    }

    /**
     * Get translator
     *
     * @param string $bank
     * @return \Nikapps\NikPay\PaymentProviders\Translator
     */
    public function translator($bank)
    {
        return app('nikapps:nikpay:translator:' . strtolower($bank));
    }

}
