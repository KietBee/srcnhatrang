<div class="flex mb-4 items-center">
    <a href="{{ $goBack }}" title="Quay về">
        <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m15 19-7-7 7-7"/>
        </svg>              
    </a>
    <h2 class="ml-4 text-xl font-bold text-gray-900 dark:text-white">{{ $buttonName }}</h2>
</div>
<form method="POST" action="{{ $route }}">
    @csrf
    <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
        {{ $slot }}
    </div>
    <div class="flex items-center">
        <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
            {{ $buttonName }}
        </button>
    </div>
</form>