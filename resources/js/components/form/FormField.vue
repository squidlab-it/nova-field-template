<template>
  <div v-if="currentField.visible" :class="config.rootClass">
    <div
      class="flex flex-col"
      :class="{ 'md:flex-row': !currentField.stacked }"
    >
      <div
        class="px-6 md:px-8 mt-2 md:mt-0"
        :class="{
          'w-full md:w-1/5 md:py-5': !currentField.stacked,
          'md:pt-2 w-full': currentField.stacked,
        }"
      >
        <FormLabel
          :label-for="currentField.uniqueKey"
          class="space-x-1"
          :class="{ 'mb-2': shouldShowHelpText }"
        >
          <span>
            {{ fieldLabel }}
          </span>
          <span v-if="currentField.required" class="text-red-500 text-sm">
            {{ __('*') }}
          </span>
        </FormLabel>
      </div>

      <div
        class="mt-1 md:mt-0 pb-5 px-6 md:px-8"
        :class="{
          'md:w-4/5': currentField.fullWidth,
          'md:w-3/5': !currentField.fullWidth,
          'w-full md:py-5': !currentField.stacked,
          'w-full md:pt-2': currentField.stacked,
        }"
      >
        <div class="w-full flex flex-row items-center justify-center">
          <DefaultButton
            v-if="currentField.allowDecrement"
            @click.prevent="onDecrement"
            >-</DefaultButton
          >
          <div class="flex-1 space-y-1 mx-2">
            <input
              :id="currentField.uniqueKey"
              ref="input"
              type="text"
              class="w-full form-control form-input form-input-bordered"
              :class="{
                ['form-input-border-error']: hasError,
              }"
              :value="value.counter"
              :dusk="currentField.attribute"
              :disabled="currentField.readonly"
              @input="onInputChange"
            />
          </div>
          <DefaultButton
            v-if="currentField.allowIncrement"
            @click.prevent="onIncrement"
            >+</DefaultButton
          >
        </div>

        <div class="flex items-center justify-center my-2">
          <DefaultButton size="xs" @click.prevent="onApiRequest"
            >API Request</DefaultButton
          >
        </div>

        <HelpText v-if="shouldShowErrors" class="mt-2 help-text-error">
          {{ firstError }}
        </HelpText>

        <HelpText
          v-if="shouldShowHelpText"
          class="help-text mt-2"
          v-html="helpText"
        />
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { defineProps, ref } from 'vue';
import type { FieldEmitFn } from '@squidlab/nova-vue3-helper';
import { useFormField, useLocalization } from '@squidlab/nova-vue3-helper';
import { config } from '@/config';
import { FieldProps } from '@/types/field-props';
import { Value } from '@/types/value';
import { DehydratedValue } from '@/types/dehydrated-value';
import { Field } from '@/types/field';
import { useHydrate } from '@/composables/useHydrate';
import { useDehydrate } from '@/composables/useDehydrate';

const { __ } = useLocalization();

const props = defineProps<FieldProps>();

const emit = defineEmits<FieldEmitFn>();

const hydrate = useHydrate();
const dehydrate = useDehydrate();

const {
  value,
  currentField,
  fieldLabel,
  helpText,
  shouldShowHelpText,
  emitValueChange,
  firstError,
  hasError,
  shouldShowErrors,
} = useFormField<FieldProps, Field, DehydratedValue, Value>(
  props,
  hydrate,
  dehydrate,
  emit
);

const input = ref<HTMLInputElement>();

const onDecrement = () => {
  emitValueChange({
    counter: value.value.counter - 1,
  });
};
const onIncrement = () => {
  emitValueChange({
    counter: value.value.counter + 1,
  });
};

const getInputValue = () => {
  let str = input.value?.value ?? '0';
  str = str.replaceAll(/[^0-9]+/g, '');
  const num = parseInt(str, 10);
  if (isNaN(num)) {
    return 0;
  }
  return num;
};

const onApiRequest = async () => {
  const res = await Nova.request().get<{
    message: string;
  }>(`/${config.rootClass}-api/ping`);

  Nova.success(`Received response: "${res.data.message}"`);
};

const onInputChange = () => {
  emitValueChange({
    counter: getInputValue(),
  });
};
</script>
