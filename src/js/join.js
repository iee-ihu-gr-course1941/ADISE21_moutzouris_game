let playersObject;
let createListofUsersExecutedOnce = false;
let playerCredentials;

$(document).ready(() => {
  setInterval(reloadForPlayers,1000)
  $('#joinGame').on('click',initGame)  
});

function reloadForPlayers() {
  const url = "../src/api/gofish.php/leaderboard";
  $.ajax({
    url: url,
    type: "GET",
    dataType: "JSON",
    success: (data) => {
      playersObject = data;
      createListofUsers(data);
      refreshLeaderboard();
    },
  });
}

function createListofUsers(data) {
  //console.log(createListofUsersExecutedOnce);
  if (createListofUsersExecutedOnce == false) {
    createListofUsersExecutedOnce = true;
    let tbody = document.querySelector("tbody");
    if (tbody.children.length > 0) {
      tbody.remove();
    }
    //console.log(tbody);
    sortedData = sortLosses(data);
    for (i = 0; i < data.length; i++) {
      let tr = document.createElement("tr");
      let username = document.createElement("th");
      username.classList.add("col");
      username.innerHTML = sortedData[i].username;
      losses = document.createElement("th");
      losses.classList.add("col");
      losses.innerHTML = sortedData[i].losses;
      let connected = document.createElement("th");
      connected.classList.add("col");
      if (sortedData[i].loggedIn == "1") {
        connected.innerHTML = "Yes";
      } else {
        connected.innerHTML = "No";
      }
      tr.appendChild(username);
      tr.appendChild(losses);
      tr.appendChild(connected);
      tbody.appendChild(tr);
    }
  }
}

function sortLosses(data) {
  data.sort((a, b) => {
    return a.losses - b.losses;
  });
  return data;
}

function checkForAvailablePlayers(e) {
  playersAvailable = false;
  playerName = $("#playerId").text();
  playerId = $("#playerId").attr("myid");
  const allPlayers = playersObject.filter(function (player) {
    return player.username != playerName && player.loggedIn === "1";
  });
  //console.log(allPlayers);
  if (allPlayers.length > 0) {
    playersAvailable = true;
  }

  if (!playersAvailable) {
    e.preventDefault();
    alert("There are no available players!");
  }
}

function refreshLeaderboard() {
  table = $("#tableBody");
  tableRows = table[0].children;
  tableRowsLength = tableRows.length;
  sortedData = sortLosses(playersObject);
  //console.log(sortedData);
  for (i = 0; i < tableRowsLength; i++) {
    for (j = 0; j < tableRows[i].cells.length; j++) {
      tableRows[i].cells[1].innerHTML = sortedData[i].losses;
      tableRows[i].cells[0].innerHTML = sortedData[i].username;
      if (sortedData[i].loggedIn == "1") {
        tableRows[i].cells[2].innerHTML = "Yes";
      } else {
        tableRows[i].cells[2].innerHTML = "No";
      }
    }
  }
}

function initGame(e){
    checkForAvailablePlayers(e)
    window.location = '../Board/'
}