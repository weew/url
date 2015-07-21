<?php

namespace Tests\Weew\Url;

use PHPUnit_Framework_TestCase;
use Weew\Url\IUrlSegments;
use Weew\Url\UrlParser;

class UrlParserTest extends PHPUnit_Framework_TestCase {
    private $url = 'http://name:pass@example.com:80/products?sku=1234#price';

    public function test_parse_url() {
        $parser = new UrlParser();
        $segments = $parser->parse($this->url);
        $this->assertTrue($segments instanceof IUrlSegments);

        $this->assertEquals('http', $segments->getScheme());
        $this->assertEquals('name', $segments->getUser());
        $this->assertEquals('pass', $segments->getPassword());
        $this->assertEquals('example.com', $segments->getHost());
        $this->assertEquals('80', $segments->getPort());
        $this->assertEquals('/products', $segments->getPath());
        $this->assertEquals('sku=1234', $segments->getQuery()->toString());
        $this->assertEquals('price', $segments->getFragment());
    }
}
