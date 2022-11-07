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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/validations/edit_validation.js":
/*!*****************************************************!*\
  !*** ./resources/js/validations/edit_validation.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var form = document.getElementById('edit-form');
var username = document.getElementById('username');
var userError = document.getElementById('user-error');
var firstName = document.getElementById('first_name');
var fnError = document.getElementById('fn-error');
var lastName = document.getElementById('last_name');
var lnError = document.getElementById('ln-error');
var addressChoice = document.getElementById('address');
var addressError = document.getElementById('address-error');
var specializations = document.querySelectorAll('.form-check-input');
var specBtn = document.getElementById('spec-button');
var specError = document.getElementById('spec-error');
var phone = document.getElementById('phone');
var phoneError = document.getElementById('phone-error');
function checkTheBox() {
  var flag = 0;
  for (var i = 0; i < specializations.length; i++) {
    console.log(specializations[i]);
    if (form["specs[]"][i].checked) {
      flag++;
    }
  }
  if (!flag) {
    return false;
  }
  return true;
}
form.addEventListener('submit', function (e) {
  var userValid = true;
  var fnValid = true;
  var lnValid = true;
  var addressValid = true;
  var specValid = true;
  var phoneValid = true;
  if (!isNaN(username.value) || username.value.length < 3 || username.value.length > 30) {
    userValid = false;
  }
  if (!isNaN(firstName.value) || firstName.value.length < 3 || firstName.value.length > 30) {
    fnValid = false;
  }
  if (!isNaN(lastName.value) || lastName.value.length < 3 || lastName.value.length > 30) {
    lnValid = false;
  }
  if (!addressChoice.value) {
    addressValid = false;
  }
  if (!checkTheBox()) {
    specValid = false;
  }
  if (!(/^((00|\+)39[\. ]??)??3\d{2}[\. ]??\d{6,7}$/.test(phone.value) || !phone.value)) {
    phoneValid = false;
  }
  userValid ? (userError.className = 'd-none', username.classList.remove('border-danger')) : (userError.className = 'text-danger', username.classList.add('border-danger'));
  fnValid ? (fnError.className = 'd-none', firstName.classList.remove('border-danger')) : (fnError.className = 'text-danger', firstName.classList.add('border-danger'));
  lnValid ? (lnError.className = 'd-none', lastName.classList.remove('border-danger')) : (lnError.className = 'text-danger', lastName.classList.add('border-danger'));
  addressValid ? (addressError.className = 'd-none', addressChoice.classList.remove('border-danger')) : (addressError.className = 'text-danger', addressChoice.classList.add('border-danger'));
  specValid ? (specError.className = 'd-none', specBtn.classList.remove('border-danger')) : (specError.className = 'text-danger', specBtn.classList.add('border-danger'));
  phoneValid ? (phoneError.className = 'd-none', phone.classList.remove('border-danger')) : (phoneError.className = 'text-danger', phone.classList.add('border-danger'));
  if (!(userValid && fnValid && lnValid && addressValid && specValid && phoneValid)) e.preventDefault();
});

/***/ }),

/***/ 3:
/*!***********************************************************!*\
  !*** multi ./resources/js/validations/edit_validation.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/daniel-andrei.sorescu/Desktop/project/team-4-project/resources/js/validations/edit_validation.js */"./resources/js/validations/edit_validation.js");


/***/ })

/******/ });