<template>
  <div class="makeRequestModal">
    <div class="modal" id="modal-one" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-header">
          <h2>Create New Request</h2>
          <a @click="closeModal" class="btn-close" aria-hidden="true">×</a>
        </div>
        <div class="modal-body">
          <div class="successField" v-if="successModalIsVisible">Your request has been sent.</div>
          <div class="errorField" v-if="errorModalIsVisible">Please fill the fields below</div>
          <textarea
            @input="hideMessageFields"
            ref="request_or_complaint"
            placeholder="Type your request or complaint here"
            id="modal-complaint-field"
          ></textarea>
          <div class="modal-number">
            <span>No. of Equipments needed:</span>
            <input
              @input="hideMessageFields"
              ref="no_of_equipments"
              type="number"
              id="modal-number-field"
              value="0"
            />
          </div>
        </div>
        <SpinnerLayout
          :class="{ active: !isSending }"
          class="spinner_layout"
          :spinnerHeight="'45px'"
          :spinnerWidth="'45px'"
        />
        <div class="modal-footer">
          <span
            :class="{ disabledBtn: isDisabled }"
            @click="sendRequest"
            class="modal-send-request"
          >Send Request</span>
        </div>
      </div>
    </div>
  </div>
</template><script>
import { mapMutations } from "vuex";
import SpinnerLayout from "../components/SpinnerLayout";
export default {
  name: "MakeARequestModal",
  components: {
    SpinnerLayout
  },
  data() {
    return {
      errorModalIsVisible: false,
      successModalIsVisible: false,
      isSending: false,
      isDisabled: false
    };
  },
  methods: {
    ...mapMutations(["setRequestAdded"]),
    closeModal() {
      this.$emit("closeModal");
    },
    sendRequest() {
      const User = JSON.parse(localStorage.getItem("User"));
      const user_id = User.id;
      const department = User.department;
      const request = this.$refs.request_or_complaint.value;
      const no_of_requests = this.$refs.no_of_equipments.value;
      const fixed = false;

      if (!request || !no_of_requests) {
        this.errorModalIsVisible = true;
      } else {
        this.isDisabled = true;
        this.isSending = true;
        fetch("sendRequest", {
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": this.token
          },
          method: "post",
          body: JSON.stringify({
            query_id: "mKrTyR2e456",
            user_id,
            department,
            request,
            no_of_requests,
            fixed
          })
        })
          .then(response => response.json())
          .then(data => {
            if (data.message === "Request Sent") {
              this.successModalIsVisible = true;
              this.$refs.request_or_complaint.value = "";
              this.$refs.no_of_equipments.value = "";
              this.setRequestAdded(true);
            }
            this.isSending = false;
            this.isDisabled = false;
          })
          .catch(err => {
            console.error("Warning:", err);
          });
      }
    },
    hideMessageFields() {
      this.errorModalIsVisible = false;
      this.successModalIsVisible = false;
    }
  },
  mounted() {
    // console.log(this.activeTab);
  },
  computed: {
    activeTab: function() {
      return this.$store.getters.getActiveTab;
    },
    token: function() {
      return this.$store.getters.getToken;
    },
    requestAdded() {
      return this.$store.getters.getRequestAdded;
    }
  }
};
</script>
<style lang="scss"scoped>
.makeRequestModal {
  user-select: none;
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
    top: 15%;
    -webkit-transition: -webkit-transform 0.3s ease-out;
    -moz-transition: -moz-transform 0.3s ease-out;
    -o-transition: -o-transform 0.3s ease-out;
    transition: transform 0.3s ease-out;
  }

  .modal-body {
    padding: 20px;

    .successField {
      text-align: center;
      margin-bottom: 10px;
      font-size: 11px;
      color: green;
    }

    .errorField {
      text-align: center;
      margin-bottom: 10px;
      font-size: 11px;
      color: red;
    }
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
    margin: 30px 0 10px;
    text-align: center;
  }

  .spinner_layout {
    max-height: 30px;
    margin-top: 40px;
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

  .active {
    visibility: hidden;
  }

  .disabledBtn {
    pointer-events: none;
  }
}
</style>