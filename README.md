# Template Components

A standalone, dependency free implementation of re-usable components.

## Installation

```
composer require kjohnson/template-components
```

## Example

The component defined as `foo` can be used as `<x-foo></x-foo>`.

```php
<?php

include "../vendor/autoload.php";

$compiler = new TemplateComponents\Compiler(
    new TemplateComponents\Component( 'foo', '<div>foo</div>' ),
);

echo $compiler->compile( '<x-foo></x-foo>' );

// Outputs: <div>foo</div>
```

## Composing Components
Component templates support composing via "slots", which allow for controlling the placement of passed contents within the defined component template.

```php
<?php

include "../vendor/autoload.php";

$compiler = new TemplateComponents\Compiler(
    new TemplateComponents\Component( 'foo', '<div>{{ slot }}</div>' ),
);

echo $compiler->compile( '<x-foo>bar</x-foo>' );

// Outputs: <div>bar</div>
```

## Nesting Components

Components can be composed with other components.

```php
<?php

include "../vendor/autoload.php";

$compiler = new TemplateComponents\Compiler(
    new TemplateComponents\Component( 'foo', '<div>{{ slot }}</div>' ),
    new TemplateComponents\Component( 'bar', '<span>bar</span>' ),
);

echo $compiler->compile( '<x-foo><x-bar></x-bar></x-foo>' );

// Outputs: <div><span>bar</span></div>
```