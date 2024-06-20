<x-home-layout>
    <div class="flex flex-col gap-3">
        <h2 class="text-4xl font-semibold text-white">Créer un Parcours</h2>
        <div class="p-4 px-6 bg-white shadow dark:bg-black bg-opacity-20 dark:bg-opacity-20 sm:rounded-lg">
            <form class="space-y-6" action="{{ route('create.parcour.store') }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="label" :value="__('Nom du Parcours')" />
                    <x-text-input id="label" name="label" type="text" placeholder="DW" class="block w-full mt-1" />
                </div>

                <div>
                    <x-primary-button>{{ __('Ajouter le parcours') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-home-layout>
