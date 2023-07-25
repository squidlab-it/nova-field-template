import { Nova as NovaType } from '@squidlab/nova-vue3-helper';

declare module '*.vue';

declare global {
  const Nova: NovaType;
}
