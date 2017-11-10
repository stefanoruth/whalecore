<nav id="navbar" class="flex p-6 bg-blue items-center justify-between flex-wrap text-white select-none">
    <div class="flex mr-6">
        <span class="text-xl font-semibold">{{ config('app.name') }}</span>
    </div>
    <div class="flex-grow flex items-center">
        <a href="{{ route('dashboard') }}" class="inline-block text-white mr-4 no-underline hover:underline">Dashboard</a>
        <a href="{{ route('pages.index') }}" class="inline-block text-white mr-4 no-underline hover:underline">Pages</a>
        <a href="{{ route('buckets.index') }}" class="inline-block text-white mr-4 no-underline hover:underline">Buckets</a>
        <a href="{{ route('templates.index') }}" class="inline-block text-white mr-4 no-underline hover:underline">Template</a>
        <a href="{{ route('components.index') }}" class="inline-block text-white mr-4 no-underline hover:underline">Components</a>
        <a href="{{ route('media.index') }}" class="inline-block text-white mr-4 no-underline hover:underline">Media Library</a>
        <a href="#"  class="inline-block text-white mr-4 no-underline hover:underline">Settings</a>
        <a href="#"  class="inline-block text-white mr-4 no-underline hover:underline">User</a>
        <a href="{{ route('logout') }}"  class="inline-block text-white mr-4 no-underline hover:underline">Logout</a>
    </div>
</nav>