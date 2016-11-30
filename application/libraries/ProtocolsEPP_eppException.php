<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/11/2016
 * Time: 7:35 PM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPEpp/Protocols/EPP/eppException.php";


class EppException extends Metaregistrar\EPP\eppException
{

    public function __construct()
    {

        parent::__construct();

    }

}