<?php

use Fuel\Core\View;
use \Fuel\Core\Session;
use Fuel\Core\Response;

class Controller_Index extends Controller_App {
    public function action_index():void
    {
        $this->template->content = View::forge('index/index');
    }

    public function action_start():void
    {
        $data = [];
        $data['redirect_url'] = $this->startAuth(false);
        $this->template->content = View::forge('index/start',$data);
    }

    public function action_logout(): void
    {
        Session::delete('UserId');
        Session::delete('AccessToken');
        Session::delete('RefreshToken');
        Response::redirect('/');
    }

}