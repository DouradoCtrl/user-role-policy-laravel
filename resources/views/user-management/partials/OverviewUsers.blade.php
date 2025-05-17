<section>
    <header>
        <div class="flex justify-between">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Usuários do sistema') }}
            </h2>
            <a href="{{ route('register') }}">
                <x-primary-button class="flex items-center">
                    <!-- <x-heroicon-o-plus class="h-4 w-4" /> -->
                    {{ __('Adicionar') }}
                </x-primary-button>
            </a>
        </div>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Gerencie os usuários cadastrados.") }}
        </p>
    </header>

    <div class="rounded-lg border mt-6">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">E-mail</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">Cargo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 ">{{ $user->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 ">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 ">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 ">{{ $user->role }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 ">
                            <div class="flex gap-2">
                                <x-primary-button class="px-4 py-2 flex items-center" title="Editar">
                                    <x-heroicon-o-pencil class="h-4 w-4" />
                                </x-primary-button>
                                <x-danger-button
                                    x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                                    class="px-4 py-2 flex items-center"
                                    title="Excluir"
                                >
                                    <x-heroicon-o-trash class="h-4 w-4" />
                                </x-danger-button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-2">
        {{ $users->links() }}
    </div>

</section>