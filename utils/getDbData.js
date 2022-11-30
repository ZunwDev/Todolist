function getColorCode(id) {
  let data = $.ajax("./utils/scripts/getColor.php", {
    async: false,
    type: "POST",
    data: {
      projectID: id,
    },
  });
  return data.responseText;
}

function getProjectName(id) {
  let data = $.ajax("./utils/scripts/getProjectName.php", {
    async: false,
    type: "POST",
    data: {
      projectID: id,
    },
  });
  return data.responseText;
}

function getProjectIdFromBoardId(id) {
  let data = $.ajax("../utils/scripts/getProjectIdFromBoardId.php", {
    async: false,
    type: "POST",
    data: {
      boardID: id,
    },
  });
  return data.responseText;
}

function getProjectIdFromTaskId(id) {
  let data = $.ajax("../utils/scripts/getProjectIdFromTaskId.php", {
    async: false,
    type: "POST",
    data: {
      taskID: id,
    },
  });
  return data.responseText;
}

function getBoardData(id) {
  let data = $.ajax("../utils/loadBoards.php", {
    async: false,
    type: "post",
    data: {
      projectID: id,
    },
  });
  return data.responseText;
}

function getProjectEditPopup(id) {
  let data = $.ajax("../utils/loadProjectEdit.php", {
    async: false,
    type: "POST",
    data: {
      projectID: id,
    },
  });
  return data.responseText;
}

function getColumnEditPopup(id) {
  let data = $.ajax("../utils/loadColumnEdit.php", {
    async: false,
    type: "post",
    data: {
      boardID: id,
    },
  });
  return data.responseText;
}

function getCheckState(id) {
  const data = $.ajax("../utils/scripts/getCheckStatus.php", {
    async: false,
    type: "POST",
    data: {
      dataID: id,
    },
  });
  return data.responseText;
}

function getTaskEditPopup(id) {
  const data = $.ajax("../utils/loadTaskEditPopup.php", {
    async: false,
    type: "post",
    data: {
      dataID: id,
    },
  });
  return data.responseText;
}

function getPriorityListPopup() {
  const data = $.ajax("../utils/loadPriorityList.php", {
    async: false,
    type: "post",
  });
  return data.responseText;
}

function getTaskManagePopup(id) {
  const data = $.ajax("../utils/loadTaskManage.php", {
    async: false,
    type: "post",
    data: {
      dataID: id,
    },
  });
  return data.responseText;
}

function getColorSelect() {
  const data = $.ajax("./utils/loadColors.php", {
    async: false,
    type: "post",
    data: {},
  });
  return data.responseText;
}