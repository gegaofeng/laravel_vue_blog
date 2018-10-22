<?php

namespace App\Tools;

use Illuminate\Http\Request;

class IP
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * IP constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the client ip.
     *
     * @return mixed|string
     */
    public function get()
    {
        $ip = $this->request->getClientIp();
        if ($ip == '::1') {
            $ip = '127.0.0.1';
        }
        return $ip;
    }

    public function getIpInfo()
    {
//        $ip = $this->get();
        $ip = '222.78.116.22';
        if ($ip == '127.0.0.1') {
            return 'localhost';
        }
        $ip_info = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip);
        $ip_info = json_decode($ip_info, true);
        if ($ip_info['data']['country_id']=='CN'){
            return $ip_info['data']['country'].'-'.$ip_info['data']['region'].'-'.$ip_info['data']['city'];
        }else{
            return $ip_info['data']['country'];
        }
    }
}
