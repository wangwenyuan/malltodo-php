<?php
require_once 'BaseTDController.php';

class ProductTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/Product/index");
    }
}