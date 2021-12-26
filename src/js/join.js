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
    for(i=0;i<data.length;i++){
        let li = document.createElement('li')
        li.classList.add('list-group-item')
        li.innerHTML = data[i].username
        $('#users').append(li)
    }
}



