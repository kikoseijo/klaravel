<template>
  <div class="form-group require">
          <label :for="name">{{label}}</label>
          <el-date-picker
            v-model="defaultValue"
            type="datetime"
            :name="name"
            value-format="yyyy-MM-dd HH:mm:ss"
            :placeholder="placeHolder">
          </el-date-picker>
      </div>

</template>

<script>
export default {
  props: ['value', 'name', 'label', 'noDate', 'placeHolder'],
  data() {
    return {
      defaultValue: this.value
        ? this.value
        : this.noDate ? null : window.moment().format('YYYY-MM-DD HH:mm:ss')
    };
  },
  mounted() {
    // console.log('Component mounted.');
  }
};
</script>
