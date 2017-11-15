<template>
    <nav class="navbar is-unselectable is-light">
        <div class="navbar-brand">
            <a href="" class="navbar-item">
                <img src="/hvalborg.png">
            </a>
            <div class="navbar-burger" v-on:click="mobileShow = !mobileShow" v-bind:class="{'is-active':mobileShow}">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="navbar-menu" v-bind:class="{'is-active':mobileShow}">
            <div class="navbar-start">
                <router-link to="/" class="navbar-item">Dashboard</router-link>
                <router-link to="/pages" class="navbar-item">Pages</router-link>
                <router-link to="/buckets" class="navbar-item">Buckets</router-link>
                <router-link to="/templates" class="navbar-item">Templates</router-link>
                <router-link to="#" class="navbar-item">Components</router-link>
                <router-link to="#" class="navbar-item">Media Library</router-link>
            </div>
            <div class="navbar-end">
                <router-link to="#" class="navbar-item">Settings</router-link>
                <router-link to="#" class="navbar-item">User</router-link>
                <a href="/logout" class="navbar-item">Logout</a>
            </div>
        </div>
    </nav>
</template>

<script>
export default {

  data() {
    return {
      mobileShow: false
    };
  }
};
</script>