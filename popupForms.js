function newProjectForm() {
    document.getElementById("loginPopup").style.display = "block";
}

function closenewProjectForm() {
    document.getElementById("loginPopup").style.display = "none";
}

function editProjectForm(num) {
    document.getElementById("editPopup").style.display = "block";
    const button = document.getElementById(num);
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');
    const desc = button.getAttribute('data-description');
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_name").value = name;
    document.getElementById("edit_description").value = desc;
}

function closeEditProjectForm() {
    document.getElementById("editPopup").style.display = "none";
}

function newTaskForm() {
    document.getElementById("loginPopup").style.display = "block";
}

function closenewTaskForm() {
    document.getElementById("loginPopup").style.display = "none";
}

function editTaskForm(num) {
    document.getElementById("editPopup").style.display = "block";
    const button = document.getElementById(num);
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');
    const desc = button.getAttribute('data-description');
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_name").value = name;
    document.getElementById("edit_description").value = desc;
}

function closeeditTaskForm() {
    document.getElementById("editPopup").style.display = "none";
}