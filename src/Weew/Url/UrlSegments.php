<?php

namespace Weew\Url;

class UrlSegments implements IUrlSegments {
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

        if ($path and $this->getPath()) {
            $this->setPath(s('%s%s', $this->getPath(), $path));
        } else {
            $this->setPath($path);
        }
    }

    /**
     * @param $segment
     *
     * @return string
     */
    protected function addLeadingSlash($segment) {
        if ($segment and substr($segment, 0, 1) != '/') {
            $segment = s('/%s', $segment);
        }

        return $segment;
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
}
