<div>
    <label class="flex items-center relative w-max cursor-pointer select-none">
        <input type="checkbox" wire:model="language" class="appearance-none transition-colors cursor-pointer w-24 h-10 rounded-full bg-white" />
        <span class="absolute right-1"> <img id="hu" class="w-9" src="{{asset('images/hungary.png')}}" alt="hungary"> </span>
        <span style="right: 3.55rem" class="absolute"> <img id="ro" class="w-9" src="{{asset('images/romania.png')}}" alt="hungary"> </span>
        <span class="w-10 h-10 right-14 absolute rounded-full transform transition-transform bg-red-700" />
    </label>


    {{__('landingpage.test')}}
</div>
