<?php

declare(strict_types = 1);

namespace Observer;

trait ObservableTrait
{
    /**
     * @var array
     */
    protected $observers = [];

    /**
     * {@inheritdoc}
     */
    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * @return int
     */
    public function countObservers(): int
    {
        return count($this->observers);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteObservers()
    {
        $this->observers = [];
    }

    /**
     * {@inheritdoc}
     */
    public function deleteObserver(Observer $targetObserver)
    {
        $found = null;
        foreach ($this->observers as $index => $observer) {
            if ($observer->observerEquals($targetObserver)) $found = $index;
        }

        if (is_null($found)) {
            throw new \LogicException('Observer cannot removed. Target observer not found.');
        }

        array_splice($this->observers, $found, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function notifyObservers($options = [])
    {
        foreach ($this->observers as $observer) {
            $observer->update($this, $options);
        }
    }
}