<x-danger-button
    x-data=""
    @click="$dispatch('open-modal', 'confirm-todo-deletion-{{$todo->id}}')">
    {{ __('Delete todo') }}
</x-danger-button>
