<?php

/**
 * summary
 */
class Quit extends Controller
{
    public function index()
    {
    	session_start();
    	session_destroy();
    	header("Location: ./");
    	//echo "123131313132";
    }
}