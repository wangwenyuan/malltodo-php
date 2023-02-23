<?php
require_once 'BaseTDController.php';

class NewsTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/News/index");
    }
}