<?php

namespace Weew\Url;

class UrlParser implements IUrlParser {
    /**
     * @param $url
     *
     * @return array
     */
    public function parse($url) {
        $parts = parse_url($url);

        $parts['protocol'] = array_get($parts, 'scheme');
        $parts['username'] = array_get($parts, 'user');
        $parts['password'] = array_get($parts, 'pass');
        $parts = array_extend($parts, $this->parseHost(array_get($parts, 'host')));

        array_remove($parts, 'scheme');
        array_remove($parts, 'host');
        array_remove($parts, 'user');
        array_remove($parts, 'pass');

        return $parts;
    }

    /**
     * @param $host
     *
     * @return array
     */
    public function parseHost($host) {
        $segments = [
            'tld' => null,
            'domain' => null,
            'subdomain' => null,
        ];

        $parts = explode('.', $host);

        if (count($parts) == 1) {
            $segments['domain'] = $parts[0];

            return $segments;
        }

        if (count($parts)) {
            $segments['tld'] = array_pop($parts);
        }

        if (count($parts)) {
            $segments['domain'] = array_pop($parts);
        }

        if (count($parts)) {
            $segments['subdomain'] = implode('.', $parts);
        }

        return $segments;
    }
}
