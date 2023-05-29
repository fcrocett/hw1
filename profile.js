function fetchfilmsinlist(){
    fetch("fetch_film_in_list.php").then(fetchResponse).then(fetchfilmsinlistjson);
}

function fetchfilmswatched(){
    fetch("fetch_film_watched.php").then(fetchResponse).then(fetchfilmswatchedjson);

}

function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}

function fetchfilmsinlistjson(json) {
    console.log("Fetching...");
    console.log(json);
    if (!json.length) {noResults(); return;}

    const container = document.getElementById('resultslist');
    container.innerHTML = '';
    container.className = 'tmdb';

    for (let film in json) {
        const card = document.createElement('div');
        card.dataset.id = json[film].content.id;
        card.classList.add('film');
        const films = document.querySelectorAll(".film")
        const filmInfo = document.createElement('div');
        filmInfo.classList.add('filmInfo');
        card.appendChild(filmInfo);
        const img = document.createElement('img');
        img.src = json[film].content.poster;
        filmInfo.appendChild(img);
        const infoContainer = document.createElement('div');
        infoContainer.classList.add("infoContainer");
        filmInfo.appendChild(infoContainer);
        const info = document.createElement('div');
        info.classList.add("info");
        infoContainer.appendChild(info);
        const title = document.createElement('strong');
        title.innerHTML = json[film].content.title+"<br>";
        info.appendChild(title);
        const vote = document.createElement('a');
        vote.innerHTML = "Valutazione: "+json[film].content.vote+"/10";
        info.appendChild(vote);
        container.appendChild(card);


        const seenForm = document.createElement('div');
        seenForm.classList.add("seenForm");
        card.appendChild(seenForm);
        const seen = document.createElement('div');
        seen.value='';
        seen.classList.add("seen");
        seenForm.appendChild(seen);
        seenForm.addEventListener('click',seenFilm );

    }

}

function fetchfilmswatchedjson(json){
    console.log("Fetching...");
    console.log(json);

    const container = document.getElementById('resultswatched');
    container.innerHTML = '';
    container.className = 'tmdb';

    for (let film in json) {
        const card = document.createElement('div');
        card.dataset.id = json[film].content.id;
        card.classList.add('film');
        const films = document.querySelectorAll(".film")
        const filmInfo = document.createElement('div');
        filmInfo.classList.add('filmInfo');
        card.appendChild(filmInfo);
        const img = document.createElement('img');
        img.src = json[film].content.poster;
        filmInfo.appendChild(img);
        const infoContainer = document.createElement('div');
        infoContainer.classList.add("infoContainer");
        filmInfo.appendChild(infoContainer);
        const info = document.createElement('div');
        info.classList.add("info");
        infoContainer.appendChild(info);
        const title = document.createElement('strong');
        title.innerHTML = json[film].content.title+"<br>";
        info.appendChild(title);
        const vote = document.createElement('a');
        vote.innerHTML = "Valutazione: "+json[film].content.vote+"/10";
        info.appendChild(vote);
        container.appendChild(card);
        }

}

function noResults() {
    // Definisce il comportamento nel caso in cui non ci siano contenuti da mostrare
    const container = document.getElementById('resultslist');
    container.innerHTML = '';
    const nores = document.createElement('div');
    nores.className = "nores";
    nores.textContent = "Nessun risultato.";
    container.appendChild(nores);
}


function seenFilm(event){
    console.log("Salvo come già visto")

    const card = event.currentTarget.parentNode;
    const formData=new FormData();
    formData.append('id', card.dataset.id);
    fetch("move_film_to_watched.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
    event.stopPropagation();

    const container = document.getElementById('resultslist');
    const resultswatchedContainer = document.getElementById('resultswatched');
    resultswatchedContainer.appendChild(card);
    

    const seenElement = card.querySelector('.seen');


  seenElement.remove();

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

fetchfilmsinlist();
fetchfilmswatched();