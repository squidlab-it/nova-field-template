import IndexField from '@/components/index/IndexField.vue';
import FormField from '@/components/form/FormField.vue';
import DetailField from '@/components/detail/DetailField.vue';
import '@css/field.css';
import { config } from '@/config';

const { componentName } = config;

Nova.booting((app) => {
  app.component(`Index${componentName}`, IndexField);
  app.component(`Detail${componentName}`, DetailField);
  app.component(`Form${componentName}`, FormField);
});
