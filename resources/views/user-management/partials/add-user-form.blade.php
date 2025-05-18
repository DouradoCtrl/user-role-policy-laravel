<form method="POST" class="p-6" action="{{ route('register') }}">
    @csrf
    
    <!-- Campo oculto para identificar que a requisição vem do painel admin -->
    <input type="hidden" name="from_admin_panel" value="1">

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Nome')" />
        <x-text-input id="add-name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
        <x-input-error :messages="$errors->userCreate->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="add-email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        <x-input-error :messages="$errors->userCreate->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Senha')" />
        <x-text-input id="add-password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required />
        <x-input-error :messages="$errors->userCreate->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
        <x-text-input id="add-password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required />
        <x-input-error :messages="$errors->userCreate->get('password_confirmation')" class="mt-2" />
    </div>

    <!-- Permissão -->
    <div class="mt-4">
        <x-input-label for="role" :value="__('Permissão')" />
        <select id="add-role" name="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
            <option value="">Selecione uma permissão</option>
            <option value="Administrador" {{ old('role') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
            <option value="Estoque" {{ old('role') == 'Estoque' ? 'selected' : '' }}>Estoque</option>
            <option value="Atendente" {{ old('role') == 'Atendente' ? 'selected' : '' }}>Atendente</option>
        </select>
        <x-input-error :messages="$errors->userCreate->get('role')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-6">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancelar') }}
        </x-secondary-button>
        <x-primary-button class="ms-3">
            {{ __('Cadastrar') }}
        </x-primary-button>
    </div>
</form>
