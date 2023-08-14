<template>
  <div :class="config.rootClass">
    <span
      class="relative bg-primary-500 text-white dark:text-gray-900 rounded text-sm font-bold inline-flex items-center justify-center px-2 py-1 bg-primary-500"
    >
      {{ value.counter }}
    </span>
  </div>
</template>

<script lang="ts" setup>
import { useIndexField } from '@squidlab/nova-vue3-helper';
import { FieldProps } from '@/types/field-props';
import { Value } from '@/types/value';
import { Field } from '@/types/field';
import { DehydratedValue } from '@/types/dehydrated-value';
import { config } from '@/config';
import { useHydrate } from '@/composables/useHydrate';

const props = defineProps<FieldProps>();

const hydrate = useHydrate();

const { value } = useIndexField<FieldProps, Field, DehydratedValue, Value>(
  props,
  hydrate
);
</script>
