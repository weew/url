<?php

namespace Weew\Url;

interface IUrlParser {
    /**
     * @param $string
     *
     * @return array
     */
    function parse($string);

    /**
     * @param $string
     *
     * @return array
     */
    function parseHost($string);
}
