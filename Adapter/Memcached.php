<?php
namespace def\Cache\Adapter;

use def\Cache\CacheInterface;
use def\Cache\CacheIdPrefixTrait;

class Memcached implements CacheInterface
{
    use CacheIdPrefixTrait;

    const MEMCACHED_TTL_LIMITATION = 60 * 60 * 24 * 30;

    /**
     * @var \Memcached
     */
    private $memcached;

    private $enabled = true;

    public function __construct(array $servers = [])
    {
        $this->memcached = new \Memcached();

        if (!empty($servers)) {
            $this->memcached->addServers($servers);
        }
    }

    public function enable()
    {
        $this->enabled = true;
    }

    public function disable()
    {
        $this->enabled = false;
    }

    public function setMemcached(\Memcached $memcached)
    {
        $this->memcached = $memcached;
    }

    public function getMemcached()
    {
        return $this->memcached;
    }

    public function set($id, $value, $ttl = 0)
    {
        if ($ttl > self::MEMCACHED_TTL_LIMITATION) {
            $ttl = time() + $ttl;
        }

        return $this->enabled && $this->memcached->set($this->id($id), $value, $ttl);
    }

    public function add($id, $value, $ttl = 0)
    {
        if ($ttl > self::MEMCACHED_TTL_LIMITATION) {
            $ttl = time() + $ttl;
        }

        return $this->enabled && $this->memcached->add($this->id($id), $value, $ttl);
    }

    public function increment($id, $offset = 1)
    {
        if ($this->enabled) {
            return $this->memcached->increment($this->id($id), $offset);
        }

        return false;
    }

    public function decrement($id, $offset = 1)
    {
        if ($this->enabled) {
            return $this->memcached->decrement($this->id($id), $offset);
        }

        return false;
    }

    public function get($id)
    {
        if ($this->enabled) {
            return $this->memcached->get($this->id($id));
        }

        return false;
    }

    public function touch($id, $ttl = 0)
    {
        if ($ttl > self::MEMCACHED_TTL_LIMITATION) {
            $ttl = time() + $ttl;
        }

        return $this->enabled && $this->memcached->touch($this->id($id), $ttl);
    }

    public function delete($id)
    {
        return $this->enabled && $this->memcached->delete($this->id($id));
    }

    public function contains($id)
    {
        return $this->enabled && (
               !$this->memcached->add($this->id($id), $id)
            || ($this->memcached->delete($this->id($id)) && false)
        );
    }

    public function clear()
    {
        return $this->enabled && $this->memcached->flush();
    }
}
