<form class="space-y-6" action="{{ route('password.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <x-input-label for="current_password" :value="__('Mot de passe actuel')" />
        <x-text-input id="current_password" name="current_password" type="password" class="block w-full mt-1" autocomplete="current-password" />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password" :value="__('Nouveau mot de passe')" />
        <x-text-input id="password" name="password" type="password" class="block w-full mt-1" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="password_confirmation" :value="__('Confirmer le nouveau mot de passe')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block w-full mt-1" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>

    <div>
        <x-primary-button>{{ __('Modifier le mot de passe') }}</x-primary-button>
        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="mt-5 text-lg text-center text-green-600 dark:text-green-400"
            >{{ __('Mot de passe modifié avec succès.') }}</p>
        @endif
    </div>
</form>
