<div class="flex flex-col gap-lg">

    <!-- Modal: Ajouter un nouvel article -->
    <div  class="{{ $openModal ? 'flex' : 'hidden' }} fixed inset-0 z-[100] items-center justify-center bg-on-background/40 backdrop-blur-sm p-md"
        id="add-item-modal">
        <div
            class="bg-white dark:bg-on-background w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden border border-outline-variant/30">
            <div class="flex items-center justify-between p-lg border-b border-outline-variant/20">
                <h2 class="text-headline-md font-display-lg text-on-surface dark:text-surface-bright">{{ $editModal ? 'Modifier un produits' : 'Ajouter un produits' }}</h2>
                <a wire:click="closeModal" class="p-2 hover:bg-surface-container-low rounded-full text-on-surface-variant transition-colors"
                    href="#">
                    <span class="material-symbols-outlined">close</span>
                </a>
            </div>
            <form wire:submit.prevent="save" class="p-lg space-y-md" >
                <div>
                    <label class="block font-label-lg text-label-lg mb-xs">Nom de l'article</label>
                    <input
                        wire:model="name"  class="@error('name') is-invalid @enderror w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary"
                        placeholder="Ex: Salade César au Poulet" type="text" />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="grid grid-cols-2 gap-md">
                    <div>
                        <label class="block font-label-lg text-label-lg mb-xs">Catégorie</label>
                        <select
                            wire:model='category'
                            class="@error('category') is-invalid @enderror w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary">
                            <option value="">-- Choisir une catégorie --</option>
                            <option value="Petit Déjeuner">Petit Déjeuner</option>
                            <option value="Soupes">Soupes</option>
                            <option value="Pâtes">Pâtes</option>
                            <option value="Fruits de mer">Fruits de mer</option>
                            <option value="Burgers">Burgers</option>
                            <option value="Boissons">Boissons</option>
                            <option value="Desserts">Desserts</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-label-lg text-label-lg mb-xs">Prix (€)</label>
                        <input
                            wire:model='price'
                            class="@error('price') is-invalid @enderror w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary"
                            placeholder="0.00" step="0.01" type="number" />
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <label class="block font-label-lg text-label-lg mb-xs">Quantité</label>
                    <input
                        wire:model='quantity'
                        class="@error('quantity') is-invalid @enderror w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary"
                        placeholder="ex: 200"  type="number" />
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Image
                        @if($editModal)
                            <span class="text-gray-400 text-xs">
                                (laisser vide pour conserver)
                            </span>
                        @endif
                    </label>

                    {{-- Prévisualisation --}}
                    @if (($editModal && $currentImage && !$image) || $image)
                        <div class="mb-4 flex justify-center">
                            <img
                                src="{{ $image ? $image->temporaryUrl() : Storage::url($currentImage) }}"
                                class="w-28 h-28 rounded-2xl object-cover border border-gray-200 shadow-sm"
                            >
                        </div>
                    @endif

                    {{-- Input Upload --}}
                    <label
                        class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed rounded-2xl cursor-pointer transition
                        @error('image')
                            border-red-400 bg-red-50
                        @else
                            border-gray-300 bg-gray-50 hover:bg-gray-100
                        @enderror
                        "
                    >
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">

                            <svg class="w-10 h-10 mb-3 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>

                            <p class="mb-1 text-sm text-gray-600">
                                <span class="font-semibold">Clique pour uploader</span>
                            </p>

                            <p class="text-xs text-gray-400">
                                PNG, JPG ou JPEG (Max 2MB)
                            </p>
                        </div>

                        <input
                            type="file"
                            wire:model="image"
                            accept="image/*"
                            class="hidden"
                        >
                    </label>

                    {{-- Loader --}}
                    <div
                        wire:loading
                        wire:target="image"
                        class="mt-3 text-sm text-primary font-medium"
                    >
                        ⏳ Chargement de l'image...
                    </div>

                    {{-- Erreur --}}
                    @error('image')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="pt-md flex gap-md">

                    <button
                        type="button"
                        wire:click="closeModal"
                        class="flex-1 text-center py-3 border border-outline rounded-xl"
                    >
                        Annuler
                    </button>

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="flex-1 py-3 bg-primary text-on-primary rounded-xl"
                    >

                        @if($editModal)

                            <span wire:loading.remove>
                                Mettre à jour
                            </span>

                            <span wire:loading>
                                Sauvegarde...
                            </span>

                        @else

                            <span wire:loading.remove>
                                Créer
                            </span>

                            <span wire:loading>
                                Création...
                            </span>

                        @endif

                    </button>

                </div>
            </form>
        </div>
    </div>

    <!-- Category Chips Section -->
    <section class="flex gap-md overflow-x-auto pb-base no-scrollbar">
        <button
            type="button"
            wire:click="$set('categorySearch', '')"
            class="flex-shrink-0 p-md rounded-2xl w-24 h-24 flex flex-col items-center justify-center gap-xs transition-all active:scale-95 shadow-lg
            {{ $categorySearch === '' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/30 text-on-surface-variant hover:shadow-md' }}"
        >
            <span class="material-symbols-outlined text-3xl"
                style="{{ $categorySearch === '' ? "font-variation-settings: 'FILL' 1" : '' }}">
                grid_view
            </span>
            <span class="font-label-sm text-label-sm">Tous</span>
        </button>

        <!-- Petit Déjeuner -->
        <button
            type="button"
            wire:click="$set('categorySearch', 'Petit Déjeuner')"
            class="flex-shrink-0 p-md rounded-2xl w-24 h-24 flex flex-col items-center justify-center gap-xs transition-all active:scale-95 shadow-sm
            {{ $categorySearch === 'Petit Déjeuner' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/30 text-on-surface-variant hover:shadow-md group' }}"
        >
            <span class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform"
                style="{{ $categorySearch === 'Petit Déjeuner' ? "font-variation-settings: 'FILL' 1" : '' }}">
                breakfast_dining
            </span>
            <span class="font-label-sm text-label-sm">Petit Déj</span>
        </button>

        <!-- Soupes -->
        <button
            type="button"
            wire:click="$set('categorySearch', 'Soupes')"
            class="flex-shrink-0 p-md rounded-2xl w-24 h-24 flex flex-col items-center justify-center gap-xs transition-all active:scale-95 shadow-sm
            {{ $categorySearch === 'Soupes' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/30 text-on-surface-variant hover:shadow-md group' }}"
        >
            <span class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform"
                style="{{ $categorySearch === 'Soupes' ? "font-variation-settings: 'FILL' 1" : '' }}">
                soup_kitchen
            </span>
            <span class="font-label-sm text-label-sm">Soupes</span>
        </button>

        <!-- Pâtes -->
        <button
            type="button"
            wire:click="$set('categorySearch', 'Pâtes')"
            class="flex-shrink-0 p-md rounded-2xl w-24 h-24 flex flex-col items-center justify-center gap-xs transition-all active:scale-95 shadow-sm
            {{ $categorySearch === 'Pâtes' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/30 text-on-surface-variant hover:shadow-md group' }}"
        >
            <span class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform"
                style="{{ $categorySearch === 'Pâtes' ? "font-variation-settings: 'FILL' 1" : '' }}">
                dinner_dining
            </span>
            <span class="font-label-sm text-label-sm">Pâtes</span>
        </button>

        <button
            type="button"
            wire:click="$set('categorySearch', 'Poissons')"
            class="flex-shrink-0 p-md rounded-2xl w-24 h-24 flex flex-col items-center justify-center gap-xs transition-all active:scale-95 shadow-sm
            {{ $categorySearch === 'Poissons' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/30 text-on-surface-variant hover:shadow-md group' }}"
        >
            <span class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform"
                style="{{ $categorySearch === 'Poissons' ? "font-variation-settings: 'FILL' 1" : '' }}">
                set_meal
            </span>
            <span class="font-label-sm text-label-sm">Poissons</span>
        </button>

        <button
            type="button"
            wire:click="$set('categorySearch', 'Burgers')"
            class="flex-shrink-0 p-md rounded-2xl w-24 h-24 flex flex-col items-center justify-center gap-xs transition-all active:scale-95 shadow-sm
            {{ $categorySearch === 'Burgers' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/30 text-on-surface-variant hover:shadow-md group' }}"
        >
            <span class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform"
                style="{{ $categorySearch === 'Burgers' ? "font-variation-settings: 'FILL' 1" : '' }}">
                lunch_dining
            </span>
            <span class="font-label-sm text-label-sm">Burgers</span>
        </button>

        <button
            type="button"
            wire:click="$set('categorySearch', 'Boissons')"
            class="flex-shrink-0 p-md rounded-2xl w-24 h-24 flex flex-col items-center justify-center gap-xs transition-all active:scale-95 shadow-sm
            {{ $categorySearch === 'Boissons' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/30 text-on-surface-variant hover:shadow-md group' }}"
        >
            <span class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform"
                style="{{ $categorySearch === 'Boissons' ? "font-variation-settings: 'FILL' 1" : '' }}">
                local_bar
            </span>
            <span class="font-label-sm text-label-sm">Boissons</span>
        </button>

        <button
            type="button"
            wire:click="$set('categorySearch', 'Boissons')"
            class="flex-shrink-0 p-md rounded-2xl w-24 h-24 flex flex-col items-center justify-center gap-xs transition-all active:scale-95 shadow-sm
            {{ $categorySearch === 'Boissons' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/30 text-on-surface-variant hover:shadow-md group' }}"
        >
            <span class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform"
                style="{{ $categorySearch === 'Boissons' ? "font-variation-settings: 'FILL' 1" : '' }}">
                local_bar
            </span>
            <span class="font-label-sm text-label-sm">Boissons</span>
        </button>

        <button
            type="button"
            wire:click="$set('categorySearch', 'Desserts')"
            class="flex-shrink-0 p-md rounded-2xl w-24 h-24 flex flex-col items-center justify-center gap-xs transition-all active:scale-95 shadow-sm
            {{ $categorySearch === 'Desserts' ? 'bg-primary text-on-primary' : 'bg-white border border-outline-variant/30 text-on-surface-variant hover:shadow-md group' }}"
        >
            <span class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform"
                style="{{ $categorySearch === 'Desserts' ? "font-variation-settings: 'FILL' 1" : '' }}">
                cake
            </span>
            <span class="font-label-sm text-label-sm">Desserts</span>
        </button>

    </section>
    <!-- Bento Grid of Menu Items -->

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-gutter">
        <!-- Item Card 1 -->
        @forelse ($products as $product)
            <div
                class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all border border-outline-variant/20 flex flex-col group">
                <div class="relative h-48 overflow-hidden">
                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    src="{{ Storage::url($product->image) }}" />
                    @if ($product->quantity > 0)
                        <div
                            class="absolute top-3 left-3 bg-primary text-on-primary px-3 py-1 rounded-full font-label-sm text-label-sm">
                            En stock
                        </div>
                    @else
                        <div class="absolute inset-0 bg-black/10 flex items-center justify-center">
                            <div
                                    class="bg-error text-on-error px-4 py-2 rounded-full font-label-lg text-label-lg shadow-lg">
                                    Rupture
                            </div>
                        </div>
                    @endif

                </div>
                <div class="p-md flex flex-col flex-1">
                    <div class="flex justify-between items-start mb-base">
                        <h3 class="font-title-lg text-title-lg text-on-surface pr-sm"> {{ $product->name }} </h3>
                        <div class="flex items-center gap-xs -mt-1 -mr-1 shrink-0">
                            <button
                                wire:click="openEdite({{ $product->id }})"
                                class="w-8 h-8 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-surface-container hover:text-primary transition-colors"
                                title="Modifier">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </button>
                            <button
                                wire:click="destroy({{ $product->id }})"
                                wire:confirm="Supprimer cet article ?"
                                class="w-8 h-8 flex items-center justify-center rounded-full text-on-surface-variant hover:bg-error-container hover:text-error transition-colors"
                                title="Supprimer">
                                <span class="material-symbols-outlined text-[20px]">delete</span>
                            </button>
                        </div>
                    </div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mb-md">Catégorie:
                        {{ $product->category }} </p>
                    <div class="mt-auto flex items-center justify-between">
                        <span class="font-headline-md text-headline-md text-primary"> {{ $product->price }}€</span>
                        <div class="flex items-center gap-xs">
                            <span class="material-symbols-outlined text-primary-container"
                                style="font-variation-settings: 'FILL' 1;">eco</span>
                            <span class="font-label-sm text-label-sm text-primary">Veg</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse


        <!-- Add New Item Skeleton Card -->
        <button wire:click="openCreate" class="bg-surface-container-low rounded-3xl overflow-hidden border-2 border-dashed border-outline-variant flex items-center justify-center p-xl cursor-pointer hover:border-primary group transition-all h-full min-h-[400px]"
            type="button">
            <div class="flex flex-col items-center gap-md">
                <div
                    class="w-16 h-16 rounded-full bg-white flex items-center justify-center text-on-surface-variant group-hover:text-primary group-hover:scale-110 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-4xl">add</span>
                </div>
                <p
                    class="font-title-lg text-title-lg text-on-surface-variant group-hover:text-primary transition-colors text-center">
                    Nouveau Produit</p>
            </div>
        </button>
    </section>
</div>
