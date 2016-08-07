<?php
/**
 * @link      http://github.com/zetta-repo/tss-bootstrap for the canonical source repository
 * @copyright Copyright (c) 2016 Thiago S. Santos
 */

namespace TSS\Bootstrap;

class Module
{
    /**
     * Provide application configuration.
     *
     * @return array
     */
    public function getConfig()
    {
        $provider = new ConfigProvider();
        return [
            'controller_plugins' => $provider->getControllerPluginConfig(),
            'view_helpers'       => $provider->getViewHelpers(),
            'view_helper_config' => $provider->getViewHelperConfig()
        ];
    }
}
