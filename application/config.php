<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 应用调试模式
    'app_debug'              => true,
    // 应用Trace
    'app_trace'              => true,
    // 应用模式状态
    'app_status'             => '',
    // 是否支持多模块
    'app_multi_module'       => true,
    // 入口自动绑定模块
    'auto_bind_module'       => false,
    // 注册的根命名空间
    'root_namespace'         => [],
    // 扩展函数文件
    'extra_file_list'        => [THINK_PATH . 'helper' . EXT],
    // 默认输出类型
    'default_return_type'    => 'html',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    // 默认JSONP格式返回的处理方法
    'default_jsonp_handler'  => 'jsonpReturn',
    // 默认JSONP处理方法
    'var_jsonp_handler'      => 'callback',
    // 默认时区
    'default_timezone'       => 'PRC',
    // 是否开启多语言
    'lang_switch_on'         => false,
    // 默认全局过滤方法 用逗号分隔多个
    'default_filter'         => '',
    // 默认语言
    'default_lang'           => 'zh-cn',
    // 应用类库后缀
    'class_suffix'           => false,
    // 控制器类后缀
    'controller_suffix'      => false,

    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

    // 默认模块名
    'default_module'         => 'index',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 操作方法后缀
    'action_suffix'          => '',
    // 自动搜索控制器
    'controller_auto_search' => false,

    // +----------------------------------------------------------------------
    // | URL设置
    // +----------------------------------------------------------------------

    // PATHINFO变量名 用于兼容模式
    'var_pathinfo'           => 's',
    // 兼容PATH_INFO获取
    'pathinfo_fetch'         => ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
    // pathinfo分隔符
    'pathinfo_depr'          => '/',
    // URL伪静态后缀
    'url_html_suffix'        => 'html',
    // URL普通方式参数 用于自动生成
    'url_common_param'       => false,
    // URL参数方式 0 按名称成对解析 1 按顺序解析
    'url_param_type'         => 0,
    // 是否开启路由
    'url_route_on'           => true,
    // 路由使用完整匹配
    'route_complete_match'   => false,
    // 路由配置文件（支持配置多个）
    'route_config_file'      => ['route'],
    // 是否强制使用路由
    'url_route_must'         => false,
    // 域名部署
    'url_domain_deploy'      => false,
    // 域名根，如thinkphp.cn
    'url_domain_root'        => '',
    // 是否自动转换URL中的控制器和操作名
    'url_convert'            => true,
    // 默认的访问控制器层
    'url_controller_layer'   => 'controller',
    // 表单请求类型伪装变量
    'var_method'             => '_method',
    // 表单ajax伪装变量
    'var_ajax'               => '_ajax',
    // 表单pjax伪装变量
    'var_pjax'               => '_pjax',
    // 是否开启请求缓存 true自动缓存 支持设置请求缓存规则
    'request_cache'          => false,
    // 请求缓存有效期
    'request_cache_expire'   => null,
    // 全局请求缓存排除规则
    'request_cache_except'   => [],

    // +----------------------------------------------------------------------
    // | 模板设置
    // +----------------------------------------------------------------------

    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
    ],

    // 视图输出字符串内容替换
    'view_replace_str'       => [],
    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl'  => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',

    // +----------------------------------------------------------------------
    // | 异常及错误设置
    // +----------------------------------------------------------------------

    // 异常页面的模板文件
    'exception_tmpl'         => THINK_PATH . 'tpl' . DS . 'think_exception.tpl',

    // 错误显示信息,非调试模式有效
    'error_message'          => '页面错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'         => false,
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => 'app\common\server\HttpServer',

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------

    'log'                    => [
        // 日志记录方式，内置 file socket 支持扩展
        'type'  => 'File',
        // 日志保存目录
        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => ["error"],
    ],

    // +----------------------------------------------------------------------
    // | Trace设置 开启 app_trace 后 有效
    // +----------------------------------------------------------------------
    'trace'                  => [
        // 内置Html Console 支持扩展
        'type' => 'Html',
    ],

    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------

    'cache'                  => [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => CACHE_PATH,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'                 => [
        // cookie 名称前缀
        'prefix'    => '',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],

    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],

    //安全
    'mclogin' => [
        'public_key' => '-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAlRm8lWcyVUHfztVVXPAm
BdFT7D2iYvnMgxwKxOQ5ELM5rsKSFBzAt/vmvkYluHY/tdsWnI7gtow/UIFrdkZU
GKJBucB/wbEX7U2QbbvaMxkGwIhqxRyHqYZEgVM9TIJRZGh3GcN/xdXCppGS/RFM
u+pp2pAwP51+oBQmyJt60sW7fZBLwF8m/Fc4Yv7H2/NLLSVtDG8s9j2a0I9A+1X2
vP9R3eIqYSZpsOV7jEGN+Ai2eL5G3tFPnN+Mdtci5rGObsZJU72Mo5crjPQ/VTF1
R+R5iQMVDC2Oy9/U883D9MT59Oeur70VT+GKrzCSv2grb4Xdd1ZIMTASPZaBd0RP
iDno7Hfnc8alB7H62XYd1EvvYhRJzAXAeodh9ktDrXa2fcv9Uint7nMb+ucPwn/u
32i6DTADut8d88GasSzFVuVDvNIVrOfW/UD/vVwthLfgauO8uZKnt1+o42WLwGY5
wnMtbUgZUd3eq2UZ1vZxNpXcXfQ71N1qzRihQdWKs69J+eFRdRnsRmOVqxJtlj+Z
rky03Kl/xHwtUUQ++wPBvNFDEcB7Ke5itrh8Y3h5c//ocBoGjYPmZ56GKhqmHtVb
A3iOECumEQpgTraJdreiic47VDp0Gim725hlHd7AJBBexyMTxGjNd2dpfgNTyC/x
4/rXbsGQyucd0UustXFcMX8CAwEAAQ==
-----END PUBLIC KEY-----',
        'private_key' => '-----BEGIN RSA PRIVATE KEY-----
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
-----END RSA PRIVATE KEY-----'
    ]
];
