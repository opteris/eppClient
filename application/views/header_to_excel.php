<?php
/**
 * Created by PhpStorm.
 * User: aasiimwe
 * Date: 9/20/2015
 * Time: 1:28 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$user_name = ($this->session->userdata['user_name']);
$page_name = ($this->session->userdata['page_name']);

header("Cache-control: private");
/*header("Content-type: application/octet-stream");*/
header("Content-Disposition: attachment; filename=".$page_name.".xls");
header("Content-Description: PHP Generated Data");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">

