"use strict";
(self["webpackChunkseven_tech"] = self["webpackChunkseven_tech"] || []).push([["src_views_About_jsx"],{

/***/ "./src/views/About.jsx":
/*!*****************************!*\
  !*** ./src/views/About.jsx ***!
  \*****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_redux__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-redux */ "./node_modules/react-redux/es/index.js");
/* harmony import */ var _views_components_ContentComponent__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../views/components/ContentComponent */ "./src/views/components/ContentComponent.jsx");
/* harmony import */ var _controllers_contentSlice__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../controllers/contentSlice */ "./src/controllers/contentSlice.js");




function About() {
  var dispatch = (0,react_redux__WEBPACK_IMPORTED_MODULE_1__.useDispatch)();
  var missionStatement = 'Turning ideas into tangible assets ';
  var _useSelector = (0,react_redux__WEBPACK_IMPORTED_MODULE_1__.useSelector)(function (state) {
      return state.content;
    }),
    content = _useSelector.content;
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    dispatch((0,_controllers_contentSlice__WEBPACK_IMPORTED_MODULE_3__.getContent)('about'));
  }, [dispatch]);
  console.log(content);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement((react__WEBPACK_IMPORTED_MODULE_0___default().Fragment), null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("h2", null, "ABOUT"), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    "class": "mission-statement-card card"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("h4", {
    "class": "mission-statement"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("q", null, missionStatement))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_views_components_ContentComponent__WEBPACK_IMPORTED_MODULE_2__["default"], {
    content: content
  }));
}
/* harmony default export */ __webpack_exports__["default"] = (About);

/***/ }),

/***/ "./src/views/components/ContentComponent.jsx":
/*!***************************************************!*\
  !*** ./src/views/components/ContentComponent.jsx ***!
  \***************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

function ContentComponent(props) {
  var content = props.content;
  console.log(content);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement((react__WEBPACK_IMPORTED_MODULE_0___default().Fragment), null, content ? content.map(function (paragraph, index) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
      key: index,
      className: "card",
      dangerouslySetInnerHTML: {
        __html: paragraph
      }
    });
  }) : null);
}
/* harmony default export */ __webpack_exports__["default"] = (ContentComponent);

/***/ })

}]);
//# sourceMappingURL=src_views_About_jsx.js.map