<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;

class SystemController extends ApiController
{
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

        return $this->response->json($data);
    }


    /**
     * Notes:
     * User:
     * Date:2018/10/16
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    function getEnv(array $data=['APP_ENV'=>'','LOCALE'=>'','ARTICLE_SHARE'=>''])
    {
        $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
        $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
        $contentArray->transform(function ($item) use ($data)
        {
            foreach ($data as $key => $value) {
                if (str_contains($item, $key)) {
                    return $item;
                }
            }
        }
        );
        $preg = "/(\w+)=(\S*)/i";
        foreach (array_filter($contentArray->toArray()) as $key => $value) {
            preg_match($preg, $value, $arr);
            $systemSettings[$arr[1]] = $arr[2];
        }
//        var_dump($systemSettings);
        return $this->response->json($systemSettings);
    }

    /**
     * Notes:修改配置文件
     * User:
     * Date:2018/10/16
     * @param array $data
     */
    function modifyEnv(Request $request)
    {
        $data=$request;
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
}
