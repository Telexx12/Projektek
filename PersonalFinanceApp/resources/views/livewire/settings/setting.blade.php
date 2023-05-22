<div class="flex flex-wrap justify-around mt-6 pb-12 md:mb-0 md:px-3">
    <div class="w-full flex flex-col md:flex-row justify-between gap-3">
        <livewire:components.category-create />
        <livewire:components.category-scope :categories="$categories" wire:key="{{hash('md5',$categories)}}"/>
    </div>
</div>
