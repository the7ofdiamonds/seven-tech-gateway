"use strict";
(self["webpackChunkthfw_users"] = self["webpackChunkthfw_users"] || []).push([["src_views_Team_jsx"],{

/***/ "./src/components/TeamMember.jsx":
/*!***************************************!*\
  !*** ./src/components/TeamMember.jsx ***!
  \***************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function TeamMember(props) {
  var team_member = props.team_member;
  return /*#__PURE__*/React.createElement(React.Fragment, null, team_member && _typeof(team_member) === 'object' ? /*#__PURE__*/React.createElement("div", {
    "class": "author-card card"
  }, /*#__PURE__*/React.createElement("div", {
    className: "author-pic"
  }, /*#__PURE__*/React.createElement("a", {
    href: team_member.author_url
  }, /*#__PURE__*/React.createElement("img", {
    src: team_member.avatar_url,
    alt: ""
  }))), /*#__PURE__*/React.createElement("div", {
    "class": "author-name"
  }, /*#__PURE__*/React.createElement("h4", {
    className: "title"
  }, team_member.first_name, " ", team_member.last_name)), /*#__PURE__*/React.createElement("div", {
    "class": "author-role"
  }, /*#__PURE__*/React.createElement("h5", null, team_member.role)), /*#__PURE__*/React.createElement("div", {
    "class": "author-contact"
  }, /*#__PURE__*/React.createElement("a", {
    href: "mailto:".concat(team_member.email)
  }, /*#__PURE__*/React.createElement("i", {
    className: "fa fa-envelope fa-fw"
  })))) : '');
}
/* harmony default export */ __webpack_exports__["default"] = (TeamMember);

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
/* harmony import */ var _components_TeamMember__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../components/TeamMember */ "./src/components/TeamMember.jsx");




function Team() {
  var _useSelector = (0,react_redux__WEBPACK_IMPORTED_MODULE_1__.useSelector)(function (state) {
      return state.team;
    }),
    loading = _useSelector.loading,
    error = _useSelector.error,
    team = _useSelector.team;
  var dispatch = (0,react_redux__WEBPACK_IMPORTED_MODULE_1__.useDispatch)();
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    dispatch((0,_controllers_teamSlice__WEBPACK_IMPORTED_MODULE_2__.getTeam)());
  }, [dispatch]);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement((react__WEBPACK_IMPORTED_MODULE_0___default().Fragment), null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("h4", {
    className: "title"
  }, "Team"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "team"
  }, Array.isArray(team) && team.length > 0 ? team.map(function (team_member) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement((react__WEBPACK_IMPORTED_MODULE_0___default().Fragment), null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_components_TeamMember__WEBPACK_IMPORTED_MODULE_3__["default"], {
      team_member: team_member
    }));
  }) : ''));
}
/* harmony default export */ __webpack_exports__["default"] = (Team);

/***/ })

}]);
//# sourceMappingURL=src_views_Team_jsx.js.map