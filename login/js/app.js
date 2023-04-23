let url_buttons = document.querySelectorAll(".url-button");
const save_button = document.getElementById("save_button");
const url = document.getElementById("url");
const status_dropdown = document.getElementById("status");
const status_selector = document.getElementById("status_selector");
const tbody = document.querySelector("tbody");
let id;

url_buttons.forEach((element, index) => {
  element.addEventListener("click", (e) => {
    id = e.target.getAttribute("data-id");
    fetch("fetch_third_party_url.php", {
      method: "POST",
      body: JSON.stringify({
        id,
      }),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.json())
      .then((data) => {
        if (!data.ok) {
          throw new Error(data.message);
        }
        if (data.data.url !== null) {
          url.value = data.data.url;
          status_dropdown.value = data.data.is_enabled;
        } else {
          url.value = "";
          status_dropdown.value = "1";
        }
      })
      .catch((error) => {
        console.log(error.message);
      });
  });
});

save_button.addEventListener("click", () => {
  const url_value = url.value.trim();
  const status_value = status_dropdown.value;
  if (url === "") return alert("Enter URL");
  fetch("set_third_party_url.php", {
    method: "POST",
    body: JSON.stringify({
      url: url_value,
      status: status_value,
      id,
    }),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      if (!data.ok) {
        throw new Error(data.message);
      }
      location.reload();
    })
    .catch((error) => alert(error.message));
});

function filterAllCountry() {
  fetch("filter_all_country.php")
    .then((response) => response.json())
    .then((data) => {
      if (!data.ok) {
        throw new Error(data.message);
      }
      tbody.innerHTML = "";
      createTableRow(data.data);
    })
    .catch((error) => alert(error.message));
}

function filterBlockedCountry() {
  fetch("filter_blocked_country.php")
    .then((response) => response.json())
    .then((data) => {
      if (!data.ok) {
        throw new Error(data.message);
      }
      tbody.innerHTML = "";
      createTableRow(data.data);
    })
    .catch((error) => alert(error.message));
}

function filterUnblockedCountry() {
  fetch("filter_unblocked_country.php")
    .then((response) => response.json())
    .then((data) => {
      if (!data.ok) {
        throw new Error(data.message);
      }
      tbody.innerHTML = "";
      createTableRow(data.data);
    })
    .catch((error) => alert(error.message));
}

const createTableRow = (data) => {
  data.forEach((element, index) => {
    let tr = document.createElement("tr");
    let tdCode = document.createElement("td");
    tdCode.innerText = element[1];
    tr.appendChild(tdCode);

    let tdName = document.createElement("td");
    tdName.innerText = element[2];
    tr.appendChild(tdName);

    // Create button element for "Set Url"
    let btnSetUrl = document.createElement("button");
    btnSetUrl.setAttribute("data-id", element[0]);
    btnSetUrl.setAttribute("data-toggle", "modal");
    btnSetUrl.setAttribute("data-target", "#modal");
    btnSetUrl.classList.add(element[3] !== null ? "bg-success" : "bg-primary");
    btnSetUrl.classList.add("text-white", "px-2", "rounded", "url-button");
    btnSetUrl.innerText = "Set Url";

    if (element[3] !== null) {
      let icon = document.createElement("i");
      icon.classList.add("fa-solid", "fa-link", "text-white");
      btnSetUrl.appendChild(icon);
    }

    let tdBtnSetUrl = document.createElement("td");
    tdBtnSetUrl.appendChild(btnSetUrl);
    tr.appendChild(tdBtnSetUrl);

    // Create table data element for "Block"/"Unblock" link
    let tdBlock = document.createElement("td");
    if (element[4] === "0") {
      let linkBlock = document.createElement("a");
      linkBlock.setAttribute("href", "block.php?country_id=" + element[0]);
      linkBlock.classList.add(
        "bg-danger",
        "text-white",
        "px-2",
        "py-1",
        "rounded"
      );
      linkBlock.textContent = "Block";
      tdBlock.appendChild(linkBlock);
    } else {
      let linkUnblock = document.createElement("a");
      linkUnblock.setAttribute("href", "unblock.php?country_id=" + element[0]);
      linkUnblock.classList.add(
        "rounded",
        "py-1",
        "bg-success",
        "text-white",
        "px-2"
      );
      linkUnblock.innerText = "Unblock";
      tdBlock.appendChild(linkUnblock);
    }
    tr.appendChild(tdBlock);
    tbody.appendChild(tr);
  });
};

status_selector.onchange = (e) => {
 if(e.target.value === 'all'){
   filterAllCountry();
 }else if(e.target.value === 'blocked'){
  filterBlockedCountry();
 }else{
  filterUnblockedCountry();
 }
};
