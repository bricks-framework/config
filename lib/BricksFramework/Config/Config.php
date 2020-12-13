<?php

/** @copyright Sven Ullmann <kontakt@sumedia-webdesign.de> **/

declare(strict_types=1);

namespace BricksFramework\Config;

use BricksFramework\ArrayKeyParser\ArrayKeyParserInterface;

class Config implements ConfigInterface, \IteratorAggregate
{
    /**
     * @var \BricksFramework\ArrayKeyParser\ArrayKeyParserInterface
     */
    protected $arrayKeyParser;

    protected $data = [];

    public function __construct(ArrayKeyParserInterface $arrayKeyParser) {
        $this->arrayKeyParser = $arrayKeyParser;
    }

    public function get(string $path)
    {
        if ($this->arrayKeyParser->has($this->data, $path)) {
            return $this->arrayKeyParser->get($this->data, $path);
        }
    }

    public function set(string $path, $value) : void
    {
        $this->arrayKeyParser->set($this->data, $path, $value);
    }

    public function remove(string $path) : void
    {
        $this->arrayKeyParser->remove($this->data, $path);
    }

    public function has(string $path) : bool
    {
        return $this->arrayKeyParser->has($this->data, $path);
    }

    public function merge(array $data)
    {
        $path = '';
        foreach ($data as $key => $value) {
            $path .= empty($path)
                ? $this->arrayKeyParser->escape($key)
                : '.' . $this->arrayKeyParser->escape($key);
            $this->set($path, $value);
        }
    }

    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->data);
    }
}
