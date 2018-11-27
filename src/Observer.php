<?php

declare(strict_types = 1);

namespace Observer;

interface Observer
{
    /**
     * @param Observable $observed
     * @param array $options
     *
     * @return void
     */
    public function update(Observable $observed, array $options = []);

    /**
     * @param Observer $observer
     *
     * @return bool
     */
    public function observerEquals(Observer $observer): bool;

    /**
     * @return int
     */
    public function observerHashCode(): int;
}