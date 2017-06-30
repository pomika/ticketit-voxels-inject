## Voxels Inyector

ServiceProvider + Middleware to inject custom voxels css/js into laravel

## Install

  * Add repository to your composer.json
  * Add post-autoload-dump script exeution

```
"post-autoload-dump": [
    "php -f $(pwd)/vendor/pomika/ticketit-voxels-inject/src/script.php"
]
```
