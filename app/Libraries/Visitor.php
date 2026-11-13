<?php
namespace App\Libraries;

use App\Models\VisitorModel;

class Visitor
{
    protected $visitorModel;

    public function __construct()
    {
        $this->visitorModel = new VisitorModel();
    }

    public function addHist($nameApp)
    {
        $data = array(
            'name_app'  => $nameApp,
            'hits'      => 1,
            'created_at'=> get_timestamp(),
            'updated_at'=> get_timestamp(),
        );
        $this->visitorModel->insert($data);
    }
}