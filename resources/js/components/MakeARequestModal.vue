<template>
  <div class="makeRequestModal">
    <div class="modal" id="modal-one" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-header">
          <h2>Create New Request</h2>
          <a @click="closeModal" class="btn-close" aria-hidden="true">×</a>
        </div>
        <div class="modal-body">
          <textarea
            ref="request_or_complaint"
            placeholder="Type your request or complaint here"
            id="modal-complaint-field"
          ></textarea>
          <div class="modal-number">
            <span>No. of Equipments needed:</span>
            <input ref="no_of_equipments" type="number" id="modal-number-field" value="0" />
          </div>
        </div>
        <div class="modal-footer">
          <span @click="sendRequest" class="modal-send-request">Send Request</span>
        </div>
      </div>
    </div>
  </div>
</template><script>
export default {
  name: "MakeARequestModal",
  methods: {
    closeModal() {
      this.$emit("closeModal");
    },
    sendRequest() {
      const request_or_complaint = this.$refs.request_or_complaint.value;
      const no_of_equipments = this.$refs.no_of_equipments.value;
    }
  },
  mounted() {
    console.log(this.activeTab);
  },
  computed: {
    activeTab: function() {
      return this.$store.getters.getActiveTab;
    }
  }
};
</script>
<style lang="scss"scoped>
.makeRequestModal {
  .btn-close {
    color: #aaa;
    font-size: 30px;
    text-decoration: none;
    position: absolute;
    right: 15px;
    top: 10px;
    cursor: default;
  }

  .btn-close:hover {
    color: #919191;
  }

  .modal {
    font-family: Arial, Helvetica, sans-serif;
  }

  .modal:before {
    content: "";
    display: block;
    background: rgba(0, 0, 0, 0.6);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 10;
  }

  .modal-dialog {
    background: #fefefe;
    border-radius: 5px;
    margin-left: -200px;
    position: fixed;
    left: 50%;
    z-index: 11;
    width: 560px;
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0);
    top: 20%;
    -webkit-transition: -webkit-transform 0.3s ease-out;
    -moz-transition: -moz-transform 0.3s ease-out;
    -o-transition: -o-transform 0.3s ease-out;
    transition: transform 0.3s ease-out;
  }

  .modal-body {
    padding: 20px;
  }

  .modal-header,
  .modal-footer {
    padding: 20px 20px;
  }

  .modal-header h2 {
    font-size: 20px;
    text-align: center;
  }

  .modal-footer {
    margin: 60px 0 10px;
    text-align: center;
  }

  textarea {
    resize: none;
    height: 120px;
    width: 100%;
    margin-bottom: 25px;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    word-spacing: normal;
    font-family: Arial, Helvetica, sans-serif;
  }

  .modal-number {
    display: flex;
    flex-direction: row;
    font-size: 15px;
    align-items: center;
  }

  #modal-number-field {
    height: 30px;
    width: 57%;
    border: 1px solid #ccc;
    outline: none;
    margin-left: 40px;
    padding: 3px 5px;
  }

  .modal-send-request {
    border: 1px solid transparent;
    padding: 10px 70px;
    background-color: #3089f1;
    color: #fff;
    border-radius: 5px;
    cursor: default;
  }

  .modal-send-request:hover {
    // color: #3089f1;
    // border: 1px solid #3089f1;
    // background-color: #fff;
    background-color: rgba(30, 131, 247, 0.7);
  }
}
</style>