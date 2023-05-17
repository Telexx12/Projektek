<div class="w-full px-1 md:px-2 md:w-5/12 md:relative order-2 md:order-1" x-data="{create:false, update:false}">
    <div x-show="create" class="absolute backdrop-blur-lg w-full h-full z-50" style="display: none;">
        <div class="flex items-center justify-center h-full">
            <div class="flex gap-2 flex-col lg:flex-row">
                <div class="flex  gap-5 md:gap-1 lg:flex-row items-center">
                    <x-input class="mb-1" wire:model="category_name" wire:model="category_name"/>
                    <x-color-picker class="lg:w-2/5 hidden md:block" wire:model="color"/>
                    <div class="w-9 h-9 rounded-full mr-3 md:hidden"
                         style="background-color: {{$color}}" x-on:click="popover = true;">
                        <x-color-picker class="z-10 md:hidden" style="opacity: 0"  wire:model="color"/>
                    </div>
                </div>
                <div class="flex justify-between lg:gap-1">
                    <div class="w-2/5 lg:w-auto">
                        <x-button green class="w-full" x-on:click="$wire.saveCategory; create=false"><i
                                class="fa-solid fa-floppy-disk p-1"></i></x-button>
                    </div>
                    <div class="w-2/5 lg:w-auto">
                        <x-button red class="w-full" x-on:click="create = false"><i
                                class="fa-solid fa-x p-1"></i></x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="update" class="absolute backdrop-blur-lg w-full h-full z-50" style="display: none;">
        <div class="flex items-center justify-center h-full">
            <div class="flex gap-2 flex-col lg:flex-row">
                <div class="flex gap-1 flex-col lg:flex-row">
                    <x-color-picker class="w-full" wire:model="update_color"/>
                </div>
                <div class="flex justify-around lg:gap-1">
                    <div class="w-2/5 lg:w-auto">
                        <x-button green class="w-full" x-on:click="$wire.updateCategory; update=false"><i
                                class="fa-solid fa-floppy-disk p-1"></i></x-button>
                    </div>
                    <div class="w-2/5 lg:w-auto">
                        <x-button red class="w-full" x-on:click="update = false"><i
                                class="fa-solid fa-x p-1"></i></x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-card cardClasses="min-h-[40vh] lg:h-[40vh] lg:overflow-y-scroll soft-scrollbar">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between gap-2 lg:mb-3">
                <h1 class="text-lg font-bold text-center">Categories</h1>
                <x-button blue class="place-self-end" x-on:click="create = !create"><span
                        class="hidden lg:block">Create category</span><i class="fa-solid fa-plus lg:hidden"></i>
                </x-button>
            </div>
            @if($categories)
                <div class="flex h-full px-3">
                    <div class="w-full">
                        @foreach($categories as $category)
                            <livewire:components.category-card :category="$category"  wire:key="{{rand()}}"/>
                        @endforeach
                    </div>
                </div>
            @else
                <p class=" backdrop-blur-lg">No category</p>
            @endif
        </div>
    </x-card>
</div>
