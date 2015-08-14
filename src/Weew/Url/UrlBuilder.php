<?php

namespace Weew\Url;

class UrlBuilder implements IUrlBuilder {
    /**
     * @var string
     */
    protected $pattern = ':scheme:credentials:host:port:path:query:fragment';

    /**
     * @param IUrl $url
     *
     * @return string
     */
    public function build(IUrl $url) {
        $pattern = $this->pattern;
        $pattern = $this->setScheme($pattern, $url);
        $pattern = $this->setUser($pattern, $url);
        $pattern = $this->setHost($pattern, $url);
        $pattern = $this->setPort($pattern, $url);
        $pattern = $this->setPath($pattern, $url);
        $pattern = $this->setQuery($pattern, $url);
        $pattern = $this->setFragment($pattern, $url);

        return $pattern;
    }

    /**
     * @param string $pattern
     * @param IUrl $url
     * @param string $key
     *
     * @return string
     */
    public function setScheme($pattern, IUrl $url, $key = ':scheme') {
        $scheme = $url->getScheme();

        if ($scheme) {
            $scheme = s('%s://', $scheme);
        }

        $pattern = s($pattern, [$key => $scheme]);

        return $pattern;
    }

    /**
     * @param string $pattern
     * @param IUrl $url
     * @param string $key
     *
     * @return string
     */
    public function setUser($pattern, IUrl $url, $key = ':credentials') {
        $user = $url->getUser();
        $password = $url->getPassword();
        $credentials = '';

        if ($user && $password) {
            $credentials = s('%s:%s@', $user, $password);
        }

        $pattern = s($pattern, [$key => $credentials]);

        return $pattern;
    }

    /**
     * @param string $pattern
     * @param IUrl $url
     * @param string $key
     *
     * @return string
     */
    public function setHost($pattern, IUrl $url, $key = ':host') {
        $host = $url->getHost();
        $pattern = s($pattern, [$key => $host]);

        return $pattern;
    }

    /**
     * @param string $pattern
     * @param IUrl $url
     * @param string $key
     *
     * @return string
     */
    public function setPort($pattern, IUrl $url, $key = ':port') {
        $port = $url->getPort();

        if ($port) {
            $port = s(':%s', $port);
        }

        $pattern = s($pattern, [$key => $port]);

        return $pattern;
    }

    /**
     * @param string $pattern
     * @param IUrl $url
     * @param string $key
     *
     * @return string
     */
    public function setPath($pattern, IUrl $url, $key = ':path') {
        $path = $url->getPath();
        $pattern = s($pattern, [$key => $path]);

        return $pattern;
    }

    public function setQuery($pattern, IUrl $url, $key = ':query') {
        $query = $url->getQuery()->toString();

        if ($query) {
            $query = s('?%s', $query);
        }

        $pattern = s($pattern, [$key => $query]);

        return $pattern;
    }

    /**
     * @param string $pattern
     * @param IUrl $url
     * @param string $key
     *
     * @return string
     */
    public function setFragment($pattern, IUrl $url, $key = ':fragment') {
        $fragment = $url->getFragment();

        if ($fragment) {
            $fragment = s('#%s', $fragment);
        }

        $pattern = s($pattern, [$key => $fragment]);

        return $pattern;
    }
}
