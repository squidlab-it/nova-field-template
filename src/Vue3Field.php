<?php

namespace Squidlab\NovaFieldTemplate;

use Laravel\Nova\Fields\SupportsDependentFields;
use Squidlab\NovaFieldTemplate\Providers\FieldServiceProvider;
use Squidlab\NovaFieldTemplate\Traits\FieldHandlesDehydration;
use Squidlab\NovaFieldTemplate\Traits\FieldHandlesHydration;
use Squidlab\NovaFieldTemplate\Traits\FieldHandlesMeta;
use Squidlab\NovaFieldTemplate\Traits\FieldHandlesSerialization;
use Squidlab\NovaFieldTemplate\Traits\FieldHandlesValidation;

class Vue3Field extends \Laravel\Nova\Fields\Field
{
    use SupportsDependentFields;
    use FieldHandlesMeta;
    use FieldHandlesHydration;
    use FieldHandlesDehydration;
    use FieldHandlesSerialization;
    use FieldHandlesValidation;

    public $component = FieldServiceProvider::FIELD_NAME;
}
