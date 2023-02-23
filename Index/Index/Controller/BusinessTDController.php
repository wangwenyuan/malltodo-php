<?php
require_once 'BaseTDController.php';

class BusinessTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/Business/index");
    }
}