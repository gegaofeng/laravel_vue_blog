<?php

namespace App\Http\ViewComposers;

use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;
use Illuminate\Contracts\View\View;

class ProfileComposer
{
    /**
     * 用户对象的实例。
     *
     * @var UserRepository
     */
    protected $tag;
    protected $article;

    /**
     * 创建一个新的个人数据视图组件。
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(TagRepository $tag,ArticleRepository $article)
    {
        // 所有依赖都会自动地被服务容器解析...
        $this->tag = $tag;
        $this->article=$article;
    }

    /**
     * 将数据绑定到视图。
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('article_group_by_tags', $this->tag->articleGroupBytag());
        $view->with('article_group_by_time',$this->article->articleGroupByTime());
        $view->with('article_get_by_view_count',$this->article->articleGetByViewCount());
    }
}