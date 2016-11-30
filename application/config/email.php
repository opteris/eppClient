<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/25/2016
 * Time: 11:11 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'mail.dcareug.com';
$config['smtp_port'] = '587';

/*$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://mail.dcareug.com';
$config['smtp_port'] = '465';*/

$config['smtp_user'] = 'ors@dcareug.com';
$config['smtp_pass'] = 'pass@dc2016';
$config['smtp_timeout'] = 5;
$config['mailtype'] = 'html';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";

