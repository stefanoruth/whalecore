<template>
    <div>
        <section class="h-screen bg-gradient flex flex-col">
                <nav class="px-4 py-4 mx-auto w-full relative select-none md:flex md:items-stretch">
                    <div class="flex flex-no-shrink items-stretch">
                        <a href="/" class="flex flex-no-grow flex-no-shrink items-center no-underline">
                            <img class="mr-2 h-12 w-12 block bg-white p-2 rounded-full" src="/logo.png" alt="Whaleborg">
                            <div class="text-white">Whalecore</div>
                        </a>
                    </div>
                </nav>

                <div class="px-2 flex-1 flex justify-center items-center">
                    <div>
                        <h1 class="mb-4 text-white text-center">Whalecore a CMS for Developers by Developers</h1>
                        <div class="text-center text-white leading-normal mx-auto mb-4">
                           <p>With a headless architecture and a user-friendly editor, we believe we've created something truely awesome.</p>
                           <p>Signup and let us help you create the web applications of tommorow!</p>
                        </div>
                        <div class="flex justify-center">
                            <router-link to="/signup" class="mr-4 py-2 px-8 border border-white rounded-full text-white no-underline hover:bg-white hover:text-primary">Signup</router-link>                       
                            <a :href='loginUrl' class="py-2 px-8 border border-white rounded-full text-white no-underline hover:bg-white hover:text-primary">Login</a>
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
                <div class="text-grey-dark text-sm mb-6">Our CMS is based around a headless structure. We use a super quick Node.js API to deliever your data, which is stored in our Redis database. Simply call the end point of the desired page and ye shall recieve content. Smart right?</div>
                <div class="">
                    <img class="w-full rounded-xl" alt="flow-img" src="/images/680x240.png">
                </div>
            </div>
        </section>

        <section class="bg-primary bg-clip text-white px-4 py-18">
            <div class="mx-auto max-w-xs text-center">
                <div class="text-xl mb-4">Not convinced yet?</div>
                <div class="mb-6">Well then take a look at what these guys felt!</div>
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
                        <div class="text-primary mb-2">You keep saying Headles..</div>
                        <div class="text-xl text-black mb-4">What does that even mean?</div>
                        <div class="divider bg-primary"></div>
                        <div class="text-sm text-grey-dark">We're glad you asked! Headless is an architecture which allows us to serve your content, with out having to restrict the way you code your application. Pretty sweet right?</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="px-4 py-8">
            <div class="md:flex max-w-lg mx-auto">
                <div class="flex-1 flex justify-center items-center p-8">
                    <div class="text-center">
                        <div class="text-primary mb-2">Developers should develop</div>
                        <div class="text-xl text-black mb-4">And editors should edit!</div>
                        <div class="divider bg-primary"></div>
                        <div class="text-sm text-grey-dark">We created Whalecore because we felt that developers and content editors should be able to work together in a way that benefits both. Our CMS allows content editors to write awesome content and engange with the costumers, and it allows developers to be crazy and experiment with the latest technologies</div>
                    </div>
                </div>
                <div class="flex-1 p-8">
                    <img class="rounded-lg w-full" src="/images/300.png" alt="tmp image">
                </div>
            </div>
        </section>

        <section class="bg-primary-darkest">
            <div class="mx-auto max-w-lg px-4 py-16">
                <div class="mb-8 text-center">
                    <div class="text-primary mb-2">Alright - whats the damage?</div>
                    <div class="text-white mb-2 text-xl">Our Prices</div>
                    <div class="divider bg-white"></div>
                    <div class="text-sm mx-auto max-w-xs text-grey-lighter">As we said, we created Whalecore in an attempt to combine the best of both worlds. This is something we truely and dearly believe in. But.. We need to keep our services running, have food on the table and sometimes we gotta check to the whales too! We don't have an investor or anyother form of backing, but we did try and keep our prices to a minimum!</div>
                </div>
                <div class="md:flex justify-center">
                    <div v-for="(item, i) in pricePackages" :key="i" class="flex-1 flex flex-col text-center mb-4 mx-4 bg-white rounded-xl overflow-hidden">
                        <div class="bg-gradient text-white px-8 pt-8 pb-6">
                            <div class="text-2xl mb-2">{{ item.title }}</div>
                            <div class="text-base">&nbsp;{{ item.price }}</div>
                        </div>
                        <ul class="px-8 list-reset py-4">
                            <li v-for="(option, oi) in item.options" :key="oi" class="mb-2">{{ option }}</li> 
                        </ul>
                        <div class="px-8 pb-4 mt-auto">
                            <button v-if="i == 2" class="btn-primary">Contact us</button>
                            <button v-else class="btn-primary">Get started</button>
                        </div>
                    </div>
                </div>
            </div>

            <svg class="block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3840 442">
                <path d="M0,62c0,0 193.777,24.272 306,83c112.223,58.728 177.307,91.297 259,84c81.693,-7.297 158.345,-33.268 190,-46c31.655,-12.732 239.845,-89.282 318,-87c78.155,2.282 144.033,-0.88 309,61c164.967,61.88 287.988,130.083 460,154c172.012,23.917 461.924,-82.352 563,-89c133.596,-8.787 231.185,11.314 380,62c127.29,43.354 301.681,-8.726 397,-52c95.319,-43.274 304.071,-141.702 365,-167c60.929,-25.298 210.754,-64.186 293,-65l0,442l-3840,0l0,-380Z" style="fill:#04a1e3;"/>
            </svg>
        </section>

        <section class="bg-primary text-white px-4 py-6">
            <div class="container mx-auto">
                <div class="md:flex justify-between">
                    <div class="flex justify-between md:justify-start mb-4">
                        <div class="mr-8">
                            <div class="mb-2 uppercase text-primary-darkest font-bold text-xs">Getting Started</div>
                            <ul class="list-reset">
                                <li class="mb-1"><a class="block text-white no-underline hover:underline" href="#">Documentation</a></li>
                                <li class="mb-1"><a class="block text-white no-underline hover:underline" href="#">Api</a></li>
                            </ul>
                        </div>
                        <div class="mr-8">
                            <div class="mb-2 uppercase text-primary-darkest font-bold text-xs">About</div>
                            <ul class="list-reset">
                                <li class="mb-1"><a class="block text-white no-underline hover:underline" href="#">Terms of Service</a></li>
                                <li class="mb-1"><a class="block text-white no-underline hover:underline" href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <div class="mr-8">
                            <div class="mb-2 uppercase text-primary-darkest font-bold text-xs">Connect</div>
                            <ul class="list-reset">
                                <li class="mb-1"><a class="block text-white no-underline hover:underline" href="mailto:hello.whalecore@gmail.com">Contact Us</a></li>
                                <li class="mb-1"><a class="block text-white no-underline hover:underline" href="https://www.facebook.com/WhalecoreCms/" target="_blank">Facebook</a></li>
                                <li class="mb-1"><a class="block text-white no-underline hover:underline" href="https://twitter.com/WhalecoreCms" target="_blank">Twitter</a></li>
                                <li class="mb-1"><a class="block text-white no-underline hover:underline" href="#">Instagram</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-4">
                        <newsletter-signup></newsletter-signup>
                    </div>
                </div>
                <div class="text-left">@2018 Whalecore</div>
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
                    'Whalecore is super simple to use!',
                    'Their content builder is otherwordly!',
                    'Data arrives quick, prices are small and I LOVE the whale!',
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
        },

        components: {
            'newsletter-signup': require('../components/NewsletterSignup'),
        },
    }
</script>
