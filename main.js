        // NERUDA DETAILS TOGGLE JS
        function showNerudaDetails() {
            document.getElementById('poemIntro').classList.add('hidden');
            document.getElementById('nerudaDetails').classList.remove('hidden');
        }

        function showPoemIntro() {
            document.getElementById('nerudaDetails').classList.add('hidden');
            document.getElementById('poemIntro').classList.remove('hidden');
        }
        
        // POEM TEXT TOGGLE JS
            const poemText = document.getElementById('poemText');
            const toggleButton = document.getElementById('toggleButton');
            let expanded = false;

            toggleButton.addEventListener('click', () => {
                expanded = !expanded;
                poemText.classList.toggle('max-h-[800px]');
                toggleButton.textContent = expanded ? 'Show Less' : 'Continue Reading';
            });


            const slides = document.querySelectorAll("#stanzaCarousel .carousel-slide");
            const dots = document.querySelectorAll(".dot");
            let index = 0;

                function showSlide(n) {
                    slides.forEach((slide, i) => {
                        slide.style.display = i === n ? "block" : "none";
                        dots[i].classList.toggle("bg-[#EF7722]", i === n);
                        dots[i].classList.toggle("bg-white", i !== n);
                    });
                }

            document.getElementById("nextBtn").addEventListener("click", () => {
                index = (index + 1) % slides.length;
                showSlide(index);
            });


            dots.forEach((dot, i) => {
                dot.addEventListener("click", () => {
                    index = i;
                    showSlide(index);
                });
            });

            showSlide(index);

            
        
// THOUGHTS SECTION JS
const thoughtInput = document.getElementById('thoughtInput');
const addThoughtBtn = document.getElementById('addThoughtBtn');
const thoughtsList = document.getElementById('thoughtsList');

let thoughts = JSON.parse(localStorage.getItem('thoughtsData')) || [];

function renderThoughts() {
  thoughtsList.innerHTML = '';
  thoughts.forEach((t, i) => {
    const div = document.createElement('div');
    div.className = 'p-4 bg-sky-100 rounded-xl shadow-sm border border-sky-200';

    // Render replies
    let repliesHTML = '';
    if (t.replies && t.replies.length > 0) {
      repliesHTML = `
        <div class="mt-3 pl-4 border-l-2 border-sky-300 space-y-2">
          ${t.replies.map(r => `
            <div class="bg-white p-2 rounded-lg shadow-sm border border-sky-100">
              <p class="text-sm text-gray-700 italic">"${r.text}"</p>
              <p class="text-xs text-gray-500 text-right">— ${r.date}</p>
            </div>
          `).join('')}
        </div>
      `;
    }

    div.innerHTML = `
      <p class="italic text-gray-800 break-words leading-relaxed">"${t.text}"</p>
      <p class="text-xs text-gray-500 mt-2">— posted on ${t.date}</p>

      <div class="flex items-center mt-3 space-x-4">
        <!-- Like -->
        <button onclick="toggleLike(${i})" class="focus:outline-none hover:scale-110 transition">
          <svg xmlns="http://www.w3.org/2000/svg" fill="${t.liked ? '#e90e0eff' : 'none'}" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="#e90e0eff" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 8.25c0-2.485-2.015-4.5-4.5-4.5-1.74 0-3.285.992-4.05 2.457C11.285 4.742 9.74 3.75 8 3.75 5.515 3.75 3.5 5.765 3.5 8.25c0 7.22 8.5 12 8.5 12s8.5-4.78 8.5-12z" />
          </svg>
        </button>
        <span class="text-sm text-gray-700">${t.likes || 0} Likes</span>

        <!-- Reply -->
        <button onclick="showReplyBox(${i})" class="text-sm text-sky-700 hover:underline font-medium">Reply</button>
      </div>

      <!-- Reply input box -->
      <div id="replyBox-${i}" class="hidden mt-3">
        <textarea id="replyInput-${i}" placeholder="Write a reply..."
          class="w-full border border-sky-200 rounded-lg p-2 mb-2 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none"></textarea>
        <button onclick="addReply(${i})"
          class="bg-sky-600 text-white text-sm px-4 py-1 rounded-lg hover:bg-sky-700 transition">Post Reply</button>
      </div>

      ${repliesHTML}
    `;

    thoughtsList.appendChild(div);
  });
}

addThoughtBtn.addEventListener('click', () => {
  const text = thoughtInput.value.trim();
  if (text === '') return alert('Please write something first!');
  const newThought = {
    text,
    date: new Date().toLocaleString(),
    likes: 0,
    liked: false,
    replies: []
  };
  thoughts.push(newThought);
  localStorage.setItem('thoughtsData', JSON.stringify(thoughts));
  thoughtInput.value = '';
  renderThoughts();
});

function toggleLike(index) {
  thoughts[index].liked = !thoughts[index].liked;
  thoughts[index].likes += thoughts[index].liked ? 1 : -1;
  localStorage.setItem('thoughtsData', JSON.stringify(thoughts));
  renderThoughts();
}

function showReplyBox(index) {
  const box = document.getElementById(`replyBox-${index}`);
  box.classList.toggle('hidden');
}

function addReply(index) {
  const replyInput = document.getElementById(`replyInput-${index}`);
  const text = replyInput.value.trim();
  if (text === '') return alert('Please write a reply!');
  const reply = {
    text,
    date: new Date().toLocaleString()
  };
  thoughts[index].replies.push(reply);
  localStorage.setItem('thoughtsData', JSON.stringify(thoughts));
  replyInput.value = '';
  renderThoughts();
}

// Initial render
renderThoughts();


const quotes = [
  "Take bread away from me, if you wish, take air away, but do not take from me your laughter. — Pablo Neruda",
  "Do not take away the rose, the lance flower that you pluck, the water that suddenly bursts forth in joy. — Pablo Neruda",
  "The sudden wave of silver born in you. — Pablo Neruda",
  "My struggle is harsh and I come back with eyes tired at times from having seen the unchanging earth. — Pablo Neruda",
  "But when your laughter enters it rises to the sky seeking me and it opens for me all the doors of life. — Pablo Neruda",
  "My love, in the darkest hour your laughter opens, and if suddenly you see my blood staining the stones of the street, laugh. — Pablo Neruda",
  "Because your laughter will be for my hands like a fresh sword. — Pablo Neruda",
  "Next to the sea in the autumn, your laughter must raise its foamy cascade. — Pablo Neruda",
  "And in the spring, love, I want your laughter like the flower I was waiting for, the heart of the light, the silver bell. — Pablo Neruda",
  "Laugh at the night, at the day, at the moon, laugh at the twisted streets of the island. — Pablo Neruda",
  "Laugh at this clumsy boy who loves you. — Pablo Neruda",
  "But when I open my eyes and close them, when my steps go, when my steps return, deny me bread, air, light, spring, but never your laughter for I would die. — Pablo Neruda",
  "I want your laughter like the flower I was waiting for, the blue flower, the rose of my echoing country. — Pablo Neruda",
  "Your laughter opens for me all the doors of life. — Pablo Neruda",
  "In the darkest hour, your laughter will be for my hands like a fresh sword. — Pablo Neruda"
];


function showRandomQuote() {
  const quoteBox = document.getElementById('quoteBox');
  const randomIndex = Math.floor(Math.random() * quotes.length);
  quoteBox.textContent = quotes[randomIndex];
}

// Show a random quote on page load
showRandomQuote();
