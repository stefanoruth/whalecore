<template>
    <div>
        <section class="h-screen bg-gradient flex flex-col">
                <nav class="px-4 mx-auto w-full relative select-none md:flex md:items-stretch">
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
                            <a href="mailto:hello.whalecore@gmail.com" class="menu-item">Contact</a>
                            <a :href="loginUrl" class="bg-white text-primary flex-no-grow flex-no-shrink no-underline self-center rounded px-2 py-1">Login</a>
                        </div>
                    </div>
                </nav>
                <div class="flex-1 flex justify-center items-center">
                    <div>
                        <h1 class="mb-4 text-white text-center">Whalecore a CMS for Developers by Developers</h1>
                        <div class="text-center text-white leading-normal mx-auto mb-4">
                           <p>With a headless architecture and a user-friendly editor, we believe we have created something truely awesome.</p>
                           <p>Signup and start creating the web applications of tommorow!</p>
                        </div>
                        <div class="flex justify-center">
                            <router-link to="/signup" class="mr-4 py-2 px-8 border border-white rounded-full text-white no-underline">Signup</router-link>                       
                            <a :href='loginUrl' class="py-2 px-8 border border-white rounded-full text-white no-underline">Login</a>
                        </div>
                    </div>
                </div>

                <div>
                    <svg class="block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3840 496">
                        <path d="M2829,375c0,0 144.151,-3.241 261,-49c116.849,-45.759 402.155,-189.395 493,-222c90.845,-32.605 170.118,-53.307 257,-52l0,336l-1011,-13Z" style="fill:url(#_Linear1);"/>
                        <path d="M536,286c0,0 -97.731,-20.765 -166,-89c-68.269,-68.235 -120.308,-110.166 -161,-134c-40.692,-23.834 -88.556,-55.791 -209,-63l0,284l536,2Z" style="fill:url(#_Linear2);"/>
                        <path d="M0,118c0,0 179.667,16.191 322,89c142.333,72.809 203.125,111.826 414,37c210.875,-74.826 356.899,-152.535 658,-27c301.101,125.535 478.777,193.987 708,135c229.223,-58.987 337.998,-58.281 480,-44c200.08,20.121 234.853,116.52 505,27c623.842,-206.725 753,-188 753,-188l0,349l-3840,0l0,-378Z" style="fill:#fff;"/>
                        <defs>
                            <linearGradient id="_Linear1" x1="0" y1="0" x2="1" y2="0" gradientUnits="userSpaceOnUse" gradientTransform="matrix(1011,0,0,336.058,2829,219.971)">
                                <stop offset="0" style="stop-color:#1397cd;stop-opacity:1"/>
                                <stop offset="1" style="stop-color:#26c2e3;stop-opacity:1"/>
                            </linearGradient>
                            <linearGradient id="_Linear2" x1="0" y1="0" x2="1" y2="0" gradientUnits="userSpaceOnUse" gradientTransform="matrix(532,0,0,284,2.27374e-13,142)">
                                <stop offset="0" style="stop-color:#1bacdd;stop-opacity:1"/>
                                <stop offset="1" style="stop-color:#63d3ff;stop-opacity:1"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </div>


        </section>

        <section class="bg-white py-12 px-4">
            <div class="mx-auto max-w-lg w-full text-center">
                <div class="text-primary py-2">CMS Flow</div>
                <div class="text-black py-2 text-xl">How does our Content Management system work?</div>
                <div class="divider bg-primary"></div>
                <div class="text-grey-dark text-sm mb-6">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate dolore tenetur qui quasi minus accusamus inventore tempora, ut odit nam similique omnis quod facere ducimus pariatur aut sunt? Cupiditate.</div>
                <div class="">
                    <img class="w-full rounded-xl" alt="flow-img" src="/images/680x240.png">
                </div>
            </div>
        </section>

        <section class="bg-primary bg-clip text-white px-4 py-18">
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
                        <div class="text-primary mb-2">Title here</div>
                        <div class="text-xl text-black mb-4">Some text here</div>
                        <div class="divider bg-primary"></div>
                        <div class="text-sm text-grey-dark">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, voluptatem adipisci beatae sunt nulla esse deserunt velit, dolores veniam quasi quibusdam veritatis sapiente rerum commodi necessitatibus voluptate magnam quos dolore.</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-4 py-8">
            <div class="md:flex max-w-lg mx-auto">
                <div class="flex-1 flex justify-center items-center p-8">
                    <div class="text-center">
                        <div class="text-primary mb-2">Title here</div>
                        <div class="text-xl text-black mb-4">Some text here</div>
                        <div class="divider bg-primary"></div>
                        <div class="text-sm text-grey-dark">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, voluptatem adipisci beatae sunt nulla esse deserunt velit, dolores veniam quasi quibusdam veritatis sapiente rerum commodi necessitatibus voluptate magnam quos dolore.</div>
                    </div>
                </div>
                <div class="flex-1 p-8">
                    <img class="rounded-lg w-full" src="/images/300.png" alt="tmp image">
                </div>
            </div>
        </section>

        <section class="bg-primary-darkest px-4 py-16">
            <div class="mx-auto max-w-lg    ">
                <div class="mb-8 text-center">
                    <div class="text-primary mb-2">Title here</div>
                    <div class="text-white mb-2 text-xl">Our Prices</div>
                    <div class="divider bg-white"></div>
                    <div class="text-sm mx-auto max-w-xs text-grey-lighter">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus placeat, nisi nemo nesciunt natus tempore optio consequatur officiis, itaque ipsa blanditiis animi fugit. Quaerat reprehenderit porro eos cum nemo necessitatibus.</div>
                </div>
                <div class="md:flex justify-center">
                    <div v-for="(item, i) in pricePackages" :key="i" class="flex-1 text-center mb-4">
                        <div class="px-4">
                            <div class="bg-gradient text-white px-8 pt-8 pb-6 rounded-t-xl">
                                <div class="text-2xl mb-2">{{ item.title }}</div>
                                <div class="text-base">{{ item.price }}</div>
                            </div>
                            <div class="px-8 bg-white pb-4 pt-4 rounded-b-xl">
                                <ul class="list-reset mb-6 pt-2">
                                    <li v-for="(option, oi) in item.options" :key="oi" class="mb-2">{{ option }}</li>
                                </ul>
                                <div>
                                    <button v-if="i == 2" class="btn-primary">Contact us</button>
                                    <button v-else class="btn-primary">Get started</button>
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
                        title: 'Free',
                        price: null,
                        options: [
                            'Unlimited templates',
                            'Unlimited content pages',
                            'Downloadable JSON content',
                        ]
                    },
                    {
                        title: 'Professional',
                        price: '$24.99/month',
                        options: [
                            'Unlimited content hosting',
                            'One click publish',
                            'Access to the Whalecore API',
                        ]
                    },
                    {
                        title: 'Whitelabel',
                        price: "Coming soon",
                        options: [
                            'Same as Professional',
                            'Your company logo on all pages',
                        ]
                    },
                ]
            };
        },

        computed: {
            loginUrl() {
                return route('login');
            },
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