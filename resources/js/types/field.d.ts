import { Field as BaseField } from '@squidlab/nova-vue3-helper';
import { DehydratedValue } from '@/types/dehydrated-value';

export interface Field extends BaseField<DehydratedValue> {
  allowIncrement: boolean;
  allowDecrement: boolean;
}
