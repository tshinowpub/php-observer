<?php

declare(strict_types = 1);

namespace Observer;

interface Observable
{
    /**
     * @param Observer $observer
     */
    public function addObserver(Observer $observer);

    /**
     * @return int
     */
    public function countObservers(): int;

    /**
     * @return void
     */
    public function deleteObservers();

    /**
     * @param Observer $observer
     */
    public function deleteObserver(Observer $observer);

    /**
     * @param array $options
     *
     * @return void
     */
    public function notifyObservers(array $options = []);
}