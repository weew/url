<?php

namespace Weew\Url;

interface IUrlParser {
    /**
     * @param $url
     *
     * @return IUrlSegments
     */
    function parse($url);
}
