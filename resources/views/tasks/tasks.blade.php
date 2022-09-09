<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }} - {{ Str::upper($currentPermission) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @can('create', \App\Models\Task::class)
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white italic float-right py-2 px-2 rounded-full mb-4">
                            <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-success">
                                + Task Oluştur</a>
                        </button>
                    @endcan
                    <table class="w-full text-sm text-left text-gray-500  dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Id
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Task Title
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Description
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Creator
                                </th>

                                @if ($currentPermission == 'Admin' || $currentPermission == 'Manager')
                                    <th scope="col" class="py-3 px-6">
                                        Transactions
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row"
                                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $task->id }}
                                    </th>
                                    <td class="py-4 px-6">
                                        {{ $task->title }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $task->desc }}
                                    </td>
                                    <td class="py-4 px-6 @if($task->user_id == auth()->user()->id) text-sky-500 @endif">
                                        {{ $task->user->name }}
                                    </td>

                                    <td class="py-4 px-6 mx-4">
                                        @can('delete', $task)
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-500 p-2 m-2">Sil</button>
                                            </form>
                                        @endcan

                                        @can('update', $task)
                                            <a href="{{ route('tasks.edit', $task->id) }}"
                                                style="color:rgb(17, 199, 138); float:left;">Düzenle</a>
                                        @endcan
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
