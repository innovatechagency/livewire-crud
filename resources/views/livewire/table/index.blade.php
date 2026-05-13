<div>
    <div class="flex flex-1 overflow-hidden">
        <!-- Floor Plan Canvas -->
        <div class="flex-1 p-margin-desktop overflow-y-auto">
            <div class="grid grid-cols-3 gap-xl">
                @forelse ($tables as $table)
                    <!-- Table Card Reserved -->
                    <div class="relative group">

                        <button
                            wire:click="destroy({{ $table->id }})"
                            wire:confirm="Supprimer cette table ?"
                            class="absolute -top-2 -right-2 z-10
                                w-8 h-8 rounded-full
                                bg-error text-on-error
                                flex items-center justify-center
                                opacity-0 group-hover:opacity-100
                                scale-75 group-hover:scale-100
                                transition-all shadow-md">
                            <span class="material-symbols-outlined text-[16px]">delete</span>
                        </button>

                        <!-- Bouton modifier -->
                        <a
                            href="/manage/{{ $table->id }}/edit"
                            class="absolute -top-2 -left-2 z-10
                                w-8 h-8 rounded-full
                                bg-primary text-on-primary
                                flex items-center justify-center
                                opacity-0 group-hover:opacity-100
                                scale-75 group-hover:scale-100
                                transition-all shadow-md">
                            <span class="material-symbols-outlined text-[16px]">edit</span>
                        </a>

                        <div
                            class="bg-white p-xl rounded-[32px]
                            shadow-[0px_4px_20px_rgba(0,0,0,0.04)]
                            border border-outline-variant/30 flex
                            flex-col items-center gap-md cursor-pointer
                            hover:shadow-[0px_10px_30px_rgba(0,0,0,0.08)] transition-all
                            @if($table->status === 'occupied')
                                border-primary/40
                            @elseif($table->status === 'reserved')
                                border-tertiary/40
                            @else
                                border-outline-variant/30 border-dashed
                            @endif">
                            <div
                                class="absolute top-md right-md
                                bg-tertiary-container text-on-tertiary-container
                                text-[10px] font-bold px-sm py-[2px] rounded-full
                                uppercase tracking-wider
                                @if($table->status === 'occupied')
                                    bg-primary-container text-on-primary-container
                                @elseif($table->status === 'reserved')
                                    bg-tertiary-container text-on-tertiary-container
                                @else
                                    bg-secondary-container text-on-secondary-container
                                @endif">

                                @if($table->status === 'occupied')
                                    Occupé
                                @elseif($table->status === 'reserved')
                                    Réservé
                                @else
                                    Disponible
                                @endif

                            </div>
                            <div
                                class="w-12 h-12 rounded-2xl
                                bg-tertiary-container/30 flex
                                items-center justify-center
                                text-tertiary font-display
                                font-bold text-xl
                                @if($table->status === 'occupied')
                                    bg-primary-container/30 text-primary
                                @elseif($table->status === 'reserved')
                                    bg-tertiary-container/30 text-tertiary
                                @else
                                    bg-secondary-container/30 text-secondary
                                @endif">
                                {{ $table->name }}
                            </div>
                            <div class="text-center">
                                <h3 class="font-display font-semibold text-on-surface">{{ ucfirst($table->zone) }}</h3>
                                <p class="text-label-sm text-on-surface-variant">{{ $table->capacity }} personnes</p>
                            </div>

                            {{-- REPRESENTATION TABLE --}}
                            @if($table->capacity <= 2)

                                {{-- PETITE TABLE RONDE --}}
                                <div
                                    class="w-24 h-24 bg-surface-container rounded-full relative border-2 border-outline-variant/30">

                                    <div class="absolute -left-3 top-1/2 -translate-y-1/2 w-3 h-6 bg-outline-variant/40 rounded-full"></div>

                                    <div class="absolute -right-3 top-1/2 -translate-y-1/2 w-3 h-6 bg-outline-variant/40 rounded-full"></div>

                                </div>

                            @elseif($table->capacity <= 4)

                                {{-- TABLE STANDARD --}}
                                <div
                                    class="w-32 h-20 bg-surface-container rounded-2xl relative border-2 border-dashed border-outline-variant/50">

                                    <div class="absolute -left-3 top-1/2 -translate-y-1/2 w-3 h-8 bg-outline-variant/40 rounded-full"></div>

                                    <div class="absolute -right-3 top-1/2 -translate-y-1/2 w-3 h-8 bg-outline-variant/40 rounded-full"></div>

                                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-8 h-3 bg-outline-variant/40 rounded-full"></div>

                                    <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-8 h-3 bg-outline-variant/40 rounded-full"></div>

                                </div>

                            @else

                                {{-- GRANDE TABLE --}}
                                <div
                                    class="w-40 h-24 bg-surface-container-low rounded-2xl relative border-2 border-outline-variant/20">

                                    <div class="absolute -left-3 top-1/4 w-3 h-6 bg-outline-variant/20 rounded-full"></div>

                                    <div class="absolute -left-3 bottom-1/4 w-3 h-6 bg-outline-variant/20 rounded-full"></div>

                                    <div class="absolute -right-3 top-1/4 w-3 h-6 bg-outline-variant/20 rounded-full"></div>

                                    <div class="absolute -right-3 bottom-1/4 w-3 h-6 bg-outline-variant/20 rounded-full"></div>

                                </div>

                            @endif

                        </div>
                    </div>
                @empty
                    <div class="col-span-full flex items-center justify-center py-20">
                        <h3 class="text-xl font-semibold text-on-surface-variant">
                            Aucune table créée
                        </h3>
                    </div>
                @endforelse
            </div>
        </div>
        <!-- Contextual FAB (Only on relevant screens) -->
        <a
            href="/manage"
            class="fixed bottom-xl right-[30px] w-14 h-14 bg-primary text-on-primary rounded-2xl shadow-2xl flex items-center justify-center z-50 hover:scale-105 active:scale-95 transition-all">
            <span class="material-symbols-outlined text-3xl">add</span>
        </a>
    </div>
</div>
