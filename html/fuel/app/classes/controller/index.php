<?php

use Fuel\Core\View;

class Controller_Index extends Controller_App {
    public function action_index():void
    {
        $this->template->content = View::forge('index/index');
    }

    public function action_start():void
    {
        $this->startAuth();
    }

}