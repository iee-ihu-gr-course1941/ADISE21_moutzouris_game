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
        username.innerHTML = sortedData[i].username
        losses = document.createElement('th')
        losses.classList.add('col')
        losses.innerHTML = sortedData[i].losses
        tr.appendChild(username)
        tr.appendChild(losses)
        tbody.appendChild(tr)
    }
}


function sortLosses(data){
    data.sort((a,b) =>{
        return a.losses - b.losses
    })
    return data
}
