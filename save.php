<?php
header('Location: ' . $_SERVER['HTTP_REFERER'] . "?wptopd-saved=true");

$path = dirname(__FILE__);
$path_1 = str_replace('wp-content/plugins/wptopd', '', $path);
$path_1 = str_replace('wp-content\plugins\wptopd', '', $path_1);
require_once($path_1 .'wp-config.php');

function wptopd_create_person($api_token, $person) {
  $url = "https://api.pipedrive.com/v1/persons?api_token=" . $api_token;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $person);
  $output = curl_exec($ch);
  $info = curl_getinfo($ch);
  curl_close($ch);
}

$token = get_option("wptopd_api_token");
$person = array(
  'name'  => $_POST['wptopd-name'],
  'email' => $_POST['wptopd-email'],
  'phone' => $_POST['wptopd-phone']
);

wptopd_create_person($token, $person);
?>
