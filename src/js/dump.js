let playerHand = document.querySelector('.player-deck')

function setRows(card, index) {
    if (index == 0 || index == 11) {
        let newRow = document.createElement("div");
        newRow.classList.add("row");
        let newCol = document.createElement("div");
        newCol.classList.add("col-2");
        newCol.setAttribute("style", "margin-top:15px");
        newCol.setAttribute("style", "padding:15px");
        newCol.appendChild(card.getHTML());
        newRow.appendChild(newCol);
        playerHand.appendChild(newRow);
      } else {
        let currentRow = playerHand.lastChild;
        let newCol = document.createElement("div");
        newCol.classList.add("col-2");
        newCol.setAttribute("style", "margin-top:15px");
        newCol.setAttribute("style", "padding:15px");
        newCol.appendChild(card.getHTML());
        currentRow.appendChild(newCol);
      }
}

// 1. display /Board ->ok
// 2. Create deck -> ok
// 3. Shuffle deck and split to player hand and opponent hand -> ok
// 4. Define status and board -> ok
// ROUND
    // update round,last_change,
    // 1. Eliminate Duplicates for p_turn
    // 2. p_turn picks a card 
    // 3. update p1hand and p2hand


// deck
let deck, deckMidpoint, playerDeck, opponentDeck

// db tables
let board, game_status , Gameround=1

// html elements
let startBtn = document.querySelector('#start')
let Board = document.querySelector('.Board')
let pickCardBtn = document.querySelector('#card')
pickCardBtn.style.visibility = "hidden"
Board.style.visibility = "hidden"
let gameMessage = document.querySelector('.gameMessage')

$(document).ready(()=>{
    console.log('INSERT INTO game_status(status,p_turn,result,last_change) VALUES (started, random(1,2), null, Date.now)')
    createDeck()
    $('#start').on('click',startGame)
    $('#card').on('click',updateCards) // update cards gia kathe gyro
})

function startGame(){
    updateGameMessage('Deck shuffled these are your cards,next step searching for doubles')
    Board.style.visibility = "visible"
    startBtn.style.visibility = 'hidden'
    // call api to update tables
    displayCards()
    round()
}


function deleteDuplicates(hand){
    const filteredArr = hand.reduce((acc, current) => {
        const x = acc.find(item => item.value === current.value);
        if (!x) {
          return acc.concat([current]);
        } else {
          return acc;
        }
      }, []);
    
      return filteredArr
}

function createDeck(){
    console.log('INSERT INTO board(round,p1_hand,p2_hand) VALUES (board.round, board.p1_hand, board.p2_hand)')
    //INSERT INTO board(round,p1_hand,p2_hand) VALUES (board.round, board.p1_hand, board.p2_hand)
    deck = new Deck()
    deck.shuffle()
    deckMidpoint = Math.ceil(deck.numberOfCards / 2)
    playerDeck = new Deck(deck.cards.slice(0, deckMidpoint))
    opponentDeck = new Deck(deck.cards.slice(deckMidpoint, deck.numberOfCards))
    
    board = {
        round : Gameround,
        p1_hand : playerDeck.cards,
        p2_hand : opponentDeck.cards,
    }
    game_status = {
        status : 'started',
        p_turn : 1 /*Math.floor(Math.random() * (2 - 1 + 1) + 1),*/,
        result : null,
        last_change : Date.now
    }
}

function displayCards(){  
    board.p1_hand.forEach((item, index) => {
        setRows(item, index)
    })
}

function clearDeck(parent){
    let childLength = parent.children.length
    for(let i=0;i<childLength;i++){
        parent.removeChild(parent.lastElementChild)
    }
    return parent
    
}

function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
  }

function updateGameMessage(message){
      gameMessage.innerHTML = message
  }

function round(){
    console.log('1.SELECT * FROM board 2.SELECT * FROM game_status')
    if(game_status.result ==null){
        if(game_status.p_turn == 1){
            delay(4000).then(()=>{
                updateGameMessage("Doubles deleted you new hand is:")
                board.p1_hand = deleteDuplicates(board.p1_hand)
                playerHand = clearDeck(playerHand)
                displayCards()
            })
            delay(4000).then(()=>{
                updateGameMessage("Click the button to pick a card")
                pickCardBtn.style.visibility = "visible"
                $('#card').on('click',()=>{
                    card = board.p2_hand[Math.floor(Math.random()*board.p2_hand.length)]
                    // call to api to update board
                    board.p1_hand.push(card)
                    board.p2_hand.pop(card)
                    playerHand = clearDeck(playerHand)
                    displayCards()
                    pickCardBtn.style.visibility = "hidden"
                    updateGameMessage('Its opponents turn now')
                })
            })
            
        }
    }        
}
function updateCards(){ //se kathe gyro
    round()
    const board = JSON.stringify({
        'p1_hand' : board.p1_hand,
        'p2_hand' : board.p2_hand,
        'p_turn'  : game_status.p_turn
    })
    $.ajax({
        url:'../src/api/inGame.php/Update',
        type:'POST',
        data: board,
        contentType:'application/json',
        dataType:'JSON',
        success:(data)=>{
          if(p1_hand == ''){
              alert("Player 1 is the winner");
              window.location.replace("../src/api/initGame.php/Board");
          }else if(p2_hand == ''){
              alert("Player 2 is the winner");
              window.location.replace("../src/api/initGame.php/Board");
          }
        },
        error:(response)=>{console.log(response)}
    })
} 

}
