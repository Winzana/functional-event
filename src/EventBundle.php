<?php

namespace Winzana\Core\Event;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EventBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        AnnotationRegistry::registerFile(__DIR__ . '/Annotation/Event.php');
    }
}
