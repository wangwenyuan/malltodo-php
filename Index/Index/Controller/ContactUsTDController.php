<?php
require_once 'BaseTDController.php';

class ContactUsTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/ContactUs/index");
    }
}