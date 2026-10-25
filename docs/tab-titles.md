# Native tab titles

```php
$tab = (new \Presentation\UI\Tabs\Tab())
    ->setName('Подавления')
    ->setTitle('Временное скрытие обращений');
```

`getTitle(): string` returns the plain-text hover hint; `setTitle(string): Tab`
returns the same tab for chaining. The default is an empty string, and setting
an empty string clears the hint. The visible name remains independent.

Renderers should omit the `title` attribute when empty and HTML-escape nonempty
values at output using `ENT_QUOTES | ENT_SUBSTITUTE` and UTF-8. Do not pre-escape
the value when calling `setTitle()`.
