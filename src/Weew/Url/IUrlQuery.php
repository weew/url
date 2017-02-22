<?php

namespace Weew\Url;

use Weew\Contracts\IArrayable;
use Weew\Contracts\IStringable;

interface IUrlQuery extends IArrayable, IStringable {
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
     * @param array $data
     */
    function extend(array $data);

    /**
     * @param bool $encode
     *
     * @return string
     */
    function toString($encode = false);
}
