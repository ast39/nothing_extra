<?php


namespace framework\classes;

use Symfony\Component\Cache\Adapter\TagAwareAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;


class Cacher {

    public function __construct()
    {
        $this->instance = new TagAwareAdapter(
            new FilesystemAdapter('', config('sys.cache_time'))
        );
    }

    /**
     * Существует ли ключ в кэше
     *
     * @param $key
     * @return bool
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function issetItem($key)
    {
        return $this->instance->getItem($key)->isHit();
    }

    /**
     * Получить элемент по ключу
     *
     * @param $key
     * @param null $def
     * @return mixed|null
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getItem($key, $def = null)
    {
        $item = $this->instance->getItem($key);

        return $item->isHit()
            ? $item->get()
            : $def;
    }

    /**
     * Сохранить в кэш
     *
     * @param $key
     * @param $value
     * @param array $tags
     * @param null $expires
     * @throws \Psr\Cache\CacheException
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function addItem($key, $value, array $tags, $expires = NULL)
    {
        $item = $this->instance->getItem($key)->set($value)->expiresAfter($expires ?: config('sys.cache_time'))->tag($tags);
        $this->instance->save($item);
    }

    /**
     * Удалить кэш по ключу
     *
     * @param string $key
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function deleteItemByKey(string $key): void
    {
        $this->instance->deleteItem($key);
    }

    /**
     * Удалить кэш по ключам
     *
     * @param array $keys
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function deleteItemsByKeys(array $keys): void
    {
        $this->instance->deleteItems($keys);
    }

    /**
     * Удалить кэш по тэгу
     *
     * @param string $tag
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function deleteItemByTag(string $tag): void
    {
        $this->instance->invalidateTags([$tag]);
    }

    /**
     * Удалить кэш по тэгам
     *
     * @param array $tags
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function deleteItemsByTags(array $tags): void
    {
        $this->instance->invalidateTags($tags);
    }
}
