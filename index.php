<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Laughter — Pablo Neruda</title>
    <link rel="icon" href="./images/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<?php
include 'form.php'; // this defines $posts, $replies_tree, and functions
?>

<!-- ANIMATION STYLE -->
<style>
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .animate-scroll {
        display: flex;
        width: calc(200px * 12 + 3rem * 11);
        /* Adjust to number of items */
        animation: scroll 30s linear infinite;
    }

    /* Pause animation when hovered */
    .animate-scroll:hover {
        animation-play-state: paused;
    }

    /* Hide scrollbar for neat look */
    ::-webkit-scrollbar {
        display: none;
    }

    html {
        scroll-behavior: smooth;
    }
</style>

<body class="bg-gradient-to-b from-orange-50 text-gray-800 min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="bg-gray-900 text-white py-4 px-4 shadow-md sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto flex flex-col">
            <!-- Top Row: Title + Hamburger -->
            <div class="flex justify-between items-center">
                <div class="text-left">
                    <h1 class="text-xl md:text-3xl font-bold tracking-wide text-[#EF7722]">Your Laughter</h1>
                    <p class="text-xs md:text-sm italic mt-1">by Pablo Neruda</p>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="md:hidden focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#EF7722]" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Desktop Nav -->
                <ul class="hidden md:flex md:space-x-14 text-gray-100 text-lg">
                    <li><a href="#home" class="hover:text-[#EF7722] hover:underline underline-offset-4">Home</a></li>
                    <li><a href="#poem" class="hover:text-[#EF7722] hover:underline underline-offset-4">Read Poem</a></li>
                    <li><a href="#summary" class="hover:text-[#EF7722] hover:underline underline-offset-4">Analysis</a></li>
                    <li><a href="#share-thoughts" class="hover:text-[#EF7722] hover:underline underline-offset-4">Share Thoughts</a></li>
                </ul>
            </div>

            <!-- Mobile Nav (below the title) -->
            <ul x-show="open" x-transition
                class="flex flex-col  mt-4 text-sm text-gray-100 md:hidden">
                <li class="text-center">
                    <a href="#home" class="block py-2 hover:text-[#EF7722] hover:underline underline-offset-4" @click="open = false">Home</a>
                </li>
                <li class="text-center">
                    <a href="#poem" class="block py-2 hover:text-[#EF7722] hover:underline underline-offset-4" @click="open = false">Read Poem</a>
                </li>
                <li class="text-center">
                    <a href="#summary" class="block py-2 hover:text-[#EF7722] hover:underline underline-offset-4" @click="open = false">Analysis</a>
                </li>
                <li class="text-center">
                    <a href="#share-thoughts" class="block py-2 hover:text-[#EF7722] hover:underline underline-offset-4" @click="open = false">Share Thoughts</a>
                </li>
            </ul>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section id="home" class="flex items-center justify-center py-16 ">
        <div class="container mx-auto px-6">
            <!-- Default View (Poem Intro) -->
            <div id="poemIntro" class="flex md:flex-row flex-col gap-10 items-center justify-center transition-all duration-500">
                <div>
                    <img
                        src="./images/pic3.jpg"
                        alt="Pablo Neruda"
                        class="w-full md:max-w-xs rounded-lg shadow-lg cursor-pointer transform hover:scale-105 transition duration-300"
                        onclick="showNerudaDetails()">
                </div>

                <div class="max-w-xl flex flex-col">
                    <h2 class="text-3xl md:text-5xl font-bold mb-3 text-[#EF7722]">Your Laughter</h2>
                    <p class="text-lg font-medium mb-6 text-[#0BA6DF] cursor-pointer underline underline-offset-4" onclick="showNerudaDetails()">By Pablo Neruda</p>
                    <blockquote class="bg-orange-100 p-5 rounded-lg text-base md:text-lg italic mb-8 border-l-4 border-[#EF7722]">
                        “Take bread away from me, if you wish, take air away, but do not take from me your laughter.”
                    </blockquote>
                    <div class="flex flex-wrap gap-4">
                        <a href="#poem" class="bg-[#EF7722] text-white px-5 py-2 rounded-lg hover:bg-sky-500 transition font-medium">Read Poem</a>
                        <a href="#share-thoughts" class="border-2 border-[#EF7722] text-[#EF7722] px-5 py-2 rounded-lg hover:text-sky-500 hover:border-sky-500 transition font-medium">Share Thoughts</a>
                    </div>
                </div>
            </div>

            <!-- Hidden View (Pablo Neruda Details) -->
            <div id="nerudaDetails" class="hidden transition-all duration-500 py-12 px-6 flex justify-center items-center bg-orange-50 rounded-lg shadow-lg">
                <div class="flex flex-col md:flex-row gap-10 max-w-6xl items-center">

                    <!-- Image -->
                    <div class="flex-shrink-0">
                        <img src="./images/pic1.jpg" alt="Pablo Neruda" class="w-72 md:w-100 rounded-lg shadow-lg">
                    </div>

                    <!-- Info Content -->
                    <div class="flex flex-col text-left space-y-4">
                        <h2 class="text-2xl md:text-4xl font-bold text-[#EF7722]">Ricardo Eliécer Neftalí Reyes Basoalto</h2>
                        <h3 class="text-lg font-semibold text-gray-700 border-b-2 border-[#EF7722] w-fit pb-1">About</h3>
                        <p class="text-md text-gray-700 leading-relaxed max-w-2xl">
                            Pablo Neruda (1904–1973) was a Chilean poet-diplomat and politician, widely regarded as one of the most influential poets of the 20th century.
                            He received the <span class="font-semibold text-[#EF7722]">Nobel Prize in Literature in 1971</span> for his lyrical and passionate works.
                            His poetry explores themes of <span class="italic">love, nature, politics, and the human condition</span>.
                        </p>

                        <h3 class="text-lg font-semibold text-gray-700 border-b-2 border-[#EF7722] w-fit pb-1 mt-4">Notable Works</h3>
                        <ul class="list-disc list-inside text-gray-700 text-sm space-y-1">
                            <li><em>Twenty Love Poems and a Song of Despair</em> (1924)</li>
                            <li><em>Canto General</em> (1950)</li>
                            <li><em>Residence on Earth</em> (1933–1947)</li>
                            <li><em>Odes to Common Things</em> (1954)</li>
                        </ul>

                        <h3 class="text-lg font-semibold text-gray-700 border-b-2 border-[#EF7722] w-fit pb-1 mt-4">About “Your Laughter”</h3>
                        <p class="text-md text-gray-700 leading-relaxed max-w-2xl">
                            “Your Laughter” is a poem that celebrates love as a sustaining force of life.
                            Neruda portrays laughter as something sacred — a symbol of hope, strength, and emotional light even in moments of darkness.
                        </p>

                        <div class="pt-6">
                            <button onclick="showPoemIntro()"
                                class="bg-[#EF7722] text-white px-6 py-2 rounded-lg hover:bg-sky-500 transition font-medium shadow-md">
                                ← Back
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- POEM SECTION -->
    <section id="poem" class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold  text-[#EF7722]">"Your Laughter"</h2>
            <p>By: Pablo Neruda</p>
            <p
                id="poemText"
                class="mt-4 text-lg italic leading-relaxed text-gray-700 overflow-hidden transition-all duration-700 max-h-[800px] columns-1 md:columns-2 lg:columns-3 gap-8 text-left">
                Take bread away from me, if you wish, <br>
                take air away, but <br>
                do not take from me your laughter.<br><br>

                Do not take away the rose, <br>
                the lance flower that you pluck, <br>
                the water that suddenly <br>
                bursts forth in joy, <br>
                the sudden wave <br>
                of silver born in you.<br><br>

                My struggle is harsh and I come back <br>
                with eyes tired <br>
                at times from having seen <br>
                the unchanging earth, <br>
                but when your laughter enters <br>
                it rises to the sky seeking me <br>
                and it opens for me all <br>
                the doors of life.<br><br>

                My love, in the darkest <br>
                hour your laughter <br>
                opens, and if suddenly <br>
                you see my blood staining <br>
                the stones of the street, <br>
                laugh, because your laughter <br>
                will be for my hands <br>
                like a fresh sword.<br><br>

                Next to the sea in the autumn, <br>
                your laughter must raise <br>
                its foamy cascade, <br>
                and in the spring, love, <br>
                I want your laughter like <br>
                the flower I was waiting for, <br>
                the blue flower, the rose <br>
                of my echoing country.<br><br>


                Laugh at the night, <br>
                at the day, at the moon, <br>
                laugh at the twisted <br>
                streets of the island, <br>
                laugh at this clumsy <br>
                boy who loves you, <br>
                but when I open <br>
                my eyes and close them, <br>
                when my steps go, <br>
                when my steps return, <br>
                deny me bread, air, <br>
                light, spring, <br>
                but never your laughter <br>
                for I would die. <br><br>
            </p>

            <!-- Continue Button -->
            <button
                id="toggleButton"
                class="mt-6 bg-[#EF7722] text-white font-semibold py-2 px-6 rounded-full hover:bg-[#e06611] transition md:hidden">
                Continue Reading
            </button>
        </div>

    </section>


    <!-- SUMMARY SECTION -->
    <section id="summary" class="py-16 bg-[#0BA6DF] grid grid-cols-2 gap-2">
        <div class="col-span-2 md:col-span-1   px-6 text-center">
            <h2 class="text-4xl font-bold mb-6 text-white">Summary of The Poem</h2>
            <p class="text-lg text-white leading-relaxed p-4 bg-white/10 rounded-lg shadow-md">
                Pablo Neruda’s <em>“Your Laughter”</em> is a heartfelt ode to love and hope.
                The speaker values his beloved’s laughter above all worldly things, calling it
                the essence of his survival and joy. Her laughter symbolizes light, life, and renewal,
                turning even suffering into beauty. The poem blends tenderness with strength—showing
                how love and joy can heal pain and inspire resilience.
            </p>
        </div>
        <div class="col-span-2 md:col-span-1   px-6 text-center">
            <h2 class="text-4xl font-bold mb-6 text-white">Structure of the Poem</h2>
            <p class="text-lg text-white leading-relaxed p-4 bg-white/10 rounded-lg shadow-md">
                Is written in <em>"free verse"</em>, meaning it has no fixed rhyme or meter.
                This structure gives the poem a natural, flowing rhythm that mirrors the spontaneity
                of laughter and emotion. The lines vary in length, emphasizing key images and ideas.
                The tone shifts between <em>"intimate devotion"</em> and <em>spiritual admiration</em>, creating
                a balance between passion and tenderness.
            </p>
        </div>
    </section>

    <!-- LITERARY DEVICES SECTION -->
    <section id="literary-devices" class="py-16 bg-white overflow-hidden relative">
        <div class="w-full mx-auto px-6">
            <h2 class="text-3xl font-bold mb-8 text-center text-[#0BA6DF]">Literary Devices</h2>

            <!-- Moving Container -->
            <div class="overflow-hidden relative">
                <div class="flex space-x-6 animate-scroll">

                    <!-- Repeated set for seamless loop -->
                    <div class="flex space-x-6 p-2">
                        <!-- Metaphor -->
                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/metaphor.png" alt="Metaphor" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Metaphor</h3>
                        </div>

                        <!-- Imagery -->
                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/imagery.png" alt="Imagery" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Imagery</h3>
                        </div>

                        <!-- Repetition -->
                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/repetition.png" alt="Repetition" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Repetition</h3>
                        </div>

                        <!-- Symbolism -->
                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/symbolism.png" alt="Symbolism" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Symbolism</h3>
                        </div>

                        <!-- Tone -->
                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/tones.png" alt="Tone" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Tone</h3>
                        </div>

                        <!-- Personification -->
                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/personification.png" alt="Personification" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Personification</h3>
                        </div>
                    </div>

                    <!-- Duplicate set for smooth infinite effect -->
                    <div class="flex space-x-6 p-2">
                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/metaphor.png" alt="Metaphor" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Metaphor</h3>
                        </div>

                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/imagery.png" alt="Imagery" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Imagery</h3>
                        </div>

                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg ">
                            <img src="./images/repetition.png" alt="Repetition" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Repetition</h3>
                        </div>

                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/symbolism.png" alt="Symbolism" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Symbolism</h3>
                        </div>

                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/tones.png" alt="Tone" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Tone</h3>
                        </div>

                        <div class="min-w-[200px] bg-[#FFF8F0] p-6 rounded-2xl shadow text-center flex-shrink-0 hover:scale-105 transform transition duration-300 shadow-lg">
                            <img src="./images/personification.png" alt="Personification" class="w-10 h-10 mx-auto mb-4">
                            <h3 class="text-xl font-semibold text-[#EF7722]">Personification</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EXPLANATION PER STANZA (WITH LINES) - CAROUSEL -->
    <section id="explanation" class="py-16 bg-gray-800">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center">
            <h2 class="text-2xl md:text-4xl font-bold mb-8 text-[#EF7722]">Explanation Per Stanza</h2>

            <div class="relative overflow-hidden rounded-2xl shadow-lg bg-[#FFF8F0]" id="stanzaCarousel">
                <!-- Carousel Slides -->
                <div class="carousel-slide p-4 sm:p-6" style="display:block;">
                    <h3 class="text-xl font-semibold mb-3 text-[#EF7722]">Stanza 1</h3>
                    <blockquote class="italic text-gray-800 border-l-4 border-[#EF7722] pl-3 mb-3 text-center font-semibold bg-orange-300 p-3 sm:p-4 rounded-lg text-sm sm:text-base">
                        "Take bread away from me, if you wish, <br>
                        take air away, but <br>
                        do not take from me your laughter."
                    </blockquote>
                    <p class="text-gray-700 text-left text-sm sm:text-base leading-relaxed">
                        The speaker expresses that his lover’s laughter is more vital than food or air.
                        This exaggeration (hyperbole) shows <b>his emotional dependence</b> and how her joy
                        sustains his very life more than any physical need.
                    </p>
                </div>

                <div class="carousel-slide p-4 sm:p-6 hidden">
                    <h3 class="text-xl font-semibold mb-3 text-[#EF7722]">Stanza 2</h3>
                    <blockquote class="italic text-gray-800 border-l-4 border-[#EF7722] pl-3 mb-3 text-center font-semibold bg-orange-300 p-3 sm:p-4 rounded-lg text-sm sm:text-base">
                        "Do not take away the rose, <br>
                        the lance flower that you pluck, <br>
                        the water that suddenly bursts forth in joy..."
                    </blockquote>
                    <p class="text-gray-700 text-left text-sm sm:text-base leading-relaxed">
                        Her laughter is compared to natural imagery like flowers and water — symbols of
                        <b>life, freshness, and beauty</b>. Neruda portrays laughter as something natural and life-giving.
                    </p>
                </div>

                <div class="carousel-slide p-4 sm:p-6 hidden">
                    <h3 class="text-xl font-semibold mb-3 text-[#EF7722]">Stanza 3</h3>
                    <blockquote class="italic text-gray-800 border-l-4 border-[#EF7722] pl-3 mb-3 text-center font-semibold bg-orange-300 p-3 sm:p-4 rounded-lg text-sm sm:text-base">
                        "My struggle is harsh and I come back <br>
                        with eyes tired... <br>
                        but when your laughter enters <br>
                        it rises to the sky seeking me <br>
                        and it opens for me all the doors of life."
                    </blockquote>
                    <p class="text-gray-700 text-left text-sm sm:text-base leading-relaxed">
                        The poet admits to life’s hardships and exhaustion. Yet, his lover’s laughter
                        <b>revives his spirit</b>, lifting him emotionally and spiritually — a symbol of <b>hope and renewal</b>.
                    </p>
                </div>

                <div class="carousel-slide p-4 sm:p-6 hidden">
                    <h3 class="text-xl font-semibold mb-3 text-[#EF7722]">Stanza 4</h3>
                    <blockquote class="italic text-gray-800 border-l-4 border-[#EF7722] pl-3 mb-3 text-center font-semibold bg-orange-300 p-3 sm:p-4 rounded-lg text-sm sm:text-base">
                        "If suddenly you see my blood staining the stones of the street, <br>
                        laugh, because your laughter will be for my hands like a fresh sword."
                    </blockquote>
                    <p class="text-gray-700 text-left text-sm sm:text-base leading-relaxed">
                        Even in danger or death, he tells her to keep laughing. Her laughter becomes a <b>weapon of courage</b>,
                        turning his pain into strength. The “fresh sword” symbolizes <b>resilience</b>.
                    </p>
                </div>

                <div class="carousel-slide p-4 sm:p-6 hidden">
                    <h3 class="text-xl font-semibold mb-3 text-[#EF7722]">Stanza 5</h3>
                    <blockquote class="italic text-gray-800 border-l-4 border-[#EF7722] pl-3 mb-3 text-center font-semibold bg-orange-300 p-3 sm:p-4 rounded-lg text-sm sm:text-base">
                        "Next to the sea in the autumn, <br>
                        your laughter must raise its foamy cascade, <br>
                        and in the spring, love, I want your laughter like the flower I was waiting for..."
                    </blockquote>
                    <p class="text-gray-700 text-left text-sm sm:text-base leading-relaxed">
                        Neruda connects laughter with <b>changing seasons and nature’s cycles</b>,
                        showing that her joy brings color to his world all year long — a symbol of <b>continuity and renewal</b>.
                    </p>
                </div>

                <div class="carousel-slide p-4 sm:p-6 hidden">
                    <h3 class="text-xl font-semibold mb-3 text-[#EF7722]">Stanza 6</h3>
                    <blockquote class="italic text-gray-800 border-l-4 border-[#EF7722] pl-3 mb-3 text-center font-semibold bg-orange-300 p-3 sm:p-4 rounded-lg text-sm sm:text-base">
                        "Laugh at the night, at the day, at the moon... <br>
                        deny me bread, air, light, spring, <br>
                        but never your laughter for I would die."
                    </blockquote>
                    <p class="text-gray-700 text-left text-sm sm:text-base leading-relaxed">
                        The final stanza repeats the poem’s central plea — her laughter is <b>his lifeline</b>.
                        Neruda ends with deep emotional intensity, merging themes of <b>love, dependence, and joy</b>.
                    </p>
                </div>
                <!-- Previous button -->
                <button id="prevBtn"
                    class="absolute left-1 sm:left-3 top-2 text-xl text-[#EF7722] px-2 sm:px-3 py-1.5 sm:py-2 rounded-lg">
                    ❮
                </button>

                <!-- Next button -->
                <button id="nextBtn"
                    class="absolute right-1 sm:right-3 top-2 text-xl text-[#EF7722] px-2 sm:px-3 py-1.5 sm:py-2 rounded-lg">
                    ❯
                </button>




            </div>

            <!-- Carousel Dots -->
            <div class="flex justify-center mt-6 space-x-2">
                <button class="dot w-2 h-2 sm:w-3 sm:h-3 bg-[#EF7722] rounded-full"></button>
                <button class="dot w-2 h-2 sm:w-3 sm:h-3 bg-white rounded-full"></button>
                <button class="dot w-2 h-2 sm:w-3 sm:h-3 bg-white rounded-full"></button>
                <button class="dot w-2 h-2 sm:w-3 sm:h-3 bg-white rounded-full"></button>
                <button class="dot w-2 h-2 sm:w-3 sm:h-3 bg-white rounded-full"></button>
                <button class="dot w-2 h-2 sm:w-3 sm:h-3 bg-white rounded-full"></button>
            </div>
        </div>

    </section>

    <!-- READER THOUGHTS SECTION -->
    <section id="share-thoughts" class="py-14 px-6 bg-gradient-to-b from-sky-50 to-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 items-center">

            <!-- Left: Thoughts -->
            <div class="md:col-span-2 px-4">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-sky-700 mb-2">Share Your Thoughts!</h2>
                    <p class="text-gray-600">Share your reflections about <span class="font-semibold italic">"Your Laughter"</span> by Pablo Neruda. We’d love to hear your thoughts!</p>
                </div>

                <div id="thoughtsList" class="bg-sky-100 space-y-2 mb-6 max-h-96 overflow-y-auto p-4">
                    <?php foreach ($posts as $post): ?>
                        <div class="mb-4 py-4 px-6 bg-white rounded-lg">
                            <p class="italic text-gray-800 break-words leading-relaxed">"<?= htmlspecialchars($post['content']) ?>"</p>
                            <p class="text-xs text-gray-500 my-2">— posted on <?= date("m/d/Y H:i", strtotime($post['created_at'])) ?> by <?= htmlspecialchars($post['author']) ?></p>

                            <div class="flex items-center gap-4">
                                <!-- Like post -->
                                <form method="POST" action="form.php">
                                    <input type="hidden" name="like_post_id" value="<?= $post['id'] ?>">
                                    <button type="submit" class="flex items-center text-red-600 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="#e90e0eff" viewBox="0 0 24 24" stroke-width="1.5" stroke="#e90e0eff" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.015-4.5-4.5-4.5-1.74 0-3.285.992-4.05 2.457C11.285 4.742 9.74 3.75 8 3.75 5.515 3.75 3.5 5.765 3.5 8.25c0 7.22 8.5 12 8.5 12s8.5-4.78 8.5-12z" />
                                        </svg>
                                        <span><?= $post['likes'] ?: 0 ?></span>
                                    </button>
                                </form>

                                <!-- Reply form for main post -->
                                <form method="POST" class="mt-1 reply-form" action="form.php">
                                    <input type="hidden" name="reply_post_id" value="<?= $post['id'] ?>">
                                    <input type="text" name="reply_author" placeholder="Your Name (optional)" class="reply-author hidden w-full border border-sky-200 rounded-sm p-1 mb-1 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
                                    <textarea name="reply_content" placeholder="Write a reply..." class="reply-content hidden w-full border border-sky-200 rounded-sm p-1 mb-1 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none resize-none" rows="1"></textarea>
                                    <button type="button" class="show-reply-btn text-sky-500 hover:text-sky-600 px-2 py-1 rounded-sm transition text-sm">Reply</button>
                                    <button type="submit" class="reply-submit hidden text-sky-500 hover:text-sky-600 px-2 py-1 rounded-sm transition text-sm">Reply</button>
                                </form>
                            </div>

                            <!-- Display nested replies -->
                            <div class="mt-2">
                                <?php display_replies($post['id'], 0, $replies_tree); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>



                <form method="POST" action="form.php">
                    <input type="text" name="author" placeholder="Your Name (optional)"
                        class="w-full border border-sky-200 rounded-lg p-3 mb-4 text-gray-700 focus:ring-2 focus:ring-sky-400 focus:outline-none">

                    <textarea name="content" placeholder="Write your thoughts about the poem..."
                        class="w-full border border-sky-200 rounded-lg p-3 mb-4 text-gray-700 focus:ring-2 focus:ring-sky-400 focus:outline-none resize-none"></textarea>

                    <button type="submit"
                        class="bg-sky-600 text-white px-6 py-2 rounded-lg hover:bg-sky-700 transition font-semibold">Share</button>
                </form>


            </div>

            <!-- Right: Image -->
            <div class="md:col-span-1">
                <img src="./images/pic4.jpg" alt="Pablo Neruda"
                    class="w-full h-96 md:h-full object-cover rounded-2xl shadow-xl border-4 border-sky-100">
            </div>
        </div>
    </section>


    <section class="w-full flex md:flex-row flex-col gap-4 items-center justify-center py-10 bg-white gap-4">
        <h1 class="font-bold text-xl">Line of the Day : </h1>
        <blockquote id="quoteBox"
            class="text-lg border-l-4 bg-orange-200 p-4 rounded border-orange-500 pl-4 italic text-center max-w-2xl">
            Loading quote...
        </blockquote>
    </section>


    <!-- FOOTER -->
    <footer class="mt-auto bg-[#0BA6DF] text-white py-10 shadow-inner">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10 text-center md:text-left">

            <!-- About / Inspiration -->
            <div>
                <h3 class="font-bold text-lg mb-2">About</h3>
                <p class="text-sm md:text-base">
                    Your Laughter Blog celebrates the timeless poetry of Pablo Neruda, bringing joy and reflection through words.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-bold text-lg mb-2">Quick Links</h3>
                <ul class="text-sm md:text-base space-y-1">
                    <li><a href="#home" class="hover:underline hover:text-gray-800 underline-offset-4">Home</a></li>
                    <li><a href="#poem" class="hover:underline hover:text-gray-800 underline-offset-4">Read Poem</a></li>
                    <li><a href="#summary" class="hover:underline hover:text-gray-800 underline-offset-4">Analysis</a></li>
                    <li><a href="#share-thoughts" class="hover:underline hover:text-gray-800 underline-offset-4">Share Thoughts</a></li>
                </ul>
            </div>

            <!-- Developer / Social -->
            <div>
                <h3 class="font-bold text-lg mb-2">Connect with Me</h3>
                <p class="text-sm md:text-base">
                    Developed by <span class="underline font-semibold text-gray-800 underline-offset-4">Jervy Jake O. Morales</span>
                </p>
                <div class="flex justify-center md:justify-start mt-2 space-x-4">
                    <a href="https://github.com/GeykScript" target="_blank" class="hover:cursor-pointer">
                        <img src="./socials/github.png" alt="GitHub" class="w-6 h-6 hover:transform hover:scale-110 transition">
                    </a>
                    <a href="https://www.facebook.com/jervy.jake.morales" target="_blank" class="hover:cursor-pointer">
                        <img src="./socials/facebook.png" alt="Facebook" class="w-6 h-6 hover:transform hover:scale-110 transition">
                    </a>

                    <a href="mailto:jjom2022-6574-75688@bicol-u.edu.ph" class="hover:cursor-pointer">
                        <img src="./socials/email.png" alt="Email" class="w-6 h-6 hover:transform hover:scale-110 transition">
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright -->
        <div class="mt-6 border-t border-white/30 pt-4 text-center text-sm md:text-base">
            <p>© 2025 <span class="font-semibold">Your Laughter Blog</span> — Inspired by Pablo Neruda</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="main.js"></script>
</body>


</html>