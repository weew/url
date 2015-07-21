<?php

namespace Weew\Url;

class Url implements IUrl {
    /**
     * @var string
     */
    protected $url;

    /**
     * @var IUrlSegments
     */
    protected $segments;

    /**
     * @var IUrlParser
     */
    private $parser;

    /**
     * @var IUrlBuilder
     */
    private $builder;

    /**
     * @param string ...$url
     */
    public function __construct($url = '') {
        if (is_array($url)) {
            $url = implode('/', func_get_args());
        }

        $this->buildSegments($url);
    }

    /**
     * @return string
     */
    public function toString() {
        return $this->buildUrl();
    }

    /**
     * @return IUrlSegments
     */
    public function getSegments() {
        return $this->segments;
    }

    /**
     * @param $url
     */
    protected function buildSegments($url) {
        $this->segments = $this->getUrlParser()->parse($url);
    }

    /**
     * @return string
     */
    protected function buildUrl() {
        $url = $this->getUrlBuilder()->build($this->segments);

        return $url;
    }

    /**
     * @return IUrlParser
     */
    protected function getUrlParser() {
        if ( ! $this->parser instanceof IUrlParser) {
            $this->parser = new UrlParser();
        }

        return $this->parser;
    }

    /**
     * return IUrlBuilder
     */
    protected function getUrlBuilder() {
        if ( ! $this->builder instanceof IUrlBuilder) {
            $this->builder = new UrlBuilder();
        }

        return $this->builder;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->toString();
    }
}
