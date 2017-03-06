<?php
namespace Nikapps\NikPayLaravel\Tests;

use Nikapps\NikPayLaravel\NikPayServiceProvider;
use Nikapps\NikPayLaravel\Translators\LaravelTranslator;
use Orchestra\Testbench\TestCase;
use Nikapps\NikPayLaravel\NikPayFactory as NikPay;

class LaravelTranslatorTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [NikPayServiceProvider::class];
    }

    /**
     * @test
     */
    public function it_should_translate_status_code()
    {
        /** @var LaravelTranslator $samanTranslator */
        $samanTranslator = app(NikPay::class)->translator('saman');

        trans()->setLocale('fa');

        $this->assertEquals(
            $samanTranslator->translate('Canceled By User'),
            'تراکنش توسط خریدار کنسل شده است.'
        );
    }

    /**
     * @test
     */
    public function it_should_translate_error_code()
    {
        /** @var LaravelTranslator $samanTranslator */
        $samanTranslator = app(NikPay::class)->translator('saman');

        trans()->setLocale('fa');

        $this->assertEquals(
            $samanTranslator->translate(-3),
            'ورودیها حاوی کارکترهای ریرمجاز میباشند.'
        );
    }

    /**
     * @test
     */
    public function it_should_return_code_when_translation_is_not_available()
    {
        /** @var LaravelTranslator $samanTranslator */
        $samanTranslator = app(NikPay::class)->translator('saman');

        $this->assertEquals($samanTranslator->translate(-2000), -2000);
    }
}
