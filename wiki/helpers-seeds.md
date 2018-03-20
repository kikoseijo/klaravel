# Seeds reference

#### User seeder

```
php artisan make:seeder UsersTableSeeder
```


```
if (! DB::table('users')->where('email', 'user@example.com')->first()) {
  DB::table('users')->insert([
    'name'     => 'Kiko Seijo',
    'email'    => 'user@example.com',
    'password' => app('hash')->make('secret'),
    // 'admin' => 1,
  ]);
}
```

#### Faker

```
use Faker\Factory;
use Faker\Generator as Faker;
use Faker\Provider\es_ES\Payment;


$faker = Factory::create('es_ES');
```


#### Faker most used

```
'number_plate'  => $faker->numerify('XA-####-NP'),
'reference'     => $faker->word,
'chofer'        => $faker->randomElement([NULL, $faker->word]),
'is_active'     => $faker->boolean(),
'notes'         => $faker->paragraph,
'created_at'    => Carbon::now()->addMinutes(-rand(0, 60 * 24 * 7 * 4)),
'arrive_time'   => $faker->time,

// company
'name'          => $faker->company,
'cif'           => $faker->vat, // use Faker\Provider\es_ES\Payment;
'address'       => $faker->address,
'phone'         => $faker->phoneNumber,
'email'         => $faker->safeEmail,
'calidad_name'  => $faker->name,
'calidad_email' => $faker->safeEmail,
'notes'         => $faker->paragraph,

// not sure if this is faker or spatie seeder.-
'estado_id' => $faker->numberBetween(0,4),
'delivery_at' => $faker->dateTimeBetween('-30 days', '-2 days'),

```
