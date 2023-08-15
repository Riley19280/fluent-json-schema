<?php

namespace FluentJsonSchema\Utility;

trait Foreachable
{
    /**
     * @param iterable                                      $items
     * @param callable(static $this, mixed ...$args): mixed $handler
     * @param                                               ...$args
     *
     * @return $this
     */
    public function foreach(iterable $items, callable $handler, ...$args): static
    {
        foreach ($items as $item) {
            $handler($this, $item, ...$args);
        }

        return $this;
    }
}
