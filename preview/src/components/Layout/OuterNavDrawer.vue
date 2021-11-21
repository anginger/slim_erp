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
      <v-btn class="white text-center ml-1 my-5" icon>
        <v-icon>mdi-account-outline</v-icon>
      </v-btn>
      <v-divider class="mx-3 my-5"></v-divider>
      <v-btn
          v-for="i in circles"
          :key="i.title"
          class="white text-center ml-1 mb-9"
          @click="action(i)"
          icon
      >
        <v-icon v-text="i.icon"/>
      </v-btn>
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
          @click="action(i)"
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
        path: "/logout"
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
  }),
  methods: {
    action(i) {
      if (i.path) {
        this.$router.push(i.path)
      } else if (i.url) {
        location.assign(i.url)
      } else {
        console.error(i)
      }
    }
  }
}
</script>
