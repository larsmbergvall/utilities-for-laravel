# Utilities for Laravel

This is a collection of some utilities that I personally use when developing Laravel applications. Feel free to use them
in your own projects!

# Usage

You can publish the action stub with:
```shell
php artisan vendor:publish --tag=utilities-for-laravel-stubs
```

You can publish the config with:
```shell
php artisan vendor:publish --tag=utilities-for-laravel-config
```

# What is included?

## Make:action command
`php artisan make:action CreatePost` command that creates an action class
    * This would create a `CreatePostAction.cs` - if you don't want the suffix you can disable it in the config file (or
      change the suffix to something else)

## Result class
A Result class inspired by Rusts Result type

```php
        /** @var Result<array, string> $result */
//        $result = Result::ok(['value' => 'foo']);
        $result = Result::err('something went wrong');

        $result->match(
            ok: fn(array $data) => dd($data),
            err: fn(string $error) => dd($error)
        );

//        $data = $result->getValue();
        $error = $result->getErr();
```