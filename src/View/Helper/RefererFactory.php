<?php
/**
 * Created by PhpStorm.
 * User: thiag
 * Date: 02/08/2016
 * Time: 17:26
 */

namespace TSS\Bootstrap\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class RefererFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $application = $container->get('Application');

        return new Referer($application->getRequest());
    }
}
