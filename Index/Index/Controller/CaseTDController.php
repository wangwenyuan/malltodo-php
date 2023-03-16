<?php
require_once __DIR__ . '/BaseTDController.php';

class CaseTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/Case/index");
    }
}