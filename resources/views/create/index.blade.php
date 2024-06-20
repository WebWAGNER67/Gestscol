<x-home-layout>
    {{-- afficher les groups diplomes et parcours --}}
    <div class="flex flex-col gap-3">
        <h2 class="text-4xl font-semibold text-white">Création</h2>
    </div>
    <div class="grid grid-cols-1 gap-3" >
        <div class="flex flex-col justify-between gap-6 p-3 bg-white h-fit dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
            <div>
                <h3 class="text-2xl font-semibold text-white">Groupes</h3>
                <span class="text-gray-300">Voici tous les groupes</span>
            </div>
            <div class="text-left text-gray-400">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Label</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr class="border-y">
                                <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">{{$group->label}}</td>
                                <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">{{ $group->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('create.param', 'group') }}" class="px-5 py-2 text-white bg-white rounded-full dark:bg-black bg-opacity-30 dark:bg-opacity-30 dark:hover:bg-opacity-60 w-fit">En créer un</a>
        </div>
        <div class="flex flex-col justify-between gap-6 p-3 bg-white h-fit dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
            <div>
                <h3 class="text-2xl font-semibold text-white">Diplomes</h3>
                <span class="text-gray-300">Voici tous les diplomes</span>
            </div>
            <div class="text-left text-gray-400">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Titre</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Code</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Année</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diplomes as $diplome)
                            <tr class="border-y">
                                <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">{{$diplome->title}}</td>
                                <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">{{ $diplome->code }}</td>
                                <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">{{ $diplome->annee }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('create.param', 'diplome') }}" class="px-5 py-2 text-white bg-white rounded-full dark:bg-black bg-opacity-30 dark:bg-opacity-30 dark:hover:bg-opacity-60 w-fit">En créer un</a>
        </div>
        <div class="flex flex-col justify-between gap-6 p-3 bg-white h-fit dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
            <div>
                <h3 class="text-2xl font-semibold text-white">Parcours</h3>
                <span class="text-gray-300">Voici tous les parcours</span>
            </div>
            <div class="text-left text-gray-400">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Label</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parcours as $parcour)
                            <tr class="border-y">
                                <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">{{$parcour->label}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('create.param', 'parcour') }}" class="px-5 py-2 text-white bg-white rounded-full dark:bg-black bg-opacity-30 dark:bg-opacity-30 dark:hover:bg-opacity-60 w-fit">En créer un</a>
        </div>
    </div>

</x-home-layout>
