<?php

return [

    // Mail Notification
    'mail_notification' => env('MAIL_NOTIFICATION') ?: false,

    // Default Avatar
    'default_avatar' => env('DEFAULT_AVATAR') ?: '/images/default.png',

    // Default Icon
    'default_icon' => env('DEFAULT_ICON') ?: '/images/favicon.ico',

    // Color Theme
    'color_theme' => 'default-theme',

    // Meta
    'meta' => [
        'keywords' => '',
        'description' => ''
    ],

    // Social Share
    'social_share' => [
        'article_share'    => env('ARTICLE_SHARE') ?: false,
        'discussion_share' => env('DISCUSSION_SHARE') ?: false,
        'sites'            => env('SOCIAL_SHARE_SITES') ?: 'google,twitter,weibo',
        'mobile_sites'     => env('SOCIAL_SHARE_MOBILE_SITES') ?: 'google,twitter,weibo,qq,wechat',
    ],

    // Google Analytics
    'google' => [
        'id'   => env('GOOGLE_ANALYTICS_ID', 'Google-Analytics-ID'),
        'open' => env('GOOGLE_OPEN') ?: false
    ],

    // Article Page
    'article' => [
        'title'       => '简单不先于复杂，而是在复杂之后',
        'description' => 'https://www.gegaofeng.com',
        'number'      => 10,
        'sort'        => 'desc',
        'sortColumn'  => 'published_at',
    ],
    //Article List
    'article_list'=>[
        'most_visit'=>5
    ],

    // Discussion Page
    'discussion' => [
        'number' => 20,
        'sort'   => 'desc',
        'sortColumn' => 'created_at',
    ],

    // Footer
    'footer' => [
        'github' => [
            'open' => false,
            'url'  => 'https://github.com/gegaofeng',
        ],
        'twitter' => [
            'open' => false,
            'url'  => 'https://twitter.com/'
        ],
        'meta' => '© Xiaocainiao 2018.Powered By gegaofeng.com',
    ],

    'license' => 'Powered By gegaofeng.com.<br/>This article is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/">Creative Commons Attribution-NonCommercial 4.0 International License</a>.',
    //注册功能开放
    'user_register' => env('USER_REGISTER') ? : false,
];
