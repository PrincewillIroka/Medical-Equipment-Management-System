<template>
  <div @scroll="inventoryIsScrolled($event)" class="inventory">
    <template v-for="(iData, index) in inventoryData">
      <div>
        <div>
          <img :src="'/images/'+iData.image" :alt="iData.name" />
        </div>
        <div>{{iData.name}}</div>
        <div>{{iData.description}}</div>
      </div>
    </template>
  </div>
</template>

<script>
export default {
  props: ["inventoryData"],
  methods: {
    inventoryIsScrolled(event) {
      console.log(event.target);
    }
  }
};
</script>

<style lang="scss" scoped>
.inventory {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  grid-auto-rows: minmax(260px, auto);
  grid-column-gap: 20px;
  grid-row-gap: 40px;

  > div {
    box-shadow: 0 0 3px 0 rgb(240, 240, 240);
    background-color: #fff;
    // border-radius: 3px;
    display: flex;
    flex-direction: column;
    padding: 20px 10px 0;
    align-items: center;
    text-align: center;

    > div:nth-child(1) {
      > img {
        border: 1px solid rgb(255, 255, 255);
        border-radius: 50%;
        height: 100px;
        width: 100px;
      }
    }

    > div:nth-child(2) {
      font-weight: bold;
      font-size: 15px;
      margin: 20px 0;
      font-family: "Lato", sans-serif;
      color: #3089f1;
    }

    > div:nth-child(3) {
      font-size: 13px;
      font-family: Arial, Helvetica, sans-serif;
      opacity: 0.8;
    }
  }
}
</style>


