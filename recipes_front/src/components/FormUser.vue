<template>
  <form>
    <p>
      <label for="name">Nom</label><br>
      <input id="name" v-model="name" type="text" name="name">
    </p>
    <p>
      <label for="name">Email</label><br>
      <input id="email" v-model="email" type="text" name="email">
    </p>
    <p>
      <label for="password">Mot de passe</label><br>
      <input id="password" v-model="password" type="password" name="password">
    </p>
    <p>
      <label for="vpassword">Confirmer mot de passe</label><br>
      <input id="vpassword" v-model="vpassword" type="password" name="password">
    </p>
    <button @click.prevent="register(password, vpassword)">Confirmer</button>
  </form>
</template>

<script>
export default {
  name: 'FormUser',
  data() {
    return {
      name: "",
      email: "",
      password: "",
      vpassword: ""
    }
  },

  async created(){
    const res = await fetch('/api/users')
    const data = await res.json();
    console.log(data.data);
  },
  methods: {
    async register(password, vpassword) {
      const user = {
        name: this.name,
        email: this.email,
        password: this.password
      }
      if (password !== vpassword) {
        alert('Les mots de passes ne coincident pas !');
      }
      const res = await fetch('/api/users', {
        method: "POST",
        body: JSON.stringify(user)
      });
      const data = res.json();
      console.log(data)
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
