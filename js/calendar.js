
function addRequest(type,idUser,date){
    const textRequest = `vac=${type}&idUser=${idUser}&date=${date}`;

    const request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === 4) {
            const container=document.getElementById("container");
            container.innerHTML=request.responseText;
            console.log(request.responseText);//Réponse à afficher
        }
    };
    request.open('POST', 'setRequests.php');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.send(textRequest);
}