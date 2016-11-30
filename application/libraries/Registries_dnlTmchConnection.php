<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/11/2016
 * Time: 7:35 PM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPEpp/Registries/dnlTmchConnection/tmchConnection.php";


class DnlTmchConnection extends Metaregistrar\TMCH\dnlTmchConnection
{

    public function __construct()
    {

        parent::__construct();

    }

}