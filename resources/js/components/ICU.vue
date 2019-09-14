<template>
  <div class="container">
    <div>
      <span>Departments</span>
      <span>
        <i class="fas fa-angle-right"></i>
      </span>
      <span>Intensive Care Unit (ICU)</span>
      <a @click="toggleMakeARequestModalVisibility">Make a Request</a>
    </div>
    <div>
      <div>
        <div>About</div>
        <div>
          <div class="img_wrapper">
            <img class="img" src="../../../public/images/about_images/Intensive_care_unit.jpeg" />
            <span>Intensive care units cater to patients with severe or life-threatening illnesses and injuries, which require constant care, close supervision from life support equipment and medication in order to ensure normal bodily functions.</span>
          </div>
        </div>
      </div>
      <div>
        <div>Equipments found here:</div>
        <div>
          <div>
            <span>Defibrillator</span>
            <span>ECG Machine</span>
            <span>Laryngoscope</span>
            <span>Multiparameter monitor</span>
            <span>Pulse Oximeter</span>
            <span>Transport Ventilator(pneumatic)</span>
            <span>Ventilator</span>
            <span>Distilled water</span>
            <span>Gloves</span>
            <span>Facemask</span>
          </div>
        </div>
      </div>
      <div>
        <div>Pending Complaints:</div>
        <div>
          <div class="ongoing_requests_layout">
            <div>
              <div>Complaint</div>
              <div>Quantity</div>
            </div>
            <div>
              <div>
                <div>Urgent need for replacement of damaged hand gloves.</div>
                <div>30</div>
                <div>Urgent need for replacement of damaged hand gloves.</div>
                <div>17</div>
                <div>Urgent need for replacement of damaged hand gloves.</div>
                <div>4</div>
              </div>
            </div>
          </div>
          <div class="no_request_layout">No Ongoing Request</div>
        </div>
      </div>
    </div>
    <MakeARequestModal
      v-if="toggleMakeARequestModal"
      v-on:closeModal="toggleMakeARequestModalVisibility"
    />
  </div>
</template>

<script>
import MakeARequestModal from "./MakeARequestModal";
export default {
  name: "ICU",
  components: {
    MakeARequestModal
  },
  data() {
    return {
      toggleMakeARequestModal: false
    };
  },
  methods: {
    toggleMakeARequestModalVisibility() {
      this.toggleMakeARequestModal = !this.toggleMakeARequestModal;
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

      > div:nth-child(2) {
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

        .no_request_layout {
          display: none;
        }
      }
    }
  }
}
</style>


