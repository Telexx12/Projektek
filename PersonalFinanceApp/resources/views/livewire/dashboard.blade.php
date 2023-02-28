<div>
    <h1 x-data="{ message: 'AlpineJs working' }"  x-text="message" class="text-6xl font-bold underline">
        Hello world!
    </h1>
    <x-input wire:model="firstName" label="Name" placeholder="User's first name" />
    <h1 x-data="{text : @entangle('firstName')}" x-text="text"></h1>
</div>
