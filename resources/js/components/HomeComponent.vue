<template>
  <div class="wrapper-div">
    <div class="side-nav">
      <div class="logo-section">
        <i class="fas fa-plus-square"></i>
        <span>Medical Equipment System</span>
      </div>
      <div>
        <div
          @click="changeTab('Inventory')"
          class="nav_item"
          :class="{active_nav_item : activeTab == 'Inventory'}"
        >
          <i class="fas fa-home"></i>
          <span>Inventory</span>
        </div>
        <div @click="toggleDepartments()">
          <i class="fas fa-address-card"></i>
          <span>Departments</span>
          <i v-if="toggleDepartmentsStatus" class="fas fa-angle-down"></i>
          <i v-else class="fas fa-angle-right"></i>
        </div>
        <div
          v-if="toggleDepartmentsStatus && (user.department === 'laboratory' || user.department === 'admin')"
          @click="changeTab('Laboratory')"
          class="nav_item"
          :class="{active_nav_item : activeTab == 'Laboratory'}"
        >
          <i class="fas fa-bong"></i>
          <span>Laboratory</span>
        </div>
        <div
          v-if="toggleDepartmentsStatus && (user.department === 'theatre' || user.department === 'admin')"
          @click="changeTab('Theatre')"
          class="nav_item"
          :class="{active_nav_item : activeTab == 'Theatre'}"
        >
          <i class="fas fa-x-ray"></i>
          <span>Theatre</span>
        </div>
        <div
          v-if="toggleDepartmentsStatus && (user.department === 'icu' || user.department === 'admin')"
          @click="changeTab('ICU')"
          class="nav_item"
          :class="{active_nav_item : activeTab == 'ICU'}"
        >
          <i class="fas fa-procedures"></i>
          <span>ICU</span>
        </div>
        <div
          v-if="toggleDepartmentsStatus && (user.department === 'pathology' || user.department === 'admin')"
          @click="changeTab('Pathology')"
          class="nav_item"
          :class="{active_nav_item : activeTab == 'Pathology'}"
        >
          <i class="fas fa-stethoscope"></i>
          <span>Pathology</span>
        </div>
        <div
          v-if="toggleDepartmentsStatus && (user.department === 'radiology' || user.department === 'admin')"
          @click="changeTab('Radiology')"
          class="nav_item"
          :class="{active_nav_item : activeTab == 'Radiology'}"
        >
          <i class="fas fa-microscope"></i>
          <span>Radiology</span>
        </div>
        <div
          v-if="toggleDepartmentsStatus && (user.department === 'biomedical engineering' || user.department === 'admin')"
          @click="changeTab('BiomedicalEngineering')"
          class="nav_item"
          :class="{active_nav_item : activeTab == 'BiomedicalEngineering'}"
        >
          <i class="fas fa-people-carry"></i>
          <span>Biomedical Engineering</span>
        </div>
      </div>
    </div>
    <div class="main-layout">
      <div>
        <span>
          <span>Welcome, {{user.name}}</span>
          <i class="fas fa-power-off" @click="logOut"></i>
        </span>
      </div>
      <div v-if="!hasLoadedInventory" class="loader-layout">
        <SpinnerLayout :spinnerHeight="'80px'" :spinnerWidth="'80px'" />
      </div>
      <component :inventoryData="inventoryData" :is="activeTab"></component>
    </div>
  </div>
</template>
<script>
import homeMixin from "../mixins/homeMixin";

export default {
  name: "Home",
  mixins: [homeMixin]
};
</script>
<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css?family=Roboto&display=swap");
@import url("https://fonts.googleapis.com/css?family=Farro&display=swap");

.wrapper-div {
  display: flex;
  flex-direction: row;
  background-color: #fafafa;
  overflow: hidden;

  > .side-nav {
    display: flex;
    flex-direction: column;
    width: 18%;
    height: 100vh;
    background-color: #fff;
    box-shadow: 3px 0 3px -3px #f0f0f0;
    user-select: none;

    > .logo-section {
      display: flex;
      align-items: center;
      padding: 5px 0;
      border-bottom: 1px solid #eee;
      padding-left: 15px;
      background-color: #3089f1;
      width: 100%;

      .fa-plus-square {
        font-size: 40px;
        color: #fff;
        margin-right: 20px;
      }

      > span {
        font-weight: bold;
        font-size: 13px;
        font-family: "Roboto", sans-serif;
        color: #fff;
      }
    }

    > div:nth-child(2) {
      display: flex;
      flex-direction: column;
      padding-top: 50px;
      color: rgb(98, 100, 98);

      > .nav_item {
        display: flex;
        flex-direction: row;
        padding: 15px 0 15px 15px;
        border-left: 3px solid transparent;

        > span {
          margin-left: 20px;
          font-family: "Farro", sans-serif;
        }
      }

      > .active_nav_item {
        background-color: rgba(48, 137, 241, 0.1);
        border-left: 3px solid #3089f1;
        color: #3089f1;
      }

      > div:nth-child(2) {
        display: flex;
        flex-direction: row;
        color: rgb(98, 100, 98);
        padding: 15px 0 15px 15px;
        align-items: center;

        > .fas {
          font-size: 15px;
        }

        > span {
          margin: 0 60px 0 20px;
          font-family: "Farro", sans-serif;
        }
      }
    }
  }

  > .main-layout {
    width: 82%;
    display: flex;
    flex-direction: column;
    overflow-y: hidden;

    > div:nth-child(1) {
      height: 50px;
      width: 100%;
      background-color: #3089f1;
      display: flex;
      align-items: center;
      > span:nth-child(1) {
        display: flex;
        align-items: center;
        margin-left: auto;
        > span:nth-child(1) {
          color: #fff;
          font-size: 17px;
          margin-right: 100px;
          font-family: Arial, Helvetica, sans-serif;
        }
        > .fa-power-off {
          color: red;
          font-size: 20px;
          margin-right: 30px;
        }
      }
    }

    > div:nth-child(2) {
      // margin-bottom: 80px;
      padding: 2%;
      position: relative;
      height: 600px;
      overflow-y: auto;
    }
  }
}
</style>