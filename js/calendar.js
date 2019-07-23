function addRequest(type, idUser, date){
    const textRequest = `type=${type}&idUser=${idUser}&date=${date}`;
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            console.log(request.responseText);//Réponse à afficher
        }
    };
    request.open('POST', 'setRequests.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(textRequest);
}

function getVacation(date, j){
    let i = j.split("_");
    let th = document.getElementsByTagName("th")[parseInt(i[0]) + 1];
    let idUser = th.getAttribute("id");
    const textRequest = `date=${date}&idUser=${idUser}`;
    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            let writeZone = document.getElementById(j);
            writeZone.innerHTML = request.responseText;
        }
    };
    request.open('POST', 'getVacation.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(textRequest);
}