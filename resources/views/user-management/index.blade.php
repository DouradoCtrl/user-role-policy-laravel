<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('users-management') }}" class="flex items-center p-2 rounded-lg transition duration-200 text-gray-800">
            <x-heroicon-o-users class="w-6 h-6" />
            <h2 class="text-lg leading-tight ml-2">
                User Management
            </h2>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    @include('user-management.partials.OverviewUsers')
                </div>
            </div>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div x-data="{ userId: '{{ old('user_id') }}' }"
             x-on:set-user-id.window="userId = $event.detail">
            @include('user-management.partials.delete-user-form')
        </div>
    </x-modal>
    
    <!-- Modal para edição de usuário -->
    <x-modal name="edit-user-modal" :show="$errors->userEdit->isNotEmpty()" focusable>
        <div x-data="{ 
                userId: '{{ old('user_id') }}',
                userName: '{{ old('name') }}',
                userEmail: '{{ old('email') }}',
                userRole: '{{ old('role') }}'
             }"
             x-init="
                // Se não houver valores old (quando não é um erro de validação),
                // inicializa com valores vazios para receber novos dados
                if (!userId) {
                    userId = '';
                    userName = '';
                    userEmail = '';
                    userRole = '';
                }
             "
             x-on:set-user-data.window="
                // Atualiza os valores do formulário com os dados do usuário
                userId = $event.detail.id;
                userName = $event.detail.name;
                userEmail = $event.detail.email;
                userRole = $event.detail.role;
                
                // Atualizar os campos do formulário
                setTimeout(() => {
                    document.getElementById('edit-user-id').value = userId;
                    document.getElementById('edit-name').value = userName;
                    document.getElementById('edit-email').value = userEmail;
                    document.getElementById('edit-role').value = userRole;
                }, 50);
             ">
            @include('user-management.partials.edit-user-form')
        </div>
    </x-modal>
</x-app-layout>