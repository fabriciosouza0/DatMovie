const onload = () => {
  $("#load").remove();
  $("body").css("overflow", "auto");

  const page = document.title.slice(0, 6);

  switch (page) {
    case "Filmes":
      $("#filmes").addClass("active");
      break;
    case "Séries":
      $("#series").addClass("active");
      break;
    case "Animes":
      $("#animes").addClass("active");
      break;
    case "Home":
      $("#home").addClass("active");
      break;
  }
};

const targets = document.querySelectorAll(".lazy");

const lazy = (target) => {
  const io = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        const src = img.getAttribute("data-lazy");

        img.setAttribute("src", src);
        img.classList.add("fade-in");

        observer.disconnect();
      }
    });
  });

  io.observe(target);
};

targets.forEach(lazy);
