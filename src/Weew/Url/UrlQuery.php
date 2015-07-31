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
        if (is_string($query)) {
            $queryString = $query;
            parse_str($queryString, $query);
        }

        if (is_array($query)) {
            $this->query = $query;
        }
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
     * @return string
     */
    public function toString() {
        return http_build_query($this->query);
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
}
