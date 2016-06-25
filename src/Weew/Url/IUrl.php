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
     * @param string $protocol
     */
    function setProtocol($protocol);

    /**
     * @return string
     */
    function getHost();

    /**
     * @param string $host
     */
    function setHost($host);

    /**
     * @return string
     */
    function getTLD();

    /**
     * @param string $tld
     */
    function setTLD($tld);

    /**
     * @return string
     */
    function getDomain();

    /**
     * @param string $domain
     */
    function setDomain($domain);

    /**
     * @return string
     */
    function getSubdomain();

    /**
     * @param string $subdomain
     */
    function setSubdomain($subdomain);

    /**
     * @return int
     */
    function getPort();

    /**
     * @param int $port
     */
    function setPort($port);

    /**
     * @return string
     */
    function getUsername();

    /**
     * @param string $user
     */
    function setUsername($user);

    /**
     * @return string
     */
    function getPassword();

    /**
     * @param string $password
     */
    function setPassword($password);

    /**
     * @return string
     */
    function getPath();

    /**
     * @param string $path
     */
    function setPath($path);

    /**
     * @param string $path
     */
    function addPath($path);

    /**
     * @param string $pattern
     * @param array $patterns
     *
     * @return true
     */
    function match($pattern, array $patterns = []);

    /**
     * @param string $pattern
     * @param array $patterns
     *
     * @return IDictionary
     */
    function parse($pattern, array $patterns = []);

    /**
     * @param string $placeholder
     * @param string $value
     */
    function replace($placeholder, $value);

    /**
     * @param array $replacements
     */
    function replaceAll(array $replacements);

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
     * @param string $fragment
     */
    function setFragment($fragment);

    /**
     * @return string
     */
    function toString();
}
