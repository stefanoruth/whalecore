<template>
    <div>
        <section class="bg-blue">
            <div class="">
                <nav class="px-4 mx-auto relative select-none md:flex md:items-stretch">
                    <div class="flex flex-no-shrink items-stretch">
                        <div class="flex flex-no-grow flex-no-shrink items-center">
                            <img class=" mr-2 h-10 w-10 block" src="/logo.png" alt="Whaleborg">
                            <div class="text-white text-sm">Whalecore</div>
                        </div>
                        <button class="block md:hidden cursor-pointer ml-auto relative p-4" @click="mobileMenu = !mobileMenu">
                            <div class="h-6 w-6">
                                <svg v-show="!mobileMenu" class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                                <svg v-show="mobileMenu" class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
                            </div>
                        </button>
                    </div>

                    <div class="md:flex md:items-stretch md:flex-no-shrink md:flex-grow border-b md:border-b-0" v-bind:class="{'hidden':!mobileMenu}">
                        <div class="md:flex md:items-stretch md:justify-end ml-auto">
                            <router-link to="/signup" class="menu-item">Signup</router-link>
                            <a href="#" class="menu-item">How it works</a>
                            <a href="#" class="menu-item">Contact</a>
                        </div>
                    </div>
                </nav>
            </div>
        </section>

        <section class="bg-white py-12 px-4">
            <div class="mx-auto max-w-lg w-full text-center">
                <div class="text-blue py-2">CMS Flow</div>
                <div class="text-black py-2 text-xl">How does our Content Management system work?</div>
                <div class="divider bg-blue"></div>
                <div class="text-grey-dark text-sm mb-6">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate dolore tenetur qui quasi minus accusamus inventore tempora, ut odit nam similique omnis quod facere ducimus pariatur aut sunt? Cupiditate.</div>
                <div class="">
                    <img class="w-full rounded-xl" alt="flow-img" src="/images/680x240.png">
                </div>
            </div>
        </section>

        <section class="bg-blue bg-clip text-white px-4 py-18">
            <div class="mx-auto max-w-xs text-center">
                <div class="text-xl mb-4">Reviews</div>
                <div class="mb-6">See what others are saying!</div>
                <div class="mb-6 text-black flex overflow-hidden">
                    <div v-for="(review, i) in reviews" :key="i" v-show="reviewShow == i" class="px-2 flex-no-shrink w-full">
                        <div class="bg-white shadow rounded p-8">{{ review }}</div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <span @click="reviewShow = 0" :class="{'bg-white': reviewShow == 0}" class="cursor-pointer rounded-full h-2 w-2 border border-white mr-2"></span>
                    <span @click="reviewShow = 1" :class="{'bg-white': reviewShow == 1}" class="cursor-pointer rounded-full h-2 w-2 border border-white mr-2"></span>
                    <span @click="reviewShow = 2" :class="{'bg-white': reviewShow == 2}" class="cursor-pointer rounded-full h-2 w-2 border border-white"></span>
                </div>
            </div>
        </section>

        <section class="px-4 py-8">
            <div class="flex max-w-lg mx-auto flex-col-reverse md:flex-row">
                <div class="flex-1 p-8">
                    <img class="rounded-lg w-full" src="/images/300.png" alt="tmp image">
                </div>
                <div class="flex-1 flex justify-center items-center p-8">
                    <div class="text-center">
                        <div class="text-blue mb-2">Title here</div>
                        <div class="text-xl text-black mb-4">Some text here</div>
                        <div class="divider bg-blue"></div>
                        <div class="text-sm text-grey-dark">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, voluptatem adipisci beatae sunt nulla esse deserunt velit, dolores veniam quasi quibusdam veritatis sapiente rerum commodi necessitatibus voluptate magnam quos dolore.</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-4 py-8">
            <div class="md:flex max-w-lg mx-auto">
                <div class="flex-1 flex justify-center items-center p-8">
                    <div class="text-center">
                        <div class="text-blue mb-2">Title here</div>
                        <div class="text-xl text-black mb-4">Some text here</div>
                        <div class="divider bg-blue"></div>
                        <div class="text-sm text-grey-dark">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, voluptatem adipisci beatae sunt nulla esse deserunt velit, dolores veniam quasi quibusdam veritatis sapiente rerum commodi necessitatibus voluptate magnam quos dolore.</div>
                    </div>
                </div>
                <div class="flex-1 p-8">
                    <img class="rounded-lg w-full" src="/images/300.png" alt="tmp image">
                </div>
            </div>
        </section>

        <section class="bg-grey-darkest px-4 py-16">
            <div class="mx-auto max-w-lg    ">
                <div class="mb-8 text-center">
                    <div class="text-blue mb-2">Title here</div>
                    <div class="text-white mb-2 text-xl">Our Prices</div>
                    <div class="divider bg-white"></div>
                    <div class="text-sm mx-auto max-w-xs text-grey-lighter">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus placeat, nisi nemo nesciunt natus tempore optio consequatur officiis, itaque ipsa blanditiis animi fugit. Quaerat reprehenderit porro eos cum nemo necessitatibus.</div>
                </div>
                <div class="md:flex justify-center">
                    <div v-for="(item, i) in pricePackages" :key="i" class="flex-1 text-center mb-4">
                        <div class="px-4">
                            <div class="bg-blue text-white px-8 pt-8 pb-6 rounded-t-xl">
                                <div class="text-2xl mb-2">{{ item.title }}</div>
                                <div class="text-base">${{ item.price }}</div>
                            </div>
                            <div class="px-8 bg-white pb-4 pt-4 rounded-b-xl">
                                <ul class="list-reset mb-6 pt-2">
                                    <li v-for="(option, oi) in item.options" :key="oi" class="mb-2">{{ option }}</li>
                                </ul>
                                <div>
                                    <button class="btn-primary">Get started</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                mobileMenu: false,
                reviews: [
                    'Someone said that',
                    'I sais this',
                    'We hope for this',
                ],
                reviewShow: 0,

                pricePackages: [
                    {
                        title: 'Beginner',
                        price: 14.99,
                        options: [
                            'What you get',
                            'What you get',
                            'What you get',
                        ]
                    },
                    {
                        title: 'Advanced',
                        price: 24.99,
                        options: [
                            'What you get',
                            'What you get',
                            'What you get',
                        ]
                    },
                    {
                        title: 'Professional',
                        price: 64.99,
                        options: [
                            'What you get',
                            'What you get',
                            'What you get',
                        ]
                    },
                ]
            };
        },

        mounted() {
            this.changeReview();
            // document.addEventListener('click', e => {
            //     if (this.mobileMenu) {
            //         this.mobileMenu = false;
            //     }
            // });
        },

        methods: {
            changeReview() {
                setInterval(() => {
                    this.reviewShow++;

                    if (this.reviewShow > 2) {
                        this.reviewShow = 0;
                    }
                },5000);
            }
        }
    }
</script>