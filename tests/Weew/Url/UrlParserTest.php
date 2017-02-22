<?php

namespace Tests\Weew\Url;

use PHPUnit_Framework_TestCase;
use Weew\Url\UrlParser;

class UrlParserTest extends PHPUnit_Framework_TestCase {
    public function test_parse_host() {
        $parser = new UrlParser();

        $this->assertEquals(
            ['tld' => 'com', 'domain' => 'bar', 'subdomain' => 'foo'],
            $parser->parseHost('foo.bar.com')
        );
        $this->assertEquals(
            ['tld' => 'com', 'domain' => 'example', 'subdomain' => 'just.an'],
            $parser->parseHost('just.an.example.com')
        );
        $this->assertEquals(
            ['tld' => null, 'domain' => 'localhost', 'subdomain' => null],
            $parser->parseHost('localhost')
        );
        $this->assertEquals(
            ['tld' => 'foo', 'domain' => 'localhost', 'subdomain' => null],
            $parser->parseHost('localhost.foo')
        );
        $this->assertEquals(
            ['tld' => 'foo', 'domain' => 'localhost', 'subdomain' => 'this.is'],
            $parser->parseHost('this.is.localhost.foo')
        );
    }

    public function test_parse() {
        $parser = new UrlParser();

        $this->assertEquals(
            [
                'protocol' => 'http',
                'username' => 'name',
                'password' => 'pass',
                'subdomain' => 'just.an',
                'domain' => 'example',
                'tld' => 'com',
                'port' => '80',
                'path' => '/products',
                'query' => 'sku=1234',
                'fragment' => 'price',
                'host' => 'just.an.example.com',
            ],
            $parser->parse('http://name:pass@just.an.example.com:80/products?sku=1234#price')
        );

        $parser = new UrlParser();

        $this->assertEquals(
            [
                'protocol' => 'http',
                'username' => 'name',
                'password' => 'pass',
                'subdomain' => 'just.an',
                'domain' => 'example',
                'tld' => 'com',
                'port' => '80',
                'path' => null,
                'query' => 'sku=1234',
                'fragment' => 'price',
                'host' => 'just.an.example.com',
            ],
            $parser->parse('http://name:pass@just.an.example.com:80?sku=1234#price')
        );
    }

    public function test_parse_host_removes_empty_strings() {
        $parser = new UrlParser();
        $this->assertEquals([
            'domain' => null,
            'subdomain' => null,
            'tld' => null,
        ], $parser->parseHost(''));
    }

    public function test_parse_malformed() {
        $parser = new UrlParser();
        $this->assertEquals([
            'protocol' => 'https',
            'username' => null,
            'password' => null,
            'subdomain' => null,
            'domain' => null,
            'tld' => null,
            'port' => null,
            'path' => null,
            'query' => null,
            'fragment' => null,
            'host' => null,
        ], $parser->parse('https://'));
    }

    public function test_parse_empty() {
        $parser = new UrlParser();
        $this->assertEquals([
            'protocol' => null,
            'username' => null,
            'password' => null,
            'subdomain' => null,
            'domain' => null,
            'tld' => null,
            'port' => null,
            'path' => null,
            'query' => null,
            'fragment' => null,
            'host' => null,
        ], $parser->parse(''));
    }
}
