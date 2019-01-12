<?php namespace LukeTowers\EEZEAuth;

use Url;
use View;
use Event;
use Backend;
use System\Classes\PluginBase;
use System\Classes\CombineAssets;
use LukeTowers\EEZEAuth\Models\Settings;
use Backend\Controllers\Auth as AuthController;

/**
 * EEZEAuth Plugin Information File
 */
class Plugin extends PluginBase
{
    public $elevated = true;

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'luketowers.eezeauth::lang.plugin.name',
            'description' => 'luketowers.eezeauth::lang.plugin.description',
            'author'      => 'LukeTowers',
            'icon'        => 'icon-lock'
        ];
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function boot()
    {
        $clientId = Settings::get('client_id');

        if (empty($clientId)) {
            return;
        }

        Event::listen('backend.auth.extendSigninView', function($controller) use ($clientId) {
            return View::make("luketowers.eezeauth::login", [
                'url'        => Url::to('luketowers/eezeauth'),
                'client_id'  => $clientId,
                'hide_login' => Settings::get('hide_login', false),
            ]);
        });

        AuthController::extend(function($controller) {
            if (\Backend\Classes\BackendController::$action === 'signin') {
                $controller->addCss(CombineAssets::combine(['eeze.less'], plugins_path() . '/luketowers/eezeauth/assets/less/'));
            }
        });
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'luketowers.eezeauth.some_permission' => [
                'tab' => 'luketowers.eezeauth::lang.plugin.name',
                'label' => 'luketowers.eezeauth::lang.permissions.manage_plugin'
            ],
        ];
    }

    /**
     * Registers any settings implemented in this plugin
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'luketowers.eezeauth::lang.settings.label',
                'description' => 'luketowers.eezeauth::lang.settings.description',
                'icon'        => 'icon-cogs',
                'url'         => Backend::url('luketowers/eezeauth/settings/update'),
                'class'       => 'LukeTowers\EEZEAuth\Models\Settings',
                'keywords'    => 'eeze eeze.io auth authentication client_id client_secret client id secret',
                'permissions' => ['luketowers.eezeauth.manage_plugin'],
            ],
        ];
    }
}
