<div x-data="{open:false}" class="rounded-lg" :class="open ? 'border' : ''" x-transition.opacity.duration.300ms>
    <div class="flex justify-between items-center p-2 mb-1 rounded-lg"
         style="background-color: {{$selected_category ? $selected_category->category_color : "#e5e5e5"}}">
        <div>
            {{--            <div class="w-6 h-6 rounded-full" style="background-color: {{$selected_category ? $selected_category->category_color : "#e5e5e5"}}">--}}
            {{--            </div>--}}
        </div>
        <div><h2
                class="text-base font-bold {{$selected_category ? $this->is_color_dark($selected_category->category_color) ? 'text-black' : 'text-white' : ''}}">{{$selected_category ? $selected_category->category_name : 'Category'}}</h2>
        </div>
        <div x-on:click="open = !open"><i class="fa-solid fa-plus" x-show="!open"></i><i class="fa-solid fa-minus"
                                                                                         x-show="open"></i></div>
    </div>
    <div class="flex flex-wrap justify-center mb-1" x-show="open" x-transition.opacity.duration.300ms>
        @foreach($categories as $category)
            <div class="rounded-lg"
                 style="background-color: {{$this->selected_category == $category ? $category->category_color : '' }}">
                <input id="{{$transaction->id}}.{{$category->id}}.category-select" type="radio" class="hidden"
                       wire:model="selected_category"
                       value="{{$category->id}}">

                <label for="{{$transaction->id}}.{{$category->id}}.category-select"
                       class="text-sm font-semibold w-full h-full flex items-center p-1"><span
                        class="bg-white rounded-lg p-1">{{$category->category_name}}</span></label>
            </div>
        @endforeach
            <div class="rounded-lg"
                 style="background-color: {{$this->selected_category == null ? '#e5e5e5' : '' }}">
                <input id="no-category-select.{{$transaction->id}}" type="radio" class="hidden"
                       wire:model="selected_category"
                       value="0">
                <label for="no-category-select.{{$transaction->id}}"
                       class="text-sm font-semibold w-full h-full flex items-center p-1"><span
                        class="bg-white rounded-lg p-1">No category</span></label>
            </div>
    </div>
</div>
