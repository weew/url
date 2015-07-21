<?php

namespace Weew\Url;

class UrlParser implements IUrlParser {
    /**
     * @param $url
     *
     * @return IUrlSegments
     */
    function parse($url) {
        $parts = parse_url($url);
        $segments = new UrlSegments();
        $segments->setFragment(array_get($parts, 'fragment'));
        $segments->setHost(array_get($parts, 'host'));
        $segments->setPassword(array_get($parts, 'pass'));
        $segments->setPath(array_get($parts, 'path'));
        $segments->setPort(array_get($parts, 'port'));
        $segments->setScheme(array_get($parts, 'scheme'));
        $segments->setUser(array_get($parts, 'user'));
        $segments->setQuery(new UrlQuery(array_get($parts, 'query')));

        return $segments;
    }
}
