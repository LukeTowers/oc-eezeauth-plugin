<?php namespace LukeTowers\EEZEAuth\Controllers;

use Redirect;
use System\Controllers\Settings as SettingsController;

class Settings extends SettingsController
{
    public function index()
    {
        abort(404);
    }

    public function mysettings()
    {
        abort(404);
    }

    public function formGetModel()
    {
        return $this->formWidget->model;
    }

    public function update($author = null, $plugin = null, $code = null)
    {
        parent::update('luketowers', 'eezeauth', 'settings');
    }

    public function update_onSave($author = null, $plugin = null, $code = null)
    {
        parent::update_onSave('luketowers', 'eezeauth', 'settings');
        return Redirect::refresh();
    }

    public function update_onPurgeYear()
    {

    }
}