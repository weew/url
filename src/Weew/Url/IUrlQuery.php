<?php

namespace Weew\Url;

interface IUrlQuery {
    /**
     * @return array
     */
    function getAll();

    /**
     * @param string $key
     * @param null $default
     *
     * @return mixed
     */
    function get($key, $default = null);

    /**
     * @param string $key
     * @param $value
     */
    function set($key, $value);

    /**
     * @param string $key
     *
     * @return bool
     */
    function has($key);

    /**
     * @param string $key
     */
    function remove($key);

    /**
     * @return int
     */
    function count();

    /**
     * @return string
     */
    function toString();

    /**
     * @param array $data
     */
    function extend(array $data);
}
