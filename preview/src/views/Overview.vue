<template>
  <v-card>
    <v-container class="py-8 px-6" fluid>
      <v-row>
        <v-col v-for="(card, name) in cards" :key="name" cols="12">
          <v-card>
            <v-subheader>{{ name }}</v-subheader>
            <v-list two-line>
              <template v-for="(item, index) in card.data">
                <v-list-item :key="index">
                  <v-list-item-avatar color="grey darken-1">
                  </v-list-item-avatar>
                  <v-list-item-content>
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                    <v-list-item-subtitle>{{
                      item.description
                    }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-divider
                  v-if="index !== card.data.length - 1"
                  :key="`divider-${index}`"
                  inset
                ></v-divider>
              </template>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-card>
</template>

<script>
export default {
  name: "Overview",
  data: () => ({
    cards: {
      Overview: {
        loaded: true,
        data: [
          {
            title: "無法使用",
            description: "Unavailable",
          },
        ],
      },
      History: {
        loaded: false,
        data: [],
      },
    },
  }),
  created() {
    this.load();
  },
  methods: {
    load() {
      this.cards.History.loaded = false;
      this.$axios.get("/history/all").then((resp) => {
        this.cards.History.loaded = true;
        this.cards.History.data = resp.data.map((item) => ({
          title: Date(item.created_time * 1000).toLocaleString(),
          description: `User ${item.user} requested to ${item.method.toLowerCase()} ${item.resource}`
        }));
      });
    },
  },
};
</script>
