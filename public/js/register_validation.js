/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/validations/register_validation.js":
/*!*********************************************************!*\
  !*** ./resources/js/validations/register_validation.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var form = document.getElementById('form');
var username = document.getElementById('name');
var userError = document.getElementById('user-error');
var email = document.getElementById('email');
var emailError = document.getElementById('email-error');
var password = document.getElementById('password');
var pwError = document.getElementById('pw-error');
var passwordConfirm = document.getElementById('password-confirm');
var pwCheckError = document.getElementById('pwcheck-error');
form.addEventListener('submit', function (e) {
  var userValid = true;
  var emailValid = true;
  var pwValid = true;
  var pwCheckValid = true;
  if (!isNaN(username.value) || username.value.length < 3 || username.value.length > 30) {
    userValid = false;
  }
  if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)) {
    emailValid = false;
  }
  if (password.value.length < 8) {
    pwValid = false;
  }
  if (passwordConfirm.value !== password.value) {
    pwCheckValid = false;
  }
  userValid ? (userError.className = 'd-none', username.classList.remove('border-danger')) : (userError.className = 'text-danger error', username.classList.add('border-danger'));
  emailValid ? (emailError.className = 'd-none', email.classList.remove('border-danger')) : (emailError.className = 'text-danger error', email.classList.add('border-danger'));
  pwValid ? (pwError.className = 'd-none', password.classList.remove('border-danger')) : (pwError.className = 'text-danger error', password.classList.add('border-danger'));
  pwCheckValid ? (pwCheckError.className = 'd-none', passwordConfirm.classList.remove('border-danger')) : (pwCheckError.className = 'text-danger error', passwordConfirm.classList.add('border-danger'));
  if (!(userValid && emailValid && pwValid && pwCheckValid)) e.preventDefault();
});

/***/ }),

/***/ 1:
/*!***************************************************************!*\
  !*** multi ./resources/js/validations/register_validation.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/daniel-andrei.sorescu/Desktop/project/team-4-project/resources/js/validations/register_validation.js */"./resources/js/validations/register_validation.js");


/***/ })

/******/ });