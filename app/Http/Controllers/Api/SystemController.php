<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;

class SystemController extends ApiController
{
     protected $personalsetting=array(
         'USER_REGISTER'=>'',
         'DISCUSSION_SHARE'=>'',
         'ARTICLE_SHARE'=>''
     );
    /**
     * SystemController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the system info.
     * 
     * @return mixed
     */
    public function getSystemInfo()
    {
        $pdo     = \DB::connection()->getPdo();

        $version = $pdo->query('select version()')->fetchColumn();

        $data = [
            'server'          => $_SERVER['SERVER_SOFTWARE'],
            'http_host'       => $_SERVER['HTTP_HOST'],
            'remote_host'     => isset($_SERVER['REMOTE_HOST']) ? $_SERVER['REMOTE_HOST'] : $_SERVER['REMOTE_ADDR'],
            'user_agent'      => $_SERVER['HTTP_USER_AGENT'],
            'php'             => phpversion(),
            'sapi_name'       => php_sapi_name(),
            'extensions'      => implode(", ", get_loaded_extensions()),
            'db_connection'   => isset($_SERVER['DB_CONNECTION']) ? $_SERVER['DB_CONNECTION'] : 'Secret',
            'db_database'     => isset($_SERVER['DB_DATABASE']) ? $_SERVER['DB_DATABASE'] : 'Secret',
            'db_version'      => $version,
        ];
        $data=array_merge($data,$this->getEnv($this->personalsetting));
        return $this->response->json($data);
    }
    public function status($setting,Request $request){
        $value=$request->post('status')?'true':'false';
        $this->modifyEnv(array($setting=>$value));
    }
    function getEnv(array $data=['APP_ENV'=>'','LOCALE'=>'','ARTICLE_SHARE'=>''])
    {
//        $systemSettings=array();
//        $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
//        $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
//        $contentArray->transform(function ($item) use ($data)
//        {
//            foreach ($data as $key => $value) {
//                if (str_contains($item, $key)) {
//                    return $item;
//                }
//            }
//        }
//        );
//        $preg = "/(\w+)=(\S*)/i";
//        foreach (array_filter($contentArray->toArray()) as $key => $value) {
//            preg_match($preg, $value, $arr);
//            $systemSettings[]=array('id'=>$arr[1],'status'=> (bool)$arr[2]);
//        }
//        var_dump($systemSettings);
        foreach ($data as $key=>$value){
            $systemSettings[]=array('id'=>$key,'status'=>env($key));
        }
        return array('personalsettings'=>$systemSettings);
    }

    /**
     * Notes:修改配置文件
     * User:
     * Date:2018/10/16
     * @param array $data
     */
    function modifyEnv(array $data)
    {
        $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
        $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
        $contentArray->transform(function ($item) use ($data)
        {
            foreach ($data as $key => $value) {
                if (str_contains($item, $key)) {
                    return $key . '=' . $value;
                }
            }
            return $item;
        }
        );
        $content = implode($contentArray->toArray(), "\n");
        \File::put($envPath, $content);
    }
    function test(){
        echo config('blog.test');
        config('blog.test','tttt');
        echo "<hr>";
        echo config('blog.test');
    }
}
