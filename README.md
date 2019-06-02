# sawan-core
1- run  "composer required sawan-core"

2- add Sawan\Core\SawanCoreServiceProvider::class to providers array in config\app.php like this

        'providers' => [
        .
        .
        .
        Sawan\Core\SawanCoreServiceProvider::class,
        .
        ],
    
3- run "php artisan vendor:publish --provider="Sawan\Core\SawanCoreServiceProvider" to include admin panel
