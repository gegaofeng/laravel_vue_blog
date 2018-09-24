
    <div class="aside-content">
        <div>
        <ul class="list-group">
            <li class="list-unstyled">
                <a class="list-group-item text-dark" href="javascript:void(0);">
                    <h5 class="aside-title">分类</h5>
                </a>
            </li>
            @foreach($article_group_by_tags as $tag=>$count)
                @if($count!=0)
            <li class="list-unstyled">
                <a class="list-group-item text-dark" href="{{ url('tag', $tag) }}">
                    <span class="label"><i class="fas fa-tag"></i> {{$tag}}</span>
                    <span class="count float-right">{{$count}}篇</span>
                </a>
            </li>
                @endif
            @endforeach
            {{--<li class="list-unstyled">--}}
                {{--<a class="list-group-item text-dark" href="https://blog.csdn.net/wangcuiling_123/article/category/6967597">--}}
                    {{--<span class="title oneline">javascript</span>--}}
                    {{--<span class="count float-right">14篇</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
        </div>
        <div style="margin-bottom: 8px"></div>
        <div>
        <ul class="list-group">
            <li class="list-unstyled">
                <a class="list-group-item text-dark" href="javascript:void(0);">
                    <h5 class="aside-title">归档</h5>
                </a>
            </li>
            @foreach($article_group_by_time as $article)
                    <li class="list-unstyled">
                        <a class="list-group-item text-dark" href="{{url('month',$article->time)}}">
                            <span class="label">{{date('Y年n月',strtotime($article->time.'01'))}}</span>
                            <span class="count float-right">{{$article->counts}}篇</span>
                        </a>
                    </li>
            @endforeach
        </ul>
    </div>
        <div style="margin-bottom: 8px"></div>
        <div>
            <ul class="list-group">
                <li class="list-unstyled">
                    <a class="list-group-item text-dark" href="javascript:void(0);">
                        <h5 class="aside-title">热门文章</h5>
                    </a>
                </li>
                @foreach($article_get_by_view_count as $article)
                    <li class="list-unstyled">
                        <a class="list-group-item text-dark" href="{{url($article->slug)}}">
                            <span class="label">{{$article->title}}</span>
                            <span class="count float-right"><i class="fas fa-eye"></i> {{$article->view_count}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>