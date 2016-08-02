<?php
/**
 * @link      http://github.com/zetta-repo/tss-bootstrap for the canonical source repository
 * @copyright Copyright (c) 2016 Thiago S. Santos
 */


namespace TSS\Bootstrap;


use TSS\Bootstrap\Controller\Plugin\EmailPluginFactory;
use TSS\Bootstrap\Controller\Plugin\ImageTumbPluginFactory;
use TSS\Bootstrap\View\Helper\PaginatorFactory;
use TSS\Bootstrap\View\Helper\RefererFactory;
use Zend\ServiceManager\Factory\InvokableFactory;

class ConfigProvider
{
    /**
     * Return configuration for this component.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'controller_plugins' => $this->getControllerPluginConfig(),
            'view_helpers'       => $this->getViewHelperConfig(),
        ];
    }

    /**
     * Return dependency mappings for this component.
     *
     * @return array
     */
    public function getDependencyConfig()
    {
        return [
            'factories' => [
                //'FilterManager' => FilterPluginManagerFactory::class,
            ],
        ];
    }

    /**
     * Return component plugins configuration.
     *
     * @return array
     */
    public function getControllerPluginConfig()
    {
        return [
            'aliases' => [
                'tssEmail' => Controller\Plugin\EmailPlugin::class,
                'tssImageThumb' => Controller\Plugin\ImageThumbPlugin::class,
                'tssReferer' => Controller\Plugin\Referer::class,
            ],
            'factories' => [
                Controller\Plugin\EmailPlugin::class => EmailPluginFactory::class,
                Controller\Plugin\ImageThumbPlugin::class => ImageTumbPluginFactory::class,
                Controller\Plugin\Referer::class => InvokableFactory::class,
            ],
        ];
    }

    /**
     * Return component helpers configuration.
     *
     * @return array
     */
    public function getViewHelperConfig()
    {
        return [
            'aliases' => [
                'tssFlashMessenger' => View\Helper\FlashMessenger::class,
                'tssFormCheckbox' => Form\View\Helper\FormCheckbox::class,
                'tssFormRow' => Form\View\Helper\FormRow::class,
                'tssFormRowHorizontal' => Form\View\Helper\FormRowHorizontal::class,
                'tssPaginator' => View\Helper\Paginator::class,
                'tssReferer' => View\Helper\Referer::class,
            ],
            'factories' => [
                Form\View\Helper\FormCheckbox::class => InvokableFactory::class,
                Form\View\Helper\FormRow::class => InvokableFactory::class,
                Form\View\Helper\FormRowHorizontal::class => InvokableFactory::class,
                View\Helper\FlashMessenger::class => InvokableFactory::class,
                View\Helper\Paginator::class => PaginatorFactory::class,
                View\Helper\Referer::class => RefererFactory::class,
            ],
        ];
    }
//'flashmessenger' => array(
//'message_open_format' => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
//'message_close_string' => '</li></ul></div>',
//'message_separator_string' => '</li><li>'
//)
}
