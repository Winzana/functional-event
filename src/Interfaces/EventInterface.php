<?php

namespace Winzana\Core\Event\Interfaces;


interface EventInterface
{
    public function getEventName(): string;
    public function getPriority(): int;
}
