
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
            let a = document.createElement('a')
            let div = document.createElement('div')
            let container = document.querySelector('.container')
            let url = document.createElement('img')

            if(film.poster_path == null){
                url.src = "img/question_mark.jpg" 
            }
            else{         
                url.src = "https://image.tmdb.org/t/p/w500" + film.poster_path
            }

            a.href=`SinglePage.php?film_id=${film.id}`
            div.appendChild(url)
            a.appendChild(div)
            container.appendChild(a)
        })
        }
        
    )

})
