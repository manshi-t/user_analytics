<?php

namespace Mansi\Analytics\Tests\Feature;

use Mansi\Analytics\Tests\TestCase;

class UserAnalyticsTest extends TestCase
{
    
    //creating product with it multiple items , item sizes and images.
    public function test_for_userInfo_creating()
    {
        $this->withoutExceptionHandling();
        $api = 'api/analysis';
        // Positive test case
        $userInfo = [
            'session_id' => 'i0fc7lg15l14dalr70pjhcbo0e',
            'ip_address' => '192.168.1.197',
            'device_name' => 'mobile',
            'brand' => 'samsung',
            'model'=>'samsung flip4',
            'os'=>'android',
            'browser'=>'chrome',
            'country'=>'india',
            'state'=>'gujarat',
            'city'=>'ahemdabad'
        ]; 
        $visitedPages = [
            'page_url' => 'https://webcodegenie.com/index',
            'website' => 'frontend',
            'status' => 'running',
            'time_spent' => 403
        ];
        $pageActivities = [
            'clicked_element' => "Index page web development company slider 'Get a Free Quote' button",
            'timestamp' => '2023-10-30T13:42:52.470Z',
            'visited_page_id' => 28,
            'session_id' => 'i0fc7lg15l14dalr70pjhcbo0e',
            'action' => 'Get a Free Quote'
        ];
    }

    //     // fetching all the Products
    public function test_for_userInfo_fetching_all()
    {
        // $this->test_for_product_creating();
        $api = 'api/analysis';


        $response = $this->get($api);
        
        $response = [
            [
                'action' => "Get a Free Quote",
                'clickedElement' => "Index page web development company slider 'Get a Free Quote' button",
                'timestamp' => "2023-10-31T06:20:46.623Z"
            ],
            [
                'action' => "Get a Free Quote",
                'clickedElement' => "Index page app development company slider 'Get a Free Quote' button",
                'timestamp' => "2023-10-31T06:20:48.166Z"
            ],
            [
                'action' => "Hire Now",
                'clickedElement' => "Index page hire remote developers slider 'Hire Now' button",
                'timestamp'	=> "2023-10-31T06:20:49.518Z"
            ],
            [
                'action' => "Game Developemnt",
                'clickedElement' => "Game Developemnt",
                'timestamp'	=> "2023-10-31T06:20:51.742Z"
            ],
            [
                'end' => 1698733254051,
                'start' => 1698733245202,
                'totalTime' => 8.849,
                'url' => "http://127.0.0.1:8000/index"
            ]
        ]; 
    }
}
