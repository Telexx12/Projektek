<div class="w-full px-1 md:px-2 md:w-6/12 md:relative order-1 md:order-2">
    <x-card cardClasses="min-h-[40vh] lg:h-[40vh] lg:overflow-y-scroll soft-scrollbar"
            class="flex flex-col justify-between">
        <x-select
            label="Select category"
            placeholder="Select category"
            :options="$category_names"
            option-label="category_name"
            option-value="id"
            wire:model="selected_category"
            class="mb-2"
        />

        <x-card cardClasses="flex-1 h-8/12" class="flex flex-col gap-2">
            <div class="flex-1">
                <div class="flex flex-wrap gap-2">
                    @if($scopes)
                        @foreach($scopes as $scope)
                            <div class="rounded-lg bg-blue-100">
                                <label class="text-sm font-semibold w-full h-full flex items-center p-1"><span
                                        class="bg-white rounded-lg p-1">{{$scope->category_scope_name}}</span></label>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex gap-2 items-center">
                <div class="flex-1">
                    <x-input placeholder="Add scope" wire:model="scope_name"/>
                </div>
                <x-button.circle icon="plus" positive class="md:w-20" wire:click="saveScope"/>
            </div>
        </x-card>
    </x-card>
</div>
