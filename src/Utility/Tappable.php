<?php

namespace FluentJsonSchema\Utility;

trait Tappable
{
    /**
     * @param callable(static $self): static $callback
     *
     * @return static
     */
    public function tap(callable $callback): static
    {
        $callback($this);

        return $this;
    }
}
