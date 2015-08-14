<?php
namespace Nikapps\NikPayLaravel;

use Illuminate\Support\ServiceProvider;
use Nikapps\NikPay\PaymentProviders\Saman\Saman;
use Nikapps\NikPay\PaymentProviders\Saman\SamanConfig;
use Nikapps\NikPay\Soap\PhpSoapService;
use Nikapps\NikPay\Soap\SoapService;
use Nikapps\NikPayLaravel\Translators\LaravelTranslator;

class NikPayServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadTranslationsFrom(__DIR__ . '/lang', 'nikpay');

        $this->setupConfig();
        $this->setupViews();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(SoapService::class, PhpSoapService::class);

        $this->registerSaman();

        $this->app->singleton(NikPayFactory::class, function () {
            return new NikPayFactory();
        });

    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = __DIR__ . '/config/nikpay.php';

        $this->publishes([
            $source => config_path('nikpay.php')
        ], 'config');

        $this->mergeConfigFrom($source, 'nikpay');
    }

    /**
     * Setup views
     *
     * @return void
     */
    protected function setupViews()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'nikpay');

        $this->publishes([
            __DIR__ . '/views' => base_path('resources/views/vendor/nikpay'),
        ], 'views');
    }

    protected function registerSaman()
    {
        // Bind saman configuration
        $this->app->bind(SamanConfig::class, function ($app) {

            $config = $app['config']->get('nikpay');

            return (new SamanConfig())
                ->setGatewayUrl($config['webservice']['gateway'])
                ->setWebServiceUrl($config['webservice']['general'])
                ->setTokenUrl($config['webservice']['token'])
                ->setSoapOptions($config['webservice']['soap_options'])
                ->setRedirectUrl($config['redirect_url'])
                ->setMerchantId($config['merchant_id'])
                ->setPassword($config['password'])
                ->setUsername($config['username']);

        });

        $this->app->bind('nikapps:nikpay:saman', Saman::class);

        $this->app->singleton('nikapps:nikpay:translator:saman', function () {
            return new LaravelTranslator('saman');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [NikPayFactory::class];
    }

}