<x-home-layout>
    <div class="flex flex-col gap-3" id="content">
        <h2 class="text-4xl font-semibold text-white">{{ $titre }}</h2>
        <div class="flex flex-col gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    @if (empty($coursAbsences))
                        <h3 class="text-2xl text-white">🎉 Félicitation, vous n'avez jamais été absent.</h3>
                    @else
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    @if (Auth::user()->role == 'eleve')
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Cours</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Date / Heure</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Status</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Professeur</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Actions</th>
                                    @else
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Eleve</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Cours</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Date / Heure</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Status</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-white">Fichier de justification</th>
                                        @can('AcceptJustificatif', \App\Models\User::class)
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Actions</th>
                                        @endcan
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="absences_list">
                                @foreach ($coursAbsences as $absence)
                                    <tr class="border-y">
                                        @if(Auth::user()->role == 'eleve')
                                            <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                                <div class="font-medium text-white">{{$absence['@attributes']['name']}}</div>
                                            </td>
                                            <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">
                                                <div class="text-white">{{$absence['@attributes']['date']}} | {{$absence['@attributes']['startHour']}} - {{$absence['@attributes']['endHour']}}</div>
                                            </td>
                                            <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">
                                                @if ($absence['status'] == "justify")
                                                    <div class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-200 rounded-md text-red-950 ring-1 ring-inset ring-red-600">Justifiée</div>
                                                @elseif ($absence['status'] == "unjustify")
                                                    <div class="inline-flex items-center px-2 py-1 text-xs font-medium bg-orange-200 rounded-md text-orange-950 ring-1 ring-inset ring-orange-600">Non Justifiée</div>
                                                @elseif ($absence['status'] == "waiting")
                                                    <div class="inline-flex items-center px-2 py-1 text-xs font-medium bg-purple-200 rounded-md text-purple-950 ring-1 ring-inset ring-purple-600">En attente</div>
                                                @endif
                                            </td>
                                            <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">
                                                @php
                                                    $instructorFound = false;
                                                @endphp
                                                @foreach ($absence['resources']['resource'] as $resource)
                                                    @if ($resource['@attributes']['category'] == "instructor")
                                                        {{$resource['@attributes']['name']}}
                                                        @php
                                                            $instructorFound = true;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if (!$instructorFound)
                                                    Pas de professeur attitré
                                                @endif
                                            </td>
                                            <td>
                                                @if ($absence['status'] == "justify")
                                                    <span class="px-2 py-1 font-semibold bg-red-200 rounded-md text-md ring-1 ring-inset text-red-950 ring-red-600">Justifiée</span>
                                                @elseif ($absence['status'] == "unjustify")
                                                    <form action="{{ route('absence.justify') }}" method="POST">
                                                        @csrf
                                                        @method("POST")
                                                        <input type="hidden" name="id_absence" value="{{ $absence['id_absence'] }}">
                                                        <button type="submit" class="px-2 py-1 font-semibold bg-orange-200 rounded-md text-md ring-1 ring-inset text-orange-950 ring-orange-600">Justifier l'absence</button>
                                                    </form>
                                                @elseif ($absence['status'] == "waiting")
                                                    <span class="px-2 py-1 font-semibold bg-purple-200 rounded-md text-md ring-1 ring-inset text-purple-950 ring-purple-600">En attente de l'administration</span>
                                                @endif
                                            </td>
                                        @else
                                            <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                                <div class="font-medium text-white">{{ $absence['name'] }}</div>
                                            </td>
                                            <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">
                                                <div class="text-white">{{$absence['@attributes']['name']}}</div>
                                            </td>
                                            <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">
                                                <div class="text-white">{{$absence['@attributes']['date']}} | {{$absence['@attributes']['startHour']}} - {{$absence['@attributes']['endHour']}}</div>
                                            </td>
                                            <td class="px-3 py-5 text-sm text-gray-400 whitespace-nowrap">
                                                @if ($absence['status'] == "justify")
                                                    <div class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-200 rounded-md text-red-950 ring-1 ring-inset ring-red-600">Justifiée</div>
                                                @elseif ($absence['status'] == "unjustify")
                                                    <div class="inline-flex items-center px-2 py-1 text-xs font-medium bg-orange-200 rounded-md text-orange-950 ring-1 ring-inset ring-orange-600">Non Justifiée</div>
                                                @elseif ($absence['status'] == "waiting")
                                                    <div class="inline-flex items-center px-2 py-1 text-xs font-medium bg-purple-200 rounded-md text-purple-950 ring-1 ring-inset ring-purple-600">En attente</div>
                                                @endif
                                            </td>
                                            <td class="px-3 py-5 text-sm text-center text-gray-400 whitespace-nowrap">
                                                @if (isset($absence['justification_file']))
                                                    <a href="{{ $absence['justification_file'] }}" target="_blank" class="p-3 text-white cursor-pointer hover:bg-black hover:bg-opacity-20 rounded-xl"><span class="pr-3 bg-[url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAVElEQVR42n3PgQkAIAhEUXdqJ3dqJ3e6IoTPUSQcgj4EQ5IlUiLE0Jil3PECXhcHGBhZ8kg4hwxAu3MZeCGeyFnAXp4hqNQPnt7QL0nADpD6wHccLvnAKksq8iiaAAAAAElFTkSuQmCC)] bg-right-center bg-no-repeat">Justificatif</span></a>
                                                @else
                                                    <span>Aucun fichier déposé</span>
                                                @endif
                                            </td>
                                            @can('AcceptJustificatif', \App\Models\User::class)
                                                <td>
                                                    <form action="{{ route('absence.justify.accept') }}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="id_absence" value="{{ $absence['id_absence'] }}">
                                                        <button type="submit" class="px-2 py-1 text-xl text-white bg-white font-semi-bold dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">Valider le Justificatif</button>
                                                    </form>
                                                </td>
                                            @endcan
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-home-layout>
