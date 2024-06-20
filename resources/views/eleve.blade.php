<x-home-layout>
    <div class="flex flex-col gap-3" id="content">
        <div class="flex justify-between">
            <h2 class="text-4xl font-semibold text-white">{{ $content }}</h2>
            <button class="p-3 text-xl text-white bg-white font-semi-bold dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl" id="generate-qrcode" >Générer un QR Code</button>
        </div>
        <div class="flex flex-col gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Nom Prénom</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Promo</th>
                                <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-white text-center">Statut</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Groupe</th>
                            </tr>
                        </thead>
                        <tbody id="users_list_appel">
                            @foreach ($users as $user)
                                <tr class="border-y">
                                    <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                        <div class="flex flex-col justify-center">
                                            <div class="font-medium text-white">{{$user->prenom}} {{$user->nom}}</div>
                                            <div class="mt-1 text-gray-400">{{$user->email}}</div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">
                                        <div class="text-white">{{$user->diplome->code}}</div>
                                    </td>
                                    <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">
                                        <div class="text-center text-white">{{ $user->statut }}</div>
                                    </td>
                                    <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">{{$user->group->label}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-2 m-2" id="navigation_pagination">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const pagination = document.getElementById('navigation_pagination').children[0].children[1].children[0].children[0];
        pagination.classList.remove('text-gray-700');
        pagination.classList.add('text-white');
    </script>
</x-home-layout>
