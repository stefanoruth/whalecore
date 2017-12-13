<template>
    <nav class="navbar is-unselectable is-light" v-show="$route.path != '/'">
        <div class="navbar-brand">
            <router-link to="/" class="navbar-item">
                <img src="/hvalborg.png" alt="Hvalborg icon">
            </router-link>
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
                        <router-link to="/pages" class="navbar-item" @click.native="mobileShow = false">Pages</router-link>
                        <router-link to="/buckets" class="navbar-item" @click.native="mobileShow = false">Buckets</router-link>
                        <router-link to="/posts" class="navbar-item" @click.native="mobileShow = false">Posts</router-link>
                    </div>
                </div>
                <router-link to="/templates" class="navbar-item" @click.native="mobileShow = false">Templates</router-link>
                <router-link to="/media" class="navbar-item" @click.native="mobileShow = false">Media Library</router-link>
            </div>
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">                
                    <div class="navbar-link">Settings</div>
                        <div class="navbar-dropdown">
                            <router-link to="/" class="navbar-item" @click.native="mobileShow = false">Change project</router-link>                        
                            <router-link to="/settings" class="navbar-item" @click.native="mobileShow = false">Project settings</router-link>
                            <!-- <router-link to="#" class="navbar-item" @click.native="mobileShow = false">User settings</router-link> -->
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