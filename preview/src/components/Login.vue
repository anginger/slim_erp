<template>
  <v-container>
    <v-card flat>
      <v-card-title>
        <v-avatar color="grey lighten-5">
          <v-img
              max-width="15"
              max-height="35"
              :src="require('../assets/logo.png')"
          />
        </v-avatar>
        <v-card-title>
          Slim ERP Framework
        </v-card-title>
      </v-card-title>
    </v-card>
    <v-card outlined rounded>
      <v-card-title>
        Slim ERP 登入界面
      </v-card-title>
      <v-card-subtitle>
        Slim ERP Login
      </v-card-subtitle>
      <v-card-actions v-if="!id_login">
        <v-btn :disabled="true" depressed>
          單一簽入認證
        </v-btn>
        <v-spacer/>
        <v-btn @click="id_login = true" class="secondary" depressed>
          以帳號密碼登入
        </v-btn>
      </v-card-actions>
      <div v-else>
        <v-card-text>
          <v-text-field label="帳號" type="text"/>
          <v-text-field label="密碼" type="password"/>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="id_login = false" depressed>取消</v-btn>
          <v-spacer/>
          <v-btn class="secondary" depressed>登入</v-btn>
        </v-card-actions>
      </div>
    </v-card>
  </v-container>
</template>

<script>
export default {
  name: "Login",
  data: () => ({
    id_login: false
  })
}
</script>
