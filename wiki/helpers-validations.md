# Laravel validations

Some mostly used rules at a handy place.

```php
public function validator($id, array $data)
    {
        return Validator::make($data, [
            'text.en' => 'required|string',
            'group' => 'required|string|max:255',
            // Unique when updating.
            'key' => 'required|string|unique:fragments,key,'.$id,
        ]);
    }
```
