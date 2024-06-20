<x-home-layout>
    <div class="flex flex-col gap-3" id="content">
        <div class="flex justify-between">
            <h2 class="text-4xl font-semibold text-white">Faire l'appel</h2>
            <button class="p-3 text-xl text-white bg-white font-semi-bold dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl" id="generate-qrcode" >Générer un QR Code</button>
        </div>
        <div class="flex flex-col gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    @if ($present_fait)
                        <form action="{{ route('appel.update') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="idcour" value="{{$idcour}}">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Nom Prénom</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Promo</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white" id="present-count">0 élèves présents</th>
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
                                                @if ($user->present)
                                                    <div class="checkbox-container">
                                                        <input type="checkbox" name="{{"present_".$username}}" class="custom-checkbox present-checkbox" checked>
                                                        <label class="checkbox-label"></label>
                                                    </div>
                                                @else
                                                    <input type="hidden" name="idabsence" value="{{$user->absence_id}}">
                                                    <input type="time" name="{{"retard_".$username}}" value="{{ $user->retard_time }}">
                                                @endif
                                            </td>
                                            <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">{{$user->group->label}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button id="submit_button" type="submit" class="flex gap-3 mt-3 text-white cursor-pointer w-fit hover:bg-black dark:hover:bg-white hover:bg-opacity-20 dark:hover:bg-opacity-20 rounded-xl"><span class="flex w-full gap-3 p-3">Valider la liste</span></button>
                        </form>
                    @else
                        <form action="{{ route('appel.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="idcour" value="{{$idcour}}">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Nom Prénom</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Promo</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white" id="present-count">0 élèves présents</th>
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
                                                    <input type="checkbox" id="{{ "present_".$username }}" name="{{"present_".$username}}" class="custom-checkbox present-checkbox">
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
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Gérer le clic sur le bouton "Générer un QR code"
            document
                .getElementById("generate-qrcode")
                .addEventListener("click", function () {
                    const qrcodeContainer = document.getElementById("qrcode-container");
                    fetch("{{ route('qrcode', $idcour) }}")
                        .then((response) => response.text())
                        .then((qrcodeSvg) => {
                            // Convertir le code SVG en une URL de données (Data URL)
                            const qrcodeDataUrl =
                                "data:image/svg+xml," + encodeURIComponent(qrcodeSvg);

                            // Mettre à jour la balise <img> avec l'URL de données
                            document.getElementById("qrcode-img").src = qrcodeDataUrl;
                            qrcodeContainer.classList.toggle("hidden");

                            // Actualiser la liste des utilisateurs uniquement si le QR code est affiché
                            if (!qrcodeContainer.classList.contains("hidden")) {
                                updateUsersList();
                            }
                        });
                });

            // actualiser la liste des users toutes les 30 secondes seulement si le QR code est affiché
            function updateUsersList() {
                fetch("{{ route('users', $idcour) }}")
                    .then((response) => response.json())
                    .then((users) => {
                        const tbody = document.getElementById("users_list_appel");
                        tbody.innerHTML = "";

                        users.forEach((user) => {
                            // username lowercase
                            const username = user.prenom.toLowerCase() + "_" + user.nom.toLowerCase();

                            const tr = document.createElement("tr");
                            tr.classList.add("border-y");

                            const td1 = document.createElement("td");
                            td1.classList.add("py-5", "pl-4", "pr-3", "text-sm", "whitespace-nowrap", "sm:pl-0");
                            const div1 = document.createElement("div");
                            div1.classList.add("flex", "items-center");
                            const div2 = document.createElement("div");
                            div2.classList.add("flex-shrink-0", "h-11", "w-11");
                            const img = document.createElement("img");
                            img.classList.add("rounded-full", "h-11", "w-11");
                            img.src = "https://gestscol.mydevosux.fr/img/profil-min.png";
                            img.alt = "";
                            const div3 = document.createElement("div");
                            div3.classList.add("ml-4");
                            const div4 = document.createElement("div");
                            div4.classList.add("font-medium", "text-white");
                            div4.textContent = user.prenom + " " + user.nom;
                            const div5 = document.createElement("div");
                            div5.classList.add("mt-1", "text-gray-400");
                            div5.textContent = user.email;
                            div3.appendChild(div4);
                            div3.appendChild(div5);
                            div2.appendChild(img);
                            div1.appendChild(div2);
                            div1.appendChild(div3);
                            td1.appendChild(div1);

                            const td2 = document.createElement("td");
                            td2.classList.add("px-3", "py-5", "text-sm", "text-gray-400", "whitespace-nowrap");
                            const div6 = document.createElement("div");
                            div6.classList.add("text-white");
                            div6.textContent = "{{$users[0]->diplome->code}}";
                            td2.appendChild(div6);

                            const td3 = document.createElement("td");
                            td3.classList.add("px-3", "py-5", "text-sm", "text-gray-400", "whitespace-nowrap");

                            const div7 = document.createElement("div");
                            div7.classList.add("checkbox-container");
                            const input = document.createElement("input");
                            input.setAttribute("type", "checkbox");
                            input.setAttribute("name", "present_" + username);
                            input.classList.add("custom-checkbox", "present-checkbox");
                            if (user.presence) {
                                input.setAttribute("checked", "checked");
                            }
                            const label = document.createElement("label");
                            label.classList.add("checkbox-label", "cursor-not-allowed");
                            div7.appendChild(input);
                            div7.appendChild(label);
                            td3.appendChild(div7);


                            const td4 = document.createElement("td");
                            td4.classList.add("px-3", "py-5", "text-sm", "text-gray-400", "whitespace-nowrap");
                            td4.textContent = "{{$users[0]->group->label}}";

                            tr.appendChild(td1);
                            tr.appendChild(td2);
                            tr.appendChild(td3);
                            tr.appendChild(td4);

                            tbody.appendChild(tr);
                        });

                        const input2 = document.createElement("input");
                        input2.setAttribute("type", "hidden");
                        input2.setAttribute("name", "generatedQRCode");
                        input2.setAttribute("value", "1");
                        tbody.appendChild(input2);
                    });
            }

            document.querySelectorAll('.present-checkbox').forEach(function (checkbox) {
                checkbox.addEventListener('change', updatePresentCount);
            });

            function updatePresentCount() {
                const presentCount = document.querySelectorAll('.present-checkbox:checked').length;
                document.getElementById('present-count').textContent = presentCount + " élèves présents";
            }

            updatePresentCount();

            const submit_button = document.getElementById('submit_button');
            const span_submit_button = submit_button.querySelector('span');

            // Actualiser la liste des utilisateurs toutes les secondes uniquement si le QR code est affiché
            setInterval(function () {
                const qrcodeContainer = document.getElementById("qrcode-container");
                if (!qrcodeContainer.classList.contains("hidden")) {
                    updateUsersList();
                    updatePresentCount();
                    if(generatedQRCode) {
                        span_submit_button.textContent = "Passer à la vérification";
                    }
                }
            }, 1000);
        });
    </script>
</x-home-layout>
