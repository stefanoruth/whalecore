<template>
    <div class="h-screen flex items-center justify-center bg-blue-lightest">
        <div class="max-w-xl bg-white flex p-2 shadow-lg rounded-lg text-grey-darkest">
            <div class="p-8 flex justify-between flex-col w-2/5">
                <div>
                    <div class="text-xl font-bold mt-4 mb-1">Start using Whalecore Today</div>
                    <div class="mb-6 text-sm">Just a few quick and easy steps to get you started</div>
                    
                    <template v-if="step == 0">
                        <label class="mb-4 block">
                            <div class="uppercase text-xs">Basic Information</div>
                            <input class="w-full py-1 leading-normal text-grey-darkest border-b outline-none bg-transparent" type="text" name="email" placeholder="Email">
                        </label>

                        <label class="mb-4 block">
                            <div class="uppercase text-xs">Name</div>
                            <input class="w-full py-1 leading-normal text-grey-darkest border-b outline-none bg-transparent" type="text" name="name" placeholder="Full name">
                        </label>

                        <label class="mb-4 block">
                            <div class="uppercase text-xs">Password</div>
                            <input class="w-full py-1 leading-normal text-grey-darkest border-b outline-none bg-transparent" type="password" name="password" placeholder="8+ characters">
                        </label>

                        <label class="mb-6 block">
                            <div class="uppercase text-xs">Confirm Password</div>
                            <input class="w-full py-1 leading-normal text-grey-darkest border-b outline-none bg-transparent" type="password" name="password_confirmation" placeholder="Repeat password">
                        </label>

                        <div class="flex justify-between">
                            <div class="text-xs mr-8">By proceeding you are agreeing to our <a href="#" class="text-blue">terms of service</a> and <a href="#" class="text-blue">privacy policy</a></div>
                            <button @click.prevent="nextStep" class="btn-blue self-start">
                                <span>Next</span>
                                <svg class="inline h-4 w-4 fill-current align-text-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                            </button>
                        </div>
                    </template>
                    <template v-if="step == 1">
                        <label class="mb-4 block">
                            <div class="uppercase text-xs">Project</div>
                            <input class="w-full py-1 leading-normal text-grey-darkest border-b outline-none bg-transparent" type="text" placeholder="Title">
                        </label>

                        <div class="flex justify-end">
                            <button @click.prevent="nextStep" class="btn-primary self-start">
                                <span>Next</span>
                                <svg class="inline h-4 w-4 fill-current align-text-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                            </button>
                        </div>
                    </template>
                    <template v-if="step == 2">
                        <div class="btn-blue">Cancel</div>
                        <div class="btn-primary">Login</div>
                        <button class="btn-blue">Dermo</button>
                    </template>
                </div>
                <div class="flex justify-center mt-4">
                    <div class="flex justify-around w-16">
                        <span class="h-2 w-2 rounded-full bg-grey block" :class="{'bg-blue': step == 0}"></span>
                        <span class="h-2 w-2 rounded-full bg-grey block" :class="{'bg-blue': step == 1}"></span>
                        <span class="h-2 w-2 rounded-full bg-grey block" :class="{'bg-blue': step == 2}"></span>
                        <span class="h-2 w-2 rounded-full bg-grey block" :class="{'bg-blue': step == 3}"></span>
                        <span class="h-2 w-2 rounded-full bg-grey block" :class="{'bg-blue': step == 4}"></span>
                    </div>
                </div>
            </div>
            <div class="bg-grey-light p-8 w-3/5 flex-no-grow">
                <img class="" src="/images/signup-step1.png">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                info: {
                    user: {
                        name: null,
                        email: null,
                        password: null,
                        password_confirmation: null,
                    },
                    project: {
                        title: null,
                    }
                },
                step: 0,
            };
        },

        methods: {
            nextStep() {
                this.step++;
            },
        },
    }
</script>
