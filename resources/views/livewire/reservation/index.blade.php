<div>

    <div class="flex flex-1 overflow-hidden">
        <!-- Floor Plan / Tables View -->
        <div class="flex-1 p-margin-desktop overflow-y-auto bg-surface-container-lowest">
            <div class="flex items-center justify-between mb-xl">
                <h2 class="text-display-lg font-display text-on-surface">Plan de Salle</h2>
                <button
                    class="flex items-center gap-sm bg-surface-container-high text-on-surface px-md py-sm rounded-xl font-label-lg font-semibold hover:bg-surface-variant transition-colors">
                    <span class="material-symbols-outlined">add</span>
                    <span>Ajouter une Table</span>
                </button>
            </div>
            <div class="grid grid-cols-3 gap-xl">
                <!-- Table Card Reserved -->
                <div class="relative group">
                    <div
                        class="bg-white p-xl rounded-[32px] shadow-[0px_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex flex-col items-center gap-md cursor-pointer hover:shadow-[0px_10px_30px_rgba(0,0,0,0.08)] transition-all">
                        <div
                            class="absolute top-md right-md bg-tertiary-container text-on-tertiary-container text-[10px] font-bold px-sm py-[2px] rounded-full uppercase tracking-wider">
                            Réservé</div>
                        <div
                            class="w-12 h-12 rounded-2xl bg-tertiary-container/30 flex items-center justify-center text-tertiary font-display font-bold text-xl">
                            T1</div>
                        <div class="text-center">
                            <h3 class="font-display font-semibold text-on-surface">Jacob Jones</h3>
                            <p class="text-label-sm text-on-surface-variant">4 Personnes • 18:30</p>
                        </div>
                        <div
                            class="w-32 h-20 bg-surface-container rounded-2xl relative border-2 border-dashed border-outline-variant/50">
                            <div
                                class="absolute -left-3 top-1/2 -translate-y-1/2 w-3 h-8 bg-outline-variant/40 rounded-full">
                            </div>
                            <div
                                class="absolute -right-3 top-1/2 -translate-y-1/2 w-3 h-8 bg-outline-variant/40 rounded-full">
                            </div>
                            <div
                                class="absolute -top-3 left-1/2 -translate-x-1/2 w-8 h-3 bg-outline-variant/40 rounded-full">
                            </div>
                            <div
                                class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-8 h-3 bg-outline-variant/40 rounded-full">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table Card Available -->
                <div class="relative group">
                    <div
                        class="bg-white p-xl rounded-[32px] shadow-[0px_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex flex-col items-center gap-md cursor-pointer hover:shadow-[0px_10px_30px_rgba(0,0,0,0.08)] transition-all border-dashed">
                        <div
                            class="absolute top-md right-md bg-secondary-container text-on-secondary-container text-[10px] font-bold px-sm py-[2px] rounded-full uppercase tracking-wider">
                            Disponible</div>
                        <div
                            class="w-12 h-12 rounded-2xl bg-secondary-container/30 flex items-center justify-center text-secondary font-display font-bold text-xl">
                            T4</div>
                        <div class="text-center">
                            <h3 class="font-display font-semibold text-on-surface-variant">Libre</h3>
                            <p class="text-label-sm text-outline">Jusqu'à 6 Personnes</p>
                        </div>
                        <div
                            class="w-40 h-24 bg-surface-container-low rounded-2xl relative border-2 border-outline-variant/20">
                            <div class="absolute -left-3 top-1/4 w-3 h-6 bg-outline-variant/20 rounded-full"></div>
                            <div class="absolute -left-3 bottom-1/4 w-3 h-6 bg-outline-variant/20 rounded-full">
                            </div>
                            <div class="absolute -right-3 top-1/4 w-3 h-6 bg-outline-variant/20 rounded-full"></div>
                            <div class="absolute -right-3 bottom-1/4 w-3 h-6 bg-outline-variant/20 rounded-full">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table Card Reserved -->
                <div class="relative group">
                    <div
                        class="bg-white p-xl rounded-[32px] shadow-[0px_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex flex-col items-center gap-md cursor-pointer hover:shadow-[0px_10px_30px_rgba(0,0,0,0.08)] transition-all">
                        <div
                            class="absolute top-md right-md bg-tertiary-container text-on-tertiary-container text-[10px] font-bold px-sm py-[2px] rounded-full uppercase tracking-wider">
                            Réservé</div>
                        <div
                            class="w-12 h-12 rounded-2xl bg-tertiary-container/30 flex items-center justify-center text-tertiary font-display font-bold text-xl">
                            T5</div>
                        <div class="text-center">
                            <h3 class="font-display font-semibold text-on-surface">Annette Black</h3>
                            <p class="text-label-sm text-on-surface-variant">6 Personnes • 19:15</p>
                        </div>
                        <div
                            class="w-32 h-20 bg-surface-container rounded-2xl relative border-2 border-dashed border-outline-variant/50">
                            <div
                                class="absolute -left-3 top-1/2 -translate-y-1/2 w-3 h-8 bg-outline-variant/40 rounded-full">
                            </div>
                            <div
                                class="absolute -right-3 top-1/2 -translate-y-1/2 w-3 h-8 bg-outline-variant/40 rounded-full">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table Card Occupied -->
                <div class="relative group">
                    <div
                        class="bg-white p-xl rounded-[32px] shadow-[0px_4px_20px_rgba(0,0,0,0.04)] border border-outline-variant/30 flex flex-col items-center gap-md cursor-pointer hover:shadow-[0px_10px_30px_rgba(0,0,0,0.08)] transition-all border-primary/40">
                        <div
                            class="absolute top-md right-md bg-primary-container text-on-primary-container text-[10px] font-bold px-sm py-[2px] rounded-full uppercase tracking-wider">
                            Occupé</div>
                        <div
                            class="w-12 h-12 rounded-2xl bg-primary-container/30 flex items-center justify-center text-primary font-display font-bold text-xl">
                            T2</div>
                        <div class="text-center">
                            <h3 class="font-display font-semibold text-on-surface">Bessie Cooper</h3>
                            <p class="text-label-sm text-on-surface-variant">2 Personnes • En cours</p>
                        </div>
                        <div
                            class="w-24 h-24 bg-surface-container rounded-full relative border-2 border-outline-variant/30">
                            <div
                                class="absolute -left-3 top-1/2 -translate-y-1/2 w-3 h-6 bg-outline-variant/40 rounded-full">
                            </div>
                            <div
                                class="absolute -right-3 top-1/2 -translate-y-1/2 w-3 h-6 bg-outline-variant/40 rounded-full">
                            </div>
                            <div
                                class="absolute -top-3 left-1/2 -translate-x-1/2 w-6 h-3 bg-outline-variant/40 rounded-full">
                            </div>
                            <div
                                class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-6 h-3 bg-outline-variant/40 rounded-full">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- More tables... -->
                <div class="relative group opacity-60">
                    <div
                        class="bg-white p-xl rounded-[32px] border border-outline-variant/20 flex flex-col items-center gap-md">
                        <div
                            class="w-12 h-12 rounded-2xl bg-surface-container-highest flex items-center justify-center text-outline font-display font-bold text-xl">
                            T3</div>
                        <div
                            class="w-24 h-24 bg-surface-container-low rounded-2xl relative border-2 border-outline-variant/10">
                        </div>
                    </div>
                </div>
                <div class="relative group opacity-60">
                    <div
                        class="bg-white p-xl rounded-[32px] border border-outline-variant/20 flex flex-col items-center gap-md">
                        <div
                            class="w-12 h-12 rounded-2xl bg-surface-container-highest flex items-center justify-center text-outline font-display font-bold text-xl">
                            T6</div>
                        <div
                            class="w-40 h-20 bg-surface-container-low rounded-2xl relative border-2 border-outline-variant/10">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Upcoming Reservations List (Side Panel) -->
        <aside class="w-[450px] bg-white border-l border-outline-variant flex flex-col h-full z-10">
            <div class="p-margin-desktop border-b border-outline-variant/50">
                <div class="flex items-center justify-between mb-xl">
                    <h2 class="text-display-lg font-display text-on-surface">Réservations</h2>
                </div>
                <button
                    class="w-full bg-primary text-on-primary py-md rounded-2xl font-display font-bold text-lg shadow-lg shadow-primary/20 hover:bg-on-primary-fixed-variant transition-colors active:scale-[0.98] flex items-center justify-center gap-sm">
                    <span class="material-symbols-outlined">add</span>
                    Nouvelle Réservation
                </button>
            </div>
            <div class="flex-1 overflow-y-auto p-margin-desktop pt-lg">
                <h3 class="font-display font-semibold text-on-surface-variant mb-md">À venir</h3>
                <div class="space-y-sm">
                    <!-- Reservation Item -->
                    <div
                        class="flex items-start gap-md p-md bg-surface-container-low rounded-2xl hover:bg-surface-container-high cursor-pointer transition-colors border border-transparent hover:border-outline-variant/30">
                        <div class="flex flex-col items-center justify-center min-w-[60px]">
                            <span class="text-title-lg font-display font-bold text-on-surface">18:30</span>
                            <span
                                class="text-[10px] font-bold text-on-surface-variant bg-surface-container-highest px-2 py-1 rounded-full mt-1">T1</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <h4 class="font-label-lg text-base text-on-surface">Jacob Jones</h4>
                                <span
                                    class="bg-tertiary-container/50 text-on-tertiary-container text-[10px] font-bold px-sm py-[2px] rounded-full">Confirmé</span>
                            </div>
                            <p class="text-sm text-on-surface-variant mt-1">4 Personnes • Intérieur</p>
                            <div class="flex items-center gap-xs mt-2 text-xs text-on-surface-variant">
                                <span class="material-symbols-outlined text-[14px]">phone</span>
                                <span>+33 6 12 34 56 78</span>
                            </div>
                        </div>
                    </div>
                    <!-- Reservation Item -->
                    <div
                        class="flex items-start gap-md p-md bg-surface-container-low rounded-2xl hover:bg-surface-container-high cursor-pointer transition-colors border border-transparent hover:border-outline-variant/30">
                        <div class="flex flex-col items-center justify-center min-w-[60px]">
                            <span class="text-title-lg font-display font-bold text-on-surface">19:15</span>
                            <span
                                class="text-[10px] font-bold text-on-surface-variant bg-surface-container-highest px-2 py-1 rounded-full mt-1">T5</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <h4 class="font-label-lg text-base text-on-surface">Annette Black</h4>
                                <span
                                    class="bg-tertiary-container/50 text-on-tertiary-container text-[10px] font-bold px-sm py-[2px] rounded-full">Confirmé</span>
                            </div>
                            <p class="text-sm text-on-surface-variant mt-1">6 Personnes • Intérieur</p>
                            <div class="flex items-center gap-xs mt-2 text-xs text-on-surface-variant">
                                <span class="material-symbols-outlined text-[14px]">phone</span>
                                <span>+33 6 98 76 54 32</span>
                            </div>
                        </div>
                    </div>
                    <!-- Reservation Item (Unassigned) -->
                    <div
                        class="flex items-start gap-md p-md bg-surface-container-low rounded-2xl hover:bg-surface-container-high cursor-pointer transition-colors border border-transparent hover:border-outline-variant/30 opacity-80">
                        <div class="flex flex-col items-center justify-center min-w-[60px]">
                            <span class="text-title-lg font-display font-bold text-on-surface">20:00</span>
                            <span
                                class="text-[10px] font-bold text-error bg-error-container/50 px-2 py-1 rounded-full mt-1">À
                                assigner</span>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <h4 class="font-label-lg text-base text-on-surface">Dianne Russell</h4>
                                <span
                                    class="bg-surface-variant text-on-surface-variant text-[10px] font-bold px-sm py-[2px] rounded-full">En
                                    attente</span>
                            </div>
                            <p class="text-sm text-on-surface-variant mt-1">2 Personnes • Extérieur</p>
                            <div class="flex items-center gap-xs mt-2 text-xs text-on-surface-variant">
                                <span class="material-symbols-outlined text-[14px]">phone</span>
                                <span>+33 6 11 22 33 44</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

</div>
