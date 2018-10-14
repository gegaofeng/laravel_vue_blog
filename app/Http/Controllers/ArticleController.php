<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    protected $article;

    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
    }

    /**
     * Display the articles resource.
     *
     * @return mixed
     */
    public function index()
    {
        $articles = $this->article->page(config('blog.article.number'), config('blog.article.sort'), config('blog.article.sortColumn'));

        return view('article.index', compact('articles'));
    }

    /**
     * Display the article resource by article slug.
     *
     * @param  string $slug
     * @return mixed
     */
    public function show($slug)
    {
        $article = $this->article->getBySlug($slug);

        return view('article.show', compact('article'));
    }

    /**
     * Notes:
     * User:
     * Date:2018/9/25
     * @param $month
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articleGroupByTime($month)
    {
        $time['year'] = substr($month, 0, 4);
        $time['month'] = substr($month, 5);
        $articles = $this->article->articleGetByPublishedTime($time);
        //        var_dump($articles);
        return view('article.month', compact('articles', 'time'));
    }

    public function test()
    {
//        return $this->readEnv(['TIMEZONE' => '', 'LOCALE' => '', 'APPLICATION_NAME' => '']);
        return $this->modifyEnv(['TIMEZONE' => '', 'LOCALE' => '', 'APPLICATION_NAME' => '']);
    }

    function readEnv(array $data)
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
            $systemSetting[$arr[1]] = $arr[2];
        }
        var_dump($systemSetting);
    }

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

}
