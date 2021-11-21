<template>
  <v-card>
    <v-container class="py-8 px-6" fluid>
      <v-row>
        <v-col v-for="(data, name) in cards" :key="name" cols="12">
          <v-card>
            <v-subheader>{{ name }}</v-subheader>
            <v-list two-line>
              <template v-for="(item, index) in data">
                <v-list-item :key="index">
                  <v-list-item-avatar color="grey darken-1">
                  </v-list-item-avatar>
                  <v-list-item-content>
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                    <v-list-item-subtitle>{{ item.description }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-divider v-if="index !== (data.length - 1)" :key="`divider-${index}`" inset></v-divider>
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
      Overview: [{
        title: "無法使用",
        description: "Unavailable"
      }]
    },
  })
}
</script>
