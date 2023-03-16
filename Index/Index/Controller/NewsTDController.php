<?php
require_once __DIR__ . '/BaseTDController.php';

class NewsTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/News/index");
    }
}