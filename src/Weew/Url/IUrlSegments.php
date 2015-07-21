<?php

namespace Weew\Url;

interface IUrlSegments {
    /**
     * @return string
     */
    function getScheme();

    /**
     * @param $scheme
     */
    function setScheme($scheme);

    /**
     * @return string
     */
    function getHost();

    /**
     * @param $host
     */
    function setHost($host);

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
    function getUser();

    /**
     * @param $user
     */
    function setUser($user);

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
}
