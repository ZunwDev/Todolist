class ProjectManager {
  constructor(projectID = null) {
    this.projectID = projectID;
  }

  projectCreate() {
    let projectCreatePopup = new ProjectCreatePopup();
    projectCreatePopup.showPopup();
    $('#colorSelect').prepend(getColorSelect());
  }

  acceptProjectCreate() {
    const projectName = $('#nameInputCreate').val();
    const projectDescription = $('#projectDescriptionCreate').val();
    const colorName = document.getElementById('currentColorName').innerText;

    if (!projectName.replace(/\s/g, '').length) return;
    let finalDescription = projectDescription == '' ? '' : projectDescription;

    $.post('http://localhost/TodoList/src/scripts/project/createProject.php', {
      projectName: projectName,
      projectDescription: finalDescription,
      color: colorName,
    }).done((data) => {
      window.location.reload();
    });
    let popupHandler = new PopupHandler();
    popupHandler.closeAnyPopup();
  }

  closeProject() {
    const getSidebar = document.getElementById('sidebar');
    const lastClass = getSidebar.classList.item(getSidebar.classList.length - 1);
    getSidebar.classList.replace(lastClass, 'bg-slate-200');

    if (document.querySelector('#project_opened') != null) {
      document.querySelector('#project_opened').remove();
    }
    $('#project_grid, #projects_nameEl, .project_wrapper').show();
    URL('index.php');
    title('TodoList');
  }

  insertPreparedHTML(projectID, name, lightlow) {
    const getSidebar = document.getElementById('sidebar');
    const lastClass = getSidebar.classList.item(getSidebar.classList.length - 1);
    getSidebar.classList.replace(lastClass, lightlow);
    return getPrepHTML(projectID, name);
  }

  openProject(projectID) {
    if (document.querySelector('#project_opened') != null) {
      this.closeProject(projectID);
      this.openProject(projectID);
      return;
    }
    //Data
    let projectName = getProjectName(projectID);
    const colorClass = new Color(getColorCode(projectID));
    //Hiding projects
    $('#project_grid, #projects_nameEl, .project_wrapper').hide();
    //New window
    $('.app_appProjectsContainer').prepend(this.insertPreparedHTML(projectID, projectName, colorClass.getLighter(400)));
    setTimeout(() => {
      $('#boards').text('');
      $('#boards').append(getBoardData(projectID));
    }, 50);
    URL(`${projectID}/${projectName}`);
    title(`TodoList: ${projectName}`);
  }

  saveProjectEdit(projectID) {
    let newProjectName = $('#projectNameEdit').val();
    let newProjectDescription = $('#projectDescriptionEdit').val();
    const newColorName = $('#currentColorName').text();

    let finalName = newProjectName == '' ? 'Project' : newProjectName;
    let finalDescription = newProjectDescription == '' ? '' : newProjectDescription;

    $.post('http://localhost/TodoList/src/scripts/project/saveProjectEdit.php', {
      projectName: finalName,
      projectDescription: finalDescription,
      color: newColorName,
      projectID: projectID,
    }).done((data) => window.location.reload());
  }
}
