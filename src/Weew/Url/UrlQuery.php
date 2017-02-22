<?php

namespace Weew\Url;

class UrlQuery implements IUrlQuery {
    /**
     * @var array
     */
    protected $query = [];

    /**
     * @param mixed $query
     */
    public function __construct($query = []) {
        $this->query = $this->parseQuery($query);
    }

    /**
     * @param string $key
     * @param null $default
     *
     * @return mixed
     */
    public function get($key, $default = null) {
        return array_get($this->query, $key, $default);
    }

    /**
     * @param string $key
     * @param $value
     */
    public function set($key, $value) {
        array_set($this->query, $key, $value);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key) {
        return array_has($this->query, $key);
    }

    /**
     * @param string $key
     */
    public function remove($key) {
        array_remove($this->query, $key);
    }

    /**
     * @return int
     */
    public function count() {
        return count($this->query);
    }

    /**
     * @param bool $encode
     *
     * @return string
     */
    public function toString($encode = false) {
        $query = http_build_query($this->query, '', '&', PHP_QUERY_RFC3986);

        if ( ! $encode) {
            return rawurldecode($query);
        }

        return $query;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->toString();
    }

    /**
     * @param array $data
     */
    public function extend(array $data) {
        $this->query = array_extend($this->query, $data);
    }

    /**
     * @return array
     */
    public function toArray() {
        return $this->query;
    }

    /**
     * @param string|array $query
     *
     * @return array
     */
    private function parseQuery($query) {
        if (is_array($query)) {
            return $query;
        }

        // "+" sign is reserved and must always be encoded,
        // otherwise it is interpreted as a space
        $queryString = str_replace('+', '%2B', $query);
        parse_str($queryString, $query);

        return $query;
    }
}
