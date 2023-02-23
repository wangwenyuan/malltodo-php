<?php
require_once 'BaseTDController.php';

class BriefTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/Brief/index");
    }
}