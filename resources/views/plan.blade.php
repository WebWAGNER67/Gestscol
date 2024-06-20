<x-home-layout>
    <div class="flex flex-col gap-3" id="content">
        <h2 class="text-4xl font-semibold text-white">Plan du site</h2>
        <div class="flex flex-col gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
            <div class="flex flex-col w-full gap-3 md:flex-row">
                <ul class="flex flex-col gap-3 md:w-1/2">
                    <li>
                        <h3 class="text-2xl font-semibold text-white">Accueil</h3>
                        <ul class="ml-2">
                            <li>
                                <a href="{{ route('home') }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Accueil</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="text-2xl font-semibold text-white">Paramètres</h3>
                        <ul class="ml-2">
                            <li>
                                <a href="{{ route('profile.show') }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('profile.edit') }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Modifier le mot de passe</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="text-2xl font-semibold text-white">Elèves</h3>
                        <ul class="ml-2">
                            <li>
                                <a href="{{ route("group") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Mon groupe</a>
                            </li>
                            <li>
                                <a href="{{ route("promo") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Ma promo</a>
                            </li>
                            <li>
                                <a href="{{ route("home") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Justifier une absence</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="text-2xl font-semibold text-white">Profs</h3>
                        <ul class="ml-2">
                            <li>
                                <a href="{{ route("trombinoscope") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Trombinoscopes</a>
                            </li>
                            <li>
                                <a href="{{ route("home") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Faire l'appel</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="text-2xl font-semibold text-white">Administration</h3>
                        <ul class="ml-2">
                            <li>
                                <a href="{{ route("trombinoscope") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Trombinoscopes</a>
                            </li>
                            <li>
                                <a href="{{ route("home") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Gérer les absences</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="flex flex-col gap-3 md:w-1/2">
                    <li>
                        <h3 class="text-2xl font-semibold text-white">Infos</h3>
                        <ul class="ml-2">
                            <li>
                                <a href="{{ route('mentions') }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Mentions légales</a>
                            </li>
                            <li>
                                <a href="{{ route("politique_cookies") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Politique de gestion de cookies</a>
                            </li>
                            <li>
                                <a href="{{ route("cookies") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Gestion de cookies</a>
                            </li>
                            <li>
                                <a href="{{ route("plan") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Plan du site</a>
                            </li>
                            <li>
                                <a href="{{ route("accessibilite") }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Accessibilité</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="text-2xl font-semibold text-white">Authentification</h3>
                        <ul class="ml-2">
                            <li>
                                <a href="{{ route('login') }}" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500">Connexion</a>
                            </li>
                            <li>
                                <form method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout')}} " onclick="event.preventDefault(); this.closest('form').submit();" class="w-full text-gray-300 lg:w-2/3 hover:text-gray-500" >Déconnexion</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-home-layout>
