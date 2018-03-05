<template>
    <div>
      <el-select v-model="defaultValue"
        :multiple="multiple"
        @change="selectChanged"
        :collapse-tags="collapseTags"
        :clearable="clearable"
        :placeholder="placeHolder">
          <el-option
            v-for="item in selectOptions"
            :key="item.value"
            :label="item.label"
            :value="item.value">
          </el-option>
      </el-select>
      <input type="hidden" :name="name" :value="hiddenValue">
    </div>
</template>

<script>
/*
  // Normal
    <select-component
      value=""
      name=""
      options=""
      placeholder="">
    </select-component>
  // multiple
    <select-component
      value="{{ request()->has('features') ? request('features') : '[]'}}"
      name="features"
      :multiple="true"
      :clearable="true"
      :options="{{json_encode($features)}}"
      placeholder="Select features">
    </select-component>
*/
export default {
  props: [
    'value',
    'name',
    'options',
    'placeholder',
    'multiple',
    'clearable',
    'collapseTags'
  ],
  data() {
    return {
      placeHolder: this.placeholder ? this.placeholder : 'Select option',
      selectOptions: this.options,
      defaultValue: this.value ? this.value : null,
      hiddenValue: null
    };
  },
  methods: {
    selectChanged(newValue) {
      this.hiddenValue = newValue;
    }
  }
};
</script>
