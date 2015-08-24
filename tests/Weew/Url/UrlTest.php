<?php

namespace Tests\Weew\Url;

use PHPUnit_Framework_TestCase;
use Weew\Url\IUrl;
use Weew\Url\Url;
use Weew\Url\UrlQuery;

class UrlTest extends PHPUnit_Framework_TestCase {
    private $url = 'http://name:pass@just.an.example.com:80/products?sku=1234#price';

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

        $url->setProtocol(7);
        $this->assertEquals(7, $url->getProtocol());

        $url->setUsername(8);
        $this->assertEquals(8, $url->getUsername());
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

        $url = new Url('foo', 'bar', 'baz', 'yolo');
        $this->assertEquals(
            '/foo/bar/baz/yolo', $url->toString()
        );

        $url = new Url('https://foo.com', 'bar', 'baz', 'yolo');
        $this->assertEquals(
            'https://foo.com/bar/baz/yolo', $url->toString()
        );
    }

    public function test_work_with_host() {
        $url = new Url($this->url);

        $this->assertEquals(
            'just.an.example.com', $url->getHost()
        );

        $this->assertEquals('com', $url->getTLD());
        $url->setTLD('net');
        $this->assertEquals('net', $url->getTLD());

        $this->assertEquals('example', $url->getDomain());
        $url->setDomain('foo');
        $this->assertEquals('foo', $url->getDomain());

        $this->assertEquals('just.an', $url->getSubdomain());
        $url->setSubdomain('bar.baz');
        $this->assertEquals('bar.baz', $url->getSubdomain());

        $this->assertEquals('bar.baz.foo.net', $url->getHost());
    }

    public function test_work_with_host_incomplete() {
        $url = new Url('http://foo.bar');
        $this->assertEquals('foo.bar', $url->getHost());
        $this->assertEquals('bar', $url->getTLD());
        $this->assertEquals('foo', $url->getDomain());
        $this->assertNull($url->getSubdomain());
        $url->setHost('localhost');
        $this->assertEquals('localhost', $url->getHost());
        $this->assertEquals('localhost', $url->getDomain());
        $this->assertNull($url->getTLD());
        $this->assertNull($url->getSubdomain());
        $url->setSubdomain('foo');
        $this->assertEquals('foo', $url->getSubdomain());
        $this->assertEquals('foo.localhost', $url->getHost());
        $url->setTLD('com');
        $this->assertEquals('com', $url->getTLD());
        $this->assertEquals('foo.localhost.com', $url->getHost());

        $url = new Url('http://localhost/foo/bar');
        $this->assertEquals('localhost', $url->getHost());
        $this->assertEquals('localhost', $url->getDomain());
        $this->assertNull($url->getTLD());
        $this->assertNull($url->getSubdomain());
        $url->setSubdomain('foo');
        $this->assertEquals('foo', $url->getSubdomain());
        $this->assertNull($url->getTLD());
        $this->assertEquals('foo.localhost', $url->getHost());
        $url->setTLD('com');
        $this->assertEquals('com', $url->getTLD());
        $this->assertEquals('foo', $url->getSubdomain());
        $this->assertEquals('foo.localhost.com', $url->getHost());
        $url->setHost('foo.bar.baz.yolo');
        $this->assertEquals('foo.bar.baz.yolo', $url->getHost());
        $this->assertEquals('yolo', $url->getTLD());
        $this->assertEquals('baz', $url->getDomain());
        $this->assertEquals('foo.bar', $url->getSubdomain());
    }

    private function check_url(IUrl $url) {
        $this->assertEquals('http', $url->getProtocol());
        $this->assertEquals('name', $url->getUsername());
        $this->assertEquals('pass', $url->getPassword());
        $this->assertEquals('just.an.example.com', $url->getHost());
        $this->assertEquals('example', $url->getDomain());
        $this->assertEquals('com', $url->getTLD());
        $this->assertEquals('just.an', $url->getSubdomain());
        $this->assertEquals('80', $url->getPort());
        $this->assertEquals('/products', $url->getPath());
        $this->assertEquals('sku=1234', $url->getQuery()->toString());
        $this->assertEquals('price', $url->getFragment());
    }

    public function test_to_array() {
        $url = new Url($this->url);
        $this->assertEquals(
            [
                'protocol' => $url->getProtocol(),
                'tld' => $url->getTLD(),
                'domain' => $url->getDomain(),
                'subdomain' => $url->getSubdomain(),
                'host' => $url->getHost(),
                'port' => $url->getPort(),
                'path' => $url->getPath(),
                'query' => $url->getQuery()->toArray(),
                'username' => $url->getUsername(),
                'password' => $url->getPassword(),
                'fragment' => $url->getFragment(),
            ],
            $url->toArray()
        );
    }
}
