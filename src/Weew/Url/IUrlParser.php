<?php

namespace Weew\Url;

interface IUrlParser {
    /**
     * @param $url
     *
     * @return array
     */
    function parse($url);

    /**
     * @param $host
     *
     * @return array
     */
    function parseHost($host);
}
