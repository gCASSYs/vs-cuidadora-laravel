
// Alteração da Gabriele: ajuste do carrossel para ficar mais suave e premium, sem alterar a estrutura dos cards
if ($('.ava-cards').length) {
  $('.ava-cards').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3500,
    speed: 700,
    infinite: true,
    pauseOnHover: true,
    pauseOnFocus: true,
    arrows: true,
    dots: false,
    adaptiveHeight: true,

    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 700,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true
        }
      }
    ]
  });
}

// Alteração da Gabriele: inicialização do WOW protegida para evitar erro caso a biblioteca não carregue
if (typeof WOW !== "undefined") {
  new WOW({
    boxClass: "wow",
    animateClass: "animate__animated",
    offset: 80,
    mobile: true,
    live: true
  }).init();
}

// Alteração da Gabriele: proteção do menu mobile para não quebrar em páginas que não tenham os botões
const botaoAbrirMenu = document.querySelector(".abrir-menu");
const botaoFecharMenu = document.querySelector(".fechar-menu");

if (botaoAbrirMenu) {
  botaoAbrirMenu.onclick = function () {
    document.documentElement.classList.add("menu-mobile");
  };
}

if (botaoFecharMenu) {
  botaoFecharMenu.onclick = function () {
    document.documentElement.classList.remove("menu-mobile");
  };
}

// Alteração da Gabriele: fecha o menu mobile ao clicar em um link, melhorando a navegação no celular
const linksMenu = document.querySelectorAll(".menu a");

linksMenu.forEach(function (link) {
  link.addEventListener("click", function () {
    document.documentElement.classList.remove("menu-mobile");
  });
});

// Alteração da Gabriele: ajuste do topo fixo com proteção para evitar erro caso o header não exista
const topoFixo = document.getElementById("topo-fixo");

if (topoFixo) {
  window.addEventListener("scroll", function () {
    const top = window.scrollY;

    if (top >= 800) {
      topoFixo.classList.remove("saindo");
      topoFixo.classList.add("menu-fixo");
    } else {
      if (topoFixo.classList.contains("menu-fixo") && !topoFixo.classList.contains("saindo")) {
        topoFixo.classList.add("saindo");

        topoFixo.addEventListener("animationend", function onMenuFixoOut(e) {
          if (e.animationName === "menuFixoOut") {
            topoFixo.classList.remove("menu-fixo", "saindo");
            topoFixo.removeEventListener("animationend", onMenuFixoOut);
          }
        });
      }
    }
  });
}

// Alteração da Gabriele: comportamento do FAQ com abertura mais organizada, mantendo a estrutura details/summary
const faqs = document.querySelectorAll(".faq-cards details");

faqs.forEach(function (item) {
  const summary = item.querySelector("summary");

  if (summary) {
    summary.addEventListener("click", function () {
      faqs.forEach(function (outroItem) {
        if (outroItem !== item) {
          outroItem.removeAttribute("open");
        }
      });
    });
  }
});
