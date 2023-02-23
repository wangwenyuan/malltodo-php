<?php
require_once 'BaseTDController.php';

class JobTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/Job/index");
    }
}