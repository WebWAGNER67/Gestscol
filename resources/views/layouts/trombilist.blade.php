<div>
    <form class="flex flex-col gap-3" wire:submit="submit">
        <div>
            <select id="diplome" wire:model="form.diplome" class="bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 border text-sm rounded-lg block w-full p-2.5 text-white">
                <option value="" class="text-black">{{ __('Choisissez un Diplome') }}</option>
                @foreach ($diplomes as $diplome)
                    <option value="{{ $diplome->id }}" class="text-black">{{ $diplome->code }}</option>
                @endforeach
            </select>
            @error('form.diplome')
                <span class="block text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <select id="group" wire:model="form.group" class="bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 border text-sm rounded-lg block w-full p-2.5 text-white">
                <option value="" class="text-black">{{ __('Choisissez un Groupe') }}</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" class="text-black">{{ $group->label }}</option>
                @endforeach
            </select>
            @error('form.group')
                <span class="block text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="px-5 py-2 text-white bg-white rounded-full dark:bg-black bg-opacity-30 dark:bg-opacity-30 dark:hover:bg-opacity-60 w-fit">Voir le trombinoscope</button>
    </form>
</div>
