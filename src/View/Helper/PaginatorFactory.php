<?php
/**
 * Created by PhpStorm.
 * User: thiag
 * Date: 02/08/2016
 * Time: 17:34
 */

namespace TSS\Bootstrap\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class PaginatorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $params = $container->get('ControllerPluginManager')->get('params');

        return new Paginator($params);
    }
}