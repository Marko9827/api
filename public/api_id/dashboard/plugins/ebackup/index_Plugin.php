<?php
return 'eBackup';
class eBackup extends TB_Plugin
{
    protected $name, $description, $image, $id, $url, $lang;
    public function eBackup($api)
    {
        parent::__construct($api);
    }

    public function conf(){
        
    }

    public function call()
    {
        $this->api->call('Called from Weather');
    }

    public function page(){
        include "./dynamic/page.php";
    }
   

    public function whatever()
    {
        echo "Doing whatever from Weather<br>\n";
    }
    
  
    
}