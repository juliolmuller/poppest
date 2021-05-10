/* eslint-env node */
const mix = require('laravel-mix') // eslint-disable-line @typescript-eslint/no-var-requires

mix
  .ts('resources/scripts/index.tsx', 'public/js').react()
  .sass('resources/styles/index.scss', 'public/css')
