## Startup with envoy

Starting points, on local and remote auto-config.

#### Installing on remote

`envoy run ssh`

`envoy run alias`

`envoy run setup`

`envoy run publish`

#### Deploy (not recommended for production)

`envoy run deploy`

`envoy run fm`

#### configuring initial project

`envoy run setupKlaravel`

### Envoy.blade.php

create this file on the root directory to be able to run the commands, you need envoy installed on machine.

```php
@servers(['remote' => 'xxx.xxxx.com', 'local' => '127.0.0.1'])

@include('vendor/autoload.php')

@setup

    (new Dotenv\Dotenv(__DIR__, '.env'))->load();

    $now = date('Ymd-His');
    $branch = "origin/master";
    $username = "hotel";
    $key_email = "no-reply@sunnyface.com";
    $repo_domain = "git.xxxxx.com";
    $repo_group = "repogroupd";
    $repo_name = "laravel-app";
    $project_root = "/home/$username/$repo_name";
    $domain = $username.'.sunnyface.com';
    $slack = env('SLACK_ENDPOINT');
    $crons = [
        'Laravel Schedule' => [
            '* * * * *',
            "/usr/bin/php71 $project_root/artisan schedule:run >> /dev/null 2>&1"
        ]
    ];
    $alias = [
        'alias php="/usr/bin/php71"',
        'alias composer="php /bin/composer"',
        'alias ka="php artisan"',
        'alias kdump="composer dump autoload"',
    ];
    $envs = [
        'SLACK_ENDPOINT="https://hooks.slack.com/services/xxxxx/xxxxxx/xxxxxxxx"',
    ];
@endsetup


@task('php', ['on' => 'remote'])
    su -l  {{ $username }}
    php -v
@endtask

@task('deploy', ['on' => 'remote'])
    su -l  {{ $username }}
    cd ~/{{ $repo_name }}
    php artisan down --message="Upgrading system.." --retry=60
    git fetch --all
    git reset --hard {{ $branch }}
    git pull origin master
    composer update --no-dev --prefer-dist
    php artisan up
@endtask

@task('setupKlaravel')
    valet link {{ $username }}
    composer install
    cp .env.example .env
    atom .env
    ka k:g
    ka make:auth
    ka session:table
    ka cache:table
    npm i
    npm i element-ui moment toastr vue-carousel smoothscroll-for-websites
    npm run build
    echo "Assets done ✔︎"
    composer require laravelcollective/html
    composer require kalnoy/nestedset
    composer require maatwebsite/excel
    composer require spatie/laravel-translatable
    php artisan vendor:publish --provider="Spatie\Translatable\TranslatableServiceProvider"
    {{-- composer require jenssegers/date --}}
    composer require ksoft/klaravel
    php artisan vendor:publish --provider="Former\FormerServiceProvider"
    php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
    echo "Remove name from config.backup.backup.name"
    php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider"
    ka ksoft:publish 0
    echo "backend layout:"
    echo "#extends('klaravel::layouts.crud')"
    echo "config/former.php"
    echo "Ksoft\Klaravel\Utils\FormerBootstrap4"
    echo "config/app.php"
    echo "Ksoft\Klaravel\DirectivesProvider::class,"
@endtask

@task('composer', ['on' => 'remote'])
    su -l  {{ $username }}
    cd ~/{{ $repo_name }}
    php artisan down --message="Upgrading system.." --retry=60
    composer install --no-dev --prefer-dist
    php artisan up
@endtask

@task('ssh', ['on' => 'remote', 'confirm' => true])
    su -l {{ $username }}
    [ -d ~/.ssh ] || echo "~/.ssh directory does not exist, lets create"
    [ -d ~/.ssh ] || mkdir ~/.ssh
    echo "Adding {{ $repo_domain }} domain to known_hosts"
    ssh-keyscan {{ $repo_domain }} >> ~/.ssh/known_hosts
    cd ~/.ssh
    echo "Deleting ssh keys..."
    rm -rf id_rsa id_rsa.pub
    ssh-keygen -t rsa -C "{{ $repo_domain }}" -b 4096  -N "" -f id_rsa
    cat  ~/.ssh/id_rsa.pub
@endtask

@story('setup')
    download
    install
@endstory

@task('download', ['on' => ['remote']])
    su -l {{ $username }}
    cd ~
    echo "Cloning {{ "git@" . $repo_domain .":". $repo_group ."/" . $repo_name . ".git" }}"
    git clone {{ "git@" . $repo_domain .":". $repo_group ."/" . $repo_name . ".git" }}
    cd ~/{{ $repo_name }}
    echo "Done download"
@endtask

@task('install', ['on' => ['remote']])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    composer install --no-dev
    [ -e .env ] || echo ".env does not exist, using default .env.example"
    [ -e .env ] || cp .env.example .env && php artisan key:generate
    echo "Linking storage folder"
    php artisan storage:link
@endtask

@task('alias', ['on' => ['remote']])
    su -l {{ $username }}
    cd ~
    @foreach ($alias as $alia)
        LINE='{{$alia}}'
        FILE=.profile
        grep -qF "$LINE" "$FILE" || echo "$LINE" >> "$FILE"
    @endforeach
    alias
    echo "Done."
@endtask

@task('add_env', ['on' => ['remote']])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    @foreach ($envs as $env)
        LINE='{{$env}}'
        FILE=.env
        grep -qF "$LINE" "$FILE" || echo "$LINE" >> "$FILE"
    @endforeach
    cat .env
    echo "Done."
@endtask

@task('publish', ['on' => ['remote']])
    su -l {{ $username }}
    cd ~
    rm -rf public_html
    ln -s ~/{{ $repo_name }}/public ~/public_html
    echo "App should be now live."
@endtask

@task('cron_add', ['on' => 'remote'])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    echo "# write out current crontab"
    @foreach ($crons as $cron_name => $cron_job)
        echo "{{$cron_job[1]}}"
        croncmd="{{$cron_job[1]}}"
        cronjob="{{$cron_job[0]}} $croncmd"
        ( crontab -l | grep -v -F "$croncmd" ; echo "$cronjob" ) | crontab -
    @endforeach
    echo "# Done addCrons"
@endtask

@task('cron_remove', ['on' => 'remote'])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    echo "# remove crontabs"
    @foreach ($crons as $cron_name => $cron_job)
        croncmd="{{$cron_job[1]}}"
        ( crontab -l | grep -v -F "$cron_name" ) | crontab -
        ( crontab -l | grep -v -F "$croncmd" ) | crontab -
    @endforeach
    echo "# Done rmCrons"
@endtask

@task('apachelogswatch', ['on' => 'remote'])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    tail -f /var/log/virtualmin/{{$domain}}_error_log
@endtask

@task('laralogswatch', ['on' => 'remote'])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    tail -f storage/logs/laravel.log
@endtask

@task('catenv', ['on' => 'local'])
    cat .env
@endtask

@task('klean', ['on' => 'local'])
    php artisan clear-compiled
    php artisan migrate:refresh
    php artisan db:seed
@endtask

@task('dump', ['on' => 'local'])
    composer dump-autoload
    php artisan config:clear
    php artisan view:clear
    php artisan cache:clear
    php artisan clear-compiled
@endtask

@task('up', ['on' => ['remote']])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    php artisan up
@endtask

@task('down', ['on' => ['remote']])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    php artisan down
@endtask

@story('fm', ['on' => ['remote']])

    migrate_fresh
    migrate_seed
    passport
@endstory
@task('migrate_fresh', ['on' => 'remote'])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    php artisan migrate:refresh --force
@endtask
@task('migrate_seed', ['on' => 'remote'])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    composer update
    php artisan db:seed --force
@endtask
@task('passport', ['on' => 'remote'])
    su -l  {{ $username }}
    cd ~/{{ $repo_name }}
    php artisan passport:keys --force
    php artisan passport:install
    # php artisan vendor:publish --tag=passport-components
@endtask

@story('migrate')
    warning
    run_migration_seed
@endstory

@task('warning', ['on' => ['local']])
    echo "---------------------------------------------"
    echo "---------------------------------------------"
    echo "--------------- "ATTENTION" -----------------"
    echo "---------------------------------------------"
    echo "---------------------------------------------"
    echo "-------------  Are you sure?  ---------------"
    echo "---------------------------------------------"
    echo "---------------------------------------------"
@endtask

@task('run_migration_seed', ['on' => 'remote', 'confirm' => true])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    php artisan migrate --force
    @if ($seed)
        php artisan db:seed --force
    @endif
@endtask

@task('m:r', ['on' => 'remote'])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    php artisan migrate:rollback --force
@endtask

@task('rights', ['on' => 'remote', 'confirm' => true])
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    chmod -R 0777 public/upload app/storage
    find . -type d -exec chmod 775 {} \;
    find . -type f -exec chmod 664 {} \;
@endtask

@task('reload_php_server', ['on' => 'remote'])
    /etc/rc.d/init.d/php-fcgi-{{str_replace('.', '-', $domain)}} restart
@endtask

@task('reload_nginx', ['on' => 'remote'])
    systemctl restart nginx
@endtask

@task('optimizeInstallation', ['on' => 'remote'])
    echo 'start optimizeInstallation'
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    php artisan clear-compiled
    php artisan optimize
@endtask

@task('backupDatabase', ['on' => 'remote'])
    echo 'start backupDatabase'
    su -l {{ $username }}
    cd ~/{{ $repo_name }}
    php artisan backup:run
@endtask
```
