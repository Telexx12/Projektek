@props(['margin' => false, 'rootClass' => null])

<div class="fixed inset-0 z-20 flex items-end sm:z-10 sm:absolute sm:inset-auto transition-all ease-linear duration-150 {{ $rootClass }} !opacity-100"
    style="display: none"
    x-cloak
    x-show="popover"
    x-ref="popover"
    x-on:click.outside="close"
    x-on:keydown.escape.window="handleEscape">
    <div class="fixed inset-0 transition-opacity bg-secondary-400 bg-opacity-60 sm:hidden dark:bg-secondary-700 dark:bg-opacity-60"
        x-show="popover"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-on:click="close"
        aria-hidden="true">
    </div>

    <div
        {{ $attributes->class([
            'w-full rounded-t-md sm:rounded-xl border border-secondary-200 bg-white shadow-lg !opacity-100',
            'dark:bg-secondary-800 dark:border-secondary-600 transition-all relative overflow-hidden !opacity-100 bottom-20 md:bottom-0 z-20',
        ]) }}
        x-show="popover"
        tabindex="-1"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>
