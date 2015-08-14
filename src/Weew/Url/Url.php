<?php

namespace Weew\Url;

class Url implements IUrl {
    /**
     * @var IUrlParser
     */
    protected $parser;

    /**
     * @var IUrlBuilder
     */
    protected $builder;

    /**
     * @var string
     */
    protected $scheme;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $port;

    /**
     * @var string
     */
    protected $user;

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
       $url = implode('/', func_get_args());

        $this->builder = $this->createBuilder();
        $this->parse($url);
    }

    /**
     * @param string $url
     */
    public function parse($url) {
        $parts = parse_url($url);

        $this->setFragment(array_get($parts, 'fragment'));
        $this->setHost(array_get($parts, 'host'));
        $this->setPassword(array_get($parts, 'pass'));
        $this->setPath(array_get($parts, 'path'));
        $this->setPort(array_get($parts, 'port'));
        $this->setScheme(array_get($parts, 'scheme'));
        $this->setUser(array_get($parts, 'user'));
        $this->setQuery(new UrlQuery(array_get($parts, 'query')));
    }

    /**
     * @return string
     */
    public function getScheme() {
        return $this->scheme;
    }

    /**
     * @param string $scheme
     */
    public function setScheme($scheme) {
        $this->scheme = $scheme;
    }

    /**
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host) {
        $this->host = $host;
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
    public function getUser() {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser($user) {
        $this->user = $user;
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
     * @param $path
     */
    public function addPath($path) {
        $path = $this->addLeadingSlash($path);
        $this->setPath($this->getPath() . $path);
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
     * @return string
     */
    public function toString() {
        return $this->buildUrl();
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->toString();
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
     * @return string
     */
    protected function buildUrl() {
        $url = $this->getUrlBuilder()->build($this);

        return $url;
    }

    /**
     * return IUrlBuilder
     */
    protected function getUrlBuilder() {
        return $this->builder;
    }

    /**
     * @return UrlBuilder
     */
    protected function createBuilder() {
        return new UrlBuilder();
    }
}
