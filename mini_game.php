<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Teka Kata - Permainan Perkataan Malay 5 Huruf</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome Free Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fa-game-console-handheld::before {
            content: "\f8b8";
        }
    </style>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Canvas Confetti -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                        },
                        correct: '#22c55e',
                        present: '#eab308',
                        absent: '#64748b',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    animation: {
                        'pop': 'pop 0.15s ease-in-out',
                        'shake': 'shake 0.5s ease-in-out',
                        'flip': 'flip 0.5s ease forward',
                    },
                    keyframes: {
                        pop: {
                            '0%': { transform: 'scale(0.8)', opacity: '0.5' },
                            '40%': { transform: 'scale(1.1)' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        shake: {
                            '0%, 100%': { transform: 'translateX(0)' },
                            '20%, 60%': { transform: 'translateX(-6px)' },
                            '40%, 80%': { transform: 'translateX(6px)' },
                        },
                        flip: {
                            '0%': { transform: 'rotateX(0deg)' },
                            '50%': { transform: 'rotateX(90deg)' },
                            '100%': { transform: 'rotateX(0deg)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
        }

        .tile {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-weight: 800;
            text-transform: uppercase;
            border-radius: 0.5rem;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s, transform 0.15s;
            backface-visibility: hidden;
        }

        .tile[data-state="empty"] {
            border: 2px solid #cbd5e1;
            background-color: transparent;
        }
        .dark .tile[data-state="empty"] {
            border-color: #334155;
        }

        .tile[data-state="tapped"] {
            border: 2px solid #64748b;
            animation: pop 0.15s ease-in-out;
        }
        .dark .tile[data-state="tapped"] {
            border-color: #94a3b8;
        }

        .tile[data-state="correct"] {
            background-color: #22c55e !important;
            border-color: #22c55e !important;
            color: white !important;
        }

        .tile[data-state="present"] {
            background-color: #eab308 !important;
            border-color: #eab308 !important;
            color: white !important;
        }

        .tile[data-state="absent"] {
            background-color: #64748b !important;
            border-color: #64748b !important;
            color: white !important;
        }

        .dark .tile[data-state="absent"] {
            background-color: #475569 !important;
            border-color: #475569 !important;
        }

        .key-btn {
            touch-action: manipulation;
            transition: all 0.15s ease;
        }
        .key-btn:active {
            transform: scale(0.92);
        }

        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #334155;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col justify-between transition-colors duration-300">

    <!-- HEADER TOP BAR -->
    <header class="border-b border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md sticky top-0 z-20">
        <div class="max-w-lg mx-auto px-3 h-14 flex items-center justify-between">
            <a href="home.php" id="btn-back" class="flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl text-xs font-bold transition shadow-xs border border-slate-200 dark:border-slate-700" title="Kembali ke home.php">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="inline">Kembali</span>
            </a>

            <div id="nav-title" class="flex items-center gap-2 cursor-pointer" onclick="navigateToHomeView()">
                <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center text-white font-black text-lg shadow-md shadow-emerald-500/30">
                    T
                </div>
                <h1 class="text-lg sm:text-xl font-extrabold tracking-wider bg-gradient-to-r from-emerald-600 to-teal-500 dark:from-emerald-400 dark:to-teal-300 bg-clip-text text-transparent">
                    TEKA KATA
                </h1>
            </div>

            <div class="flex items-center gap-1">
                <button id="btn-help" class="p-2 text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 rounded-lg text-lg transition" title="Cara Bermain">
                    <i class="fa-solid fa-circle-question"></i>
                </button>
                <button id="btn-sound" class="p-2 text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 rounded-lg text-lg transition" title="Kesan Bunyi">
                    <i class="fa-solid fa-volume-high" id="icon-sound"></i>
                </button>
                <button id="btn-stats" class="p-2 text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 rounded-lg text-lg transition" title="Statistik">
                    <i class="fa-solid fa-chart-column"></i>
                </button>
                <button id="btn-theme" class="p-2 text-slate-600 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-400 rounded-lg text-lg transition" title="Tukar Tema">
                    <i class="fa-solid fa-moon" id="icon-theme"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- NOTIFICATION TOAST -->
    <div id="toast-container" class="fixed top-16 left-1/2 -translate-x-1/2 z-50 flex flex-col items-center gap-2 pointer-events-none"></div>

    <!-- VIEW 1: HOME PAGE / SKRIN UTAMA -->
    <section id="view-home" class="flex-1 flex flex-col items-center justify-center max-w-lg w-full mx-auto p-4 sm:p-6 text-center animate-pop">
        <div class="mb-4 flex flex-col items-center">
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center text-white text-3xl sm:text-4xl font-black shadow-xl shadow-emerald-500/30 mb-3 animate-bounce">
                TK
            </div>
            <h2 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-800 dark:text-slate-100">
                Teka Kata Melayu
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1 max-w-xs">
                Pilih mod permainan atau kategori kegemaran anda!
            </p>
        </div>

        <!-- MODE SELECTION BUTTONS -->
        <div class="w-full space-y-3 max-w-xs mb-6">
            <button id="btn-mode-random" class="w-full py-3 px-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-extrabold text-sm sm:text-base rounded-2xl shadow-lg shadow-emerald-500/25 active:scale-95 transition flex items-center justify-center gap-3">
                <i class="fa-solid fa-shuffle text-lg"></i>
                <span>Permainan Rawak</span>
            </button>

            <button id="btn-mode-daily" class="w-full py-3 px-4 bg-white dark:bg-slate-800 hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-100 font-extrabold text-sm sm:text-base rounded-2xl shadow-md border border-slate-200 dark:border-slate-700 active:scale-95 transition flex items-center justify-center gap-3">
                <i class="fa-solid fa-calendar-day text-amber-500 text-lg"></i>
                <span>Teka-teki Harian</span>
            </button>
        </div>

        <!-- CATEGORY SELECTION SECTION -->
        <div class="w-full max-w-xs mb-6">
            <div class="text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-2 flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-layer-group"></i> Pilih Mengikut Kategori
            </div>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <button onclick="navigateToGame('category', 'haiwan')" class="p-2.5 bg-white dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-700/80 border border-slate-200 dark:border-slate-700 rounded-xl font-bold flex items-center gap-2 text-slate-700 dark:text-slate-200 transition shadow-xs text-left">
                    <span class="p-1.5 bg-emerald-100 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-400 rounded-lg"><i class="fa-solid fa-paw"></i></span>
                    <span>Haiwan & Tumbuhan</span>
                </button>
                <button onclick="navigateToGame('category', 'peralatan')" class="p-2.5 bg-white dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-700/80 border border-slate-200 dark:border-slate-700 rounded-xl font-bold flex items-center gap-2 text-slate-700 dark:text-slate-200 transition shadow-xs text-left">
                    <span class="p-1.5 bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400 rounded-lg"><i class="fa-solid fa-kitchen-set"></i></span>
                    <span>Peralatan & Rumah</span>
                </button>
                <button onclick="navigateToGame('category', 'makanan')" class="p-2.5 bg-white dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-700/80 border border-slate-200 dark:border-slate-700 rounded-xl font-bold flex items-center gap-2 text-slate-700 dark:text-slate-200 transition shadow-xs text-left">
                    <span class="p-1.5 bg-amber-100 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400 rounded-lg"><i class="fa-solid fa-utensils"></i></span>
                    <span>Makanan & Dapur</span>
                </button>
                <button onclick="navigateToGame('category', 'tubuh')" class="p-2.5 bg-white dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-700/80 border border-slate-200 dark:border-slate-700 rounded-xl font-bold flex items-center gap-2 text-slate-700 dark:text-slate-200 transition shadow-xs text-left">
                    <span class="p-1.5 bg-rose-100 text-rose-600 dark:bg-rose-900/40 dark:text-rose-400 rounded-lg"><i class="fa-solid fa-child"></i></span>
                    <span>Tubuh Badan</span>
                </button>
                <button onclick="navigateToGame('category', 'tempat')" class="p-2.5 bg-white dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-700/80 border border-slate-200 dark:border-slate-700 rounded-xl font-bold flex items-center gap-2 text-slate-700 dark:text-slate-200 transition shadow-xs text-left">
                    <span class="p-1.5 bg-teal-100 text-teal-600 dark:bg-teal-900/40 dark:text-teal-400 rounded-lg"><i class="fa-solid fa-mountain-sun"></i></span>
                    <span>Tempat & Alam</span>
                </button>
                <button onclick="navigateToGame('category', 'sifat')" class="p-2.5 bg-white dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-slate-700/80 border border-slate-200 dark:border-slate-700 rounded-xl font-bold flex items-center gap-2 text-slate-700 dark:text-slate-200 transition shadow-xs text-left">
                    <span class="p-1.5 bg-purple-100 text-purple-600 dark:bg-purple-900/40 dark:text-purple-400 rounded-lg"><i class="fa-solid fa-wand-magic-sparkles"></i></span>
                    <span>Sifat & Kata Kerja</span>
                </button>
            </div>
        </div>

        <!-- QUICK ACCESS LINKS -->
        <div class="flex items-center gap-4 text-xs font-bold text-slate-500 dark:text-slate-400">
            <button id="home-btn-stats" class="hover:text-emerald-600 dark:hover:text-emerald-400 flex items-center gap-1.5 transition">
                <i class="fa-solid fa-chart-line"></i> Statistik
            </button>
            <span>&bull;</span>
            <button id="home-btn-help" class="hover:text-emerald-600 dark:hover:text-emerald-400 flex items-center gap-1.5 transition">
                <i class="fa-solid fa-book-open"></i> Cara Bermain
            </button>
        </div>
    </section>

    <!-- VIEW 2: GAME PAGE / SKRIN PERMAINAN -->
    <main id="view-game" class="hidden flex-1 flex flex-col items-center justify-between max-w-lg w-full mx-auto p-2 sm:p-4">
        
        <!-- TOP TOOLBAR: PETUNJUK & MOD BANTU -->
        <div class="w-full flex items-center justify-between mb-2 px-1">
            <div id="game-mode-indicator" class="text-xs font-semibold text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                <span id="category-badge" class="px-2 py-0.5 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-bold rounded-lg border border-emerald-500/20 text-[11px] flex items-center gap-1">
                    <i class="fa-solid fa-tag"></i>
                    <span id="mode-label">Mod Bebas</span>
                </span>
            </div>
            <button id="btn-hint" class="px-3 py-1.5 bg-amber-500/10 text-amber-600 dark:text-amber-400 hover:bg-amber-500/20 rounded-full text-xs font-bold border border-amber-500/30 transition flex items-center gap-1.5 shadow-sm">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                <span>Petunjuk</span>
            </button>
        </div>

        <!-- GRID PAD (6 TEKAAN x 5 HURUF) -->
        <div class="w-full flex-1 flex items-center justify-center my-auto">
            <div id="grid-container" class="grid grid-rows-6 gap-1.5 sm:gap-2 p-1 w-full max-w-[350px] aspect-[5/6]">
                <!-- Rows and Tiles generated dynamically -->
            </div>
        </div>

        <!-- DEFINITION / INFO PANEL (APPEARS AFTER GAME ENDS) -->
        <div id="definition-card" class="hidden w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-3.5 rounded-2xl shadow-lg my-2 text-center animate-pop">
            <div class="text-xs uppercase font-bold text-slate-400 tracking-wider mb-0.5">Perkataan Rahsia</div>
            <div id="def-word" class="text-2xl font-black text-emerald-600 dark:text-emerald-400 tracking-widest mb-1">------</div>
            <div id="def-meaning" class="text-sm text-slate-600 dark:text-slate-300 italic mb-3">Maksud perkataan...</div>
            <button id="btn-play-again" class="w-full py-2.5 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold rounded-xl shadow-md shadow-emerald-500/20 active:scale-95 transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-rotate-right"></i>
                <span>Main Perkataan Seterusnya</span>
            </button>
        </div>

        <!-- KEYBOARD -->
        <div class="w-full mt-2 select-none">
            <div id="keyboard" class="flex flex-col gap-1.5 sm:gap-2">
                <!-- Row 1 -->
                <div class="flex justify-center gap-1 sm:gap-1.5">
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="Q">Q</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="W">W</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="E">E</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="R">R</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="T">T</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="Y">Y</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="U">U</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="I">I</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="O">O</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="P">P</button>
                </div>
                <!-- Row 2 -->
                <div class="flex justify-center gap-1 sm:gap-1.5 px-3">
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="A">A</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="S">S</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="D">D</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="F">F</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="G">G</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="H">H</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="J">J</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="K">K</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="L">L</button>
                </div>
                <!-- Row 3 -->
                <div class="flex justify-center gap-1 sm:gap-1.5">
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-emerald-600 text-white font-bold text-xs sm:text-sm px-2 sm:px-3 flex-[1.5] flex items-center justify-center shadow-sm" data-key="ENTER">
                        HANTAR
                    </button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="Z">Z</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="X">X</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="C">C</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="V">V</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="B">B</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="N">N</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm" data-key="M">M</button>
                    <button class="key-btn h-12 sm:h-13 rounded-md bg-rose-500 text-white font-bold text-base px-2 sm:px-3 flex-[1.5] flex items-center justify-center shadow-sm" data-key="BACKSPACE" title="Padam">
                        <i class="fa-solid fa-delete-left"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="py-2 text-center text-xs text-slate-400 dark:text-slate-500">
        made by MAARRI &copy; 2026 &bull; ONLY FOR AIFA
    </footer>

    <!-- MODAL: CARA BERMAIN OVERLAY -->
    <div id="modal-how-to-use" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 animate-pop">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-extrabold flex items-center gap-2 text-slate-800 dark:text-slate-100">
                    <i class="fa-solid fa-circle-info text-emerald-500"></i>
                    Cara Menggunakan Aplikasi
                </h3>
                <button onclick="document.getElementById('modal-how-to-use').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-xl p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-3 text-xs sm:text-sm text-slate-600 dark:text-slate-300">
                <div class="p-3 bg-slate-100 dark:bg-slate-700/50 rounded-xl">
                    <strong class="text-emerald-600 dark:text-emerald-400 block mb-1 font-bold">1. Pilih Mod atau Kategori</strong>
                    Pilih <strong>Permainan Rawak</strong>, <strong>Teka-teki Harian</strong>, atau kategori khusus seperti <strong>Haiwan</strong> atau <strong>Peralatan</strong>.
                </div>

                <div class="p-3 bg-slate-100 dark:bg-slate-700/50 rounded-xl">
                    <strong class="text-emerald-600 dark:text-emerald-400 block mb-1 font-bold">2. Taip & Teka Perkataan</strong>
                    Gunakan papan kekunci di skrin atau papan kekunci komputer untuk menaip 5 huruf perkataan Bahasa Melayu. Tekan <strong>HANTAR</strong>.
                </div>

                <div class="p-3 bg-slate-100 dark:bg-slate-700/50 rounded-xl">
                    <strong class="text-emerald-600 dark:text-emerald-400 block mb-1 font-bold">3. Perhatikan Warna Petak</strong>
                    <ul class="list-disc pl-4 mt-1 space-y-1">
                        <li><span class="text-emerald-600 font-bold">Hijau:</span> Huruf & kedudukan betul.</li>
                        <li><span class="text-amber-500 font-bold">Kuning:</span> Huruf ada tetapi kedudukan salah.</li>
                        <li><span class="text-slate-400 font-bold">Kelabu:</span> Huruf tiada dalam perkataan.</li>
                    </ul>
                </div>
            </div>

            <button onclick="document.getElementById('modal-how-to-use').classList.add('hidden')" class="w-full mt-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-gamepad"></i>
                <span>Mula Bermain Sekarang!</span>
            </button>
        </div>
    </div>

    <!-- MODAL: STATISTIK -->
    <div id="modal-stats" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-200">
        <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-sm w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 transform scale-95 transition-transform duration-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-extrabold flex items-center gap-2">
                    <i class="fa-solid fa-chart-line text-emerald-500"></i>
                    Statistik Permainan
                </h3>
                <button class="btn-close-modal text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-xl p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="grid grid-cols-4 gap-2 text-center my-4">
                <div class="bg-slate-100 dark:bg-slate-700/50 p-2 rounded-xl">
                    <div id="stat-played" class="text-2xl font-black text-slate-800 dark:text-slate-100">0</div>
                    <div class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 uppercase mt-0.5">Main</div>
                </div>
                <div class="bg-slate-100 dark:bg-slate-700/50 p-2 rounded-xl">
                    <div id="stat-winrate" class="text-2xl font-black text-emerald-600 dark:text-emerald-400">0%</div>
                    <div class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 uppercase mt-0.5">Menang</div>
                </div>
                <div class="bg-slate-100 dark:bg-slate-700/50 p-2 rounded-xl">
                    <div id="stat-streak" class="text-2xl font-black text-amber-500">0</div>
                    <div class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 uppercase mt-0.5">Rentetan</div>
                </div>
                <div class="bg-slate-100 dark:bg-slate-700/50 p-2 rounded-xl">
                    <div id="stat-maxstreak" class="text-2xl font-black text-teal-500">0</div>
                    <div class="text-[10px] font-semibold text-slate-500 dark:text-slate-400 uppercase mt-0.5">Terbaik</div>
                </div>
            </div>

            <h4 class="text-xs font-bold uppercase text-slate-400 mb-2 tracking-wider">Taburan Percubaan</h4>
            <div id="guess-distribution" class="space-y-1.5 mb-6"></div>

            <div class="flex flex-col gap-2">
                <button id="btn-modal-play-again" class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-600/30 active:scale-95 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-play"></i>
                    <span>Main Perkataan Baharu</span>
                </button>
                <button class="btn-close-modal w-full py-2 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-semibold rounded-xl text-xs transition flex items-center justify-center gap-1.5">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Tutup</span>
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL: CARA BERMAIN -->
    <div id="modal-help" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-200">
        <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200 dark:border-slate-700 transform scale-95 transition-transform duration-200">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-extrabold flex items-center gap-2">
                    <i class="fa-solid fa-graduation-cap text-emerald-500"></i>
                    Cara Bermain
                </h3>
                <button class="btn-close-modal text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-xl p-1">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <p class="text-sm text-slate-600 dark:text-slate-300 mb-4">
                Teka perkataan rahsia 5 huruf dalam 6 percubaan. Semua kategori kata am Bahasa Melayu diterima.
            </p>

            <div class="space-y-3 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-500 text-white font-black text-lg rounded-lg flex items-center justify-center shrink-0">
                        A
                    </div>
                    <div class="text-xs text-slate-600 dark:text-slate-300">
                        <strong class="text-emerald-600 dark:text-emerald-400 font-bold block text-sm">Hijau</strong>
                        Huruf <strong>A</strong> tepat pada kedudukannya.
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-amber-500 text-white font-black text-lg rounded-lg flex items-center justify-center shrink-0">
                        R
                    </div>
                    <div class="text-xs text-slate-600 dark:text-slate-300">
                        <strong class="text-amber-500 font-bold block text-sm">Kuning</strong>
                        Huruf <strong>R</strong> wujud dalam perkataan tetapi di kedudukan berlainan.
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-slate-500 text-white font-black text-lg rounded-lg flex items-center justify-center shrink-0">
                        N
                    </div>
                    <div class="text-xs text-slate-600 dark:text-slate-300">
                        <strong class="text-slate-500 font-bold block text-sm">Kelabu</strong>
                        Huruf <strong>N</strong> tiada langsung dalam perkataan ini.
                    </div>
                </div>
            </div>

            <button class="btn-close-modal w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-check"></i>
                <span>Faham & Mulakan!</span>
            </button>
        </div>
    </div>

    <!-- JAVASCRIPT DICTIONARY WITH CATEGORIES & GAME LOGIC -->
    <script>
        /* ===================================================================
           1. KAMUS 5 HURUF BAHASA MELAYU DIKATEGORIKAN
           =================================================================== */
        const CATEGORIES = {
            haiwan: "Haiwan & Tumbuhan",
            peralatan: "Peralatan & Rumah",
            makanan: "Makanan & Dapur",
            tubuh: "Tubuh Badan",
            tempat: "Tempat & Alam",
            sifat: "Sifat & Kata Kerja"
        };

        const RAW_MALAY_WORDS = [
            // Kategori: haiwan
            { w: "ARNAB", d: "Haiwan mamalia bertelinga panjang dan melompat.", c: "haiwan" },
            { w: "GAJAH", d: "Haiwan darat terbesar bersaiz gergasi dan berbelalai.", c: "haiwan" },
            { w: "SINGA", d: "Haiwan pemangsa buas bergelar raja hutan.", c: "haiwan" },
            { w: "LEBAH", d: "Serangga bersengat penghasil madu.", c: "haiwan" },
            { w: "KATAK", d: "Haiwan amfibia yang pandai melompat.", c: "haiwan" },
            { w: "CICAK", d: "Reptilia kecil yang biasa merayap di dinding.", c: "haiwan" },
            { w: "BUAYA", d: "Reptilia pemangsa bersisik keras yang hidup di air.", c: "haiwan" },
            { w: "LALAT", d: "Serangga terbang berdua sayap.", c: "haiwan" },
            { w: "LEMBU", d: "Haiwan ternakan berkaki empat penghasil susu/daging.", c: "haiwan" },
            { w: "IKAN", d: "Haiwan akuatik yang bernafas menggunakan insang.", c: "haiwan" },
            { w: "PAUS", d: "Mamalia laut gergasi terbesar di dunia.", c: "haiwan" },
            { w: "PENYU", d: "Reptilia laut bertempurung yang mendarat bertelur.", c: "haiwan" },
            { w: "LIPAS", d: "Serangga perang tahan lasak di kawasan gelap.", c: "haiwan" },
            { w: "SEMUT", d: "Serangga kecil rajin berkoloni.", c: "haiwan" },
            { w: "AYAM", d: "Unggas peliharaan berkaki dua yang bertelur.", c: "haiwan" },
            { w: "ANGSA", d: "Unggas air berleher panjang.", c: "haiwan" },
            { w: "ITIK", d: "Unggas air berkaki selaput.", c: "haiwan" },
            { w: "RUSA", d: "Haiwan bertanduk cabang yang pantas berlari.", c: "haiwan" },
            { w: "SIPUT", d: "Haiwan berkerang keras yang bergerak perlahan.", c: "haiwan" },
            { w: "BUNGA", d: "Bahagian tumbuhan yang indah dan harum.", c: "haiwan" },
            { w: "POKOK", d: "Tumbuhan berbatang keras dan tinggi.", c: "haiwan" },
            { w: "BUAH", d: "Hasil tumbuhan yang boleh dimakan.", c: "haiwan" },

            // Kategori: peralatan
            { w: "RUMAH", d: "Bangunan tempat tinggal manusia.", c: "peralatan" },
            { w: "PINTU", d: "Laluan keluar masuk ke sesuatu ruang.", c: "peralatan" },
            { w: "TIANG", d: "Tonggak tegak untuk menyokong binaan.", c: "peralatan" },
            { w: "LAMPU", d: "Alat pencahayaan menggunakan elektrik atau api.", c: "peralatan" },
            { w: "KAPAS", d: "Gentian serat putih lembut daripada tumbuhan.", c: "peralatan" },
            { w: "PISAU", d: "Alat pemotong tajam berhulu.", c: "peralatan" },
            { w: "SUDU", d: "Alat ceduk makanan cecair atau pepejal.", c: "peralatan" },
            { w: "GARFU", d: "Alat makan bercabang empat.", c: "peralatan" },
            { w: "CAWAN", d: "Bekas minuman bertangkai.", c: "peralatan" },
            { w: "BOTOL", d: "Bekas cecair tinggi berleher sempit.", c: "peralatan" },
            { w: "GELAS", d: "Bekas minuman diperbuat daripada kaca.", c: "peralatan" },
            { w: "TIMBA", d: "Bekas mengangkat air.", c: "peralatan" },
            { w: "KERTAS", d: "Lembaran nipis untuk menulis atau membungkus.", c: "peralatan" },
            { w: "BATU", d: "Bahan pepejal galian keras.", c: "peralatan" },
            { w: "KAYU", d: "Bahan keras daripada batang pokok.", c: "peralatan" },
            { w: "SABUN", d: "Bahan pembersih badan atau pakaian.", c: "peralatan" },
            { w: "SPAN", d: "Bahan berliang yang menyerap air untuk mencuci.", c: "peralatan" },
            { w: "TUALA", d: "Kain lembut menyerap air untuk mengeringkan badan.", c: "peralatan" },
            { w: "PAGAR", d: "Penghalang keselamatan keliling kawasan.", c: "peralatan" },
            { w: "PAPAN", d: "Kepingan kayu rata dan lebar.", c: "peralatan" },
            { w: "KAPAL", d: "Kenderaan besar yang belayar di air.", c: "peralatan" },
            { w: "MOTOR", d: "Enjin penggerak atau kenderaan motosikal.", c: "peralatan" },
            { w: "KIPAS", d: "Alat hembusan angin untuk mendinginkan udara.", c: "peralatan" },
            { w: "CEREK", d: "Bekas pemanas air berpemegang.", c: "peralatan" },
            { w: "KUALI", d: "Bejana bulat cekung untuk menggoreng makanan.", c: "peralatan" },

            // Kategori: makanan
            { w: "BERAS", d: "Padi yang telah dibuang kulitnya.", c: "makanan" },
            { w: "ROTI", d: "Makanan asas daripada adunan tepung yang dibakar.", c: "makanan" },
            { w: "GULA", d: "Bahan pemanis kristal putih daripada tebu.", c: "makanan" },
            { w: "GARAM", d: "Bahan masin daripada air laut.", c: "makanan" },
            { w: "LADA", d: "Rempah pedas atau cili.", c: "makanan" },
            { w: "CABAI", d: "Cili pedas penyedap makanan.", c: "makanan" },
            { w: "CILI", d: "Buah pedas pelbagai warna.", c: "makanan" },
            { w: "BAWAN", d: "Bahan ramuan masakan berbau harum.", c: "makanan" },
            { w: "TIMUN", d: "Sayur buah hijau segar berair.", c: "makanan" },
            { w: "SAYUR", d: "Tumbuhan yang dijadikan bahan makanan.", c: "makanan" },
            { w: "EPAL", d: "Buah bulat manis dan rangup.", c: "makanan" },
            { w: "NANAS", d: "Buah bersisik tajam berkuning manis.", c: "makanan" },
            { w: "LAKSA", d: "Hidangan mi berkuah rempah masam pedas.", c: "makanan" },
            { w: "NASI", d: "Beras yang telah dimasak dengan air.", c: "makanan" },
            { w: "SUP", d: "Masakan berkuah sup yang gurih.", c: "makanan" },
            { w: "SOTO", d: "Hidangan sup berempah khas tradisi.", c: "makanan" },
            { w: "KUAH", d: "Cecair masakan berasa sedap.", c: "makanan" },
            { w: "KARI", d: "Masakan berkuah rempah pekat.", c: "makanan" },
            { w: "TELUR", d: "Bahan makanan berzat daripada unggas.", c: "makanan" },
            { w: "TEMPE", d: "Makanan terbitan kacang soya terfermentasi.", c: "makanan" },
            { w: "TAHU", d: "Gumpalan protein soya lembut.", c: "makanan" },
            { w: "SOYA", d: "Kacang tumbuhan bernilai protein tinggi.", c: "makanan" },
            { w: "TEH", d: "Minuman seduhan daun teh harum.", c: "makanan" },

            // Kategori: tubuh
            { w: "PERUT", d: "Bahagian badan tempat penghadaman makanan.", c: "tubuh" },
            { w: "DARAH", d: "Cecair merah penting mengalir dalam pembuluh tubuh.", c: "tubuh" },
            { w: "HATI", d: "Organ dalaman penting; pusat emosi.", c: "tubuh" },
            { w: "SUARA", d: "Bunyi yang dihasilkan oleh pita suara.", c: "tubuh" },
            { w: "MATA", d: "Organ penglihatan manusia dan haiwan.", c: "tubuh" },
            { w: "JARI", d: "Anggota di hujung tangan atau kaki.", c: "tubuh" },
            { w: "KAKI", d: "Anggota bawah tubuh untuk berdiri dan berjalan.", c: "tubuh" },
            { w: "KUKU", d: "Lapisan keras di hujung jari.", c: "tubuh" },
            { w: "SAYAP", d: "Anggota badan burung untuk terbang.", c: "tubuh" },
            { w: "PARUK", d: "Paru-paru atau bahagian organ pernafasan.", c: "tubuh" },

            // Kategori: tempat
            { w: "PANTA", d: "Kawasan persisiran darat di tepi laut.", c: "tempat" },
            { w: "GUNUN", d: "Binaan alam tanah tinggi melebihi bukit.", c: "tempat" },
            { w: "BUKIT", d: "Kawasan tanah tinggi berukuran sederhana.", c: "tempat" },
            { w: "SUNGA", d: "Laluan air tawar semula jadi yang mengalir.", c: "tempat" },
            { w: "TASIK", d: "Kawasan air yang dikelilingi daratan.", c: "tempat" },
            { w: "LAUT", d: "Kumpulan air masin yang sangat luas.", c: "tempat" },
            { w: "HUTAN", d: "Kawasan luas ditumbuhi pokok-pokok liar.", c: "tempat" },
            { w: "TAMAN", d: "Kawasan rekreasi atau bunga yang indah.", c: "tempat" },
            { w: "PASAR", d: "Tempat urus niaga jual beli barang.", c: "tempat" },
            { w: "KEDAI", d: "Bangunan tempat menjual barangan.", c: "tempat" },
            { w: "BILIK", d: "Ruang terasing dalam rumah atau bangunan.", c: "tempat" },
            { w: "DAPUR", d: "Ruang memasak makanan di rumah.", c: "tempat" },
            { w: "DEWAN", d: "Bangunan besar untuk majlis atau perhimpunan.", c: "tempat" },
            { w: "KILAN", d: "Premis pembuatan barangan industri.", c: "tempat" },
            { w: "PULAU", d: "Daratan yang dikelilingi oleh laut sepenuhnya.", c: "tempat" },
            { w: "TANAH", d: "Permukaan bumi tempat tumbuhan bercambah.", c: "tempat" },
            { w: "HUJAN", d: "Titisan air dari awan jatuh ke bumi.", c: "tempat" },
            { w: "MALAM", d: "Waktu gelap apabila matahari terbenam.", c: "tempat" },

            // Kategori: sifat
            { w: "MERAH", d: "Warna seperti warna darah.", c: "sifat" },
            { w: "HIJAU", d: "Warna segar seperti warna daun.", c: "sifat" },
            { w: "BIRU", d: "Warna jernih seperti warna langit cerah.", c: "sifat" },
            { w: "KUNIN", d: "Warna terang seperti kunyit atau emas.", c: "sifat" },
            { w: "HITAM", d: "Warna gelap tanpa sebarang cahaya.", c: "sifat" },
            { w: "PUTIH", d: "Warna bersih seperti warna salji atau kapas.", c: "sifat" },
            { w: "UNGU", d: "Warna gabungan merah dan biru.", c: "sifat" },
            { w: "BESAR", d: "Ukuran saiz yang luas atau tinggi.", c: "sifat" },
            { w: "KECIL", d: "Ukuran saiz yang sedikit atau kerdil.", c: "sifat" },
            { w: "PANJA", d: "Ukuran jarak dari hujung ke hujung yang jauh.", c: "sifat" },
            { w: "PENDE", d: "Ukuran yang tidak panjang.", c: "sifat" },
            { w: "TINGG", d: "Ukuran dari tapak ke atas yang jauh.", c: "sifat" },
            { w: "TEBAL", d: "Berlapis tebal; tidak nipis.", c: "sifat" },
            { w: "NIPIS", d: "Lembaran yang sangat selapis.", c: "sifat" },
            { w: "BERAT", d: "Sukar diangkat kerana timbangan tinggi.", c: "sifat" },
            { w: "RINGA", d: "Mudah diangkat; timbangan rendah.", c: "sifat" },
            { w: "KERAS", d: "Pepejal padat yang tidak mudah kemek.", c: "sifat" },
            { w: "LEMBUT", d: "Mudah diubah bentuk atau disentuh.", c: "sifat" },
            { w: "PANAS", d: "Suhu tinggi hangat membara.", c: "sifat" },
            { w: "SEJUK", d: "Suhu rendah dingin melegakan.", c: "sifat" },
            { w: "BASAH", d: "Mengandungi atau terkena cecair air.", c: "sifat" },
            { w: "KERIN", d: "Bebas daripada sebarang kelembapan air.", c: "sifat" },
            { w: "TAJAM", d: "Mudah memotong atau melukai.", c: "sifat" },
            { w: "MANIS", d: "Rasa sedap seperti rasa gula.", c: "sifat" },
            { w: "MASAM", d: "Rasa masam seperti buah asam jawa.", c: "sifat" },
            { w: "MASIN", d: "Rasa seperti garam laut.", c: "sifat" },
            { w: "PAHIT", d: "Rasa kelat pahit seperti kopi tanpa gula.", c: "sifat" },
            { w: "PEDAS", d: "Rasa panas menggigit seperti cili.", c: "sifat" },
            { w: "WANGI", d: "Bau harum menyenangkan hidung.", c: "sifat" },
            { w: "MAKAN", d: "Memasukkan makanan ke dalam mulut dan menelan.", c: "sifat" },
            { w: "MINUM", d: "Memasukkan cecair ke dalam mulut dan menelan.", c: "sifat" },
            { w: "LARI", d: "Melangkah kaki dengan amat pantas.", c: "sifat" },
            { w: "DUDUK", d: "Meletakkan bahagian punggung di atas kerusi/tanah.", c: "sifat" },
            { w: "TIDUR", d: "Berehat memejamkan mata secara separa sedar.", c: "sifat" },
            { w: "BACA", d: "Memahami teks bertulis dengan teliti.", c: "sifat" },
            { w: "TULIS", d: "Mencatat abjad menggunakan pena atau pensel.", c: "sifat" },
            { w: "HIDUP", d: "Bernafas dan bernyawa.", c: "sifat" }
        ];

        // Format and clean master dictionary
        const WORD_LOOKUP = {};
        RAW_MALAY_WORDS.forEach(item => {
            const cleanWord = item.w.toUpperCase().trim();
            if (cleanWord.length === 5) {
                WORD_LOOKUP[cleanWord] = {
                    def: item.d,
                    cat: item.c
                };
            }
        });

        const VALID_TARGET_WORDS = Object.keys(WORD_LOOKUP);
        const ALL_VALID_GUESSES = new Set(VALID_TARGET_WORDS);

        /* ===================================================================
           2. STATE & ROUTING MANAGEMENT
           =================================================================== */
        const MAX_ATTEMPTS = 6;
        const WORD_LENGTH = 5;

        let gameMode = 'random'; // 'random', 'daily', or 'category'
        let selectedCategory = null;
        let targetWord = "";
        let targetDef = "";
        let currentGuess = "";
        let guesses = [];
        let gameOver = false;
        let isMuted = false;
        let hintsUsed = 0;

        let stats = {
            played: 0,
            wins: 0,
            currentStreak: 0,
            maxStreak: 0,
            guesses: { 1: 0, 2: 0, 3: 0, 4: 0, 5: 0, 6: 0 }
        };

        /* ===================================================================
           3. WEB AUDIO SYNTHESIZER
           =================================================================== */
        class SoundEffects {
            constructor() {
                this.ctx = null;
            }

            init() {
                if (!this.ctx) {
                    const AudioContext = window.AudioContext || window.webkitAudioContext;
                    if (AudioContext) {
                        this.ctx = new AudioContext();
                    }
                }
            }

            playKey() {
                if (isMuted) return;
                this.init();
                if (!this.ctx) return;
                
                const osc = this.ctx.createOscillator();
                const gain = this.ctx.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(420, this.ctx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(220, this.ctx.currentTime + 0.05);
                
                gain.gain.setValueAtTime(0.1, this.ctx.currentTime);
                gain.gain.linearRampToValueAtTime(0.01, this.ctx.currentTime + 0.05);

                osc.connect(gain);
                gain.connect(this.ctx.destination);
                osc.start();
                osc.stop(this.ctx.currentTime + 0.05);
            }

            playFlip(index) {
                if (isMuted) return;
                this.init();
                if (!this.ctx) return;

                const osc = this.ctx.createOscillator();
                const gain = this.ctx.createGain();
                osc.type = 'triangle';
                osc.frequency.setValueAtTime(320 + (index * 60), this.ctx.currentTime);
                
                gain.gain.setValueAtTime(0.12, this.ctx.currentTime);
                gain.gain.linearRampToValueAtTime(0.01, this.ctx.currentTime + 0.08);

                osc.connect(gain);
                gain.connect(this.ctx.destination);
                osc.start();
                osc.stop(this.ctx.currentTime + 0.08);
            }

            playError() {
                if (isMuted) return;
                this.init();
                if (!this.ctx) return;

                const osc = this.ctx.createOscillator();
                const gain = this.ctx.createGain();
                osc.type = 'sawtooth';
                osc.frequency.setValueAtTime(160, this.ctx.currentTime);
                osc.frequency.setValueAtTime(120, this.ctx.currentTime + 0.1);
                
                gain.gain.setValueAtTime(0.18, this.ctx.currentTime);
                gain.gain.linearRampToValueAtTime(0.01, this.ctx.currentTime + 0.22);

                osc.connect(gain);
                gain.connect(this.ctx.destination);
                osc.start();
                osc.stop(this.ctx.currentTime + 0.22);
            }

            playWin() {
                if (isMuted) return;
                this.init();
                if (!this.ctx) return;

                const notes = [261.63, 329.63, 392.00, 523.25];
                notes.forEach((freq, idx) => {
                    const osc = this.ctx.createOscillator();
                    const gain = this.ctx.createGain();
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(freq, this.ctx.currentTime + (idx * 0.08));

                    gain.gain.setValueAtTime(0.15, this.ctx.currentTime + (idx * 0.08));
                    gain.gain.linearRampToValueAtTime(0.01, this.ctx.currentTime + (idx * 0.08) + 0.2);

                    osc.connect(gain);
                    gain.connect(this.ctx.destination);
                    osc.start(this.ctx.currentTime + (idx * 0.08));
                    osc.stop(this.ctx.currentTime + (idx * 0.08) + 0.2);
                });
            }
        }

        const sounds = new SoundEffects();

        /* ===================================================================
           4. DOM ELEMENTS & ROUTING LOGIC
           =================================================================== */
        const viewHome = document.getElementById('view-home');
        const viewGame = document.getElementById('view-game');
        const gridContainer = document.getElementById('grid-container');
        const keyboard = document.getElementById('keyboard');
        const definitionCard = document.getElementById('definition-card');
        const defWord = document.getElementById('def-word');
        const defMeaning = document.getElementById('def-meaning');
        const btnPlayAgain = document.getElementById('btn-play-again');
        const btnModalPlayAgain = document.getElementById('btn-modal-play-again');
        const btnHint = document.getElementById('btn-hint');
        const btnBack = document.getElementById('btn-back');
        const modeLabel = document.getElementById('mode-label');

        const modalStats = document.getElementById('modal-stats');
        const modalHelp = document.getElementById('modal-help');

        const btnSound = document.getElementById('btn-sound');
        const iconSound = document.getElementById('icon-sound');
        const btnTheme = document.getElementById('btn-theme');
        const iconTheme = document.getElementById('icon-theme');

        window.addEventListener('DOMContentLoaded', () => {
            loadStats();
            loadSettings();
            initGrid();
            setupEventListeners();
        });

        /* NAVIGATION LOGIC */
        function navigateToGame(mode = 'random', category = null) {
            gameMode = mode;
            selectedCategory = category;
            showGameScreen(true);
        }

        function navigateToHomeView() {
            if (!modalHelp.classList.contains('hidden') || !modalStats.classList.contains('hidden')) {
                hideModal(modalHelp);
                hideModal(modalStats);
            }
            showHomeScreen(true);
        }

        function showHomeScreen(animate = true) {
            viewGame.classList.add('hidden');
            viewHome.classList.remove('hidden');
            if (animate) {
                viewHome.classList.add('animate-pop');
            }
        }

        function showGameScreen(startFresh = true) {
            viewHome.classList.add('hidden');
            viewGame.classList.remove('hidden');

            if (startFresh) {
                startNewGame();
            }
        }

        /* ===================================================================
           5. GAME SETUP
           =================================================================== */
        function initGrid() {
            gridContainer.innerHTML = '';
            for (let r = 0; r < MAX_ATTEMPTS; r++) {
                const row = document.createElement('div');
                row.className = 'grid grid-cols-5 gap-1.5 sm:gap-2 w-full';
                row.dataset.row = r;

                for (let c = 0; c < WORD_LENGTH; c++) {
                    const tile = document.createElement('div');
                    tile.className = 'tile aspect-square text-xl sm:text-2xl font-black shadow-xs';
                    tile.dataset.row = r;
                    tile.dataset.col = c;
                    tile.dataset.state = 'empty';
                    row.appendChild(tile);
                }
                gridContainer.appendChild(row);
            }
        }

        function startNewGame() {
            if (gameMode === 'daily') {
                const today = new Date();
                const seed = today.getFullYear() * 10000 + (today.getMonth() + 1) * 100 + today.getDate();
                const index = seed % VALID_TARGET_WORDS.length;
                targetWord = VALID_TARGET_WORDS[index];
                modeLabel.textContent = "Teka-teki Harian";
            } else if (gameMode === 'category' && selectedCategory) {
                const filteredWords = VALID_TARGET_WORDS.filter(w => WORD_LOOKUP[w].cat === selectedCategory);
                const randomIndex = Math.floor(Math.random() * filteredWords.length);
                targetWord = filteredWords[randomIndex];
                modeLabel.textContent = `Kategori: ${CATEGORIES[selectedCategory]}`;
            } else {
                const randomIndex = Math.floor(Math.random() * VALID_TARGET_WORDS.length);
                targetWord = VALID_TARGET_WORDS[randomIndex];
                modeLabel.textContent = "Mod Rawak";
            }

            const item = WORD_LOOKUP[targetWord];
            targetDef = item ? item.def : "Kata am Bahasa Melayu (5 huruf).";

            currentGuess = "";
            guesses = [];
            gameOver = false;
            hintsUsed = 0;

            definitionCard.classList.add('hidden');
            btnHint.disabled = false;
            btnHint.classList.remove('opacity-50', 'cursor-not-allowed');

            // Reset Grid UI
            const tiles = gridContainer.querySelectorAll('.tile');
            tiles.forEach(tile => {
                tile.textContent = '';
                tile.dataset.state = 'empty';
                tile.classList.remove('animate-flip', 'animate-shake', 'animate-pop');
                tile.style.animationDelay = '0ms';
            });

            // Reset Keyboard Colors
            const keys = keyboard.querySelectorAll('.key-btn');
            keys.forEach(key => {
                key.classList.remove('bg-emerald-600', 'bg-amber-500', 'bg-slate-500', 'dark:bg-slate-600', 'text-white');
                if (key.dataset.key !== 'ENTER' && key.dataset.key !== 'BACKSPACE') {
                    key.className = 'key-btn h-12 sm:h-13 rounded-md bg-slate-200 dark:bg-slate-700 font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm';
                }
            });
        }

        /* ===================================================================
           6. EVENT LISTENERS
           =================================================================== */
        function setupEventListeners() {
            document.getElementById('btn-mode-random').addEventListener('click', () => navigateToGame('random'));
            document.getElementById('btn-mode-daily').addEventListener('click', () => navigateToGame('daily'));

            btnBack.addEventListener('click', (e) => {
                e.preventDefault();
                try {
                    window.location.href = 'home.php';
                } catch (err) {
                    navigateToHomeView();
                }
            });

            keyboard.addEventListener('click', (e) => {
                const button = e.target.closest('.key-btn');
                if (!button || gameOver) return;

                const key = button.dataset.key;
                handleKeyPress(key);
            });

            document.addEventListener('keydown', (e) => {
                if (viewGame.classList.contains('hidden') || gameOver) return;
                
                if (!modalStats.classList.contains('hidden') || !modalHelp.classList.contains('hidden')) {
                    if (e.key === 'Escape') {
                        hideModal(modalHelp);
                        hideModal(modalStats);
                    }
                    return;
                }

                if (e.key === 'Enter') {
                    handleKeyPress('ENTER');
                } else if (e.key === 'Backspace') {
                    handleKeyPress('BACKSPACE');
                } else {
                    const letter = e.key.toUpperCase();
                    if (/^[A-Z]$/.test(letter)) {
                        handleKeyPress(letter);
                    }
                }
            });

            btnPlayAgain.addEventListener('click', startNewGame);
            btnModalPlayAgain.addEventListener('click', () => {
                hideModal(modalStats);
                if (viewGame.classList.contains('hidden')) {
                    navigateToGame('random');
                } else {
                    startNewGame();
                }
            });

            btnHint.addEventListener('click', giveHint);

            document.getElementById('btn-help').addEventListener('click', () => showModal(modalHelp));
            document.getElementById('btn-stats').addEventListener('click', () => {
                updateStatsModal();
                showModal(modalStats);
            });
            document.getElementById('home-btn-stats').addEventListener('click', () => {
                updateStatsModal();
                showModal(modalStats);
            });
            document.getElementById('home-btn-help').addEventListener('click', () => showModal(modalHelp));

            document.querySelectorAll('.btn-close-modal').forEach(btn => {
                btn.addEventListener('click', () => {
                    hideModal(modalHelp);
                    hideModal(modalStats);
                });
            });

            btnSound.addEventListener('click', () => {
                isMuted = !isMuted;
                localStorage.setItem('tekakata_sound', isMuted ? 'muted' : 'active');
                updateSoundIcon();
            });

            btnTheme.addEventListener('click', () => {
                document.documentElement.classList.toggle('dark');
                const isDark = document.documentElement.classList.contains('dark');
                localStorage.setItem('tekakata_theme', isDark ? 'dark' : 'light');
                updateThemeIcon();
            });
        }

        /* ===================================================================
           7. GAMEPLAY LOGIC & GUESS PROCESSING
           =================================================================== */
        function handleKeyPress(key) {
            if (gameOver) return;

            if (key === 'ENTER') {
                submitGuess();
            } else if (key === 'BACKSPACE') {
                if (currentGuess.length > 0) {
                    sounds.playKey();
                    currentGuess = currentGuess.slice(0, -1);
                    updateCurrentRowUI();
                }
            } else if (/^[A-Z]$/.test(key)) {
                if (currentGuess.length < WORD_LENGTH) {
                    sounds.playKey();
                    currentGuess += key;
                    updateCurrentRowUI();
                }
            }
        }

        function updateCurrentRowUI() {
            const rowIndex = guesses.length;
            const rowTiles = gridContainer.querySelectorAll(`[data-row="${rowIndex}"] .tile`);

            rowTiles.forEach((tile, colIndex) => {
                if (colIndex < currentGuess.length) {
                    tile.textContent = currentGuess[colIndex];
                    tile.dataset.state = 'tapped';
                } else {
                    tile.textContent = '';
                    tile.dataset.state = 'empty';
                }
            });
        }

        function submitGuess() {
            if (currentGuess.length < WORD_LENGTH) {
                showToast("Cukupkan 5 huruf!");
                shakeRow(guesses.length);
                sounds.playError();
                return;
            }

            if (!ALL_VALID_GUESSES.has(currentGuess)) {
                showToast("Tiada dalam kamus BM!");
                shakeRow(guesses.length);
                sounds.playError();
                return;
            }

            const rowIndex = guesses.length;
            const currentTiles = gridContainer.querySelectorAll(`[data-row="${rowIndex}"] .tile`);
            const guessArray = currentGuess.split('');
            const targetArray = targetWord.split('');

            const resultStates = Array(WORD_LENGTH).fill('absent');
            const targetTaken = Array(WORD_LENGTH).fill(false);

            guessArray.forEach((letter, i) => {
                if (letter === targetArray[i]) {
                    resultStates[i] = 'correct';
                    targetTaken[i] = true;
                }
            });

            guessArray.forEach((letter, i) => {
                if (resultStates[i] !== 'correct') {
                    for (let j = 0; j < WORD_LENGTH; j++) {
                        if (!targetTaken[j] && letter === targetArray[j]) {
                            resultStates[i] = 'present';
                            targetTaken[j] = true;
                            break;
                        }
                    }
                }
            });

            currentTiles.forEach((tile, i) => {
                setTimeout(() => {
                    tile.classList.add('animate-flip');
                    tile.dataset.state = resultStates[i];
                    sounds.playFlip(i);

                    if (i === WORD_LENGTH - 1) {
                        updateKeyboardColors(guessArray, resultStates);
                        checkGameOutcome();
                    }
                }, i * 220);
            });

            guesses.push(currentGuess);
        }

        function updateKeyboardColors(guessArray, resultStates) {
            guessArray.forEach((letter, i) => {
                const keyBtn = keyboard.querySelector(`[data-key="${letter}"]`);
                if (!keyBtn) return;

                const currentState = resultStates[i];
                if (currentState === 'correct') {
                    keyBtn.className = 'key-btn h-12 sm:h-13 rounded-md bg-emerald-600 text-white font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm';
                } else if (currentState === 'present' && !keyBtn.classList.contains('bg-emerald-600')) {
                    keyBtn.className = 'key-btn h-12 sm:h-13 rounded-md bg-amber-500 text-white font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm';
                } else if (currentState === 'absent' && !keyBtn.classList.contains('bg-emerald-600') && !keyBtn.classList.contains('bg-amber-500')) {
                    keyBtn.className = 'key-btn h-12 sm:h-13 rounded-md bg-slate-400 dark:bg-slate-600 text-white font-bold text-sm sm:text-base flex-1 flex items-center justify-center shadow-sm opacity-60';
                }
            });
        }

        function checkGameOutcome() {
            const isWin = currentGuess === targetWord;
            const isLoss = guesses.length >= MAX_ATTEMPTS && !isWin;

            if (isWin) {
                gameOver = true;
                sounds.playWin();
                triggerConfetti();
                showToast(getWinPhrase(guesses.length), 3000);
                saveGameStats(true, guesses.length);
                revealDefinition();
            } else if (isLoss) {
                gameOver = true;
                sounds.playError();
                showToast(`Perkataan Rahsia: ${targetWord}`, 4000);
                saveGameStats(false, guesses.length);
                revealDefinition();
            } else {
                currentGuess = "";
            }
        }

        function revealDefinition() {
            defWord.textContent = targetWord;
            defMeaning.textContent = `"${targetDef}"`;
            definitionCard.classList.remove('hidden');
        }

        /* ===================================================================
           8. PETUNJUK & UTILITIES
           =================================================================== */
        function giveHint() {
            if (gameOver) return;

            if (hintsUsed >= 1) {
                showToast("Satu petunjuk sahaja setiap perlawanan!");
                return;
            }

            const unrevealedIndices = [];
            for (let i = 0; i < WORD_LENGTH; i++) {
                const targetChar = targetWord[i];
                let revealed = false;
                
                guesses.forEach(g => {
                    if (g[i] === targetChar) revealed = true;
                });

                if (!revealed) {
                    unrevealedIndices.push(i);
                }
            }

            if (unrevealedIndices.length > 0) {
                const randomIndex = unrevealedIndices[Math.floor(Math.random() * unrevealedIndices.length)];
                const letter = targetWord[randomIndex];
                showToast(`Petunjuk: Huruf ke-${randomIndex + 1} ialah '${letter}'`, 3500);
                hintsUsed++;
                btnHint.disabled = true;
                btnHint.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                showToast("Semua huruf tepat telah ditemui!");
            }
        }

        function shakeRow(rowIndex) {
            const row = gridContainer.querySelector(`[data-row="${rowIndex}"]`);
            if (row) {
                row.classList.add('animate-shake');
                setTimeout(() => row.classList.remove('animate-shake'), 500);
            }
        }

        function showToast(message, duration = 2000) {
            const toast = document.createElement('div');
            toast.className = 'bg-slate-800 dark:bg-slate-100 text-white dark:text-slate-800 font-extrabold text-sm px-4 py-2 rounded-full shadow-lg border border-slate-700 dark:border-slate-300 animate-pop';
            toast.textContent = message;

            const container = document.getElementById('toast-container');
            container.appendChild(toast);

            setTimeout(() => {
                toast.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                setTimeout(() => toast.remove(), 300);
            }, duration);
        }

        function triggerConfetti() {
            if (typeof confetti === 'function') {
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: { y: 0.6 }
                });
            }

        }

        function getWinPhrase(attempts) {
            switch(attempts) {
                case 1: return "Luar Biasa! Sekali Teka!";
                case 2: return "Hebat Sekali!";
                case 3: return "Tahniah! Cemerlang!";
                case 4: return "Syabas! Bijak!";
                case 5: return "Hampir Sahaja! Berjaya!";
                case 6: return "Selamat pada minit akhir!";
                default: return "Tahniah!";
            }
        }

        /* ===================================================================
           9. LOCAL STORAGE & STATS
           =================================================================== */
        function loadStats() {
            const saved = localStorage.getItem('tekakata_stats');
            if (saved) {
                try {
                    stats = JSON.parse(saved);
                } catch(e) {
                    console.error("Failed to parse stats", e);
                }
            }
        }

        function saveGameStats(isWin, attempts) {
            stats.played++;
            if (isWin) {
                stats.wins++;
                stats.currentStreak++;
                if (stats.currentStreak > stats.maxStreak) {
                    stats.maxStreak = stats.currentStreak;
                }
                stats.guesses[attempts] = (stats.guesses[attempts] || 0) + 1;
            } else {
                stats.currentStreak = 0;
            }
            localStorage.setItem('tekakata_stats', JSON.stringify(stats));
        }

        function updateStatsModal() {
            document.getElementById('stat-played').textContent = stats.played;
            const winrate = stats.played > 0 ? Math.round((stats.wins / stats.played) * 100) : 0;
            document.getElementById('stat-winrate').textContent = `${winrate}%`;
            document.getElementById('stat-streak').textContent = stats.currentStreak;
            document.getElementById('stat-maxstreak').textContent = stats.maxStreak;

            const distContainer = document.getElementById('guess-distribution');
            distContainer.innerHTML = '';

            const maxVal = Math.max(...Object.values(stats.guesses), 1);

            for (let i = 1; i <= MAX_ATTEMPTS; i++) {
                const count = stats.guesses[i] || 0;
                const pct = Math.max(8, Math.round((count / maxVal) * 100));

                const row = document.createElement('div');
                row.className = 'flex items-center gap-2 text-xs font-bold';

                row.innerHTML = `
                    <span class="w-3 text-right text-slate-500">${i}</span>
                    <div class="flex-1 bg-slate-100 dark:bg-slate-700/50 rounded-md overflow-hidden">
                        <div class="h-5 bg-emerald-500 text-white flex items-center justify-end px-2 transition-all duration-500 rounded-md" style="width: ${pct}%">
                            ${count}
                        </div>
                    </div>
                `;
                distContainer.appendChild(row);
            }
        }

        function showModal(modal) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.querySelector('div').classList.remove('scale-95');
                modal.querySelector('div').classList.add('scale-100');
            }, 10);
        }

        function hideModal(modal) {
            modal.querySelector('div').classList.remove('scale-100');
            modal.querySelector('div').classList.add('scale-95');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        function loadSettings() {
            const soundPref = localStorage.getItem('tekakata_sound');
            if (soundPref === 'muted') {
                isMuted = true;
            }
            updateSoundIcon();

            const themePref = localStorage.getItem('tekakata_theme');
            if (themePref === 'dark' || (!themePref && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            updateThemeIcon();
        }

        function updateSoundIcon() {
            if (isMuted) {
                iconSound.className = 'fa-solid fa-volume-xmark text-rose-500';
            } else {
                iconSound.className = 'fa-solid fa-volume-high text-slate-600 dark:text-slate-300';
            }
        }

        function updateThemeIcon() {
            const isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
                iconTheme.className = 'fa-solid fa-sun text-amber-400';
            } else {
                iconTheme.className = 'fa-solid fa-moon text-slate-600';
            }
        }
    </script>
</body>
</html>