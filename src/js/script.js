import Deck from '../modules/deck.js'

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
    
    createDeck()
    $('#start').on('click',startGame)
})

function startGame(){
    updateGameMessage('Deck shuffled these are your cards,next step searching for doubles')
    Board.style.visibility = "visible"
    startBtn.style.visibility = 'hidden'
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
    if(game_status.result ==null){
        if(game_status.p_turn == 1){
            delay(4000).then(()=>{
                updateGameMessage("Doubles deleted you new hand is:")
                board.p1_hand = deleteDuplicates(board.p1_hand)
                // console.log(board.p1_hand)
                playerHand = clearDeck(playerHand)
                displayCards()
            })
            // updateTables(2)
        }else{
            delay(4000).then(()=>{
                updateGameMessage('Opponents turn. Searching and deleting doubles')
                console.log('Opponent hand length='+board.p2_hand.length)
                board.p2_hand = deleteDuplicates(board.p2_hand)
                console.log('New opponent hand length='+board.p2_hand.length)
                // updateTables(1)
            })
        }
    }        
}

function updateTables(turn){
    board.round ++
    game_status.p_turn = turn
    if(board.p1_hand == null){
        game_status.result = 1
        game_status.p_turn = null
        game_status.last_change = Date.now
    }
}



