<?php

namespace Mix\Http\Daemon\Commands;

use Mix\Console\CommandLine\Flag;
use Mix\Console\PidFileHandler;
use Mix\Helper\FileSystemHelper;
use Mix\Core\Bean\AbstractObject;
use Mix\Log\MultiHandler;

/**
 * Class BaseCommand
 * @package Mix\Http\Daemon\Commands\Service
 * @author liu,jian <coder.keda@gmail.com>
 */
class BaseCommand extends AbstractObject
{

    /**
     * 运行中提示
     */
    const IS_RUNNING = 'Service is running, PID : %d';

    /**
     * 未运行提示
     */
    const NOT_RUNNING = 'Service is not running.';

    /**
     * 执行成功提示
     */
    const EXEC_SUCCESS = 'Command executed successfully.';

    /**
     * 配置信息
     * @var array
     */
    public $config;

    /**
     * 初始化事件
     */
    public function onInitialize()
    {
        parent::onInitialize(); // TODO: Change the autogenerated stub
        // 服务器配置处理
        $file = Flag::string(['c', 'configuration'], '');
        if ($file == '') {
            println("Option '-c/--configuration' required.");
            exit;
        }
        if (!FileSystemHelper::isAbsolute($file)) {
            $file = getcwd() . DIRECTORY_SEPARATOR . $file;
        }
        if (!is_file($file)) {
            println("Configuration file not found: {$file}");
            exit;
        }
        $config = require $file;
        // 应用配置处理
        if (isset($config['application']['config_file']) && !is_file($config['application']['config_file'])) {
            $filename = \Mix\Helper\FileSystemHelper::basename($file);
            println("{$filename}: 'application.config_file' file not found: {$config['application']['config_file']}");
            exit;
        }
        // 构造配置信息
        $this->config = [
            'name'       => app()->appName,
            'version'    => app()->appVersion,
            'host'       => $config['server']['host'],
            'port'       => $config['server']['port'],
            'configFile' => $config['application']['config_file'] ?? '',
            'config'     => $config['application']['config'] ?? [],
            'setting'    => $config['setting'],
        ];
        // 配置日志组件
        /** @var \Mix\Log\MultiHandler $multiHandler */
        $multiHandler = app()->log->handler;
        foreach ($multiHandler->handlers as $handler) {
            if ($handler instanceof \Mix\Log\FileHandler) {
                $handler->single = $this->config['setting']['log_file'] ?? '';
                break;
            }
        }
        // Swoole 判断
        if (!extension_loaded('swoole')) {
            println('Need swoole extension to run, install: https://www.swoole.com/');
            exit;
        }
    }

    /**
     * 获取pid
     * @return bool|string
     */
    public function getServicePid()
    {
        $handler = new PidFileHandler(['pidFile' => $this->config['setting']['pid_file'] ?? '']);
        return $handler->read();
    }

}
