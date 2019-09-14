<template>
  <div class="view_more_info">
    <div class="modal" id="modal-one" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-header">
          <h2>{{dataForViewMoreInfoModal.name}}</h2>
          <a @click="closeModal" class="btn-close" aria-hidden="true">×</a>
        </div>
        <div class="modal-body">
          <div>
            <img
              :src="'/images/'+dataForViewMoreInfoModal.image"
              :alt="dataForViewMoreInfoModal.name"
            />
            <div>
              <div>Description:</div>
              <div>{{dataForViewMoreInfoModal.description}}</div>
            </div>
            <div>
              <div>Use:</div>
              <div>{{dataForViewMoreInfoModal.use}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "ViewMoreInfo",
  data() {
    return {};
  },
  props: ["dataForViewMoreInfoModal"],
  mounted() {
    this.dataForViewMoreInfoModal;
  },
  methods: {
    closeModal() {
      this.$emit("closeModal");
    }
  }
};
</script>
<style lang="scss" scoped>
.view_more_info {
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
    padding: 20px 20px 0;
  }

  .modal-header {
    padding: 20px 20px;
  }

  .modal-header h2 {
    font-size: 20px;
    text-align: center;
    max-width: 95%;
  }

  .modal-body {
    padding-bottom: 20px;
    > div:nth-child(1) {
      display: flex;
      flex-direction: column;
      > img {
        border: 1px solid rgb(255, 255, 255);
        border-radius: 50%;
        height: 200px;
        width: 200px;
        align-self: center;
        margin-bottom: 40px;
      }
      > div {
        display: grid;
        grid-template-columns: 120px auto;
        margin-bottom: 20px;
        > div:nth-child(1) {
          font-weight: bold;
          width: 100px;
          margin-right: 30px;
        }
        > div:nth-child(2) {
          font-size: 15px;
          text-align: start;
          line-height: 1.2em;
        }
      }
    }
  }
}
</style>