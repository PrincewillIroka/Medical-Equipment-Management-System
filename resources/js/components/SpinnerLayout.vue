<template>
  <div class="spinner_layout">
    <div class="loader" :style="{height: spinnerHeight, width: spinnerWidth}"></div>
  </div>
</template>


<script>
export default {
  props: ["spinnerHeight", "spinnerWidth"]
};
</script>


<style lang="scss" scoped>
.spinner_layout {
  display: flex;
  width: 100%;
  height: 530px;
  background-color: #fefefe;
  border-radius: 3px;
  justify-content: center;
  align-items: center;

  // width: 100%;
  // display: flex;
  // justify-content: center;
  // align-items: center;
  // height: 100vh;

  .loader {
    border: 12px solid #f3f3f3; /* Light grey */
    border-top: 12px solid #3892e9; /* Blue */
    border-radius: 50%;
    animation: spin 2s linear infinite;
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
}
</style>