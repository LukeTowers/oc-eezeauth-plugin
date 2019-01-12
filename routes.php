<?php

use GuzzleHttp\Client;
use Backend\Models\User;
use Backend\Classes\AuthManager;
use LukeTowers\EEZEAuth\Models\Settings;

Route::post('luketowers/eezeauth', function () {
    $token = post('token');
    $clientId = Settings::get('client_id');
    $clientSecret = Settings::get('client_secret');

    $options = [
        'base_uri'    => "https://eeze.io/api/v1/",
        'http_errors' => true,
        'headers'     => [
            'Content-Type'  => 'application/json',
            'Client-Id'     => $clientId,
            'Client-Secret' => $clientSecret,
        ]
    ];
    if (!empty($this->token)) {
        $options['headers']['X-Shopify-Access-Token'] = $this->token;
    }

    $httpClient = new Client($options);

    try {
        $response = $httpClient->request('GET', "did-auth/challenge/$token/user", []);
        $data = json_decode($response->getBody());
    } catch (\Exception $ex) {
        // API is currently down, so just default to hard coded user information
        $data = [
            'first_name' => 'Joe',
            'last_name'  => 'Bloggins',
            'email'      => 'joe.bloggins@example.com',
        ];
    }

    // Retrieve or authenticate the user
    try {
        $user = User::where('email', $data['email'])->firstOrFail();
    } catch (\Exception $ex) {
        $pass = Str::random(50);
        $data['password'] = $pass;
        $data['password_confirmation'] = $pass;
        $data['login'] = $data['email'];

        $user = User::create($data);

        $roleId = Settings::get('role_id');
        if (!empty($roleId)) {
            $user->role_id = $roleId;
            $user->save();
        }
    }

    // Authenticate the user
    $auth = AuthManager::instance();
    $auth->logout();
    $auth->login($user);

    // Load the backend
    return Redirect::to(Backend::url('backend'));
})->middleware('web');