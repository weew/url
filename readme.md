# URL wrapper

[![Build Status](https://img.shields.io/travis/weew/php-url.svg)](https://travis-ci.org/weew/php-url)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/php-url.svg)](https://scrutinizer-ci.com/g/weew/php-url)
[![Test Coverage](https://img.shields.io/coveralls/weew/php-url.svg)](https://coveralls.io/github/weew/php-url)
[![Dependencies](https://img.shields.io/versioneye/d/php/weew:php-url.svg)](https://versioneye.com/php/weew:php-url)
[![Version](https://img.shields.io/packagist/v/weew/php-url.svg)](https://packagist.org/packages/weew/php-url)
[![Licence](https://img.shields.io/packagist/l/weew/php-url.svg)](https://packagist.org/packages/weew/php-url)

## Table of contents

- [Installation](#installation)
- [Overview](#overview)
- [Instantiation](#instantiation)
- [Parsing](#parsing)
- [Building](#building)
- [Additional methods](#additional-methods)

## Installation

`composer require weew/php-url`

## Overview

Currently this library is able to parse and build urls of such format and complexity:

```php
// protocol://username:password@subdomain.domain.tld:port/path?key=value#fragment
```

For example:

```php
// https://john:doe@another.domain.net:8080/my/path?query=value&some=value#hashtag
```

## Instantiation

Creating a new url is very easy:

```php
$url = new Url('http://username:password@subdomain.domain.com:80/some/path?query=value#fragment');
```

## Parsing

Url containts manny segments which can be accessed trough convenient methods:

```php
echo $url->getProtocol();
// http

echo $url->getHost();
// subdomain.domain.com

echo $url->getDomain();
// domain

echo $url->getSubdomain();
// subdomain

echo $url->getTLD();
// com

echo $url->getPort();
// 80

echo $url->getPath();
// /some/path

echo $url->getQuery();
// query=value

echo $url->getFragment();
// fragment

echo $url->getUsername();
// username

echo $url->getPassword();
// password
```

## Building

You can modify url segments in the same manner.

```php
$url->setProtocol('https');

$url->setHost('another.domain.net');
// or
$url->setDomain('domain');
$url->setSubdomain('another');
$url->setTLD('net');

$url->setPort(8080);
$url->setPath('my/path');
$url->addPath('here');
$url->getQuery()->set('some', 'value');
$url->setFragment('hashtag');
$url->setUsername('john');
$url->setPassword('doe');

echo $url;
// https://john:doe@another.domain.net:8080/my/path/here?query=value&some=value#hashtag
```

## Path matching

You can match url path against a pattern.

```php
$url = new Url('users/1');
// true
$url->matchPath('users/{id}');

$url = new Url('users');
// false
$url->matchPath('users/{id}');
```

Placeholders can be optional by adding the `?` sign at the end.

```php
$url = new Url('users/1');
// true
$url->matchPath('users/{id?}');

$url = new Url('users');
// true
$url->matchPath('users/{id?}');
```

Placeholders can have custom patterns.

```php
$url = new Url('users/1');
// true
$url->matchPath('users/{id}', [
    'id' => '[0-9]+',
]);

$url = new Url('users/abc');
// false
$url->matchPath('users/{id}', [
    'id' => '[0-9]+',
]);
```

For further documentation check out the [weew/php-url-matcher](https://github.com/weew/php-url-matcher) package;

## Path parsing

Retrieving placeholder values is very trivial.

```php
$url = new Url('users/1');
$dictionary = $url->parsePath('users/{id}');
// 1
$dictionary->get('id');
```

For further documentation check out the [weew/php-url-matcher](https://github.com/weew/php-url-matcher) package;
