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

/***/ "./resources/js/router.js":
/*!********************************!*\
  !*** ./resources/js/router.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: C:\\laravel\\team-4-project\\resources\\js\\router.js: Identifier 'HomePage' has already been declared. (15:7)\n\n\u001b[0m \u001b[90m 13 |\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 14 |\u001b[39m \u001b[90m// rotte\u001b[39m\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 15 |\u001b[39m \u001b[36mimport\u001b[39m \u001b[33mHomePage\u001b[39m \u001b[36mfrom\u001b[39m \u001b[32m'./components/pages/HomePage'\u001b[39m\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m    |\u001b[39m        \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 16 |\u001b[39m \u001b[36mimport\u001b[39m \u001b[33mAdvancedResearch\u001b[39m \u001b[36mfrom\u001b[39m \u001b[32m'./components/pages/AdvancedResearch'\u001b[39m\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 17 |\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 18 |\u001b[39m \u001b[90m// istanziamo VueRouter\u001b[39m\u001b[0m\n    at instantiate (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:72:32)\n    at constructor (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:367:12)\n    at Parser.raise (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:3706:19)\n    at ScopeHandler.checkRedeclarationInScope (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:1657:19)\n    at ScopeHandler.declareName (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:1623:12)\n    at Parser.declareNameFromIdentifier (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:12375:16)\n    at Parser.checkIdentifier (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:12370:12)\n    at Parser.checkLVal (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:12296:12)\n    at Parser.finishImportSpecifier (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:16590:10)\n    at Parser.parseImportSpecifierLocal (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:16586:31)\n    at Parser.maybeParseDefaultImportSpecifier (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:16702:12)\n    at Parser.parseImport (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:16550:31)\n    at Parser.parseStatementContent (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:14981:27)\n    at Parser.parseStatement (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:14871:17)\n    at Parser.parseBlockOrModuleBlockBody (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:15531:25)\n    at Parser.parseBlockBody (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:15522:10)\n    at Parser.parseProgram (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:14785:10)\n    at Parser.parseTopLevel (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:14772:25)\n    at Parser.parse (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:16799:10)\n    at parse (C:\\laravel\\team-4-project\\node_modules\\@babel\\parser\\lib\\index.js:16851:38)\n    at parser (C:\\laravel\\team-4-project\\node_modules\\@babel\\core\\lib\\parser\\index.js:52:34)\n    at parser.next (<anonymous>)\n    at normalizeFile (C:\\laravel\\team-4-project\\node_modules\\@babel\\core\\lib\\transformation\\normalize-file.js:87:38)\n    at normalizeFile.next (<anonymous>)\n    at run (C:\\laravel\\team-4-project\\node_modules\\@babel\\core\\lib\\transformation\\index.js:31:50)\n    at run.next (<anonymous>)\n    at transform (C:\\laravel\\team-4-project\\node_modules\\@babel\\core\\lib\\transform.js:29:41)\n    at transform.next (<anonymous>)\n    at step (C:\\laravel\\team-4-project\\node_modules\\gensync\\index.js:261:32)\n    at C:\\laravel\\team-4-project\\node_modules\\gensync\\index.js:273:13\n    at async.call.result.err.err (C:\\laravel\\team-4-project\\node_modules\\gensync\\index.js:223:11)\n    at C:\\laravel\\team-4-project\\node_modules\\gensync\\index.js:189:28\n    at C:\\laravel\\team-4-project\\node_modules\\@babel\\core\\lib\\gensync-utils\\async.js:84:7\n    at C:\\laravel\\team-4-project\\node_modules\\gensync\\index.js:113:33\n    at step (C:\\laravel\\team-4-project\\node_modules\\gensync\\index.js:287:14)\n    at C:\\laravel\\team-4-project\\node_modules\\gensync\\index.js:273:13\n    at async.call.result.err.err (C:\\laravel\\team-4-project\\node_modules\\gensync\\index.js:223:11)");

/***/ }),

/***/ 3:
/*!**************************************!*\
  !*** multi ./resources/js/router.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laravel\team-4-project\resources\js\router.js */"./resources/js/router.js");


/***/ })

/******/ });