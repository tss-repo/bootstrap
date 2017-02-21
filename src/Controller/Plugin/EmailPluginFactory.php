<?php
/**
 * @link      http://github.com/zetta-repo/tss-bootstrap for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace TSS\Bootstrap\Controller\Plugin;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class EmailPluginFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        $transport = $container->get('mail.transport');

        return new EmailPlugin($transport, $config['mail']['options']);
    }

}
