"use strict";
(self["webpackChunkseven_tech"] = self["webpackChunkseven_tech"] || []).push([["src_views_Founder_jsx"],{

/***/ "./src/views/Founder.jsx":
/*!*******************************!*\
  !*** ./src/views/Founder.jsx ***!
  \*******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _components_MemberNavigationComponent__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/MemberNavigationComponent */ "./src/views/components/MemberNavigationComponent.jsx");


function Founder() {
  return /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement((react__WEBPACK_IMPORTED_MODULE_0___default().Fragment), null, /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().createElement(_components_MemberNavigationComponent__WEBPACK_IMPORTED_MODULE_1__["default"], null));
}
/* harmony default export */ __webpack_exports__["default"] = (Founder);

/***/ }),

/***/ "./src/views/components/MemberNavigationComponent.jsx":
/*!************************************************************!*\
  !*** ./src/views/components/MemberNavigationComponent.jsx ***!
  \************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);

function MemberNavigationComponent() {
  var founderSection = document.getElementById('founder');
  var portfolioElement = document.getElementById('portfolio');
  var portfolioButton = document.getElementById('portfolio_button');
  var founderButton = document.getElementById('founder_button');
  function updateButtonVisibility(currentSectionId) {
    if (currentSectionId === 'founder') {
      founderButton.style.display = 'none';
      portfolioButton.style.display = 'block';
    } else if (currentSectionId === '7tech_portfolio') {
      portfolioButton.style.display = 'none';
      founderButton.style.display = 'block';
    }
  }

  // Button press
  var scrollToSection = function scrollToSection(sectionId) {
    var section = document.getElementById(sectionId);
    console.log(section);
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
    window.location.href = 'resume';
    console.log('resume');
  };
  return /*#__PURE__*/React.createElement("nav", {
    "class": "author-nav"
  }, /*#__PURE__*/React.createElement("button", {
    onClick: scrollToSection('founder'),
    id: "founder_button"
  }, /*#__PURE__*/React.createElement("h3", null, "FOUNDER")), /*#__PURE__*/React.createElement("button", {
    onClick: scrollToSection('7tech_portfolio'),
    id: "portfolio_button"
  }, /*#__PURE__*/React.createElement("h3", null, "PORTFOLIO")), /*#__PURE__*/React.createElement("button", {
    onClick: openResumeInNewTab
  }, /*#__PURE__*/React.createElement("h3", null, "R\xC9SUM\xC9")));
}
/* harmony default export */ __webpack_exports__["default"] = (MemberNavigationComponent);

/***/ })

}]);
//# sourceMappingURL=src_views_Founder_jsx.js.map