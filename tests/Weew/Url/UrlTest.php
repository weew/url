<?php

namespace Tests\Weew\Url;

use PHPUnit_Framework_TestCase;
use Weew\Url\IUrl;
use Weew\Url\Url;
use Weew\Url\UrlQuery;

class UrlTest extends PHPUnit_Framework_TestCase {
    private $url = 'http://name:pass@example.com:80/products?sku=1234#price';

    public function test_get_and_set_segments() {
        $url = new Url();
        $url->setFragment(1);
        $this->assertEquals(1, $url->getFragment());

        $url->setHost(2);
        $this->assertEquals(2, $url->getHost());

        $url->setPassword(3);
        $this->assertEquals(3, $url->getPassword());

        $url->setPath(4);
        $this->assertEquals('/4', $url->getPath());

        $url->setPort(5);
        $this->assertEquals(5, $url->getPort());

        $url->setQuery(new UrlQuery(['foo' => 'bar']));
        $this->assertEquals('bar', $url->getQuery()->get('foo'));

        $url->setScheme(7);
        $this->assertEquals(7, $url->getScheme());

        $url->setUser(8);
        $this->assertEquals(8, $url->getUser());
    }

    public function test_path_always_starts_with_slash() {
        $url = new Url();

        $url->setPath('foo');
        $this->assertEquals('/foo', $url->getPath());

        $url->setPath('/bar');
        $this->assertEquals('/bar', $url->getPath());
    }

    public function test_add_path() {
        $url = new Url();

        $url->setPath('foo');
        $url->addPath('bar');
        $this->assertEquals('/foo/bar', $url->getPath());

        $url->addPath('/baz');
        $this->assertEquals('/foo/bar/baz', $url->getPath());
    }

    public function test_to_string() {
        $url = new Url($this->url);
        $this->assertEquals($url, $url->toString());
        $this->assertEquals($url, (string) $url);
    }

    public function test_create_url() {
        $url = new Url($this->url);
        $this->check_url($url);
        $url->parse($this->url);
        $this->check_url($url);

        $url = new Url('foo', 'bar', 'baz', 'yolo');
        $this->assertEquals(
            '/foo/bar/baz/yolo', $url->toString()
        );
    }

    private function check_url(IUrl $url) {
        $this->assertEquals('http', $url->getScheme());
        $this->assertEquals('name', $url->getUser());
        $this->assertEquals('pass', $url->getPassword());
        $this->assertEquals('example.com', $url->getHost());
        $this->assertEquals('80', $url->getPort());
        $this->assertEquals('/products', $url->getPath());
        $this->assertEquals('sku=1234', $url->getQuery()->toString());
        $this->assertEquals('price', $url->getFragment());
    }
}
