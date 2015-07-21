<?php

namespace Weew\Url;

class UrlBuilder implements IUrlBuilder {
    /**
     * @var string
     */
    protected $urlScheme = ':scheme:credentials:host:port:path:query:fragment';

    /**
     * @param IUrlSegments $segments
     *
     * @return string
     */
    public function build(IUrlSegments $segments) {
        $url = $this->urlScheme;
        $url = $this->setScheme($url, $segments);
        $url = $this->setUser($url, $segments);
        $url = $this->setHost($url, $segments);
        $url = $this->setPort($url, $segments);
        $url = $this->setPath($url, $segments);
        $url = $this->setQuery($url, $segments);
        $url = $this->setFragment($url, $segments);

        return $url;
    }

    /**
     * @param string $url
     * @param IUrlSegments $segments
     * @param string $key
     *
     * @return string
     */
    public function setScheme($url, IUrlSegments $segments, $key = ':scheme') {
        $scheme = $segments->getScheme();

        if ($scheme) {
            $scheme = s('%s://', $scheme);
        }

        $url = s($url, [$key => $scheme]);

        return $url;
    }

    /**
     * @param string $url
     * @param IUrlSegments $segments
     * @param string $key
     *
     * @return string
     */
    public function setUser($url, IUrlSegments $segments, $key = ':credentials') {
        $user = $segments->getUser();
        $password = $segments->getPassword();
        $credentials = '';

        if ($user and $password) {
            $credentials = s('%s:%s@', $user, $password);
        }

        $url = s($url, [$key => $credentials]);

        return $url;
    }

    /**
     * @param string $url
     * @param IUrlSegments $segments
     * @param string $key
     *
     * @return string
     */
    public function setHost($url, IUrlSegments $segments, $key = ':host') {
        $host = $segments->getHost();
        $url = s($url, [$key => $host]);

        return $url;
    }

    /**
     * @param string $url
     * @param IUrlSegments $segments
     * @param string $key
     *
     * @return string
     */
    public function setPort($url, IUrlSegments $segments, $key = ':port') {
        $port = $segments->getPort();

        if ($port) {
            $port = s(':%s', $port);
        }

        $url = s($url, [$key => $port]);

        return $url;
    }

    /**
     * @param string $url
     * @param IUrlSegments $segments
     * @param string $key
     *
     * @return string
     */
    public function setPath($url, IUrlSegments $segments, $key = ':path') {
        $path = $segments->getPath();
        $url = s($url, [$key => $path]);

        return $url;
    }

    public function setQuery($url, IUrlSegments $segments, $key = ':query') {
        $query = $segments->getQuery()->toString();

        if ($query) {
            $query = s('?%s', $query);
        }

        $url = s($url, [$key => $query]);

        return $url;
    }

    /**
     * @param string $url
     * @param IUrlSegments $segments
     * @param string $key
     *
     * @return string
     */
    public function setFragment($url, IUrlSegments $segments, $key = ':fragment') {
        $fragment = $segments->getFragment();

        if ($fragment) {
            $fragment = s('#%s', $fragment);
        }

        $url = s($url, [$key => $fragment]);

        return $url;
    }
}
