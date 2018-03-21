# Laravel passport

#### Install

```
php artisan migrate
php artisan migrate
```

Full Passport features installation method.

```
php artisan passport:install
```

Simple token client installation method use `--password` option
for the Password Grant Client-

```
php artisan passport:keys // Necessary on first deploy to server
// one of the 2 options.
php artisan passport:client
php artisan passport:client --password
```

#### Configuration

On user model add the HasApiTokens trait.

```php
use Laravel\Passport\HasApiTokens;
```

On service provider **boot method**

```
Passport::routes();
// Passport::tokensExpireIn(now()->addDays(15));
// Passport::refreshTokensExpireIn(now()->addDays(30));
```

on `config/auth.php` api driver to passport

```
'api' => [
  'driver' => 'passport',
  'provider' => 'users',
],
```

Publish the Passport Vue components

```
php artisan vendor:publish --tag=passport-components
```

#### Graphql login example

Token grant example for graphql resolver function.

```php
use Illuminate\Auth\Access\AuthorizationException;
...
public function resolve($root, $args, $context, ResolveInfo $info)
{
  $user = User::where('email', $args['email'])->first();

  if ($user && app('hash')->check($args['password'], $user->password)) {
    $this->deleteExpiredTokens($user);
    $user['token'] = $user->createToken('LRHP')->accessToken;
    return $user;
  }
  throw new AuthorizationException('Invalid credentials!');
  return null;
}

protected function deleteExpiredTokens($user)
{
  $user->tokens()->where('expires_at', '<=', Carbon::now())->delete();
}
```

#### UnauthorizedHttpException

```php
namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class InvalidCredentialsException extends UnauthorizedHttpException
{
    public function __construct($message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct('', $message, $previous, $code);
    }
}
```

#### Login Mutation for React-relay

```js
// @flow
import { commitMutation, graphql } from 'react-relay';
import RelayEnv from './../../../graphql/AuthEnviroment';

const environment = RelayEnv.environment;

const mutation = graphql`
  mutation LoginMutation($email: String!, $password: String!) {
    login(email: $email, password: $password) {
      token
      user {
        id
      }
    }
  }
`;

export default (
  email: string,
  password: string,
  callback: Function,
  onError: Function
) => {
  const variables = {
    email,
    password
  };

  commitMutation(environment, {
    mutation,
    variables,
    onCompleted: (response, error) => {
      if (response.login && response.login.token) {
        const token = response.login.token;
        callback(null, token);
      } else {
        onError(error);
      }
    },
    onError
  });
};
```
