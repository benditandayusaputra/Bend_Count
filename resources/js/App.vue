<template>
  <div class="wrapper">
    <Navbar v-if="isAuth" />
    <Sidebar v-if="isAuth" />
    <div class="content-wrapper">
      <div class="content">
        <div class="container-fluid py-3">
          <router-view></router-view>
        </div>
      </div>
    </div>
    <Footer v-if="isAuth" />
  </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import Navbar from "./components/Navbar.vue";
import Sidebar from "./components/Sidebar.vue";
import Footer from "./components/Footer.vue";

export default {
  computed: {
    ...mapState(["token"]),
    ...mapGetters(["isAuth"]),
  },
  components: {
    Navbar,
    Sidebar,
    Footer,
  },
  mounted() {
    window.$("body").Layout();
    window.$('[data-widget="pushmenu"]').PushMenu();
    window.$('[data-widget="control-sidebar"]').ControlSidebar();
    window.$('ul[data-widget="treeview"]').Treeview("init");
    window.$(".dropdown").Dropdown();
    window.$('ul[data-widget="treeview"]').overlayScrollbars();
  },
};
</script>