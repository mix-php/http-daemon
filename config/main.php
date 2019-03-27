<?php

// Console应用配置
return [

    // 应用名称
    'appName'          => 'mix-httpd',

    // 应用版本
    'appVersion'       => '2.0.1',

    // 应用调试
    'appDebug'         => env('APP_DEBUG'),

    // 基础路径
    'basePath'         => dirname(__DIR__),

    // 运行目录路径
    'runtimePath'      => '',

    // 命令命名空间
    'commandNamespace' => 'Mix\Http\Daemon\Commands',

    // 命令
    'commands'         => [

        'service start' => [
            'Service\Start',
            'description' => 'Start the mix-httpd service.',
            'options'     => [
                '-c/--configuration' => 'FILENAME -- configuration file path',
                '-d/--daemon'        => "\t" . 'Run in the background',
                '-u/--update'        => "\t" . 'Enable code hot update (only sync available)',
            ],
        ],

        'service stop' => [
            'Service\Stop',
            'description' => 'Stop the mix-httpd service.',
            'options'     => [
                '-c/--configuration' => 'FILENAME -- configuration file path',
            ],
        ],

        'service restart' => [
            'Service\Restart',
            'description' => 'Restart the mix-httpd service.',
            'options'     => [
                '-c/--configuration' => 'FILENAME -- configuration file path',
                '-d/--daemon'        => "\t" . 'Run in the background',
                '-u/--update'        => "\t" . 'Enable code hot update (only sync available)',
            ],
        ],

        'service reload' => [
            'Service\Reload',
            'description' => 'Reload the worker process of the mix-httpd service.',
            'options'     => [
                '-c/--configuration' => 'FILENAME -- configuration file path',
            ],
        ],

        'service status' => [
            'Service\Status',
            'description' => 'Check the status of the mix-httpd service.',
            'options'     => [
                '-c/--configuration' => 'FILENAME -- configuration file path',
            ],
        ],

    ],

    // 组件配置
    'components'       => [

        // 错误
        'error' => [
            // 依赖引用
            'ref' => beanname(Mix\Console\Error::class),
        ],

        // 日志
        'log'   => [
            // 依赖引用
            'ref' => beanname(Mix\Log\Logger::class),
        ],

    ],

    // 依赖配置
    'beans'            => [

        // 错误
        [
            // 类路径
            'class'      => Mix\Console\Error::class,
            // 属性
            'properties' => [
                // 错误级别
                'level' => E_ALL,
            ],
        ],

        // 日志
        [
            // 类路径
            'class'      => Mix\Log\Logger::class,
            // 属性
            'properties' => [
                // 日志记录级别
                'levels'  => ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'],
                // 处理者
                'handler' => [
                    // 依赖引用
                    'ref' => beanname(Mix\Log\FileHandler::class),
                ],
            ],
        ],

        // 处理者
        [
            // 类路径
            'class' => Mix\Log\FileHandler::class,
        ],

    ],

];
