function jsonintheatres(json) {
    console.log(json);
    const container = document.getElementById('resultstheatres');
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
        //api restituisce solo l'ultima parte del path del poster quindi devo concatenare la prima parte
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

function jsontoprated(json) {
    console.log(json);
    const container = document.getElementById('resultstoprated');
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
        //api restituisce solo l'ultima parte del path del poster quindi devo concatenare la prima parte
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


function fetchintheatres(){
    fetch("fetch_in_theatres.php").then(tmdbresponse).then(jsonintheatres);
}

function fetchtoprated(){
    fetch("fetch_top_rated.php").then(tmdbresponse).then(jsontoprated);

}

function tmdbresponse(response){
    console.log(response);
    return response.json();
}


fetchintheatres();
fetchtoprated();