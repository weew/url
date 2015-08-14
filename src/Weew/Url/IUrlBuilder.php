<?php

namespace Weew\Url;

interface IUrlBuilder {
    /**
     * @param IUrl $url
     *
     * @return string
     */
    function build(IUrl $url);
}
