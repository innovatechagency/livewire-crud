<div>
    <div class="relative w-full max-w-md">
        <span
            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
        <input
            wire:model.live.debounce.300ms="globalSearch"
            class="w-full bg-surface-container-low border-none rounded-full py-3 pl-12 pr-4 font-body-sm text-body-sm focus:ring-2 focus:ring-primary"
            placeholder="Rechercher un produit..." type="text" />
    </div>
</div>
