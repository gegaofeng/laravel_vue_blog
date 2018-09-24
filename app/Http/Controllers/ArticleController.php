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

    public function articleGroupByTime($month){
        $time['year']=substr($month,0,4);
        $time['month']=substr($month,5);
        $articles=$this->article->articleGetByPublishedTime($time);
//        var_dump($articles);
        return view('article.month',compact('articles','time'));
    }
    public function test(){
        $articles = $this->article->page(config('blog.article.number'), config('blog.article.sort'), config('blog.article.sortColumn'));
        print_r($articles);
    }
}
