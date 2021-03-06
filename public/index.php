<?php
header("connection: close");
if (!empty($_GET['flags'])) {
    header("content-type: image/svg+xml");
    readfile("flags/" . $_GET['flags'] . ".svg");
} else {
    include_once "index.html";
}
<<<<<<< Updated upstream
=======
*/

define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . "/");
define("ROOT", $_SERVER['DOCUMENT_ROOT'] . "/api_id/dashboard/");

#$eronelit = new eronelit(new API());
#$eronelit->registerClient($f);
#$eronelit->SSL();

#include_once(ROOT_PATH . "eronelit/api.php");

//$eapi = new eronelit(new API());
//$eapi->SSL(); 
require_once("eronelit/eronelit.php");
ignore_user_abort(false);
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($requestMethod) {

    case 'POST':
        $eronelitAPI = new eronelit(new api_eronelit());
        if (isset($_POST['TYPE'])) {
            if ($_POST['TYPE'] == "config") {
                foreach (glob('api_id/*/*_bundle.php') as $file) {
                    $eronelitAPI->registerClient(
                        $_POST['server'],
                        $_POST['username'],
                        $_POST['db'],
                        $_POST['password'],
                        $_POST['domain'],
                        $_POST['key'],
                        require_once($file)
                    );
                }
            }
            //$eronelitAPI->registerClient(require_once("api_id/dashboard/api_bundle.php"));

            $eronelitAPI->CALLF($_POST['f_name'], $_POST['f_params']);
            /*
            $eronelitAPI->TABLE("other", "id", "lang");
            parse_str("name=Peter&age=43", $ouput);
            echo $ouput['name'];
       */
        }
        break;
    default:
        die(include_once("index_html_old"));
        break;
}
>>>>>>> Stashed changes
