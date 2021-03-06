<?php
return 'Weather';
class Weather extends TB_Plugin
{
    protected $name, $description, $image, $id, $url, $lang;
    public function Weather($api)
    {
        parent::__construct($api);
    }

    public function conf(){
        
    }

    public function call()
    {
        $this->api->call('Called from Weather');
    }

    public function whatever()
    {
        echo "Doing whatever from Weather<br>\n";
    }
    
  
    
}
