<template>
  <div class="container">
    <div>
      <span>Departments</span>
      <span>
        <i class="fas fa-angle-right"></i>
      </span>
      <span>Pathology</span>
      <a @click="toggleMakeARequestModalVisibility">Make a Request</a>
    </div>
    <div>
      <div>
        <div>About</div>
        <div>
          <div class="img_wrapper">
            <img class="img" src="../../../public/images/about_images/Pathology.jpeg" />
            <span>Pathology involves the study and diagnosis of disease through the examination of surgically removed organs, tissues (biopsy samples), bodily fluids, and in some cases the whole body (autopsy).</span>
          </div>
        </div>
      </div>
      <div>
        <div>Equipments found here:</div>
        <div>
          <div>
            <span>Autopsy table</span>
            <span>Tissue processor</span>
            <span>Microscope</span>
            <span>Hot plate</span>
            <span>Automatic timer</span>
            <span>Balance for weighing organs</span>
          </div>
        </div>
      </div>
      <div>
        <div>Pending Complaints:</div>
        <div v-if="isLoading">
          <SpinnerLayout class="spinner_layout" :spinnerHeight="'50px'" :spinnerWidth="'50px'" />
        </div>
        <div v-else-if="equipmentRepairRequests.length===0" class="no_request_layout">
          <h4>No Ongoing Request</h4>
        </div>
        <div v-else class="ongoing_requests_container">
          <div class="ongoing_requests_layout">
            <div>
              <div>Complaint</div>
              <div>Quantity</div>
            </div>
            <div>
              <div>
                <template v-for="equipmentRepairRequest in equipmentRepairRequests">
                  <div>{{equipmentRepairRequest.request}}</div>
                  <div>{{equipmentRepairRequest.no_of_requests}}</div>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <MakeARequestModal
      v-if="toggleMakeARequestModal"
      v-on:closeModal="refreshLayout(), toggleMakeARequestModalVisibility()"
    />
  </div>
</template>

<script>
import MakeARequestModal from "./MakeARequestModal";
import SpinnerLayout from "../components/SpinnerLayout";
import { mapMutations } from "vuex";

export default {
  name: "Pathology",
  components: {
    MakeARequestModal,
    SpinnerLayout
  },
  data() {
    return {
      toggleMakeARequestModal: false,
      equipmentRepairRequests: [],
      isLoading: true
    };
  },
  created() {
    this.getRequests();
  },
  computed: {
    user: function() {
      return this.$store.getters.getUser;
    },
    token: function() {
      return this.$store.getters.getToken;
    },
    requestAdded() {
      return this.$store.getters.getRequestAdded;
    }
  },
  methods: {
    ...mapMutations(["setRequestAdded"]),
    toggleMakeARequestModalVisibility() {
      this.toggleMakeARequestModal = !this.toggleMakeARequestModal;
    },
    refreshLayout() {
      if (this.requestAdded) {
        this.isLoading = true;
        this.getRequests();
        this.setRequestAdded(false);
      }
    },
    getRequests() {
      const department = this.user.department;
      fetch("getRequests", {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": this.token
        },
        method: "post",
        body: JSON.stringify({
          department
        })
      })
        .then(response => response.json())
        .then(data => {
          this.isLoading = false;
          this.equipmentRepairRequests = data;
        })
        .catch(err => {
          console.error("Warning:", err);
        });
    }
  }
};
</script>

<style lang="scss" scoped>
$general-color: #3089f1;

.special-background {
  background-color: #fff;
  border-radius: 3px;
  font-family: Arial, Helvetica, sans-serif;
  box-shadow: 0 0 3px 0 rgb(240, 240, 240);
}

.popular-font {
  font-family: "Roboto", sans-serif;
}

.header-background {
  font-weight: bold;
  border-bottom: 1px solid #eee;
  padding: 10px 0 5px 10px;
  font-size: 15px;
  opacity: 0.6;
}

.container {
  overflow: hidden;
  > div:nth-child(1) {
    display: flex;
    align-items: center;
    margin-bottom: 40px;
    font-family: Arial, Helvetica, sans-serif;

    > span {
      font-size: 17px;
      font-weight: bold;
      color: rgba(51, 51, 51, 0.9);
    }

    > span:nth-child(1),
    > span:nth-child(2) {
      margin-right: 15px;
    }

    > div {
      margin-left: auto;
      color: #fff;
      border-radius: 20px;
      padding: 7px 15px;
      background-color: $general-color;
      font-size: 14px;
      box-shadow: 0 0 3px 0 rgb(240, 240, 240);
    }
  }

  > div:nth-child(2) {
    height: 485px;
    overflow-y: hidden;

    &:hover {
      overflow-y: auto;
    }

    > div:nth-child(1) {
      @extend .special-background;

      > div:nth-child(1) {
        @extend .header-background;
      }

      > div:nth-child(2) {
        padding: 10px;
        line-height: 20pt;
        word-spacing: 2px;
      }

      .img_wrapper {
        display: flex;

        > img {
          max-width: 288px;
          max-height: 177px;
        }

        > span {
          align-self: flex-end;
          margin-left: 10px;
        }
      }
    }

    > div:nth-child(2) {
      @extend .special-background;
      margin-top: 30px;

      > div:nth-child(1) {
        @extend .header-background;
      }

      > div:nth-child(2) {
        padding: 15px 10px;

        > div {
          display: grid;
          grid-template-columns: repeat(auto-fill, minmax(20%, 1fr));
          // grid-auto-flow: column;
          // grid-auto-columns: min-content max-content auto;
          grid-column-gap: 10px;
          grid-row-gap: 15px;

          > span {
            padding: 5px;
            border-radius: 3px;
            font-size: 14px;
          }
        }
      }
    }

    > div:nth-child(3) {
      @extend .special-background;
      margin-top: 30px;
      margin-bottom: 20px;

      > div:nth-child(1) {
        @extend .header-background;
      }

      > .ongoing_requests_container {
        .ongoing_requests_layout {
          padding: 15px 10px 0;
          font-size: 14px;

          > div:nth-child(1) {
            display: grid;
            grid-template-columns: 70% 30%;
            font-weight: bold;
            opacity: 0.9;

            > div {
              padding: 10px;
            }

            > div:nth-child(odd) {
              border-right: 1px solid transparent;
            }

            > div:nth-child(even) {
              text-align: center;
            }
          }

          > div:nth-child(2) {
            padding-bottom: 15px;

            > div:nth-child(1) {
              display: grid;
              grid-template-columns: 70% 30%;

              > div {
                padding: 10px;
                border-top: none;
              }

              > div:nth-child(odd) {
                border-right: 1px solid transparent;
              }

              > div:nth-child(even) {
                text-align: center;
              }
            }
          }
        }
      }

      .spinner_layout {
        height: 120px;
      }

      .no_request_layout {
        padding: 30px;
        font-size: 15px;
        text-align: center;
        color: gray;
      }
    }
  }
}
</style>


