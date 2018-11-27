<?php

declare(strict_types = 1);

namespace Observer\Tests\Fixtures;

use Observer\Observable;
use Observer\Observer;

class ObserverFixtureB implements Observer
{
    private const HASH_CODE = 2;

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
        return $this->observerHashCode() === $object->observerHashCode();;
    }

    /**
     * @{inheritDoc}
     */
    public function observerHashCode(): int
    {
        return self::HASH_CODE;
    }
}