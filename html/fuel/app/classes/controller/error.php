<?php


class Controller_Error extends Controller_App
{
    public function action_404(){
        return Response::forge(Presenter::forge('error/404'), 404);
    }

    public function action_500(){
        return Response::forge(Presenter::forge('error/500'), 500);
    }

}