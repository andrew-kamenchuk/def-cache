<?php
namespace def\Cache\Adapter;

use def\Cache\CacheInterface;
use def\Cache\CacheIdPrefixTrait;

class APCu implements CacheInterface
{
    use CacheIdPrefixTrait;

    private $enabled = true;

    public function enable()
    {
        $this->enabled = true;
    }

    public function disable()
    {
        $this->enabled = false;
    }

    public function set($id, $value, $ttl = 0)
    {
        return $this->enabled && apcu_store($this->id($id), $value, $ttl);
    }

    public function add($id, $value, $ttl = 0)
    {
        return $this->enabled && apcu_add($this->id($id), $value, $ttl);
    }

    public function increment($id, $offset = 1)
    {
        if ($this->enabled) {
            return apcu_inc($this->id($id), $offset);
        }

        return false;
    }

    public function decrement($id, $offset = 1)
    {
        if ($this->enabled) {
            return apcu_dec($this->id($id), $offset);
        }

        return false;
    }

    public function get($id)
    {
        if ($this->enabled) {
            return apcu_fetch($this->id($id));
        }

        return false;
    }

    public function touch($id, $ttl = 0)
    {
        $id = $this->id($id);

        if (!$this->enabled || !apcu_exists($id)) {
            return false;
        }

        return apcu_store($id, apcu_fetch($id), $ttl);
    }

    public function delete($id)
    {
        return $this->enabled && apcu_delete($this->id($id));
    }

    public function contains($id)
    {
        return $this->enabled && apcu_exists($this->id($id));
    }

    public function clear()
    {
        return $this->enabled && apcu_clear_cache();
    }
}
