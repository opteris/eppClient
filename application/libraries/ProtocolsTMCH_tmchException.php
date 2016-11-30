<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/11/2016
 * Time: 7:35 PM
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPEpp/Protocols/TMCH/tmchData/tmchException.php";


class TmchException extends Metaregistrar\TMCH\tmchException
{

    public function __construct()
    {

        parent::__construct();

    }

}