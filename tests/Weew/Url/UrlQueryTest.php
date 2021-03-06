<?php

namespace Tests\Weew\Url;

use PHPUnit_Framework_TestCase;
use Weew\Url\UrlQuery;

class UrlQueryTest extends PHPUnit_Framework_TestCase {
    public function test_create_query() {
        $query = new UrlQuery();
        $this->assertEquals([], $query->toArray());
        $this->assertEquals('', $query->toString());

        $query = new UrlQuery(['foo' => 'bar']);
        $this->assertEquals(['foo' => 'bar'], $query->toArray());
        $this->assertEquals('foo=bar', $query->toString());

        $query = new UrlQuery('foo=bar');
        $this->assertEquals(['foo' => 'bar'], $query->toArray());
        $this->assertEquals('foo=bar', $query->toString());
    }

    public function test_getters_and_setters() {
        $query = new UrlQuery(['foo' => 'bar', 'baz' => 'bar']);
        $this->assertEquals(
            ['foo' => 'bar', 'baz' => 'bar'], $query->toArray()
        );
        $this->assertEquals('bar', $query->get('foo'));
        $query->set('foo', 'yolo');
        $this->assertEquals('yolo', $query->get('foo'));
        $query->remove('foo');
        $this->assertNull($query->get('foo'));
        $this->assertEquals('bar', $query->get('foo', 'bar'));
        $this->assertFalse($query->has('yolo'));
        $this->assertTrue($query->has('baz'));
    }

    public function test_count() {
        $query = new UrlQuery();
        $this->assertEquals(0, $query->count());
        $query->set('foo', 'bar');
        $this->assertEquals(1, $query->count());
    }

    public function test_get_url_encoded() {
        $query = new UrlQuery();
        $this->assertEquals('', $query->toString());
        $query->set('foo+bar', 'yolo swag @');
        $query->set(0, ['yolo']);
        $this->assertEquals(
            'foo+bar=yolo swag @&0[0]=yolo',
            $query->toString()
        );
        $this->assertEquals(
            'foo%2Bbar=yolo%20swag%20%40&0%5B0%5D=yolo',
            $query->toString(true)
        );
        $this->assertEquals(
            (string) $query, $query->toString()
        );
    }

    public function test_extend() {
        $query = new UrlQuery(['foo' => 'bar']);
        $query->extend(['bar' => 'foo']);
        $this->assertEquals(
            ['foo' => 'bar', 'bar' => 'foo'], $query->toArray()
        );
    }
}
