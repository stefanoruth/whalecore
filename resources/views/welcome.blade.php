@extends('master')

@section('body')
    <div id="sales">
        
        <nav class="flex justify-between container mx-auto px-8 pt-8">
            <a href="#" class="flex no-underline">
                <img class="w-16 h-16 mr-4" src="{{ asset('logo.png') }}" alt="Whalecore Logo">
                <div class="uppercase text-blue self-center">Whalecore</div>
            </a>
            <ul class="list-reset flex">
                <li class="mr-4"><a href="#" class="py-4 block text-blue no-underline">About</a></li>
                <li class="mr-4"><a href="#" class="py-4 block text-blue no-underline">Features</a></li>
                <li class="mr-4"><a href="#" class="py-4 block text-blue no-underline">Pricing</a></li>
                <li class="mr-4"><a href="#" class="py-4 block text-blue no-underline">Contact</a></li>
                <li class="mr-4"><a href="{{ route('login') }}" class="py-4 block text-blue no-underline">Login</a></li>
                <li class="mr-4"><a href="{{ route('register') }}" class="py-4 block text-blue no-underline">Get Started</a></li>              
            </ul>
        </nav>

        <div class="container mx-auto p-8">
            <div class="w-full text-center text-3xl mb-8 font-bold">Freatures of Whalecore</div>
            <div class="flex justify-between">
                <div class="text-center px-4">
                    <div class="mb-4">
                        <img src="{{ asset('logo.png') }}" class="w-24 h-24">
                    </div>
                    <div>
                        <div class="font-bold mb-2">Content Building</div>
                        <div class="text-grey-dark">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem culpa similique ut fuga error ea voluptatem alias totam aliquam veritatis?</div>
                    </div>
                </div>
                <div class="text-center px-4">
                    <div class="mb-4">
                        <img src="{{ asset('logo.png') }}" class="w-24 h-24">
                    </div>
                    <div>
                        <div class="font-bold mb-2">SEO</div>
                        <div class="text-grey-dark">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem culpa similique ut fuga error ea voluptatem alias totam aliquam veritatis?</div>
                    </div>
                </div>
                <div class="text-center px-4">
                    <div class="mb-4">
                        <img src="{{ asset('logo.png') }}" class="w-24 h-24">
                    </div>
                    <div>
                        <div class="font-bold mb-2">Templating</div>
                        <div class="text-grey-dark">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rem culpa similique ut fuga error ea voluptatem alias totam aliquam veritatis?</div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="flex p-8 justify-between container mx-auto">
            <div class="pr-4">
                <div class="flex">
                    <img class="w-24 h-24 mr-4" src="{{ asset('logo.png') }}" alt="Whalecore Logo">
                    <div class="uppercase self-center">Whalecore</div>
                </div>
            </div>
            <div class="pr-4">
                <div class="uppercase mb-6">Features</div>
                <ul class="list-reset">
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Live channels</a></li>
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Creating Projects</a></li>
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Team effectiveness</a></li>
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">User Rating</a></li>
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Templating</a></li>
                </ul>
            </div>
            <div class="pr-4">
                <div class="uppercase mb-6">Resources</div>
                <ul class="list-reset">
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Watch a Demo</a></li>
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Docs</a></li>
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Integrations & API</a></li>
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Status</a></li>
                </ul>
            </div>
            <div class="pr-4">
                <div class="uppercase mb-6">Company</div>
                <ul class="list-reset">
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">About</a></li>
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Customers</a></li>
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Careers</a></li>
                    <li class="mb-2"><a href="#" class="text-grey-light no-underline">Press</a></li>
                </ul>
            </div>
            <div class="">
                <div class="uppercase mb-6">Contact</div>
                <ul class="list-reset">
                    <li class="mb-8"><a href="mailto:support@whalecore.net" target="_blank" class="text-grey-light no-underline">support@whalecore.net</a></li>
                    <li>
                        <ul class="list-reset flex justify-between">
                            <li class="border border-grey-light hover:border-blue rounded-full p-1 mr-2">
                                <a href="#" target="_blank">
                                    <img class="h-4 w-4 block" src="{{ asset('logo.png') }}" alt="">
                                </a>
                            </li>
                            <li class="border border-grey-light hover:border-blue rounded-full p-1 mr-2">
                                <a href="#" target="_blank">
                                    <img class="h-4 w-4 block" src="{{ asset('logo.png') }}" alt="">
                                </a>
                            </li>
                            <li class="border border-grey-light hover:border-blue rounded-full p-1 mr-2">
                                <a href="#" target="_blank">
                                    <img class="h-4 w-4 block" src="{{ asset('logo.png') }}" alt="">
                                </a>
                            </li>
                            <li class="border border-grey-light hover:border-blue rounded-full p-1 mr-2">
                                <a href="#" target="_blank">
                                    <img class="h-4 w-4 block" src="{{ asset('logo.png') }}" alt="">
                                </a>
                            </li>
                            <li class="border border-grey-light hover:border-blue rounded-full p-1 mr-2">
                                <a href="#" target="_blank">
                                    <img class="h-4 w-4 block" src="{{ asset('logo.png') }}" alt="">
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </footer>
    </div>
    <script src="{{ mix('sales.js') }}"></script>
@stop