<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
            <a href="home.php" id="btn-back" class="flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl text-xs font-bold transition shadow-xs border border-slate-200 dark:border-slate-700" title="Kembali ke home.php">
                <i class="fa-solid fa-arrow-left"></i>
                <span class="inline">Kembali</span>
            </a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Birthday — Clutch Queen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        lightBg: '#e6f2ff',
                        softBlue: '#f0f7ff',
                        cardBg: '#ffffff',
                        cardBorder: '#cbd5e1',
                        goldText: '#b47816',
                        goldGlow: '#d97706',
                        purpleAccent: '#6d28d9',
                        purpleDeep: '#4c1d95',
                        navyDark: '#0f172a',
                        bodyText: '#334155'
                    },
                    fontFamily: {
                        serif: ['"Playfair Display"', 'serif'],
                        cinzel: ['Cinzel', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['ui-monospace', 'SFMono-Regular', 'Menlo', 'monospace']
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #e6f2ff;
            background-image: radial-gradient(at 0% 0%, rgba(219, 234, 254, 0.8) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(221, 214, 254, 0.6) 0px, transparent 50%);
            color: #334155;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        .gold-gradient-text {
            background: linear-gradient(135deg, #b47816 0%, #d97706 50%, #92400e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .corner-card {
            position: relative;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            clip-path: polygon(
                0 16px, 16px 0, 
                100% 0, 
                100% calc(100% - 16px), calc(100% - 16px) 100%, 
                0 100%
            );
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.03);
        }

        .corner-card:hover {
            border-color: #b47816;
            transform: translateY(-2px);
            box-shadow: 0 14px 30px -5px rgba(180, 120, 22, 0.15);
        }

        .corner-pill {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            border: 1px solid #cbd5e1;
            clip-path: polygon(
                0 12px, 12px 0, 
                100% 0, 
                100% calc(100% - 12px), calc(100% - 12px) 100%, 
                0 100%
            );
            box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.1);
        }

        .nav-btn {
            transition: all 0.2s ease;
        }
        .nav-btn.active {
            color: #b47816;
            border-bottom: 2px solid #b47816;
        }

        /* Image Sound Pulse Effect */
        .image-sound-wrapper {
            position: relative;
            cursor: pointer;
            overflow: hidden;
        }
        .image-sound-wrapper::after {
            content: '';
            position: absolute;
            inset: 0;
            border: 2px solid transparent;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            pointer-events: none;
        }
        .image-sound-wrapper.playing::after {
            border-color: #b47816;
            box-shadow: inset 0 0 25px rgba(180, 120, 22, 0.3);
            animation: pulseGlow 0.8s ease-in-out infinite alternate;
        }

        @keyframes pulseGlow {
            from { box-shadow: inset 0 0 10px rgba(180, 120, 22, 0.2); }
            to { box-shadow: inset 0 0 30px rgba(180, 120, 22, 0.5); }
        }

        /* Sound Ripple Indicator */
        .sound-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(180, 120, 22, 0.4);
            color: #b47816;
            padding: 4px 10px;
            border-radius: 9999px;
            font-family: ui-monospace, SFMono-Regular, monospace;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.1em;
            display: flex;
            align-items: center;
            gap: 6px;
            opacity: 0;
            transform: translateY(-6px);
            transition: all 0.3s ease;
            pointer-events: none;
            z-index: 20;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .image-sound-wrapper:hover .sound-badge,
        .image-sound-wrapper.playing .sound-badge {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #e6f2ff;
        }
        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }
    </style>
</head>
<body class="selection:bg-amber-500/20 selection:text-amber-900">

    <!-- HERO SECTION (TOP) -->
    <section id="top" class="min-h-screen relative flex items-center justify-center px-6 lg:px-20 py-24">
        <div class="max-w-7xl w-full grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Column Content -->
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-block font-mono text-xs font-semibold tracking-[0.25em] text-goldText uppercase">
                    
                </div>
                
                <h1 class="font-serif text-5xl sm:text-7xl lg:text-8xl font-normal tracking-tight gold-gradient-text leading-[1.1]">
                    HAPPY BIRTHDAY
                </h1>
                
                <div class="inline-block font-mono text-sm tracking-[0.3em] text-purpleAccent font-semibold">
                    AIFA NABILAH BINTI BASIR
                </div>
                
                <p class="text-slate-600 text-lg max-w-lg leading-relaxed pt-2">
                    Selamat hari lahir! 🎂 Semoga Allah sentiasa merahmati setiap langkahmu, mempermudahkan segala urusan, meluaskan rezeki, mengurniakan kesihatan yang baik serta menetapkan hati dalam iman dan Islam. Semoga segala doa yang baik dimakbulkan dan semoga kita sentiasa berada dalam lindungan-Nya. Aamiin ya Rabbal Alamin. 🤍 
                </p>

                <div class="pt-6 flex items-center space-x-4">
                    <div class="w-px h-16 bg-gradient-to-b from-goldText/60 to-transparent"></div>
                    <span class="font-mono text-xs tracking-[0.3em] text-slate-500 uppercase">Scroll · Click photos to play your audio</span>
                </div>
            </div>

            <!-- Right Column Image Frame -->
            <div class="lg:col-span-6 flex justify-center lg:justify-end">
                <div class="corner-card p-3 max-w-lg w-full">
                    <div class="image-sound-wrapper relative rounded-sm aspect-[4/3]" onclick="playCustomImageAudio('heroAudio', 'hero-ukulele', this)">
                        <!-- EDIT YOUR AUDIO FILE HERE 1 -->
                        <audio id="heroAudio" src="@TheMarias - No One Noticed (Lyrics).mp3" preload="auto"></audio>

                        <img src="photo_3_2026-10-15_11-43-16.jpg" 
                             alt="Atmospheric Ukulele in Light Room" 
                             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700 filter brightness-95 contrast-105"
                             onerror="this.src='https://placehold.co/800x600/ffffff/b47816?text=Ukulele+Vibe'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-purple-900/10 pointer-events-none"></div>
                        <div class="sound-badge">
                            <i class="fa-solid fa-volume-high animate-pulse"></i> TAP FOR SOUND
                        </div>
                        <div class="absolute bottom-4 left-4 font-mono text-xs text-white tracking-wider z-10 font-medium">
                            01 /OUR FIRST MEET
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- SIDE ONE — TACTICAL -->
    <section id="tactical" class="min-h-screen py-28 px-6 lg:px-20 border-t border-slate-300/60">
        <div class="max-w-7xl mx-auto space-y-16">
            
            <!-- Section Header -->
            <div class="space-y-4">
                <div class="font-mono text-xs font-semibold tracking-[0.3em] text-goldText uppercase">
                    SIDE ONE — VALORANT
                </div>
                <h2 class="font-serif text-4xl sm:text-6xl gold-gradient-text">
                    Clutch Queen
                </h2>
                <p class="text-slate-600 text-base sm:text-lg max-w-2xl">
                    I LOVE PLAY VALO WITH MY FAAFAA.
                </p>
            </div>

            <!-- Two Image Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1: Setup -->
                <div class="corner-card p-4 space-y-4">
                    <div class="image-sound-wrapper relative rounded-sm aspect-[16/10]" onclick="playCustomImageAudio('keyboardAudio', 'keyboard', this)">
                        <!-- EDIT YOUR AUDIO FILE HERE 2 -->
                        <audio id="keyboardAudio" src="valorant-09-19-2026-0-13-27-769_jmqh3lai.mp3" preload="auto"></audio>

                        <img src="photo_2_2026-10-15_11-43-16.jpg" 
                             alt="Mechanical Keyboard with Purple Neon Keycap" 
                             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700"
                             onerror="this.src='https://placehold.co/800x500/ffffff/6d28d9?text=Mechanical+Keyboard'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent pointer-events-none"></div>
                        <div class="sound-badge">
                            <i class="fa-solid fa-keyboard animate-pulse"></i> TAP FOR SOUND
                        </div>
                    </div>
                    <div class="flex justify-between items-center px-2 pb-2">
                        <span class="font-mono text-xs font-semibold tracking-widest text-purpleAccent">01 / SETUP</span>
                        <span class="font-mono text-xs text-slate-500">Where the aim gets better after hear your voice</span>
                    </div>
                </div>

                <!-- Card 2: Arena -->
                <div class="corner-card p-4 space-y-4">
                    <div class="image-sound-wrapper relative rounded-sm aspect-[16/10]" onclick="playCustomImageAudio('arenaAudio', 'arena', this)">
                        <!-- EDIT YOUR AUDIO FILE HERE 3 -->
                        <audio id="arenaAudio" src="Valorant kill ace sound effect.mp3" preload="auto"></audio>

                        <img src="photo_1_2026-10-15_11-43-16.jpg" 
                             alt="Esports Arena with Purple Lighting" 
                             class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700"
                             onerror="this.src='https://placehold.co/800x500/ffffff/6d28d9?text=Esports+Arena'">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent pointer-events-none"></div>
                        <div class="sound-badge">
                            <i class="fa-solid fa-bullhorn animate-pulse"></i> TAP FOR SOUND
                        </div>
                    </div>
                    <div class="flex justify-between items-center px-2 pb-2">
                        <span class="font-mono text-xs font-semibold tracking-widest text-purpleAccent">02 / ACE</span>
                        <span class="font-mono text-xs text-slate-500">SOUND YANG AWAK JARANG DENGAR</span>
                    </div>
                </div>
            </div>

            <!-- Bottom 4 Stat Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 pt-6">
                <div class="corner-card p-5 space-y-2">
                    <div class="font-mono text-[10px] font-semibold tracking-[0.25em] text-slate-400 uppercase">Clutch Factor</div>
                    <div class="font-serif text-xl font-medium text-navyDark">1v5,clutch sambil ditekan oleh ISSISS</div>
                </div>
                <div class="corner-card p-5 space-y-2">
                    <div class="font-mono text-[10px] font-semibold tracking-[0.25em] text-slate-400 uppercase">Aim</div>
                    <div class="font-serif text-xl font-medium text-navyDark">Sharper than your comebacks</div>
                </div>
                <div class="corner-card p-5 space-y-2">
                    <div class="font-mono text-[10px] font-semibold tracking-[0.25em] text-slate-400 uppercase">Team Morale</div>
                    <div class="font-serif text-xl font-medium text-navyDark">memberi ISSISS kata kata semangat</div>
                </div>
                <div class="corner-card p-5 space-y-2">
                    <div class="font-mono text-[10px] font-semibold tracking-[0.25em] text-slate-400 uppercase">Agent</div>
                    <div class="font-serif text-xl font-medium text-navyDark">Whatever you lock, ISSISS carry</div>
                </div>
            </div>

        </div>
    </section>


    <!-- SIDE TWO — ACOUSTIC -->
    <section id="acoustic" class="min-h-screen py-28 px-6 lg:px-20 border-t border-slate-300/60">
        <div class="max-w-7xl mx-auto space-y-16">
            
            <!-- Section Header -->
            <div class="space-y-4">
                <div class="font-mono text-xs font-semibold tracking-[0.3em] text-goldText uppercase">
                    UKULELE
                </div>
                <h2 class="font-serif text-4xl sm:text-6xl gold-gradient-text">
                YOU &amp; YOUR MUSIC</h2>
                <p class="text-slate-600 text-base sm:text-lg max-w-2xl">
                    SAYA SUKA DENGAR AWAK NYANYI + MAIN UKULELE TU
                </p>
            </div>

            <!-- Main Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- Left Side: Two Image Cards -->
                <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="corner-card p-3 space-y-3">
                        <div class="image-sound-wrapper relative rounded-sm aspect-[4/5]" onclick="playCustomImageAudio('goldenHourAudio', 'golden-hour', this)">
                            <!-- EDIT YOUR AUDIO FILE HERE 4 -->
                            <audio id="goldenHourAudio" src="muka buku.mp3" preload="auto"></audio>

                            <img src="photo_4_2026-10-15_11-43-16.jpg" 
                                 alt="Golden hour ukulele by window" 
                                 class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700"
                                 onerror="this.src='https://placehold.co/600x750/ffffff/b47816?text=Golden+Hour'">
                            <div class="sound-badge">
                                <i class="fa-solid fa-sun animate-pulse"></i> TAP FOR SOUND
                            </div>
                        </div>
                        <div class="font-mono text-xs text-slate-500 px-1 pb-1">
                            03 / KALAU ADA SEMBILAN NYAWA
                        </div>
                    </div>

                    <div class="corner-card p-3 space-y-3 sm:mt-10">
                        <div class="image-sound-wrapper relative rounded-sm aspect-[4/5]" onclick="playCustomImageAudio('sheetMusicAudio', 'sheet-music', this)">
                            <!-- EDIT YOUR AUDIO FILE HERE 5 -->
                            <audio id="sheetMusicAudio" src="kita_berkenalan.m4a" preload="auto"></audio>

                            <img src="photo_5_2026-10-15_11-43-16.jpg" 
                                 alt="Sheet music and fairy lights" 
                                 class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-700"
                                 onerror="this.src='https://placehold.co/600x750/ffffff/b47816?text=Sheet+Music'">
                            <div class="sound-badge">
                                <i class="fa-solid fa-music animate-pulse"></i> TAP FOR SOUND
                            </div>
                        </div>
                        <div class="font-mono text-xs text-slate-500 px-1 pb-1">
                            04 / MUKA BUKU
                        </div>
                    </div>
                </div>

                <!-- Right Side: Chord Player & Description -->
                <div class="lg:col-span-6 space-y-8 lg:pl-6">
                    <div class="space-y-3">
                        <div class="font-mono text-xs font-semibold tracking-[0.3em] text-goldText uppercase">
                            THE FOUR CHORDS
                        </div>
                        
                        <!-- Chord Buttons -->
                        <div class="grid grid-cols-4 gap-4 pt-2">
                            <button onclick="playChord('C')" id="btn-C" class="corner-card py-6 text-center font-serif text-2xl font-bold text-navyDark hover:text-goldText transition-all cursor-pointer active:scale-95">
                                C
                            </button>
                            <button onclick="playChord('Am')" id="btn-Am" class="corner-card py-6 text-center font-serif text-2xl font-bold text-navyDark hover:text-goldText transition-all cursor-pointer active:scale-95">
                                Am
                            </button>
                            <button onclick="playChord('F')" id="btn-F" class="corner-card py-6 text-center font-serif text-2xl font-bold text-navyDark hover:text-goldText transition-all cursor-pointer active:scale-95">
                                F
                            </button>
                            <button onclick="playChord('G')" id="btn-G" class="corner-card py-6 text-center font-serif text-2xl font-bold text-navyDark hover:text-goldText transition-all cursor-pointer active:scale-95">
                                G
                            </button>
                        </div>
                    </div>

                    <div class="space-y-4 pt-2">
                        <button onclick="strumAllFour()" class="corner-pill px-6 py-3 font-mono text-xs font-semibold tracking-[0.2em] text-purpleAccent hover:text-purpleDeep transition-all cursor-pointer flex items-center space-x-2">
                            <i class="fa-solid fa-guitar"></i>
                            <span>STRUM ALL FOUR · TAP TO PLAY</span>
                        </button>
                        
                        <p class="text-slate-700 text-lg leading-relaxed pt-2">
                            Every song you play on that little wooden thing is built out of four shapes. So is every good day with you.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- FINAL ROUND / LETTER -->
    <section id="letter" class="min-h-screen py-28 px-6 lg:px-20 border-t border-slate-300/60 flex items-center">
        <div class="max-w-4xl mx-auto space-y-12 text-center lg:text-left">
            
            <div class="space-y-4 text-center">
                <div class="font-mono text-xs font-semibold tracking-[0.3em] text-purpleAccent uppercase">
                    FINAL ROUND
                </div>
                <h2 class="font-serif text-4xl sm:text-6xl gold-gradient-text">
                    One Last Thing
                </h2>
            </div>

            <div class="corner-card p-8 sm:p-12 space-y-8 bg-white/90 backdrop-blur-md">
                <div class="space-y-6 text-slate-700 text-lg sm:text-xl font-normal leading-relaxed">
                    <p>
                       happy birthday, sayang 🤍 thank you sebab selalu ada dengan baby, even waktu baby susah, waktu baby takde duit, sayang tetap hulurkan tangan dan tak pernah penat bersabar dengan baby. baby mungkin belum mampu nak bagi sayang semua yang sayang layak dapat, tapi baby doa satu hari nanti baby dapat bahagiakan sayang macam mana sayang selalu cuba bahagiakan baby. semoga Allah jaga sayang, permudahkan segala urusan sayang. baby love you so much, sayang. ❤️
.
                    </p>
                    <p>
                        SEMOGA AWAK SELALU ADA WAKTU SUSAH SENANG SAYA.
                    </p>
                    <p class="font-semibold text-goldText">
                        Happy birthday, my love. SEMOGA DIPERMUDAHKAN URUSAN DAN DIMURAHKAN REZEKI.
                    </p>
                </div>

                <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center text-sm">
                    <div class="font-serif italic text-purpleAccent text-xl font-medium">
                        — sorry agak cringe
                    </div>
                    <div class="font-mono text-xs text-slate-500 mt-4 sm:mt-0 tracking-wider">
                        P.S. No, this does not count as your present.
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- FLOATING BOTTOM NAVIGATION -->
    <nav class="fixed bottom-6 left-1/2 transform -translate-x-1/2 z-50">
        <div class="corner-pill px-4 py-2 flex items-center space-x-2 sm:space-x-5">
            <button onclick="scrollToSection('top')" id="nav-top" class="nav-btn font-mono text-xs font-semibold tracking-[0.2em] text-slate-600 hover:text-goldText px-3 py-2 uppercase transition-all">
                TOP
            </button>
            <button onclick="scrollToSection('tactical')" id="nav-tactical" class="nav-btn font-mono text-xs font-semibold tracking-[0.2em] text-slate-600 hover:text-goldText px-3 py-2 uppercase transition-all">
                TACTICAL
            </button>
            <button onclick="scrollToSection('acoustic')" id="nav-acoustic" class="nav-btn font-mono text-xs font-semibold tracking-[0.2em] text-slate-600 hover:text-goldText px-3 py-2 uppercase transition-all">
                ACOUSTIC
            </button>
            <button onclick="scrollToSection('letter')" id="nav-letter" class="nav-btn font-mono text-xs font-semibold tracking-[0.2em] text-slate-600 hover:text-goldText px-3 py-2 uppercase transition-all">
                LETTER
            </button>
            <button onclick="toggleGlobalMute()" id="mute-btn" title="Toggle Sound" class="font-mono text-xs text-slate-600 hover:text-goldText px-2 py-2 transition-all">
                <i class="fa-solid fa-volume-high" id="mute-icon"></i>
            </button>
        </div>
    </nav>


    <script>
        // Web Audio API Synthesizer & Sound FX Engine
        let audioCtx = null;
        let isMuted = false;

        function initAudio() {
            if (!audioCtx) {
                audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            }
            if (audioCtx.state === 'suspended') {
                audioCtx.resume();
            }
        }

        function toggleGlobalMute() {
            isMuted = !isMuted;
            const icon = document.getElementById('mute-icon');
            if (isMuted) {
                icon.className = 'fa-solid fa-volume-xmark text-red-500';
            } else {
                icon.className = 'fa-solid fa-volume-high';
            }
        }

        // --- CUSTOM IMAGE AUDIO PLAYER WITH SYNTH FALLBACK ---
        function playCustomImageAudio(audioElementId, fallbackSynthType, element) {
            if (isMuted) return;
            initAudio();

            // Visual feedback glow
            if (element) {
                element.classList.add('playing');
                setTimeout(() => {
                    element.classList.remove('playing');
                }, 1400);
            }

            const audioElement = document.getElementById(audioElementId);

            if (audioElement && audioElement.getAttribute('src') && audioElement.getAttribute('src') !== 'your-sound1.mp3' && audioElement.getAttribute('src') !== 'your-sound2.mp3' && audioElement.getAttribute('src') !== 'your-sound3.mp3' && audioElement.getAttribute('src') !== 'your-sound4.mp3' && audioElement.getAttribute('src') !== 'your-sound5.mp3') {
                audioElement.currentTime = 0;
                const playPromise = audioElement.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.warn("Custom audio failed to play, playing synthetic sound fallback.", error);
                        playFallbackSynthSound(fallbackSynthType);
                    });
                }
            } else {
                // Play built-in sound synth fallback if custom file path is unchanged
                playFallbackSynthSound(fallbackSynthType);
            }
        }

        function playFallbackSynthSound(type) {
            switch(type) {
                case 'hero-ukulele':
                    playUkuleleArpeggio([261.63, 329.63, 392.00, 523.25, 659.25], 0.06, 1.8);
                    break;

                case 'keyboard':
                    playKeyboardClicks();
                    break;

                case 'arena':
                    playArenaHumAndCheer();
                    break;

                case 'golden-hour':
                    playUkuleleArpeggio([196.00, 246.94, 293.66, 392.00], 0.08, 2.0);
                    break;

                case 'sheet-music':
                    playMusicBoxMelody();
                    break;
            }
        }

        // --- SPECIFIC SOUND SYNTHESIS FUNCTIONS ---

        // 1. Ukulele Strum Effect
        function playUkuleleArpeggio(notes, delayBetween, duration) {
            notes.forEach((freq, idx) => {
                setTimeout(() => {
                    if (!audioCtx) return;
                    const osc = audioCtx.createOscillator();
                    const gain = audioCtx.createGain();

                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(freq, audioCtx.currentTime);

                    gain.gain.setValueAtTime(0.001, audioCtx.currentTime);
                    gain.gain.exponentialRampToValueAtTime(0.18, audioCtx.currentTime + 0.04);
                    gain.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + duration);

                    osc.connect(gain);
                    gain.connect(audioCtx.destination);

                    osc.start();
                    osc.stop(audioCtx.currentTime + duration);
                }, idx * delayBetween * 1000);
            });
        }

        // 2. Mechanical Keyboard Click Effect
        function playKeyboardClicks() {
            const clickCount = 6;
            for (let i = 0; i < clickCount; i++) {
                setTimeout(() => {
                    if (!audioCtx) return;
                    
                    const osc = audioCtx.createOscillator();
                    const gain = audioCtx.createGain();

                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(1800 + Math.random() * 600, audioCtx.currentTime);
                    osc.frequency.exponentialRampToValueAtTime(300, audioCtx.currentTime + 0.03);

                    gain.gain.setValueAtTime(0.15, audioCtx.currentTime);
                    gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.03);

                    osc.connect(gain);
                    gain.connect(audioCtx.destination);

                    osc.start();
                    osc.stop(audioCtx.currentTime + 0.03);

                    const thock = audioCtx.createOscillator();
                    const thockGain = audioCtx.createGain();
                    thock.type = 'triangle';
                    thock.frequency.setValueAtTime(120 + Math.random() * 40, audioCtx.currentTime);
                    
                    thockGain.gain.setValueAtTime(0.12, audioCtx.currentTime);
                    thockGain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.04);

                    thock.connect(thockGain);
                    thockGain.connect(audioCtx.destination);

                    thock.start();
                    thock.stop(audioCtx.currentTime + 0.04);
                }, i * (70 + Math.random() * 50));
            }
        }

        // 3. Gaming Arena Bass Hum & Cheer
        function playArenaHumAndCheer() {
            if (!audioCtx) return;

            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();

            osc.type = 'sawtooth';
            osc.frequency.setValueAtTime(55, audioCtx.currentTime);
            osc.frequency.exponentialRampToValueAtTime(110, audioCtx.currentTime + 0.8);

            const filter = audioCtx.createBiquadFilter();
            filter.type = 'lowpass';
            filter.frequency.setValueAtTime(300, audioCtx.currentTime);

            gain.gain.setValueAtTime(0.001, audioCtx.currentTime);
            gain.gain.linearRampToValueAtTime(0.2, audioCtx.currentTime + 0.4);
            gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 1.8);

            osc.connect(filter);
            filter.connect(gain);
            gain.connect(audioCtx.destination);

            osc.start();
            osc.stop(audioCtx.currentTime + 1.8);
        }

        // 4. Music Box Chime Melody
        function playMusicBoxMelody() {
            const melody = [523.25, 659.25, 783.99, 1046.50, 880.00, 783.99];
            melody.forEach((freq, idx) => {
                setTimeout(() => {
                    if (!audioCtx) return;
                    const osc = audioCtx.createOscillator();
                    const gain = audioCtx.createGain();

                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(freq, audioCtx.currentTime);

                    gain.gain.setValueAtTime(0.001, audioCtx.currentTime);
                    gain.gain.exponentialRampToValueAtTime(0.15, audioCtx.currentTime + 0.02);
                    gain.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + 1.2);

                    osc.connect(gain);
                    gain.connect(audioCtx.destination);

                    osc.start();
                    osc.stop(audioCtx.currentTime + 1.2);
                }, idx * 160);
            });
        }

        // --- CHORD BOARD CONTROLLER ---
        const chordFrequencies = {
            'C': [261.63, 329.63, 392.00, 523.25], 
            'Am': [220.00, 261.63, 329.63, 440.00], 
            'F': [174.61, 220.00, 261.63, 349.23], 
            'G': [196.00, 246.94, 293.66, 392.00]  
        };

        function playChord(chordName) {
            if (isMuted) return;
            initAudio();
            highlightButton(chordName);
            
            const freqs = chordFrequencies[chordName];
            if (!freqs) return;

            freqs.forEach((freq, index) => {
                setTimeout(() => {
                    playTone(freq, 1.2);
                }, index * 40); 
            });
        }

        function playTone(freq, duration) {
            if (!audioCtx) return;
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();

            osc.type = 'triangle';
            osc.frequency.setValueAtTime(freq, audioCtx.currentTime);

            gain.gain.setValueAtTime(0.001, audioCtx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.15, audioCtx.currentTime + 0.08);
            gain.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + duration);

            osc.connect(gain);
            gain.connect(audioCtx.destination);

            osc.start();
            osc.stop(audioCtx.currentTime + duration);
        }

        function highlightButton(chordName) {
            const btn = document.getElementById(`btn-${chordName}`);
            if (btn) {
                btn.classList.add('border-goldText', 'text-goldText', 'bg-amber-500/10');
                setTimeout(() => {
                    btn.classList.remove('border-goldText', 'text-goldText', 'bg-amber-500/10');
                }, 400);
            }
        }

        function strumAllFour() {
            if (isMuted) return;
            initAudio();
            const chords = ['C', 'Am', 'F', 'G'];
            chords.forEach((chord, i) => {
                setTimeout(() => {
                    playChord(chord);
                }, i * 350);
            });
        }

        function scrollToSection(id) {
            const el = document.getElementById(id);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Scroll spy for active navbar highlighting
        window.addEventListener('scroll', () => {
            const sections = ['top', 'tactical', 'acoustic', 'letter'];
            const scrollPos = window.scrollY + 200;

            sections.forEach(secId => {
                const section = document.getElementById(secId);
                const navBtn = document.getElementById(`nav-${secId}`);
                if (section && navBtn) {
                    const top = section.offsetTop;
                    const height = section.offsetHeight;
                    if (scrollPos >= top && scrollPos < top + height) {
                        navBtn.classList.add('text-goldText', 'border-b-2', 'border-goldText');
                    } else {
                        navBtn.classList.remove('text-goldText', 'border-b-2', 'border-goldText');
                    }
                }
            });
        });
    </script>
</body>
</html>