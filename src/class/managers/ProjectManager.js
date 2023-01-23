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

		let finalProjectName = projectName == '' ? 'Project' : projectName;
		let finalDescription = projectDescription == '' ? '' : projectDescription;

		$.post('./src/scripts/project/createProject.php', {
			projectName: finalProjectName,
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
		getSidebar.classList.replace(lastClass, 'bg-slate-100');

		if (document.querySelector('#project_opened') != null) {
			document.querySelector('#project_opened').remove();
		}
		$('#project_grid, #projects_nameEl, .project_wrapper').show();
		URL('index.php');
		title('TodoList');
	}

	insertPreparedHTML(name, lightlow) {
		const getSidebar = document.getElementById('sidebar');
		const lastClass = getSidebar.classList.item(getSidebar.classList.length - 1);
		getSidebar.classList.replace(lastClass, lightlow);
		return getPrepHTML(this.projectID, name);
	}

	openProject() {
		if (document.querySelector('#project_opened') != null) {
			this.closeProject(this.projectID);
			this.openProject(this.projectID);
			return;
		}
		//Data
		let projectName = getProjectName(this.projectID);
		const colorClass = new Color(getColorCode(this.projectID));
		//Hiding projects
		$('#project_grid, #projects_nameEl, .project_wrapper').hide();
		//New window
		$('.app_appProjectsContainer').prepend(this.insertPreparedHTML(projectName, colorClass.getLighter(400)));
		setTimeout(() => {
			$('#boards').text('');
			$('#boards').append(getBoardData(this.projectID));
		}, 50);
		URL(`${this.projectID}/${projectName}`);
		title(`TodoList: ${projectName}`);
	}

	saveProjectEdit() {
		let newProjectName = $('#projectNameEdit').val();
		let newProjectDescription = $('#projectDescriptionEdit').val();
		const newColorName = $('#currentColorName').text();

		let finalName = newProjectName == '' ? 'Project' : newProjectName;
		let finalDescription = newProjectDescription == '' ? '' : newProjectDescription;

		$.post('../src/scripts/project/saveProjectEdit.php', {
			projectName: finalName,
			projectDescription: finalDescription,
			color: newColorName,
			projectID: id,
		}).done((data) => window.location.reload());
	}
}
