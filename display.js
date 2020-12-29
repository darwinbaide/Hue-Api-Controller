async function loadButtons() {
    version = 'getButtons';
    total = "version=".concat(version); // This will hold the data to send
    let responsive = await fetch("requests.php", {
        method: 'post',
        headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        },
        body: total
    });
    let data = await responsive.json();
    //console.log(data);

    if (responsive.ok == false || responsive.status !== 200) {
        alert("Request Failed ");
        console.log('Network response was not ok.');
        return;
    }
    if (data.Done == "yes") {
        document.getElementById('lights1').innerHTML = data.lights;
        document.getElementById('groups1').innerHTML = data.groups;


    } else {
        document.getElementById("current-tmp").innerHTML = "Could not reach the server to retrieve data. " + total;


    }

}



async function toggleLight(index) {

    version = 'toggleLight';
    total = "version=".concat(version, "& index=", index); // This will hold the data to send
    let responsive = await fetch("requests.php", {
        method: 'post',
        headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        },
        body: total
    });
    let data = await responsive.json();

}




async function toggleGroup(index) {

    version = 'toggleGroup';
    total = "version=".concat(version, "& index=", index); // This will hold the data to send
    let responsive = await fetch("requests.php", {
        method: 'post',
        headers: {
            "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
        },
        body: total
    });
    let data = await responsive.json();
}