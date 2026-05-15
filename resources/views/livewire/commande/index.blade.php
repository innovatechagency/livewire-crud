<div>

    {{-- Modal --}}
    <div class="{{ $openModal ? 'flex' : 'hidden' }} fixed inset-0 z-[1000] items-start justify-center bg-on-background/40 backdrop-blur-sm p-md overflow-y-auto">
        <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl overflow-hidden border border-outline-variant/30 my-auto">

            {{-- Header --}}
            <div class="flex items-center justify-between p-lg border-b border-outline-variant/20">
                <h2 class="text-headline-md font-display text-on-surface">
                    {{ $editModal ? 'Modifier la commande' : 'Nouvelle commande' }}
                </h2>
                <a wire:click="closeModal" href="#"
                    class="p-2 hover:bg-surface-container-low rounded-full text-on-surface-variant transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </a>
            </div>

            <form wire:submit.prevent="store" class="p-lg space-y-md">

                {{-- Table & Notes --}}
                <div class="grid grid-cols-2 gap-md">
                    <div>
                        <label class="block font-label-lg text-label-lg mb-xs">Table</label>
                        <select
                            wire:model="tableId"
                            class="w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary">
                            <option value="">Sans table (passant)</option>
                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}">{{ $table->name }} — {{ $table->zone }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-label-lg text-label-lg mb-xs">Notes</label>
                        <input
                            type="text"
                            wire:model="notes"
                            placeholder="Instructions spéciales..."
                            class="w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary" />
                    </div>
                </div>

                {{-- Produits --}}
                <div>
                    <label class="block font-label-lg text-label-lg mb-xs">Produits</label>

                    {{-- Recherche + filtre --}}
                    <div class="flex gap-sm mb-sm">
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="searchProduct"
                            placeholder="Rechercher un produit..."
                            class="flex-1 bg-surface-container-low border-none rounded-xl py-2 px-md text-sm focus:ring-2 focus:ring-primary" />
                        <select
                            wire:model.live="filterCategory"
                            class="bg-surface-container-low border-none rounded-xl py-2 px-md text-sm focus:ring-2 focus:ring-primary">
                            <option value="">Toutes les catégories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Liste filtrée --}}
                    <div class="grid grid-cols-2 gap-sm max-h-[250px] overflow-y-auto pr-xs">
                        @forelse ($products as $product)
                            <button
                                type="button"
                                wire:click="addToCart({{ $product->id }})"
                                class="flex items-center justify-between p-sm bg-surface-container-low rounded-xl hover:bg-surface-container-high transition-colors border border-transparent hover:border-outline-variant/30">
                                <div class="text-left">
                                    <p class="text-sm font-semibold text-on-surface">{{ $product->name }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $product->category }}</p>
                                </div>
                                <span class="text-sm font-bold text-primary">{{ number_format($product->price, 2) }}€</span>
                            </button>
                        @empty
                            <p class="col-span-2 text-sm text-on-surface-variant text-center py-md">Aucun produit trouvé</p>
                        @endforelse
                    </div>
                </div>

                {{-- Panier --}}
                @if (count($cart) > 0)
                    <div>
                        <label class="block font-label-lg text-label-lg mb-xs">Panier</label>
                        <div class="space-y-xs">
                            @foreach ($cart as $productId => $item)
                                <div class="flex items-center justify-between p-sm bg-surface-container-low rounded-xl">
                                    <span class="text-sm text-on-surface flex-1">{{ $item['name'] }}</span>

                                    {{-- Quantité --}}
                                    <div class="flex items-center gap-xs">
                                        <button type="button" wire:click="decrementQuantity({{ $productId }})"
                                            class="w-6 h-6 rounded-full bg-surface-container-high flex items-center justify-center hover:bg-surface-container-highest transition-colors">
                                            <span class="material-symbols-outlined text-[14px]">remove</span>
                                        </button>
                                        <span class="text-sm font-bold text-on-surface w-6 text-center">{{ $item['quantity'] }}</span>
                                        <button type="button" wire:click="incrementQuantity({{ $productId }})"
                                            class="w-6 h-6 rounded-full bg-surface-container-high flex items-center justify-center hover:bg-surface-container-highest transition-colors">
                                            <span class="material-symbols-outlined text-[14px]">add</span>
                                        </button>
                                    </div>

                                    <span class="text-sm font-bold text-primary w-16 text-right">{{ number_format($item['subtotal'], 2) }}€</span>

                                    <button type="button" wire:click="removeFromCart({{ $productId }})"
                                        class="ml-sm p-1 rounded-full hover:bg-error-container/30 transition-colors text-error">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        {{-- Total --}}
                        <div class="flex justify-between items-center mt-md pt-md border-t border-outline-variant/20">
                            <span class="font-display font-bold text-on-surface">Total</span>
                            <span class="font-display font-bold text-primary text-xl">{{ number_format($this->getTotal(), 2) }}€</span>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-on-surface-variant text-center py-md">Aucun produit ajouté</p>
                @endif

                @error('cart')
                    <span class="text-xs text-error block">{{ $message }}</span>
                @enderror

                {{-- Actions --}}
                <div class="pt-md flex gap-md">
                    <button
                        type="button"
                        wire:click="closeModal"
                        class="flex-1 text-center py-3 border border-outline rounded-xl text-on-surface-variant font-display font-semibold hover:bg-surface-container-low transition-colors">
                        Annuler
                    </button>
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="flex-1 py-3 bg-primary text-on-primary rounded-xl font-display font-bold shadow-lg shadow-primary/20 active:scale-[0.98] transition-all">
                        @if ($editModal)
                            <span wire:loading.remove>Modifier</span>
                            <span wire:loading>Sauvegarde...</span>
                        @else
                            <span wire:loading.remove>Créer</span>
                            <span wire:loading>Création...</span>
                        @endif
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="mb-xl flex justify-between items-end">
        <div>
            <h2 class="font-display-lg text-display-lg text-on-surface mb-xs">Commandes Actives</h2>
            <p class="font-body-md text-on-surface-variant">Gestion en temps réel des commandes en salle et
                livraisons.</p>
        </div>
        <div class="flex gap-sm">
            <div
                class="bg-white px-md py-sm rounded-xl shadow-sm border border-outline-variant flex items-center gap-sm">
                <span class="material-symbols-outlined text-primary"
                    data-icon="calendar_today">calendar_today</span>
                <span class="font-label-lg text-label-lg">{{ now()->translatedFormat('d M Y') }}</span>
            </div>
            <button
                wire:click="openCreate"
                class="bg-primary text-on-primary px-lg py-sm rounded-xl font-label-lg text-label-lg flex items-center gap-sm shadow-md hover:brightness-110 active:scale-95 transition-all">
                <span class="material-symbols-outlined" data-icon="add_circle">add_circle</span>
                Nouvelle Commande
            </button>
        </div>
    </div>

    {{-- Filters --}}
    <div class="flex gap-sm mb-lg">
        <button
            wire:click="$set('filterStatus', '')"
            class="px-md py-xs rounded-full font-label-lg text-label-lg transition-colors
                {{ $filterStatus === '' ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface hover:bg-surface-container-highest' }}">
            Toutes
        </button>
        <button
            wire:click="$set('filterStatus', 'in_progress')"
            class="px-md py-xs rounded-full font-label-lg text-label-lg transition-colors
                {{ $filterStatus === 'in_progress' ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface hover:bg-surface-container-highest' }}">
            En cours
        </button>
        <button
            wire:click="$set('filterStatus', 'completed')"
            class="px-md py-xs rounded-full font-label-lg text-label-lg transition-colors
                {{ $filterStatus === 'completed' ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface hover:bg-surface-container-highest' }}">
            Terminées
        </button>
        <button
            wire:click="$set('filterStatus', 'cancelled')"
            class="px-md py-xs rounded-full font-label-lg text-label-lg transition-colors
                {{ $filterStatus === 'cancelled' ? 'bg-primary text-on-primary' : 'bg-surface-container-high text-on-surface hover:bg-surface-container-highest' }}">
            Annulées
        </button>
    </div>

    {{-- Grid of Orders --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-gutter">
        @forelse ($orders as $order)
            @php
                $isPending    = $order->status === 'pending';
                $isInProgress = $order->status === 'in_progress';
                $isCompleted  = $order->status === 'completed';
                $isCancelled  = $order->status === 'cancelled';
            @endphp

            <div class="bg-white rounded-[20px] p-md shadow-[0px_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex flex-col gap-md
                {{ $isCancelled ? 'opacity-90' : '' }}">

                {{-- Header --}}
                <div class="flex justify-between items-start">
                    <div>
                        <div class="flex items-center gap-sm mb-1">
                            <h3 class="font-title-lg text-title-lg text-on-surface">{{ $order->reference }}</h3>
                            <span class="px-2 py-0.5 rounded-full font-label-sm text-label-sm
                                {{ $isPending    ? 'bg-surface-variant text-on-surface-variant' : '' }}
                                {{ $isInProgress ? 'bg-secondary-container text-on-secondary-container' : '' }}
                                {{ $isCompleted  ? 'bg-primary-container text-on-primary-container' : '' }}
                                {{ $isCancelled  ? 'bg-error-container text-on-error-container' : '' }}">
                                {{ match($order->status) {
                                    'pending'     => 'En attente',
                                    'in_progress' => 'En cours',
                                    'completed'   => 'Terminée',
                                    'cancelled'   => 'Annulée',
                                    default       => $order->status,
                                } }}
                            </span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                            {{ $order->created_at->translatedFormat('d M Y, H:i') }}
                            @if ($order->table)
                                • {{ $order->table->name }}
                            @else
                                • Passant
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Items --}}
                <div class="flex flex-col gap-sm">
                    @foreach ($order->items as $index => $item)
                        @if ($index > 0)
                            <div class="h-px bg-outline-variant/30"></div>
                        @endif
                        <div class="flex gap-md items-center {{ $isCompleted ? 'opacity-60' : '' }}">
                            @if ($item->product->image)
                                <img
                                    src="{{ Storage::url($item->product->image) }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-16 h-16 rounded-xl object-cover bg-surface-container" />
                            @else
                                <div class="w-16 h-16 bg-surface-container rounded-xl flex items-center justify-center">
                                    <span class="material-symbols-outlined text-outline">restaurant</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h4 class="font-label-lg text-label-lg">{{ $item->product->name }}</h4>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $item->product->category }}</p>
                                <div class="flex justify-between items-center mt-xs">
                                    <span class="font-label-lg text-label-lg text-primary">{{ number_format($item->price, 2) }} €</span>
                                    <span class="font-label-sm text-label-sm text-on-surface-variant">Qté: {{ $item->quantity }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Footer --}}
                <div class="mt-auto pt-md border-t border-dashed border-outline-variant flex items-center justify-between">
                    <div>
                        <p class="font-label-sm text-label-sm text-on-surface-variant">
                            Total: {{ $order->items->count() }} {{ $order->items->count() > 1 ? 'articles' : 'article' }}
                        </p>
                        <p class="font-title-lg text-title-lg text-on-surface">{{ number_format($order->total, 2) }} €</p>
                    </div>

                    <div class="flex gap-sm">
                        {{-- En attente ou En cours : Annuler + Valider --}}
                        @if ($isPending || $isInProgress)
                            <button
                                wire:click="delete({{ $order->id }})"
                                wire:confirm="Confirmer la suppression ?"
                                class="w-12 h-12 rounded-xl bg-error-container/10 border border-error-container text-error flex items-center justify-center hover:bg-error-container hover:text-on-error-container transition-all">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                            <button
                                wire:click="updateStatus({{ $order->id }}, 'completed')"
                                class="w-12 h-12 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center shadow-sm hover:brightness-105 active:scale-95 transition-all">
                                <span class="material-symbols-outlined">check</span>
                            </button>
                        @endif

                        {{-- Annulée --}}
                        @if ($isCancelled)
                            <div class="flex-1">
                                <button class="w-full py-sm border border-error text-error rounded-xl font-label-lg text-label-lg flex items-center justify-center gap-xs bg-error-container/5 uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-[18px]">close</span>
                                    REJETÉE
                                </button>
                            </div>
                        @endif

                        {{-- Terminée --}}
                        @if ($isCompleted)
                            <div class="flex-1">
                                <button class="w-full py-sm border border-primary text-primary rounded-xl font-label-lg text-label-lg flex items-center justify-center gap-xs bg-primary-container/5 uppercase tracking-wider">
                                    <span class="material-symbols-outlined text-[18px]">check</span>
                                    TERMINÉE
                                </button>
                            </div>
                        @endif

                        {{-- Modifier (toujours disponible sauf terminée/annulée) --}}
                        @if (!$isCompleted && !$isCancelled)
                            <button
                                wire:click="openEdit({{ $order->id }})"
                                class="w-12 h-12 rounded-xl bg-surface-container-low border border-outline-variant/30 flex items-center justify-center hover:bg-surface-container transition-all">
                                <span class="material-symbols-outlined">edit</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-xl text-on-surface-variant">
                Aucune commande trouvée
            </div>
        @endforelse
    </div>

    <!-- FAB for quick actions -->
    <button
        class="fixed bottom-xl right-xl w-14 h-14 bg-primary text-on-primary rounded-full shadow-2xl flex items-center justify-center hover:scale-105 transition-transform group">
        <span class="material-symbols-outlined text-[32px]" data-icon="restaurant_menu">restaurant_menu</span>
        <span
            class="absolute right-full mr-md px-md py-xs bg-on-background text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none font-label-lg text-label-lg">Ouvrir
            le Menu</span>
    </button>

</div>
