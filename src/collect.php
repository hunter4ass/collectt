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

    public function only(array $keys): self
    {
        $filtered = array_intersect_key($this->items, array_flip($keys));
        return new static($filtered);
    }

    public function except(array $keys): self
    {
        $filtered = array_diff_key($this->items, array_flip($keys));
        return new static($filtered);
    }

    public function add(string $key, $value): self
    {
        $this->items[$key] = $value;
        return $this;
    }

    public function filter(callable $callback): self
    {
        return new static(array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH));
    }

    public function map(callable $callback): self
    {
        return new static(array_map($callback, $this->items));
    }

    public function count(): int
    {
        return count($this->items);
    }
}
