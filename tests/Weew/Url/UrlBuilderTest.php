<?php

namespace Tests\Weew\Url;

use Weew\Url\Url;
use Weew\Url\UrlBuilder;
use PHPUnit_Framework_TestCase;

class UrlBuilderTest extends PHPUnit_Framework_TestCase {
    private $url = 'http://name:pass@just.an.example.com:80/products?sku=1234#price';

    public function test_build_host() {
        $builder = new UrlBuilder();

        $this->assertEquals(
            'localhost', $builder->buildHost(null, 'localhost', null)
        );
        $this->assertEquals(
            'localhost.com', $builder->buildHost('com', 'localhost', null)
        );
        $this->assertEquals(
            'this.is.localhost.com', $builder->buildHost('com', 'localhost', 'this.is')
        );
    }

    public function test_build() {
        $builder = new UrlBuilder();
        $url = $builder->build(new Url($this->url));

        $this->assertEquals($this->url, $url);
    }
}
