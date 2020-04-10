function getProjects(callback) {
    return fetch('/api/projects', {
        method: 'GET',
        credentials: 'same-origin',
    })
    .then(response => response.json())
    .then(repos => callback({
        "repositories": repos,
    }))
    .catch(error => callback({
        "repositories": null,
    }));
}

const containerNode = document.querySelector("#dynamicProjects");

getProjects(function(response) {
    if (response.repositories !== null) {
        response.repositories.forEach(repository => {
            containerNode.innerHTML += getProjectTemplate(repository);
        });
    } else {
        containerNode.innerHTML += getErrorTemplate(window.location.pathname);
    }
});

function getProjectTemplate(repository) {
    return `
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
            <div class="row">
                <div class="view overlay hm-black-strong">
                    <img src="images/languages/${repository.language}.png" alt="${repository.language}">
                    <div class="mask flex-center">
                        <div>
                        <p class="white-text">${repository.description}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <h5>
                    <a href="${repository.html_url}" target="_blank">${repository.name}</a>
                </h5>
            </div>
        </div>
    `
}

function getErrorTemplate(uiLanguage) {
    const repoURL = "https://github.com/PoLaKoSz?tab=repositories";
    if (uiLanguage === "/hu") {
        return `
            <div class="alert alert-danger lead text-center" role="alert">
                Nem sikerült betölteni a legfrissebben módosított repository-kat, viszont <a href="${repoURL}" target="_blank">ide kattintva</a> megnézheted őket GitHub-on.
            </div>
        `
    } else {
        return `
            <div class="alert alert-danger lead text-center" role="alert">
                Couldn't load the most recently updated GitHub repositories but <a href="${repoURL}" target="_blank">clicking here</a> will open it on GitHub.
            </div>
        `
    }

}
