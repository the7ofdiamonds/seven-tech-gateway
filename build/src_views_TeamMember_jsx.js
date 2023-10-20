"use strict";
(self["webpackChunkseven_tech"] = self["webpackChunkseven_tech"] || []).push([["src_views_TeamMember_jsx"],{

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

/***/ "./src/views/TeamMember.jsx":
/*!**********************************!*\
  !*** ./src/views/TeamMember.jsx ***!
  \**********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_router_dom__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! react-router-dom */ "./node_modules/react-router/dist/index.js");
/* harmony import */ var react_redux__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-redux */ "./node_modules/react-redux/es/index.js");
/* harmony import */ var _controllers_teamSlice__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../controllers/teamSlice */ "./src/controllers/teamSlice.js");
/* harmony import */ var _loading_LoadingComponent__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../loading/LoadingComponent */ "./src/loading/LoadingComponent.jsx");
/* harmony import */ var _error_ErrorComponent__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../error/ErrorComponent */ "./src/error/ErrorComponent.jsx");
/* harmony import */ var _components_MemberNavigationComponent__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/MemberNavigationComponent */ "./src/views/components/MemberNavigationComponent.jsx");
/* harmony import */ var _components_MemberProgrammingSkillsComponent__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/MemberProgrammingSkillsComponent */ "./src/views/components/MemberProgrammingSkillsComponent.jsx");
/* harmony import */ var _components_MemberIntroductionComponent__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./components/MemberIntroductionComponent */ "./src/views/components/MemberIntroductionComponent.jsx");









function TeamMember() {
  var _useParams = (0,react_router_dom__WEBPACK_IMPORTED_MODULE_8__.useParams)(),
    teammember = _useParams.teammember;
  var dispatch = (0,react_redux__WEBPACK_IMPORTED_MODULE_1__.useDispatch)();
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    dispatch((0,_controllers_teamSlice__WEBPACK_IMPORTED_MODULE_2__.getTeamMember)(teammember));
  }, [dispatch, teammember]);
  var _useSelector = (0,react_redux__WEBPACK_IMPORTED_MODULE_1__.useSelector)(function (state) {
      return state.team;
    }),
    teamLoading = _useSelector.teamLoading,
    teamError = _useSelector.teamError,
    title = _useSelector.title,
    avatarURL = _useSelector.avatarURL,
    fullName = _useSelector.fullName,
    greeting = _useSelector.greeting,
    skills = _useSelector.skills,
    teamResume = _useSelector.teamResume;
  if (teamLoading) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_loading_LoadingComponent__WEBPACK_IMPORTED_MODULE_3__["default"], null);
  }
  if (teamError) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_error_ErrorComponent__WEBPACK_IMPORTED_MODULE_4__["default"], {
      error: teamError
    });
  }
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("section", {
    className: "team-member"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_components_MemberNavigationComponent__WEBPACK_IMPORTED_MODULE_5__["default"], {
    resume: teamResume
  }), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("main", {
    "class": "founder"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_components_MemberIntroductionComponent__WEBPACK_IMPORTED_MODULE_7__["default"], {
    title: title,
    avatarURL: avatarURL,
    fullName: fullName,
    greeting: greeting
  })), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_components_MemberProgrammingSkillsComponent__WEBPACK_IMPORTED_MODULE_6__["default"], {
    skills: skills
  }));
}
/* harmony default export */ __webpack_exports__["default"] = (TeamMember);

/***/ }),

/***/ "./src/views/components/MemberIntroductionComponent.jsx":
/*!**************************************************************!*\
  !*** ./src/views/components/MemberIntroductionComponent.jsx ***!
  \**************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

function MemberIntroductionComponent(props) {
  var title = props.title,
    avatarURL = props.avatarURL,
    fullName = props.fullName,
    greeting = props.greeting;
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    "class": "author-intro"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    "class": "author"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("h2", {
    "class": "title"
  }, title), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    "class": "author-card card"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    "class": "author-pic"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("img", {
    src: avatarURL,
    alt: ""
  }))), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("h4", {
    "class": "title"
  }, fullName)), /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    "class": "author-card card"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("p", {
    "class": "author-greeting"
  }, greeting)));
}
/* harmony default export */ __webpack_exports__["default"] = (MemberIntroductionComponent);

/***/ }),

/***/ "./src/views/components/MemberNavigationComponent.jsx":
/*!************************************************************!*\
  !*** ./src/views/components/MemberNavigationComponent.jsx ***!
  \************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
function MemberNavigationComponent(props) {
  var resume = props.resume;
  var portfolioElement = document.getElementById('portfolio');
  var scrollToSection = function scrollToSection(sectionId) {
    var section = document.getElementById(sectionId);
    if (section) {
      var offsetTopPx = section.getBoundingClientRect().top + window.scrollY;
      var paddingTopPx = 137.5;
      var rootFontSize = parseFloat(getComputedStyle(document.documentElement).fontSize);
      var paddingTopRem = paddingTopPx / 16;
      var paddingTopBackToPx = paddingTopRem * rootFontSize;
      var topPx = offsetTopPx - paddingTopBackToPx;
      window.scrollTo({
        top: topPx,
        behavior: 'smooth'
      });
    }
  };
  var openResumeInNewTab = function openResumeInNewTab() {
    window.open('resume', '_blank');
  };
  return /*#__PURE__*/React.createElement("nav", {
    "class": "author-nav"
  }, portfolioElement ? /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement("button", {
    onClick: scrollToSection('intro'),
    id: "founder_button"
  }, /*#__PURE__*/React.createElement("h3", {
    className: "title"
  }, "intro")), /*#__PURE__*/React.createElement("button", {
    onClick: scrollToSection('7tech_portfolio'),
    id: "portfolio_button"
  }, /*#__PURE__*/React.createElement("h3", {
    className: "title"
  }, "PORTFOLIO"))) : '', resume ? /*#__PURE__*/React.createElement("button", {
    onClick: openResumeInNewTab
  }, /*#__PURE__*/React.createElement("h3", {
    className: "title"
  }, "R\xC9SUM\xC9")) : '');
}
/* harmony default export */ __webpack_exports__["default"] = (MemberNavigationComponent);

/***/ }),

/***/ "./src/views/components/MemberProgrammingSkillsComponent.jsx":
/*!*******************************************************************!*\
  !*** ./src/views/components/MemberProgrammingSkillsComponent.jsx ***!
  \*******************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

function MemberProgrammingSkillsComponent(props) {
  var skills = props.skills;
  var skillsSlideRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(function () {
    var skillsSlide = skillsSlideRef.current;
    if (skillsSlide) {
      var totalSkills = skillsSlide.children.length;
      for (var i = 0; i < totalSkills; i++) {
        skillsSlide.appendChild(skillsSlide.children[i].cloneNode(true));
      }
      document.documentElement.style.setProperty('--total-skills', totalSkills);
    }
  }, [skills]);
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement((react__WEBPACK_IMPORTED_MODULE_0___default().Fragment), null, Array.isArray(skills) && skills.length > 0 ? /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "author-skills"
  }, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("div", {
    className: "author-skills-slide",
    ref: skillsSlideRef
  }, skills.map(function (skill, index) {
    return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement("i", {
      key: index,
      className: "fa-brands fa-".concat(skill.toLowerCase())
    });
  }))) : null);
}
/* harmony default export */ __webpack_exports__["default"] = (MemberProgrammingSkillsComponent);

/***/ })

}]);
//# sourceMappingURL=src_views_TeamMember_jsx.js.map