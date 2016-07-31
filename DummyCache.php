<?php
namespace def\Cache;

class DummyCache implements CacheInterface
{
    public function set($id, $value, $ttl = 0)
    {
        return false;
    }

    public function add($id, $value, $ttl = 0)
    {
        return false;
    }

    public function get($id)
    {
        return false;
    }

    public function contains($id)
    {
        return false;
    }

    public function touch($id, $ttl = 0)
    {
        return false;
    }

    public function delete($id)
    {
        return false;
    }

    public function increment($id, $offset = 1)
    {
        return false;
    }

    public function decrement($id, $offset = 1)
    {
        return false;
    }

    public function clear()
    {
        return false;
    }

    public function enable()
    {
    }

    public function disable()
    {
    }
}
