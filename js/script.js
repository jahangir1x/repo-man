const checkRepoForms = document.querySelectorAll(".check-repo-form");
checkRepoForms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const folder = form.querySelector(".folder");
        const result = form.querySelector(".result");
        result.innerHTML = "Checking...";
        console.log(folder.value + " is being checked");
        fetch("check-repo.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                folder: folder.value,
            }),
        })
            .then((res) => {
                res.json().then((data) => {
                    result.innerHTML = data.is_remote_ahead ? "Not OK" : "OK";
                });
            })
            .catch((err) => {
                result.innerHTML = "Error: " + err;
            });
    });
});

const updateRepoForms = document.querySelectorAll(".update-repo-form");
updateRepoForms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const folder = form.querySelector(".folder");
        const result = form.querySelector(".result");
        result.innerHTML = "Updating...";
        console.log(folder.value + " is being updated");
        fetch("update-repo.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                folder: folder.value,
            }),
        })
            .then((res) => {
                res.json().then((data) => {
                    result.innerHTML = data.message == "done" ? "OK" : "ERROR";
                });
            })
            .catch((err) => {
                result.innerHTML = "Error: " + err;
            });
    });
});
