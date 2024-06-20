<x-home-layout>

    <form method="POST" action="{{ route('scan') }}" class="flex flex-col items-center justify-center">
        @method('POST')
        @csrf

        <input type="hidden" name="user" value="{{$user}}">
        <input type="hidden" name="idcour" value="{{$idcour}}">

        <button type="submit" class="px-10 py-2 text-2xl text-white bg-white rounded-full md:block dark:bg-black bg-opacity-30 dark:bg-opacity-30 w-fit">Je suis présent</button>
    </form>

</x-home-layout>
