# Tags

Install

`composer require spatie/eloquent-tags`

Migrations

`php artisan vendor:publish --provider="Spatie\Tags\TagsServiceProvider" --tag="migrations"`

`php artisan migrate`

Configuration (optional)

`php artisan vendor:publish --provider="Spatie\Tags\TagsServiceProvider" --tag="config"`

```
// config
return [
    /*
     * The given function generates a URL friendly "slug" from the tag name property before saving it.
     */
    'slugger' => 'str_slug',
];
```

[https://docs.spatie.be/laravel-tags/](https://docs.spatie.be/laravel-tags/)

#### On the Model

```php
use Spatie\Tags\HasTags;

class YourModel extends Model
{
    use HasTags;

    public $tagTypes = ['dishMenu', 'dishCategory', 'dishAllergens']; // custom.

    ...
}
```

#### What you can do...

```
$yourModel->attachTag('tag 1');
$yourModel->attachTags(['tag 2', 'tag 3']);
$yourModel->attach(\Spatie\Tags\Tag::findOrCreate('tag4'));

$yourModel->detachTag('tag 1');
$yourModel->detachTags(['tag 2', 'tag 3']);
$yourModel->detach(\Spatie\Tags\Tag::Find('tag4'));

$yourModel->syncTags(['tag 2', 'tag 3']);

//create a tag
$tag = Tag::create(['name' => 'my tag']);

//update a tag
$tag->name = 'another tag';
$tag->save();

//use "findFromString" instead of "find" to retrieve a certain tag
$tag = Tag::findFromString('another tag')

//create a tag if it doesn't exist yet
$tag = Tag::findOrCreateFromString('yet another tag');

//delete a tag
$tag->delete();

//returns models that have one or more of the given tags
YourModel::withAnyTags(['tag 1', 'tag 2'])->get();

//returns models that have one or more of the given tags that are typed `myType`
YourModel::withAnyTags(['tag 1', 'tag 2'], 'myType')->get();

//returns models that have all given tags
YourModel::withAllTags(['tag 1', 'tag 2'])->get();

//returns models that have all given tags that are typed `myType`
YourModel::withAllTags(['tag 1', 'tag 2'], 'myType')->get();
```

#### Translations

```
$tag = Tag::findOrCreate('my tag'); //store in the current locale of your app

//let's add some translation for other languages
$tag->setTranslation('name', 'fr', 'mon tag');
$tag->setTranslation('name', 'nl', 'mijn tag');

//don't forget to save the model
$tag->save();

$tag->getTranslation('name', 'fr'); // returns 'mon tag'

$tag->name // returns the name of the tag in current locale of your app.

\Spatie\Tags\Tag
   ->where('name->fr', 'mon tag')
   ->first();
```

#### Types

```
//creating a tag with a certain type
$tagWithType = Tag::findOrCreate('headline', 'newsTag');

$newsItem->attachTag($tagWithType);
$newsItem->detachTag($tagWithType);

$newsItem->syncTagsWithType(['tagA', 'tagB'], 'firstType');
$newsItem->syncTagsWithType(['tagC', 'tagD'], 'secondType');

$tag = Tag::create('gossip', 'newsTag');
$tag2 = Tag::create('headline', 'newsTag');

NewsItem::withAnyTags([$tag, $tag2])->get();

$tagA = Tag::findOrCreate('tagA', 'firstType');
$tagB = Tag::findOrCreate('tagB', 'firstType');
$tagC = Tag::findOrCreate('tagC', 'secondType');
$tagD = Tag::findOrCreate('tagD', 'secondType');

Tag::getWithType('firstType'); // returns a collection with $tagA and $tagB

//there's also a scoped version
Tag::withType('firstType')->get(); // returns the same result

$newsItem->tagsWithType('firstType'); // returns a collection
```

#### Sort

```
//get all tags sorted on `order_column`
$orderedTags = Tags::ordered()->get();

//set a new order entirely
Tags::setNewOrder($arrayWithTagIds);

$myModel->moveOrderUp();
$myModel->moveOrderDown();

//let's grab a Tag instance
$tag = $orderedTags->first();

//move the tag to the first or last position
$tag->moveToStart();
$tag->moveToEnd();

$tag->swapOrder($anotherTag);
```

More here [https://docs.spatie.be/laravel-tags/](https://docs.spatie.be/laravel-tags/)
