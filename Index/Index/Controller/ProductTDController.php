<?php
require_once __DIR__ . '/BaseTDController.php';

class ProductTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/Product/index");
    }
}