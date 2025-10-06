<?php
namespace Collect;

class Collection
{
    protected array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function all(): array
    {
        return $this->items;
    }

    public function except(array $keys): self
    {
        $filtered = array_diff_key($this->items, array_flip($keys));
        return new static($filtered);
    }

    public function only(array $keys): self
    {
        $filtered = array_intersect_key($this->items, array_flip($keys));
        return new static($filtered);
    }
}
