"use strict";
(self["webpackChunkseven_tech"] = self["webpackChunkseven_tech"] || []).push([["src_views_Team_jsx"],{

/***/ "./src/error/ErrorComponent.jsx":
/*!**************************************!*\
  !*** ./src/error/ErrorComponent.jsx ***!
  \**************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
function ErrorComponent(props) {
  var error = props.error;
  return /*#__PURE__*/React.createElement("main", {
    className: "error"
  }, /*#__PURE__*/React.createElement("div", {
    className: "status-bar card error"
  }, /*#__PURE__*/React.createElement("span", null, error)));
}
/* harmony default export */ __webpack_exports__["default"] = (ErrorComponent);

/***/ }),

/***/ "./src/views/Team.jsx":
/*!****************************!*\
  !*** ./src/views/Team.jsx ***!
  \****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_redux__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-redux */ "./node_modules/react-redux/es/index.js");
/* harmony import */ var _controllers_teamSlice__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../controllers/teamSlice */ "./src/controllers/teamSlice.js");
/* harmony import */ var _loading_LoadingComponent__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../loading/LoadingComponent */ "./src/loading/LoadingComponent.jsx");
/* harmony import */ var _error_ErrorComponent__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../error/ErrorComponent */ "./src/error/ErrorComponent.jsx");
/* harmony import */ var _components_GroupMembers__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/GroupMembers */ "./src/views/components/GroupMembers.jsx");






function Team() {
  var _useSelector = (0,react_redux__WEBPACK_IMPORTED_MODULE_1__.useSelector)(function (state) {
      return state.team;
    }),
    teamLoading = _useSelector.teamLoading,
    teamError = _useSelector.teamError,
    team = _useSelector.team;
  var dispatch = (0,react_redux__WEBPACK_IMPORTED_MODULE_1__.useDispatch)();
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    dispatch((0,_controllers_teamSlice__WEBPACK_IMPORTED_MODULE_2__.getTeam)());
  }, [dispatch]);
  if (teamLoading) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_loading_LoadingComponent__WEBPACK_IMPORTED_MODULE_3__["default"], null);
  }
  if (teamError) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_error_ErrorComponent__WEBPACK_IMPORTED_MODULE_4__["default"], {
      error: teamError
    });
  }
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement((react__WEBPACK_IMPORTED_MODULE_0___default().Fragment), null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("section", {
    className: "team"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("h4", {
    className: "title"
  }, "Team"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_components_GroupMembers__WEBPACK_IMPORTED_MODULE_5__["default"], {
    group: team
  })));
}
/* harmony default export */ __webpack_exports__["default"] = (Team);

/***/ }),

/***/ "./src/views/components/GroupMembers.jsx":
/*!***********************************************!*\
  !*** ./src/views/components/GroupMembers.jsx ***!
  \***********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function GroupMembers(props) {
  var group = props.group;
  return /*#__PURE__*/React.createElement(React.Fragment, null, Array.isArray(group) && group.length > 0 ? group.map(function (group_member) {
    return /*#__PURE__*/React.createElement("div", {
      className: "group"
    }, group_member && _typeof(group_member) === 'object' ? /*#__PURE__*/React.createElement("div", {
      "class": "author-card card"
    }, /*#__PURE__*/React.createElement("div", {
      className: "author-pic"
    }, /*#__PURE__*/React.createElement("a", {
      href: group_member.author_url
    }, /*#__PURE__*/React.createElement("img", {
      src: group_member.avatar_url,
      alt: ""
    }))), /*#__PURE__*/React.createElement("div", {
      "class": "author-name"
    }, /*#__PURE__*/React.createElement("h4", {
      className: "title"
    }, group_member.first_name, " ", group_member.last_name)), /*#__PURE__*/React.createElement("div", {
      "class": "author-role"
    }, /*#__PURE__*/React.createElement("h5", null, group_member.role)), /*#__PURE__*/React.createElement("div", {
      "class": "author-contact"
    }, /*#__PURE__*/React.createElement("a", {
      href: "mailto:".concat(group_member.email)
    }, /*#__PURE__*/React.createElement("i", {
      className: "fa fa-envelope fa-fw"
    })))) : '');
  }) : '');
}
/* harmony default export */ __webpack_exports__["default"] = (GroupMembers);

/***/ })

}]);
//# sourceMappingURL=src_views_Team_jsx.js.map