<template>
  <div
    :class="config.rootClass"
    class="flex flex-col md:flex-row -mx-6 px-6 py-2 md:py-0 space-y-2 md:space-y-0"
    :dusk="props.field.attribute"
  >
    <div class="md:w-1/4 md:py-3">
      <slot>
        <h4 class="font-normal">
          <span>{{ fieldLabel }}</span>
        </h4>
      </slot>
    </div>
    <div class="md:w-3/4 md:py-3 break-all lg:break-words">
      <span
        class="relative bg-primary-500 text-white dark:text-gray-900 rounded text-sm font-bold inline-flex items-center justify-center px-2 py-1 bg-primary-500"
      >
        {{ value.counter }}
      </span>
    </div>
  </div>
</template>

<script lang="ts" setup>
import type { FieldEmitFn } from '@squidlab/nova-vue3-helper';
import { useDetailField } from '@squidlab/nova-vue3-helper';
import { Value } from '@/types/value';
import { FieldProps } from '@/types/field-props';
import { Field } from '@/types/field';
import { DehydratedValue } from '@/types/dehydrated-value';
import { config } from '@/config';
import { useHydrate } from '@/composables/useHydrate';

const props = defineProps<FieldProps>();

const emit = defineEmits<FieldEmitFn>();

const hydrate = useHydrate();

const { value, fieldLabel } = useDetailField<
  FieldProps,
  Field,
  DehydratedValue,
  Value
>(props, hydrate, emit);
</script>
