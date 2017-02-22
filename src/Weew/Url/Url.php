<?php

namespace Weew\Url;

use Weew\Collections\IDictionary;
use Weew\UrlMatcher\IUrlMatcher;
use Weew\UrlMatcher\UrlMatcher;

class Url implements IUrl {
    /**
     * @var IUrlParser
     */
    protected $parser;

    /**
     * @var IUrlMatcher
     */
    protected $matcher;

    /**
     * @var IUrlBuilder
     */
    protected $builder;

    /**
     * @var string
     */
    protected $protocol;

    /**
     * @var string
     */
    protected $tld;

    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $subdomain;

    /**
     * @var string
     */
    protected $port;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var IUrlQuery
     */
    protected $query;

    /**
     * @var string
     */
    protected $fragment;

    /**
     * @param string ...$url
     */
    public function __construct($url = '') {
        $this->builder = $this->createBuilder();
        $this->parser = $this->createParser();
        $this->matcher = $this->createMatcher();

        $this->build(implode('/', func_get_args()));
    }

    /**
     * @return string
     */
    public function getProtocol() {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol($protocol) {
        $this->protocol = $protocol;
    }

    /**
     * @return string
     */
    public function getHost() {
        return $this->builder->buildHost(
            $this->getTLD(), $this->getDomain(), $this->getSubdomain()
        );
    }

    /**
     * @param string $host
     */
    public function setHost($host) {
        $parts = $this->parser->parseHost($host);
        $this->setTLD(array_get($parts, 'tld'));
        $this->setDomain(array_get($parts, 'domain'));
        $this->setSubdomain(array_get($parts, 'subdomain'));
    }

    /**
     * @return string
     */
    public function getTLD() {
        return $this->tld;
    }

    /**
     * @param string $tld
     */
    public function setTLD($tld) {
        $this->tld = $tld;
    }

    /**
     * @return string
     */
    public function getDomain() {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain($domain) {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getSubdomain() {
        return $this->subdomain;
    }

    /**
     * @param string $subdomain
     */
    public function setSubdomain($subdomain) {
        $this->subdomain = $subdomain;
    }

    /**
     * @return string
     */
    public function getPort() {
        return $this->port;
    }

    /**
     * @param string $port
     */
    public function setPort($port) {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path) {
        $this->path = $this->addLeadingSlash($path);
    }

    /**
     * @param string $path
     */
    public function addPath($path) {
        $this->setPath(
            $this->getPath() . $this->addLeadingSlash($path)
        );
    }

    /**
     * @param string $pattern
     * @param array $patterns
     *
     * @return bool
     */
    public function match($pattern, array $patterns = []) {
        return $this->matcher->match(
            $this->addLeadingSlash($pattern), $this->getPath(), $patterns
        );
    }

    /**
     * @param string $pattern
     * @param array $patterns
     *
     * @return IDictionary
     */
    public function parse($pattern, array $patterns = []) {
        return $this->matcher->parse(
            $pattern, $this->getPath(), $patterns
        );
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function replace($key, $value) {
        $url = $this->matcher->replace(
            $this->toString(), $key, $value
        );

        $this->build($url);
    }

    /**
     * @param array $replacements
     */
    public function replaceAll(array $replacements) {
        $url = $this->matcher->replaceAll(
            $this->toString(), $replacements
        );

        $this->build($url);
    }

    /**
     * @return IUrlQuery
     */
    public function getQuery() {
        return $this->query;
    }

    /**
     * @param IUrlQuery $query
     */
    public function setQuery(IUrlQuery $query) {
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getFragment() {
        return $this->fragment;
    }

    /**
     * @param string $fragment
     */
    public function setFragment($fragment) {
        $this->fragment = $fragment;
    }

    /**
     * @param bool $encode
     *
     * @return string
     */
    public function toString($encode = false) {
        return $this->buildUrl($encode);
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->toString();
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'protocol' => $this->getProtocol(),
            'tld' => $this->getTLD(),
            'domain' => $this->getDomain(),
            'subdomain' => $this->getSubdomain(),
            'host' => $this->getHost(),
            'port' => $this->getPort(),
            'path' => $this->getPath(),
            'query' => $this->getQuery()->toArray(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'fragment' => $this->getFragment(),
            'full' => $this->toString(),
        ];
    }

    /**
     * @param string $url
     */
    protected function build($url) {
        $parts = $this->parser->parse($url);

        $this->setProtocol(array_get($parts, 'protocol'));
        $this->setTLD(array_get($parts, 'tld'));
        $this->setDomain(array_get($parts, 'domain'));
        $this->setSubdomain(array_get($parts, 'subdomain'));
        $this->setPath(array_get($parts, 'path'));
        $this->setPort(array_get($parts, 'port'));
        $this->setUsername(array_get($parts, 'username'));
        $this->setPassword(array_get($parts, 'password'));
        $this->setQuery(new UrlQuery(array_get($parts, 'query')));
        $this->setFragment(array_get($parts, 'fragment'));
    }

    /**
     * @param $segment
     *
     * @return string
     */
    protected function addLeadingSlash($segment) {
        if ($segment && substr($segment, 0, 1) != '/') {
            $segment = s('/%s', $segment);
        }

        return $segment;
    }

    /**
     * @param bool $encode
     *
     * @return string
     */
    protected function buildUrl($encode = false) {
        return $this->builder->build($this, $encode);
    }

    /**
     * @return IUrlBuilder
     */
    protected function createBuilder() {
        return new UrlBuilder();
    }

    /**
     * @return IUrlParser
     */
    protected function createParser() {
        return new UrlParser();
    }

    /**
     * @return IUrlMatcher
     */
    protected function createMatcher() {
        return new UrlMatcher();
    }
}
