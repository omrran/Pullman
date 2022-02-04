function activateCompAccount(id) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            console.log(xhttp.readyState);
            console.log(xhttp.getAllResponseHeaders());
            console.log(JSON.parse(xhttp.responseText));
            document.getElementById(id).style.display = "none";
        }
        console.log(xhttp.readyState);
    };
    xhttp.open(
        "GET",
        "http://127.0.0.1:8000/admin-profile/activate-company/" + id,
        true
    );
    xhttp.send();
}

function blockPassenger(pass_id, row_id) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        // console.log(xhttp.readyState);
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            //console.log(xhttp.readyState);
            //console.log(xhttp.getAllResponseHeaders());

            // console.log(JSON.parse(xhttp.responseText).id);
            // console.log(xhttp.responseText);
            let row = document.getElementById(row_id);
            console.log(row.getElementsByTagName('td')[3]);
            //update td element that has status :
            row.getElementsByTagName('td')[3].innerText = 'blocked';
            console.log(row.getElementsByTagName('td')[4]);
            //update button element in td element that has function of blocking :

            row.getElementsByTagName('td')[4]
                .innerHTML = '<button id="unblock' + pass_id + '" type="button" class="btn btn-success  mt-1" onclick="unBlockPassenger(' + pass_id + ',\'row' + pass_id + '\')">Unblock</button>';
            // console.log(row2);

        }
    };
    xhttp.open(
        "GET",
        "http://127.0.0.1:8000/admin-profile/block-passenger/" + pass_id,
        true
    );
    xhttp.send();
}

function unBlockPassenger(pass_id, row_id) {

    const xhttp = new XMLHttpRequest();
    let row = document.getElementById(row_id);
    xhttp.onreadystatechange = function () {
        console.log(xhttp.readyState);

        if (xhttp.readyState === 4 && xhttp.status === 200) {
            //console.log(xhttp.readyState);
            //console.log(xhttp.getAllResponseHeaders());

            // console.log(JSON.parse(xhttp.responseText).id);
            // console.log(xhttp.responseText);

            console.log(row.getElementsByTagName('td')[3]);
            //update td element that has status :
            row.getElementsByTagName('td')[3].innerText = 'unblocked';
            console.log(row.getElementsByTagName('td')[4]);
            //update button element in td element that has function of blocking :

            row.getElementsByTagName('td')[4]
                .innerHTML = '<button id="unblock' + pass_id + '" type="button" class="btn btn-warning  mt-1" onclick="blockPassenger(' + pass_id + ',\'row' + pass_id + '\')">Block</button>';
            // console.log(row2);

        }
    };
    xhttp.open(
        "GET",
        "http://127.0.0.1:8000/admin-profile/unBlock-passenger/" + pass_id,
        true
    );
    xhttp.send();
}

function displayEditForm(button, id) {
    button.style.display = 'none';
    document.getElementById('info' + id).style.display = 'none';
    document.getElementById('form' + id).style.display = 'block';
}

function displayInfoTrip(id) {
    document.getElementById('info' + id).style.display = 'block';
    document.getElementById('form' + id).style.display = 'none';
    document.getElementById('edit' + id).style.display = 'block';
}

function convertInputTypeToDate(Input) {
    Input.setAttribute('type', 'datetime-local');

}

function toggleImgSize(id) {
    console.log(id);
    let e = document.getElementById(id);
    console.log(e);
    console.log(e.style.width);
    switch (e.style.width) {
        case "200px":
            e.style.width = "50px";
            e.style.height = "50px";
            console.log(e.height);
            break;
        case "50px":
            e.style.width = "200px";
            e.style.height = "200px";
            console.log(e.height);
            break;
    }
}

function showfilterItems(id) {

    let element = document.getElementById(id);
    let listClasses = document.getElementById(id).classList;

    listClasses.contains("d-none") ? element.classList.remove("d-none") : element.classList.add("d-none");

}

function hide(id) {
    document.getElementById(id).style.display = 'none';
}

function reserveASeat(tripId, button) {
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        console.log(xhttp.readyState);

        if (xhttp.readyState === 4 && xhttp.status === 200) {
            console.log('xhttp.responseText');
            console.log('xhttp.responseText');
            console.log(JSON.parse(xhttp.responseText));
            if (JSON.parse(xhttp.responseText).res === true) {
                button.innerText = "done"
            } else if (JSON.parse(xhttp.responseText).res === false) {
                button.innerText = "there are no seats in this trip";
            } else {
                button.innerText = JSON.parse(xhttp.responseText).res;
            }

        }
    };
    xhttp.open(
        "GET",
        "http://127.0.0.1:8000/passenger-profile/reserve-seat/" + tripId,
        true
    );
    xhttp.send();
}
function showEditProfile(id){
    console.log(document.getElementById('editprofile'+id).style.display);
    document.getElementById('editprofile'+id).classList.remove('d-none');
    document.getElementById('editprofile'+id).classList.add('d-flex');

}

