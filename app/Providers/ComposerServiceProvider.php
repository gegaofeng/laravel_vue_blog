<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * 在容器内注册所有绑定。
     *
     * @return void
     */
    public function boot()
    {
        // 使用对象型态的视图组件...
        view()->composer(
            'widgets.article_list', 'App\Http\ViewComposers\ProfileComposer'
        );

        // 使用闭包型态的视图组件...
//        view()->composer('widgets.article_list', function ($view) {
//            $view->with('test',array('name'=>'hehe'));
//        });
    }

    /**
     * 注册服务提供者。
     *
     * @return void
     */
    public function register()
    {
        //
    }
}