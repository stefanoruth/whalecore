<template>
    <nav id="navbar" class="flex p-6 bg-blue items-center justify-between flex-wrap text-white select-none">
        <div class="flex mr-6">
            <span class="text-xl font-semibold">Whalecore</span>
        </div>
        <div class="flex-grow flex items-center">
            <router-link to="/" class="inline-block text-white mr-4 no-underline hover:underline">Dashboard</router-link>
            <router-link to="/pages" class="inline-block text-white mr-4 no-underline hover:underline">Pages</router-link>
            <router-link to="/buckets" class="inline-block text-white mr-4 no-underline hover:underline">Buckets</router-link>
            <router-link to="/templates" class="inline-block text-white mr-4 no-underline hover:underline">Templates</router-link>
            <router-link to="#" class="inline-block text-white mr-4 no-underline hover:underline">Components</router-link>
            <router-link to="#" class="inline-block text-white mr-4 no-underline hover:underline">Media Library</router-link>
            <router-link to="#" class="inline-block text-white mr-4 no-underline hover:underline">Settings</router-link>
            <router-link to="#" class="inline-block text-white mr-4 no-underline hover:underline">User</router-link>
            <a href="/logout" class="inline-block text-white mr-4 no-underline hover:underline">Logout</a>
        </div>
    </nav>
</template>