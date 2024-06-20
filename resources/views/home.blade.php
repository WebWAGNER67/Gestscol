<x-home-layout>
    <div class="flex flex-col gap-3" id="content">
        <h2 class="text-4xl font-semibold text-white">Accueil</h2>
        @if (session('status'))
            <div class="p-3 text-white bg-green-500 ring-1 ring-green-700 rounded-xl">
                {{ session('status') }}
            </div>
        @endif
        @can('viewHome', \App\Models\User::class)
            @if (isset($currentEvent))
                <div class="grid items-center justify-center grid-cols-1 gap-3 lg:grid-cols-2">
                    <div class="flex flex-col gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-12 h-12 p-3 overflow-hidden bg-black rounded-full dark:bg-white bg-opacity-40 dark:bg-opacity-40">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                                        <path d="M3.76074 9.59898H20.248" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M16.1087 13.2115H16.1173" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M12.0045 13.2115H12.0131" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M7.89122 13.2115H7.89979" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M16.1087 16.8065H16.1173" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M12.0045 16.8065H12.0131" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M7.89122 16.8065H7.89979" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M15.7407 2.75V5.79399" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M8.26855 2.75V5.79399" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.3258 4.21069H3.67578V21.25H20.3258V4.21069Z" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white">{{ $currentEvent['@attributes']['name'] }}</h3>
                                    <span class="text-gray-300">
                                        @foreach ($nextEvent['resources']['resource'] as $event)
                                            @if( $event['@attributes']['category'] == 'classroom')
                                                Salle {{ $event['@attributes']['name'] }}
                                            @endif
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            <div>
                                <span class="flex items-center justify-center w-10 text-white bg-black rounded-full aspect-square dark:bg-white bg-opacity-30 dark:bg-opacity-30 md:hidden">A</span>
                                <span class="hidden px-5 py-2 text-white bg-black rounded-full md:block dark:bg-white bg-opacity-30 dark:bg-opacity-30 w-fit">Actuellement</span>
                            </div>
                        </div>
                        <p class="flex w-full gap-4 text-gray-300">
                            {{-- Description du cours (Prof / Groupe d'élève / temps du cours / ce qui est prévu) --}}
                            <span>
                                {{ $currentEvent['@attributes']['date'] }}
                            </span>
                            |
                            <span>
                                {{ formatTime($currentEvent['@attributes']['startHour']) }} - {{ formatTime($currentEvent['@attributes']['endHour']) }}
                            </span>
                            |
                            @foreach ($currentEvent['resources']['resource'] as $currentEvent)
                                @if ($currentEvent['@attributes']['category'] == "instructor")
                                    <span>
                                        {{ $currentEvent['@attributes']['name'] }}
                                    </span>
                                    |
                                @endif
                            @endforeach
                            <span>
                                {{ $user_connected->diplome->code }}
                            </span>
                        </p>
                    </div>
                    <div class="flex flex-col gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-12 h-12 p-3 overflow-hidden bg-black rounded-full dark:bg-white bg-opacity-40 dark:bg-opacity-40">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                                    <path d="M3.76074 9.59898H20.248" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    <path d="M16.1087 13.2115H16.1173" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    <path d="M12.0045 13.2115H12.0131" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    <path d="M7.89122 13.2115H7.89979" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    <path d="M16.1087 16.8065H16.1173" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    <path d="M12.0045 16.8065H12.0131" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    <path d="M7.89122 16.8065H7.89979" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    <path d="M15.7407 2.75V5.79399" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    <path d="M8.26855 2.75V5.79399" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.3258 4.21069H3.67578V21.25H20.3258V4.21069Z" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-semibold text-white">{{ $nextEvent['@attributes']['name'] }}</h3>
                                <span class="text-gray-300">
                                    @foreach ($nextEvent['resources']['resource'] as $event)
                                        @if( $event['@attributes']['category'] == 'classroom')
                                            Salle {{ $event['@attributes']['name'] }}
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>
                        <p class="flex w-full gap-4 text-gray-300">
                            {{-- Description du cours (Prof / Groupe d'élève / temps du cours / ce qui est prévu) --}}
                            <span>
                                {{ $nextEvent['@attributes']['date'] }}
                            </span>
                            |
                            <span>
                                {{ formatTime($nextEvent['@attributes']['startHour']) }} - {{ formatTime($nextEvent['@attributes']['endHour']) }}
                            </span>
                            |
                            @foreach ($nextEvent['resources']['resource'] as $nextEvent)
                                @if ($nextEvent['@attributes']['category'] == "instructor")
                                    <span>
                                        {{ $nextEvent['@attributes']['name'] }}
                                    </span>
                                    |
                                @endif
                            @endforeach
                            <span>
                                {{ $user_connected->diplome->code }}
                            </span>
                        </p>
                    </div>
                </div>
            @else
                <div class="flex flex-col gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-12 h-12 p-3 overflow-hidden bg-black rounded-full dark:bg-white bg-opacity-40 dark:bg-opacity-40">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                                <path d="M3.76074 9.59898H20.248" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                <path d="M16.1087 13.2115H16.1173" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                <path d="M12.0045 13.2115H12.0131" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                <path d="M7.89122 13.2115H7.89979" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                <path d="M16.1087 16.8065H16.1173" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                <path d="M12.0045 16.8065H12.0131" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                <path d="M7.89122 16.8065H7.89979" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                <path d="M15.7407 2.75V5.79399" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                <path d="M8.26855 2.75V5.79399" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.3258 4.21069H3.67578V21.25H20.3258V4.21069Z" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-white">{{ $nextEvent['@attributes']['name'] }}</h3>
                            <span class="text-gray-300">
                                @foreach ($nextEvent['resources']['resource'] as $event)
                                    @if( $event['@attributes']['category'] == 'classroom')
                                        Salle {{ $event['@attributes']['name'] }}
                                    @endif
                                @endforeach
                            </span>
                        </div>
                    </div>
                    <p class="flex w-full gap-4 text-gray-300">
                        {{-- Description du cours (Prof / Groupe d'élève / temps du cours / ce qui est prévu) --}}
                        <span>
                            {{ $nextEvent['@attributes']['date'] }}
                        </span>
                        |
                        <span>
                            {{ formatTime($nextEvent['@attributes']['startHour']) }} - {{ formatTime($nextEvent['@attributes']['endHour']) }}
                        </span>
                        |
                        @foreach ($nextEvent['resources']['resource'] as $nextEvent)
                            @if ($nextEvent['@attributes']['category'] == "instructor")
                                <span>
                                    {{ $nextEvent['@attributes']['name'] }}
                                </span>
                                |
                            @endif
                        @endforeach
                        <span>
                            {{ $user_connected->diplome->code }}
                        </span>
                    </p>
                </div>
            @endif
            @can('viewEDTHome', \App\Models\User::class)
                <div id="emploi">
                    <div class="flex flex-col gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
                        <div class="flex flex-col justify-between gap-2 lg:flex-row">
                            <div class="flex items-start gap-3">
                                <div class="flex items-center justify-center w-12 h-12 p-3 overflow-hidden bg-black rounded-full dark:bg-white bg-opacity-40 dark:bg-opacity-40">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                                        <path d="M3.76074 9.59898H20.248" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M16.1087 13.2115H16.1173" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M12.0045 13.2115H12.0131" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M7.89122 13.2115H7.89979" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M16.1087 16.8065H16.1173" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M12.0045 16.8065H12.0131" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M7.89122 16.8065H7.89979" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M15.7407 2.75V5.79399" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path d="M8.26855 2.75V5.79399" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.3258 4.21069H3.67578V21.25H20.3258V4.21069Z" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-semibold text-white">Mon emploi du temps</h3>
                                    <span class="text-gray-300">Voir l'emploi du temps et les absences</span>
                                </div>
                            </div>
                            @can('viewAbences', \App\Models\User::class)
                                <div class="flex flex-col items-start gap-2 lg:items-end">
                                    <button class="px-5 py-2 text-white bg-black rounded-full dark:bg-white bg-opacity-30 dark:bg-opacity-30 hover:bg-opacity-60 dark:hover:bg-opacity-60 w-fit" id="code_couleur">Afficher le code couleur</button>
                                    <div class="items-center justify-center hidden grid-cols-1 gap-2 text-center 2xl:grid-cols-4 lg:grid-cols-2 md:grid-cols-3" id="code_couleur_menu">
                                        <span class="px-2 py-1 font-bold text-black capitalize bg-red-500 rounded-xl h-fit">absence justifiée</span>
                                        <span class="px-2 py-1 font-bold text-black capitalize bg-orange-500 rounded-xl h-fit">absence injustifiée</span>
                                        <span class="px-2 py-1 font-bold text-black capitalize bg-purple-500 rounded-xl h-fit">absence en attente</span>
                                        <span class="px-2 py-1 font-bold text-black capitalize bg-green-500 rounded-xl h-fit">présent</span>
                                        <span class="px-2 py-1 font-bold text-black capitalize bg-blue-500 rounded-xl h-fit">Appel non fait</span>
                                    </div>
                                </div>
                            @endcan
                        </div>

                        <div class="flex justify-between">
                            <button class="px-5 py-2 text-white bg-black rounded-full dark:bg-white bg-opacity-30 dark:bg-opacity-30 hover:bg-opacity-60 dark:hover:bg-opacity-60 w-fit" id="emploi_button">Afficher l'EDT</button>
                        </div>
                    </div>
                    <div id="emploi_menu" class="hidden p-3 mt-2 bg-white bg-opacity-20 dark:bg-black dark:bg-opacity-20 rounded-xl">
                        <h2 class="mb-3 text-2xl font-semibold text-center text-white">Emploi du temps</h2>


                        <div class="flex flex-col h-full">
                            <div class="flex flex-col flex-auto bg-white isolate dark:bg-black dark:bg-opacity-10 bg-opacity-10 rounded-xl">
                                <div class="flex flex-col flex-none max-w-full sm:max-w-none md:max-w-full">
                                    <div class="sticky top-0 z-30 flex-none bg-white shadow bg-opacity-10 ring-1 ring-black ring-opacity-5">
                                        <div class="grid grid-cols-7 text-sm leading-6 text-white md:hidden">
                                            @foreach ($days as $day)
                                                <div>
                                                    @if ($day->isToday())
                                                        <button type="submit" class="flex flex-col items-center pt-2 pb-3"><span>{{ $joursSemaine[$day->dayOfWeek]['lettre'] }}</span> <span class="flex items-center justify-center w-8 h-8 mt-1 font-semibold text-white bg-indigo-600 rounded-full">{{ $day->format('d') }}</span></button>
                                                    @else
                                                        <button type="submit" class="flex flex-col items-center pt-2 pb-3"><span>{{ $joursSemaine[$day->dayOfWeek]['lettre'] }}</span> <span class="flex items-center justify-center w-8 h-8 mt-1 font-semibold text-white">{{ $day->format('d') }}</span></button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="hidden grid-cols-7 -mr-px text-sm leading-6 text-white border-r border-gray-100 divide-x divide-gray-100 md:grid">
                                            <div class="col-end-1 w-14"></div>
                                            @foreach ($days as $day)
                                                <div class="flex items-center justify-center py-3">
                                                    <span class="flex items-baseline gap-1">

                                                        <span>{{ $joursSemaine[$day->dayOfWeek]['abreviation'] }}</span>
                                                        @if ($day->isToday())
                                                            <span>
                                                                <span class="ml-1.5 flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white">{{ $day->format('d') }}</span>
                                                            </span>
                                                        @else
                                                            <span>
                                                                <span class="items-center justify-center font-semibold text-white">{{ $day->format('d') }}</span>
                                                            </span>
                                                        @endif
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex flex-auto">
                                        <div class="sticky left-0 z-10 flex-none bg-white w-14 bg-opacity-10 ring-t-1 ring- ring-gray-100 rounded-bl-xl"></div>
                                        <div class="grid flex-auto grid-cols-1 grid-rows-1">
                                            <!-- Horizontal lines -->
                                            <div class="grid col-start-1 col-end-2 row-start-1 divide-y divide-gray-100" style="grid-template-rows: repeat(10, minmax(3.5rem, 1fr))">
                                                <div class="row-end-1"></div>
                                                @foreach($hours as $hour)
                                                    <div>
                                                        <div class="sticky left-0 z-20 -ml-14 -mt-2.5 w-14 pr-2 text-right text-xs leading-5 text-white">{{ $hour }}</div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Vertical lines -->
                                            <div class="hidden grid-cols-7 col-start-1 col-end-2 grid-rows-1 row-start-1 divide-x divide-gray-100 md:grid md:grid-cols-7">
                                                <div class="col-start-1 row-span-full"></div>
                                                <div class="col-start-2 row-span-full"></div>
                                                <div class="col-start-3 row-span-full"></div>
                                                <div class="col-start-4 row-span-full"></div>
                                                <div class="col-start-5 row-span-full"></div>
                                                <div class="col-start-6 row-span-full"></div>
                                                <div class="col-start-7 row-span-full"></div>
                                            </div>

                                            <!-- Events -->
                                            <ol class="grid grid-cols-1 col-start-1 col-end-2 row-start-1 md:grid-cols-7" style="grid-template-rows: 1.75rem repeat(288, minmax(0, 1fr)) auto">
                                                @foreach ($evenementsByDate as $date => $evenements)
                                                    @foreach ($days as $day)
                                                        @if ($date == $day->format('d/m/Y'))
                                                            @php
                                                                $dayOfWeek = $day->format('N');
                                                                $class = ' col-start-' . $dayOfWeek;
                                                            @endphp
                                                            @foreach ($evenements as $evenement)
                                                                @php
                                                                    $color = $evenement['@attributes']['color'];
                                                                @endphp
                                                                <li class=" relative flex mt-px overflow-y-hidden text-center {{ $class }}
                                                                @php
                                                                    if ($evenement['@attributes']['startHour'] == '08:30' && $evenement['@attributes']['endHour'] == '10:30')
                                                                    {
                                                                        echo('huit_a_dix');
                                                                    }
                                                                    elseif ($evenement['@attributes']['startHour'] == '10:30' && $evenement['@attributes']['endHour'] == '12:30')
                                                                    {
                                                                        echo('dix_a_douze');
                                                                    }
                                                                    elseif ($evenement['@attributes']['startHour'] == '08:30' && $evenement['@attributes']['endHour'] == '12:30')
                                                                    {
                                                                        echo('huit_a_douze');
                                                                    }
                                                                    elseif ($evenement['@attributes']['startHour'] == '09:00' && $evenement['@attributes']['endHour'] == '12:00')
                                                                    {
                                                                        echo('huit_a_douze');
                                                                    }
                                                                    elseif ($evenement['@attributes']['startHour'] == '14:00' && $evenement['@attributes']['endHour'] == '16:00')
                                                                    {
                                                                        echo('quatorze_a_seize');
                                                                    }
                                                                    elseif ($evenement['@attributes']['startHour'] == '16:00' && $evenement['@attributes']['endHour'] == '18:00')
                                                                    {
                                                                        echo('seize_a_dixhuit');
                                                                    }
                                                                    elseif ($evenement['@attributes']['startHour'] == '14:00' && $evenement['@attributes']['endHour'] == '18:00')
                                                                    {
                                                                        echo('quatorze_a_dixhuit');
                                                                    }
                                                                @endphp
                                                                    ">
                                                                    <a @if($user_connected->role == "prof") href="{{ route('appel', $evenement['@attributes']['id']) }}" @endif class="absolute flex flex-col items-center justify-center p-2 overflow-y-auto text-xs leading-5 rounded-lg group inset-1 no-scroll
                                                                        @if ($user_connected->role == 'eleve')
                                                                            @php
                                                                                $current_day = \Illuminate\Support\Carbon::createFromFormat('d/m/Y', $current_day->format('d/m/Y'));
                                                                                $day = \Illuminate\Support\Carbon::createFromFormat('d/m/Y', $day->format('d/m/Y'));
                                                                            @endphp
                                                                            @if ($user_connected->absences->isNotEmpty())
                                                                                @foreach ($user_connected->absences as $absence)
                                                                                    @if ($absence->cours == $evenement['@attributes']['id'])
                                                                                        @if ($absence->status == "justify")
                                                                                            bg-red-200 hover:bg-red-300
                                                                                        @elseif ($absence->status == "unjustify")
                                                                                            bg-orange-200 hover:bg-orange-300
                                                                                        @elseif ($absence->status == "waiting")
                                                                                            bg-purple-200 hover:bg-purple-300
                                                                                        @endif
                                                                                    @else
                                                                                        @php
                                                                                            if($current_day->lessThan($day))
                                                                                            {
                                                                                        @endphp
                                                                                                bg-blue-200 hover:bg-blue-300
                                                                                        @php
                                                                                            } elseif ($current_day == $day) {
                                                                                        @endphp
                                                                                            @php $appelFait = false; @endphp
                                                                                            @foreach ($list_appel as $appel)
                                                                                                @if ($appel->cours == $evenement['@attributes']['id'])
                                                                                                    @php $appelFait = true; @endphp
                                                                                                    bg-green-200 hover:bg-green-300
                                                                                                @endif
                                                                                            @endforeach
                                                                                            @if (!$appelFait)
                                                                                                @if ($current_hour->format('H:i') < $evenement['@attributes']['endHour'])
                                                                                                    bg-blue-200 hover:bg-blue-300
                                                                                                @else
                                                                                                    bg-green-200 hover:bg-green-300
                                                                                                @endif
                                                                                            @endif
                                                                                        @php
                                                                                            } else {
                                                                                        @endphp
                                                                                                bg-green-200 hover:bg-green-300
                                                                                        @php
                                                                                            }
                                                                                        @endphp
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                @php
                                                                                    if($current_day->lessThan($day))
                                                                                    {
                                                                                @endphp
                                                                                        bg-blue-200 hover:bg-blue-300
                                                                                @php
                                                                                    } elseif ($current_day == $day) {
                                                                                @endphp
                                                                                    @php $appelFait = false; @endphp
                                                                                    @foreach ($list_appel as $appel)
                                                                                        @if ($appel->cours == $evenement['@attributes']['id'])
                                                                                            @php $appelFait = true; @endphp
                                                                                            bg-green-200 hover:bg-green-300
                                                                                        @endif
                                                                                    @endforeach
                                                                                    @if (!$appelFait)
                                                                                        @if ($current_hour->format('H:i') < $evenement['@attributes']['endHour'])
                                                                                            bg-blue-200 hover:bg-blue-300
                                                                                        @else
                                                                                            bg-green-200 hover:bg-green-300
                                                                                        @endif
                                                                                    @endif
                                                                                @php
                                                                                    } else {
                                                                                @endphp
                                                                                        bg-green-200 hover:bg-green-300
                                                                                @php
                                                                                    }
                                                                                @endphp
                                                                            @endif"
                                                                        @else
                                                                            " style="background-color:rgb({{$evenement['@attributes']['color']}});"
                                                                        @endif>
                                                                        @if ($user_connected->role == 'prof')
                                                                            <div class="absolute z-10 items-center justify-center hidden w-full h-full group-hover:flex"  style="background-color:rgb({{$evenement['@attributes']['color']}});">Faire l'appel</div>
                                                                        @endif
                                                                        <p class="font-semibold text-gray-800 group-hover:text-gray-900">{{ $evenement['@attributes']['name'] }}</p>

                                                                        @foreach ($evenement['resources']['resource'] as $event)
                                                                            @if ($event['@attributes']['category'] == "trainee")
                                                                                <p class="text-gray-800 group-hover:text-gray-900">
                                                                                    @if ($event['@attributes']['name'] == $user_connected->diplome->code || $event['@attributes']['name'] == $user_connected->parcour->label)
                                                                                        {{ $event['@attributes']['name'] }}
                                                                                    @endif
                                                                                </p>
                                                                            @endif
                                                                            @if ($event['@attributes']['category'] == "classroom")
                                                                                <p class="text-gray-800 group-hover:text-gray-900">Salle {{ $event['@attributes']['name'] }}</p>
                                                                            @endif
                                                                        @endforeach
                                                                        @if ($user_connected->role == "prof")
                                                                            <p class="text-gray-800 group-hover:text-gray-900">{{ $evenement['@attributes']['startHour'] }} - {{ $evenement['@attributes']['endHour'] }}</p>
                                                                        @endif
                                                                        @foreach ($evenement['resources']['resource'] as $event)
                                                                            @if ($event['@attributes']['category'] == "instructor")
                                                                                <p class="text-gray-800 group-hover:text-gray-900">
                                                                                    @if ($user_connected->role == 'prof')
                                                                                        @if ($event['@attributes']['name'] == $user_connected->code_diplome)
                                                                                            {{ $event['@attributes']['name'] }}
                                                                                        @endif
                                                                                    @else
                                                                                        {{ $event['@attributes']['name'] }}
                                                                                    @endif
                                                                                </p>
                                                                            @endif
                                                                        @endforeach
                                                                        {{-- <p>{{ $evenement['@attributes']['id'] }}</p> --}}
                                                                    </a>

                                                                </li>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        @endcan
    </div>

    <x-slot name="edt_script">

        <script>
            // récupération de l'emploi du temps
            let emploi = document.querySelector('#emploi');
            let emploi_button = document.querySelector('#emploi_button');
            let emploi_menu = document.querySelector('#emploi_menu');
            if (emploi) {
              emploi_button.addEventListener('click', () => {
                  if (emploi_button.innerHTML == 'Afficher l\'EDT'){
                      emploi_button.innerHTML = 'Masquer l\'EDT';
                  } else {
                      emploi_button.innerHTML = 'Afficher l\'EDT';
                  }
                  emploi_menu.classList.toggle('hidden');
              });
              emploi.addEventListener('click', (e) => {
                  e.stopPropagation();
              });
            }

        </script>
    </x-slot>
</x-home-layout>

@php
    function formatTime($time){
        // Analyse l'heure dans le format HH:mm
        $timestamp = strtotime($time);

        // Formate l'heure au format "Hhmm"
        $formattedTime = date('H\hi', $timestamp);

        return $formattedTime;
    }
@endphp
