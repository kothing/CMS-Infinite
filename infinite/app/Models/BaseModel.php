<?php namespace App\Models;

use CodeIgniter\Model;
use Config\Globals;

class BaseModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->activeLangId = $this->session->get('activeLangId');
        $this->generalSettings = Globals::$generalSettings;
    }
}