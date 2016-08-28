<?php
namespace def\Cache;

interface CacheInterface
{
    /**
     * @param string $id
     * @param mixed $value
     * @param int $ttl lifetime
     * @return boolean
     */
    public function set($id, $value, $ttl = 0);

    /**
     * @param string $id
     * @param mixed $value
     * @param int $ttl lifetime
     * @return boolean
     */
    public function add($id, $value, $ttl = 0);

    /**
     * @param string $id
     * @return mixed
     */
    public function get($id);

    /**
     * @param string $id
     * @return boolean
     */
    public function contains($id);

    /**
     * @param string $id
     * @param int $ttl
     * @return boolean
     */
    public function touch($id, $ttl = 0);

    /**
     * @param string $id
     * @return boolean
     */
    public function delete($id);

    /**
     * @param string $id
     * @param int $offset
     * @return int|boolean
     */
    public function increment($id, $offset = 1);

    /**
     * @param string $id
     * @param int $offset
     * @return int|boolean
     */
    public function decrement($id, $offset = 1);

    /**
     * @return boolean
     */
    public function clear();

    public function enable();

    public function disable();
}
