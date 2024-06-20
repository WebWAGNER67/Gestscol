<header class="relative flex justify-between w-full p-4 bg-white dark:bg-black bg-opacity-10 dark:bg-opacity-20 lg:rounded-tr-xl lg:rounded-none rounded-xl h-fit">
    <ul>
        <li class="flex items-center justify-center w-12 h-12 cursor-pointer lg:hidden" id="menu_open">
            <svg width="26" height="22" viewBox="0 0 26 22" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path d="M1.30371 1.92932H24.5952" stroke="white" stroke-width="1.94096" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M1.30371 10.9872H24.5952" stroke="white" stroke-width="1.94096" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M1.30371 20.0449H24.5952" stroke="white" stroke-width="1.94096" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </li>
    </ul>
    <ul class="flex justify-end gap-3">
        <li class="flex items-center justify-center w-12 h-12 cursor-pointer" id="moon">
            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path d="M3.5 12.2941C3.5 17.2647 7.52944 21.2941 12.5 21.2941C16.3527 21.2941 19.6399 18.8733 20.9237 15.4698C20.9237 15.4698 14.5 15 12 12.5C9.51408 10.0141 9 4 9 4C5.76806 5.36551 3.5 8.56494 3.5 12.2941Z" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
            </svg>
        </li>
        <li class="flex items-center justify-center w-12 h-12 cursor-pointer" id="sun">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path d="M12 1L12 3" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M23 12L21 12" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M19.7781 19.7781L18.4817 18.4818" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M4.22144 19.7783L5.5178 18.4819" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M12 21L12 23" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M3 12L1 12" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M5.51807 5.51819L4.2217 4.22183" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M18.4814 5.51819L19.7778 4.22183" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <circle cx="12" cy="12" r="6" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
            </svg>
        </li>
        <li class="flex items-center justify-center w-12 h-12 cursor-pointer">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24.7306 24.6967C22.2572 27.1704 19.0015 28.3682 15.7661 28.2983C11.3725 28.2033 3.6665 28.2723 3.6665 28.2723L6.36694 23.9672C6.36694 23.9672 3.73076 20.0516 3.73076 16.006C3.72842 12.8559 4.92778 9.70657 7.33533 7.29955C12.1344 2.49866 19.9315 2.49866 24.7306 7.29831C29.5384 12.1066 29.5297 19.8971 24.7306 24.6967Z" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M11.0862 16.5077H10.9546" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M16.0652 16.5079H15.9336" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M21.0442 16.5077H20.9126" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
            </svg>
        </li>
        <li class="relative flex items-center justify-center w-12 h-12 cursor-pointer">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="https://www.w3.org/2000/svg">
                <path d="M7.7493 11.917C7.7493 7.36049 11.4431 3.66667 15.9997 3.66667C20.5562 3.66667 24.25 7.36049 24.25 11.917V18.0245L26.4002 23.8096H5.59912L7.7493 18.0245V11.917Z" stroke="white" stroke-width="1.5"/>
                <path d="M20.2233 23.8099V24.1112C20.2233 26.4431 18.3329 28.3335 16.001 28.3335C13.6692 28.3335 11.7788 26.4431 11.7788 24.1112V23.8099" stroke="white" stroke-width="1.5"/>
            </svg>
            <span class="absolute bg-[#9451E9] w-2 h-2 rounded-full top-2 right-3">
            </span>
        </li>
        <li class="flex items-center justify-center w-12 h-12 overflow-hidden bg-white rounded-full cursor-pointer dark:bg-black" id="profil_button">
            @if (Auth::user()->image != null)
                <img src="{{ Auth::user()->image }}" alt="" class="object-cover w-full h-full">
            @else
                <img src="{{ asset('img/profil-min.png') }}" alt="" class="w-full h-full">
            @endif
            {{-- <img src="https://gestscol.mydevosux.fr/img/profil-min.png" alt="" class="w-full h-full"> --}}
        </li>
    </ul>

    <ul class="hidden flex-col gap-1 md:w-80 w-full md:h-fit h-screen md:rounded-xl absolute md:right-10 right-0 md:top-16 top-0 bg-white dark:bg-black md:bg-opacity-30 dark:md:bg-opacity-50 p-3 shadow-[0_8px_16px_0px_rgba(0,0,0,0.24)] backdrop-blur-sm z-10" id="profil_menu">
        <li class="absolute flex items-center justify-center w-8 h-8 bg-white cursor-pointer md:hidden rounded-xl dark:bg-black bg-opacity-20 dark:bg-opacity-20 top-2 right-2 hover:bg-opacity-50 dark:hover:bg-opacity-50" id="profil_close">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="https://www.w3.org/2000/svg" id="dark_svg">
                <path d="M13.9997 1.59778L1.60962 13.9878" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M14 13.9957L1.59961 1.59277" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
            </svg>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="black" xmlns="https://www.w3.org/2000/svg" id="light_svg">
                <path d="M13.9997 1.59778L1.60962 13.9878" stroke="black" stroke-width="1.5" stroke-linecap="square"/>
                <path d="M14 13.9957L1.59961 1.59277" stroke="black" stroke-width="1.5" stroke-linecap="square"/>
            </svg>
        </li>
        <li class="p-3 font-bold text-center text-white border-b">{{ Auth::user()->name }}</li>
        <x-dropdown-link :href="route('profile.show')">
            {{ __('Profile') }}
        </x-dropdown-link>

        <x-logout-form>
            {{ __('Déconnexion') }}
        </x-logout-form>
    </ul>
</header>
