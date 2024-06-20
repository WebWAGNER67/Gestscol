<x-home-layout>
    <div class="flex flex-col gap-3">
        <h2 class="text-4xl font-semibold text-white">Créer un Diplome</h2>
        <div class="p-4 px-6 bg-white shadow dark:bg-black bg-opacity-20 dark:bg-opacity-20 sm:rounded-lg">
            <form class="space-y-6" action="{{ route('create.diplome.store') }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="title" :value="__('Titre du Diplome')" />
                    <x-text-input id="title" name="title" type="text" placeholder="BUT Métiers du multimédia et de l'Internet" class="block w-full mt-1" />
                </div>

                <div>
                    <x-input-label for="code" :value="__('Nom du Diplome')" />
                    <x-text-input id="code" name="code" type="text" placeholder="MMI3" class="block w-full mt-1" />
                </div>

                <div>
                    <x-input-label for="annee" :value="__('Année')" />
                    <x-text-input id="annee" name="annee" type="text" placeholder="23_24" class="block w-full mt-1" />
                </div>

                <div>
                    <x-primary-button>{{ __('Ajouter le diplome') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-home-layout>
