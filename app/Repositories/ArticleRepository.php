<?php

namespace App\Repositories;

use App\Article;
use App\Scopes\DraftScope;
use Illuminate\Support\Facades\DB;

class ArticleRepository
{
    use BaseRepository;

    protected $model;

    protected $visitor;

    public function __construct(Article $article, VisitorRepository $visitor)
    {
        $this->model = $article;

        $this->visitor = $visitor;
    }

    /**
     * Get the page of articles without draft scope.
     *
     * @param  Request $request
     * @param  integer $number
     * @param  string  $sort
     * @param  string  $sortColumn
     * @return collection
     */
    public function pageWithRequest($request, $number = 10, $sort = 'desc', $sortColumn = 'created_at')
    {
        $this->model = $this->checkAuthScope();

        $keyword = $request->get('keyword');

        return $this->model
                    ->when($keyword, function ($query) use ($keyword) {
                        $query->where('title', 'like', "%{$keyword}%")
                            ->orWhere('subtitle', 'like', "%{$keyword}%");
                    })
                    ->orderBy($sortColumn, $sort)->paginate($number);
    }

    /**
     * Get the page of articles without draft scope.
     *
     * @param  integer $number
     * @param  string  $sort
     * @param  string  $sortColumn
     * @return collection
     */
    public function page($number = 10, $sort = 'desc', $sortColumn = 'created_at')
    {
        $this->model = $this->checkAuthScope();

        return $this->model->orderBy($sortColumn, $sort)->paginate($number);
    }

    /**
     * Get the article record without draft scope.
     *
     * @param  int $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->withoutGlobalScope(DraftScope::class)->findOrFail($id);
    }

    /**
     * Update the article record without draft scope.
     *
     * @param  int $id
     * @param  array $input
     * @return boolean
     */
    public function update($id, $input)
    {
        $this->model = $this->model->withoutGlobalScope(DraftScope::class)->findOrFail($id);

        return $this->save($this->model, $input);
    }

    /**
     * Get the article by article's slug.
     * The Admin can preview the article if the article is drafted.
     *
     * @param $slug
     * @return object
     */
    public function getBySlug($slug)
    {
        $this->model = $this->checkAuthScope();

        $article = $this->model->where('slug', $slug)->firstOrFail();

        $article->increment('view_count');

        $this->visitor->log($article->id);

        return $article;
    }

    /**
     * Check the auth and the model without global scope when user is the admin.
     *
     * @return Model
     */
    public function checkAuthScope()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            $this->model = $this->model->withoutGlobalScope(DraftScope::class);
        }

        return $this->model;
    }

    /**
     * Sync the tags for the article.
     *
     * @param  int $number
     * @return Paginate
     */
    public function syncTag(array $tags)
    {
        $this->model->tags()->sync($tags);
    }

    /**
     * Search the articles by the keyword.
     *
     * @param  string $key
     * @return collection
     */
    public function search($key)
    {
        $key = trim($key);

        return $this->model
                    ->where('title', 'like', "%{$key}%")
                    ->orderBy('published_at', 'desc')
                    ->get();

    }

    /**
     * Delete the draft article.
     *
     * @param int $id
     * @return boolean
     */
    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * Notes:获取文章归档数据
     * User:
     * Date:2018/9/24
     * @return array
     */
    public function articleGroupByTime(){
        $article_group_by_time=DB::select('select DATE_FORMAT(published_at,\'%Y%m\') as time,COUNT(DATE_FORMAT(published_at,\'%Y%m\')) as counts from articles GROUP BY DATE_FORMAT(published_at,\'%Y%m\')');
        return array_reverse($article_group_by_time);
    }

    /**
     * Notes:获取排行榜文章
     * User:
     * Date:2018/9/24
     * @param int $number
     * @param string $sort
     * @param string $sortColumn
     * @return mixed
     */
    public function articleGetByViewCount($number = 5, $sort = 'desc', $sortColumn = 'view_count'){
        $article_get_by_view_count=$this->model->select('title','slug','view_count')->orderby($sortColumn,$sort)->limit($number)->get();
        return $article_get_by_view_count;
    }
    public function articleGetByPublishedTime($time){
        $articles=$this->model->select('title','slug','view_count')->whereYear('published_at',$time['year'])->whereMonth('published_at',$time['month'])->get();
        return $articles;
    }
}
