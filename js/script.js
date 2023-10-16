const checkRepoForms = document.querySelectorAll(".check-repo-form");
checkRepoForms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        checkRepo(form);
    });
});

const updateRepoForms = document.querySelectorAll(".update-repo-form");
updateRepoForms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const folder = form.querySelector(".folder");
        const spinner =
            form.parentElement.parentElement.querySelector(".spinner");
        const checkIndicator =
            form.parentElement.parentElement.querySelector(".check");
        const crossIndicator =
            form.parentElement.parentElement.querySelector(".cross");
        const checkButton = form.parentElement.querySelector(".check-btn");
        const updateButton = form.querySelector(".update-btn");

        spinner.style.display = "block";
        checkIndicator.style.display = "none";
        crossIndicator.style.display = "none";
        checkButton.style.display = "none";
        updateButton.style.display = "none";

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
                    spinner.style.display = "none";
                    if (data.message == "done") {
                        checkIndicator.style.display = "block";
                        checkButton.style.display = "block";
                    } else {
                        crossIndicator.style.display = "block";
                        updateButton.style.display = "block";
                    }
                });
            })
            .catch((err) => {
                console.log(err);
            });
    });
});

function checkRepo(form) {
    const folder = form.querySelector(".folder");
    const spinner = form.parentElement.parentElement.querySelector(".spinner");
    const checkIndicator =
        form.parentElement.parentElement.querySelector(".check");
    const crossIndicator =
        form.parentElement.parentElement.querySelector(".cross");
    const checkButton = form.querySelector(".check-btn");
    const updateButton = form.parentElement.querySelector(".update-btn");

    spinner.style.display = "block";
    checkIndicator.style.display = "none";
    crossIndicator.style.display = "none";
    checkButton.style.display = "none";
    updateButton.style.display = "none";

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
                console.log(data);
                spinner.style.display = "none";
                if (data.is_remote_ahead) {
                    crossIndicator.style.display = "block";
                    updateButton.style.display = "block";
                } else {
                    checkIndicator.style.display = "block";
                    checkButton.style.display = "block";
                }
            });
        })
        .catch((err) => {
            console.log(err);
        });
}

function checkAllRepo() {
    const checkRepoForms = document.querySelectorAll(".check-repo-form");
    checkRepoForms.forEach((form) => {
        checkRepo(form);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM loaded");
    checkAllRepo();
});
