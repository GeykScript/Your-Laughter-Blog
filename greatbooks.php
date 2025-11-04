<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Laughter — Pablo Neruda</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800 min-h-screen flex flex-col">
  <!-- HEADER -->
  <header class="bg-[#FAA533] text-gray-800 py-6 flex justify-evenly  px-4 shadow-md">
    <div class="text-center">
      <h1 class="text-4xl font-bold">Your Laughter</h1>
      <p class="mt-2 italic">by Pablo Neruda</p>
    </div>
    <ul class="flex md:text-lg text-xs space-x-4  md:space-x-6 mt-8">
      <li><a href="#thoughtsList" class="text-gray-900  hover:text-white hover:underline underline-offset-4">Home</a></li>
      <li><a href="#thoughtsList" class="text-gray-900  hover:text-white hover:underline underline-offset-4">Read Poem</a></li>
      <li><a href="#thoughtsList" class="text-gray-900  hover:text-white hover:underline underline-offset-4">Analysis</a></li>
      <li><a href="#thoughtsList" class="text-gray-900  hover:text-white hover:underline underline-offset-4">Share your Thoughts</a></li>
    </ul>
  </header>
  <section id="home" class="bg-white py-12">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="flex gap-6">
          <img src="/GreatBooks/pic5.jpg" alt="Poem Cover" class="w-64 md:w-64 rounded-lg shadow-xl mb-6">
          <div class="flex flex-col justify-center">
            <h2 class="text-2xl md:text-4xl font-bold mb-2 accent-orange">Your Laughter</h2>
            <p class="text-lg mb-6 accent-yellow">By Pablo Neruda</p>
            <blockquote class="bg-orange-100 p-4 rounded-r-lg text-base md:text-lg italic mb-6 border-l-4 border-[#EF7722] pl-4">
              “Take bread away from me, if you wish, take air away, but do not take from me your laughter.”
            </blockquote>
            <div class="flex flex-col sm:flex-row gap-4 text-md">
              <a href="#poem" class="bg-[#EF7722] text-white px-4 py-2 rounded-lg hover:bg-sky-500  transition font-medium text-center">Read Poem</a>
              <a href="#thoughts" class="bg-white text-[#EF7722] border-2 border-[#EF7722] px-4 py-2 rounded-lg hover:text-sky-500 hover:border-sky-500 transition font-medium text-center">Share Your Thoughts</a>
            </div>
          </div>
        </div>
        <div class="flex justify-center">
          <div class="w-full max-w-sm">
            <img src="/GreatBooks/pic3.jpg" alt="Pablo Neruda" class="w-full rounded-lg shadow-xl">
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- READER THOUGHTS SECTION -->
  <section class="py-10 px-4">
    <div class="max-w-3xl mx-auto">
      <h2 class="text-2xl font-semibold mb-6 text-center text-orange-700">Share Your Thoughts</h2>

      <div class="bg-white p-6 rounded-2xl shadow-md mb-6">
        <textarea id="thoughtInput" placeholder="Write your thoughts about the poem..."
          class="w-full border border-gray-300 rounded-lg p-3 mb-4 focus:ring-2 focus:ring-orange-400 focus:outline-none"></textarea>
        <button id="addThoughtBtn"
          class="bg-orange-600 text-white px-6 py-2 rounded-lg hover:bg-orange-700 transition font-semibold">Post</button>
      </div>

      <div id="thoughtsList" class="space-y-4">
        <!-- Thoughts will appear here -->
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="mt-auto bg-orange-600 text-white py-4 text-center">
    <p>© 2025 Your Laughter Blog — Inspired by Pablo Neruda</p>
  </footer>

  <!-- JAVASCRIPT (JSON-based storage) -->
  <script>
    const thoughtInput = document.getElementById('thoughtInput');
    const addThoughtBtn = document.getElementById('addThoughtBtn');
    const thoughtsList = document.getElementById('thoughtsList');

    let thoughts = JSON.parse(localStorage.getItem('thoughtsData')) || [];

    function renderThoughts() {
      thoughtsList.innerHTML = '';
      thoughts.forEach((t, i) => {
        const div = document.createElement('div');
        div.className = 'p-4 bg-orange-100 rounded-lg shadow';
        div.innerHTML = `
          <p class="italic text-gray-700">"${t.text}"</p>
          <p class="text-sm text-gray-500 mt-2">— posted on ${t.date}</p>
          <button onclick="deleteThought(${i})" class="text-xs text-red-600 mt-2 hover:underline">Delete</button>
        `;
        thoughtsList.appendChild(div);
      });
    }

    addThoughtBtn.addEventListener('click', () => {
      const text = thoughtInput.value.trim();
      if (text === '') return alert('Please write something first!');
      const newThought = {
        text,
        date: new Date().toLocaleString()
      };
      thoughts.push(newThought);
      localStorage.setItem('thoughtsData', JSON.stringify(thoughts));
      thoughtInput.value = '';
      renderThoughts();
    });

    function deleteThought(index) {
      thoughts.splice(index, 1);
      localStorage.setItem('thoughtsData', JSON.stringify(thoughts));
      renderThoughts();
    }

    // Initial render
    renderThoughts();
  </script>
</body>

</html>