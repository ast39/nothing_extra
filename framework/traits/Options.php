<?php

namespace framework\traits;


/**
 * Options Trait
 *
 * Example of usage
 *     class Foo
 *     {
 *       use Options;
 *
 *       protected $bar = '';
 *       protected $baz = '';
 *
 *       public function setBar($value)
 *       {
 *           $this->bar = $value;
 *       }
 *
 *       public function setBaz($value)
 *       {
 *           $this->baz = $value;
 *       }
 *     }
 *
 *     $Foo = new Foo();
 *     $Foo->setOptions(['bar'=>123, 'baz'=>456]);
 *
 */
trait Options
{
    /**
     * @var array options store
     */
    protected $options = [];

    /**
     * Get option by key
     *
     * @param  string $key
     * @param  array  $keys
     * @return mixed
     */
    public function getOption(string $key, ...$keys)
    {
        $method = 'get' . $this->toCamelCase($key);

        if (method_exists($this, $method)) {
            return $this->$method($key, ...$keys);
        }

        return $this->getCollection($key, ...$keys);
    }

    /**
     * Set option by key over setter
     *
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    public function setOption(string $key, $value): void
    {
        $method = 'set' . $this->toCamelCase($key);

        if (method_exists($this, $method)) {
            $this->$method($value);
        } else {
            $this->options[$key] = $value;
        }
    }

    /**
     * Get all options
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Setup, check and init options
     *
     * @param array|null $options
     * @return void
     */
    public function setOptions(?array $options = null): void
    {
        $this->options = (array)$options;

        foreach ($this->options as $key => $value) {
            $this->setOption($key, $value);
        }
    }

    /**
     * Convert string to CamelCase
     *
     * @param string $subject
     * @return string
     */
    private function toCamelCase(string $subject): string
    {
        $subject = str_replace(['_', '-'], ' ', strtolower($subject));

        return str_replace(' ', '', ucwords($subject));
    }

    /**
     * Option collection
     *
     * @param string $key
     * @param ...$keys
     * @return array
     */
    private function getCollection(string $key, ...$keys): array
    {
        $result = [];
        foreach (func_get_args() as $key) {
            if (key_exists($key, $this->options)) {
                $result[$key] = $this->options[$key];
            }
        }

        return $result;
    }
}