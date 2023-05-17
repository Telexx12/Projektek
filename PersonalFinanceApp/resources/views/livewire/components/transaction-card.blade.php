<x-card cardClasses="mb-2 md:mb-6" class="!py-2 md:!py-5">
    <div class="flex justify-start">
        <div class="mb-1 hidden md:block" wire:click="deleteTransaction">
            <x-icon name="x-circle" class="w-7 text-red-600"/>
        </div>
        <div class="mb-1 md:hidden" wire:click="deletePhoneTransaction">
            <x-icon name="x-circle" class="w-7 text-red-600"/>
        </div>
    </div>
    <div class="flex flex-col">

        <livewire:components.category-select :categories="$categories" :transaction="$transaction"
                                             :wire:key="'item-'.$transaction->id"/>

        <div class="flex flex-col justify-between md:flex-row mt-2">
            <div class="w-100 md:w-9/12 mb-2 md:mb-0">
                <p class="text-sm font-bold text-center mb-2">
                    {{$transaction->completed_date}}
                </p>
                <p class="text-sm md:text-base">
                    {{$transaction->description}}
                </p>
            </div>
            <div class="flex justify-center items-center w-100 text-right md:w-2/12">
                <p class="font-bold text-lg md:text-xl whitespace-nowrap">{{$transaction->amount}} {{$transaction->currency}}  @if($transaction->amount > 0)
                        <span class="text-green-600"><i
                                class="fa-solid fa-arrow-trend-up"></i></span>
                    @else
                        <span class="text-red-600"><i
                                class="fa-solid fa-arrow-trend-down"></i></span>
                    @endif</p>
            </div>
        </div>
        <div class="relative" x-data="{comment: @entangle('comment')}">
            <div x-show="comment" class="ml-0 md:ml-3 md:mt-2" style="display: none" x-data="{edit:false}">
                <input type="text" id="floating_filled.{{$transaction->id}}"
                       class="block w-[90%] [&:not(:focus)]:border-none rounded-full px-2.5 [&:not(:focus)]:pt-4 w-full text-sm text-gray-900  focus:border-gray-300 focus:pt-2 focus:w-full focus:mt-5 peer"
                       placeholder=" " x-model.lazy="comment" x-show="edit" x-ref="input" @blur="edit = !edit"/>
                <div class="flex mt-2" x-show="!edit">
                    <span class="rounded-full w-1 bg-purple-600 block peer-focus:hidden"></span>
                    <p class="ml-2 inline-block text-sm w-[95%] focus:hidden" x-text="comment"
                       x-on:click="edit = !edit; $nextTick(() => { setTimeout(() => { $refs.input.focus(); }, 10); });"></p>
                    <div class="flex justify-end w-[5%]">
                        <x-icon name="trash" solid class="w-5 inline-block peer-focus:hidden text-red-700"
                                x-on:click="$wire.deleteComment"
                        />
                    </div>
                </div>
                <x-icon name="paper-airplane" solid
                        class="rotate-90 w-[0.95rem] absolute hidden peer-focus:block top-8 right-3 text-blue-500"
                />

            </div>
            <div x-show="!comment" style="display: none">
                <input type="text" id="input_no_comment-{{$transaction->id}}"
                       class="block [&:not(:focus)]:border-none rounded-full px-2.5 [&:not(:focus)]:pt-5 w-full text-sm text-gray-900 focus:outline-none focus:ring-0 focus:border-gray-300 focus:pt-2 focus:mt-5 peer"
                       placeholder=" "
                       wire:model.lazy="comment"
                />
                <x-icon name="paper-airplane" solid
                        class="rotate-90 w-[0.95rem] absolute hidden peer-focus:block top-8 right-3 text-blue-500"
                />

                <label for="input_no_comment-{{$transaction->id}}"
                       class="absolute flex text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-2.5 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4">
                    <x-icon name="plus-circle" class="w-5 h-5 text-green-500"/>
                    Add comment
                </label>
            </div>
        </div>
    </div>
</x-card>
