<?php

namespace Controllers;

use Core\Controller;
use GuzzleHttp\Client;
class ControllerTest extends Controller
{
    public $client;
    public function __construct()
	{
		parent::__construct();
		$this->client = new Client();
	}   


public function actionIndex()
	{
        $response = $this->client->request('GET', 'https://docs.guzzlephp.org/en/stable/quickstart.html');
        try {
            dd($response->getBody());
        } catch (\Exception $e) {
            // How can I get the response body?
        }
    }
}
