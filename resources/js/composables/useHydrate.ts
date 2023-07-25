import { Value } from '@/types/value';
import { Field } from '@/types/field';

export function useHydrate() {
  return (field: Field): Value => {
    return (
      (JSON.parse(field.value) as Value | null) ?? {
        counter: 0,
      }
    );
  };
}
