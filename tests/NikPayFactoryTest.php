<?php
namespace Nikapps\NikPayLaravel\Tests;

use Nikapps\NikPay\PaymentProviders\Saman\Saman;
use Nikapps\NikPay\PaymentProviders\Saman\SamanConfig;
use Nikapps\NikPayLaravel\NikPayServiceProvider;
use Nikapps\NikPayLaravel\Translators\LaravelTranslator;
use Orchestra\Testbench\TestCase;
use Nikapps\NikPayLaravel\NikPayFactory as NikPay;

class NikPayFactoryTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [NikPayServiceProvider::class];
    }

    /**
     * Get base path.
     *
     * @return string
     */
    protected function getBasePath()
    {
        // reset base path to point to our package's src directory
        return __DIR__ . '/../vendor/orchestra/testbench/fixture';
    }

    /**
     * @test
     */
    public function it_should_return_an_instance_of_saman_payment_provider()
    {
        $nikpay = app(NikPay::class);

        $saman = $nikpay->bank('saman');

        $this->assertInstanceOf(Saman::class, $saman);
    }

    /**
     * @test
     */
    public function it_should_return_an_instance_of_laravel_translator()
    {
        $nikpay = app(NikPay::class);

        $translator = $nikpay->translator('saman');

        $this->assertInstanceOf(LaravelTranslator::class, $translator);
    }

    /**
     * @test
     */
    public function it_should_setup_saman_config()
    {

        // Service provider will not be loaded if I don't write this! WHY?!
        app(NikPay::class);

        $config = config('nikpay.saman');

        /** @var SamanConfig $samanConfig */
        $samanConfig = app(SamanConfig::class);

        $this->assertInstanceOf(SamanConfig::class, $samanConfig);

        $this->assertEquals($samanConfig->getGatewayUrl(), $config['webservice']['gateway']);
        $this->assertEquals($samanConfig->getTokenUrl(), $config['webservice']['token']);
        $this->assertEquals($samanConfig->getWebServiceUrl(), $config['webservice']['general']);
        $this->assertEquals($samanConfig->getSoapOptions(), $config['webservice']['soap_options']);

        $this->assertEquals($samanConfig->getRedirectUrl(), $config['redirect_url']);
        $this->assertEquals($samanConfig->getMerchantId(), $config['merchant_id']);
        $this->assertEquals($samanConfig->getUsername(), $config['username']);
        $this->assertEquals($samanConfig->getPassword(), $config['password']);
    }
}