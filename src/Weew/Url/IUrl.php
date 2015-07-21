<?php

namespace Weew\Url;

use Weew\Foundation\Interfaces\IStringable;

interface IUrl extends IStringable {
    /**
     * @return string
     */
    function toString();

    /**
     * @return IUrlSegments
     */
    function getSegments();
}
