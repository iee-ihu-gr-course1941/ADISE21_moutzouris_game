import Deck from '../modules/deck.js'

// opponent deck
let opponentDeckDiv = document.querySelector('.opponent-deck')

const deck = new Deck()
deck.shuffle()
const deckMidpoint = Math.ceil(deck.numberOfCards / 2)
const playerDeck = new Deck(deck.cards.slice(0, deckMidpoint))
const opponentDeck = new Deck(deck.cards.slice(deckMidpoint, deck.numberOfCards))

let playerHand = document.querySelector('.player-deck')
let rowCount
playerDeck.cards.forEach((item, index) => {
    // console.log(index)
    // playerHand.appendChild(item.getHTML())
    setRows(item, index)
})

function setRows(card, index) {
    // if(index % Math.ceil(deckMidpoint/2) == 0){
    //     console.log(index)
    //     let newRow = document.createElement('div')
    //     newRow.classList.add('row')
    //     let newCol = document.createElement('div')
    //     newCol.classList.add('col')
    //     newCol.appendChild(card.getHTML())
    //     newRow.appendChild(newCol)
    //     playerHand.appendChild(newRow)
    // }else{
    //     let currentRow = playerHand.lastChild
    //     // console.log(currentRow)
    //     let newCol = document.createElement('div')
    //     newCol.classList.add('col')
    //     newCol.appendChild(card.getHTML())
    //     currentRow.appendChild(newCol)
    // }

    if (index == 0 || index == 11) {
        let newRow = document.createElement('div')
        newRow.classList.add('row')
        let newCol = document.createElement('div')
        newCol.classList.add('col')
        newCol.appendChild(card.getHTML())
        newRow.appendChild(newCol)
        playerHand.appendChild(newRow)
    } else {
        let currentRow = playerHand.lastChild
        let newCol = document.createElement('div')
        newCol.classList.add('col')
        newCol.appendChild(card.getHTML())
        currentRow.appendChild(newCol)
    }
}