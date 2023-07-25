<?php

namespace Squidlab\NovaFieldTemplate\Traits;

use Laravel\Nova\Http\Requests\NovaRequest;

trait FieldHandlesSerialization
{
    public function jsonSerialize(): array
    {
        return with(app(NovaRequest::class), function ($request) {
            return array_merge(parent::jsonSerialize(), [
                // additional data provided to the field
            ]);
        });
    }
}
