<x-home-layout>
    <div class="flex flex-col gap-3" id="content">
        <h2 class="font-semibold text-center text-white text-7xl">Erreur 404</h2>
        <p class="text-2xl text-center text-white">
            La page que vous cherchez n'existe pas
        </p>

        <div class="flex justify-center gap-3">
            <a href="{{ route('home') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Retour à l'accueil
            </a>
            <a href="{{ url()->previous() }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Retour à la page précédente
            </a>
        </div>
    </div>
</x-home-layout>
