<?php

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    //check ip from share internet
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    //to check ip is pass from proxy
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$ip = getRealIpAddr();
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
$location = $details->city;
$yahooResult = json_decode(file_get_contents("http://query.yahooapis.com/v1/public/yql?q=select%20name%2Cwoeid%20from%20geo.places%20where%20text%3D%22" . $location . "%22%20limit%201&format=json"));
$woeid = $yahooResult->query->results->place->woeid;
$weatherDetails = json_decode(file_get_contents("http://query.yahooapis.com/v1/public/yql?q=select%20units%2C%20item%20from%20weather.forecast%20where%20woeid%3D" . $woeid . "&format=json"));

echo $weatherTitle = $weatherDetails->query->results->channel->item->title;
echo $weatherDate = $weatherDetails->query->results->channel->item->condition->date;
echo $weatherTemp = $weatherDetails->query->results->channel->item->condition->temp . " " . $weatherDetails->query->results->channel->units->temperature;
echo $weatherCond = $weatherDetails->query->results->channel->item->condition->text;

?>
<div style="background-color: #fff; width:250px; height:250px;"></div>