<template>
  <div class="container">
    <div>
      <span>Departments</span>
      <span>
        <i class="fas fa-angle-right"></i>
      </span>
      <span>Biomedical Engineering</span>
      <!-- <div>Make a Request</div> -->
    </div>
    <div>
      <div>
        <div>About</div>
        <div>
          <div class="img_wrapper">
            <img class="img" src="../../../public/images/about_images/biomedical_engineering.png" />
            <span>New medical equipments are first inspected here, before taken to their various units. It's a place where compliants are laid about a faulty medical equipments or replacement of instruments.</span>
          </div>
        </div>
      </div>
      <div>
        <div>Ongoing Requests</div>
        <div>
          <div class="spinner_layout" v-if="isLoading">
            <SpinnerLayout :spinnerHeight="'50px'" :spinnerWidth="'50px'" />
          </div>
          <div v-else-if="equipmentRepairRequests.length===0" class="no_complaints">No Requests</div>
          <div v-else class="list_of_complaints">
            <div>
              <div>S/N</div>
              <div>Department</div>
              <div>Complaints</div>
              <div>No. Required</div>
              <div></div>
            </div>
            <div>
              <template v-for="(equipmentRepairRequest, index) in equipmentRepairRequests">
                <div>
                  <span>{{index+1}}</span>
                  <span class="departmentName">{{equipmentRepairRequest.department}}</span>
                  <span>{{equipmentRepairRequest.request}}</span>
                  <span>{{equipmentRepairRequest.no_of_requests}}</span>
                  <span>
                    <span @click="fixRequest(equipmentRepairRequest.id, index)">Mark as Fixed</span>
                  </span>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SpinnerLayout from "../components/SpinnerLayout";
import { mapMutations } from "vuex";
export default {
  name: "BiomedicalEngineering",
  components: {
    SpinnerLayout
  },
  data() {
    return {
      equipmentRepairRequests: [],
      isLoading: true
    };
  },
  mounted() {
    this.getRequests();
  },
  methods: {
    getRequests() {
      fetch("getAllOngoingRequests", {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": this.token
        },
        method: "get"
      })
        .then(response => response.json())
        .then(data => {
          this.isLoading = false;
          this.equipmentRepairRequests = data;
        })
        .catch(err => {
          console.error("Warning:", err);
        });
    },
    fixRequest(id, index) {
      fetch("fixRequest", {
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": this.token
        },
        method: "post",
        body: JSON.stringify({
          id
        })
      })
        .then(response => response.json())
        .then(data => {
          if (data.message === "success") {
            this.equipmentRepairRequests.splice(index, 1);
          }
        })
        .catch(err => {
          console.error("Warning:", err);
        });
    }
  },
  computed: {
    token: function() {
      return this.$store.getters.getToken;
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
        padding: 15px 5px;

        .list_of_complaints {
          display: flex;
          flex-direction: column;
          text-align: center;
          > div:nth-child(1) {
            display: grid;
            grid-template-columns: 5% 15% 50% 10% 20%;
            font-weight: bold;
            opacity: 0.7;

            > div {
              padding: 5px;
              border-radius: 3px;
              font-size: 14px;
            }
          }

          > div:nth-child(2) {
            margin-top: 10px;
            > div {
              display: grid;
              grid-template-columns: 5% 15% 50% 10% 20%;
              margin-bottom: 20px;

              > span {
                padding: 5px;
                border-radius: 3px;
                font-size: 14px;
              }

              > span:nth-child(5) {
                > span {
                  background-color: $general-color;
                  color: #fff;
                  padding: 7px 15px;
                  border-radius: 5px;
                  cursor: default;

                  &:hover {
                    opacity: 0.7;
                  }
                }
              }
            }

            > div:last-child {
              margin-bottom: 0;
            }
          }
        }

        .spinner_layout {
          display: flex;
          justify-content: center;
          height: 100px;
        }

        .no_complaints {
          padding: 10px;
          font-size: 15px;
          display: flex;
          justify-content: center;
          color: gray;
          font-weight: bold;
        }
      }
    }
  }
  .departmentName {
    text-transform: capitalize;
  }
}
</style>


