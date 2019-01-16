## Mix HTTPD

`mix-http` 是一个 WEB 容器，负责执行 Mix 的 HTTP 应用 (类似 `PHP-FPM`)，由于基于 Swoole 的特性，所以具有常驻内存、异步IO的特点，性能非常强悍。

## 环境要求

* PHP >= 7.0
* Swoole >= 1.9.5

## 安装

直接下载最新的 mix-httpd.zip 文件，解压到 `/usr/local/mix-httpd` 目录，软链接到 `/usr/local/bin` 目录即可。

```shell
wget https://github.com/mix-php/mix-httpd/releases/download/v1.0.0/mix-httpd-1.0.0.zip
unzip mix-httpd-1.0.0.zip -d /usr/local/mix-httpd
cd /usr/local/mix-httpd
chmod 755 mix-httpd.phar
ln -s -f /usr/local/mix-httpd/mix-httpd.phar /usr/local/bin/mix-httpd
```

编辑配置文件：

```shell

```

启动服务：

```shell
[root@localhost data]# mix-httpd service start -c /usr/local/mix-httpd/app.ini
```

查看帮助：

```shell
[root@localhost data]# mix-httpd -h
Usage: mix-httpd.phar [OPTIONS] COMMAND [SUBCOMMAND] [arg...]

Options:
  -h/--help	Print usage.
  -v/--version	Print version information.

Commands:
  service
    service start	Start the mix-httpd service.
    service stop	Stop the mix-httpd service.
    service restart	Restart the mix-httpd service.
    service reload	Reload the worker process of the mix-httpd service.
    service status	Check the status of the mix-httpd service.

Run 'mix-httpd.phar COMMAND [SUBCOMMAND] --help' for more information on a command.

Developed with Mix PHP framework. (mixphp.cn)
```

## License

Apache License Version 2.0, http://www.apache.org/licenses/
