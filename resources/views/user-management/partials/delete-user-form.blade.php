<form method="POST" class="p-6" action="{{ route('user.destroy') }}">
    @csrf
    @method('delete')
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Você tem certeza de que deseja excluir essa conta? ') }}
    </h2>
    <p class="mt-1 text-sm text-gray-600">
        {{ __('Uma vez que essa conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Por favor, digite SUA SENHA para confirmar que você deseja excluir permanentemente esta conta.') }}
    </p>
    <div class="mt-6">
        <x-input-label for="password" value="{{ __('Sua senha') }}" />
        <x-text-input
            id="password"
            name="password"
            type="password"
            class="mt-1 block w-3/4"
            placeholder="{{ __('Digite sua senha para confirmar') }}"
            required
        />
        <!-- Campo hidden para manter o ID do usuário -->
        <input type="hidden" name="user_id" :value="userId">
        
        <!-- Debug info - pode remover em produção -->
        <p class="text-sm text-gray-600 mt-2">ID do usuário a ser excluído: <span x-text="userId || 'Nenhum ID definido'"></span></p>
        
        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
    </div>
    <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancelar') }}
        </x-secondary-button>
        <x-danger-button class="ms-3">
            {{ __('Excluir Conta') }}
        </x-danger-button>
    </div>
</form>
