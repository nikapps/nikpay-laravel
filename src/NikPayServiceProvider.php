<?php
namespace Nikapps\NikPayLaravel;

use Illuminate\Support\ServiceProvider;

class NikPayServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }

    protected function setupConfig()
    {

    }
}