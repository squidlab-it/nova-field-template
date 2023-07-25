<?php

namespace Squidlab\NovaFieldTemplate\Traits;

trait FieldHandlesMeta
{
    public function allowIncrement(bool $allowed = true): static
    {
        return $this->withMeta([
            'allowIncrement' => $allowed,
        ]);
    }

    public function allowDecrement(bool $allowed = true): static
    {
        return $this->withMeta([
            'allowDecrement' => $allowed,
        ]);
    }

    protected function defaultMeta(): array
    {
        return [
            'allowIncrement' => true,
            'allowDecrement' => true,
        ];
    }

    public function meta()
    {
        return [
            ...$this->defaultMeta(),
            ...parent::meta(),
        ];
    }
}
