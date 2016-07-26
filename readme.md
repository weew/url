# URL wrapper

[![Build Status](https://img.shields.io/travis/weew/url.svg)](https://travis-ci.org/weew/url)
[![Code Quality](https://img.shields.io/scrutinizer/g/weew/url.svg)](https://scrutinizer-ci.com/g/weew/url)
[![Test Coverage](https://img.shields.io/coveralls/weew/url.svg)](https://coveralls.io/github/weew/url)
[![Dependencies](https://img.shields.io/versioneye/d/php/weew:url.svg)](https://versioneye.com/php/weew:url)
[![Version](https://img.shields.io/packagist/v/weew/url.svg)](https://packagist.org/packages/weew/url)
[![Licence](https://img.shields.io/packagist/l/weew/url.svg)](https://packagist.org/packages/weew/url)

## Table of contents

- [Installation](#installation)
- [Overview](#overview)
- [Instantiation](#instantiation)
- [Parsing](#parsing)
- [Building](#building)
- [Matching](#matching)
- [Parsing](#parsing)
- [Replacing](#building)

## Installation

`composer require weew/url`

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

## Matching

You can match url path against a pattern.

```php
$url = new Url('users/1');
// true
$url->match('users/{id}');

$url = new Url('users');
// false
$url->match('users/{id}');
```

Placeholders can be optional by adding the `?` sign at the end.

```php
$url = new Url('users/1');
// true
$url->match('users/{id?}');

$url = new Url('users');
// true
$url->match('users/{id?}');
```

Placeholders can have custom patterns.

```php
$url = new Url('users/1');
// true
$url->match('users/{id}', [
    'id' => '[0-9]+',
]);

$url = new Url('users/abc');
// false
$url->match('users/{id}', [
    'id' => '[0-9]+',
]);
```

For further documentation check out the [weew/url-matcher](https://github.com/weew/url-matcher) package;

## Parsing

Retrieving placeholder values is very trivial.

```php
$url = new Url('users/1');
$dictionary = $url->parse('users/{id}');
// 1
$dictionary->get('id');
```

For further documentation check out the [weew/url-matcher](https://github.com/weew/url-matcher) package;

## Replacing

You can replace placeholders inside your path with values.

```php
$url = new Url('{subdomain}.service.com/users/{id}/profile');
$url->replace('subdomain', 'api');
$url->replace('id', 1);

// or 
$url->replaceAll(['subdomain' => 'api', 'id' => 1]);

// api.service.com/users/1/profile
$url->toString();
```
