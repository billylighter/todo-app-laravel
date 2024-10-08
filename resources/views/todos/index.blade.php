<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

        <h1 class="mb-5 text-4xl text-center font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-black">
            {{$title}}
        </h1>

        @if (session('success'))
            <div class="pt-8">
                <div class="max-w-7xl mx-auto">
                    <div class="overflow-hidden sm:rounded-lg">
                        <div
                            class="text-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50"
                            role="alert">
                            <p class="font-medium">
                                {{__('Success!')}}
                            </p>
                            <p>
                                @if (session('success'))
                                    {{ session('success') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @forelse ($todos as $todo)
                <div class="p-6 flex space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $todo->user->name }}</span>
                                <small
                                    class="ml-2 text-sm text-gray-600">{{ $todo->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($todo->created_at->eq($todo->updated_at))
                                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                @endunless
                            </div>
                            @if ($todo->user->is(auth()->user()))
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('todos.edit', $todo)">
                                            {{ __('Edit') }}
                                        </x-dropdown-link>
                                        @include('todos.partials.delete-todo-popup')
                                        <form method="POST" action="{{ route('todos.destroy', $todo) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('todos.destroy', $todo)"
                                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $todo->message }}</p>
                    </div>
                </div>

                @if ($todo->user->is(auth()->user()))
                    <x-modal name="confirm-todo-deletion-{{$todo->id}}" focusable>
                        <form method="post"
                              action="{{ route('todos.destroy', $todo) }}"
                              class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete your todo?') }}
                            </h2>

                            <div class="mt-6">

                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Delete Todo') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                @endif

            @empty
                <div
                    class="p-5 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-yellow-400 text-center"
                    role="alert">
                    {{__('Your list is empty.')}}
                </div>
            @endforelse

        </div>
    </div>

</x-app-layout>
