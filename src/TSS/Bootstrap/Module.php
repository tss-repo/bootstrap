<?php
/**
 * Created by PhpStorm.
 * User: Thiago
 * Date: 01/09/2015
 * Time: 14:05
 */

namespace TSS\Bootstrap;


use Zend\EventManager\EventManagerInterface;
use Zend\Http\Response;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\Mvc\ApplicationInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;

class Module implements AutoloaderProviderInterface, DependencyIndicatorInterface
{
    /**
     * @var ApplicationInterface
     */
    protected $application;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceManager;

    /**
     * @var EventManagerInterface
     */
    protected $eventManager;

    /**
     * @var AbstractPluginManager
     */
    protected $pluginManager;

    /**
     * @var HelperPluginManager
     */
    protected $helperManager;

    public function onBootstrap(MvcEvent $e)
    {
        $this->application = $e->getApplication();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($this->getEventManager());

        $this->getHelperManager()->get('Navigation')->getPluginManager()->setInvokableClass('Menu', 'TSS\Bootstrap\View\Helper\MenuHelper');
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/../../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getModuleDependencies()
    {
        return array();
    }

    /**
     * @return ApplicationInterface
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @return ServiceLocatorInterface
     */
    public function getServiceManager()
    {
        if ($this->serviceManager == null) {
            $this->serviceManager = $this->application->getServiceManager();
        }

        return $this->serviceManager;
    }

    /**
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if ($this->eventManager == null) {
            $this->eventManager = $this->application->getEventManager();
        }

        return $this->eventManager;
    }

    /**
     * @return AbstractPluginManager
     */
    public function getPluginManager()
    {
        if ($this->pluginManager == null) {
            $this->pluginManager = $this->getServiceManager()->get('ControllerPluginManager');
        }

        return $this->pluginManager;
    }

    /**
     * @return HelperPluginManager
     */
    public function getHelperManager()
    {
        if ($this->helperManager == null) {
            $this->helperManager = $this->getServiceManager()->get('ViewHelperManager');
        }

        return $this->helperManager;
    }
}