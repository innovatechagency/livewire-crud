<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'STITCH Restaurant') }}</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-low": "#eff4ff",
                        "tertiary": "#9e4036",
                        "on-secondary-fixed-variant": "#005226",
                        "on-tertiary-fixed": "#410001",
                        "surface-container-lowest": "#ffffff",
                        "inverse-on-surface": "#eaf1ff",
                        "error-container": "#ffdad6",
                        "surface-dim": "#cbdbf5",
                        "surface-bright": "#f8f9ff",
                        "secondary-container": "#a4f1b2",
                        "secondary-fixed-dim": "#8bd79b",
                        "secondary": "#1f6c3a",
                        "on-error": "#ffffff",
                        "surface": "#f8f9ff",
                        "on-background": "#0b1c30",
                        "on-error-container": "#93000a",
                        "inverse-primary": "#4ae176",
                        "outline": "#6d7b6c",
                        "on-primary-fixed-variant": "#005321",
                        "tertiary-fixed-dim": "#ffb4a9",
                        "primary-fixed": "#6bff8f",
                        "primary": "#006e2f",
                        "tertiary-fixed": "#ffdad5",
                        "on-surface": "#0b1c30",
                        "surface-variant": "#d3e4fe",
                        "surface-container-highest": "#d3e4fe",
                        "on-primary-fixed": "#002109",
                        "surface-container-high": "#dce9ff",
                        "on-secondary": "#ffffff",
                        "outline-variant": "#bccbb9",
                        "on-tertiary-fixed-variant": "#7f2a21",
                        "background": "#f8f9ff",
                        "primary-container": "#22c55e",
                        "inverse-surface": "#213145",
                        "on-tertiary-container": "#76231b",
                        "surface-tint": "#006e2f",
                        "on-tertiary": "#ffffff",
                        "on-secondary-fixed": "#00210b",
                        "on-primary": "#ffffff",
                        "surface-container": "#e5eeff",
                        "on-surface-variant": "#3d4a3d",
                        "tertiary-container": "#ff8b7c",
                        "primary-fixed-dim": "#4ae176",
                        "secondary-fixed": "#a6f4b5",
                        "error": "#ba1a1a",
                        "on-primary-container": "#004b1e",
                        "on-secondary-container": "#24703e"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "20px",
                        "margin-desktop": "32px",
                        "xs": "8px",
                        "lg": "24px",
                        "md": "16px",
                        "margin-mobile": "16px",
                        "xl": "32px",
                        "sm": "12px",
                        "base": "4px"
                    },
                    "fontFamily": {
                        "display-lg-mobile": ["Plus Jakarta Sans"],
                        "body-sm": ["Inter"],
                        "body-md": ["Inter"],
                        "title-lg": ["Plus Jakarta Sans"],
                        "label-sm": ["Inter"],
                        "label-lg": ["Inter"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "display-lg-mobile": ["24px", {
                            "lineHeight": "1.2",
                            "fontWeight": "700"
                        }],
                        "body-sm": ["14px", {
                            "lineHeight": "1.5",
                            "fontWeight": "400"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "1.5",
                            "fontWeight": "400"
                        }],
                        "title-lg": ["18px", {
                            "lineHeight": "1.4",
                            "fontWeight": "600"
                        }],
                        "label-sm": ["12px", {
                            "lineHeight": "1.2",
                            "fontWeight": "500"
                        }],
                        "label-lg": ["14px", {
                            "lineHeight": "1.2",
                            "fontWeight": "600"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "1.3",
                            "fontWeight": "600"
                        }],
                        "display-lg": ["32px", {
                            "lineHeight": "1.2",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #add-item-modal:target {
            display: flex;
        }
    </style>
    @livewireStyles()

</head>

<body class="bg-background text-on-surface">

    <!-- SideNavBar -->
    <aside
        class="w-64 h-screen fixed left-0 top-0 border-r border-outline-variant bg-surface dark:bg-on-background flex flex-col py-xl px-md gap-lg shadow-sm z-50">
        <div class="flex items-center gap-sm mb-lg">
            <div
                class="w-10 h-10 bg-primary-container rounded-xl flex items-center justify-center text-on-primary-container">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">restaurant</span>
            </div>
            <div>
                <h1 class="text-title-lg font-display-lg font-bold text-on-surface dark:text-surface-bright">
                    CHILI POS</h1>
                <p class="font-body-sm text-body-sm text-on-surface-variant opacity-70">Admin Restaurant</p>
            </div>
        </div>
        <nav class="flex-1 flex flex-col gap-xs">
            <a class="flex items-center gap-md px-md py-sm bg-primary text-on-primary rounded-xl transition-all duration-200 active:scale-95"
                href="/">
                <span class="material-symbols-outlined">restaurant_menu</span>
                <span class="font-label-lg text-label-lg">Menu</span>
            </a>
            <a class="flex items-center gap-md px-md py-sm text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container rounded-xl transition-all duration-200"
                href="/tables">
                <span class="material-symbols-outlined">table_restaurant</span>
                <span class="font-label-lg text-label-lg">Tables</span>
            </a>
            <a class="flex items-center gap-md px-md py-sm text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container rounded-xl transition-all duration-200"
                href="/reservation">
                <span class="material-symbols-outlined">event_available</span>
                <span class="font-label-lg text-label-lg">Réservations</span>
            </a>
            <a class="flex items-center gap-md px-md py-sm text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container rounded-xl transition-all duration-200"
                href="/commande">
                <span class="material-symbols-outlined">delivery_dining</span>
                <span class="font-label-lg text-label-lg">Commande</span>
            </a>
            <a class="flex items-center gap-md px-md py-sm text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container rounded-xl transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined">account_balance_wallet</span>
                <span class="font-label-lg text-label-lg">Comptabilité</span>
            </a>
            <a class="flex items-center gap-md px-md py-sm text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container rounded-xl transition-all duration-200"
                href="#">
                <span class="material-symbols-outlined">settings</span>
                <span class="font-label-lg text-label-lg">Paramètres</span>
            </a>
        </nav>
        <div class="mt-auto flex flex-col gap-md border-t border-outline-variant pt-lg">
            <div class="flex items-center gap-sm px-sm">
                <img alt="Floyd Miles" class="w-10 h-10 rounded-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAOPiH90T_HH0SEK6b0IBAN1yQU2K4bPQ-rrPX2Ft44kD4By1OMms_pRS3Rzf2aSBdUFgGGlvD6__zCCD6SwgQmVATlg1ukNDN3V1QO1uIPW8iRbkF1ZSU6ucZsWdwm6Oa79u7gcuTR_GTuZOMR0Dwf9iblXsiSifLxxF0K8XrqJ2dBrSt_ImPHPX_1ZGmsitxv25OW0HzDyBjR0mUA0WAXejqSQQ3Cgg0Aor_0dxVJUkCIXVeahZhM0yi5zT9oxSj1Knq6XW_nL8Fp" />
                <div>
                    <p class="font-label-lg text-label-lg">Floyd Miles</p>
                    <p class="font-body-sm text-body-sm opacity-60">Directeur Général</p>
                </div>
            </div>
            <button
                class="flex items-center gap-md px-md py-sm text-error hover:bg-error-container hover:text-on-error-container rounded-xl transition-all duration-200">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-label-lg text-label-lg">Déconnexion</span>
            </button>
        </div>
    </aside>
    {{-- End Sidebar --}}

    <!-- TopAppBar -->
    <header
        class="fixed top-0 left-64 right-0 h-20 z-40 backdrop-blur-md bg-white/50 dark:bg-on-background/50 flex items-center justify-between px-margin-desktop border-b border-outline-variant/10">
        <div class="flex items-center gap-lg flex-1">
            @livewire('layout.search-bar', [], key('global-search'))
            <button
                class="p-2 bg-surface-container-low rounded-xl text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container transition-colors focus:ring-2 focus:ring-primary ring-offset-2">
                <span class="material-symbols-outlined">tune</span>
            </button>
        </div>
        <div class="flex items-center gap-md">
            {{-- <a class="bg-primary text-on-primary px-lg py-sm rounded-xl font-label-lg text-label-lg flex items-center gap-sm shadow-md hover:bg-on-primary-fixed-variant transition-all"
                href="#add-item-modal">
                <span class="material-symbols-outlined">add</span>
                Ajouter un article
            </a> --}}
            <div
                class="w-10 h-10 rounded-full bg-surface-container-high border-2 border-primary-container overflow-hidden">
                <img alt="Manager Profile"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzlTG9eLO4_YZdrEOsmz9pAMtiha1eFJzxcdeGfGmp_KfEfvVvQo93PfWwVHyyknEaQzDdrNzj8nipgRAVY8EtKPei68ipyzGYxtCa-FrP-I2dygxiGJQCcrlG_eTmTJwCaYlf2u7M-YQeC_9QICjY0PZr5d32MzlZoeHs917Pj8oI0gVinq58kTqBpXddEVVZr21osiCz59W2iehkIVHzerxbdj99xWKpfineCJJVwoZxDCnNuKrVwfoSDcDYJblF2fgIEaH3CQtY" />
            </div>
        </div>
    </header>

    <main class="ml-64 pt-24 px-margin-desktop pb-xl min-h-screen">

        {{-- Chargement dynamique des composants --}}
        @isset($component)
            @livewire($component, ['id' => $tableId ?? null])
        @else
            <h1>Bienvenue sur mon app Livewire</h1>
        @endisset

    </main>

    @livewireScripts()
</body>

</html>
