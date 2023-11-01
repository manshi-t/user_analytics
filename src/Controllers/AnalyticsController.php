<?php

namespace Mansi\Analytics\Controllers;

use Illuminate\Http\Request;
use DeviceDetector\DeviceDetector;
use GeoIp2\Database\Reader;
use Illuminate\Support\Facades\Log;
use Mansi\Analytics\Models\Session;
use Mansi\Analytics\Models\VisitedPage;
use Mansi\Analytics\Models\PageActivity;

session_start();

class AnalyticsController
{
    static $clientInfomation = array();
    static $pageInfo = array();

    /**
     * get user information
     */
    public function getClientInfo(Request $request)
	{
        try {
            $sessionId = $_COOKIE['PHPSESSID'];
            $ip = $request->ip();
            $serverDetail = self::clientInfo();
            $device = new DeviceDetector($_SERVER['HTTP_USER_AGENT']);
            $device->parse();
            $clientInfo = $device->getClient(); 
            $os = $device->getOs();
            $name = $device->getDeviceName();
            $brand = $device->getBrandName();
            $model = $device->getModel();
            $data = json_decode(file_get_contents('php://input'), true);
            $len = sizeof($data);
            self::$pageInfo = array_merge(self::$pageInfo,$data[$len-1]);
            unset($data[$len-1]);
            $pageActivity = $data;
            self::$clientInfomation =  array_merge(self::$clientInfomation,['session_id' => $sessionId],['ip_address' => $ip],['device_name' => $name],
                ['country' => $serverDetail['server_country']],['state' =>  $serverDetail['server_state']], ['city' => $serverDetail['server_city']],
                ['model' => $model], ['brand' => $brand],['os' => $os['name']], ['browser' => $clientInfo['name']], 
                ['Duration' => self::$pageInfo['totalTime']],['page_url' => self::$pageInfo['url']],['pageActivity' => $pageActivity]
            );
            $this->insertClientInformation(self::$clientInfomation);

            $response = [
                'type' => 'success',
                'code' => 200,
                'message' => "UserInfo Store Successfully",
                'data' => self::$clientInfomation,
            ];

            return response()->json($response, 200);
        } catch (\Throwable $e) {
            Log::error($th->getMessage());
            $response = [
                'type' => 'error',
                'code' => 500,
                'message' => $th->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * store user information in database.
     */
    public function insertClientInformation($clientInfomation){

        $ignoreUrls = config('ignoreUrl');
		/**
		 * insert data in sessions table
		 */

         $userSession = Session::firstOrCreate([
            'session_id' => $clientInfomation['session_id'],
            'ip_address' => $clientInfomation['ip_address'],
            'device_name' => $clientInfomation['device_name'],
            'model' => $clientInfomation['model'],
            'brand' => $clientInfomation['brand'],
            'os' => $clientInfomation['os'],
            'browser' => $clientInfomation['browser']
         ],
            [
            'country' => $clientInfomation['country'],
            'state' => $clientInfomation['state'],
            'city' => $clientInfomation['city'],
         ]);

        if (!empty($clientInfomation['page_url']) && !in_array($clientInfomation['page_url'],$ignoreUrls)) {

        /**
		 * insert data in visited_pages table
		*/
            $visitedPage = VisitedPage::firstOrCreate([
                'page_url' => $clientInfomation['page_url'],
            ],
                [
                'time_spent' => $clientInfomation['Duration'],
                'website' => str_contains($clientInfomation['page_url'],'admin') ? 'backend' : 'frontend',
                'status' => $clientInfomation['page_url'] ? 'running' : 'failed'
            ]);

            /**
		    * insert data in visited_pages table
		    */
            if (!empty($clientInfomation['pageActivity'])) {
                for ($i=0; $i<sizeof($clientInfomation['pageActivity']); $i++) { 
                    $insertActivity[$i] = PageActivity::create([
                        'clicked_element' => $clientInfomation['pageActivity'][$i]['clickedElement'],
                        'timestamp' => $clientInfomation['pageActivity'][$i]['timestamp'],
                        'visited_page_id' => $visitedPage->id,
                        'session_id' => $clientInfomation['session_id'],
                        'action' => $clientInfomation['pageActivity'][$i]['action']
                    ]);
                }
            }
        }
    }

    /**
	* get client location information(country,state,city) from ip address
	*/
    public static function clientInfo()
    {   
        $serverIpDetail = [
            'server_city' => '',
            'server_state' => '',
            'server_country' => '',
            'server_country_code' => '',
            'server_continent' => '',
            'server_continent_code' => '',
            'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
            'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
            'HTTP_REFERER' => isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'-'
        ];
        try{
            /** 
             * Add ip detail with server detail
             */
            $reader = new Reader(base_path().'/packages/laravel/analytics/src/database/maxmind/GeoLite2-City.mmdb');
            $record = $reader->city($_SERVER['REMOTE_ADDR']);
            $serverIpDetail['server_city'] = $record->city->name;
            $serverIpDetail['server_state'] = $record->mostSpecificSubdivision->name;
            $serverIpDetail['server_country'] = $record->country->name;
            $serverIpDetail['server_country_code'] = $record->country->isoCode;
            $serverIpDetail['server_continent'] = $record->continent->name;
            $serverIpDetail['server_continent_code'] = $record->continent->code;

        }catch(\Exception $e){
            Log::error($e->getMessage());
        }
        
        return $serverIpDetail;
    }

}
