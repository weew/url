<?php

namespace Weew\Url;

use Weew\Collections\IDictionary;
use Weew\Contracts\IArrayable;
use Weew\Contracts\IStringable;

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
     * @param $pattern
     * @param array $patterns
     *
     * @return true
     */
    function matchPath($pattern, array $patterns = []);

    /**
     * @param $pattern
     * @param array $patterns
     *
     * @return IDictionary
     */
    function parsePath($pattern, array $patterns = []);

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
