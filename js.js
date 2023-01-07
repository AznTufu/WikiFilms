
let recherche=document.querySelector('.recherche');
console.log(recherche);
recherche.addEventListener('input', (e)=>{

    axios.get('http://localhost/getfilm.php')
    .then(function (response){
        console.log(response);
        }
    )

})
