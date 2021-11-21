<template>
  <v-app id="inspire">
    <loading v-if="!loaded"/>
    <login v-else-if="!ready" @success="loginSuccess"/>
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
    loaded: false,
    ready: false
  }),
  methods: {
    async checkStatus() {
      try {
        const response = await this.$axios.get("/authentic/session")
        this.ready = response.status === 204
      } catch (e) {
        console.warn(e)
      }
      setTimeout(() => {
        this.loaded = true;
      }, 3000)
    },
    loginSuccess() {
      this.loaded = false
      this.checkStatus()
    }
  },
  created() {
    this.checkStatus()
  }
}
</script>
