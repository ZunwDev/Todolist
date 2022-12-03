function getColorCode(id) {
  let data = $.ajax('./utils/scripts/db/getColor.php', {
    async: false,
    type: 'POST',
    data: {
      projectID: id,
    },
  });
  return data.responseText;
}

function getProjectName(id) {
  let data = $.ajax('./utils/scripts/db/getProjectName.php', {
    async: false,
    type: 'POST',
    data: {
      projectID: id,
    },
  });
  return data.responseText;
}

function getProjectIdFromBoardId(id) {
  let data = $.ajax('../utils/scripts/db/getProjectIdFromBoardId.php', {
    async: false,
    type: 'POST',
    data: {
      boardID: id,
    },
  });
  return data.responseText;
}

function getProjectIdFromTaskId(id) {
  let data = $.ajax('../utils/scripts/db/getProjectIdFromTaskId.php', {
    async: false,
    type: 'POST',
    data: {
      taskID: id,
    },
  });
  return data.responseText;
}

function getBoardData(id) {
  let data = $.ajax('../utils/load/board/loadBoards.php', {
    async: false,
    type: 'post',
    data: {
      projectID: id,
    },
  });
  return data.responseText;
}

function getProjectEditPopup(id) {
  let data = $.ajax('../utils/load/project/loadProjectEdit.php', {
    async: false,
    type: 'POST',
    data: {
      projectID: id,
    },
  });
  return data.responseText;
}

function getColumnEditPopup(id) {
  let data = $.ajax('../utils/load/board/loadColumnEdit.php', {
    async: false,
    type: 'post',
    data: {
      boardID: id,
    },
  });
  return data.responseText;
}

function getCheckState(id) {
  const data = $.ajax('../utils/scripts/db/getCheckStatus.php', {
    async: false,
    type: 'POST',
    data: {
      dataID: id,
    },
  });
  return data.responseText;
}

function getTaskEditPopup(id) {
  const data = $.ajax('../utils/load/task/loadTaskEditPopup.php', {
    async: false,
    type: 'post',
    data: {
      dataID: id,
    },
  });
  return data.responseText;
}

function getPriorityListPopup() {
  const data = $.ajax('../utils/load/other/loadPriorityList.php', {
    async: false,
    type: 'post',
  });
  return data.responseText;
}

function getTaskManagePopup(id) {
  const data = $.ajax('../utils/load/task/loadTaskManage.php', {
    async: false,
    type: 'post',
    data: {
      dataID: id,
    },
  });
  return data.responseText;
}

function getColumnManagePopup(id) {
  const data = $.ajax('../utils/load/board/loadColumnManage.php', {
    async: false,
    type: 'post',
    data: {
      boardID: id,
    },
  });
  return data.responseText;
}

function getDeletePopup(id, title, msg, reason) {
  closeAnyPopup();
  const data = $.ajax('../utils/load/other/loadDeletePopup.php', {
    async: false,
    type: 'post',
    data: {
      id,
      title,
      msg,
      reason,
    },
  });
  body.insertAdjacentHTML('beforeend', data.responseText);
  popupModalSettings();
}
