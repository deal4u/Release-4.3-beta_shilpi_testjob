<?php
class Admin404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        show_admin404();//loading in custom error view
    }
}