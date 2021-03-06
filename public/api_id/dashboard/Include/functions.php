<?php

require_once(ROOT . 'Include/Database.php');
require_once(ROOT . 'Include/backup.php');
require_once(ROOT . 'Include/sql_backup.php');

#require_once(ROOT . 'Include/ithd/plugins/pluginManager.php');
#require_once(ROOT . 'Include/ithd/plugins/api.php');


include_once($_SERVER['DOCUMENT_ROOT']."/eronelit/eronelit.php");
 

#$pm = new PluginManager(new Api());


foreach (glob('plugins/*/*_Plugin.php') as $file) {
	$eronelitAPI->registerPlugin(require_once($file));
}


 

function LOG_F($msg)
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



function Redirect_To($location)
{
	header('location:' . $location);
	exit;
}
function formatBytes($size, $precision = 2)
{
	$base = log($size, 1024);
	$suffixes = array('', 'K', 'M', 'G', 'T');

	return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

function compressImage($source, $destination, $quality)
{
	// Get image info 
	$imgInfo = getimagesize($source);
	$mime = $imgInfo['mime'];

	// Create a new image from file 
	switch ($mime) {
		case 'image/jpeg':
			$image = imagecreatefromjpeg($source);
			break;
		case 'image/png':
			$image = imagecreatefrompng($source);
			break;
		case 'image/gif':
			$image = imagecreatefromgif($source);
			break;
		default:
			$image = imagecreatefromjpeg($source);
	}

	// Save image 
	imagejpeg($image, $destination, $quality);

	// Return compressed image 
	return $destination;
}

function manteince($id)
{
	if ($id == "1") {
		$reae = "selected='selected'";
	}
	if ($id == "0") {
		$reae = "";
	}
	echo $reae;
}

function siteURL()
{
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domainName = $_SERVER['HTTP_HOST'] . '/';
	return $protocol  . $domainName;
}

function siteURL_FFF()
{
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domainName = $_SERVER['HTTP_HOST'];
	return $protocol  . $domainName;
}

function call_image_uploader($source)
{
	if (empty($source)) {
?>
		<div class="form-group">
			<labal for="post-image"><?php echo lang('dash_th_image'); ?></labal>
			<br>
			<label id="image_preview_box" class="image_preview_box_2" style="display: none;">
				<img class="del_image_content box_image_content_2" id="box_image_content" src="" width='250' height='250'> <i id="remove_image" onclick="remove_image();" title="<?php echo lang('dash_upload_image_remove'); ?>" class="fas fa-times"></i><i id="max_image" title="<?php echo lang('dash_upload_image_max_view'); ?>" data-toggle="modal" data-target="#image_preview" class="fas fa-expand"></i></label>

			<div class="input-group">
				<span class="input-group-addon input-group-addon-frnds" data-toggle="modal" data-target="#exampleModalCenter_GALLERY_UPLOAD" onclick="open_image_for_title()" id="open_image_for_title"><span class=" glyphicon glyphicon-modal fas fa-file-upload"></span> <?php echo lang("IMAGE_IU"); ?></span>
				<input type="url" name="post-image" id="input_type__file" class="form-control input_type__file-image_post input_type__file-image_post_2" />
			</div>
		</div>
	<?php
	} else {

	?>

		<div class="form-group">
			<labal for="post-image"><?php if (empty($_GET['delete_post_id'])) {
										echo lang('dash_th_edit_image');
									} ?></labal>
			<br>
			<label id="image_preview_box" class="image_preview_box_2">
				<img class="del_image_content box_image_content_2" id="box_image_content" src="<?php echo $source;  ?>" width='250' height='250'> <?php if (empty($_GET['delete_post_id'])) { ?> <i id="remove_image" onclick="remove_image();" title="<?php echo lang('dash_upload_image_remove'); ?>" class="fas fa-times"></i><?php } ?><i id="max_image" <?php if (!empty($_GET['delete_post_id'])) {
																																																																																									echo "style='margin-top:8px !important;'";
																																																																																								} ?> title="<?php echo lang('dash_upload_image_max_view'); ?>" data-toggle="modal" data-target="#image_preview" class="fas fa-expand"></i></label>

			<div class="input-group">
				<span class="input-group-addon input-group-addon-frnds" onclick="open_image_for_title()" data-toggle="modal" data-target="#exampleModalCenter_GALLERY_UPLOAD" id="open_image_for_title"><span class="glyphicon glyphicon-modal fas fa-file-upload"></span> <?php echo lang("IMAGE_IU"); ?></span>
				<input type="url" name="post-image" id="input_type__file" value="<?php echo $source; ?>" class="form-control input_type__file-image_post input_type__file-image_post_2" />

			</div>
		</div>
	<?php
	} ?>
	<div class="modal fade" id="image_preview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-expand"></i> <?php echo lang('dash_upload_image_max_view'); ?></h5>

				</div>
				<div class="modal-body modal-body-content modal-body-content-content-f">
					<img id="box_modal_image_preivew" src="<?php echo $source;  ?>" /></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo lang('public_about_copyright_tr_title_close'); ?></button>
				</div>
			</div>

		</div>
	</div>
	<?php
}

function active_nav($code)
{

	$ifriner = "";
	if (!empty($_GET['admin'])) {
		if ($code == "dashboard") {
			if ($_GET['admin'] == "dashboard") {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "post") {
			if ($_GET['admin'] == "post") {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "category") {
			if ($_GET['admin'] == "category") {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "slider") {
			if ($_GET['admin'] == "slider") {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "plugins") {
			if ($_GET['admin'] == "plugins") {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "quotes") {
			if (strpos($_GET['admin'], "quotes") !== false) {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "contacts") {
			if (strpos($_GET['admin'], "contacts") !== false) {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "other") {
			if ($_GET['admin'] == "other") {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "pages") {
			if ($_GET['admin'] == "pages") {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "admin") {
			if ($_GET['admin'] == "admin") {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "comments") {
			if ($_GET['admin'] == "comments") {
				$ifriner =  "class='active'";
			}
		}
		/*
	if ($code == "backup") {
		if ($_GET['admin'] == "backup") {
			$ifriner =  "class='active'";
		}
	} 
	 */
		if ($code == "news") {
			if ($_GET['admin'] == "news") {
				$ifriner =  "class='active'";
			}
		}
		if ($code == "edp") {
			if ($_GET['admin'] == "edp") {
				$ifriner =  "class='active'";
			}
		}
	}
	echo $ifriner;
}
 
function Query($query)
{
	//$eronelitAPI->Query($query);

 
 
	global $con;

	try {

		$exec = mysqli_query($con, $query) or die(LOG_F($con));
		if ($exec) {
			if (strpos($query, "lang") !== false) {
			} else {
				LOG_F($query);
			}
			return $exec;
		}
	} catch (Exception $e) {
		LOG_F($e);
		//	header("location: /?installer=1");
	}

	return false; 
}

function row_number($table, $row, $url, $icon, $lang)
{

	$i = 0;
	foreach (glob('plugins/*/conf.php') as $file) {
		$i++;
	}
	$tttime = time();
	if ($table == "custom") {
		function number()
		{
		}
	?>

		<article id="<?php echo $tttime; ?>" class="location-listing">
			<a class="location-title">
				<?php echo lang('dash_th_id') . ": " .  $i; ?> </a>
			<span class="nav-pills-span-txt glyphicon <?php echo $icon; ?> location-title-2">&nbsp;<span class="title_fel"><?php echo $lang;  ?></span></span>
			<div class="location-image">
				<a href="/?admin=<?php echo $url; ?>">
					<div class="response-image"></div>
				</a>
				<p-message onclick="window.location.href = '/?admin=<?php echo $url; ?>'; ">
					<?php echo lang('dash_open_link') . " /?admin=$url" ?>
				</p-message>
		</article>

	<?php
	} else if ($table == "folder") {

		$files = glob($row);
		$count = 0;
		$totalCount = 0;
		$subFileCount = 0;
		foreach ($files as $file) {
			global $count, $totalCount;
			if (is_dir($file)) {
				$totalCount += getFileCount($file);
			}
			if (is_file($file)) {
				$count++;
			}
		}

		function getFileCount($dir)
		{
			global $subFileCount;
			if (is_dir($dir)) {
				$subfiles = glob($dir . '/*');
				if (count($subfiles)) {
					foreach ($subfiles as $file) {
						getFileCount($file);
					}
				}
			}
			if (is_file($dir)) {
				$subFileCount++;
			}
			return $subFileCount;
		}

		$totalFilesCount = $count + $totalCount;
	?>

		<article id="<?php echo $tttime; ?>" class="location-listing">
			<a class="location-title">
				<?php echo lang('dash_th_id') . ": " . $totalFilesCount; ?> </a>
			<span class="nav-pills-span-txt glyphicon fas fa-file location-title-2">&nbsp;<span class="title_fel"><?php echo $lang;  ?></span></span>
			<div class="location-image">
				<a href="/?admin=<?php echo $url; ?>">
					<div class="response-image"></div>
				</a>
				<p-message onclick="window.location.href = '/?admin=<?php echo $url; ?>'; ">
					<?php echo lang('dash_open_link') . " /?admin=$url" ?>
				</p-message>
		</article>

		<?php
	} else {
		$row =	Query("SELECT $row FROM $table ORDER BY $row");
		if ($row) {
		?>
			<article id="<?php echo $tttime; ?>" class="location-listing">
				<a class="location-title" href="/?admin=<?php echo $url; ?>">
					<?php echo lang('dash_th_id') . ": " . mysqli_num_rows($row); ?> </a>
				<span class="nav-pills-span-txt glyphicon <?php echo $icon; ?> location-title-2">&nbsp;<span class="title_fel"><?php echo lang($lang); ?></span></span>
				<div class="location-image">
					<a href="/?admin=<?php echo $url; ?>">
						<div class="response-image"></div>
					</a>
					<p-message onclick="window.location.href = '/?admin=<?php echo $url; ?>'; ">
						<?php echo lang('dash_open_link') . " /?admin=$url" ?>
					</p-message>
			</article>
<?php
		} else {
			//	return false;
		}
	}
}

function LOGIN_HASH($username, $password1, $password2)
{
	$query = "SELECT * FROM cms_admin WHERE username = '$username' AND password = '$password2'";
	$exec = Query($query);
	if ($admin = mysqli_fetch_assoc($exec)) {
		return $admin;
	} else {
		return null;
	}
}

function LoginAttempt($username, $password)
{
	$query = "SELECT * FROM cms_admin WHERE username = '$username' AND password = '$password'";
	$exec = Query($query);
	if ($admin = mysqli_fetch_assoc($exec)) {
		return $admin;
	} else {
		return null;
	}
}


function lang_set()
{
	$sql = "SELECT lang FROM other";
	$exec = Query($sql);

	while ($row = mysqli_fetch_assoc($exec)) {
		$lang = htmlentities($row['lang']);
		if ($lang == "EN") {
			include_once "./Include/lang/EN.php";
		}
		if ($lang == "RS") {
			include_once "./Include/lang/rs_latin.php";
		}
	}
}


function deleteCategory2()
{
	if (isset($_SESSION['optDeleteCategory'])) {
		$opt = "
			<div style='text-align:center;'>
				<span class='lead'>" . lang("OTHER_CATEGORY_DEL_SUREF") . " $_SESSION[categoryName]?</span>
				<div class='alert alert-info alert-category-alert-info'>
				<a href='./?admin=category&CategoryID=$_SESSION[del_id]'><button class='btn btn-danger btn-lg'><i class='fas fa-trash'></i>  " . lang('OTHER_MANTEINACE_ON') . "</button></a> | <a href='./?admin=category'><button class='btn btn-primary btn-lg'><i class='glyphicon glyphicon-tags'></i>&nbsp;&nbsp;" . lang('OTHER_MANTEINACE_OFF') . "</button></a>
				</div>
			</div>
		";
		$_SESSION['optDeleteCategory'] = null;
		$_SESSION['del_id'] = null;
		$_SESSION['optDeleteCategory'] = null;
		$_SESSION['categoryName'] = null;
		return $opt;
	}
}

function mantiance()
{
	$return_number = "";
	$sql = "SELECT mantiance FROM other";
	$exec = Query($sql);
	while ($row = mysqli_fetch_assoc($exec)) {
		return htmlentities($row['mantiance']);
	}
}

function manteiance_redirect_post_id($id)
{
	$sql = "SELECT mantiance FROM other";
	$exec = Query($sql);
	while ($row = mysqli_fetch_assoc($exec)) {
		$return_number =  htmlentities($row['mantiance']);
		if ($return_number == 1) {
			echo "./?admin=blog-post&id=" . $id;
		}
		if ($return_number == 0) {
			echo "./?p=news&id=" . $id;
		}
	}
}
function manteiance_redirect_forced()
{
	$sql = "SELECT mantiance FROM other";
	$exec = Query($sql);
	while ($row = mysqli_fetch_assoc($exec)) {
		$return_number =  htmlentities($row['mantiance']);
		if ($return_number == 1) {
		}
		if ($return_number == 0) {
		}
	}
}


function page_url_validator($url_page)
{

	echo '  <div class="form-group">
                                 <labal for="post-title">' . lang('url') . '</labal>
                                 <br>
                                 <div class="input-group">
                                     <span class="input-group-addon"><span class="glyphicon fas fa-dice"></span></span>
                                     <input type="text" id="post-title-url-page" onkeyup="get_url_is_avalaible()" name="url" class="form-control input-lg" placeholder="' . lang('url') . '" value="' . $url_page . '">
<span class="input-group-addon input-group-addon-url-yes-no bad-jla-1"><span class="glyphicon fas fa-check"></span>' . lang("URL_VALID_1") . '</span>
<span class="input-group-addon input-group-addon-url-yes-no bad-jla-2"><span class="glyphicon fas fa-check"></span>' . lang("URL_VALID_2") . '</span>
<span class="input-group-addon input-group-addon-url-yes-no bad-jla-3"><span class="glyphicon fas fa-check"></span>' . lang("URL_VALID_3") . '</span>

									 </div>
							 </div>';
}

function eronelit_doc_editor($content)
{

	$fonts = '<span class="edb-ton edb-ton-combo  fas fa-angle-down"><span id="font-sel"></span></span>';
	$fonts_size = '<span class="edb-ton edb-ton-combo  fas fa-angle-down"><span id="font-size"></span></span>';

	echo '<div class="form-group">
 								<labal for="post-content">' . lang('Post_textt_y_edit_new') . '</labal>
								' ./*<div class="p-admin-mark-top"> 
								<i id="undo" class="edb-ton edb-ton-prev fas fa-reply"></i>
								<i id="redo" class="edb-ton edb-ton-next fas fa-share"></i>
								<i class="edb-ton fas fa-file-pdf"></i>
								<i class="edb-ton fas fa-paragraph"></i>
								<i class="edb-ton fas fa-heading"></i>
								' . $fonts . $fonts_size . '
								<i class="edb-ton fas fa-align-right"></i>
								<i class="edb-ton fas fa-align-left"></i>
								<i class="edb-ton fas fa-italic"></i>
								<i class="edb-ton far fa-file-image"></i>
								<i class="edb-ton fas fa-code"></i></div> 
								'./*<div id="eronelit_div_editor_textarea" contenteditable="true"  class="form-control">' . $content . '</div>*/ '
								 <textarea  rows="20" class="form-control form-control-hidden" name="post-content" id="post-content">' . $content . '</textarea>
 							 	<p class="p-admin-mark"><i class="far fa-file-alt"></i>&nbsp;&nbsp;Eronelit document editor' ./*<span id="word_info">Ln: 0</span>*/ '</p> 
							 </div><style type="text/css">
							 .trumbowyg-button-pane {
									width: inherit !important;
									overflow: auto;
									display: inline-flex;
							 }
							 .trumbowyg-button-pane .trumbowyg-button-group {
								 display:inline-flex !important;
							 }
							 </style>';
}

function manteiance_redirect($url)
{
	$return_number = "";
	$return_number2 = "";
	if (!empty($url)) {
		$return_number2 = "&" . $url;
	} else {
		$return_number2 = "";
	}

	$sql = "SELECT mantiance FROM other";
	$exec = Query($sql);
	while ($row = mysqli_fetch_assoc($exec)) {
		$return_number =  htmlentities($row['mantiance']);
		if ($return_number == 1) {
			echo "./" . $return_number2;
		}
		if ($return_number == 0) {
			echo "./" . $return_number2;
		}
	}
}
function sanitize_my_email($field)
{
	$field = filter_var($field, FILTER_SANITIZE_EMAIL);
	if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
		return true;
	} else {
		return false;
	}
}

function EMAIL_STRING($to_email, $subject, $message, 	$headers)
{
	/*
	$to_email = 'name @ company . com';
	$subject = 'Testing PHP Mail';
	$message = 'This mail is sent using the PHP mail ';
	$headers = 'From: noreply @ company. com';
	*/
	//check if the email address is invalid $secure_check
	$secure_check = sanitize_my_email($to_email);
	if ($secure_check == false) {
		echo "Invalid input";
	} else { //send email 
		mail($to_email, $subject, $message, $headers);
		//echo "This email is sent using PHP Mail";
	}
}
function EMAIL_SENDS($subject, $message)
{
	$sql_sender = "SELECT * FROM email_sender ORDER BY date DESC LIMIT 0,53333333";

	$exec_sender = Query($sql_sender);
	$postNo_sender = 1;

	while ($post_sender_F = mysqli_fetch_assoc($exec_sender)) {
		$comment_id_sender =       $post_sender_F['id'];
		$comment_dateTime_sender = $post_sender_F['date'];
		$comment_email_sender =    $post_sender_F['email'];

		EMAIL_STRING($comment_email_sender, $subject, $message, "From: noreply@globalbusinessnets.com/");

		$postNo_sender++;
	}
}

function manteince_icon()
{
	$return_number = "";
	$sql = "SELECT mantiance FROM other";
	$exec = Query($sql);
	while ($row = mysqli_fetch_assoc($exec)) {
		$return_number =  htmlentities($row['mantiance']);
		if ($return_number == 1) {
			echo 'fas fa-lock';
		}
		if ($return_number == 0) {
			echo 'fas fa-unlock';
		}
	}
}




function get_server_memory_usage()
{

	$free = shell_exec('free');
	$free = (string)trim($free);
	$free_arr = explode("\n", $free);
	$mem = explode(" ", $free_arr[1]);
	$mem = array_filter($mem);
	$mem = array_merge($mem);
	$memory_usage = $mem[2] / $mem[1] * 100;

	return $memory_usage;
}


function nest_plugin_class($class)
{
	return $class = new $class(new api());
}
function get_server_cpu_usage()
{

	$load = sys_getloadavg();
	return $load[0];
}
