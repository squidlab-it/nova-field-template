import { Value } from '@/types/value';
import { DehydratedValue } from '@/types/dehydrated-value';

export function useDehydrate() {
  return (value: Value): DehydratedValue => {
    return JSON.stringify(value || {});
  };
}
