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



            // STANZA CAROUSEL JS
              const slides = document.querySelectorAll("#stanzaCarousel .carousel-slide");
              const dots = document.querySelectorAll(".dot");
              let index = 0;

              // Show slide function
              function showSlide(n) {
                  slides.forEach((slide, i) => {
                      slide.style.display = i === n ? "block" : "none";
                      dots[i].classList.toggle("bg-[#EF7722]", i === n);
                      dots[i].classList.toggle("bg-white", i !== n);
                  });
              }

              // Next button
              document.getElementById("nextBtn").addEventListener("click", () => {
                  index = (index + 1) % slides.length;
                  showSlide(index);
              });

              // Previous button
              document.getElementById("prevBtn").addEventListener("click", () => {
                  index = (index - 1 + slides.length) % slides.length; // wrap around
                  showSlide(index);
              });

              // Dots
              dots.forEach((dot, i) => {
                  dot.addEventListener("click", () => {
                      index = i;
                      showSlide(index);
                  });
              });

              // Initial display
              showSlide(index);

            
      

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


document.addEventListener('DOMContentLoaded', function() {
    // Handle all reply buttons
    document.querySelectorAll('.show-reply-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const form = btn.closest('.reply-form');
            form.querySelector('.reply-author').classList.remove('hidden');
            form.querySelector('.reply-content').classList.remove('hidden');
            form.querySelector('.reply-submit').classList.remove('hidden');
            btn.classList.add('hidden'); // hide the "Reply" toggle button
        });
    });
});
