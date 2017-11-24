<template>
    <nav class="navbar is-unselectable is-light">
        <div class="navbar-brand">
            <a href="" class="navbar-item">
                <img src="/hvalborg.png" alt="Hvalborg icon">
            </a>
            <div class="navbar-burger" v-on:click="mobileShow = !mobileShow" v-bind:class="{'is-active':mobileShow}">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="navbar-menu" v-bind:class="{'is-active':mobileShow}">
            <div class="navbar-start">
                <div class="navbar-item has-dropdown is-hoverable">
                    <div class="navbar-link">Content</div>
                    <div class="navbar-dropdown">
                        <router-link to="/pages" class="navbar-item">Pages</router-link>
                        <router-link to="/buckets" class="navbar-item">Buckets</router-link>
                        <router-link to="/posts" class="navbar-item">Posts</router-link>
                    </div>
                </div>
                <router-link to="/templates" class="navbar-item">Templates</router-link>
                <router-link to="#" class="navbar-item">Media Library</router-link>
            </div>
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">                
                    <div class="navbar-link">Settings</div>
                        <div class="navbar-dropdown">
                            <router-link to="/" class="navbar-item">Change project</router-link>                        
                            <router-link to="#" class="navbar-item">Project settings</router-link>
                            <router-link to="#" class="navbar-item">User settings</router-link>
                    </div>
                </div>
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