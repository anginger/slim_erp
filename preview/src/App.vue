<template>
  <v-app id="inspire">
    <loading v-if="!$store.state.loaded"/>
    <login v-else-if="!$store.state.ready" @success="loginSuccess"/>
    <div v-else>
      <app-bar/>
      <outer-nav-drawer/>
      <inner-nav-drawer v-if="$store.state.modifiable"/>
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
  methods: {
    async checkStatus() {
      try {
        const response = await this.$axios.get("/authentic/session")
        this.$store.commit("setReady", response.status === 200)
        this.$store.commit("setUser", response.data)
      } catch (e) {
        console.warn(e)
      }
      setTimeout(() => {
        this.$store.commit("setLoaded", true)
      }, 3000)
    },
    loginSuccess() {
      this.$store.commit("setLoaded", false)
      this.checkStatus()
    }
  },
  created() {
    this.checkStatus()
  }
}
</script>
