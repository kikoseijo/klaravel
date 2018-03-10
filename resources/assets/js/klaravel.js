/*
// file initialization example.
  import ElementUI from 'element-ui';
  import locale from 'element-ui/lib/locale/lang/es';
  Vue.use(ElementUI, { locale });

  require('klaravel');  <----------This file.
  import '~/../sass/element_variables.scss';

// Webpack configuration to read the library.
  .webpackConfig({
    resolve: {
    symlinks: false,
    modules: [
    path.resolve(__dirname, 'vendor/ksoft/klaravel/resources/assets/js'),
    'node_modules'
    ],
    alias: {
    'vue$': 'vue/dist/vue.js',
    '~': path.join(__dirname, './resources/assets/js'),
    '@': path.join(__dirname, './resources/assets/js/components')
    }
    }
  })

*/

Vue.component(
  'klaravel-element-range',
  require('./components/ElementRange.vue')
);
Vue.component(
  'klaravel-element-upload',
  require('./components/ElementUpload.vue')
);
Vue.component(
  'klaravel-element-select',
  require('./components/ElementSelect.vue')
);
