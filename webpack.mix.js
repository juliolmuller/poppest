/* eslint-disable */
const mix = require('laravel-mix')
require('laravel-mix-react-typescript-extension')

mix
  .reactTypeScript('resources/scripts/index.tsx', 'public/js')
  .sass('resources/styles/index.scss', 'public/css')
