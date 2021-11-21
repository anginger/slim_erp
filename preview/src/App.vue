<template>
  <v-app id="inspire">
    <loading v-if="!loaded"/>
    <login v-else-if="!ready"/>
    <div v-else>
      <app-bar/>
      <outer-nav-drawer/>
      <inner-nav-drawer/>
      <v-main>
        <router-view/>
      </v-main>
      <app-footer/>
    </div>
  </v-app>
</template>

<script>
import AppBar from "./components/Layout/AppBar";
import InnerNavDrawer from "./components/Layout/InnerNavDrawer";
import OuterNavDrawer from "./components/Layout/OuterNavDrawer";
import AppFooter from "./components/Layout/AppFooter";
import Login from "./components/Login";
import Loading from "./components/Loading";

export default {
  components: {Loading, Login, AppFooter, OuterNavDrawer, InnerNavDrawer, AppBar},
  data: () => ({
    loaded: true,
    ready: false
  })
}
</script>
