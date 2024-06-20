<x-home-layout>

    <div class="flex flex-col gap-3">
        <h2 class="text-4xl font-semibold text-white">Mon Profil</h2>
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
            <div class="space-y-4">
                <div class="overflow-hidden bg-white rounded-xl dark:bg-black bg-opacity-20 dark:bg-opacity-20">
                    <div class="flex items-center justify-between px-4 py-2 bg-gradient-to-br from-blue-950 to-blue-900">
                        <h3 class="text-lg leading-tight text-white">Prénom</h3>
                    </div>
                    <div class="p-4">
                        <p class="text-white">
                            {{ Auth::user()->prenom }}
                        </p>
                    </div>
                </div>
                <div class="overflow-hidden bg-white rounded-xl dark:bg-black bg-opacity-20 dark:bg-opacity-20">
                    <div class="flex items-center justify-between px-4 py-2 bg-gradient-to-br from-blue-950 to-blue-900">
                        <h3 class="text-lg leading-tight text-white">Nom de Famille</h3>
                    </div>
                    <div class="p-4">
                        <p class="text-white">
                            {{ Auth::user()->nom }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <div class="overflow-hidden bg-white rounded-xl dark:bg-black bg-opacity-20 dark:bg-opacity-20">
                    <div class="flex items-center justify-between px-4 py-2 bg-gradient-to-br from-blue-950 to-blue-900">
                        <h3 class="text-lg leading-tight text-white">Image du Trombinoscope</h3>
                    </div>
                    <div class="flex justify-center p-4">
                        @if (Auth::user()->image != null)
                            <img src="{{ Auth::user()->image }}" alt="" class="object-cover w-1/4">
                        @else
                            <img src="https://gestscol.mydevosux.fr/img/profil-min.png" alt="" class="w-1/4">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-between gap-4 lg:flex-row">
            <div class="w-full overflow-hidden bg-white rounded-xl dark:bg-black bg-opacity-20 dark:bg-opacity-20">
                <div class="flex items-center justify-between px-4 py-2 bg-gradient-to-br from-blue-950 to-blue-900">
                    <h3 class="text-lg leading-tight text-white">Adresse e-mail</h3>
                </div>
                <div class="px-4 py-3">
                    <p class="py-1 text-white">
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>
            <div class="w-full overflow-hidden bg-white rounded-xl dark:bg-black bg-opacity-20 dark:bg-opacity-20">
                <div class="flex items-center justify-between px-4 py-2 bg-gradient-to-br from-blue-950 to-blue-900">
                    <h3 class="text-lg leading-tight text-white">Mot de passe</h3>
                </div>
                <div class="flex flex-col justify-between w-full px-4 py-3 xl:flex-row lg:flex-col md:flex-row">
                    <p class="py-1 text-white">
                        *************
                    </p>
                    <a href="{{ route('profile.edit') }}" class="px-4 py-1 text-white rounded-xl bg-gradient-to-tl from-blue-950 to-blue-900 w-fit">Modifier le mot de passe</a>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
