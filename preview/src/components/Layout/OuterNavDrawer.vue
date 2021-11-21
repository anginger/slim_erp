<template>
  <v-navigation-drawer
      v-model="drawer"
      app
      width="300"
  >
    <v-navigation-drawer
        v-model="drawer"
        absolute
        color="black lighten-3"
        mini-variant
    >
      <v-avatar
          class="d-block text-center mx-auto mt-4"
          color="white darken-1"
          size="36"
      >
        <v-icon>mdi-account-outline</v-icon>
      </v-avatar>
      <v-divider class="mx-3 my-5"></v-divider>
      <v-avatar
          v-for="i in circles"
          :key="i.title"
          class="d-block text-center mx-auto mb-9"
          color="grey lighten-1"
          size="28"
      >
        <v-icon v-text="i.icon"/>
      </v-avatar>
    </v-navigation-drawer>
    <v-sheet
        color="grey lighten-5"
        height="128"
        width="100%"
    ></v-sheet>
    <v-list
        class="pl-14"
        shaped
    >
      <v-list-item
          v-for="i in rectangles"
          :key="i.title"
          link
      >
        <v-list-item-content>
          <v-list-item-title>{{ i.title }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: "OuterNavDrawer",
  data: () => ({
    drawer: null,
    circles: [
      {
        title: "設定",
        icon: "mdi-tune-vertical",
        url: ""
      },
      {
        title: "關於",
        icon: "mdi-information-outline",
        url: ""
      },
      {
        title: "登出",
        icon: "mdi-exit-to-app",
        url: ""
      },
    ],
    rectangles: [
      {
        title: "主控台",
        url: ""
      },
      {
        title: "員工資料",
        url: ""
      },
      {
        title: "產品資料",
        url: ""
      },
      {
        title: "角色",
        url: ""
      },
      {
        title: "供應商",
        url: ""
      },
    ]
  })
}
</script>

<style scoped>

</style>
