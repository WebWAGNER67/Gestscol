<nav class="relative hidden w-screen p-8 overflow-auto bg-white dark:bg-black dark:bg-opacity-20 bg-opacity-10 rounded-l-xl lg:w-80 lg:block" id="menu_navbar">
    <div class="absolute flex items-center justify-center w-8 h-8 bg-white cursor-pointer lg:hidden rounded-xl dark:bg-black bg-opacity-20 dark:bg-opacity-20 top-2 right-2 hover:bg-opacity-50 dark:hover:bg-opacity-50" id="menu_close">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="https://www.w3.org/2000/svg">
            <path d="M13.9997 1.59778L1.60962 13.9878" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
            <path d="M14 13.9957L1.59961 1.59277" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
        </svg>
    </div>

    <h1><a href="{{ route('home') }}" class="flex flex-col items-center gap-1 text-2xl font-bold text-white" id="first-menu-item"><img src="{{ asset('img/logo.jpg') }}" alt="" class="transition-all duration-200 ease-out rounded-xl hover:scale-95"><span>GestScol V2</span></a></h1>

    <ul class="flex flex-col items-center w-full gap-2 my-5">
        <x-nav-list :href="route('home')" :active="request()->routeIs('home')" >
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path d="M1.93359 11.3755L11.9998 2.75L22.0659 11.3755" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M4.09277 10.1592V21.2501H19.9103V10.1592" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M11.9998 12.7048L11.9998 16.1132" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
            </svg>
            {{ __('Accueil') }}
        </x-nav-list>
        @can('viewGroupNav', \App\Models\User::class)
            <x-nav-list :href="route('group')" :active="request()->routeIs('group')" >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M9.51408 14.7069C12.6415 14.6989 15.3007 16.1349 16.2782 19.226C14.308 20.4271 11.9889 20.8896 9.51408 20.8836C7.03921 20.8896 4.72016 20.4271 2.75 19.226C3.72857 16.1316 6.38327 14.6989 9.51408 14.7069Z" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    <path d="M16.0852 18.2325C17.975 18.2371 19.7458 17.8838 21.2502 16.9667C20.5039 14.6064 18.4733 13.5099 16.0852 13.516C14.5809 13.5122 13.2205 13.9439 12.2324 14.8533" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    <circle cx="9.51421" cy="7.35259" r="4.23687" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    <path d="M13.7143 5.67014C14.3046 5.05148 15.1371 4.66602 16.0597 4.66602C17.8498 4.66602 19.301 6.11718 19.301 7.90729C19.301 9.69739 17.8498 11.1486 16.0597 11.1486C14.9654 11.1486 13.9978 10.6063 13.4109 9.77575" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                </svg>
                {{ __('Groupe') }}
            </x-nav-list>
        @endcan
        @can('viewPromoNav', \App\Models\User::class)
            <x-nav-list :href="route('promo')" :active="request()->routeIs('promo')" >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M9.51408 14.7069C12.6415 14.6989 15.3007 16.1349 16.2782 19.226C14.308 20.4271 11.9889 20.8896 9.51408 20.8836C7.03921 20.8896 4.72016 20.4271 2.75 19.226C3.72857 16.1316 6.38327 14.6989 9.51408 14.7069Z" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    <path d="M16.0852 18.2325C17.975 18.2371 19.7458 17.8838 21.2502 16.9667C20.5039 14.6064 18.4733 13.5099 16.0852 13.516C14.5809 13.5122 13.2205 13.9439 12.2324 14.8533" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    <circle cx="9.51421" cy="7.35259" r="4.23687" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    <path d="M13.7143 5.67014C14.3046 5.05148 15.1371 4.66602 16.0597 4.66602C17.8498 4.66602 19.301 6.11718 19.301 7.90729C19.301 9.69739 17.8498 11.1486 16.0597 11.1486C14.9654 11.1486 13.9978 10.6063 13.4109 9.77575" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                </svg>
                {{ __('Promo') }}
            </x-nav-list>
        @endcan
        @can('viewAbsencesNav', \App\Models\User::class)
            <x-nav-list :href="route('absences')" :active="request()->routeIs('absences')" >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M4.875 23.2506H3.375C3.07663 23.2506 2.79048 23.1321 2.5795 22.9211C2.36853 22.7101 2.25 22.424 2.25 22.1256V15.3756C2.25 15.0772 2.36853 14.7911 2.5795 14.5801C2.79048 14.3691 3.07663 14.2506 3.375 14.2506H4.875C5.17337 14.2506 5.45952 14.3691 5.67049 14.5801C5.88147 14.7911 6 15.0772 6 15.3756V22.1256C6 22.424 5.88147 22.7101 5.67049 22.9211C5.45952 23.1321 5.17337 23.2506 4.875 23.2506V23.2506Z" fill="white"/>
                    <path d="M15.375 23.2493H13.875C13.5766 23.2493 13.2905 23.1307 13.0795 22.9198C12.8685 22.7088 12.75 22.4226 12.75 22.1243V10.8743C12.75 10.5759 12.8685 10.2898 13.0795 10.0788C13.2905 9.86779 13.5766 9.74927 13.875 9.74927H15.375C15.6734 9.74927 15.9595 9.86779 16.1705 10.0788C16.3815 10.2898 16.5 10.5759 16.5 10.8743V22.1243C16.5 22.4226 16.3815 22.7088 16.1705 22.9198C15.9595 23.1307 15.6734 23.2493 15.375 23.2493V23.2493Z" fill="white"/>
                    <path d="M20.625 23.2499H19.125C18.8266 23.2499 18.5405 23.1313 18.3295 22.9204C18.1185 22.7094 18 22.4232 18 22.1249V5.62488C18 5.32651 18.1185 5.04036 18.3295 4.82938C18.5405 4.6184 18.8266 4.49988 19.125 4.49988H20.625C20.9234 4.49988 21.2095 4.6184 21.4205 4.82938C21.6315 5.04036 21.75 5.32651 21.75 5.62488V22.1249C21.75 22.4232 21.6315 22.7094 21.4205 22.9204C21.2095 23.1313 20.9234 23.2499 20.625 23.2499V23.2499Z" fill="white"/>
                    <path d="M10.125 23.2495H8.625C8.32663 23.2495 8.04048 23.131 7.8295 22.92C7.61853 22.709 7.5 22.4229 7.5 22.1245V1.87451C7.5 1.57614 7.61853 1.28999 7.8295 1.07902C8.04048 0.868038 8.32663 0.749512 8.625 0.749512H10.125C10.4234 0.749512 10.7095 0.868038 10.9205 1.07902C11.1315 1.28999 11.25 1.57614 11.25 1.87451V22.1245C11.25 22.4229 11.1315 22.709 10.9205 22.92C10.7095 23.131 10.4234 23.2495 10.125 23.2495V23.2495Z" fill="white"/>
                </svg>
                {{ __('Absences') }}
            </x-nav-list>
        @endcan
        @can('viewTrombiNav', \App\Models\User::class)
            <x-nav-list :href="route('trombinoscope')" :active="request()->routeIs('trombinoscope')" >
                <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M1 19.8672V8.36716C1 7.09691 2.02974 6.06716 3.3 6.06716H3.875C4.59894 6.06716 5.28063 5.72631 5.715 5.14716L8.268 1.74316C8.39831 1.56942 8.60282 1.46716 8.82 1.46716H16.18C16.3972 1.46716 16.6017 1.56942 16.732 1.74316L19.285 5.14716C19.7194 5.72631 20.4011 6.06716 21.125 6.06716H21.7C22.9703 6.06716 24 7.09691 24 8.36716V19.8672C24 21.1375 22.9703 22.1672 21.7 22.1672H3.3C2.02974 22.1672 1 21.1375 1 19.8672Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.4999 17.5672C15.0404 17.5672 17.0999 15.5077 17.0999 12.9672C17.0999 10.4267 15.0404 8.36719 12.4999 8.36719C9.95939 8.36719 7.8999 10.4267 7.8999 12.9672C7.8999 15.5077 9.95939 17.5672 12.4999 17.5672Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ __('Trombinoscopes') }}
            </x-nav-list>
        @endcan
        @can('viewImportForm', \App\Models\User::class)
            <x-nav-list :href="route('users.index')" :active="request()->routeIs('users.index')" >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M9.51408 14.7069C12.6415 14.6989 15.3007 16.1349 16.2782 19.226C14.308 20.4271 11.9889 20.8896 9.51408 20.8836C7.03921 20.8896 4.72016 20.4271 2.75 19.226C3.72857 16.1316 6.38327 14.6989 9.51408 14.7069Z" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    <path d="M16.0852 18.2325C17.975 18.2371 19.7458 17.8838 21.2502 16.9667C20.5039 14.6064 18.4733 13.5099 16.0852 13.516C14.5809 13.5122 13.2205 13.9439 12.2324 14.8533" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    <circle cx="9.51421" cy="7.35259" r="4.23687" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    <path d="M13.7143 5.67014C14.3046 5.05148 15.1371 4.66602 16.0597 4.66602C17.8498 4.66602 19.301 6.11718 19.301 7.90729C19.301 9.69739 17.8498 11.1486 16.0597 11.1486C14.9654 11.1486 13.9978 10.6063 13.4109 9.77575" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                </svg>
                {{ __('Etudiants') }}
            </x-nav-list>
        @endcan
        @can('viewAllAbsences', \App\Models\User::class)
            <x-nav-list :href="route('absences')" :active="request()->routeIs('absences')" >
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M4.875 23.2506H3.375C3.07663 23.2506 2.79048 23.1321 2.5795 22.9211C2.36853 22.7101 2.25 22.424 2.25 22.1256V15.3756C2.25 15.0772 2.36853 14.7911 2.5795 14.5801C2.79048 14.3691 3.07663 14.2506 3.375 14.2506H4.875C5.17337 14.2506 5.45952 14.3691 5.67049 14.5801C5.88147 14.7911 6 15.0772 6 15.3756V22.1256C6 22.424 5.88147 22.7101 5.67049 22.9211C5.45952 23.1321 5.17337 23.2506 4.875 23.2506V23.2506Z" fill="white"/>
                    <path d="M15.375 23.2493H13.875C13.5766 23.2493 13.2905 23.1307 13.0795 22.9198C12.8685 22.7088 12.75 22.4226 12.75 22.1243V10.8743C12.75 10.5759 12.8685 10.2898 13.0795 10.0788C13.2905 9.86779 13.5766 9.74927 13.875 9.74927H15.375C15.6734 9.74927 15.9595 9.86779 16.1705 10.0788C16.3815 10.2898 16.5 10.5759 16.5 10.8743V22.1243C16.5 22.4226 16.3815 22.7088 16.1705 22.9198C15.9595 23.1307 15.6734 23.2493 15.375 23.2493V23.2493Z" fill="white"/>
                    <path d="M20.625 23.2499H19.125C18.8266 23.2499 18.5405 23.1313 18.3295 22.9204C18.1185 22.7094 18 22.4232 18 22.1249V5.62488C18 5.32651 18.1185 5.04036 18.3295 4.82938C18.5405 4.6184 18.8266 4.49988 19.125 4.49988H20.625C20.9234 4.49988 21.2095 4.6184 21.4205 4.82938C21.6315 5.04036 21.75 5.32651 21.75 5.62488V22.1249C21.75 22.4232 21.6315 22.7094 21.4205 22.9204C21.2095 23.1313 20.9234 23.2499 20.625 23.2499V23.2499Z" fill="white"/>
                    <path d="M10.125 23.2495H8.625C8.32663 23.2495 8.04048 23.131 7.8295 22.92C7.61853 22.709 7.5 22.4229 7.5 22.1245V1.87451C7.5 1.57614 7.61853 1.28999 7.8295 1.07902C8.04048 0.868038 8.32663 0.749512 8.625 0.749512H10.125C10.4234 0.749512 10.7095 0.868038 10.9205 1.07902C11.1315 1.28999 11.25 1.57614 11.25 1.87451V22.1245C11.25 22.4229 11.1315 22.709 10.9205 22.92C10.7095 23.131 10.4234 23.2495 10.125 23.2495V23.2495Z" fill="white"/>
                </svg>
                {{ __('Absences') }}
            </x-nav-list>
        @endcan
        @can('createAll', \App\Models\User::class)
            <x-nav-list :href="route('create.index')" :active="request()->routeIs('create.*')" >
                <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.48828 13.966H13.2883M13.2883 13.966H18.0883M13.2883 13.966V9.16602M13.2883 13.966V18.766" stroke="white" stroke-width="2.00593" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.2883 25.9661C19.9157 25.9661 25.2883 20.5934 25.2883 13.9661C25.2883 7.33864 19.9157 1.96606 13.2883 1.96606C6.66091 1.96606 1.28833 7.33864 1.28833 13.9661C1.28833 20.5934 6.66091 25.9661 13.2883 25.9661Z" stroke="white" stroke-width="2.00593" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ __('Création') }}
            </x-nav-list>
        @endcan
        @can('viewQRCode', \App\Models\User::class)
            <li>
                <div class="hidden w-full h-full p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl" id="qrcode-container">
                    <img id="qrcode-img" src="" alt="{{ __('QR Code') }}">
                </div>
            </li>
        @endcan
    </ul>
</nav>
