<?php

Use \Fuel\Core\Controller_Template;
Use \Fuel\Core\Request;
Use Fuel\Core\Response;
Use Fuel\Core\Session;
use Fuel\Core\View;

Class Controller_App extends Controller_Template
{

    /**
     * @var SpotifyWebAPI\Session
     */
    public $api_session;

    /**
     * @var SpotifyWebAPI\SpotifyWebAPI
     */
    public $api;

    /**
     *
     */
    public function before()
    {
        $this->api_session = new SpotifyWebAPI\Session(
            API_DATA['id'],
            API_DATA['secret']
            ,API_DATA['redirect_url']
        );
        $this->api = new SpotifyWebAPI\SpotifyWebAPI();

        if (isset($_GET['code'])) {
            $this->setToken($_GET['code']);
        }

        $this->refreshToken();

        return parent::before();
    }

    public function after($response){
        View::set_global('user_id', Session::get('UserId'));
        return parent::after($response);
    }

    public function startAuth($is_redirect):?string
    {
        $url = $this->auth();
        if($is_redirect){
            Response::redirect($url);
            die();
        }
        return $url;
    }

    public function refreshToken():void{
        $access_token = Session::get('AccessToken');
        $refresh_token = Session::get('RefreshToken');

        if(!empty($access_token) && !empty($refresh_token)){
            $this->api_session->refreshAccessToken($refresh_token);
            $access_token = $this->api_session->getAccessToken();
            $this->api->setAccessToken($access_token);
            Session::set('AccessToken',$access_token);
            Session::set('RefreshToken',$this->api_session->getRefreshToken());
        } else {
        }
    }


    private function setToken($code): void
    {
        try{
            $this->api_session->requestAccessToken($code);
        } catch (Exception $e){
            // エラー処理
            exit;
        }
        $access_token = $this->api_session->getAccessToken();
        $this->api->setAccessToken($this->api_session->getAccessToken());
        $refresh_token = $this->api_session->getRefreshToken();
        $user_id = $this->api->me()->id;
        if(!empty($access_token) && !empty($refresh_token)){
            Session::set('UserId', $user_id);
            Session::set('AccessToken', $access_token);
            Session::set('RefreshToken', $refresh_token);
            Response::redirect('/');
        }
    }

    private function auth():string
    {
        $options = [
            'scope' => [
                'playlist-read-private',
                'user-read-email',

            ],
        ];
        return $this->api_session->getAuthorizeUrl($options);
    }

    protected function getPagingOptions(int $page_num,int $limit = PAGE_LIMIT):?array {
        $offset = ($page_num - 1) * $limit;
        return [
            'offset' => $offset,
            'limit' =>$limit
        ];
    }

}