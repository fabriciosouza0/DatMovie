var formOptions = $(".form-options");
var btnOptions = $(".btn-options");

formOptions.click(function (e) {
  e.stopPropagation();
});

btnOptions.click(function (e) {
  e.stopPropagation();
  formOptions.toggleClass("d-none");
});

// Toggle form filter
window.addEventListener("click", function (e) {
  e.stopPropagation();

  let btn = document.getElementsByClassName("btn-options")[0];
  let form = document.getElementsByClassName("form-options")[0];
  if (
    !form.classList.contains("d-none") &&
    e.target != btn &&
    e.target != form
  ) {
    formOptions.addClass("d-none");
  }
});

var p = 2; //Actual page

// Load more content at c-wrapper
const load = (e) => {
  e.stopPropagation;

  document.getElementById("loadMore").removeChild(document.getElementById("load_more"));

  const mediaType = $("#mediaType").val(); //Media type
  const order = $("#fixedOrder").val(); //Order of data
  const genre = $("#genre").val(); //Genre of media

  const autoLoad = new IntersectionObserver((entries) => {
    entries.forEach((entrie) => {
      if (entrie.isIntersecting) {
        let url = window.location;
        let baseUrl =
          url.protocol +
          "//" +
          url.host +
          "/" +
          url.pathname.split("/")[1] +
          "/app/Model/LoadMoreModel.php";

        request(baseUrl, mediaType, order, genre);
      }
    });
  });

  autoLoad.observe(document.getElementById("loadMore"));
};

const request = (baseUrl, mediaType, order, genre) => {
  const wrapper = $(".c-wrapper");
  const mediaContent = $("#loadMore");
  const divLoading =
    $(
      '<div class="flex align-items-center justify-content-center loading" id="loading">' +
      '<section class="section">' +
      '<span class="loader loader-circles"></span>' +
      '</section>' +
      '</div>'
    );

  if (!$.contains(mediaContent, divLoading)) mediaContent.append(divLoading); //Add animation of loading after container

  $.ajax({
    url: baseUrl,
    data: { mediaType: mediaType, page: p, order: order, genre: genre },
    method: "get",
    success: (data) => {
      if (!data.results) return;

      data.results.forEach((result) => {
        let imgSrc = result.poster_path ? `https://image.tmdb.org/t/p/original${result.poster_path}` : 'app/lib/Style/Images/img-not-found.png';
        let title = result.title ? result.title : result.name;
        let content =
          '<div class="c">' +
          '<div class="c-content">' +
          '<div class="c-header">' +
          '<a href="detalhes/' + mediaType + '/' + result.id + '">' +
          '<img class="img-fluid" src="' + imgSrc + '" />' +
          '</a>' +
          '</div>' +
          '<div class="c-body">' +
          '<a href="detalhes/' + mediaType + '/' + result.id + '">' +
          '<p style="font-weight: bold; font-size: 1rem; margin: 0">' + title + '</p>' +
          '</a>' +
          '</div>' +
          '<div class="c-footer">' +
          '<i class="fa-solid fa-star star"></i>' + result.vote_average +
          '</div>' +
          '</div>' +
          '</div>';

        wrapper.append(content);
      });

      p++;
    },
    error: (jqx, textStatus) => {
      alert(jqx, textStatus);
    },
    complete: () => {
      divLoading.remove();
    },
    dataType: "json",
  });
}