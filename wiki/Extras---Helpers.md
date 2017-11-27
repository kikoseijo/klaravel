## Debugging

```php
// does a va_dump from \DB::listen
dbDump($simple = true);
logi(string|array); // \Log::info
loge(string|array); // \Log::error
logc(string|array); // \Log::critical
```

## Routing

```
/**
 * Create an API rest resource route => [index, show, store, update, destroy]
 *
 * @param $path
 * @param $controller
 * @param $name
 * @param array $exclude
 */
resource($path, $controller, $name, $exclude = []);

``
