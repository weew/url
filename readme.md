# URL wrapper

[![Build Status](https://travis-ci.org/weew/php-url.svg?branch=master)](https://travis-ci.org/weew/php-url)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/weew/php-url/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/weew/php-url/?branch=master)
[![Coverage Status](https://coveralls.io/repos/weew/php-url/badge.svg?branch=master&service=github)](https://coveralls.io/github/weew/php-url?branch=master)
[![License](https://poser.pugx.org/weew/php-url/license)](https://packagist.org/packages/weew/php-url)

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
// protocol://username:password@subdomain.domain.tld:port/path?key=value
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
$url->getQuery()->set('some', 'value');
$url->setFragment('hashtag');
$url->setUsername('john');
$url->setPassword('doe');

echo $url;
// https://john:doe@another.domain.net:8080/my/path?query=value&some=value#hashtag
```

## Additional methods

Converting url to an array:

```php
$url->toArray();

```
