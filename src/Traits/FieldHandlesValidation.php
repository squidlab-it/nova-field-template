<?php

namespace Squidlab\NovaFieldTemplate\Traits;

use Laravel\Nova\Http\Requests\NovaRequest;

trait FieldHandlesValidation
{
    public function getCreationRules(NovaRequest $request)
    {
        return array_merge_recursive(
            parent::getCreationRules($request),
            $this->getAdditionalRules(
                $request,
                $request->all(),
                'creation',
                $this->attribute
            )
        );
    }

    public function getUpdateRules(NovaRequest $request)
    {
        return array_merge_recursive(
            parent::getUpdateRules($request),
            $this->getAdditionalRules(
                $request,
                $request->all(),
                'update',
                $this->attribute
            )
        );
    }

    protected function getAdditionalRules(NovaRequest $request, array $values, string $specificity, string $attribute = null): array
    {
        return [];
    }
}
