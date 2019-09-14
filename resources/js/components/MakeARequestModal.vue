<template>
  <div class="makeRequestModal">
    <div class="modal" id="modal-one" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-header">
          <h2>Create New Request</h2>
          <a @click="closeModal" class="btn-close" aria-hidden="true">×</a>
        </div>
        <div class="modal-body">
          <textarea placeholder="Type your request or complaint here" id="modal-complaint-field"></textarea>
          <div class="modal-number">
            <span>No. of Equipments needed:</span>
            <input type="number" id="modal-number-field" value="0" />
          </div>
        </div>
        <div class="modal-footer">
          <span class="modal-send-request">Send Request</span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "MakeARequestModal",
  methods: {
    closeModal() {
      this.$emit("closeModal");
    }
  }
};
</script>
<style lang="scss" scoped>
</style>