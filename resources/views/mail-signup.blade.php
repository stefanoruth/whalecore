@extends('master')

@section('body')
    <div id="sales" class="font-sans h-screen bg-center bg-no-repeat bg-cover flex flex-col" style="background-image: url(images/newsletter-hero.jpg)">
        <div class="h-3 bg-blue"></div>
        <div class="flex-1 flex justify-center items-center">
            <div class="p-8 text-center max-w-md">
                <div class="mb-8">
                    <img class="h-24 w-24" src="{{ asset('logo.png') }}" alt="Whalecore Logo">
                </div>
                <div class="text-3xl py-6">Whoops! This is slightly embarrassing</div>
                <div class="mb-6 text-base text-grey-dark">We're just tidying up the last pieces and getting ready to help you all being amazing sailors! Sign up for our newsletter to receive the latest news</div>
                <div class="mb-4 text-grey-dark">We will never send you spam!</div>   
                <input class="w-full mb-6 py-1 leading-normal text-grey-darker border-b-4 outline-none bg-transparent" v-model="mail" type="text" name="email" placeholder="Enter your email" @keyup.enter="subscribe">                            
                <button class="hover:bg-blue text-grey-darker font-bold hover:text-white py-2 px-8 border border-blue rounded-full" @click="subscribe">Sign Up</button>
                <div class="mt-2 text-blue" v-if="successMsg != null">@{{ successMsg }}</div>
                <div class="mt-2 text-red-dark" v-if="errorMsg != null">@{{ errorMsg }}</div>
            </div>
        </div>
    </div>

    <script src="{{ mix('sales.js') }}"></script>
@stop