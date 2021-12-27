$(document).ready( () => {
        const url = '../src/api/gofish.php/available'
        $.ajax({
            url : url,
            type:'GET',
            dataType:'JSON',
            success: (data) => {
                createListofUsers(data)
            }
        })
})


function createListofUsers(data){
    let tbody = document.querySelector('tbody')
    for(i=0;i<data.length;i++){
        let tr = document.createElement('tr')
        let username = document.createElement('th')
        username.classList.add('col')
        username.innerHTML = data[i].username
        let wins = document.createElement('th')
        wins.classList.add('col')
        wins.innerHTML = data[i].wins
        losses = document.createElement('th')
        losses.classList.add('col')
        losses.innerHTML = data[i].losses
        tr.appendChild(username)
        tr.appendChild(wins)
        tr.appendChild(losses)
        tbody.appendChild(tr)
    }
}



