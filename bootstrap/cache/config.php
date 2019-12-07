<?php return array (
  'app' => 
  array (
    'name' => 'UKP Fakultas Psikologi UGM',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://127.0.0.1:8000',
    'timezone' => 'Asia/Jakarta',
    'locale' => 'id',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:/VCXkICe20B0JxLtzGNgRBck/PSUqlfg2g2h+DiejsI=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Intervention\\Image\\ImageServiceProvider',
      23 => 'Collective\\Html\\HtmlServiceProvider',
      24 => 'Barryvdh\\DomPDF\\ServiceProvider',
      25 => 'App\\Providers\\AppServiceProvider',
      26 => 'App\\Providers\\AuthServiceProvider',
      27 => 'App\\Providers\\EventServiceProvider',
      28 => 'App\\Providers\\RouteServiceProvider',
      29 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
      30 => 'RealRashid\\SweetAlert\\SweetAlertServiceProvider',
      31 => 'LaravelFCM\\FCMServiceProvider',
      32 => 'Way\\Generators\\GeneratorsServiceProvider',
      33 => 'Xethron\\MigrationsGenerator\\MigrationsGeneratorServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
      'Alert' => 'RealRashid\\SweetAlert\\Facades\\Alert',
      'FCM' => 'LaravelFCM\\Facades\\FCM',
      'FCMGroup' => 'LaravelFCM\\Facades\\FCMGroup',
      'Input' => 'Illuminate\\Support\\Facades\\Input',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'passport',
        'provider' => 'users',
      ),
      'admin' => 
      array (
        'driver' => 'passport',
        'provider' => 'admins',
      ),
      'psikolog-session' => 
      array (
        'driver' => 'session',
        'provider' => 'psikologs',
      ),
      'psikolog' => 
      array (
        'driver' => 'passport',
        'provider' => 'psikologs',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
      'admins' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Admin',
      ),
      'psikologs' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Psikolog',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
      'admins' => 
      array (
        'provider' => 'admins',
        'table' => 'password_resets',
        'expire' => 15,
      ),
      'psikologs' => 
      array (
        'provider' => 'psikologs',
        'table' => 'password_resets',
        'expire' => 15,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'D:\\PSIKOLOGI\\psikologi\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
    ),
    'prefix' => 'ukp_fakultas_psikologi_ugm_cache',
  ),
  'charts' => 
  array (
    'default_library' => 'Chartjs',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'db_psikologi',
        'prefix' => '',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'db_psikologi',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'db_psikologi',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'db_psikologi',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => 'D:\\PSIKOLOGI\\psikologi\\storage\\fonts/',
      'font_cache' => 'D:\\PSIKOLOGI\\psikologi\\storage\\fonts/',
      'temp_dir' => 'C:\\Users\\ASUS\\AppData\\Local\\Temp',
      'chroot' => 'D:\\PSIKOLOGI\\psikologi',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'temp_path' => 'C:\\Users\\ASUS\\AppData\\Local\\Temp',
      'pre_calculate_formulas' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => 'C:\\Users\\ASUS\\AppData\\Local\\Temp',
      'remote_disk' => NULL,
    ),
  ),
  'fcm' => 
  array (
    'driver' => 'http',
    'log_enabled' => false,
    'http' => 
    array (
      'server_key' => 'AAAAnR-EfyY:APA91bEYeo6QIwa9zzgsjJjzDsdEeR5E1EHCVEpqQnzmEafSXCw71uhQHAbmxLHb0fsY8Ga5AkNxYbXP9CvLD9odLeVqY4xGE-ziOYG4EjeRintLeDp99qexoxBy-Iq6BeurON3VEw78',
      'sender_id' => '674838642470',
      'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
      'server_group_url' => 'https://android.googleapis.com/gcm/notification',
      'timeout' => 30.0,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\PSIKOLOGI\\psikologi\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\PSIKOLOGI\\psikologi\\storage\\app/public',
        'url' => 'http://127.0.0.1:8000/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
    ),
  ),
  'frontend' => 
  array (
    'url' => 'http://localhost:8080',
    'email_verify_url' => '/verify-email?queryURL=',
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'highchart' => 
  array (
    'highchart_js' => true,
    'series_label_js' => true,
    'exporting_js' => true,
    'export_data_js' => true,
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'D:\\PSIKOLOGI\\psikologi\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'D:\\PSIKOLOGI\\psikologi\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.googlemail.com',
    'port' => '465',
    'from' => 
    array (
      'address' => 'meet.psy.ukp.ugm@gmail.com',
      'name' => 'UKP UGM',
    ),
    'encryption' => 'ssl',
    'username' => 'meet.psy.ukp.ugm@gmail.com',
    'password' => 'ukpugm123',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'D:\\PSIKOLOGI\\psikologi\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'pushnotification' => 
  array (
    'gcm' => 
    array (
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => 'My_ApiKey',
    ),
    'fcm' => 
    array (
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => 'AIzaSyBvmOlAcs_VN1ZbbLCQo5jAFWo5VNkKRok',
    ),
    'apn' => 
    array (
      'certificate' => 'D:\\PSIKOLOGI\\psikologi\\config/iosCertificates/apns-dev-cert.pem',
      'passPhrase' => '1234',
      'passFile' => 'D:\\PSIKOLOGI\\psikologi\\config/iosCertificates/yourKey.pem',
      'dry_run' => true,
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
      'webhook' => 
      array (
        'secret' => NULL,
        'tolerance' => 300,
      ),
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'D:\\PSIKOLOGI\\psikologi\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'ukp_fakultas_psikologi_ugm_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'sweet-alert' => 
  array (
    'autoclose' => 1800,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'D:\\PSIKOLOGI\\psikologi\\resources\\views',
    ),
    'compiled' => 'D:\\PSIKOLOGI\\psikologi\\storage\\framework\\views',
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'passport' => 
  array (
    'private_key' => NULL,
    'public_key' => NULL,
  ),
  'iseed::config' => 
  array (
    'path' => '/database/seeds',
    'chunk_size' => 500,
  ),
  'generators' => 
  array (
    'config' => 
    array (
      'model_template_path' => 'D:\\PSIKOLOGI\\psikologi\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/model.txt',
      'scaffold_model_template_path' => 'D:\\PSIKOLOGI\\psikologi\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/scaffolding/model.txt',
      'controller_template_path' => 'D:\\PSIKOLOGI\\psikologi\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/controller.txt',
      'scaffold_controller_template_path' => 'D:\\PSIKOLOGI\\psikologi\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/scaffolding/controller.txt',
      'migration_template_path' => 'D:\\PSIKOLOGI\\psikologi\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/migration.txt',
      'seed_template_path' => 'D:\\PSIKOLOGI\\psikologi\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/seed.txt',
      'view_template_path' => 'D:\\PSIKOLOGI\\psikologi\\vendor/xethron/laravel-4-generators/src/Way/Generators/templates/view.txt',
      'model_target_path' => 'D:\\PSIKOLOGI\\psikologi\\app',
      'controller_target_path' => 'D:\\PSIKOLOGI\\psikologi\\app\\Http/Controllers',
      'migration_target_path' => 'D:\\PSIKOLOGI\\psikologi\\database/migrations',
      'seed_target_path' => 'D:\\PSIKOLOGI\\psikologi\\database/seeds',
      'view_target_path' => 'D:\\PSIKOLOGI\\psikologi\\resources/views',
    ),
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
