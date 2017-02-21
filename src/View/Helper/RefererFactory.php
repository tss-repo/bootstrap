<?php
/**
 * @link      http://github.com/zetta-repo/tss-bootstrap for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
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
