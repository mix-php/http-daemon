<?php

namespace Mix\Http\Daemon\Commands\Service;

use Mix\Helper\ProcessHelper;

/**
 * Class ReloadCommand
 * @package Mix\Http\Daemon\Commands\Service
 * @author LIUJIAN <coder.keda@gmail.com>
 */
class ReloadCommand extends BaseCommand
{

    /**
     * 主函数
     */
    public function main()
    {
        // 获取服务状态
        $pid = $this->getServicePid();
        if (!$pid) {
            println(self::NOT_RUNNING);
            return;
        }
        // 重启子进程
        ProcessHelper::kill($pid, SIGUSR1);
        println(self::EXEC_SUCCESS);
    }

}
