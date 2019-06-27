<?php

namespace Winzana\Core\Event\DependencyInjection;

use Winzana\Core\Event\Annotation\Event;
use Winzana\Core\Event\Utils\AnnotationParser;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\Finder\Finder;

class EventExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        if (isset($configs[0]['mapping']['paths'])) {
            /** @var AnnotationReader $reader */
            $reader = new AnnotationReader();

            foreach ($configs[0]['mapping']['paths'] as $path) {
                $finder = new Finder();
                $finder->files()->in($path);

                foreach ($finder as $file) {
                    $class = AnnotationParser::getAllFcqn($file->getRealPath());
                    if (!$reader->getClassAnnotation(new \ReflectionClass($class), Event::class)) {
                        continue;
                    }
                    $eventName = call_user_func(array($class, 'getEventName'));
                    $priority = call_user_func(array($class, 'priority'));

                    $listener = new Definition($class);
                    $listener->setPrivate(true);
                    $listener->setAutowired(true);
                    $listener->addTag('kernel.event_listener', ['event' => $eventName, 'priority' => $priority]);
                    $container->setDefinition(sprintf('event.%s', AnnotationParser::slug($class)), $listener);
                }
            }
        }
    }
}
