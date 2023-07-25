<?php

namespace Squidlab\NovaFieldTemplate\Traits;

use Laravel\Nova\Http\Requests\NovaRequest;

trait FieldHandlesDehydration
{
    public function fill(NovaRequest $request, $model)
    {
        $callbacks = parent::fill($request, $model) ?? [];
        if (! is_array($callbacks)) {
            $callbacks = is_callable($callbacks) ? [$callbacks] : [];
        }

        return [
            ...$callbacks,

            // additional callbacks executed after all form's fields
            // are filled into the model, and the model is saved
        ];
    }

    public function fillModelWithData($model, $value, string $attribute)
    {
        // additional value manipulation before de-hydration

        parent::fillModelWithData($model, $value, $attribute);

        // additional model manipulation after de-hydration
    }
}
