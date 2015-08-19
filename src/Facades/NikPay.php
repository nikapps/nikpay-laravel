<?php
namespace Nikapps\NikPayLaravel\Facades;

use Illuminate\Support\Facades\Facade;
use Nikapps\NikPayLaravel\NikPayFactory;

class NikPay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return NikPayFactory::class;
    }
}
