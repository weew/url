<?php

namespace Weew\Url;

interface IUrlBuilder {
    /**
     * @param IUrl $url
     *
     * @return string
     */
    function build(IUrl $url);

    /**
     * @param $tld
     * @param $domain
     * @param $subdomain
     *
     * @return string
     */
    function buildHost($tld, $domain, $subdomain);
}
