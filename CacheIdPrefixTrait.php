<?php

namespace def\Cache;

trait CacheIdPrefixTrait
{
    private $prefix;

    /**
     * @param string|null $prefix
     */
    public function prefix($prefix = null)
    {
        return \func_num_args() ? $this->prefix = $prefix : $this->prefix;
    }

    public function id($id)
    {
        return $this->prefix . $id;
    }
}
