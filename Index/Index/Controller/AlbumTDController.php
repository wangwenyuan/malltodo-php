<?php
require_once 'BaseTDController.php';

class AlbumTDController extends BaseTDController
{

    public function index()
    {
        $this->homePage("Index/Album/index");
    }
}