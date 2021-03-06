<?php
return 'einvoice';
class einvoice extends TB_Plugin
{
    protected $name, $description, $image, $id, $url, $lang;
    public function einvoice($api)
    {
        parent::__construct($api);
    }

    public function conf()
    {
    }

    public function call()
    {
        $this->api->call('Called from Weather');
    }
    public function source($js)
    {
        $this->api->source("einvoice", $js);
    }

    public function page()
    {
        include "dynamic/page.php";
    }

    public function config($name)
    {

        $this->api->config(__DIR__, $name);
    }


    public function whatever()
    {
        echo "Doing whatever from Weather<br>\n";
    }

    public function time_api(){
        $this->api->TIME();
    }
}
