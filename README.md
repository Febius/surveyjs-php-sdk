[![Build Status](https://travis-ci.org/febius/surveyjs-php-sdk.svg?branch=master)](https://travis-ci.org/febius/surveyjs-php-sdk)
[![Latest Stable Version](https://poser.pugx.org/febius/surveyjs-php-sdk/v/stable)](https://packagist.org/packages/febius/surveyjs-php-sdk)
[![License](https://poser.pugx.org/febius/surveyjs-php-sdk/license)](https://packagist.org/packages/febius/surveyjs-php-sdk)

# SurveyJS PHP SDK
Provides a way to model through PHP the JSON created by SurveyJS.

## Installation
You can install the library and its dependencies using `composer` running:
```sh
$ composer require febius/surveyjs-php-sdk
```

### Usage
The library allows to return a model per each Survey element (comment, checkbox, etc...).

#### Example
The following snippet is extracted from the
[example/sample.php](https://github.com/febius/surveyjs-php-sdk/blob/master/example/sample.php)
file and shows how parsing a JSON

```php
// [Add comment]
[Add Code]
```

#### Survey Element(s)
A [RatingElement](https://github.com/febius/surveyjs-php-sdk/blob/master/src/Model/Element/RatingElement.php)
instance allows to map a single Rating element and to return information as follows:

```php
[Add snippet] TDB
```

## Development
The environment requires [phpunit](https://phpunit.de/), that has been already included in the `dev-dependencies` of the
`composer.json`.

### Dependencies
To install all modules you just need to run following command:

```sh
$ composer install
```

### Testing
Tests files are created in dedicates folders that replicate the
[src](https://github.com/febius/surveyjs-php-sdk/tree/master/src) structure as follows:
```
.
+-- src
|   +-- [folder-name]
|   |   +-- [file-name].php
|   ...
+-- tests
|   +-- [folder-name]
|   |   +-- [file-name]Test.php
```

Execute following command to run the tests suite:
```sh
$ composer test
```

Run what follows to see the code coverage:
```sh
$ composer coverage
```

## License
This package is released under the [MIT license](LICENSE.md).
