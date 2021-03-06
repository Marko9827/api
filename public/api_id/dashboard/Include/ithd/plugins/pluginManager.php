<?php


require_once('api.php');
require_once('plugin.php');

 class PluginManager extends eronelit\CLIENT_WINNER
{
    private $pluginList; // TB_Plugin[]
    private $api;

    public function PluginManager($api)
    {
        $this->pluginList = [];
        $this->api = $api;
    }

    public function registerPlugin($plugin)
    {
        $this->pluginList[$plugin] = new $plugin($this->api);
    }
    public function NAME_CALL()
    {
        foreach ($this->pluginList as $pluginName => $plugin) {
           
            
            include  $_SERVER['DOCUMENT_ROOT'] . "/plugins/" . strtolower($pluginName) . "/conf.php";
            $F_F_Hid = $conf_array['id'];
            $F_F_Hurl =  $conf_array['url'];
            $F_F_Hname = $conf_array['name'];
            $F_F_Hauthor = $conf_array['author'];
            $F_F_Hnavitem = $conf_array['navitem'];
            $F_F_Hdescription = $conf_array['description'];
            $F_F_Himage = $conf_array['cover'];
            $F_F_Henabled = $conf_array['enabled'];
            $F_F_Hsystem_rln = $conf_array['system'];
        }
     }
    public function doCall()
    {
        foreach ($this->pluginList as $pluginName => $plugin) {
            echo "(Executing whatever on plugin: " . $pluginName . ")<br>\n";
            $plugin->call();
        }
    }

    public function doWhatever()
    {
        foreach ($this->pluginList as $pluginName => $plugin) {
            echo "(Executing whatever on plugin: " . $pluginName . ")<br>\n";
            $plugin->whatever();
        }
    }

    public function Number_plugins()
    {   
        $i=0;
        foreach ($this->pluginList as $pluginName => $plugin) {
            //echo "(Executing whatever on plugin: " . $pluginName . ")<br>\n";
            //$plugin->whatever();
            $i++;
        }
        echo $i;
    }


    public function navbar_h($file)
    {
    }

    public function nav_core()
    {
        foreach ($this->pluginList as $pluginName => $plugin) {
            echo "(Executing whatever on plugin: " . $pluginName . ")<br>\n";
            $plugin->whatever();
        }
    }
    public function navbar_left()
    {
        foreach ($this->pluginList as $pluginName => $plugin) {
            //  echo "(Executing whatever on plugin: " . $pluginName . ")<br>\n";
            // $plugin->doCard();

            $plugin->navbar_left2($pluginName);
        }
    }
    public function doNavbars($type)
    {
        if ($type == "nav_item") {
            foreach ($this->pluginList as $pluginName => $plugin) {
                //  echo "(Executing whatever on plugin: " . $pluginName . ")<br>\n";
                // $plugin->doCard();

                $plugin->navbar($pluginName);
            }
        }


        if ($type == "nav_core") {
            foreach ($this->pluginList as $pluginName => $plugin) {
                //  echo "(Executing whatever on plugin: " . $pluginName . ")<br>\n";
                // $plugin->doCard();

                $plugin->PAGE_GENERATOR($pluginName);
            }
        }
    }
    public function plugin_paramJSON($url, $name)
    {
        foreach ($this->pluginList as $pluginName => $plugin) {

            $plugin->plugin_json($url, $name, $pluginName);
        }
    }


    public function plugin_json_DATA($url, $name)
    {
        foreach ($this->pluginList as $pluginName => $plugin) {

            $plugin->plugiN_Source($url, $name, $pluginName);
        }
    }
    public function plugin_navbar_top($file){
        foreach ($this->pluginList as $pluginName => $plugin) {

            $plugin->navbar_top_page($file,$pluginName);
        }
    }
    public function timef($file)
    {
      
        foreach ($this->pluginList as $pluginName => $plugin) {

            $plugin->TIME($pluginName);
        }
    } 
    public function PAGE_GENERATOR_PM($url)
    {

        foreach ($this->pluginList as $pluginName => $plugin) {

            $plugin->PAGE_GENERATOR2($url, $pluginName, "page");
        }
    }
    public function PAGE_GENERATOR_PM_S($url)
    {

        foreach ($this->pluginList as $pluginName => $plugin) {

            $plugin->PAGE_GENERATOR2($url, $pluginName, "settings");
        }
    }
    public function PAGE_NMAE($url)
    {
        foreach ($this->pluginList as $pluginName => $plugin) {

            $plugin->PAGE_GENERATOR2($url, $pluginName, "page");
        }
    }

    public function doCardF()
    {
        foreach ($this->pluginList as $pluginName => $plugin) {
            //  echo "(Executing whatever on plugin: " . $pluginName . ")<br>\n";
            // $plugin->doCard();

            $plugin->json_PARS($pluginName);
        }
    }
    

    public function TIME()
    {
        echo date("h:m:s m/d/y");
    }
}
