function toggleHidden(id) {
  for (const element of id) {
    element.classList.toggle('hidden');
  }
}

function showProjects() {
  $('#projectList').toggleClass('hidden');
}