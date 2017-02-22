<?php

namespace Weew\Url;

interface IUrlBuilder {
    /**
     * @param IUrl $url
     * @param bool $encode
     *
     * @return string
     */
    function build(IUrl $url, $encode = false);

    /**
     * @param $tld
     * @param $domain
     * @param $subdomain
     *
     * @return string
     */
    function buildHost($tld, $domain, $subdomain);
}
