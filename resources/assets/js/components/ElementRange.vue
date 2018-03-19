<template>
    <div>
      <el-slider
      v-model="defaultValue"
      @change="selectChanged"
      :range="range"
      :max="max"
      :min="min">
    </el-slider>
      <input type="hidden" :name="name" :id="name" :value="hiddenValue">
    </div>
</template>

<script>
/*
<klaravel-element-range min="" range="true" max="" name="" value=""></klaravel-element-range>
*/
export default {
  props: ['value', 'name', 'min', 'max', 'range'],
  data() {
    return {
      defaultValue: [],
      hiddenValue: null
    };
  },
  mounted() {
    this.defaultValue = this.value;
    this.hiddenValue = this.value;
  },
  methods: {
    selectChanged(newValue) {
      this.hiddenValue = newValue;
    }
  }
};
</script>
