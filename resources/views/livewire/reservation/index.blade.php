<div>

    {{-- Modal --}}
    <div class="{{ $openModal ? 'flex' : 'hidden' }} fixed inset-0 z-[1000] items-start justify-center bg-on-background/40 backdrop-blur-sm p-md overflow-y-auto">
        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden border border-outline-variant/30 my-auto">

            {{-- Header --}}
            <div class="flex items-center justify-between p-lg border-b border-outline-variant/20">
                <h2 class="text-headline-md font-display text-on-surface">
                    {{ $editModal ? 'Modifier la réservation' : 'Nouvelle réservation' }}
                </h2>
                <a wire:click="closeModal" href="#"
                    class="p-2 hover:bg-surface-container-low rounded-full text-on-surface-variant transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </a>
            </div>

            {{-- Formulaire --}}
            <form wire:submit.prevent="store" class="p-lg space-y-md">

                {{-- Nom --}}
                <div>
                    <label class="block font-label-lg text-label-lg mb-xs">Nom du client</label>
                    <input
                        type="text"
                        wire:model="guest_name"
                        placeholder="Ex : Jean Dupont"
                        class="w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary @error('guest_name') ring-2 ring-error @enderror" />
                    @error('guest_name')
                        <span class="text-xs text-error mt-xs block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Téléphone --}}
                <div>
                    <label class="block font-label-lg text-label-lg mb-xs">Téléphone</label>
                    <input
                        type="tel"
                        wire:model="guest_phone"
                        placeholder="Ex : +33 6 12 34 56 78"
                        class="w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary @error('guest_phone') ring-2 ring-error @enderror" />
                    @error('guest_phone')
                        <span class="text-xs text-error mt-xs block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Table --}}
                <div>
                    <label class="block font-label-lg text-label-lg mb-xs">Table</label>
                    <select
                        wire:model="tableId"
                        class="w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary @error('tableId') ring-2 ring-error @enderror">
                        <option value="">Sélectionner une table</option>
                        @foreach (\App\Models\Table::where('status', 'available')->orWhere('id', $tableId)->get() as $table)
                            <option value="{{ $table->id }}">{{ $table->name }} — {{ $table->capacity }} pers. ({{ $table->zone }})</option>
                        @endforeach
                    </select>
                    @error('tableId')
                        <span class="text-xs text-error mt-xs block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Date & Heure --}}
                <div class="grid grid-cols-2 gap-md">
                    <div>
                        <label class="block font-label-lg text-label-lg mb-xs">Date</label>
                        <input
                            type="date"
                            wire:model="reservation_date"
                            class="w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary @error('reservation_date') ring-2 ring-error @enderror" />
                        @error('reservation_date')
                            <span class="text-xs text-error mt-xs block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-label-lg text-label-lg mb-xs">Heure</label>
                        <input
                            type="time"
                            wire:model="reservation_time"
                            class="w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary @error('reservation_time') ring-2 ring-error @enderror" />
                        @error('reservation_time')
                            <span class="text-xs text-error mt-xs block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Nombre de personnes --}}
                <div>
                    <label class="block font-label-lg text-label-lg mb-xs">Nombre de personnes</label>
                    <input
                        type="number"
                        wire:model="guest_count"
                        min="1"
                        class="w-full bg-surface-container-low border-none rounded-xl py-3 px-md font-body-sm text-body-sm focus:ring-2 focus:ring-primary @error('guest_count') ring-2 ring-error @enderror" />
                    @error('guest_count')
                        <span class="text-xs text-error mt-xs block">{{ $message }}</span>
                    @enderror
                </div>

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

    <div class="flex flex-1 overflow-hidden">
        <!-- Floor Plan / Tables View -->
        <div class="flex-1 p-margin-desktop overflow-y-auto bg-surface-container-lowest">
            <div class="flex items-center justify-between mb-xl">
                <h2 class="text-display-lg font-display text-on-surface">Plan de Salle</h2>
                <a
                    href="/manage"
                    class="flex items-center gap-sm bg-surface-container-high text-on-surface px-md py-sm rounded-xl font-label-lg font-semibold hover:bg-surface-variant transition-colors">
                    <span class="material-symbols-outlined">add</span>
                    <span>Ajouter une Table</span>
                </a>
            </div>
            <div class="grid grid-cols-3 gap-xl">
                @foreach ($tables as $table)

                    @php
                        $reservation = $table->reservations->first(); // réservation du jour
                        $isAvailable = $table->status === 'available';
                        $isReserved  = $table->status === 'reserved';
                        $isOccupied  = $table->status === 'occupied';
                    @endphp

                    <!-- Table Card Reserved -->
                    <div class="relative group">
                        <div
                            class="bg-white p-xl rounded-[32px]
                            shadow-[0px_4px_20px_rgba(0,0,0,0.04)]
                            border border-outline-variant/30 flex
                            flex-col items-center gap-md cursor-pointer
                            hover:shadow-[0px_10px_30px_rgba(0,0,0,0.08)]
                            transition-all
                            {{ $isAvailable ? 'border-outline-variant/30 border-dashed' : '' }}
                            {{ $isReserved  ? 'border-outline-variant/30' : '' }}
                            {{ $isOccupied  ? 'border-primary/40' : '' }}">

                            {{-- Badge statut --}}
                            <div class="absolute top-md right-md text-[10px] font-bold px-sm py-[2px] rounded-full uppercase tracking-wider
                                {{ $isAvailable ? 'bg-secondary-container text-on-secondary-container' : '' }}
                                {{ $isReserved  ? 'bg-tertiary-container text-on-tertiary-container' : '' }}
                                {{ $isOccupied  ? 'bg-primary-container text-on-primary-container' : '' }}">
                                {{ $isAvailable ? 'Disponible' : ($isReserved ? 'Réservé' : 'Occupé') }}
                            </div>

                            <div
                                class="w-12 h-12 rounded-2xl bg-tertiary-container/30 flex items-center justify-center text-tertiary font-display font-bold text-xl
                                {{ $isAvailable ? 'bg-secondary-container/30 text-secondary' : '' }}
                                {{ $isReserved  ? 'bg-tertiary-container/30 text-tertiary' : '' }}
                                {{ $isOccupied  ? 'bg-primary-container/30 text-primary' : '' }}">
                                {{ $table->name }}
                            </div>
                            {{-- Infos --}}
                            <div class="text-center">
                                @if ($isAvailable)
                                    <h3 class="font-display font-semibold text-on-surface-variant">Libre</h3>
                                    <p class="text-label-sm text-outline">Jusqu'à {{ $table->capacity }} Personnes</p>
                                @elseif (!$isAvailable && $reservation !== null)
                                    <h3 class="font-display font-semibold text-on-surface">{{ $reservation->guest_name }}</h3>
                                    <p class="text-label-sm text-on-surface-variant">
                                        {{ $reservation->guest_count }} Personnes •
                                        {{ $isOccupied ? 'En cours' : \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}
                                    </p>
                                @else
                                    {{-- Table réservée/occupée mais aucune réservation trouvée pour aujourd'hui --}}
                                    <h3 class="font-display font-semibold text-on-surface-variant">{{ $table->name }}</h3>
                                    <p class="text-label-sm text-outline">{{ $table->capacity }} Personnes max</p>
                                @endif
                            </div>

                            {{-- Dessin table --}}
                            <div class="w-32 h-20 bg-surface-container rounded-2xl relative border-2
                                {{ $isAvailable ? 'border-outline-variant/20' : 'border-dashed border-outline-variant/50' }}">
                                <div class="absolute -left-3 top-1/2 -translate-y-1/2 w-3 h-8 bg-outline-variant/40 rounded-full"></div>
                                <div class="absolute -right-3 top-1/2 -translate-y-1/2 w-3 h-8 bg-outline-variant/40 rounded-full"></div>
                                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-8 h-3 bg-outline-variant/40 rounded-full"></div>
                                <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-8 h-3 bg-outline-variant/40 rounded-full"></div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>

        <!-- Aside Réservations -->
        <aside class="w-[450px] bg-white border-l border-outline-variant flex flex-col h-full z-10">
            <div class="p-margin-desktop border-b border-outline-variant/50">
                <div class="flex items-center justify-between mb-xl">
                    <h2 class="text-display-lg font-display text-on-surface">Réservations</h2>
                </div>
                <button
                    wire:click="openCreate"
                    class="w-full bg-primary text-on-primary py-md rounded-2xl font-display font-bold text-lg shadow-lg shadow-primary/20 hover:bg-on-primary-fixed-variant transition-colors active:scale-[0.98] flex items-center justify-center gap-sm">
                    <span class="material-symbols-outlined">add</span>
                    Nouvelle Réservation
                </button>
            </div>

            <div class="flex-1  p-margin-desktop pt-lg">
                <h3 class="font-display font-semibold text-on-surface-variant mb-md">À venir</h3>
                <div class="space-y-sm">
                    @foreach ($reservations as $reservation)
                        <div class="relative">
                            <div class="flex items-start gap-md p-md bg-surface-container-low rounded-2xl hover:bg-surface-container-high cursor-pointer transition-colors border border-transparent hover:border-outline-variant/30
                                {{ $reservation->status === 'pending' ? 'opacity-80' : '' }}">

                                {{-- Heure + table --}}
                                <div class="flex flex-col items-center justify-center min-w-[60px]">
                                    <span class="text-title-lg font-display font-bold text-on-surface">
                                        {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}
                                    </span>
                                    @if ($reservation->table)
                                        <span class="text-[10px] font-bold text-on-surface-variant bg-surface-container-highest px-2 py-1 rounded-full mt-1">
                                            {{ $reservation->table->name }}
                                        </span>
                                    @else
                                        <span class="text-[10px] font-bold text-error bg-error-container/50 px-2 py-1 rounded-full mt-1">
                                            À assigner
                                        </span>
                                    @endif
                                </div>

                                {{-- Détails --}}
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <h4 class="font-label-lg text-base text-on-surface">{{ $reservation->guest_name }}</h4>
                                        <span class="text-[10px] font-bold px-sm py-[2px] rounded-full
                                            {{ $reservation->status === 'confirmed' ? 'bg-tertiary-container/50 text-on-tertiary-container' : 'bg-surface-variant text-on-surface-variant' }}">
                                            {{ match($reservation->status) {
                                                'confirmed' => 'Confirmé',
                                                'pending'   => 'En attente',
                                                'cancelled' => 'Annulé',
                                                'completed' => 'Terminé',
                                                default     => $reservation->status,
                                            } }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-on-surface-variant mt-1">
                                        {{ $reservation->guest_count }} Personnes • {{ $reservation->table->zone ?? 'Non assigné' }}
                                    </p>
                                    @if ($reservation->guest_phone)
                                        <div class="flex items-center gap-xs mt-2 text-xs text-on-surface-variant">
                                            <span class="material-symbols-outlined text-[14px]">phone</span>
                                            <span>{{ $reservation->guest_phone }}</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Bouton dropdown --}}
                                <button
                                    wire:click.stop="toggleDropdown({{ $reservation->id }})"
                                    class="p-1 rounded-full hover:bg-surface-container-highest transition-colors text-on-surface-variant self-start mt-1">
                                    <span class="material-symbols-outlined text-[18px]">more_vert</span>
                                </button>
                            </div>

                            {{-- Dropdown menu --}}
                            @if ($openDropdown === $reservation->id)
                                {{-- Overlay invisible pour fermer --}}
                                <div
                                    wire:click="toggleDropdown({{ $reservation->id }})"
                                    class="fixed inset-0 z-[10]">
                                </div>

                                <div class="absolute right-0 bottom-full mb-xs z-[200] bg-white rounded-2xl shadow-lg border border-outline-variant/30 overflow-hidden min-w-[180px]">

                                    {{-- Modifier --}}
                                    <button
                                        wire:click="openEdite({{ $reservation->id }})"
                                        class="w-full flex items-center gap-sm px-md py-sm hover:bg-surface-container-low transition-colors text-on-surface text-sm">
                                        <span class="material-symbols-outlined text-[18px] text-on-surface-variant">edit</span>
                                        Modifier
                                    </button>

                                    {{-- Confirmer (seulement si pending) --}}
                                    @if ($reservation->status === 'pending')
                                        <button
                                            wire:click="confirmReservation({{ $reservation->id }})"
                                            class="w-full flex items-center gap-sm px-md py-sm hover:bg-surface-container-low transition-colors text-on-surface text-sm">
                                            <span class="material-symbols-outlined text-[18px] text-tertiary">check_circle</span>
                                            Confirmer
                                        </button>
                                    @endif

                                    {{-- Marquer occupé (seulement si confirmed) --}}
                                    @if ($reservation->status === 'confirmed')
                                        <button
                                            wire:click="markAsOccupied({{ $reservation->id }})"
                                            class="w-full flex items-center gap-sm px-md py-sm hover:bg-surface-container-low transition-colors text-on-surface text-sm">
                                            <span class="material-symbols-outlined text-[18px] text-primary">restaurant</span>
                                            Client arrivé
                                        </button>
                                    @endif

                                    {{-- Libérer la table (seulement si completed) --}}
                                    @if ($reservation->status === 'completed' && $reservation->table)
                                        <button
                                            wire:click="freeTable({{ $reservation->table_id }})"
                                            class="w-full flex items-center gap-sm px-md py-sm hover:bg-surface-container-low transition-colors text-on-surface text-sm">
                                            <span class="material-symbols-outlined text-[18px] text-secondary">table_restaurant</span>
                                            Libérer la table
                                        </button>
                                    @endif

                                    {{-- Séparateur --}}
                                    <div class="border-t border-outline-variant/20 my-xs"></div>

                                    {{-- Annuler (seulement si pas déjà annulé ou terminé) --}}
                                    @if (!in_array($reservation->status, ['cancelled', 'completed']))
                                        <button
                                            wire:click="cancelReservation({{ $reservation->id }})"
                                            class="w-full flex items-center gap-sm px-md py-sm hover:bg-error-container/20 transition-colors text-error text-sm">
                                            <span class="material-symbols-outlined text-[18px]">cancel</span>
                                            Annuler
                                        </button>
                                    @endif

                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>
    </div>

</div>
