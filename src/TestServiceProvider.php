<?php


namespace Cblink\MeituanDispatch;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class TestServiceProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['test'] = function ($pimple) {
            return new Test($pimple['config']->get('app_key'), $pimple['config']->get('secret'));
        };
    }
}