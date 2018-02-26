## Directives

Register service provider

```php
Ksoft\Klaravel\DirectivesProvider::class,
```

There are not many directives right now, if you have suggestions ill be pleased to incorporate.

### Auth

```php
/*
 * Usage: @admin @else @endif
 */
Blade::if('admin', function () {
    return auth()->check() && auth()->user()->isAdmin();
});
```

### Maths

```php
/*
 * Usage: @number($value)
 * Usage: @decimals($value)
 */
Blade::directive('number', function ($expression) {
    return "<?php echo number_format(floatval($expression), 0); ?>";
});
Blade::directive('decimals', function ($expression) {
    return "<?php echo number_format(floatval($expression), 2); ?>";
});
```

### Dates

```php
/*
 * Usage: @datetime(Carbon $date)
 */
Blade::directive('datetime', function ($expression) {
    return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
});
```

### Debug

```php
/*
 * Usage: @json($object)
 * Usage: @log($value)
 */
Blade::directive('json', function ($expression) {
    return "<?php echo json_encode(with{$expression}); ?>";
});

Blade::directive('log', function ($expression) {
    return "<?php logi(with{$expression}); ?>";
});
```

### Others

```php
/*
 * @explode($delimiter, $string)
 * @implode($delimiter, $array)
 */
Blade::directive('explode', function ($argumentString) {
    list($delimiter, $string) = $this->getArguments($argumentString);
    return "<?php echo explode({$delimiter}, {$string}); ?>";
});

Blade::directive('implode', function ($argumentString) {
    list($delimiter, $array) = $this->getArguments($argumentString);
    return "<?php echo implode({$delimiter}, {$array}); ?>";
});
```
