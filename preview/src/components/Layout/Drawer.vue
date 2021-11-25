<template>
  <v-navigation-drawer v-model="drawer">
    <v-list class="pl-14" shaped>
      <v-list-item-group v-model="current">
        <v-list-item v-for="i in rectangles" :key="i.title" @click="action(i)">
          <v-list-item-content>
            <v-list-item-title>{{ i.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: "Drawer",
  data: () => ({
    drawer: null,
    current: 0,
    rectangles: [
      {
        title: "主控台",
        path: "/manage/overview"
      },
      {
        title: "員工資料",
        path: "/manage/users"
      },
      {
        title: "產品資料",
        path: "/manage/products"
      },
      {
        title: "角色",
        path: "/manage/levels"
      },
      {
        title: "供應商",
        path: "/manage/providers"
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
  },
  created() {
    this.current.rectangle = this.rectangles.findIndex((i) => this.$route.path === i.path)
  }
}
</script>
