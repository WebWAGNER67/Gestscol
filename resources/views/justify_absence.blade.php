<x-home-layout>
    <form action="{{ route('absence.justify.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col items-center justify-center gap-5 my-5">
        @csrf
        @method('POST')
        <input type="hidden" name="id_absence" value="{{ $id_absence }}">
        <label for="file" class="flex flex-col items-center justify-center w-full gap-3 p-5 text-white border-2 border-dashed cursor-pointer rounded-xl group hover:bg-opacity-10 hover:bg-white dark:hover:bg-black dark:hover:bg-opacity-20">
            <div class="flex items-center justify-center bg-blue-500 rounded-full w-14 h-14 group-hover:bg-blue-400">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                    <path d="M11.9994 5.00308V18.9946" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                    <path d="M18.9998 12.003L4.99512 12.0016" stroke="white" stroke-width="1.5" stroke-linecap="square"/>
                </svg>
            </div>
            <div class="text-center">
                <h2 class="text-lg">Importer un fichier pdf</h2>
                <p class="text-sm text-gray-300">Drag and drop</p>
            </div>
        </label>
        <input type="file" name="import_file" id="file" class="hidden">
        <div class="flex flex-row items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" id="file-icon" width="24" height="24" fill="white" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
            </svg>
            <span id="file-name" class="text-xl font-semibold text-white"></span>
        </div>
        <button class="px-4 py-2 text-white bg-white rounded-full bg-opacity-20 dark:bg-black dark:bg-opacity-20" type="submit">Justifier l'absence</button>
    </form>
    <script>
        document.getElementById('file').addEventListener('change', function (e) {
            // Afficher le nom du fichier
            document.getElementById('file-name').textContent = e.target.files[0].name;

            // Changer l'icône en fonction du format du fichier
            const fileExtension = e.target.files[0].name.split('.').pop().toLowerCase();
            const svg = document.getElementById('file-icon');
            switch (fileExtension) {
                case 'pdf':
                    svg.innerHTML = `
                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                    `;
                    break;
                default:
                    break;
            }
        });
        </script>
</x-home-layout>
