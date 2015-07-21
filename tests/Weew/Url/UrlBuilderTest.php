<?php

namespace Tests\Weew\Url;

use Weew\Url\UrlBuilder;
use Weew\Url\UrlParser;
use PHPUnit_Framework_TestCase;

class UrlBuilderTest extends PHPUnit_Framework_TestCase {
    private $url = 'http://name:pass@example.com:80/products?sku=1234#price';

    public function test_build_url() {
        $builder = new UrlBuilder();
        $parser = new UrlParser();
        $url = $builder->build($parser->parse($this->url));

        $this->assertEquals($this->url, $url);
    }
}
