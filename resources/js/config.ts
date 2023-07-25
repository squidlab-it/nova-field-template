import packageJson from '@root/package.json';

export const config = {
  rootClass: packageJson.name,
  componentName:
    packageJson.name
      .toLowerCase()
      .match(/(\/|^)([^/]+)$/)?.[2]
      ?.replace(/(^\w|(-+)\w)/g, (text) =>
        text.replace(/-+/, '').toUpperCase()
      ) ?? 'NotDefined',
};
