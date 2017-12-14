<template>
    <nav class="bg-white flex flex-col border-r border-blue-lighter select-none flex-no-shrink">
       <div class="flex p-4 border-b border-blue-lighter">
           <img class="w-12 h-12 inline" src="/hvalborg.png">
           <div class="self-center px-6">Whalecore</div>
       </div>
       <div class="p-8">
           <ul class="list-reset">
                <li>
                    <router-link to="/pages" class="text-black no-underline hover:bg-blue py-2 mb-4 block hover:text-white px-2 rounded">Pages</router-link>
                </li>
                <li>
                    <router-link to="/templates" class="text-black no-underline hover:bg-blue py-2 mb-4 block hover:text-white px-2 rounded">Templates</router-link>
                </li>
                <li>
                    <router-link to="/media" class="text-black no-underline hover:bg-blue py-2 mb-4 block hover:text-white px-2 rounded">Media Library</router-link>
                </li>
                <li>
                    <router-link to="/settings" class="text-black no-underline hover:bg-blue py-2 mb-4 block hover:text-white px-2 rounded">Settings</router-link>
                </li>
           </ul>
       </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                mobile: false
            };
        }
    };
</script>