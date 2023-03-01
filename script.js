// Set initial values
let currentPlayer = "X";
let gameBoard = ["", "", "", "", "", "", "", "", ""];

// Get all the table cells
const cells = document.querySelectorAll("td");

// Get the status element
const status = document.querySelector("#status");

// Get the restart button
const restartButton = document.querySelector("#restart-btn");

// Add event listeners to each cell
cells.forEach((cell) => {
  cell.addEventListener("click", handleClick);
});

// Handle a cell click
function handleClick(event) {
  const cell = event.target;
  const cellIndex = cell.id;

  // Check if the cell is already filled or if the game is over
  if (gameBoard[cellIndex] !== "" || !gameInProgress()) {
    return;
  }

  // Update the game state
  gameBoard[cellIndex] = currentPlayer;
  cell.textContent = currentPlayer;

  // Check for a win or a draw
  if (checkForWin()) {
    status.textContent = `Player ${currentPlayer} has won!`;
    return;
  } else if (checkForDraw()) {
    status.textContent = "It's a draw!";
    return;
  }

  // Switch to the other player
  switchPlayer();
  updateStatus();
}

// Check if the game is still in progress
function gameInProgress() {
  return gameBoard.includes("");
}

// Check for a win
function checkForWin() {
  const winConditions = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
  ];

  for (let condition of winConditions) {
    let a = gameBoard[condition[0]];
    let b = gameBoard[condition[1]];
    let c = gameBoard[condition[2]];

    if (a === "" || b === "" || c === "") {
      continue;
    }

    if (a === b && b === c) {
      return true;
    }
  }

  return false;
}

// Check for a draw
function checkForDraw() {
  return !gameInProgress() && !checkForWin();
}

// Switch to the other player
function switchPlayer() {
  currentPlayer = currentPlayer === "X" ? "O" : "X";
}

// Update the status element
function updateStatus() {
  status.textContent = `Player ${currentPlayer}'s turn`;
}

// Handle restart button click
restartButton.addEventListener("click", restart);

// Restart the game
function restart() {
  currentPlayer = "X";
  gameBoard = ["", "", "", "", "", "", "", "", ""];
  cells.forEach((cell) => {
    cell.textContent = "";
  });
  updateStatus();
}
