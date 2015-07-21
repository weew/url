<?php

namespace Weew\Url;

interface IUrlBuilder {
    /**
     * @param IUrlSegments $segments
     *
     * @return string
     */
    function build(IUrlSegments $segments);
}
