<x-home-layout>
    @if (session('status'))
        <div class="w-full px-6 py-2 text-black bg-green-300 border border-black rounded-md">
            {{ session('status') }}
        </div>
    @elseif (session('error'))
        <div class="w-full px-6 py-2 text-black bg-red-300 border border-black rounded-md">
            {{ session('error') }}
        </div>
    @else
        <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center justify-center gap-5 my-5">
            @csrf
            <label for="file" class="flex flex-col items-center justify-center w-full gap-3 p-5 text-white border-2 border-dashed cursor-pointer rounded-xl group hover:bg-opacity-10 hover:bg-white dark:hover:bg-black dark:hover:bg-opacity-20">
                <div class="flex items-center justify-center bg-blue-500 rounded-full w-14 h-14 group-hover:bg-blue-400">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                        <path d="M11.9994 5.00308V18.9946" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                        <path d="M18.9998 12.003L4.99512 12.0016" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    </svg>
                </div>
                <div class="text-center">
                    <h2 class="text-lg">Upload new file</h2>
                    <p class="text-sm text-gray-300">Drag and drop</p>
                </div>
            </label>
            <input type="file" name="import_file" id="file" class="hidden">
            <div class="flex flex-row items-center justify-center gap-2">
                <svg id="file-icon" width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="https://www.w3.org/2000/svg">
                </svg>
                <span id="file-name" class="text-xl font-semibold text-white"></span>
            </div>
            <button class="px-4 py-2 text-white bg-white rounded-full bg-opacity-20 dark:bg-black dark:bg-opacity-20">Mettre à jour la liste des étudiants</button>
        </form>
    @endif
    <div class="flex flex-col gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full">
                    <thead>
                        <tr colspan="4">
                            <a class="float-right px-5 py-2 text-white bg-white rounded-full bg-opacity-20 dark:bg-black dark:bg-opacity-20" href="{{ route('users.export') }}">Exporter le fichier xlsx</a>
                        </tr>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">Nom Prénom</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Promo</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Code Emploi du Temps</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Groupe</th>
                        </tr>
                    </thead>
                    <tbody id="users_list_appel">
                        @foreach ($users as $user)
                            <tr class="border-y">
                                <td class="py-5 pl-4 pr-3 text-sm whitespace-nowrap sm:pl-0">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-11 w-11">
                                            @if ($user->image != null)
                                                <img src="{{ $user->image }}" alt="" class="object-cover rounded-full h-11 w-11">
                                            @else
                                                <img src="{{ asset('/img/profil-min.png') }}" alt="" class="rounded-full h-11 w-11">
                                            @endif
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
                                    <div class="text-white">{{ $user->code_diplome }}</div>
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
    <script>
        document.getElementById('file').addEventListener('change', function (e) {
            // Afficher le nom du fichier
            document.getElementById('file-name').textContent = e.target.files[0].name;

            // Changer l'icône en fonction du format du fichier
            const fileExtension = e.target.files[0].name.split('.').pop().toLowerCase();
            const svg = document.getElementById('file-icon');
            switch (fileExtension) {
                case 'xlsx':
                    svg.innerHTML = `
                    <g style="mix-blend-mode:multiply" opacity="0.2">
                        <rect x="6.52002" y="1.87988" width="17.04" height="19.68" fill="url(#pattern0)"/>
                        <g style="mix-blend-mode:multiply" opacity="0.2">
                            <path d="M21.7301 1.98987H8.22012C7.75068 1.98987 7.37012 2.37043 7.37012 2.83987V19.1699C7.37012 19.6393 7.75068 20.0199 8.22012 20.0199H21.7301C22.1996 20.0199 22.5801 19.6393 22.5801 19.1699V2.83987C22.5801 2.37043 22.1996 1.98987 21.7301 1.98987Z" fill="white"/>
                        </g>
                    </g>
                    <g style="mix-blend-mode:multiply" opacity="0.12">
                        <rect x="6.91992" y="1.79993" width="16.08" height="18.72" fill="url(#pattern1)"/>
                        <g style="mix-blend-mode:multiply" opacity="0.12">
                            <path d="M21.7299 1.98987H8.21987C7.75043 1.98987 7.36987 2.37043 7.36987 2.83987V19.1699C7.36987 19.6393 7.75043 20.0199 8.21987 20.0199H21.7299C22.1993 20.0199 22.5799 19.6393 22.5799 19.1699V2.83987C22.5799 2.37043 22.1993 1.98987 21.7299 1.98987Z" fill="white"/>
                        </g>
                    </g>
                    <path d="M15.25 1.99994H8.24997C8.13929 1.9986 8.02946 2.01941 7.92694 2.06115C7.82442 2.10289 7.73128 2.16471 7.65301 2.24298C7.57474 2.32125 7.51292 2.41438 7.47118 2.5169C7.42944 2.61942 7.40863 2.72926 7.40997 2.83994V6.49994H15.29L15.25 1.99994Z" fill="#21A366"/>
                    <path d="M21.73 1.99994H15.25V6.49994H22.58V2.82994C22.5787 2.71963 22.5557 2.61065 22.5122 2.50924C22.4688 2.40782 22.4058 2.31595 22.3269 2.23888C22.248 2.16181 22.1546 2.10103 22.0522 2.06004C21.9498 2.01904 21.8403 1.99862 21.73 1.99994Z" fill="#33C481"/>
                    <path d="M22.57 11H15.25V15.51H22.57V11Z" fill="#107C41"/>
                    <path d="M15.2499 15.51V11H7.36993V19.17C7.36859 19.2807 7.3894 19.3905 7.43114 19.493C7.47288 19.5956 7.5347 19.6887 7.61297 19.767C7.69124 19.8452 7.78438 19.9071 7.8869 19.9488C7.98942 19.9905 8.09925 20.0113 8.20993 20.01H21.7299C21.8411 20.0113 21.9514 19.9906 22.0545 19.949C22.1575 19.9073 22.2513 19.8457 22.3304 19.7675C22.4094 19.6894 22.4722 19.5964 22.515 19.4938C22.5579 19.3912 22.5799 19.2812 22.5799 19.17V15.51H15.2499Z" fill="#185C37"/>
                    <path d="M15.2599 6.48999H7.36987V11H15.2599V6.48999Z" fill="#107C41"/>
                    <path d="M22.57 6.48999H15.25V11H22.57V6.48999Z" fill="#21A366"/>
                    <g style="mix-blend-mode:multiply" opacity="0.48">
                        <rect x="0.939941" y="4.69995" width="14.16" height="14.16" fill="url(#pattern2)"/>
                        <g style="mix-blend-mode:multiply" opacity="0.48">
                            <path d="M12.1499 5.92993H3.70986C3.24042 5.92993 2.85986 6.31049 2.85986 6.77993V15.2199C2.85986 15.6894 3.24042 16.0699 3.70986 16.0699H12.1499C12.6193 16.0699 12.9999 15.6894 12.9999 15.2199V6.77993C12.9999 6.31049 12.6193 5.92993 12.1499 5.92993Z" fill="white"/>
                        </g>
                    </g>
                    <g style="mix-blend-mode:multiply" opacity="0.24">
                        <rect x="2.59985" y="5.63989" width="10.8" height="10.8" fill="url(#pattern3)"/>
                        <g style="mix-blend-mode:multiply" opacity="0.24">
                            <path d="M12.1499 5.92993H3.70986C3.24042 5.92993 2.85986 6.31049 2.85986 6.77993V15.2199C2.85986 15.6894 3.24042 16.0699 3.70986 16.0699H12.1499C12.6193 16.0699 12.9999 15.6894 12.9999 15.2199V6.77993C12.9999 6.31049 12.6193 5.92993 12.1499 5.92993Z" fill="white"/>
                        </g>
                    </g>
                    <path d="M12.1499 5.92993H3.70986C3.24042 5.92993 2.85986 6.31049 2.85986 6.77993V15.2199C2.85986 15.6894 3.24042 16.0699 3.70986 16.0699H12.1499C12.6193 16.0699 12.9999 15.6894 12.9999 15.2199V6.77993C12.9999 6.31049 12.6193 5.92993 12.1499 5.92993Z" fill="#107C41"/>
                    <path d="M5.47998 13.75L7.24998 11L5.62998 8.26H6.93998L7.81998 10C7.88695 10.1218 7.94381 10.2489 7.98998 10.38V10.38C8.04528 10.2462 8.10873 10.116 8.17998 9.99L9.17998 8.25H10.38L8.66998 11L10.38 13.77H9.09998L8.09998 11.84C8.04673 11.7622 8.00308 11.6783 7.96998 11.59V11.59C7.93674 11.6764 7.89661 11.76 7.84998 11.84L6.78998 13.77L5.47998 13.75Z" fill="white"/>
                    <g style="mix-blend-mode:soft-light" opacity="0.5">
                        <path style="mix-blend-mode:soft-light" opacity="0.5" d="M12.1499 5.92993H3.70986C3.24042 5.92993 2.85986 6.31049 2.85986 6.77993V15.2199C2.85986 15.6894 3.24042 16.0699 3.70986 16.0699H12.1499C12.6193 16.0699 12.9999 15.6894 12.9999 15.2199V6.77993C12.9999 6.31049 12.6193 5.92993 12.1499 5.92993Z" fill="url(#paint0_linear_380_2758)"/>
                    </g>
                    <defs>
                        <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image0_380_2758" transform="scale(0.0138889 0.0120482)"/>
                        </pattern>
                        <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image1_380_2758" transform="scale(0.0147059 0.0126582)"/>
                        </pattern>
                        <pattern id="pattern2" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image2_380_2758" transform="scale(0.0166667)"/>
                        </pattern>
                        <pattern id="pattern3" patternContentUnits="objectBoundingBox" width="1" height="1">
                            <use xlink:href="#image3_380_2758" transform="scale(0.0217391)"/>
                        </pattern>
                        <linearGradient id="paint0_linear_380_2758" x1="4.61986" y1="5.26993" x2="11.2399" y2="16.7299" gradientUnits="userSpaceOnUse">
                            <stop stop-color="white" stop-opacity="0.5"/>
                            <stop offset="1" stop-opacity="0.7"/>
                        </linearGradient>
                        <image id="image0_380_2758" width="72" height="83" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEgAAABTCAYAAAA8/EEfAAAACXBIWXMAAC4jAAAuIwF4pT92AAAB4ElEQVR4Xu3cwWrUUABG4XPbUMGNCnYhOM/hpjtfXRDtYziioFRcNqZeF/dmJh3aHnCZ/GeTdiab+5HJ8i+1VpaVUgobrJ5C9Mr8eYcZgAvgHNgKVAXugBGYTqFKrXXGeQZcAm+BF2wDacb5DeyBH8DtEmlYXC+Bd8AVsKM9SVtoBL4AH4BPwHfgz/zl0J+eC9qTcwW8B95wxFt7E/Ct//0VuCmlHH5qM8I57We1o+G8BM7YRn/7dcfx1XJoBlq+oAcaztrfP3Nn3D/7vXNv5Sn57wIkBUgKkBQgKUBSgKQASQGSAiQFSAqQFCApQFKApABJAZICJAVICpAUIClAUoCkAEkBkgIkBUgKkBQgKUBSgKQASQGSAiQFSAqQFCApQFKApABJAZICJAVICpAUIClAUoCkAEkBkgIkBUgKkBQgKUBSgKQASQGSAiQFSAqQFCApQFKApABJAZICJAVICpA0A1XaXN7Yrw/Odq60J88+r+At1yh/As9py5xrX8KrwC3tzHuawd3yhqHWWkspY7/hI/Cqf/ea9Y9NTjScz7Sz74HxoanSibZjet3//0Vb5lz7XOnywbimGUzLG07XgLc0eKtDt7AAgk1OJj85lQwnQIcPNza6/djYNjwClI79A/7Gf1JmIOGZAAAAAElFTkSuQmCC"/>
                        <image id="image1_380_2758" width="68" height="79" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEQAAABPCAYAAABS1GNxAAAACXBIWXMAAC4jAAAuIwF4pT92AAABY0lEQVR4Xu3cvW3bYAAG4aNggEuo8xLp0nmhdB7AnQdy5zITuIo6DSFWXwqK/jkkQWrxHoCFBEoAD59UvtMYg3y4+/ximqYZOALzn2+/SQtwHmMsANN2Qq4xvgGPrFH24gw8AT/HGAtjDK5R7oEX4AKMHV0X4BX4DsxbjBl4AH79xxfc4nVhPQz3B1ZH4Af7+ql89v7fefAbf/3IThzIFwWRgkhBpCBSECmIFEQKIgWRgkhBpCBSECmIFEQKIgWRgkhBpCBSECmIFEQKIgWRgkhBpCBSECmIFEQKIgWRgkhBpCBSECmIFEQKIgWRgkhBpCBSECmIFEQKIgWRgkhBpCBSECmIFEQKIgWRgkhBpCBSECmIFEQKIgWRgsgWZGHd81r+ce8t+3j+ZrsYrM/9AMx3AGOMZZqmE/DGai+LVdvJeANOY4zF039H1sW7vWyanYFn4MR1D/E9yGZnA5FfhiEBfgO20QT8sY3jjAAAAABJRU5ErkJggg=="/>
                        <image id="image2_380_2758" width="60" height="60" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAACXBIWXMAAC4jAAAuIwF4pT92AAADoUlEQVRoQ+2b61LbMBBGj3IhoUAphbbT93+6Ti8DoZCEXNwfq43WshyHUizi+pvZ8SWO2ONd2WH82RVFwf+kUdMBKTnnXNMxr63iLyvl9n3PgFnA7LBGhV0echJqgT2sAwZ+add3hyW++tqykBpbu70PPAnsnBsgcANgGIU9AbmANTaJ2ALbOujKHDawI2AMnJgY+dBjoF1ohdgicGtgBTyZWAE455LQJWDfxgo7AabAO+AMOPX7TqhWui3ZFl4jgHPg0YTz+5PQO+Bozo4RwAvg0sd7BH7qPx/S3ny2SWt1Vwjsb2AG3CI56fE2dopbWqt7gsBdAp+AG+Cj3z6lXOU2pQBrYAk8AHfATwJLaT4755ytsgXWCg+R1j0DPiDAX4HPwBVwTpjPOVpa23kJ3AO/kHwx+5dIW6/jAVIVHiJAp0gbXwNfEOhrpM0nhJbOAbwBFkgrT/1nWvF7v9QO1FsWUAXWCo+Rgc4Q6CukrW/ID6wtvSBUdoG09jlSqNQ1BvDA5oKlFy2tsl6lz31c8DaAN0h+IJW9INxJdLol80v9lrbQ9l48iSI3MMg8nRJyGpOAtReuVEvr0oLbGJn1NmFVOh9tLiOzrj+KkrnVVTgVdiAbOVSXlwVN5nfofTT+Yi5QVV1RiNYragLODfbP1QR8bGosUNeAG9UDd109cNfVA3ddPXDX1QN3XT1w19UDd109cNfVA3ddPXDX1QMfuWrdO6om4MYBjk1NwKoYPPeJiD0c1stR8XVY1VkP4wHsvvgPtK04hy3hKb992p/MMQauGyxlAIP2nyBqXprD2ix13Z6AilIVtoOq8UvNX0vCk/ccz4dtbgsTamRZEcB3Fa64eIqiKLyPVKuqsEs/4IMPNZA8kRdYPR4zH2pkmRPcOyVola2wbeMVAvvoB7tF/BMgf0h9WjmAYxfPD8S6dIeY1OZI/gpcUmoOq8tNYa0Pao6YR9QlA+1CK3Ds0/qGmNNmSN5PhPm8t8J69rS6d5TdMrcE66G1F7Ql29KxE+87kp8FPqjCatp8RAbAb88QC9OE4KhVvTa4TXyf1zKucMU7vQP2F664pUFOgFZbYXNYlqB8nalz0y6Q/JO3ppJB3BjU1I1nPVq6bWFzAEOzX3pDjUm84oiPbMSxL2tAmLttw6oKE6kfRHsd8XWvAMR2oEG0jVm2rcIsbYvvtp/9zsPuw+pbLbkg62ThX/ZWS53ewjtLcBhcSs8GPnYd+v9wZ/QHTbqvfA0XAmsAAAAASUVORK5CYII="/>
                        <image id="image3_380_2758" width="46" height="46" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAYAAABXuSs3AAAACXBIWXMAAC4jAAAuIwF4pT92AAAAwUlEQVRoQ+3ZsQkCMRyF8S8iZAm765zAzr0cwJ3sLG8BN8gQSfW3CIdeZ/VM4P0gTSDwcXDVSxFBSikDJyAzpgaUiGjbRaLHXoAbPX5EBbgD63f8AjyACsSgpwJP4ArkiADgDLx+ePzvU+kfeIkIDsxj9x/OFL7jcDWHqzlczeFqDldzuJrD1Ryu5nA1h6s5XM3hag5Xc7iaw9UcruZwNYcLNPre2aCH7y4G1YCVPtIWgCOf1RYmWpbTtFv+Ni/P5g1xTodLg4W2uAAAAABJRU5ErkJggg=="/>
                    </defs>
                    `;
                    break;
                default:
                    break;
            }
        });

        const pagination = document.getElementById('navigation_pagination').children[0].children[1].children[0].children[0];
        pagination.classList.remove('text-gray-700');
        pagination.classList.add('text-white');
    </script>
</x-home-layout>
