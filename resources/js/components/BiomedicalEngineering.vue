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
        <div>New medical equipments are first inspected here, before taken to their various units. It's a place where compliants are laid about a faulty medical equipments or replacement of instruments.</div>
      </div>
      <div>
        <div>Ongoing Requests</div>
        <div>
          <div class="list_of_complaints">
            <div>
              <div>S/N</div>
              <div>Department</div>
              <div>Complaints</div>
              <div>No. Required</div>
              <div></div>
            </div>
            <div>
              <div>
                <span>1</span>
                <span>ICU</span>
                <span>Faulty Centrifuge</span>
                <span>1</span>
                <span>
                  <span>Fixed</span>
                </span>
              </div>
              <div>
                <span>2</span>
                <span>Theatre</span>
                <span>Lack of Hand Gloves</span>
                <span>7</span>
                <span>
                  <span>Fixed</span>
                </span>
              </div>
            </div>
          </div>
          <div class="no_complaints">No Requests</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
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
          text-align: center;
          > div:nth-child(1) {
            display: grid;
            grid-template-columns: 5% 20% 50% 10% 15%;
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
              grid-template-columns: 5% 20% 50% 10% 15%;
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

        .no_complaints {
          display: none;
        }
      }
    }

    // > div:nth-child(3) {
    //   @extend .special-background;
    //   margin-top: 30px;
    //   margin-bottom: 20px;

    //   > div:nth-child(1) {
    //     @extend .header-background;
    //   }

    //   > div:nth-child(2) {
    //     .ongoing_requests_layout {
    //       padding: 15px 10px 0;
    //       font-size: 14px;

    //       > div:nth-child(1) {
    //         display: grid;
    //         grid-template-columns: 70% 30%;
    //         font-weight: bold;
    //         opacity: 0.9;

    //         > div {
    //           padding: 10px;
    //           border: 1px solid rgb(230, 230, 230);
    //         }

    //         > div:nth-child(odd) {
    //           border-right: 1px solid transparent;
    //         }

    //         > div:nth-child(even) {
    //           text-align: center;
    //         }
    //       }

    //       > div:nth-child(2) {
    //         padding-bottom: 15px;

    //         > div:nth-child(1) {
    //           display: grid;
    //           grid-template-columns: 70% 30%;

    //           > div {
    //             padding: 10px;
    //             border: 1px solid rgb(230, 230, 230);
    //             border-top: none;
    //           }

    //           > div:nth-child(odd) {
    //             border-right: 1px solid transparent;
    //           }

    //           > div:nth-child(even) {
    //             text-align: center;
    //           }
    //         }
    //       }
    //     }

    //     .no_request_layout {
    //       display: none;
    //     }
    //   }
    // }
  }
}
</style>


