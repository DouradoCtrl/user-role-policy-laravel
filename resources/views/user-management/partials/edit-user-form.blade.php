<form method="POST" class="p-6" action="{{ route('user.update') }}">
    @csrf
    @method('PUT')
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Editar Usuário') }}
    </h2>
    <p class="mt-1 text-sm text-gray-600">
        {{ __('Atualize as informações do usuário abaixo.') }}
    </p>

    <!-- Campo input hidden para o ID do usuário -->
    <input type="hidden" name="user_id" id="edit-user-id" value="{{ old('user_id') }}">

    <!-- Nome -->
    <div class="mt-6">
        <x-input-label for="name" value="{{ __('Nome') }}" />
        <x-text-input
            id="edit-name"
            name="name"
            type="text"
            class="mt-1 block w-full"
            :value="old('name')"
            required
        />
        <x-input-error :messages="$errors->userEdit->get('name')" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label for="email" value="{{ __('Email') }}" />
        <x-text-input
            id="edit-email"
            name="email"
            type="email"
            class="mt-1 block w-full"
            :value="old('email')"
            required
        />
        <x-input-error :messages="$errors->userEdit->get('email')" class="mt-2" />
    </div>

    <!-- Permissão/Role -->
    <div class="mt-4">
        <x-input-label for="role" value="{{ __('Permissão') }}" />
        <select 
            id="edit-role" 
            name="role" 
            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            required
        >
            <option value="">Selecione uma permissão</option>
            <option value="Administrador" {{ old('role') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
            <option value="Estoque" {{ old('role') == 'Estoque' ? 'selected' : '' }}>Estoque</option>
            <option value="Atendente" {{ old('role') == 'Atendente' ? 'selected' : '' }}>Atendente</option>
        </select>
        <x-input-error :messages="$errors->userEdit->get('role')" class="mt-2" />
    </div>

    <!-- Senha do usuário logado para confirmar a alteração -->
    <div class="mt-6">
        <x-input-label for="password" value="{{ __('Sua senha para confirmar as alterações') }}" />
        <x-text-input
            id="password"
            name="password"
            type="password"
            class="mt-1 block w-full"
            placeholder="{{ __('Digite sua senha para confirmar') }}"
            required
        />
        <x-input-error :messages="$errors->userEdit->get('password')" class="mt-2" />
    </div>

    <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancelar') }}
        </x-secondary-button>
        <x-primary-button class="ms-3">
            {{ __('Salvar alterações') }}
        </x-primary-button>
    </div>
</form>
