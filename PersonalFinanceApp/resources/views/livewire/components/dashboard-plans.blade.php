<div class="flex h-full flex-col md:flex-row md:pl-3 gap-2">
    <div class="w-full h-full order-2 md:order-1">
        <x-card cardClasses="h-full">
            <h2 class="flex items-center justify-center font-bold text-xl text-center mb-2">
                <x-icon name="puzzle" class="w-5 h-5 mr-1"/>
                Make plans
            </h2>

            <div class="flex w-full mb-2 justify-center">
                <button class="p-2 rounded-lg border w-3/5 flex justify-center items-center border-purple-600" wire:click="openModal">Add plan <x-icon name="plus" class="w-5 h-5 text-green-600 ml-2"/></button>
            </div>


            <div class="flex justify-between border rounded-lg mb-2">
                <div class="flex flex-1 items-center rounded-l-lg border-r">
                    <input id="planMethodActive" type="radio" class="hidden peer" value="1"
                           name="planMethod" wire:model="plansMethod"
                    >
                    <label for="planMethodActive"
                           class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">Active
                        Plans</label>
                </div>
                <div class="flex flex-1 items-center border-r">
                    <input id="planMethodCompleted" type="radio" class="hidden peer" value="0"
                           name="planMethod" wire:model="plansMethod">
                    <label for="planMethodCompleted"
                           class="text-xs md:text-sm whitespace-nowrap font-semibold w-full h-full flex justify-center p-2 peer-checked:bg-blue-100">Completed
                        Plans</label>
                </div>
            </div>


            <div class="flex flex-col" x-data="{ show: @entangle('plansMethod')}">
                @if($plansMethod)
                    @foreach($plans as $plan)
                        <div class="flex w-full justify-between hover:border p-1 rounded-lg items-center" x-show="show">
                            <x-button.circle negative icon="x" size="2xs" class="mr-1.5"
                                             wire:click="deletePlan({{$plan->id}})"/>
                            <p class="font-bold flex-1">{{$plan->plan_name}}</p>
                            <div>
                                    <?php
                                    $percent = $this->calculatePercent($plan->amount);
                                    ?>
                                <p class="flex-1 text-center">{{$plan->amount}} RON</p>
                                <p class="w-full text-center text-xs">{{number_format($percent,2)}}%</p>
                                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div
                                        class="{{$percent == 100 ? 'bg-green-600' : 'bg-purple-600'}} text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                        style="width: {{$percent}}%"></div>
                                </div>
                            </div>
                            <div class="flex-1 text-right">
                                @if($plan->prediction != "done")
                                    <p class="text-sm font-bold">Estimated time</p>
                                    <p>{{$plan->prediction}}</p>
                                @else
                                    <div class="flex justify-end">
                                        <x-button.circle positive icon="check" 2xs
                                                         wire:click="validatePlan({{$plan->id}})"/>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach($plans as $plan)
                        <div class="flex w-full justify-between hover:border p-1 rounded-lg items-center" x-show="show">
                            <x-button.circle negative icon="x" size="2xs" class="mr-1.5"
                                             wire:click="deletePlan({{$plan->id}})"/>
                            <p class="font-bold flex-1">{{$plan->plan_name}}</p>
                            <div>

                                <p class="flex-1 text-center">{{$plan->amount}} RON</p>
                                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div
                                        class="bg-green-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                        style="width: 100%"></div>
                                </div>
                            </div>
                            <div class="flex-1 text-right">
                                @if($plan->prediction != "done")
                                    <p>{{date('Y-m-d',strtotime($plan->validated_at))}}</p>
                                    <p class="text-sm font-bold">{{$plan->after}}</p>

                                @else
                                    <div class="flex justify-end">
                                        <x-button.circle positive icon="check" 2xs
                                                         wire:click="validatePlan({{$plan->id}})"/>
                                    </div>
                                @endif
                            </div>

                        </div>
                    @endforeach
                @endif
            </div>


        </x-card>
    </div>
    <x-modal.card title="Create new plan" blur wire:model="createPlanModal" align="start">

        <div class="mb-2 flex gap-2 flex-col">
            <x-input label="Plan name" placeholder="Plan name" wire:model.lazy="plan_name"/>
            <x-inputs.number label="Plan amount" wire:model.lazy="plan_amount"/>
        </div>

        <div class="flex justify-end gap-2">
            <x-button negative label="Cancel" wire:click="close"/>
            <x-button positive label="Save" wire:click="save"/>
        </div>
    </x-modal.card>
</div>




