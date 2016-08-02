<?php
/**
 * Created by PhpStorm.
 * User: thiag
 * Date: 02/08/2016
 * Time: 14:55
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
