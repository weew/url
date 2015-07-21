<?php

namespace Tests\Weew\Url;

use PHPUnit_Framework_TestCase;
use Weew\Url\IUrlSegments;
use Weew\Url\Url;

class UrlTest extends PHPUnit_Framework_TestCase {
    public function test_create_an_empty_url() {
        $url = new Url();
        $this->assertTrue($url->getSegments() instanceof IUrlSegments);
    }

    public function test_cast_to_string() {
        $url = new Url('foo/bar/baz');
        $this->assertEquals($url->toString(), (string) $url);
    }
}
