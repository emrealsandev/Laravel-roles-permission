<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 bg-white border-b border-gray-200">
                    @if (count($tasks) > 0)
                        @foreach ($tasks as $task)
                            <div
                                class="cursor-pointer mb-3 h-46 inline-block p-4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $task->title }}</h5>
                                <p class="font-normal pt-5 text-gray-700 dark:text-gray-400">{{ $task->desc }}</p><br>
                                <hr>
                                <small>creator: {{ $task->user->name }}</small>
                            </div>
                        @endforeach
                    @else
                        <span class="mt-3">Üzerinize kayıtlı task yok.</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
