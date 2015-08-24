<?php

namespace Weew\Url;

use Weew\Foundation\Interfaces\IArrayable;
use Weew\Foundation\Interfaces\IStringable;

interface IUrl extends IStringable, IArrayable {
    /**
     * @return string
     */
    function getProtocol();

    /**
     * @param $protocol
     */
    function setProtocol($protocol);

    /**
     * @return string
     */
    function getHost();

    /**
     * @param $host
     */
    function setHost($host);

    /**
     * @return string
     */
    function getTLD();

    /**
     * @param $tld
     */
    function setTLD($tld);

    /**
     * @return string
     */
    function getDomain();

    /**
     * @param $domain
     */
    function setDomain($domain);

    /**
     * @return string
     */
    function getSubdomain();

    /**
     * @param $subdomain
     */
    function setSubdomain($subdomain);

    /**
     * @return int
     */
    function getPort();

    /**
     * @param $port
     */
    function setPort($port);

    /**
     * @return string
     */
    function getUsername();

    /**
     * @param $user
     */
    function setUsername($user);

    /**
     * @return string
     */
    function getPassword();

    /**
     * @param $password
     */
    function setPassword($password);

    /**
     * @return string
     */
    function getPath();

    /**
     * @param $path
     */
    function setPath($path);

    /**
     * @param $path
     */
    function addPath($path);

    /**
     * @return IUrlQuery
     */
    function getQuery();

    /**
     * @param IUrlQuery $query
     */
    function setQuery(IUrlQuery $query);

    /**
     * @return string
     */
    function getFragment();

    /**
     * @param $fragment
     */
    function setFragment($fragment);

    /**
     * @return string
     */
    function toString();
}
