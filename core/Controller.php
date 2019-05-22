<?php
abstract class Controller
{
    protected $page = null;

    public function __construct()
    {
        $this->page = get_called_class();
    }
}