<template>
  <div id="app">
    <div>
      長方形1：
      <label>寬：</label>
      <input type="text" v-model="retangle1.width"/>
      <label>高：</label>
      <input type="text" v-model="retangle1.height"/>
    </div>
    <div>
      長方形2：
      <label>寬：</label>
      <input type="text" v-model="retangle2.width"/>
      <label>高：</label>
      <input type="text" v-model="retangle2.height"/>
    </div>
    <div>
      <button @click="submit">計算</button>
    </div>
    <div>
      retangle1的面積：{{ retangle1.area }}<br/>
      retangle1的周長：{{ retangle1.perimeter }}<br/>
      retangle2的面積：{{ retangle2.area }}<br/>
      retangle2的周長：{{ retangle2.perimeter }}
    </div>
  </div>
</template>

<script>
export default {
  name: "App",
  data: () => ({
    retangle1: {
      width: 0,
      height: 0,
      area: 0,
      perimeter: 0,
    },
    retangle2: {
      width: 0,
      height: 0,
      area: 0,
      perimeter: 0,
    },
  }),
  methods: {
    request(retangle) {
      return this.$axios.get(`http://localhost:1808/`, {params: retangle});
    },
    submit() {
      this.request(this.retangle1)
          .then((response) => {
            this.retangle1.area = response.data.area;
            this.retangle1.perimeter = response.data.perimeter;
          })
          .catch((error) => {
            console.log(error);
          });
      this.request(this.retangle2)
          .then((response) => {
            this.retangle2.area = response.data.area;
            this.retangle2.perimeter = response.data.perimeter;
          })
          .catch((error) => {
            console.log(error);
          });
    },
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
