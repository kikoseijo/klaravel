# Vue components

To be able to use this components you must do a little configuration on your webpack.

#### Webpack configuration

```
.webpackConfig({
  resolve: {
  symlinks: false,
  modules: [
  path.resolve(
    __dirname, 'vendor/ksoft/klaravel/resources/assets/js'),
    'node_modules'
  ],
  alias: {
    'vue$': 'vue/dist/vue.js',
    '~': path.join(__dirname, './resources/assets/js'),
    '@': path.join(__dirname, './resources/assets/js/components')
  }
  }
})
```

After configure, webpack should be able to resolve the component, `require('klaravel');` should
give you no errors if everything its fine.


```
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/es';
Vue.use(ElementUI, { locale });

require('klaravel');  \\ <----------This is the line you need add.
import '~/../sass/element_variables.scss';
```




#### Media upload

```
<klaravel-element-upload
  :fotos="[]"
  :is-multiple="true"
  base-url="{{route($model_name.'.media.upload', $record->id)}}"
  record-id="{{$record->id}}">
</klaravel-element-upload>
// this.uploadUrl = this.baseUrl + '?_token=' + Larapp.csrfToken;
```

#### Select component

```
<klaravel-element-select
  value="{{ request()->has('features') ? request('features') : '[]'}}"
  name="features"
  :multiple="true"
  :clearable="true"
  :options="{{json_encode($features)}}" // format: [label:'Label',value:'item_value']
  placeholder="Select features">
</klaravel-element-select>
```

Example use:

```
<div class="form-group required">
  <label for="name" class="form-control-label">Fuel<sup>*</sup></label>
  <klaravel-element-select
    value="{{request('fuel')}}"
    name="fuel"
    :clearable="true"
    :options="{{json_encode($search['fuel_options'])}}"
    placeholder="Select option">
  </klaravel-element-select>
</div>
```

`props: [
  'value',
  'name',
  'options',
  'placeholder',
  'searchable',
  'multiple',
  'clearable',
  'collapseTags'
],`


#### Slider - Range slider

```
<klaravel-element-range
  name=""
  min=""
  max=""
  range="true"
  value="">
</klaravel-element-range>
```
