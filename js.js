
let recherche=document.querySelector('.recherche');
let container=document.querySelector('.container');
recherche.addEventListener('input', (e)=>{

    axios.get('http://localhost/WikiFilms/getfilm.php?query=' + e.target.value)
    .then(function (response){
        while(container.firstElementChild){
            container.firstElementChild.remove()
        }
        console.log(response)
        response.data.forEach(film=>{
            container.innerHTML+=film.title


        })
        }
    )

})
