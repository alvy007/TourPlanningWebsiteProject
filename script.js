document.addEventListener("DOMContentLoaded", function () {
    const packageBtns = document.querySelectorAll(".package-btn");
    const packageCards = document.querySelectorAll(".package-card");
    const prevArrow = document.getElementById("prevArrow");
    const nextArrow = document.getElementById("nextArrow");
    const cardSlider = document.getElementById("cardSlider");
    let activeIndex = 1;
  
    // Handle Package Type Selection
    packageBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        packageBtns.forEach((b) => b.classList.remove("active"));
        btn.classList.add("active");
  
        const selectedCategory = btn.getAttribute("data-category");
  
        packageCards.forEach((card) => {
          if (card.getAttribute("data-category") === selectedCategory) {
            card.style.display = "flex";
          } else {
            card.style.display = "none";
          }
        });
  
        // Reset Active Index
        activeIndex = 1;
        updateActiveCard();
      });
    });
  
    // Handle Arrow Clicks
    prevArrow.addEventListener("click", () => {
      activeIndex = (activeIndex - 1 + packageCards.length) % packageCards.length;
      updateActiveCard();
    });
  
    nextArrow.addEventListener("click", () => {
      activeIndex = (activeIndex + 1) % packageCards.length;
      updateActiveCard();
    });
  
    function updateActiveCard() {
      packageCards.forEach((card, index) => {
        card.classList.remove("active");
        if (index === activeIndex) {
          card.classList.add("active");
        }
      });
  
      // Adjust Slider Position
      cardSlider.scrollTo({
        left: activeIndex * cardSlider.clientWidth,
        behavior: "smooth",
      });
    }
    function slideLeft() {
        currentIndex = (currentIndex - 1 + cards.length) % cards.length; // Circular index
        updateCards();
      }
  
      function slideRight() {
        currentIndex = (currentIndex + 1) % cards.length; // Circular index
        updateCards();
      }
    // Initialize First View
    updateActiveCard();
    // Add event listeners to your arrows
    document.getElementById("left-arrow").addEventListener("click", slideLeft);
    document.getElementById("right-arrow").addEventListener("click", slideRight);
    let autoSlide = setInterval(slideRight, 3000); // Slide every 3 seconds

// Pause on hover
cardSlider.addEventListener("mouseover", () => clearInterval(autoSlide));
cardSlider.addEventListener("mouseout", () => (autoSlide = setInterval(slideRight, 3000)));

  });
  