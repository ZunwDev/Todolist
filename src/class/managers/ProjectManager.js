class ProjectManager {
  projectCreate() {
    let projectCreatePopup = new ProjectCreatePopup();
    projectCreatePopup.showPopup();
    $("#colorSelect").prepend(getColorSelect());
  }

  acceptProjectCreate() {
    const projectName = $("#nameInputCreate").val();
    const projectDescription = $("#projectDescriptionCreate").val();
    const colorID = document.querySelector(".currentColorName").id;

    if (!projectName.replace(/\s/g, "").length) return $(`#nameInputCreate`).addClass("!border-red-500");
    let finalDescription = projectDescription == "" ? "" : projectDescription;

    $.post("https://xtodolist.tode.cz/src/scripts/project/createProject.php", {
      projectName: projectName,
      projectDescription: finalDescription,
      colorID: colorID,
    }).done((data) => {
      window.location.reload();
    });
    let popupHandler = new PopupHandler();
    popupHandler.closeAnyPopup();
  }

  closeProject() {
    const getSidebar = document.getElementById("sidebar");
    const lastClass = getSidebar.classList.item(getSidebar.classList.length - 1);
    getSidebar.classList.replace(lastClass, "bg-slate-200");

    if (document.querySelector("#project_opened") != null) {
      document.querySelector("#project_opened").remove();
    }
    $("#project_grid, #projects_nameEl, .project_wrapper").show();
    title("TodoList");
  }

  insertPreparedHTML(projectID, name, lightlow) {
    const getSidebar = document.getElementById("sidebar");
    const lastClass = getSidebar.classList.item(getSidebar.classList.length - 1);
    getSidebar.classList.replace(lastClass, lightlow);
    return getPrepHTML(projectID, name);
  }

  openProject(projectID) {
    if (document.querySelector("#project_opened") != null) {
      this.closeProject(projectID);
      this.openProject(projectID);
      return;
    }
    //Data
    let projectName = getProjectName(projectID);
    const colorClass = new Color(getColorCode(projectID));
    //Hiding projects
    $("#project_grid, #projects_nameEl, .project_wrapper").hide();
    //New window
    $(".app_appProjectsContainer").prepend(this.insertPreparedHTML(projectID, projectName, colorClass.getLighter(400)));
    setTimeout(() => {
      $("#boards").text("");
      $("#boards").append(getBoardData(projectID));
    }, 50);
    title(`TodoList: ${projectName}`);
  }

  saveProjectEdit(projectID) {
    let newProjectName = $("#projectNameEdit").val();
    let newProjectDescription = $("#projectDescriptionEdit").val();
    const colorID = document.querySelector(".currentColorName").id;

    let finalName = newProjectName == "" ? "Project" : newProjectName;
    let finalDescription = newProjectDescription == "" ? "" : newProjectDescription;

    $.post("https://xtodolist.tode.cz/src/scripts/project/saveProjectEdit.php", {
      projectName: finalName,
      projectDescription: finalDescription,
      colorID: colorID,
      projectID: projectID,
    }).done((data) => window.location.reload());
  }
}
