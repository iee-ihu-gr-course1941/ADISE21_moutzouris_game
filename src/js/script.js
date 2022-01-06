import Deck from '../modules/deck.js'

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
    $.ajax({
        url:'../src/api/initGame.php/Board',
        type:'GET',
        contentType:'application/json',
        dataType:'JSON',
        success:(data)=>{
            if(Object.keys(data).length ==0){
                console.log('1st player')
                insertNew()
            }else{
                if(data.p2_id == null){
                    console.log('2nd player')
                    insertSecond()
                }
            }
            startGame()
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
        success:()=>{
            console.log('ok')
        }
    })
}

function insertSecond(){
    $.ajax({
        url:'../src/api/initGame.php/Second',
        type:'POST',
        contentType:'application/json',
        dataType:'JSON',
        success:()=>{
            console.log('ok')
        }
    })
}


function startGame(){
    $.ajax({
        url:'../src/api/initGame.php/Board',
        type:'GET',
        contentType:'application/json',
        dataType:'JSON',
        success:(data)=>{
            console.log(data)
        }
    })
}