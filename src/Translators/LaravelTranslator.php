<?php
namespace Nikapps\NikPayLaravel\Translators;

use Nikapps\NikPay\PaymentProviders\Translator;

class LaravelTranslator implements Translator
{
    /**
     * @var string
     */
    private $bank;

    /**
     * @param string $bank
     */
    public function __construct($bank)
    {
        $this->bank = strtolower($bank);
    }


    /**
     * Translate/Describe error or state code
     *
     * @param string|integer $code
     *
     * @return string|integer
     */
    public function translate($code)
    {
        return str_replace(
            "nikpay::{$this->bank}.",
            '',
            trans("nikpay::{$this->bank}.$code")
        );
    }

    /**
     * Alias of translate
     *
     * @see $this::translate()
     * @param string|integer $code
     *
     * @return string|integer
     */
    public function trans($code)
    {
        return $this->translate($code);
    }

    /**
     * Alias of translate
     *
     * @see $this::translate()
     * @param string|integer $code
     *
     * @return string|integer
     */
    public function describe($code)
    {
        return $this->translate($code);
    }
}
