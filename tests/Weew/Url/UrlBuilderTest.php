<?php

namespace Tests\Weew\Url;

use Weew\Url\Url;
use Weew\Url\UrlBuilder;
use PHPUnit_Framework_TestCase;

class UrlBuilderTest extends PHPUnit_Framework_TestCase {
    private $url = 'http://name:pass@example.com:80/products?sku=1234#price';

    public function test_build_url() {
        $builder = new UrlBuilder();
        $url = $builder->build(new Url($this->url));

        $this->assertEquals($this->url, $url);
    }
}
