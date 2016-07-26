<?php

namespace Weew\Url;

class UrlParser implements IUrlParser {
    /**
     * @param $string
     *
     * @return array
     */
    public function parse($string) {
        $segments = $this->parseSegments($string);
        $segments = array_extend($segments, $this->parseHost(array_get($segments, 'host')));

        return $this->replaceEmptyStringsWithNull($segments);
    }

    /**
     * @param $string
     *
     * @return array
     */
    public function parseHost($string) {
        $segments = [
            'tld' => null,
            'domain' => null,
            'subdomain' => null,
        ];

        $parts = explode('.', $string);

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
     * @param $string
     *
     * @return array
     */
    protected function parseSegments($string) {
        preg_match_all(
            '/^' .
            '((?P<protocol>.*):\/\/)?' .
            '(' .
                '(?P<username>.*?)' .
                '(:(?P<password>.*?)' .
            ')@)?' .
            '(?P<host>[^:\/\s]+)?' .
            '(:(?P<port>[^\/]*))?' .
            '(?P<path>[^#\?]*)?' .
            '(\?(?P<query>[^#]*))?' .
            '(#(?P<fragment>.*))?' .
            '$/',
            $string,
            $segments
        );

        foreach ($segments as $key => $value) {
            if (is_numeric($key)) {
                unset($segments[$key]);
            } else {
                $segments[$key] = array_pop($value);
            }
        }

        $host = array_get($segments, 'host');

        if ($host && $host !== 'localhost' && stripos($host, '.') === false) {
            $segments['path'] = '/' . $host . array_get($segments, 'path');
            $segments['host'] = null;
        }

        return $segments;
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
