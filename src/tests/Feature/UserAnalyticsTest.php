<?php

namespace Mansi\Analytics\Tests\Feature;

use Tests\TestCase;
use Mansi\Analytics\Controllers\AnalyticsController;

class UserAnalyticsTest extends TestCase
{
    
    public function test_for_userInfo_creating(){
        $response = $this->get_userInfo();
        $response->assertStatus(200);
    }

    public function get_userInfo(){
    
      // Positive test case
      $clientInfomation = array(
            "session_id" => "e73v6hv24v5e30jfaqnk2gi12i",
            "ip_address" => "127.0.0.1",
            "device_name" => "desktop",
            "country" => "",
            "state" => "",
            "city" => "",
            "model" => "",
            "brand" => "",
            "os" => "Ubuntu",
            "browser" => "Firefox",
            "Duration" => 15.183,
            "page_url" => "http://127.0.0.1:8000/index",
            "pageActivity" => [
                [
                  "clickedElement" => "Index page web development company slider 'Get a Free Quote' button",
                  "timestamp" => "2023-11-01T04:48:19.769Z",
                  "action" => "Get a Free Quote"
                ],
                [
                  "clickedElement" => "Index page app development company slider 'Get a Free Quote' button",
                  "timestamp" => "2023-11-01T04:48:20.842Z",
                  "action" => "Get a Free Quote"
                ],
                [
                  "clickedElement" => "Index page hire remote developers slider 'Hire Now' button",
                  "timestamp" => "2023-11-01T04:48:22.147Z",
                  "action" => "Hire Now"
                ],
                [
                  "clickedElement" => "Game Developemnt",
                  "timestamp" => "2023-11-01T04:48:23.338Z",
                  "action" => "Game Developemnt"
                ]
            ]
        );

        $clientInfo = new AnalyticsController();
        $response = $clientInfo->insertClientInformation($clientInfomation);
        $this->test_for_userInfo_creating($clientInfomation);
        return $response['data'];
    }
}
