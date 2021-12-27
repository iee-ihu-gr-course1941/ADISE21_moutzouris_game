$(document).ready( () => {
        const url = '../src/api/gofish.php/leaderboard'
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
    sortedData = sortLosses(data)
    for(i=0;i<data.length;i++){
        let tr = document.createElement('tr')
        let username = document.createElement('th')
        username.classList.add('col')
        username.innerHTML = data[i].username
        losses = document.createElement('th')
        losses.classList.add('col')
        losses.innerHTML = data[i].losses
        tr.appendChild(username)
        tr.appendChild(losses)
        tbody.appendChild(tr)
    }
}


function sortLosses(data){
    for(i=0;i<data.length-1;i++){
        if (data[i].losses > data[i+1].losses){
            let temp = data[i]
            data[i] = data[i+1]
            data[i+1] = temp
        }
    }
    return data
}
