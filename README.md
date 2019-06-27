# Winzana - Model Event Bundle
Symfony functional Event Bundle

## Install
Create a config file `config/packages/winzana_model_event.yaml`. 
```yaml
event:
    mapping:
        paths: ['%kernel.project_dir%/src/CommandHandler']

```

Add bundle into `config\bundles.php`.
```php
<?php

return [   
    Winzana\Core\Event\EventBundle::class => ['all' => true],
];
```


## Example
In your CommandHandler directory.

```php
<?php
namespace App\CommandHandler;

use Winzana\Core\Event\Annotation\Event;
use Winzana\Core\Event\Interfaces\EventInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class CreateUserCommandHandler
 * @Event()
 */
final class CreateUserCommandHandler implements EventInterface
{
    public function __invoke(GetResponseEvent $event)
    {
        // TODO: Implement __invoke() method.
    }

    public function getEventName(): string
    {
        return 'kernel.request';
    }

    public function getPriority(): int
    {
        return 10;
    }

}
```
