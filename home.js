document.querySelector("#search form").addEventListener("submit", search);

function jsonTmdb(json) {
    console.log(json);
    const container = document.getElementById('results');
    container.innerHTML = '';
    container.className = 'tmdb';
    if(!json.results.length) {noResults(); return;}

    for(let film in json.results) {
        const card = document. createElement('div');
        card.dataset.id=json.results[film].id;
        card.dataset.title=json.results[film].title;
        card.dataset.overview=json.results[film].overview;
        card.dataset.releasedate=json.results[film].release_date;
        card.dataset.vote=json.results[film].vote_average;
        const path_poster= "https://image.tmdb.org/t/p/original"+json.results[film].poster_path;
        card.dataset.poster= path_poster;
        card.classList.add('film');

        const filminfo = document.createElement('div');
        filminfo.classList.add('filminfo');
        card.appendChild(filminfo);

        const img=document.createElement('img');
        img.src=path_poster;
        filminfo.appendChild(img);

        const infoContainer = document.createElement('div');
        infoContainer.classList.add("infoContainer");
        filminfo.appendChild(infoContainer);

        const info = document.createElement('div');
        info.classList.add("info");
        infoContainer.appendChild(info);

        const title = document.createElement('strong');
        title.innerHTML = json.results[film].title+"<br>";
        info.appendChild(title);

        const vote = document.createElement('a');
        vote.innerHTML="Valutazione: "+json.results[film].vote_average+"/10";
        info.appendChild(vote);

        const saveForm = document.createElement('div');
        saveForm.classList.add("saveForm");
        card.appendChild(saveForm);
        const save = document.createElement('div');
        save.value='';
        save.classList.add("save");
        saveForm.appendChild(save);
        saveForm.addEventListener('click',addwatchlist);

        card.classList.add("unselected");
        container.appendChild(card);


    }
}

function noResults() {
    const container = document.getElementById('results');
    container.innerHTML = '';
    const noresult = document.createElement('div');
    noresult.className = "loading";
    noresult.textContent = "Nessun risultato trovato.";
    container.appendChild(noresult);
}


function search(event){
    //leggo dalla barra di ricerca
    const form_data = new FormData(document.querySelector("#search form"));
    fetch("search_content.php?q="+encodeURIComponent(form_data.get('search'))).then(searchResponse).then(jsonTmdb);
    event.preventDefault();
}

function searchResponse(response){
    console.log(response);
    return response.json();
}

function addwatchlist(event){
    console.log("Aggiungo alla tua lista...")
    const card=event.currentTarget.parentNode;
    const formData=new FormData();
    formData.append('id',card.dataset.id);
    formData.append('title', card.dataset.title);
    formData.append('overview', card.dataset.overview);
    formData.append('releasedate', card.dataset.releasedate);
    formData.append('vote', card.dataset.vote);
    formData.append('poster', card.dataset.poster);
    fetch("save_in_list.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
    event.stopPropagation();
}

function dispatchResponse(response) {

    console.log(response);
    return response.json().then(databaseResponse); 
}
  
function dispatchError(error) { 
    console.log("Errore");
}

function databaseResponse(json) {
    if (!json.ok) {
        dispatchError();
        return null;
    }
}



  
