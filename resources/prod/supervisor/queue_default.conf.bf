[program:queue_default_worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/lara191010/artisan queue:work --sleep=3 --tries=3 --daemon
autostart=true
autorestart=true
numprocs=8
user=root
redirect_stderr=true
