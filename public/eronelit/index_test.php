<?php
// DB CONF
define("DB_SERVER", "localhost");
define("DB_username", "root");
define("DB_password", "");
define("DB_DBname", "bgn");

// CODE VERSION
define("VERSION", "3025915HfF13h");

// ERONELIT API > ERONELIT DASHBOARD

define("API_KEY", "LMV419-516MLE-KTSJPL-AMT492-1MLZMQ");
define("API_URL", "https://api.localhost");
define("CLIENT_URL", "globalbusinessnets.localhost");


function eronelit_api($url, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    return $response;
}

print_r(eronelit_api(API_URL, [
    'TYPE' => "config",
    'server' => DB_SERVER,
    'username' => DB_username,
    'db' => DB_DBname,
    'password' => DB_password,
    'domain' => CLIENT_URL,
    'key' => API_KEY,
    'f_name' => 'time',
    'f_params'=> ''
]));
