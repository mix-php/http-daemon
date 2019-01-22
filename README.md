## Mix HTTPD

一个 HTTP 服务容器，负责执行 Mix 的 HTTP 应用 (类似 `PHP-FPM`)，由于基于 Swoole\Http\Server 开发，所以具有常驻内存、异步IO等特点，性能非常强悍。

## 环境要求

* PHP >= 7.0
* Swoole >= 1.9.5

## 安装

直接下载最新的 mix-httpd.zip 文件，解压到 `/usr/local/mix-httpd` 目录，软链接到 `/usr/local/bin` 目录即可。

```
$> wget https://github.com/mix-php/mix-httpd/releases/download/v2.0.1-RC2/mix-httpd-2.0.1-rc2.zip
$> unzip mix-httpd-2.0.1-rc2.zip -d /usr/local/mix-httpd
$> cd /usr/local/mix-httpd
$> chmod 755 mix-httpd.phar
$> ln -s -f /usr/local/mix-httpd/mix-httpd.phar /usr/local/bin/mix-httpd
```

编辑配置文件：

```
$> vim app.ini
;主机
host = 127.0.0.1
;端口
port = 9501
;自动加载
autoload_file = /data/mix/vendor/autoload.php
;环境文件
environment_file = /data/mix/.env
;配置文件
configuration_file = /data/mix/applications/httpd/config/http_permanent.php
;运行参数：https://wiki.swoole.com/wiki/page/274.html
[settings]
;开启协程
enable_coroutine = 0
;主进程事件处理线程数
reactor_num = 8
;工作进程数
worker_num = 8
;进程的最大任务数
max_request = 10000
;PID 文件
pid_file = /var/run/mix-httpd.pid
;日志文件路径
log_file = /tmp/mix-httpd.log
;子进程运行用户
user = www
```

修改以下配置：

- `autoload_file` composer 自动加载文件路径。
- `environment_file` 环境配置文件路径。
- `configuration_file` 应用配置文件路径。

## 启动

查看帮助：

```
$> mix-httpd -h
Usage: /usr/local/bin/mix-httpd [OPTIONS] COMMAND [SUBCOMMAND] [arg...]

Options:
  -h/--help	Print usage.
  -v/--version	Print version information.

Commands:
    service start	Start the mix-httpd service.
    service stop	Stop the mix-httpd service.
    service restart	Restart the mix-httpd service.
    service reload	Reload the worker process of the mix-httpd service.
    service status	Check the status of the mix-httpd service.

Run '/usr/local/bin/mix-httpd COMMAND [SUBCOMMAND] --help' for more information on a command.

Developed with Mix PHP framework. (mixphp.cn)
```

查看启动服务命令帮助：

```
$> mix-httpd service start -h
Usage: /usr/local/bin/mix-httpd service start [arg...]

Options:
  -c/--configuration    FILENAME -- configuration file path
  -d/--daemon           Run in the background
  -u/--update           Enable code hot update

Developed with Mix PHP framework. (mixphp.cn)
```

启动服务：

```
$> mix-httpd service start -c /usr/local/mix-httpd/app.ini
                             _____
_______ ___ _____ ___   _____  / /_  ____
__/ __ `__ \/ /\ \/ /__ / __ \/ __ \/ __ \
_/ / / / / / / /\ \/ _ / /_/ / / / / /_/ /
/_/ /_/ /_/_/ /_/\_\  / .___/_/ /_/ .___/
                     /_/         /_/

Server         Name:      mix-httpd
System         Name:      linux
PHP            Version:   7.2.9
Swoole         Version:   4.2.9
Framework      Version:   2.0.1-RC
Hot            Update:    disabled
Coroutine      Mode:      disabled
Listen         Addr:      127.0.0.1
Listen         Port:      9501
Reactor        Num:       8
Worker         Num:       8
Configuration  File:      /data/applications/httpd/config/http_permanent.php
```

## License

Apache License Version 2.0, http://www.apache.org/licenses/
