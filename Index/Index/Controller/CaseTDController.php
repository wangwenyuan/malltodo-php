<?php
require_once 'BaseTDController.php';

class CaseTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/Case/index");
    }
}