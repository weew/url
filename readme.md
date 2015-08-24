# URL wrapper

[![Build Status](https://travis-ci.org/weew/php-url.svg?branch=master)](https://travis-ci.org/weew/php-url)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/weew/php-url/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/weew/php-url/?branch=master)
[![Coverage Status](https://coveralls.io/repos/weew/php-url/badge.svg?branch=master&service=github)](https://coveralls.io/github/weew/php-url?branch=master)
[![License](https://poser.pugx.org/weew/php-url/license)](https://packagist.org/packages/weew/php-url)

#### Installation

`composer require weew/php-url`

#### Working with URL segments

Let's work with this particular URL:

```php
$url = new Url('http://username:password@subdomain.domain.com:80/some/path?query=value#fragment');
```

It is very easy to access isolated parts of an URL.

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

echo $url->getQuery()->toString();
// query=value

echo $url->getFragment();
// fragment

echo $url->getUsername();
// username

echo $url->getPassword();
// password
```

The same works in the other direction too.

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
