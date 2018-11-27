<?php

declare(strict_types = 1);

namespace Observer\Tests\Fixtures;

use Observer\Observable;
use Observer\Observer;

class ObserverFixtureA implements Observer
{
    private const HASH_CODE = 1;

    /**
     * @{inheritDoc}
     */
    public function update(Observable $observed, array $options = [])
    {
    }

    /**
     * @{inheritDoc}
     */
    public function observerEquals(Observer $object): bool
    {
        return $this->observerHashCode() === $object->observerHashCode();
    }

    /**
     * @{inheritDoc}
     */
    public function observerHashCode(): int
    {
        return self::HASH_CODE;
    }
}