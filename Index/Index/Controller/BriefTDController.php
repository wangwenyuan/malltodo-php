<?php
require_once __DIR__ . '/BaseTDController.php';

class BriefTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/Brief/index");
    }
}