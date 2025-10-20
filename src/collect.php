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

    public function reduce(callable $callback, $initial = null)
    {
        return array_reduce($this->items, $callback, $initial);
    }

    public function merge(array $items): self
    {
        return new static(array_merge($this->items, $items));
    }

    public function pluck(string $key): array
    {
        return array_column($this->items, $key);
    }

    public function sort(callable $callback = null): self
    {
        $items = $this->items;
        if ($callback) {
            uasort($items, $callback);
        } else {
            asort($items);
        }
        return new static($items);
    }
}