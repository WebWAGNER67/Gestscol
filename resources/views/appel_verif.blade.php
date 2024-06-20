<x-home-layout>
    <div class="flex flex-col gap-3" id="content">
        <div class="flex justify-between">
            <h2 class="text-4xl font-semibold text-white">Vérification de l'appel</h2>
        </div>
        <div class="flex flex-col gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <form action="{{ route('appel.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="idcour" value="{{$idcour}}">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Nom Prénom</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Promo</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white" id="present-count2">0 élèves présents</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Groupe</th>
                                </tr>
                            </thead>
                            <tbody id="users_list_appel">
                                @foreach ($users as $user)
                                    @php
                                        // petits caractères
                                        $username = strtolower($user->prenom . '_' . $user->nom);
                                    @endphp
                                    <tr class="border-y">
                                        <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-11 w-11">
                                                    <img class="rounded-full h-11 w-11" src="https://gestscol.mydevosux.fr/img/profil-min.png" alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-medium text-white">{{$user->prenom}} {{$user->nom}}</div>
                                                    <div class="mt-1 text-gray-400">{{$user->email}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">
                                            <div class="text-white">{{$user->diplome->code}}</div>
                                        </td>
                                        <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">
                                            <div class="checkbox-container">
                                                <input type="checkbox" id="{{ "present_".$username }}" name="{{"present_".$username}}" class="custom-checkbox present-checkbox2" @if ($user->presence) checked @endif>
                                                <label for="{{ "present_".$username }}" class="checkbox-label"></label>
                                            </div>
                                        </td>
                                        <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">{{$user->group->label}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button id="submit_button" type="submit" class="flex gap-3 mt-3 text-white cursor-pointer w-fit hover:bg-black dark:hover:bg-white hover:bg-opacity-20 dark:hover:bg-opacity-20 rounded-xl"><span class="flex w-full gap-3 p-3">Valider la liste</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            updatePresentCount();

            document.querySelectorAll('.present-checkbox2').forEach(function (checkbox) {
                checkbox.addEventListener('change', updatePresentCount);
            });


            function updatePresentCount() {
                const presentCount = document.querySelectorAll('.present-checkbox2:checked').length;
                document.getElementById('present-count2').textContent = presentCount + " élèves présents";
            }
        });
    </script>
</x-home-layout>
