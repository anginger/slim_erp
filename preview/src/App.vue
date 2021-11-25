<template>
  <v-app id="inspire">
    <loading v-if="!$store.state.loaded"/>
    <login v-else-if="!$store.state.ready" @success="loginSuccess"/>
    <div v-else>
      <app-bar/>
      <v-navigation-drawer app>
        <nav-drawer/>
        <drawer/>
      </v-navigation-drawer>
      <v-main>
        <router-view/>
      </v-main>
      <app-footer/>
    </div>
  </v-app>
</template>

<script>
import AppBar from "./components/Layout/AppBar";
import NavDrawer from "./components/Layout/NavDrawer";
import AppFooter from "./components/Layout/AppFooter";
import Login from "./components/Login";
import Loading from "./components/Loading";
import Drawer from "./components/Layout/Drawer";

export default {
  components: {Drawer, Loading, Login, AppFooter, NavDrawer, AppBar},
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
