# Translatable

Full repo + documentation: [https://github.com/spatie/laravel-translatable](https://github.com/spatie/laravel-translatable)

**Big thanks** to **[Spatie](https://spatie.be/en/opensource) team**,

#### Installation

```bash
composer require spatie/laravel-translatable
php artisan vendor:publish --provider="Spatie\Translatable\TranslatableServiceProvider"
```

#### Model

```php
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class NewsItem extends Model
{
    use HasTranslations;

    public $translatable = ['name'];
}
```

#### Helpers

```php
// GET
public function getTranslation(string $attributeName, string $locale) : string
$newsItem->getTranslation('title','es');
public function getTranslations(string $attributeName): array
$newsItem->getTranslations();

// SET
public function setTranslation(string $attributeName, string $locale, string $value)
$newsItem->setTranslation('name', 'en', 'Updated name in English');
public function setTranslations(string $attributeName, array $translations);

// REMOVE
public function forgetTranslation(string $attributeName, string $locale);
public function forgetAllTranslations(string $locale);

// SEARCH
NewsItem::where('name->en', 'Name in English')->get();

foreach ($this->getTranslatableAttributes() as $name) {
  $attributes[$name] = $this->getTranslation($name, app()->getLocale());
}
```
