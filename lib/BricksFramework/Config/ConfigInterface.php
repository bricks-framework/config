<?php

/** @copyright Sven Ullmann <kontakt@sumedia-webdesign.de> **/

namespace BricksFramework\Config;

interface ConfigInterface
{
    public function get(string $path);

    public function set(string $path, $value) : void;

    public function remove(string $path) : void;

    public function has(string $path) : bool;

    public function merge(array $data);
}
