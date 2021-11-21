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
      <profile/>
      <v-divider class="mx-3 my-5"></v-divider>
      <v-btn
          v-for="i in circles"
          :key="i.title"
          class="white text-center ml-1 mb-9"
          @click="action(i)"
          :title="i.title"
          icon
      >
        <v-icon v-text="i.icon"/>
      </v-btn>
    </v-navigation-drawer>
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
import Profile from "@/components/Layout/Profile";
export default {
  name: "NavDrawer",
  components: {Profile},
  data: () => ({
    drawer: null,
    circles: [
      {
        title: "系統設定",
        icon: "mdi-tune-vertical",
        url: ""
      },
      {
        title: "關於系統",
        icon: "mdi-information-outline",
        url: ""
      },
    ],
    rectangles: [
      {
        title: "主控台",
        path: "/"
      },
      {
        title: "員工資料",
        path: "/users"
      },
      {
        title: "產品資料",
        path: "/products"
      },
      {
        title: "角色",
        path: "/levels"
      },
      {
        title: "供應商",
        path: "/providers"
      },
    ]
  }),
  methods: {
    action(i) {
      if (i.path) {
        if (this.$route.path !== i.path) {
          this.$router.push(i.path)
        }
      } else if (i.url) {
        location.assign(i.url)
      } else {
        console.error(i)
      }
    }
  }
}
</script>
