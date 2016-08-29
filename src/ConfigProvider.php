<?php
/**
 * @link      http://github.com/zetta-repo/tss-bootstrap for the canonical source repository
 * @copyright Copyright (c) 2016 Zetta Code
 */

namespace TSS\Bootstrap;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\View\Helper\Navigation\Menu;

class ConfigProvider implements ConfigProviderInterface
{
    public function getConfig()
    {
        return [
            'controller_plugins' => $this->getControllerPluginConfig(),
            'view_helpers'       => $this->getViewHelpers(),
            'view_helper_config' => $this->getViewHelperConfig(),
            'navigation_helpers' => [
                'aliases' => [
                    Menu::class => View\Helper\Menu::class,
                ],
                'factories' => [
                   View\Helper\Menu::class => InvokableFactory::class
                ]
            ],
            'view_manager'       => $this->getViewManagerConfig(),
        ];
    }

    /**
     * Return configuration for this component.
     *
     * @return array
     */
    public function __invoke()
    {
        return $this->getConfig();
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
                Controller\Plugin\EmailPlugin::class => Controller\Plugin\EmailPluginFactory::class,
                Controller\Plugin\ImageThumbPlugin::class => Controller\Plugin\ImageTumbPluginFactory::class,
                Controller\Plugin\Referer::class => InvokableFactory::class,
            ],
        ];
    }

    /**
     * Return component helpers configuration.
     *
     * @return array
     */
    public function getViewHelpers()
    {
        return [
            'aliases' => [
                'tssFlashMessenger' => View\Helper\FlashMessenger::class,
                'tssFormRow' => Form\View\Helper\FormRow::class,
                'tssPaginator' => View\Helper\Paginator::class,
                'tssReferer' => View\Helper\Referer::class,
            ],
            'factories' => [
                Form\View\Helper\FormRow::class => InvokableFactory::class,
                View\Helper\FlashMessenger::class => InvokableFactory::class,
                View\Helper\Paginator::class => View\Helper\PaginatorFactory::class,
                View\Helper\Referer::class => View\Helper\RefererFactory::class,
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
            'flashmessenger' => [
                'message_open_format' => '<div%s><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><ul><li>',
                'message_close_string' => '</li></ul></div>',
                'message_separator_string' => '</li><li>'
            ]
        ];
    }

    /**
     * Return component helpers configuration.
     *
     * @return array
     */
    public function getViewManagerConfig()
    {
        return [
            'template_path_stack' => [
                __DIR__ . '/../view',
            ],
        ];
    }
}
