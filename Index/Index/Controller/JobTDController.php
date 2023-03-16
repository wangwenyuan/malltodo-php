<?php
require_once __DIR__ . '/BaseTDController.php';

class JobTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/Job/index");
    }
}