<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #9e4b82 !important;">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Laravel Demo App by Imran</router-link>
                <span style="margin-left: auto;font-size: 26px;"><strong>Use as Admin</strong></span>
                <img style="margin-left: 2rem;width: 60px" :class="$store.getters.isAdmin ? 'flip' : ''" v-on:click="changed" :src="'\\svgs\\' + ($store.getters.isAdmin ? 'on' : 'off') + '.svg'" ></img>
                <span style="margin-left: 0.5rem;font-size: 26px;"><strong>{{'Turn ' + ($store.getters.isAdmin ? 'off' : 'on')}}</strong></span>
            </div>
        </nav>
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>
<style>
.flip {
    -webkit-transform: scaleX(-1);
    transform: scaleX(-1);
}
</style>
<script>
export default {
    methods: {
        changed: function(event) {
            this.$store.commit('change', !this.$store.getters.isAdmin);
            if(this.$route.name !== 'home'){
                this.$router.push({path: '/'});
            }
        }
    }
}
</script>
