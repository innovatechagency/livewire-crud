<div>
    <!-- Content Area -->
    <div class="p-xl max-w-5xl mx-auto w-full">
        <!-- Back Button -->
        <button class="flex items-center gap-xs text-primary font-label-lg hover:underline mb-lg group">
            <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition-transform"
                data-icon="arrow_back">arrow_back</span>
            Retour aux réservations
        </button>
        <!-- Header Section -->
        <div class="mb-xl">
            <h2 class="font-display-lg text-display-lg text-on-surface">{{ $tableId ? 'Modifier la table' : 'Ajouter une nouvelle table' }}</h2>
            <p class="font-body-md text-on-surface-variant mt-xs">
                {{ $tableId ? 'Modifiez les informations de votre table.' : 'Configurez l\'emplacement et la capacité de votre table.' }}
            </p>
        </div>
        <!-- Form Card -->
        <form wire:submit.prevent='store' class="bg-surface-container-lowest rounded-3xl shadow-sm border border-outline-variant p-xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-xl">
                <!-- Left Column: Details -->
                <div class="space-y-lg">
                    <div class="flex flex-col gap-base">
                        <label class="font-label-lg text-on-surface">Nom / Numéro de la table</label>
                        <input
                            wire:model="name"
                            class="@error('name') is-invalid @enderror w-full px-md py-sm rounded-xl border border-outline-variant focus:ring-2 focus:ring-primary focus:border-primary font-body-md bg-white"
                            placeholder="Ex: Table 12, VIP 1..." type="text" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-base">
                        <label class="font-label-lg text-on-surface">Capacité d'accueil</label>
                        <div class="flex items-center gap-md">
                            <button
                                wire:click="$set('capacity', {{ max(1, $capacity - 1) }})"
                                type="button"
                                class="w-12 h-12 rounded-xl border border-outline-variant flex items-center justify-center text-primary hover:bg-primary-container/10 active:scale-95 transition-all">
                                <span class="material-symbols-outlined" data-icon="remove">remove</span>
                            </button>
                            <div class="flex-1 text-center">
                                <input
                                    wire:model="capacity"
                                    class="@error('capacity') is-invalid @enderror w-full text-center border-none font-headline-md text-on-surface focus:ring-0 bg-transparent"
                                    type="number" value="4" />
                                <span class="font-body-sm text-on-surface-variant">Personnes</span>
                            </div>
                            <button
                                wire:click="$set('capacity', {{ $capacity + 1 }})"
                                type="button"
                                class="w-12 h-12 rounded-xl border border-outline-variant flex items-center justify-center text-primary hover:bg-primary-container/10 active:scale-95 transition-all">
                                <span class="material-symbols-outlined" data-icon="add">add</span>
                            </button>
                        </div>
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-base">
                        <label class="font-label-lg text-on-surface">Zone du restaurant</label>
                        <div class="grid grid-cols-3 gap-sm">
                            <button
                                wire:click="$set('zone', 'salle principal')"
                                type="button"
                                class="
                                px-md py-sm rounded-xl
                                border border-primary
                                bg-primary-container
                                text-on-primary-container
                                font-label-lg text-center
                                transition-all
                                {{ $zone === 'salle principal'
                                    ? 'border-primary bg-primary-container text-on-primary-container'
                                    : 'border-outline-variant bg-white text-on-surface-variant hover:bg-surface-container-low'
                                }}
                                ">
                                Salle principale
                            </button>
                            <button
                                type="button"
                                wire:click="$set('zone', 'terrasse')"
                                class="px-md py-sm rounded-xl border
                                    border-outline-variant bg-white
                                    text-on-surface-variant font-label-lg
                                    text-center hover:bg-surface-container-low
                                    transition-all
                                    {{ $zone === 'terrasse'
                                        ? 'border-primary bg-primary-container text-on-primary-container'
                                        : 'border-outline-variant bg-white text-on-surface-variant hover:bg-surface-container-low'
                                    }}
                                ">
                                Terrasse
                            </button>
                            <button
                                type="button"
                                wire:click="$set('zone', 'espace bar')"
                                class="px-md py-sm rounded-xl
                                    border border-outline-variant
                                    bg-white text-on-surface-variant
                                    font-label-lg text-center hover:bg-surface-container-low
                                    transition-all
                                    {{ $zone === 'espace bar'
                                        ? 'border-primary bg-primary-container text-on-primary-container'
                                        : 'border-outline-variant bg-white text-on-surface-variant hover:bg-surface-container-low'
                                    }}">
                                Espace Bar
                            </button>
                        </div>
                        @error('zone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Right Column: Status & Preview -->
                <div class="space-y-lg">
                    <div class="flex flex-col gap-base">

                        <label class="font-label-lg text-on-surface">
                            Statut de la table
                        </label>

                        <div class="grid grid-cols-2 gap-md">

                            <!-- Disponible -->
                            <label
                                wire:click="$set('status', 'available')"
                                class="relative flex flex-col items-center justify-center
                                p-lg rounded-2xl border-2 cursor-pointer transition-all

                                {{ $status === 'available'
                                    ? 'border-primary bg-primary-container/5'
                                    : 'border-outline-variant bg-white hover:border-primary/50'
                                }}"
                            >

                                <input
                                    wire:model="status"
                                    value="available"
                                    type="radio"
                                    class="hidden"
                                >

                                <span
                                    class="material-symbols-outlined text-primary text-[32px] mb-xs"
                                    style="font-variation-settings: 'FILL' 1;"
                                >
                                    check_circle
                                </span>

                                <span class="font-label-lg text-on-surface">
                                    Disponible
                                </span>

                                <span class="font-body-sm text-on-surface-variant">
                                    Prête pour réservation
                                </span>

                            </label>

                            <!-- Occupé -->
                            <label
                                wire:click="$set('status', 'occupied')"
                                class="relative flex flex-col items-center justify-center
                                p-lg rounded-2xl border-2 cursor-pointer transition-all

                                {{ $status === 'occupied'
                                    ? 'border-primary bg-primary-container/5'
                                    : 'border-outline-variant bg-white hover:border-primary/50'
                                }}"
                            >

                                <input
                                    wire:model="status"
                                    value="occupied"
                                    type="radio"
                                    class="hidden"
                                >

                                <span
                                    class="material-symbols-outlined text-on-surface-variant text-[32px] mb-xs"
                                >
                                    restaurant
                                </span>

                                <span class="font-label-lg text-on-surface">
                                    Occupé
                                </span>

                                <span class="font-body-sm text-on-surface-variant">
                                    Table en cours d'utilisation
                                </span>

                            </label>

                        </div>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="mt-xl flex items-center justify-end gap-md">
                <button
                    class="px-xl py-sm rounded-xl font-label-lg text-on-surface-variant hover:bg-surface-container-high transition-all">
                    Annuler
                </button>
                <button
                    type="submit"
                    class="px-xl py-sm rounded-xl bg-primary text-on-primary font-label-lg shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all">
                    {{ $tableId ? 'Mettre à jour' : 'Enregistrer la table' }}
                </button>
            </div>
        </form>
    </div>
</div>
