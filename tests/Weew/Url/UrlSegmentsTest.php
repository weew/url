<?php

namespace Tests\Weew\Url;

use PHPUnit_Framework_TestCase;
use Weew\Url\UrlQuery;
use Weew\Url\UrlSegments;

class UrlSegmentsTest extends PHPUnit_Framework_TestCase {
    public function test_get_and_set_segments() {
        $segments = new UrlSegments();
        $segments->setFragment(1);
        $this->assertEquals(1, $segments->getFragment());

        $segments->setHost(2);
        $this->assertEquals(2, $segments->getHost());

        $segments->setPassword(3);
        $this->assertEquals(3, $segments->getPassword());

        $segments->setPath(4);
        $this->assertEquals('/4', $segments->getPath());

        $segments->setPort(5);
        $this->assertEquals(5, $segments->getPort());

        $segments->setQuery(new UrlQuery(['foo' => 'bar']));
        $this->assertEquals('bar', $segments->getQuery()->get('foo'));

        $segments->setScheme(7);
        $this->assertEquals(7, $segments->getScheme());

        $segments->setUser(8);
        $this->assertEquals(8, $segments->getUser());
    }

    public function test_path_always_starts_with_slash() {
        $segments = new UrlSegments();

        $segments->setPath('foo');
        $this->assertEquals('/foo', $segments->getPath());

        $segments->setPath('/bar');
        $this->assertEquals('/bar', $segments->getPath());
    }

    public function test_add_path() {
        $segments = new UrlSegments();

        $segments->setPath('foo');
        $segments->addPath('bar');
        $this->assertEquals('/foo/bar', $segments->getPath());

        $segments->addPath('/baz');
        $this->assertEquals('/foo/bar/baz', $segments->getPath());
    }
}
