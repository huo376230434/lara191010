<?php
/**
 * Created by IntelliJ IDEA.
 * User: huo
 * Date: 2019-11-04
 * Time: 20:40
 */
$path = __DIR__."/../";

var_dump($path);
$handler = opendir($path);
$arr = [];
$crontab_path = "/etc/crontabs/root";
while( ($filename = readdir($handler)) !== false ) {
    if($filename != "." && $filename != ".." && is_dir($path . "/" . $filename) && file_exists($path . "/" . $filename."/artisan")){
        $command_str = "* * * * * laradock /usr/bin/php /var/www/$filename/artisan schedule:run >> /dev/null 2>&1".PHP_EOL;
        if (!strstr(file_get_contents($crontab_path), $command_str)) file_put_contents($crontab_path, $command_str, FILE_APPEND);
    }
}
closedir($handler);


