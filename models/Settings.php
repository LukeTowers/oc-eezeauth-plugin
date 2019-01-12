<?php namespace LukeTowers\EEZEAuth\Models;

use Model;
use Backend\Models\UserRole;

/**
 * Class Settings
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    /**
     * @var string $settingsCode Unique code to namespace settings under
     */
    public $settingsCode = 'luketowers_eezeauth_settings';

    /**
     * @var string $settingsFields Reference to field configuration
     */
    public $settingsFields = 'fields.yaml';

    public function getRoleIdOptions()
    {
        return UserRole::lists('name', 'id');
    }
}
