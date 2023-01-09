
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
            const img = document.querySelector("img");
            img.src = "https://image.tmdb.org/t/p/w500" + (container.innerHTML+=film.poster_path)
            container.innerHTML+=film.title
            container.innerHTML+=film.realease_date
            container.innerHTML+=film.vote_average
            container.innerHTML+=film.popularity
        })
        }
    )

})
