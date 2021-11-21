<template>
  <v-card>
    <v-container class="py-8 px-6" fluid>
      <v-card>
        <v-card-title>
          角色
        </v-card-title>
        <item-list :loaded="loaded" :empty="dataset.length < 1">
          <template #data>
            <v-list-item v-for="(item, index) in exportData" :key="index">
              <v-list-item-content>
                <v-list-item-title>
                  {{ item.display_name }}
                </v-list-item-title>
                <v-list-item-subtitle>
                  {{ item.email }}
                </v-list-item-subtitle>
              </v-list-item-content>
              <v-list-item-action v-show="modify">
                <v-btn class="amber darken-1 white--text" rounded depressed>
                  <v-icon>mdi-pencil-outline</v-icon>
                </v-btn>
              </v-list-item-action>
              <v-list-item-action v-show="modify">
                <v-btn class="red darken-1 white--text" rounded depressed>
                  <v-icon>mdi-trash-can-outline</v-icon>
                </v-btn>
              </v-list-item-action>
            </v-list-item>
          </template>
        </item-list>
      </v-card>
    </v-container>
    <modify-drawer @view="modify=false" @modify="modify=true"/>
  </v-card>
</template>

<script>
import ItemList from "@/components/ItemList";
import ModifyDrawer from "@/components/ModifyDrawer";

export default {
  name: "Levels",
  components: {ModifyDrawer, ItemList},
  data: () => ({
    loaded: false,
    modify: false,
    dataset: []
  }),
  created() {
    this.$axios.get("/level/all").then(resp => {
      this.loaded = true;
      this.dataset = resp.data
    })
  },
  computed: {
    exportData() {
      return this.dataset
    }
  }
}
</script>
