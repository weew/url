<?php

namespace Weew\Url;

class UrlParser implements IUrlParser {
    /**
     * @param $url
     *
     * @return array
     */
    public function parse($url) {
        $template = [
            'protocol' => null,
            'username' => null,
            'password' => null,
            'port' => null,
            'path' => null,
            'query' => null,
            'fragment' => null,
        ];

        $parts = parse_url($url);

        if ( ! is_array($parts)) {
            $parts = parse_url('');
        }

        $parts['protocol'] = array_get($parts, 'scheme');
        $parts['username'] = array_get($parts, 'user');
        $parts['password'] = array_get($parts, 'pass');
        $parts = array_extend($template, $parts, $this->parseHost(array_get($parts, 'host')));
        array_remove($parts, ['scheme', 'host', 'user', 'pass']);

        return $this->replaceEmptyStringsWithNull($parts);
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

        return $this->replaceEmptyStringsWithNull($segments);
    }

    /**
     * @param $array
     *
     * @return array
     */
    protected function replaceEmptyStringsWithNull(array $array) {
        return array_map(function($item) {
            return ($item === '') ? null : $item;
        }, $array);
    }
}
