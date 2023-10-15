const check_repo_form = document.getElementById("check-repo-form");
const folder = document.getElementById("folder");
const result = document.getElementById("result");
check_repo_form.addEventListener("submit", (e) => {
    e.preventDefault();
    result.innerHTML = "Checking...";
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
