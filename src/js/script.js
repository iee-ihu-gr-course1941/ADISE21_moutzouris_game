import Deck from '../modules/deck.js'

let user,p_turn=''
let gameMessage = document.querySelector('.gameMessage')
let startBtn = document.querySelector('#start')
let deck = new Deck()
deck.shuffle()
let deckMidpoint = Math.ceil(deck.numberOfCards / 2)
let playerDeck = new Deck(deck.cards.slice(0, deckMidpoint))
let opponentDeck = new Deck(deck.cards.slice(deckMidpoint, deck.numberOfCards))


/*
    1. when user clicks start game ---> GET initGame.php/board which gets te last row inserted 
    SELECT SELECT * FROM Table ORDER BY ID DESC LIMIT 1
    if (lastrow.result != NULL){
        which means it was last game so create new row
        POST initGame.php/board
        INSERT INTO board(p1_id) VALUES($_SESSION['uid'])
        wait for other player to press start game
    }else if(lastrow.p1_hand != null){
        which means the last row is current game with p1 waiting so
        if(lastrow.p1_id != null){
            POST initGame.php/board
            UPDATE board SET p2_id = $_SESSION['uid'] WHERE game_id=lastrow.game_id
    }else{
        game already in session try later
    } ---> NOW p1 and p2 are set so let begin game
    
    2. CREATE Deck in php 
    
    

*/

$(document).ready(()=>{
    $('#start').on('click',initGame)
})

function initGame(){
    startBtn.style.visibility = 'hidden'
    $.ajax({
        url:'../src/api/initGame.php/Board',
        type:'GET',
        contentType:'application/json',
        dataType:'JSON',
        success:(data)=>{
            if(Object.keys(data).length ==0){
                insertNew()
            }else{
                insertSecond()
            }
        },
        error:(response)=>{console.log(response)}
    })
}

function insertNew(){
    $.ajax({
        url:'../src/api/initGame.php/First',
        type:'POST',
        contentType:'application/json',
        dataType:'JSON',
    })
    startGame('First')
}

function insertSecond(){
    $.ajax({
        url:'../src/api/initGame.php/Second',
        type:'POST',
        contentType:'application/json',
        dataType:'JSON',
    })
    startGame('Second')
}


function startGame(player){
    console.log(player)
    if(player == 'First'){
        updateGameMessage('Wait for second player')
        user = 1
    }else{
        updateGameMessage('Game Begins')
        user = 2
        createHands()
    }
    console.log('You are user '+user)
    
}

function createHands(){
    let p1_hand=[],p2_hand=[]
    playerDeck.cards.forEach((card)=>{
        p1_hand.push(card.value+card.suit)
    })
    opponentDeck.cards.forEach((card)=>{
        p2_hand.push(card.value+card.suit)
    })
    const randomTurn = Math.floor(Math.random() * (10 - 1 + 1) + 1)
    let turn
    if(randomTurn < 6){
        turn = 1
    }else{
        turn = 2
    }
    const board = JSON.stringify({
        'p1_hand' : p1_hand,
        'p2_hand' : p2_hand,
        'p_turn'  : turn
    })
    $.ajax({
        url:'../src/api/initGame.php/Hands',
        type:'POST',
        contentType:'application/json',
        dataType:'JSON',
        data: board
    })
}

function updateGameMessage(message){
    gameMessage.innerHTML = message
}