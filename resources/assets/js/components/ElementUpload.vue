<template>
  <div>
    <el-upload
      class="upload-demo"
      :action="`${uploadUrl}`"
      name="foto"
      :multiple="isMultiple"
      :headers="{ 'Accept': 'application/json'}"
        :on-success="handleSuccess"
        :on-change="handleChange"
        :file-list="fileList"
        :on-remove="handleRemove"
        :on-error="handleError"
      list-type="picture">
      <div class="text-center my-3">
        <h4>Choose photo</h4>
        <el-button type="success" style="width:100%" plain>Select pictures</el-button>
        <div slot="tip" class="el-upload__tip">{{defaultHelp}}</div>
      </div>
    </el-upload>
  </div>
</template>

<script>
/*
  // Example of use in blades.
    <file-upload-component
        :fotos="[]"
        :is-multiple="true"
        base-url="{{route_has($model_name.'.media.upload', $record)}}"
        record-id="{{$record->id}}">
    </file-upload-component>
*/

module.exports = {
  props: ['fotos', 'recordId', 'baseUrl', 'isMultiple', 'help'],
  data() {
    return {
      fileList: [],
      uploadUrl: null,
      defaultHelp: this.help ? this.help : 'Only jpg/png of 2-3 Mb.'
    };
  },
  created() {
    //do something after creating vue instance
    this.uploadUrl = this.baseUrl + '?_token=' + Larapp.csrfToken;
    this.fileList = this.photos;
  },
  methods: {
    handleSuccess(response, file, fileList) {
      if (response.errors) {
        console.log(file.name + ' could not be uploaded.', 'error');
      } else {
        if (response.name) {
          console.log('File ' + response.name + ' uploaded succesfully');
        }
      }
    },
    handleRemove() {},
    handleChange(file, fileList) {
      this.fileList = fileList.slice(-3);
    },
    handleError(err, file, fileList) {
      if (err) {
        console.log(file.name + ' could not be uploaded.', 'error');
      }
    }
  }
};
</script>

<style>
.el-upload {
  width: 100% !important;
}
</style>
