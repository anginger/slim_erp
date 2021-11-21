<template>
  <v-app id="inspire">
    <div v-if="!loaded">
      <v-container>
        <v-card flat>
          <v-card-title>
            <v-avatar color="grey lighten-5">
              <v-img
                  max-width="15"
                  max-height="35"
                  :src="require('./assets/logo.png')"
              />
            </v-avatar>
            <v-card-title>
              Slim ERP Framework
            </v-card-title>
            <v-progress-circular
                indeterminate
                color="red"
            />
          </v-card-title>
        </v-card>
        <v-card outlined rounded>
          <v-card-title>
            Slim 是一個自由的開源 ERP 框架，提供開發人員盡可能簡單地建立出屬於他們的系統。
          </v-card-title>
          <v-card-subtitle>
            Slim is a free and opensource ERP Framework for developers to create their system as simple as possible.
          </v-card-subtitle>
          <v-card-subtitle>
            &copy; Slim 版權為 SuperSonic 所有，以 MIT 條款開放原始碼授權。
          </v-card-subtitle>
        </v-card>
      </v-container>
    </div>
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

export default {
  components: {AppFooter, OuterNavDrawer, InnerNavDrawer, AppBar},
  data: () => ({
    loaded: false
  })
}
</script>
