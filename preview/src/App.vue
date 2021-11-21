<template>
  <v-app id="inspire">
    <app-bar/>
    <outer-nav-drawer/>
    <inner-nav-drawer/>
    <v-main>
      <router-view/>
    </v-main>
    <app-footer/>
  </v-app>
</template>

<script>
import AppBar from "./components/Layout/AppBar";
import InnerNavDrawer from "./components/Layout/InnerNavDrawer";
import OuterNavDrawer from "./components/Layout/OuterNavDrawer";
import AppFooter from "./components/Layout/AppFooter";

export default {
  components: {AppFooter, OuterNavDrawer, InnerNavDrawer, AppBar},
}
</script>
