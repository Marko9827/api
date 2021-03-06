<?php

namespace eronelit;


class api_eronelit
{
    protected $api;
    public function api($api)
    {
        $this->api = $api;
    }
}

abstract class CLIENT_WINNER
{
    protected $api;
    private $id, $name, $desc, $image, $keywords, $url;

    public function CLIENT_WINNER($api)
    {
        $this->api = $api;
    }
}

class eronelit
{
    private $fncList; // TB_Plugin[]    
    private $pluginList; // TB_Plugin[]
    private $api;
    private $con;
    private $server;
    private $username, $db, $password, $domain, $key;

    public function eronelit($api)
    {
        $this->fncList = [];
        $this->pluginList = [];
        $this->api = $api;
        $this->con;
        $this->con->server = $api;
        $this->con->username = $api;
        $this->con->db = $api;
        $this->con->password = $api;
        $this->con->domain = $api;
        $this->con->key = $api;
    }

    function __construct()
    {
        $this->DATABASE();
    }


    public function DATABASE()
    {

        $server = $this->getServer();
        $username = $this->getUsername();
        $password = $this->getPassword();
        $db = $this->getDb();
        $date_conf = date('m/d/Y h:i:s A', time());
        try {

            $con = mysqli_connect($server, $username, $password, $db) or die("FAIL");
        } catch (\Exception $e) {

            # error_log("TIME : $date_conf. Message : " . $e->getMessage() . " \n", 3, ROOT . "/Include/logs/log_index_info.txt");
        }
        $this->setCon($con);
    }

    public function registerPlugin($plugin)
    {
        $this->pluginList[$plugin] = new $plugin($this->api);
    }
    public function registerClient($server, $username, $db, $password, $domain, $key, $client)
    {
        $this->setServer($server);
        $this->setUsername($username);
        $this->setDb($db);
        $this->setPassword($password);
        $this->setKey($key);
        $this->setDomain($domain);
        $this->fncList[$client] = new $client($this->api);
    }
    public function Query($query)
    {
        global $con;
        $server = $this->getServer();
        $username = $this->getUsername();
        $password = $this->getPassword();
        $db = $this->getDb();

        // $con = $this->getCon();
        try {

            $exec = mysqli_query(mysqli_connect($server, $username, $password, $db), $query) or die($this->LOG_F($con));
            if ($exec) {
                if (strpos($query, "lang") !== false) {
                } else {
                    $this->LOG_F($query);
                }
                return $exec;
            }
        } catch (\Exception $e) {
            $this->LOG_F($e);
            //	header("location: /?installer=1");
        }

        return false;
    }
    public function LOG_F($msg)
    {
        /*
	 	function file_force_contents_UPDATERF($fullPath, $contents, $flags = 0)
	{
		$parts = explode('/', $fullPath);
		array_pop($parts);
		$dir = implode('/', $parts);

		if (!is_dir($dir))
			mkdir($dir, 0777, true);

		file_put_contents($fullPath, $contents, $flags);
	}*/
        $date = date('m/d/Y h:i:s A', time());
        //	file_force_contents_UPDATERF($_SERVER['DOCUMENT_ROOT'] . "/Include/logs/log_index_info.txt", "TIME : $date. Message : $msg \n\n", FILE_APPEND);


        error_log("TIME : $date. Message : $msg <br />", 3, ROOT . "/Include/logs/log_index_info.txt");
    }

    public function TABLE($name, $value, $select)
    {


        $sql = "SELECT * FROM $name ORDER BY $value";
        $exec =  $this->Query($sql);
        if (mysqli_num_rows($exec) > 0) {
            if ($post = mysqli_fetch_assoc($exec)) {
                echo $post[$select];
            }
        }
    }
    public function FUNCTION($id1, $id2, $id3, $id4, $id5, $id6, $id7, $id8, $id9, $id10)
    {
        if (!empty($id10)) {
        }
    }
    public function Math($math)
    {
        $math2 = "";


        try {

            eval("\$math2 = (\"$math\");");
        } catch (\Exception $e) {
            $math2 = "Error math :( ";
        }
        echo $math2;
    }
    public function CALLF($name, $param)
    {
        header("Connection: close");
        ignore_user_abort(false);
        static $array_domain = array(
            "globalbusinessnets.localhost" => true
        );
        static $array_key = array(
            "LMV419-516MLE-KTSJPL-AMT492-1MLZMQ" => true
        );
        $func_array = array(
            "time"  => $this->time(),
            "color" => $this->color($param),
            "page"  => $this->CALL_PAGE($param, ""),
            "db_conf" => $this->LOGIN_CONF(),
            "math" => $this->Math($param)
        );


        ignore_user_abort(false);
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        switch ($requestMethod) {

            case 'POST':
                if ($array_key[$this->getKey()] == true) {
                    if ($array_domain[$this->getDomain()] == true) {
                        if (isset($func_array[$name])) {
                            return $func_array[$name];
                        }
                    }
                }
                break;
            default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }
    }

    public function loadApi($apier)
    {
        $this->fncList[$apier] = new $apier($this->api);
    }
    public function loadApi_key()
    {
        foreach ($this->fncList as $apiName => $api) {
        }
    }
    public function time()
    {
        echo date('m/d/Y h:i:s A', time());
    }
    public function LOGIN_CONF()
    {
    }
    public function SSL()
    {
        $ssl = "";
        if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') {
            $ssl = "https";
        } else {
            $ssl = "http";
        }

        return $ssl;
    }
    public function color($f)
    {
        //return $f;

        echo "<div style='text-align: center;padding: 10px;width: fit-content;border-radius: 10px;color: white;border: 2px solid black; background: $f;'>" . $f . "</div>";
    }
    public  function CALL_PAGE($page, $url)
    {
        $_GET['admin'] = $page;
        if (!empty($_GET['admin'])) {
            include "./api_id/dashboard/index.php";
        }
    }


    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of server
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * Set the value of server
     *
     * @return  self
     */
    public function setServer($server)
    {
        $this->server = $server;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    /**
     * Get the value of con
     */
    public function getCon()
    {
        return $this->con;
    }

    /**
     * Set the value of con
     *
     * @return  self
     */
    public function setCon($con)
    {
        $this->con = $con;

        return $this;
    }

    /**
     * Get the value of domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set the value of domain
     *
     * @return  self
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get the value of key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the value of key
     *
     * @return  self
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }
}
