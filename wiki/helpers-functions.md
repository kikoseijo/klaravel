# Helper functions

All helper functions are declared with a `function_exists` conditional.

```php
// Lowercases the string.
function normalizeString($text, $limit): string {}

// Mardown converter
function do_markdown($markdown): string {}

// Model name to title_case replacing '_' with spaces
function model_title($modelName): string {}

// Pretty print arrays
function pretty_print_array(array $array_data): string {}

// Human readable using JenssDate (Not installed)
function diff_date_for_humans(Carbon $date): string {}
// $item->created_at->diffForHumans() // using Carbon instead of JenssDate

// Resource route for Lumen
function resource($path, $controller, $name, $exclude = []) {}

// Human readable size
function humanReadableSize($bites): string {}

// Carbon date from timestamp
function createFromTimestamp($timestamp): string {}

// Dump database queries
function dbDump($simple = true): string {}

// Lumen path helpers
function config_path($path = ''): string {}
function app_path($path = ''): string {}
function public_path($path = ''): string {}

// Debug, simple shortcodes
function logi($data): void {} // info
function loge($data): void {} // error
function logc($data): void {} // critical
```
