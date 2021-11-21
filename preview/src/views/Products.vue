<template>
  <v-card>
    <v-container class="py-8 px-6" fluid>
      <v-card>
        <v-card-title>
          產品資料
        </v-card-title>
        <item-list :loaded="loaded" :empty="dataset.length < 1">
          <template #data>
            <v-list-item v-for="(item, index) in exportData" :key="index">
              <v-list-item-content>
                <v-list-item-title>
                  {{ item.display_name }}
                </v-list-item-title>
                <v-list-item-subtitle>
                  {{ item.cost_value }}
                  {{ item.sell_value }}
                  {{ item.remain_amount }}
                </v-list-item-subtitle>
              </v-list-item-content>
              <v-list-item-action>
                <v-btn depressed>
                  <v-icon>mdi-pen-outline</v-icon>
                </v-btn>
              </v-list-item-action>
            </v-list-item>
          </template>
        </item-list>
      </v-card>
    </v-container>
  </v-card>
</template>

<script>
import ItemList from "@/components/ItemList";

export default {
  name: "Products",
  components: {ItemList},
  data: () => ({
    loaded: false,
    dataset: []
  }),
  created() {
    this.$axios.get("/product/all").then(resp => {
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
