ƒ# Potato-ORM

[![Build Status](https://travis-ci.org/andela-iadeniyi/Potato-ORM.svg)](https://travis-ci.org/andela-iadeniyi/Potato-ORM)
[![License](http://img.shields.io/:license-mit-blue.svg)](https://github.com/andela-iadeniyi/Potato-ORM/blob/master/LICENCE)
[![Quality Score](https://img.shields.io/scrutinizer/g/andela-iadeniyi/Potato-ORM.svg?style=flat-square)](https://scrutinizer-ci.com/g/andela-iadeniyi/Potato-ORM)
[![Scruitinizer Code](https://scrutinizer-ci.com/g/andela-iadeniyi/Potato-ORM/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/andela-iadeniyi/Potato-ORM)
[![Code Climate](https://codeclimate.com/github/andela-iadeniyi/Potato-ORM/badges/gpa.svg)](https://codeclimate.com/github/andela-iadeniyi/Potato-ORM)
[![Test Coverage](https://codeclimate.com/github/andela-iadeniyi/Potato-ORM/badges/coverage.svg)](https://codeclimate.com/github/andela-iadeniyi/Potato-ORM/coverage)

Potato-ORM is a package that manages the CRUD operation of database. Potato-ORM currently supports `MYSQL`, `POSTGRES` and `SQLITE` Database.[Potato-ORM](http://andela-iadeniyi.github.io/Potato-ORM)

## Installation

[PHP](https://php.net) 5.5+ and [Composer](https://getcomposer.org) are required.

Via Composer

```
$ composer require ibonly/potato-orm
```

```
$ composer install
```

## Usage

### App Namespace

```
    namespace Ibonly\PotatoORM
```

Create a `Class` that correspond to the singular form of the table name in the database. i.e.

```php
    namespace Ibonly\PotatoORM;

    class User extends Model
    {
        protected $table = 'tableName';

        protected fillables = ['name', 'email'];
    }
```
The table name can also be defined in the model if the user wants it to be specified.

The fields that is to be output can also be specified as `protected $fillables = []`. 

The `Model` class contains `getAll()`, `where([$field => $value])`, `find($value)`, `save()`, update() and `detroy($id)` methods.

### getAll()

```php
    use Ibonly\PotatoORM\User;

    $sugar = new User();

    return $sugar->getAll()->all();
```

    Return type = JSON

### where($field, $value)

```php
    use Ibonly\PotatoORM\User;

    $sugar = new User();

    return $sugar->where([$field => $value])->first()->username;
```
Passing conditions to where

```php

    return $sugar->where([$field => $value, $field2 => $value2], 'AND')->first()->username;
```

    Return type = String


### Update($value): 

```php
    use Ibonly\PotatoORM\User;
    $update = new User();

    $update->password = "password";
    echo $insert->update(1)

```

    To return custom message, wrap the `save()` method in an `if statement`

    Return type = Boolean

### save()

```php
    use Ibonly\PotatoORM\User;

    $insert = new User();
    $insert->id = NULL;
    $insert->username = "username";
    $insert->email = "example@example.com";
    $insert->password = "password";
    echo $insert->save();
```

    To return custom message, wrap the `save()` method in an `if statement`

    Return type = Boolean

### file($fileName)->uploadFile()

This method is used to upload file, it can only be used along side `save()` and `update($id)`

```php
    use Ibonly\PotatoORM\User;

    $insert = new User();
    $insert->id = NULL;
    $insert->username = "username";
    $insert->email = "example@example.com";
    $insert->avatar = $this->content->file($_FILES['image'])->uploadFile($uploadDirectory);
    $insert->password = "password";
    echo $insert->save();

```

### detroy($value)

```php
    use Ibonly\PotatoORM\User;

    $insert = User::destroy(2);
    die($insert);
```

    Return type = Boolean

## Create Database Table

Its is also possible to create Database Table with the `Schema` class. The table name will be specified in the
`createTable($name)` method.

```php
    use Ibonly\PotatoORM\Schema;

    $user = new Schema;
    $user->field('increments', 'id');
    $user->field('strings', 'username');
    $user->field('strings', 'name', 50);
    $user->field('integer', 'age');
    $user->field('primaryKey', 'id');

    echo $table->createTable('players');
```
    Return type = Boolean

#### Database Constraint


Foreign Key

```php
    $user->field('foreignKey', 'id', 'users-id');
```

The reference table `(users)` and field `(id)` will be written as `(users-id)`


Unique Key

```php
    $user->field('unique', 'email')
```


## Testing

```
$ vendor/bin/phpunit test
```

## Contributing

To contribute and extend the scope of this package,
Please check out [CONTRIBUTING](CONTRIBUTING.md) file for detailed contribution guidelines.

## Credits

Potato-ORM is created and maintained by `Ibraheem ADENIYI`.
