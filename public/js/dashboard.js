/*!
 * jQuery JavaScript Library v2.1.4
 * http://jquery.com/
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 *
 * Copyright 2005, 2014 jQuery Foundation, Inc. and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2015-04-28T16:01Z
 */

(function( global, factory ) {

	if ( typeof module === "object" && typeof module.exports === "object" ) {
		// For CommonJS and CommonJS-like environments where a proper `window`
		// is present, execute the factory and get jQuery.
		// For environments that do not have a `window` with a `document`
		// (such as Node.js), expose a factory as module.exports.
		// This accentuates the need for the creation of a real `window`.
		// e.g. var jQuery = require("jquery")(window);
		// See ticket #14549 for more info.
		module.exports = global.document ?
			factory( global, true ) :
			function( w ) {
				if ( !w.document ) {
					throw new Error( "jQuery requires a window with a document" );
				}
				return factory( w );
			};
	} else {
		factory( global );
	}

// Pass this if window is not defined yet
}(typeof window !== "undefined" ? window : this, function( window, noGlobal ) {

// Support: Firefox 18+
// Can't be in strict mode, several libs including ASP.NET trace
// the stack via arguments.caller.callee and Firefox dies if
// you try to trace through "use strict" call chains. (#13335)
//

var arr = [];

var slice = arr.slice;

var concat = arr.concat;

var push = arr.push;

var indexOf = arr.indexOf;

var class2type = {};

var toString = class2type.toString;

var hasOwn = class2type.hasOwnProperty;

var support = {};



var
	// Use the correct document accordingly with window argument (sandbox)
	document = window.document,

	version = "2.1.4",

	// Define a local copy of jQuery
	jQuery = function( selector, context ) {
		// The jQuery object is actually just the init constructor 'enhanced'
		// Need init if jQuery is called (just allow error to be thrown if not included)
		return new jQuery.fn.init( selector, context );
	},

	// Support: Android<4.1
	// Make sure we trim BOM and NBSP
	rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,

	// Matches dashed string for camelizing
	rmsPrefix = /^-ms-/,
	rdashAlpha = /-([\da-z])/gi,

	// Used by jQuery.camelCase as callback to replace()
	fcamelCase = function( all, letter ) {
		return letter.toUpperCase();
	};

jQuery.fn = jQuery.prototype = {
	// The current version of jQuery being used
	jquery: version,

	constructor: jQuery,

	// Start with an empty selector
	selector: "",

	// The default length of a jQuery object is 0
	length: 0,

	toArray: function() {
		return slice.call( this );
	},

	// Get the Nth element in the matched element set OR
	// Get the whole matched element set as a clean array
	get: function( num ) {
		return num != null ?

			// Return just the one element from the set
			( num < 0 ? this[ num + this.length ] : this[ num ] ) :

			// Return all the elements in a clean array
			slice.call( this );
	},

	// Take an array of elements and push it onto the stack
	// (returning the new matched element set)
	pushStack: function( elems ) {

		// Build a new jQuery matched element set
		var ret = jQuery.merge( this.constructor(), elems );

		// Add the old object onto the stack (as a reference)
		ret.prevObject = this;
		ret.context = this.context;

		// Return the newly-formed element set
		return ret;
	},

	// Execute a callback for every element in the matched set.
	// (You can seed the arguments with an array of args, but this is
	// only used internally.)
	each: function( callback, args ) {
		return jQuery.each( this, callback, args );
	},

	map: function( callback ) {
		return this.pushStack( jQuery.map(this, function( elem, i ) {
			return callback.call( elem, i, elem );
		}));
	},

	slice: function() {
		return this.pushStack( slice.apply( this, arguments ) );
	},

	first: function() {
		return this.eq( 0 );
	},

	last: function() {
		return this.eq( -1 );
	},

	eq: function( i ) {
		var len = this.length,
			j = +i + ( i < 0 ? len : 0 );
		return this.pushStack( j >= 0 && j < len ? [ this[j] ] : [] );
	},

	end: function() {
		return this.prevObject || this.constructor(null);
	},

	// For internal use only.
	// Behaves like an Array's method, not like a jQuery method.
	push: push,
	sort: arr.sort,
	splice: arr.splice
};

jQuery.extend = jQuery.fn.extend = function() {
	var options, name, src, copy, copyIsArray, clone,
		target = arguments[0] || {},
		i = 1,
		length = arguments.length,
		deep = false;

	// Handle a deep copy situation
	if ( typeof target === "boolean" ) {
		deep = target;

		// Skip the boolean and the target
		target = arguments[ i ] || {};
		i++;
	}

	// Handle case when target is a string or something (possible in deep copy)
	if ( typeof target !== "object" && !jQuery.isFunction(target) ) {
		target = {};
	}

	// Extend jQuery itself if only one argument is passed
	if ( i === length ) {
		target = this;
		i--;
	}

	for ( ; i < length; i++ ) {
		// Only deal with non-null/undefined values
		if ( (options = arguments[ i ]) != null ) {
			// Extend the base object
			for ( name in options ) {
				src = target[ name ];
				copy = options[ name ];

				// Prevent never-ending loop
				if ( target === copy ) {
					continue;
				}

				// Recurse if we're merging plain objects or arrays
				if ( deep && copy && ( jQuery.isPlainObject(copy) || (copyIsArray = jQuery.isArray(copy)) ) ) {
					if ( copyIsArray ) {
						copyIsArray = false;
						clone = src && jQuery.isArray(src) ? src : [];

					} else {
						clone = src && jQuery.isPlainObject(src) ? src : {};
					}

					// Never move original objects, clone them
					target[ name ] = jQuery.extend( deep, clone, copy );

				// Don't bring in undefined values
				} else if ( copy !== undefined ) {
					target[ name ] = copy;
				}
			}
		}
	}

	// Return the modified object
	return target;
};

jQuery.extend({
	// Unique for each copy of jQuery on the page
	expando: "jQuery" + ( version + Math.random() ).replace( /\D/g, "" ),

	// Assume jQuery is ready without the ready module
	isReady: true,

	error: function( msg ) {
		throw new Error( msg );
	},

	noop: function() {},

	isFunction: function( obj ) {
		return jQuery.type(obj) === "function";
	},

	isArray: Array.isArray,

	isWindow: function( obj ) {
		return obj != null && obj === obj.window;
	},

	isNumeric: function( obj ) {
		// parseFloat NaNs numeric-cast false positives (null|true|false|"")
		// ...but misinterprets leading-number strings, particularly hex literals ("0x...")
		// subtraction forces infinities to NaN
		// adding 1 corrects loss of precision from parseFloat (#15100)
		return !jQuery.isArray( obj ) && (obj - parseFloat( obj ) + 1) >= 0;
	},

	isPlainObject: function( obj ) {
		// Not plain objects:
		// - Any object or value whose internal [[Class]] property is not "[object Object]"
		// - DOM nodes
		// - window
		if ( jQuery.type( obj ) !== "object" || obj.nodeType || jQuery.isWindow( obj ) ) {
			return false;
		}

		if ( obj.constructor &&
				!hasOwn.call( obj.constructor.prototype, "isPrototypeOf" ) ) {
			return false;
		}

		// If the function hasn't returned already, we're confident that
		// |obj| is a plain object, created by {} or constructed with new Object
		return true;
	},

	isEmptyObject: function( obj ) {
		var name;
		for ( name in obj ) {
			return false;
		}
		return true;
	},

	type: function( obj ) {
		if ( obj == null ) {
			return obj + "";
		}
		// Support: Android<4.0, iOS<6 (functionish RegExp)
		return typeof obj === "object" || typeof obj === "function" ?
			class2type[ toString.call(obj) ] || "object" :
			typeof obj;
	},

	// Evaluates a script in a global context
	globalEval: function( code ) {
		var script,
			indirect = eval;

		code = jQuery.trim( code );

		if ( code ) {
			// If the code includes a valid, prologue position
			// strict mode pragma, execute code by injecting a
			// script tag into the document.
			if ( code.indexOf("use strict") === 1 ) {
				script = document.createElement("script");
				script.text = code;
				document.head.appendChild( script ).parentNode.removeChild( script );
			} else {
			// Otherwise, avoid the DOM node creation, insertion
			// and removal by using an indirect global eval
				indirect( code );
			}
		}
	},

	// Convert dashed to camelCase; used by the css and data modules
	// Support: IE9-11+
	// Microsoft forgot to hump their vendor prefix (#9572)
	camelCase: function( string ) {
		return string.replace( rmsPrefix, "ms-" ).replace( rdashAlpha, fcamelCase );
	},

	nodeName: function( elem, name ) {
		return elem.nodeName && elem.nodeName.toLowerCase() === name.toLowerCase();
	},

	// args is for internal usage only
	each: function( obj, callback, args ) {
		var value,
			i = 0,
			length = obj.length,
			isArray = isArraylike( obj );

		if ( args ) {
			if ( isArray ) {
				for ( ; i < length; i++ ) {
					value = callback.apply( obj[ i ], args );

					if ( value === false ) {
						break;
					}
				}
			} else {
				for ( i in obj ) {
					value = callback.apply( obj[ i ], args );

					if ( value === false ) {
						break;
					}
				}
			}

		// A special, fast, case for the most common use of each
		} else {
			if ( isArray ) {
				for ( ; i < length; i++ ) {
					value = callback.call( obj[ i ], i, obj[ i ] );

					if ( value === false ) {
						break;
					}
				}
			} else {
				for ( i in obj ) {
					value = callback.call( obj[ i ], i, obj[ i ] );

					if ( value === false ) {
						break;
					}
				}
			}
		}

		return obj;
	},

	// Support: Android<4.1
	trim: function( text ) {
		return text == null ?
			"" :
			( text + "" ).replace( rtrim, "" );
	},

	// results is for internal usage only
	makeArray: function( arr, results ) {
		var ret = results || [];

		if ( arr != null ) {
			if ( isArraylike( Object(arr) ) ) {
				jQuery.merge( ret,
					typeof arr === "string" ?
					[ arr ] : arr
				);
			} else {
				push.call( ret, arr );
			}
		}

		return ret;
	},

	inArray: function( elem, arr, i ) {
		return arr == null ? -1 : indexOf.call( arr, elem, i );
	},

	merge: function( first, second ) {
		var len = +second.length,
			j = 0,
			i = first.length;

		for ( ; j < len; j++ ) {
			first[ i++ ] = second[ j ];
		}

		first.length = i;

		return first;
	},

	grep: function( elems, callback, invert ) {
		var callbackInverse,
			matches = [],
			i = 0,
			length = elems.length,
			callbackExpect = !invert;

		// Go through the array, only saving the items
		// that pass the validator function
		for ( ; i < length; i++ ) {
			callbackInverse = !callback( elems[ i ], i );
			if ( callbackInverse !== callbackExpect ) {
				matches.push( elems[ i ] );
			}
		}

		return matches;
	},

	// arg is for internal usage only
	map: function( elems, callback, arg ) {
		var value,
			i = 0,
			length = elems.length,
			isArray = isArraylike( elems ),
			ret = [];

		// Go through the array, translating each of the items to their new values
		if ( isArray ) {
			for ( ; i < length; i++ ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}

		// Go through every key on the object,
		} else {
			for ( i in elems ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}
		}

		// Flatten any nested arrays
		return concat.apply( [], ret );
	},

	// A global GUID counter for objects
	guid: 1,

	// Bind a function to a context, optionally partially applying any
	// arguments.
	proxy: function( fn, context ) {
		var tmp, args, proxy;

		if ( typeof context === "string" ) {
			tmp = fn[ context ];
			context = fn;
			fn = tmp;
		}

		// Quick check to determine if target is callable, in the spec
		// this throws a TypeError, but we will just return undefined.
		if ( !jQuery.isFunction( fn ) ) {
			return undefined;
		}

		// Simulated bind
		args = slice.call( arguments, 2 );
		proxy = function() {
			return fn.apply( context || this, args.concat( slice.call( arguments ) ) );
		};

		// Set the guid of unique handler to the same of original handler, so it can be removed
		proxy.guid = fn.guid = fn.guid || jQuery.guid++;

		return proxy;
	},

	now: Date.now,

	// jQuery.support is not used in Core but other projects attach their
	// properties to it so it needs to exist.
	support: support
});

// Populate the class2type map
jQuery.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(i, name) {
	class2type[ "[object " + name + "]" ] = name.toLowerCase();
});

function isArraylike( obj ) {

	// Support: iOS 8.2 (not reproducible in simulator)
	// `in` check used to prevent JIT error (gh-2145)
	// hasOwn isn't used here due to false negatives
	// regarding Nodelist length in IE
	var length = "length" in obj && obj.length,
		type = jQuery.type( obj );

	if ( type === "function" || jQuery.isWindow( obj ) ) {
		return false;
	}

	if ( obj.nodeType === 1 && length ) {
		return true;
	}

	return type === "array" || length === 0 ||
		typeof length === "number" && length > 0 && ( length - 1 ) in obj;
}
var Sizzle =
/*!
 * Sizzle CSS Selector Engine v2.2.0-pre
 * http://sizzlejs.com/
 *
 * Copyright 2008, 2014 jQuery Foundation, Inc. and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2014-12-16
 */
(function( window ) {

var i,
	support,
	Expr,
	getText,
	isXML,
	tokenize,
	compile,
	select,
	outermostContext,
	sortInput,
	hasDuplicate,

	// Local document vars
	setDocument,
	document,
	docElem,
	documentIsHTML,
	rbuggyQSA,
	rbuggyMatches,
	matches,
	contains,

	// Instance-specific data
	expando = "sizzle" + 1 * new Date(),
	preferredDoc = window.document,
	dirruns = 0,
	done = 0,
	classCache = createCache(),
	tokenCache = createCache(),
	compilerCache = createCache(),
	sortOrder = function( a, b ) {
		if ( a === b ) {
			hasDuplicate = true;
		}
		return 0;
	},

	// General-purpose constants
	MAX_NEGATIVE = 1 << 31,

	// Instance methods
	hasOwn = ({}).hasOwnProperty,
	arr = [],
	pop = arr.pop,
	push_native = arr.push,
	push = arr.push,
	slice = arr.slice,
	// Use a stripped-down indexOf as it's faster than native
	// http://jsperf.com/thor-indexof-vs-for/5
	indexOf = function( list, elem ) {
		var i = 0,
			len = list.length;
		for ( ; i < len; i++ ) {
			if ( list[i] === elem ) {
				return i;
			}
		}
		return -1;
	},

	booleans = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",

	// Regular expressions

	// Whitespace characters http://www.w3.org/TR/css3-selectors/#whitespace
	whitespace = "[\\x20\\t\\r\\n\\f]",
	// http://www.w3.org/TR/css3-syntax/#characters
	characterEncoding = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",

	// Loosely modeled on CSS identifier characters
	// An unquoted value should be a CSS identifier http://www.w3.org/TR/css3-selectors/#attribute-selectors
	// Proper syntax: http://www.w3.org/TR/CSS21/syndata.html#value-def-identifier
	identifier = characterEncoding.replace( "w", "w#" ),

	// Attribute selectors: http://www.w3.org/TR/selectors/#attribute-selectors
	attributes = "\\[" + whitespace + "*(" + characterEncoding + ")(?:" + whitespace +
		// Operator (capture 2)
		"*([*^$|!~]?=)" + whitespace +
		// "Attribute values must be CSS identifiers [capture 5] or strings [capture 3 or capture 4]"
		"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + identifier + "))|)" + whitespace +
		"*\\]",

	pseudos = ":(" + characterEncoding + ")(?:\\((" +
		// To reduce the number of selectors needing tokenize in the preFilter, prefer arguments:
		// 1. quoted (capture 3; capture 4 or capture 5)
		"('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|" +
		// 2. simple (capture 6)
		"((?:\\\\.|[^\\\\()[\\]]|" + attributes + ")*)|" +
		// 3. anything else (capture 2)
		".*" +
		")\\)|)",

	// Leading and non-escaped trailing whitespace, capturing some non-whitespace characters preceding the latter
	rwhitespace = new RegExp( whitespace + "+", "g" ),
	rtrim = new RegExp( "^" + whitespace + "+|((?:^|[^\\\\])(?:\\\\.)*)" + whitespace + "+$", "g" ),

	rcomma = new RegExp( "^" + whitespace + "*," + whitespace + "*" ),
	rcombinators = new RegExp( "^" + whitespace + "*([>+~]|" + whitespace + ")" + whitespace + "*" ),

	rattributeQuotes = new RegExp( "=" + whitespace + "*([^\\]'\"]*?)" + whitespace + "*\\]", "g" ),

	rpseudo = new RegExp( pseudos ),
	ridentifier = new RegExp( "^" + identifier + "$" ),

	matchExpr = {
		"ID": new RegExp( "^#(" + characterEncoding + ")" ),
		"CLASS": new RegExp( "^\\.(" + characterEncoding + ")" ),
		"TAG": new RegExp( "^(" + characterEncoding.replace( "w", "w*" ) + ")" ),
		"ATTR": new RegExp( "^" + attributes ),
		"PSEUDO": new RegExp( "^" + pseudos ),
		"CHILD": new RegExp( "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + whitespace +
			"*(even|odd|(([+-]|)(\\d*)n|)" + whitespace + "*(?:([+-]|)" + whitespace +
			"*(\\d+)|))" + whitespace + "*\\)|)", "i" ),
		"bool": new RegExp( "^(?:" + booleans + ")$", "i" ),
		// For use in libraries implementing .is()
		// We use this for POS matching in `select`
		"needsContext": new RegExp( "^" + whitespace + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" +
			whitespace + "*((?:-\\d)?\\d*)" + whitespace + "*\\)|)(?=[^-]|$)", "i" )
	},

	rinputs = /^(?:input|select|textarea|button)$/i,
	rheader = /^h\d$/i,

	rnative = /^[^{]+\{\s*\[native \w/,

	// Easily-parseable/retrievable ID or TAG or CLASS selectors
	rquickExpr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,

	rsibling = /[+~]/,
	rescape = /'|\\/g,

	// CSS escapes http://www.w3.org/TR/CSS21/syndata.html#escaped-characters
	runescape = new RegExp( "\\\\([\\da-f]{1,6}" + whitespace + "?|(" + whitespace + ")|.)", "ig" ),
	funescape = function( _, escaped, escapedWhitespace ) {
		var high = "0x" + escaped - 0x10000;
		// NaN means non-codepoint
		// Support: Firefox<24
		// Workaround erroneous numeric interpretation of +"0x"
		return high !== high || escapedWhitespace ?
			escaped :
			high < 0 ?
				// BMP codepoint
				String.fromCharCode( high + 0x10000 ) :
				// Supplemental Plane codepoint (surrogate pair)
				String.fromCharCode( high >> 10 | 0xD800, high & 0x3FF | 0xDC00 );
	},

	// Used for iframes
	// See setDocument()
	// Removing the function wrapper causes a "Permission Denied"
	// error in IE
	unloadHandler = function() {
		setDocument();
	};

// Optimize for push.apply( _, NodeList )
try {
	push.apply(
		(arr = slice.call( preferredDoc.childNodes )),
		preferredDoc.childNodes
	);
	// Support: Android<4.0
	// Detect silently failing push.apply
	arr[ preferredDoc.childNodes.length ].nodeType;
} catch ( e ) {
	push = { apply: arr.length ?

		// Leverage slice if possible
		function( target, els ) {
			push_native.apply( target, slice.call(els) );
		} :

		// Support: IE<9
		// Otherwise append directly
		function( target, els ) {
			var j = target.length,
				i = 0;
			// Can't trust NodeList.length
			while ( (target[j++] = els[i++]) ) {}
			target.length = j - 1;
		}
	};
}

function Sizzle( selector, context, results, seed ) {
	var match, elem, m, nodeType,
		// QSA vars
		i, groups, old, nid, newContext, newSelector;

	if ( ( context ? context.ownerDocument || context : preferredDoc ) !== document ) {
		setDocument( context );
	}

	context = context || document;
	results = results || [];
	nodeType = context.nodeType;

	if ( typeof selector !== "string" || !selector ||
		nodeType !== 1 && nodeType !== 9 && nodeType !== 11 ) {

		return results;
	}

	if ( !seed && documentIsHTML ) {

		// Try to shortcut find operations when possible (e.g., not under DocumentFragment)
		if ( nodeType !== 11 && (match = rquickExpr.exec( selector )) ) {
			// Speed-up: Sizzle("#ID")
			if ( (m = match[1]) ) {
				if ( nodeType === 9 ) {
					elem = context.getElementById( m );
					// Check parentNode to catch when Blackberry 4.6 returns
					// nodes that are no longer in the document (jQuery #6963)
					if ( elem && elem.parentNode ) {
						// Handle the case where IE, Opera, and Webkit return items
						// by name instead of ID
						if ( elem.id === m ) {
							results.push( elem );
							return results;
						}
					} else {
						return results;
					}
				} else {
					// Context is not a document
					if ( context.ownerDocument && (elem = context.ownerDocument.getElementById( m )) &&
						contains( context, elem ) && elem.id === m ) {
						results.push( elem );
						return results;
					}
				}

			// Speed-up: Sizzle("TAG")
			} else if ( match[2] ) {
				push.apply( results, context.getElementsByTagName( selector ) );
				return results;

			// Speed-up: Sizzle(".CLASS")
			} else if ( (m = match[3]) && support.getElementsByClassName ) {
				push.apply( results, context.getElementsByClassName( m ) );
				return results;
			}
		}

		// QSA path
		if ( support.qsa && (!rbuggyQSA || !rbuggyQSA.test( selector )) ) {
			nid = old = expando;
			newContext = context;
			newSelector = nodeType !== 1 && selector;

			// qSA works strangely on Element-rooted queries
			// We can work around this by specifying an extra ID on the root
			// and working up from there (Thanks to Andrew Dupont for the technique)
			// IE 8 doesn't work on object elements
			if ( nodeType === 1 && context.nodeName.toLowerCase() !== "object" ) {
				groups = tokenize( selector );

				if ( (old = context.getAttribute("id")) ) {
					nid = old.replace( rescape, "\\$&" );
				} else {
					context.setAttribute( "id", nid );
				}
				nid = "[id='" + nid + "'] ";

				i = groups.length;
				while ( i-- ) {
					groups[i] = nid + toSelector( groups[i] );
				}
				newContext = rsibling.test( selector ) && testContext( context.parentNode ) || context;
				newSelector = groups.join(",");
			}

			if ( newSelector ) {
				try {
					push.apply( results,
						newContext.querySelectorAll( newSelector )
					);
					return results;
				} catch(qsaError) {
				} finally {
					if ( !old ) {
						context.removeAttribute("id");
					}
				}
			}
		}
	}

	// All others
	return select( selector.replace( rtrim, "$1" ), context, results, seed );
}

/**
 * Create key-value caches of limited size
 * @returns {Function(string, Object)} Returns the Object data after storing it on itself with
 *	property name the (space-suffixed) string and (if the cache is larger than Expr.cacheLength)
 *	deleting the oldest entry
 */
function createCache() {
	var keys = [];

	function cache( key, value ) {
		// Use (key + " ") to avoid collision with native prototype properties (see Issue #157)
		if ( keys.push( key + " " ) > Expr.cacheLength ) {
			// Only keep the most recent entries
			delete cache[ keys.shift() ];
		}
		return (cache[ key + " " ] = value);
	}
	return cache;
}

/**
 * Mark a function for special use by Sizzle
 * @param {Function} fn The function to mark
 */
function markFunction( fn ) {
	fn[ expando ] = true;
	return fn;
}

/**
 * Support testing using an element
 * @param {Function} fn Passed the created div and expects a boolean result
 */
function assert( fn ) {
	var div = document.createElement("div");

	try {
		return !!fn( div );
	} catch (e) {
		return false;
	} finally {
		// Remove from its parent by default
		if ( div.parentNode ) {
			div.parentNode.removeChild( div );
		}
		// release memory in IE
		div = null;
	}
}

/**
 * Adds the same handler for all of the specified attrs
 * @param {String} attrs Pipe-separated list of attributes
 * @param {Function} handler The method that will be applied
 */
function addHandle( attrs, handler ) {
	var arr = attrs.split("|"),
		i = attrs.length;

	while ( i-- ) {
		Expr.attrHandle[ arr[i] ] = handler;
	}
}

/**
 * Checks document order of two siblings
 * @param {Element} a
 * @param {Element} b
 * @returns {Number} Returns less than 0 if a precedes b, greater than 0 if a follows b
 */
function siblingCheck( a, b ) {
	var cur = b && a,
		diff = cur && a.nodeType === 1 && b.nodeType === 1 &&
			( ~b.sourceIndex || MAX_NEGATIVE ) -
			( ~a.sourceIndex || MAX_NEGATIVE );

	// Use IE sourceIndex if available on both nodes
	if ( diff ) {
		return diff;
	}

	// Check if b follows a
	if ( cur ) {
		while ( (cur = cur.nextSibling) ) {
			if ( cur === b ) {
				return -1;
			}
		}
	}

	return a ? 1 : -1;
}

/**
 * Returns a function to use in pseudos for input types
 * @param {String} type
 */
function createInputPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return name === "input" && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for buttons
 * @param {String} type
 */
function createButtonPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return (name === "input" || name === "button") && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for positionals
 * @param {Function} fn
 */
function createPositionalPseudo( fn ) {
	return markFunction(function( argument ) {
		argument = +argument;
		return markFunction(function( seed, matches ) {
			var j,
				matchIndexes = fn( [], seed.length, argument ),
				i = matchIndexes.length;

			// Match elements found at the specified indexes
			while ( i-- ) {
				if ( seed[ (j = matchIndexes[i]) ] ) {
					seed[j] = !(matches[j] = seed[j]);
				}
			}
		});
	});
}

/**
 * Checks a node for validity as a Sizzle context
 * @param {Element|Object=} context
 * @returns {Element|Object|Boolean} The input node if acceptable, otherwise a falsy value
 */
function testContext( context ) {
	return context && typeof context.getElementsByTagName !== "undefined" && context;
}

// Expose support vars for convenience
support = Sizzle.support = {};

/**
 * Detects XML nodes
 * @param {Element|Object} elem An element or a document
 * @returns {Boolean} True iff elem is a non-HTML XML node
 */
isXML = Sizzle.isXML = function( elem ) {
	// documentElement is verified for cases where it doesn't yet exist
	// (such as loading iframes in IE - #4833)
	var documentElement = elem && (elem.ownerDocument || elem).documentElement;
	return documentElement ? documentElement.nodeName !== "HTML" : false;
};

/**
 * Sets document-related variables once based on the current document
 * @param {Element|Object} [doc] An element or document object to use to set the document
 * @returns {Object} Returns the current document
 */
setDocument = Sizzle.setDocument = function( node ) {
	var hasCompare, parent,
		doc = node ? node.ownerDocument || node : preferredDoc;

	// If no document and documentElement is available, return
	if ( doc === document || doc.nodeType !== 9 || !doc.documentElement ) {
		return document;
	}

	// Set our document
	document = doc;
	docElem = doc.documentElement;
	parent = doc.defaultView;

	// Support: IE>8
	// If iframe document is assigned to "document" variable and if iframe has been reloaded,
	// IE will throw "permission denied" error when accessing "document" variable, see jQuery #13936
	// IE6-8 do not support the defaultView property so parent will be undefined
	if ( parent && parent !== parent.top ) {
		// IE11 does not have attachEvent, so all must suffer
		if ( parent.addEventListener ) {
			parent.addEventListener( "unload", unloadHandler, false );
		} else if ( parent.attachEvent ) {
			parent.attachEvent( "onunload", unloadHandler );
		}
	}

	/* Support tests
	---------------------------------------------------------------------- */
	documentIsHTML = !isXML( doc );

	/* Attributes
	---------------------------------------------------------------------- */

	// Support: IE<8
	// Verify that getAttribute really returns attributes and not properties
	// (excepting IE8 booleans)
	support.attributes = assert(function( div ) {
		div.className = "i";
		return !div.getAttribute("className");
	});

	/* getElement(s)By*
	---------------------------------------------------------------------- */

	// Check if getElementsByTagName("*") returns only elements
	support.getElementsByTagName = assert(function( div ) {
		div.appendChild( doc.createComment("") );
		return !div.getElementsByTagName("*").length;
	});

	// Support: IE<9
	support.getElementsByClassName = rnative.test( doc.getElementsByClassName );

	// Support: IE<10
	// Check if getElementById returns elements by name
	// The broken getElementById methods don't pick up programatically-set names,
	// so use a roundabout getElementsByName test
	support.getById = assert(function( div ) {
		docElem.appendChild( div ).id = expando;
		return !doc.getElementsByName || !doc.getElementsByName( expando ).length;
	});

	// ID find and filter
	if ( support.getById ) {
		Expr.find["ID"] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var m = context.getElementById( id );
				// Check parentNode to catch when Blackberry 4.6 returns
				// nodes that are no longer in the document #6963
				return m && m.parentNode ? [ m ] : [];
			}
		};
		Expr.filter["ID"] = function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				return elem.getAttribute("id") === attrId;
			};
		};
	} else {
		// Support: IE6/7
		// getElementById is not reliable as a find shortcut
		delete Expr.find["ID"];

		Expr.filter["ID"] =  function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				var node = typeof elem.getAttributeNode !== "undefined" && elem.getAttributeNode("id");
				return node && node.value === attrId;
			};
		};
	}

	// Tag
	Expr.find["TAG"] = support.getElementsByTagName ?
		function( tag, context ) {
			if ( typeof context.getElementsByTagName !== "undefined" ) {
				return context.getElementsByTagName( tag );

			// DocumentFragment nodes don't have gEBTN
			} else if ( support.qsa ) {
				return context.querySelectorAll( tag );
			}
		} :

		function( tag, context ) {
			var elem,
				tmp = [],
				i = 0,
				// By happy coincidence, a (broken) gEBTN appears on DocumentFragment nodes too
				results = context.getElementsByTagName( tag );

			// Filter out possible comments
			if ( tag === "*" ) {
				while ( (elem = results[i++]) ) {
					if ( elem.nodeType === 1 ) {
						tmp.push( elem );
					}
				}

				return tmp;
			}
			return results;
		};

	// Class
	Expr.find["CLASS"] = support.getElementsByClassName && function( className, context ) {
		if ( documentIsHTML ) {
			return context.getElementsByClassName( className );
		}
	};

	/* QSA/matchesSelector
	---------------------------------------------------------------------- */

	// QSA and matchesSelector support

	// matchesSelector(:active) reports false when true (IE9/Opera 11.5)
	rbuggyMatches = [];

	// qSa(:focus) reports false when true (Chrome 21)
	// We allow this because of a bug in IE8/9 that throws an error
	// whenever `document.activeElement` is accessed on an iframe
	// So, we allow :focus to pass through QSA all the time to avoid the IE error
	// See http://bugs.jquery.com/ticket/13378
	rbuggyQSA = [];

	if ( (support.qsa = rnative.test( doc.querySelectorAll )) ) {
		// Build QSA regex
		// Regex strategy adopted from Diego Perini
		assert(function( div ) {
			// Select is set to empty string on purpose
			// This is to test IE's treatment of not explicitly
			// setting a boolean content attribute,
			// since its presence should be enough
			// http://bugs.jquery.com/ticket/12359
			docElem.appendChild( div ).innerHTML = "<a id='" + expando + "'></a>" +
				"<select id='" + expando + "-\f]' msallowcapture=''>" +
				"<option selected=''></option></select>";

			// Support: IE8, Opera 11-12.16
			// Nothing should be selected when empty strings follow ^= or $= or *=
			// The test attribute must be unknown in Opera but "safe" for WinRT
			// http://msdn.microsoft.com/en-us/library/ie/hh465388.aspx#attribute_section
			if ( div.querySelectorAll("[msallowcapture^='']").length ) {
				rbuggyQSA.push( "[*^$]=" + whitespace + "*(?:''|\"\")" );
			}

			// Support: IE8
			// Boolean attributes and "value" are not treated correctly
			if ( !div.querySelectorAll("[selected]").length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*(?:value|" + booleans + ")" );
			}

			// Support: Chrome<29, Android<4.2+, Safari<7.0+, iOS<7.0+, PhantomJS<1.9.7+
			if ( !div.querySelectorAll( "[id~=" + expando + "-]" ).length ) {
				rbuggyQSA.push("~=");
			}

			// Webkit/Opera - :checked should return selected option elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			// IE8 throws error here and will not see later tests
			if ( !div.querySelectorAll(":checked").length ) {
				rbuggyQSA.push(":checked");
			}

			// Support: Safari 8+, iOS 8+
			// https://bugs.webkit.org/show_bug.cgi?id=136851
			// In-page `selector#id sibing-combinator selector` fails
			if ( !div.querySelectorAll( "a#" + expando + "+*" ).length ) {
				rbuggyQSA.push(".#.+[+~]");
			}
		});

		assert(function( div ) {
			// Support: Windows 8 Native Apps
			// The type and name attributes are restricted during .innerHTML assignment
			var input = doc.createElement("input");
			input.setAttribute( "type", "hidden" );
			div.appendChild( input ).setAttribute( "name", "D" );

			// Support: IE8
			// Enforce case-sensitivity of name attribute
			if ( div.querySelectorAll("[name=d]").length ) {
				rbuggyQSA.push( "name" + whitespace + "*[*^$|!~]?=" );
			}

			// FF 3.5 - :enabled/:disabled and hidden elements (hidden elements are still enabled)
			// IE8 throws error here and will not see later tests
			if ( !div.querySelectorAll(":enabled").length ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Opera 10-11 does not throw on post-comma invalid pseudos
			div.querySelectorAll("*,:x");
			rbuggyQSA.push(",.*:");
		});
	}

	if ( (support.matchesSelector = rnative.test( (matches = docElem.matches ||
		docElem.webkitMatchesSelector ||
		docElem.mozMatchesSelector ||
		docElem.oMatchesSelector ||
		docElem.msMatchesSelector) )) ) {

		assert(function( div ) {
			// Check to see if it's possible to do matchesSelector
			// on a disconnected node (IE 9)
			support.disconnectedMatch = matches.call( div, "div" );

			// This should fail with an exception
			// Gecko does not error, returns false instead
			matches.call( div, "[s!='']:x" );
			rbuggyMatches.push( "!=", pseudos );
		});
	}

	rbuggyQSA = rbuggyQSA.length && new RegExp( rbuggyQSA.join("|") );
	rbuggyMatches = rbuggyMatches.length && new RegExp( rbuggyMatches.join("|") );

	/* Contains
	---------------------------------------------------------------------- */
	hasCompare = rnative.test( docElem.compareDocumentPosition );

	// Element contains another
	// Purposefully does not implement inclusive descendent
	// As in, an element does not contain itself
	contains = hasCompare || rnative.test( docElem.contains ) ?
		function( a, b ) {
			var adown = a.nodeType === 9 ? a.documentElement : a,
				bup = b && b.parentNode;
			return a === bup || !!( bup && bup.nodeType === 1 && (
				adown.contains ?
					adown.contains( bup ) :
					a.compareDocumentPosition && a.compareDocumentPosition( bup ) & 16
			));
		} :
		function( a, b ) {
			if ( b ) {
				while ( (b = b.parentNode) ) {
					if ( b === a ) {
						return true;
					}
				}
			}
			return false;
		};

	/* Sorting
	---------------------------------------------------------------------- */

	// Document order sorting
	sortOrder = hasCompare ?
	function( a, b ) {

		// Flag for duplicate removal
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		// Sort on method existence if only one input has compareDocumentPosition
		var compare = !a.compareDocumentPosition - !b.compareDocumentPosition;
		if ( compare ) {
			return compare;
		}

		// Calculate position if both inputs belong to the same document
		compare = ( a.ownerDocument || a ) === ( b.ownerDocument || b ) ?
			a.compareDocumentPosition( b ) :

			// Otherwise we know they are disconnected
			1;

		// Disconnected nodes
		if ( compare & 1 ||
			(!support.sortDetached && b.compareDocumentPosition( a ) === compare) ) {

			// Choose the first element that is related to our preferred document
			if ( a === doc || a.ownerDocument === preferredDoc && contains(preferredDoc, a) ) {
				return -1;
			}
			if ( b === doc || b.ownerDocument === preferredDoc && contains(preferredDoc, b) ) {
				return 1;
			}

			// Maintain original order
			return sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;
		}

		return compare & 4 ? -1 : 1;
	} :
	function( a, b ) {
		// Exit early if the nodes are identical
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		var cur,
			i = 0,
			aup = a.parentNode,
			bup = b.parentNode,
			ap = [ a ],
			bp = [ b ];

		// Parentless nodes are either documents or disconnected
		if ( !aup || !bup ) {
			return a === doc ? -1 :
				b === doc ? 1 :
				aup ? -1 :
				bup ? 1 :
				sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;

		// If the nodes are siblings, we can do a quick check
		} else if ( aup === bup ) {
			return siblingCheck( a, b );
		}

		// Otherwise we need full lists of their ancestors for comparison
		cur = a;
		while ( (cur = cur.parentNode) ) {
			ap.unshift( cur );
		}
		cur = b;
		while ( (cur = cur.parentNode) ) {
			bp.unshift( cur );
		}

		// Walk down the tree looking for a discrepancy
		while ( ap[i] === bp[i] ) {
			i++;
		}

		return i ?
			// Do a sibling check if the nodes have a common ancestor
			siblingCheck( ap[i], bp[i] ) :

			// Otherwise nodes in our document sort first
			ap[i] === preferredDoc ? -1 :
			bp[i] === preferredDoc ? 1 :
			0;
	};

	return doc;
};

Sizzle.matches = function( expr, elements ) {
	return Sizzle( expr, null, null, elements );
};

Sizzle.matchesSelector = function( elem, expr ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}

	// Make sure that attribute selectors are quoted
	expr = expr.replace( rattributeQuotes, "='$1']" );

	if ( support.matchesSelector && documentIsHTML &&
		( !rbuggyMatches || !rbuggyMatches.test( expr ) ) &&
		( !rbuggyQSA     || !rbuggyQSA.test( expr ) ) ) {

		try {
			var ret = matches.call( elem, expr );

			// IE 9's matchesSelector returns false on disconnected nodes
			if ( ret || support.disconnectedMatch ||
					// As well, disconnected nodes are said to be in a document
					// fragment in IE 9
					elem.document && elem.document.nodeType !== 11 ) {
				return ret;
			}
		} catch (e) {}
	}

	return Sizzle( expr, document, null, [ elem ] ).length > 0;
};

Sizzle.contains = function( context, elem ) {
	// Set document vars if needed
	if ( ( context.ownerDocument || context ) !== document ) {
		setDocument( context );
	}
	return contains( context, elem );
};

Sizzle.attr = function( elem, name ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}

	var fn = Expr.attrHandle[ name.toLowerCase() ],
		// Don't get fooled by Object.prototype properties (jQuery #13807)
		val = fn && hasOwn.call( Expr.attrHandle, name.toLowerCase() ) ?
			fn( elem, name, !documentIsHTML ) :
			undefined;

	return val !== undefined ?
		val :
		support.attributes || !documentIsHTML ?
			elem.getAttribute( name ) :
			(val = elem.getAttributeNode(name)) && val.specified ?
				val.value :
				null;
};

Sizzle.error = function( msg ) {
	throw new Error( "Syntax error, unrecognized expression: " + msg );
};

/**
 * Document sorting and removing duplicates
 * @param {ArrayLike} results
 */
Sizzle.uniqueSort = function( results ) {
	var elem,
		duplicates = [],
		j = 0,
		i = 0;

	// Unless we *know* we can detect duplicates, assume their presence
	hasDuplicate = !support.detectDuplicates;
	sortInput = !support.sortStable && results.slice( 0 );
	results.sort( sortOrder );

	if ( hasDuplicate ) {
		while ( (elem = results[i++]) ) {
			if ( elem === results[ i ] ) {
				j = duplicates.push( i );
			}
		}
		while ( j-- ) {
			results.splice( duplicates[ j ], 1 );
		}
	}

	// Clear input after sorting to release objects
	// See https://github.com/jquery/sizzle/pull/225
	sortInput = null;

	return results;
};

/**
 * Utility function for retrieving the text value of an array of DOM nodes
 * @param {Array|Element} elem
 */
getText = Sizzle.getText = function( elem ) {
	var node,
		ret = "",
		i = 0,
		nodeType = elem.nodeType;

	if ( !nodeType ) {
		// If no nodeType, this is expected to be an array
		while ( (node = elem[i++]) ) {
			// Do not traverse comment nodes
			ret += getText( node );
		}
	} else if ( nodeType === 1 || nodeType === 9 || nodeType === 11 ) {
		// Use textContent for elements
		// innerText usage removed for consistency of new lines (jQuery #11153)
		if ( typeof elem.textContent === "string" ) {
			return elem.textContent;
		} else {
			// Traverse its children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				ret += getText( elem );
			}
		}
	} else if ( nodeType === 3 || nodeType === 4 ) {
		return elem.nodeValue;
	}
	// Do not include comment or processing instruction nodes

	return ret;
};

Expr = Sizzle.selectors = {

	// Can be adjusted by the user
	cacheLength: 50,

	createPseudo: markFunction,

	match: matchExpr,

	attrHandle: {},

	find: {},

	relative: {
		">": { dir: "parentNode", first: true },
		" ": { dir: "parentNode" },
		"+": { dir: "previousSibling", first: true },
		"~": { dir: "previousSibling" }
	},

	preFilter: {
		"ATTR": function( match ) {
			match[1] = match[1].replace( runescape, funescape );

			// Move the given value to match[3] whether quoted or unquoted
			match[3] = ( match[3] || match[4] || match[5] || "" ).replace( runescape, funescape );

			if ( match[2] === "~=" ) {
				match[3] = " " + match[3] + " ";
			}

			return match.slice( 0, 4 );
		},

		"CHILD": function( match ) {
			/* matches from matchExpr["CHILD"]
				1 type (only|nth|...)
				2 what (child|of-type)
				3 argument (even|odd|\d*|\d*n([+-]\d+)?|...)
				4 xn-component of xn+y argument ([+-]?\d*n|)
				5 sign of xn-component
				6 x of xn-component
				7 sign of y-component
				8 y of y-component
			*/
			match[1] = match[1].toLowerCase();

			if ( match[1].slice( 0, 3 ) === "nth" ) {
				// nth-* requires argument
				if ( !match[3] ) {
					Sizzle.error( match[0] );
				}

				// numeric x and y parameters for Expr.filter.CHILD
				// remember that false/true cast respectively to 0/1
				match[4] = +( match[4] ? match[5] + (match[6] || 1) : 2 * ( match[3] === "even" || match[3] === "odd" ) );
				match[5] = +( ( match[7] + match[8] ) || match[3] === "odd" );

			// other types prohibit arguments
			} else if ( match[3] ) {
				Sizzle.error( match[0] );
			}

			return match;
		},

		"PSEUDO": function( match ) {
			var excess,
				unquoted = !match[6] && match[2];

			if ( matchExpr["CHILD"].test( match[0] ) ) {
				return null;
			}

			// Accept quoted arguments as-is
			if ( match[3] ) {
				match[2] = match[4] || match[5] || "";

			// Strip excess characters from unquoted arguments
			} else if ( unquoted && rpseudo.test( unquoted ) &&
				// Get excess from tokenize (recursively)
				(excess = tokenize( unquoted, true )) &&
				// advance to the next closing parenthesis
				(excess = unquoted.indexOf( ")", unquoted.length - excess ) - unquoted.length) ) {

				// excess is a negative index
				match[0] = match[0].slice( 0, excess );
				match[2] = unquoted.slice( 0, excess );
			}

			// Return only captures needed by the pseudo filter method (type and argument)
			return match.slice( 0, 3 );
		}
	},

	filter: {

		"TAG": function( nodeNameSelector ) {
			var nodeName = nodeNameSelector.replace( runescape, funescape ).toLowerCase();
			return nodeNameSelector === "*" ?
				function() { return true; } :
				function( elem ) {
					return elem.nodeName && elem.nodeName.toLowerCase() === nodeName;
				};
		},

		"CLASS": function( className ) {
			var pattern = classCache[ className + " " ];

			return pattern ||
				(pattern = new RegExp( "(^|" + whitespace + ")" + className + "(" + whitespace + "|$)" )) &&
				classCache( className, function( elem ) {
					return pattern.test( typeof elem.className === "string" && elem.className || typeof elem.getAttribute !== "undefined" && elem.getAttribute("class") || "" );
				});
		},

		"ATTR": function( name, operator, check ) {
			return function( elem ) {
				var result = Sizzle.attr( elem, name );

				if ( result == null ) {
					return operator === "!=";
				}
				if ( !operator ) {
					return true;
				}

				result += "";

				return operator === "=" ? result === check :
					operator === "!=" ? result !== check :
					operator === "^=" ? check && result.indexOf( check ) === 0 :
					operator === "*=" ? check && result.indexOf( check ) > -1 :
					operator === "$=" ? check && result.slice( -check.length ) === check :
					operator === "~=" ? ( " " + result.replace( rwhitespace, " " ) + " " ).indexOf( check ) > -1 :
					operator === "|=" ? result === check || result.slice( 0, check.length + 1 ) === check + "-" :
					false;
			};
		},

		"CHILD": function( type, what, argument, first, last ) {
			var simple = type.slice( 0, 3 ) !== "nth",
				forward = type.slice( -4 ) !== "last",
				ofType = what === "of-type";

			return first === 1 && last === 0 ?

				// Shortcut for :nth-*(n)
				function( elem ) {
					return !!elem.parentNode;
				} :

				function( elem, context, xml ) {
					var cache, outerCache, node, diff, nodeIndex, start,
						dir = simple !== forward ? "nextSibling" : "previousSibling",
						parent = elem.parentNode,
						name = ofType && elem.nodeName.toLowerCase(),
						useCache = !xml && !ofType;

					if ( parent ) {

						// :(first|last|only)-(child|of-type)
						if ( simple ) {
							while ( dir ) {
								node = elem;
								while ( (node = node[ dir ]) ) {
									if ( ofType ? node.nodeName.toLowerCase() === name : node.nodeType === 1 ) {
										return false;
									}
								}
								// Reverse direction for :only-* (if we haven't yet done so)
								start = dir = type === "only" && !start && "nextSibling";
							}
							return true;
						}

						start = [ forward ? parent.firstChild : parent.lastChild ];

						// non-xml :nth-child(...) stores cache data on `parent`
						if ( forward && useCache ) {
							// Seek `elem` from a previously-cached index
							outerCache = parent[ expando ] || (parent[ expando ] = {});
							cache = outerCache[ type ] || [];
							nodeIndex = cache[0] === dirruns && cache[1];
							diff = cache[0] === dirruns && cache[2];
							node = nodeIndex && parent.childNodes[ nodeIndex ];

							while ( (node = ++nodeIndex && node && node[ dir ] ||

								// Fallback to seeking `elem` from the start
								(diff = nodeIndex = 0) || start.pop()) ) {

								// When found, cache indexes on `parent` and break
								if ( node.nodeType === 1 && ++diff && node === elem ) {
									outerCache[ type ] = [ dirruns, nodeIndex, diff ];
									break;
								}
							}

						// Use previously-cached element index if available
						} else if ( useCache && (cache = (elem[ expando ] || (elem[ expando ] = {}))[ type ]) && cache[0] === dirruns ) {
							diff = cache[1];

						// xml :nth-child(...) or :nth-last-child(...) or :nth(-last)?-of-type(...)
						} else {
							// Use the same loop as above to seek `elem` from the start
							while ( (node = ++nodeIndex && node && node[ dir ] ||
								(diff = nodeIndex = 0) || start.pop()) ) {

								if ( ( ofType ? node.nodeName.toLowerCase() === name : node.nodeType === 1 ) && ++diff ) {
									// Cache the index of each encountered element
									if ( useCache ) {
										(node[ expando ] || (node[ expando ] = {}))[ type ] = [ dirruns, diff ];
									}

									if ( node === elem ) {
										break;
									}
								}
							}
						}

						// Incorporate the offset, then check against cycle size
						diff -= last;
						return diff === first || ( diff % first === 0 && diff / first >= 0 );
					}
				};
		},

		"PSEUDO": function( pseudo, argument ) {
			// pseudo-class names are case-insensitive
			// http://www.w3.org/TR/selectors/#pseudo-classes
			// Prioritize by case sensitivity in case custom pseudos are added with uppercase letters
			// Remember that setFilters inherits from pseudos
			var args,
				fn = Expr.pseudos[ pseudo ] || Expr.setFilters[ pseudo.toLowerCase() ] ||
					Sizzle.error( "unsupported pseudo: " + pseudo );

			// The user may use createPseudo to indicate that
			// arguments are needed to create the filter function
			// just as Sizzle does
			if ( fn[ expando ] ) {
				return fn( argument );
			}

			// But maintain support for old signatures
			if ( fn.length > 1 ) {
				args = [ pseudo, pseudo, "", argument ];
				return Expr.setFilters.hasOwnProperty( pseudo.toLowerCase() ) ?
					markFunction(function( seed, matches ) {
						var idx,
							matched = fn( seed, argument ),
							i = matched.length;
						while ( i-- ) {
							idx = indexOf( seed, matched[i] );
							seed[ idx ] = !( matches[ idx ] = matched[i] );
						}
					}) :
					function( elem ) {
						return fn( elem, 0, args );
					};
			}

			return fn;
		}
	},

	pseudos: {
		// Potentially complex pseudos
		"not": markFunction(function( selector ) {
			// Trim the selector passed to compile
			// to avoid treating leading and trailing
			// spaces as combinators
			var input = [],
				results = [],
				matcher = compile( selector.replace( rtrim, "$1" ) );

			return matcher[ expando ] ?
				markFunction(function( seed, matches, context, xml ) {
					var elem,
						unmatched = matcher( seed, null, xml, [] ),
						i = seed.length;

					// Match elements unmatched by `matcher`
					while ( i-- ) {
						if ( (elem = unmatched[i]) ) {
							seed[i] = !(matches[i] = elem);
						}
					}
				}) :
				function( elem, context, xml ) {
					input[0] = elem;
					matcher( input, null, xml, results );
					// Don't keep the element (issue #299)
					input[0] = null;
					return !results.pop();
				};
		}),

		"has": markFunction(function( selector ) {
			return function( elem ) {
				return Sizzle( selector, elem ).length > 0;
			};
		}),

		"contains": markFunction(function( text ) {
			text = text.replace( runescape, funescape );
			return function( elem ) {
				return ( elem.textContent || elem.innerText || getText( elem ) ).indexOf( text ) > -1;
			};
		}),

		// "Whether an element is represented by a :lang() selector
		// is based solely on the element's language value
		// being equal to the identifier C,
		// or beginning with the identifier C immediately followed by "-".
		// The matching of C against the element's language value is performed case-insensitively.
		// The identifier C does not have to be a valid language name."
		// http://www.w3.org/TR/selectors/#lang-pseudo
		"lang": markFunction( function( lang ) {
			// lang value must be a valid identifier
			if ( !ridentifier.test(lang || "") ) {
				Sizzle.error( "unsupported lang: " + lang );
			}
			lang = lang.replace( runescape, funescape ).toLowerCase();
			return function( elem ) {
				var elemLang;
				do {
					if ( (elemLang = documentIsHTML ?
						elem.lang :
						elem.getAttribute("xml:lang") || elem.getAttribute("lang")) ) {

						elemLang = elemLang.toLowerCase();
						return elemLang === lang || elemLang.indexOf( lang + "-" ) === 0;
					}
				} while ( (elem = elem.parentNode) && elem.nodeType === 1 );
				return false;
			};
		}),

		// Miscellaneous
		"target": function( elem ) {
			var hash = window.location && window.location.hash;
			return hash && hash.slice( 1 ) === elem.id;
		},

		"root": function( elem ) {
			return elem === docElem;
		},

		"focus": function( elem ) {
			return elem === document.activeElement && (!document.hasFocus || document.hasFocus()) && !!(elem.type || elem.href || ~elem.tabIndex);
		},

		// Boolean properties
		"enabled": function( elem ) {
			return elem.disabled === false;
		},

		"disabled": function( elem ) {
			return elem.disabled === true;
		},

		"checked": function( elem ) {
			// In CSS3, :checked should return both checked and selected elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			var nodeName = elem.nodeName.toLowerCase();
			return (nodeName === "input" && !!elem.checked) || (nodeName === "option" && !!elem.selected);
		},

		"selected": function( elem ) {
			// Accessing this property makes selected-by-default
			// options in Safari work properly
			if ( elem.parentNode ) {
				elem.parentNode.selectedIndex;
			}

			return elem.selected === true;
		},

		// Contents
		"empty": function( elem ) {
			// http://www.w3.org/TR/selectors/#empty-pseudo
			// :empty is negated by element (1) or content nodes (text: 3; cdata: 4; entity ref: 5),
			//   but not by others (comment: 8; processing instruction: 7; etc.)
			// nodeType < 6 works because attributes (2) do not appear as children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				if ( elem.nodeType < 6 ) {
					return false;
				}
			}
			return true;
		},

		"parent": function( elem ) {
			return !Expr.pseudos["empty"]( elem );
		},

		// Element/input types
		"header": function( elem ) {
			return rheader.test( elem.nodeName );
		},

		"input": function( elem ) {
			return rinputs.test( elem.nodeName );
		},

		"button": function( elem ) {
			var name = elem.nodeName.toLowerCase();
			return name === "input" && elem.type === "button" || name === "button";
		},

		"text": function( elem ) {
			var attr;
			return elem.nodeName.toLowerCase() === "input" &&
				elem.type === "text" &&

				// Support: IE<8
				// New HTML5 attribute values (e.g., "search") appear with elem.type === "text"
				( (attr = elem.getAttribute("type")) == null || attr.toLowerCase() === "text" );
		},

		// Position-in-collection
		"first": createPositionalPseudo(function() {
			return [ 0 ];
		}),

		"last": createPositionalPseudo(function( matchIndexes, length ) {
			return [ length - 1 ];
		}),

		"eq": createPositionalPseudo(function( matchIndexes, length, argument ) {
			return [ argument < 0 ? argument + length : argument ];
		}),

		"even": createPositionalPseudo(function( matchIndexes, length ) {
			var i = 0;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"odd": createPositionalPseudo(function( matchIndexes, length ) {
			var i = 1;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"lt": createPositionalPseudo(function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; --i >= 0; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		}),

		"gt": createPositionalPseudo(function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; ++i < length; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		})
	}
};

Expr.pseudos["nth"] = Expr.pseudos["eq"];

// Add button/input type pseudos
for ( i in { radio: true, checkbox: true, file: true, password: true, image: true } ) {
	Expr.pseudos[ i ] = createInputPseudo( i );
}
for ( i in { submit: true, reset: true } ) {
	Expr.pseudos[ i ] = createButtonPseudo( i );
}

// Easy API for creating new setFilters
function setFilters() {}
setFilters.prototype = Expr.filters = Expr.pseudos;
Expr.setFilters = new setFilters();

tokenize = Sizzle.tokenize = function( selector, parseOnly ) {
	var matched, match, tokens, type,
		soFar, groups, preFilters,
		cached = tokenCache[ selector + " " ];

	if ( cached ) {
		return parseOnly ? 0 : cached.slice( 0 );
	}

	soFar = selector;
	groups = [];
	preFilters = Expr.preFilter;

	while ( soFar ) {

		// Comma and first run
		if ( !matched || (match = rcomma.exec( soFar )) ) {
			if ( match ) {
				// Don't consume trailing commas as valid
				soFar = soFar.slice( match[0].length ) || soFar;
			}
			groups.push( (tokens = []) );
		}

		matched = false;

		// Combinators
		if ( (match = rcombinators.exec( soFar )) ) {
			matched = match.shift();
			tokens.push({
				value: matched,
				// Cast descendant combinators to space
				type: match[0].replace( rtrim, " " )
			});
			soFar = soFar.slice( matched.length );
		}

		// Filters
		for ( type in Expr.filter ) {
			if ( (match = matchExpr[ type ].exec( soFar )) && (!preFilters[ type ] ||
				(match = preFilters[ type ]( match ))) ) {
				matched = match.shift();
				tokens.push({
					value: matched,
					type: type,
					matches: match
				});
				soFar = soFar.slice( matched.length );
			}
		}

		if ( !matched ) {
			break;
		}
	}

	// Return the length of the invalid excess
	// if we're just parsing
	// Otherwise, throw an error or return tokens
	return parseOnly ?
		soFar.length :
		soFar ?
			Sizzle.error( selector ) :
			// Cache the tokens
			tokenCache( selector, groups ).slice( 0 );
};

function toSelector( tokens ) {
	var i = 0,
		len = tokens.length,
		selector = "";
	for ( ; i < len; i++ ) {
		selector += tokens[i].value;
	}
	return selector;
}

function addCombinator( matcher, combinator, base ) {
	var dir = combinator.dir,
		checkNonElements = base && dir === "parentNode",
		doneName = done++;

	return combinator.first ?
		// Check against closest ancestor/preceding element
		function( elem, context, xml ) {
			while ( (elem = elem[ dir ]) ) {
				if ( elem.nodeType === 1 || checkNonElements ) {
					return matcher( elem, context, xml );
				}
			}
		} :

		// Check against all ancestor/preceding elements
		function( elem, context, xml ) {
			var oldCache, outerCache,
				newCache = [ dirruns, doneName ];

			// We can't set arbitrary data on XML nodes, so they don't benefit from dir caching
			if ( xml ) {
				while ( (elem = elem[ dir ]) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						if ( matcher( elem, context, xml ) ) {
							return true;
						}
					}
				}
			} else {
				while ( (elem = elem[ dir ]) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						outerCache = elem[ expando ] || (elem[ expando ] = {});
						if ( (oldCache = outerCache[ dir ]) &&
							oldCache[ 0 ] === dirruns && oldCache[ 1 ] === doneName ) {

							// Assign to newCache so results back-propagate to previous elements
							return (newCache[ 2 ] = oldCache[ 2 ]);
						} else {
							// Reuse newcache so results back-propagate to previous elements
							outerCache[ dir ] = newCache;

							// A match means we're done; a fail means we have to keep checking
							if ( (newCache[ 2 ] = matcher( elem, context, xml )) ) {
								return true;
							}
						}
					}
				}
			}
		};
}

function elementMatcher( matchers ) {
	return matchers.length > 1 ?
		function( elem, context, xml ) {
			var i = matchers.length;
			while ( i-- ) {
				if ( !matchers[i]( elem, context, xml ) ) {
					return false;
				}
			}
			return true;
		} :
		matchers[0];
}

function multipleContexts( selector, contexts, results ) {
	var i = 0,
		len = contexts.length;
	for ( ; i < len; i++ ) {
		Sizzle( selector, contexts[i], results );
	}
	return results;
}

function condense( unmatched, map, filter, context, xml ) {
	var elem,
		newUnmatched = [],
		i = 0,
		len = unmatched.length,
		mapped = map != null;

	for ( ; i < len; i++ ) {
		if ( (elem = unmatched[i]) ) {
			if ( !filter || filter( elem, context, xml ) ) {
				newUnmatched.push( elem );
				if ( mapped ) {
					map.push( i );
				}
			}
		}
	}

	return newUnmatched;
}

function setMatcher( preFilter, selector, matcher, postFilter, postFinder, postSelector ) {
	if ( postFilter && !postFilter[ expando ] ) {
		postFilter = setMatcher( postFilter );
	}
	if ( postFinder && !postFinder[ expando ] ) {
		postFinder = setMatcher( postFinder, postSelector );
	}
	return markFunction(function( seed, results, context, xml ) {
		var temp, i, elem,
			preMap = [],
			postMap = [],
			preexisting = results.length,

			// Get initial elements from seed or context
			elems = seed || multipleContexts( selector || "*", context.nodeType ? [ context ] : context, [] ),

			// Prefilter to get matcher input, preserving a map for seed-results synchronization
			matcherIn = preFilter && ( seed || !selector ) ?
				condense( elems, preMap, preFilter, context, xml ) :
				elems,

			matcherOut = matcher ?
				// If we have a postFinder, or filtered seed, or non-seed postFilter or preexisting results,
				postFinder || ( seed ? preFilter : preexisting || postFilter ) ?

					// ...intermediate processing is necessary
					[] :

					// ...otherwise use results directly
					results :
				matcherIn;

		// Find primary matches
		if ( matcher ) {
			matcher( matcherIn, matcherOut, context, xml );
		}

		// Apply postFilter
		if ( postFilter ) {
			temp = condense( matcherOut, postMap );
			postFilter( temp, [], context, xml );

			// Un-match failing elements by moving them back to matcherIn
			i = temp.length;
			while ( i-- ) {
				if ( (elem = temp[i]) ) {
					matcherOut[ postMap[i] ] = !(matcherIn[ postMap[i] ] = elem);
				}
			}
		}

		if ( seed ) {
			if ( postFinder || preFilter ) {
				if ( postFinder ) {
					// Get the final matcherOut by condensing this intermediate into postFinder contexts
					temp = [];
					i = matcherOut.length;
					while ( i-- ) {
						if ( (elem = matcherOut[i]) ) {
							// Restore matcherIn since elem is not yet a final match
							temp.push( (matcherIn[i] = elem) );
						}
					}
					postFinder( null, (matcherOut = []), temp, xml );
				}

				// Move matched elements from seed to results to keep them synchronized
				i = matcherOut.length;
				while ( i-- ) {
					if ( (elem = matcherOut[i]) &&
						(temp = postFinder ? indexOf( seed, elem ) : preMap[i]) > -1 ) {

						seed[temp] = !(results[temp] = elem);
					}
				}
			}

		// Add elements to results, through postFinder if defined
		} else {
			matcherOut = condense(
				matcherOut === results ?
					matcherOut.splice( preexisting, matcherOut.length ) :
					matcherOut
			);
			if ( postFinder ) {
				postFinder( null, results, matcherOut, xml );
			} else {
				push.apply( results, matcherOut );
			}
		}
	});
}

function matcherFromTokens( tokens ) {
	var checkContext, matcher, j,
		len = tokens.length,
		leadingRelative = Expr.relative[ tokens[0].type ],
		implicitRelative = leadingRelative || Expr.relative[" "],
		i = leadingRelative ? 1 : 0,

		// The foundational matcher ensures that elements are reachable from top-level context(s)
		matchContext = addCombinator( function( elem ) {
			return elem === checkContext;
		}, implicitRelative, true ),
		matchAnyContext = addCombinator( function( elem ) {
			return indexOf( checkContext, elem ) > -1;
		}, implicitRelative, true ),
		matchers = [ function( elem, context, xml ) {
			var ret = ( !leadingRelative && ( xml || context !== outermostContext ) ) || (
				(checkContext = context).nodeType ?
					matchContext( elem, context, xml ) :
					matchAnyContext( elem, context, xml ) );
			// Avoid hanging onto element (issue #299)
			checkContext = null;
			return ret;
		} ];

	for ( ; i < len; i++ ) {
		if ( (matcher = Expr.relative[ tokens[i].type ]) ) {
			matchers = [ addCombinator(elementMatcher( matchers ), matcher) ];
		} else {
			matcher = Expr.filter[ tokens[i].type ].apply( null, tokens[i].matches );

			// Return special upon seeing a positional matcher
			if ( matcher[ expando ] ) {
				// Find the next relative operator (if any) for proper handling
				j = ++i;
				for ( ; j < len; j++ ) {
					if ( Expr.relative[ tokens[j].type ] ) {
						break;
					}
				}
				return setMatcher(
					i > 1 && elementMatcher( matchers ),
					i > 1 && toSelector(
						// If the preceding token was a descendant combinator, insert an implicit any-element `*`
						tokens.slice( 0, i - 1 ).concat({ value: tokens[ i - 2 ].type === " " ? "*" : "" })
					).replace( rtrim, "$1" ),
					matcher,
					i < j && matcherFromTokens( tokens.slice( i, j ) ),
					j < len && matcherFromTokens( (tokens = tokens.slice( j )) ),
					j < len && toSelector( tokens )
				);
			}
			matchers.push( matcher );
		}
	}

	return elementMatcher( matchers );
}

function matcherFromGroupMatchers( elementMatchers, setMatchers ) {
	var bySet = setMatchers.length > 0,
		byElement = elementMatchers.length > 0,
		superMatcher = function( seed, context, xml, results, outermost ) {
			var elem, j, matcher,
				matchedCount = 0,
				i = "0",
				unmatched = seed && [],
				setMatched = [],
				contextBackup = outermostContext,
				// We must always have either seed elements or outermost context
				elems = seed || byElement && Expr.find["TAG"]( "*", outermost ),
				// Use integer dirruns iff this is the outermost matcher
				dirrunsUnique = (dirruns += contextBackup == null ? 1 : Math.random() || 0.1),
				len = elems.length;

			if ( outermost ) {
				outermostContext = context !== document && context;
			}

			// Add elements passing elementMatchers directly to results
			// Keep `i` a string if there are no elements so `matchedCount` will be "00" below
			// Support: IE<9, Safari
			// Tolerate NodeList properties (IE: "length"; Safari: <number>) matching elements by id
			for ( ; i !== len && (elem = elems[i]) != null; i++ ) {
				if ( byElement && elem ) {
					j = 0;
					while ( (matcher = elementMatchers[j++]) ) {
						if ( matcher( elem, context, xml ) ) {
							results.push( elem );
							break;
						}
					}
					if ( outermost ) {
						dirruns = dirrunsUnique;
					}
				}

				// Track unmatched elements for set filters
				if ( bySet ) {
					// They will have gone through all possible matchers
					if ( (elem = !matcher && elem) ) {
						matchedCount--;
					}

					// Lengthen the array for every element, matched or not
					if ( seed ) {
						unmatched.push( elem );
					}
				}
			}

			// Apply set filters to unmatched elements
			matchedCount += i;
			if ( bySet && i !== matchedCount ) {
				j = 0;
				while ( (matcher = setMatchers[j++]) ) {
					matcher( unmatched, setMatched, context, xml );
				}

				if ( seed ) {
					// Reintegrate element matches to eliminate the need for sorting
					if ( matchedCount > 0 ) {
						while ( i-- ) {
							if ( !(unmatched[i] || setMatched[i]) ) {
								setMatched[i] = pop.call( results );
							}
						}
					}

					// Discard index placeholder values to get only actual matches
					setMatched = condense( setMatched );
				}

				// Add matches to results
				push.apply( results, setMatched );

				// Seedless set matches succeeding multiple successful matchers stipulate sorting
				if ( outermost && !seed && setMatched.length > 0 &&
					( matchedCount + setMatchers.length ) > 1 ) {

					Sizzle.uniqueSort( results );
				}
			}

			// Override manipulation of globals by nested matchers
			if ( outermost ) {
				dirruns = dirrunsUnique;
				outermostContext = contextBackup;
			}

			return unmatched;
		};

	return bySet ?
		markFunction( superMatcher ) :
		superMatcher;
}

compile = Sizzle.compile = function( selector, match /* Internal Use Only */ ) {
	var i,
		setMatchers = [],
		elementMatchers = [],
		cached = compilerCache[ selector + " " ];

	if ( !cached ) {
		// Generate a function of recursive functions that can be used to check each element
		if ( !match ) {
			match = tokenize( selector );
		}
		i = match.length;
		while ( i-- ) {
			cached = matcherFromTokens( match[i] );
			if ( cached[ expando ] ) {
				setMatchers.push( cached );
			} else {
				elementMatchers.push( cached );
			}
		}

		// Cache the compiled function
		cached = compilerCache( selector, matcherFromGroupMatchers( elementMatchers, setMatchers ) );

		// Save selector and tokenization
		cached.selector = selector;
	}
	return cached;
};

/**
 * A low-level selection function that works with Sizzle's compiled
 *  selector functions
 * @param {String|Function} selector A selector or a pre-compiled
 *  selector function built with Sizzle.compile
 * @param {Element} context
 * @param {Array} [results]
 * @param {Array} [seed] A set of elements to match against
 */
select = Sizzle.select = function( selector, context, results, seed ) {
	var i, tokens, token, type, find,
		compiled = typeof selector === "function" && selector,
		match = !seed && tokenize( (selector = compiled.selector || selector) );

	results = results || [];

	// Try to minimize operations if there is no seed and only one group
	if ( match.length === 1 ) {

		// Take a shortcut and set the context if the root selector is an ID
		tokens = match[0] = match[0].slice( 0 );
		if ( tokens.length > 2 && (token = tokens[0]).type === "ID" &&
				support.getById && context.nodeType === 9 && documentIsHTML &&
				Expr.relative[ tokens[1].type ] ) {

			context = ( Expr.find["ID"]( token.matches[0].replace(runescape, funescape), context ) || [] )[0];
			if ( !context ) {
				return results;

			// Precompiled matchers will still verify ancestry, so step up a level
			} else if ( compiled ) {
				context = context.parentNode;
			}

			selector = selector.slice( tokens.shift().value.length );
		}

		// Fetch a seed set for right-to-left matching
		i = matchExpr["needsContext"].test( selector ) ? 0 : tokens.length;
		while ( i-- ) {
			token = tokens[i];

			// Abort if we hit a combinator
			if ( Expr.relative[ (type = token.type) ] ) {
				break;
			}
			if ( (find = Expr.find[ type ]) ) {
				// Search, expanding context for leading sibling combinators
				if ( (seed = find(
					token.matches[0].replace( runescape, funescape ),
					rsibling.test( tokens[0].type ) && testContext( context.parentNode ) || context
				)) ) {

					// If seed is empty or no tokens remain, we can return early
					tokens.splice( i, 1 );
					selector = seed.length && toSelector( tokens );
					if ( !selector ) {
						push.apply( results, seed );
						return results;
					}

					break;
				}
			}
		}
	}

	// Compile and execute a filtering function if one is not provided
	// Provide `match` to avoid retokenization if we modified the selector above
	( compiled || compile( selector, match ) )(
		seed,
		context,
		!documentIsHTML,
		results,
		rsibling.test( selector ) && testContext( context.parentNode ) || context
	);
	return results;
};

// One-time assignments

// Sort stability
support.sortStable = expando.split("").sort( sortOrder ).join("") === expando;

// Support: Chrome 14-35+
// Always assume duplicates if they aren't passed to the comparison function
support.detectDuplicates = !!hasDuplicate;

// Initialize against the default document
setDocument();

// Support: Webkit<537.32 - Safari 6.0.3/Chrome 25 (fixed in Chrome 27)
// Detached nodes confoundingly follow *each other*
support.sortDetached = assert(function( div1 ) {
	// Should return 1, but returns 4 (following)
	return div1.compareDocumentPosition( document.createElement("div") ) & 1;
});

// Support: IE<8
// Prevent attribute/property "interpolation"
// http://msdn.microsoft.com/en-us/library/ms536429%28VS.85%29.aspx
if ( !assert(function( div ) {
	div.innerHTML = "<a href='#'></a>";
	return div.firstChild.getAttribute("href") === "#" ;
}) ) {
	addHandle( "type|href|height|width", function( elem, name, isXML ) {
		if ( !isXML ) {
			return elem.getAttribute( name, name.toLowerCase() === "type" ? 1 : 2 );
		}
	});
}

// Support: IE<9
// Use defaultValue in place of getAttribute("value")
if ( !support.attributes || !assert(function( div ) {
	div.innerHTML = "<input/>";
	div.firstChild.setAttribute( "value", "" );
	return div.firstChild.getAttribute( "value" ) === "";
}) ) {
	addHandle( "value", function( elem, name, isXML ) {
		if ( !isXML && elem.nodeName.toLowerCase() === "input" ) {
			return elem.defaultValue;
		}
	});
}

// Support: IE<9
// Use getAttributeNode to fetch booleans when getAttribute lies
if ( !assert(function( div ) {
	return div.getAttribute("disabled") == null;
}) ) {
	addHandle( booleans, function( elem, name, isXML ) {
		var val;
		if ( !isXML ) {
			return elem[ name ] === true ? name.toLowerCase() :
					(val = elem.getAttributeNode( name )) && val.specified ?
					val.value :
				null;
		}
	});
}

return Sizzle;

})( window );



jQuery.find = Sizzle;
jQuery.expr = Sizzle.selectors;
jQuery.expr[":"] = jQuery.expr.pseudos;
jQuery.unique = Sizzle.uniqueSort;
jQuery.text = Sizzle.getText;
jQuery.isXMLDoc = Sizzle.isXML;
jQuery.contains = Sizzle.contains;



var rneedsContext = jQuery.expr.match.needsContext;

var rsingleTag = (/^<(\w+)\s*\/?>(?:<\/\1>|)$/);



var risSimple = /^.[^:#\[\.,]*$/;

// Implement the identical functionality for filter and not
function winnow( elements, qualifier, not ) {
	if ( jQuery.isFunction( qualifier ) ) {
		return jQuery.grep( elements, function( elem, i ) {
			/* jshint -W018 */
			return !!qualifier.call( elem, i, elem ) !== not;
		});

	}

	if ( qualifier.nodeType ) {
		return jQuery.grep( elements, function( elem ) {
			return ( elem === qualifier ) !== not;
		});

	}

	if ( typeof qualifier === "string" ) {
		if ( risSimple.test( qualifier ) ) {
			return jQuery.filter( qualifier, elements, not );
		}

		qualifier = jQuery.filter( qualifier, elements );
	}

	return jQuery.grep( elements, function( elem ) {
		return ( indexOf.call( qualifier, elem ) >= 0 ) !== not;
	});
}

jQuery.filter = function( expr, elems, not ) {
	var elem = elems[ 0 ];

	if ( not ) {
		expr = ":not(" + expr + ")";
	}

	return elems.length === 1 && elem.nodeType === 1 ?
		jQuery.find.matchesSelector( elem, expr ) ? [ elem ] : [] :
		jQuery.find.matches( expr, jQuery.grep( elems, function( elem ) {
			return elem.nodeType === 1;
		}));
};

jQuery.fn.extend({
	find: function( selector ) {
		var i,
			len = this.length,
			ret = [],
			self = this;

		if ( typeof selector !== "string" ) {
			return this.pushStack( jQuery( selector ).filter(function() {
				for ( i = 0; i < len; i++ ) {
					if ( jQuery.contains( self[ i ], this ) ) {
						return true;
					}
				}
			}) );
		}

		for ( i = 0; i < len; i++ ) {
			jQuery.find( selector, self[ i ], ret );
		}

		// Needed because $( selector, context ) becomes $( context ).find( selector )
		ret = this.pushStack( len > 1 ? jQuery.unique( ret ) : ret );
		ret.selector = this.selector ? this.selector + " " + selector : selector;
		return ret;
	},
	filter: function( selector ) {
		return this.pushStack( winnow(this, selector || [], false) );
	},
	not: function( selector ) {
		return this.pushStack( winnow(this, selector || [], true) );
	},
	is: function( selector ) {
		return !!winnow(
			this,

			// If this is a positional/relative selector, check membership in the returned set
			// so $("p:first").is("p:last") won't return true for a doc with two "p".
			typeof selector === "string" && rneedsContext.test( selector ) ?
				jQuery( selector ) :
				selector || [],
			false
		).length;
	}
});


// Initialize a jQuery object


// A central reference to the root jQuery(document)
var rootjQuery,

	// A simple way to check for HTML strings
	// Prioritize #id over <tag> to avoid XSS via location.hash (#9521)
	// Strict HTML recognition (#11290: must start with <)
	rquickExpr = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,

	init = jQuery.fn.init = function( selector, context ) {
		var match, elem;

		// HANDLE: $(""), $(null), $(undefined), $(false)
		if ( !selector ) {
			return this;
		}

		// Handle HTML strings
		if ( typeof selector === "string" ) {
			if ( selector[0] === "<" && selector[ selector.length - 1 ] === ">" && selector.length >= 3 ) {
				// Assume that strings that start and end with <> are HTML and skip the regex check
				match = [ null, selector, null ];

			} else {
				match = rquickExpr.exec( selector );
			}

			// Match html or make sure no context is specified for #id
			if ( match && (match[1] || !context) ) {

				// HANDLE: $(html) -> $(array)
				if ( match[1] ) {
					context = context instanceof jQuery ? context[0] : context;

					// Option to run scripts is true for back-compat
					// Intentionally let the error be thrown if parseHTML is not present
					jQuery.merge( this, jQuery.parseHTML(
						match[1],
						context && context.nodeType ? context.ownerDocument || context : document,
						true
					) );

					// HANDLE: $(html, props)
					if ( rsingleTag.test( match[1] ) && jQuery.isPlainObject( context ) ) {
						for ( match in context ) {
							// Properties of context are called as methods if possible
							if ( jQuery.isFunction( this[ match ] ) ) {
								this[ match ]( context[ match ] );

							// ...and otherwise set as attributes
							} else {
								this.attr( match, context[ match ] );
							}
						}
					}

					return this;

				// HANDLE: $(#id)
				} else {
					elem = document.getElementById( match[2] );

					// Support: Blackberry 4.6
					// gEBID returns nodes no longer in the document (#6963)
					if ( elem && elem.parentNode ) {
						// Inject the element directly into the jQuery object
						this.length = 1;
						this[0] = elem;
					}

					this.context = document;
					this.selector = selector;
					return this;
				}

			// HANDLE: $(expr, $(...))
			} else if ( !context || context.jquery ) {
				return ( context || rootjQuery ).find( selector );

			// HANDLE: $(expr, context)
			// (which is just equivalent to: $(context).find(expr)
			} else {
				return this.constructor( context ).find( selector );
			}

		// HANDLE: $(DOMElement)
		} else if ( selector.nodeType ) {
			this.context = this[0] = selector;
			this.length = 1;
			return this;

		// HANDLE: $(function)
		// Shortcut for document ready
		} else if ( jQuery.isFunction( selector ) ) {
			return typeof rootjQuery.ready !== "undefined" ?
				rootjQuery.ready( selector ) :
				// Execute immediately if ready is not present
				selector( jQuery );
		}

		if ( selector.selector !== undefined ) {
			this.selector = selector.selector;
			this.context = selector.context;
		}

		return jQuery.makeArray( selector, this );
	};

// Give the init function the jQuery prototype for later instantiation
init.prototype = jQuery.fn;

// Initialize central reference
rootjQuery = jQuery( document );


var rparentsprev = /^(?:parents|prev(?:Until|All))/,
	// Methods guaranteed to produce a unique set when starting from a unique set
	guaranteedUnique = {
		children: true,
		contents: true,
		next: true,
		prev: true
	};

jQuery.extend({
	dir: function( elem, dir, until ) {
		var matched = [],
			truncate = until !== undefined;

		while ( (elem = elem[ dir ]) && elem.nodeType !== 9 ) {
			if ( elem.nodeType === 1 ) {
				if ( truncate && jQuery( elem ).is( until ) ) {
					break;
				}
				matched.push( elem );
			}
		}
		return matched;
	},

	sibling: function( n, elem ) {
		var matched = [];

		for ( ; n; n = n.nextSibling ) {
			if ( n.nodeType === 1 && n !== elem ) {
				matched.push( n );
			}
		}

		return matched;
	}
});

jQuery.fn.extend({
	has: function( target ) {
		var targets = jQuery( target, this ),
			l = targets.length;

		return this.filter(function() {
			var i = 0;
			for ( ; i < l; i++ ) {
				if ( jQuery.contains( this, targets[i] ) ) {
					return true;
				}
			}
		});
	},

	closest: function( selectors, context ) {
		var cur,
			i = 0,
			l = this.length,
			matched = [],
			pos = rneedsContext.test( selectors ) || typeof selectors !== "string" ?
				jQuery( selectors, context || this.context ) :
				0;

		for ( ; i < l; i++ ) {
			for ( cur = this[i]; cur && cur !== context; cur = cur.parentNode ) {
				// Always skip document fragments
				if ( cur.nodeType < 11 && (pos ?
					pos.index(cur) > -1 :

					// Don't pass non-elements to Sizzle
					cur.nodeType === 1 &&
						jQuery.find.matchesSelector(cur, selectors)) ) {

					matched.push( cur );
					break;
				}
			}
		}

		return this.pushStack( matched.length > 1 ? jQuery.unique( matched ) : matched );
	},

	// Determine the position of an element within the set
	index: function( elem ) {

		// No argument, return index in parent
		if ( !elem ) {
			return ( this[ 0 ] && this[ 0 ].parentNode ) ? this.first().prevAll().length : -1;
		}

		// Index in selector
		if ( typeof elem === "string" ) {
			return indexOf.call( jQuery( elem ), this[ 0 ] );
		}

		// Locate the position of the desired element
		return indexOf.call( this,

			// If it receives a jQuery object, the first element is used
			elem.jquery ? elem[ 0 ] : elem
		);
	},

	add: function( selector, context ) {
		return this.pushStack(
			jQuery.unique(
				jQuery.merge( this.get(), jQuery( selector, context ) )
			)
		);
	},

	addBack: function( selector ) {
		return this.add( selector == null ?
			this.prevObject : this.prevObject.filter(selector)
		);
	}
});

function sibling( cur, dir ) {
	while ( (cur = cur[dir]) && cur.nodeType !== 1 ) {}
	return cur;
}

jQuery.each({
	parent: function( elem ) {
		var parent = elem.parentNode;
		return parent && parent.nodeType !== 11 ? parent : null;
	},
	parents: function( elem ) {
		return jQuery.dir( elem, "parentNode" );
	},
	parentsUntil: function( elem, i, until ) {
		return jQuery.dir( elem, "parentNode", until );
	},
	next: function( elem ) {
		return sibling( elem, "nextSibling" );
	},
	prev: function( elem ) {
		return sibling( elem, "previousSibling" );
	},
	nextAll: function( elem ) {
		return jQuery.dir( elem, "nextSibling" );
	},
	prevAll: function( elem ) {
		return jQuery.dir( elem, "previousSibling" );
	},
	nextUntil: function( elem, i, until ) {
		return jQuery.dir( elem, "nextSibling", until );
	},
	prevUntil: function( elem, i, until ) {
		return jQuery.dir( elem, "previousSibling", until );
	},
	siblings: function( elem ) {
		return jQuery.sibling( ( elem.parentNode || {} ).firstChild, elem );
	},
	children: function( elem ) {
		return jQuery.sibling( elem.firstChild );
	},
	contents: function( elem ) {
		return elem.contentDocument || jQuery.merge( [], elem.childNodes );
	}
}, function( name, fn ) {
	jQuery.fn[ name ] = function( until, selector ) {
		var matched = jQuery.map( this, fn, until );

		if ( name.slice( -5 ) !== "Until" ) {
			selector = until;
		}

		if ( selector && typeof selector === "string" ) {
			matched = jQuery.filter( selector, matched );
		}

		if ( this.length > 1 ) {
			// Remove duplicates
			if ( !guaranteedUnique[ name ] ) {
				jQuery.unique( matched );
			}

			// Reverse order for parents* and prev-derivatives
			if ( rparentsprev.test( name ) ) {
				matched.reverse();
			}
		}

		return this.pushStack( matched );
	};
});
var rnotwhite = (/\S+/g);



// String to Object options format cache
var optionsCache = {};

// Convert String-formatted options into Object-formatted ones and store in cache
function createOptions( options ) {
	var object = optionsCache[ options ] = {};
	jQuery.each( options.match( rnotwhite ) || [], function( _, flag ) {
		object[ flag ] = true;
	});
	return object;
}

/*
 * Create a callback list using the following parameters:
 *
 *	options: an optional list of space-separated options that will change how
 *			the callback list behaves or a more traditional option object
 *
 * By default a callback list will act like an event callback list and can be
 * "fired" multiple times.
 *
 * Possible options:
 *
 *	once:			will ensure the callback list can only be fired once (like a Deferred)
 *
 *	memory:			will keep track of previous values and will call any callback added
 *					after the list has been fired right away with the latest "memorized"
 *					values (like a Deferred)
 *
 *	unique:			will ensure a callback can only be added once (no duplicate in the list)
 *
 *	stopOnFalse:	interrupt callings when a callback returns false
 *
 */
jQuery.Callbacks = function( options ) {

	// Convert options from String-formatted to Object-formatted if needed
	// (we check in cache first)
	options = typeof options === "string" ?
		( optionsCache[ options ] || createOptions( options ) ) :
		jQuery.extend( {}, options );

	var // Last fire value (for non-forgettable lists)
		memory,
		// Flag to know if list was already fired
		fired,
		// Flag to know if list is currently firing
		firing,
		// First callback to fire (used internally by add and fireWith)
		firingStart,
		// End of the loop when firing
		firingLength,
		// Index of currently firing callback (modified by remove if needed)
		firingIndex,
		// Actual callback list
		list = [],
		// Stack of fire calls for repeatable lists
		stack = !options.once && [],
		// Fire callbacks
		fire = function( data ) {
			memory = options.memory && data;
			fired = true;
			firingIndex = firingStart || 0;
			firingStart = 0;
			firingLength = list.length;
			firing = true;
			for ( ; list && firingIndex < firingLength; firingIndex++ ) {
				if ( list[ firingIndex ].apply( data[ 0 ], data[ 1 ] ) === false && options.stopOnFalse ) {
					memory = false; // To prevent further calls using add
					break;
				}
			}
			firing = false;
			if ( list ) {
				if ( stack ) {
					if ( stack.length ) {
						fire( stack.shift() );
					}
				} else if ( memory ) {
					list = [];
				} else {
					self.disable();
				}
			}
		},
		// Actual Callbacks object
		self = {
			// Add a callback or a collection of callbacks to the list
			add: function() {
				if ( list ) {
					// First, we save the current length
					var start = list.length;
					(function add( args ) {
						jQuery.each( args, function( _, arg ) {
							var type = jQuery.type( arg );
							if ( type === "function" ) {
								if ( !options.unique || !self.has( arg ) ) {
									list.push( arg );
								}
							} else if ( arg && arg.length && type !== "string" ) {
								// Inspect recursively
								add( arg );
							}
						});
					})( arguments );
					// Do we need to add the callbacks to the
					// current firing batch?
					if ( firing ) {
						firingLength = list.length;
					// With memory, if we're not firing then
					// we should call right away
					} else if ( memory ) {
						firingStart = start;
						fire( memory );
					}
				}
				return this;
			},
			// Remove a callback from the list
			remove: function() {
				if ( list ) {
					jQuery.each( arguments, function( _, arg ) {
						var index;
						while ( ( index = jQuery.inArray( arg, list, index ) ) > -1 ) {
							list.splice( index, 1 );
							// Handle firing indexes
							if ( firing ) {
								if ( index <= firingLength ) {
									firingLength--;
								}
								if ( index <= firingIndex ) {
									firingIndex--;
								}
							}
						}
					});
				}
				return this;
			},
			// Check if a given callback is in the list.
			// If no argument is given, return whether or not list has callbacks attached.
			has: function( fn ) {
				return fn ? jQuery.inArray( fn, list ) > -1 : !!( list && list.length );
			},
			// Remove all callbacks from the list
			empty: function() {
				list = [];
				firingLength = 0;
				return this;
			},
			// Have the list do nothing anymore
			disable: function() {
				list = stack = memory = undefined;
				return this;
			},
			// Is it disabled?
			disabled: function() {
				return !list;
			},
			// Lock the list in its current state
			lock: function() {
				stack = undefined;
				if ( !memory ) {
					self.disable();
				}
				return this;
			},
			// Is it locked?
			locked: function() {
				return !stack;
			},
			// Call all callbacks with the given context and arguments
			fireWith: function( context, args ) {
				if ( list && ( !fired || stack ) ) {
					args = args || [];
					args = [ context, args.slice ? args.slice() : args ];
					if ( firing ) {
						stack.push( args );
					} else {
						fire( args );
					}
				}
				return this;
			},
			// Call all the callbacks with the given arguments
			fire: function() {
				self.fireWith( this, arguments );
				return this;
			},
			// To know if the callbacks have already been called at least once
			fired: function() {
				return !!fired;
			}
		};

	return self;
};


jQuery.extend({

	Deferred: function( func ) {
		var tuples = [
				// action, add listener, listener list, final state
				[ "resolve", "done", jQuery.Callbacks("once memory"), "resolved" ],
				[ "reject", "fail", jQuery.Callbacks("once memory"), "rejected" ],
				[ "notify", "progress", jQuery.Callbacks("memory") ]
			],
			state = "pending",
			promise = {
				state: function() {
					return state;
				},
				always: function() {
					deferred.done( arguments ).fail( arguments );
					return this;
				},
				then: function( /* fnDone, fnFail, fnProgress */ ) {
					var fns = arguments;
					return jQuery.Deferred(function( newDefer ) {
						jQuery.each( tuples, function( i, tuple ) {
							var fn = jQuery.isFunction( fns[ i ] ) && fns[ i ];
							// deferred[ done | fail | progress ] for forwarding actions to newDefer
							deferred[ tuple[1] ](function() {
								var returned = fn && fn.apply( this, arguments );
								if ( returned && jQuery.isFunction( returned.promise ) ) {
									returned.promise()
										.done( newDefer.resolve )
										.fail( newDefer.reject )
										.progress( newDefer.notify );
								} else {
									newDefer[ tuple[ 0 ] + "With" ]( this === promise ? newDefer.promise() : this, fn ? [ returned ] : arguments );
								}
							});
						});
						fns = null;
					}).promise();
				},
				// Get a promise for this deferred
				// If obj is provided, the promise aspect is added to the object
				promise: function( obj ) {
					return obj != null ? jQuery.extend( obj, promise ) : promise;
				}
			},
			deferred = {};

		// Keep pipe for back-compat
		promise.pipe = promise.then;

		// Add list-specific methods
		jQuery.each( tuples, function( i, tuple ) {
			var list = tuple[ 2 ],
				stateString = tuple[ 3 ];

			// promise[ done | fail | progress ] = list.add
			promise[ tuple[1] ] = list.add;

			// Handle state
			if ( stateString ) {
				list.add(function() {
					// state = [ resolved | rejected ]
					state = stateString;

				// [ reject_list | resolve_list ].disable; progress_list.lock
				}, tuples[ i ^ 1 ][ 2 ].disable, tuples[ 2 ][ 2 ].lock );
			}

			// deferred[ resolve | reject | notify ]
			deferred[ tuple[0] ] = function() {
				deferred[ tuple[0] + "With" ]( this === deferred ? promise : this, arguments );
				return this;
			};
			deferred[ tuple[0] + "With" ] = list.fireWith;
		});

		// Make the deferred a promise
		promise.promise( deferred );

		// Call given func if any
		if ( func ) {
			func.call( deferred, deferred );
		}

		// All done!
		return deferred;
	},

	// Deferred helper
	when: function( subordinate /* , ..., subordinateN */ ) {
		var i = 0,
			resolveValues = slice.call( arguments ),
			length = resolveValues.length,

			// the count of uncompleted subordinates
			remaining = length !== 1 || ( subordinate && jQuery.isFunction( subordinate.promise ) ) ? length : 0,

			// the master Deferred. If resolveValues consist of only a single Deferred, just use that.
			deferred = remaining === 1 ? subordinate : jQuery.Deferred(),

			// Update function for both resolve and progress values
			updateFunc = function( i, contexts, values ) {
				return function( value ) {
					contexts[ i ] = this;
					values[ i ] = arguments.length > 1 ? slice.call( arguments ) : value;
					if ( values === progressValues ) {
						deferred.notifyWith( contexts, values );
					} else if ( !( --remaining ) ) {
						deferred.resolveWith( contexts, values );
					}
				};
			},

			progressValues, progressContexts, resolveContexts;

		// Add listeners to Deferred subordinates; treat others as resolved
		if ( length > 1 ) {
			progressValues = new Array( length );
			progressContexts = new Array( length );
			resolveContexts = new Array( length );
			for ( ; i < length; i++ ) {
				if ( resolveValues[ i ] && jQuery.isFunction( resolveValues[ i ].promise ) ) {
					resolveValues[ i ].promise()
						.done( updateFunc( i, resolveContexts, resolveValues ) )
						.fail( deferred.reject )
						.progress( updateFunc( i, progressContexts, progressValues ) );
				} else {
					--remaining;
				}
			}
		}

		// If we're not waiting on anything, resolve the master
		if ( !remaining ) {
			deferred.resolveWith( resolveContexts, resolveValues );
		}

		return deferred.promise();
	}
});


// The deferred used on DOM ready
var readyList;

jQuery.fn.ready = function( fn ) {
	// Add the callback
	jQuery.ready.promise().done( fn );

	return this;
};

jQuery.extend({
	// Is the DOM ready to be used? Set to true once it occurs.
	isReady: false,

	// A counter to track how many items to wait for before
	// the ready event fires. See #6781
	readyWait: 1,

	// Hold (or release) the ready event
	holdReady: function( hold ) {
		if ( hold ) {
			jQuery.readyWait++;
		} else {
			jQuery.ready( true );
		}
	},

	// Handle when the DOM is ready
	ready: function( wait ) {

		// Abort if there are pending holds or we're already ready
		if ( wait === true ? --jQuery.readyWait : jQuery.isReady ) {
			return;
		}

		// Remember that the DOM is ready
		jQuery.isReady = true;

		// If a normal DOM Ready event fired, decrement, and wait if need be
		if ( wait !== true && --jQuery.readyWait > 0 ) {
			return;
		}

		// If there are functions bound, to execute
		readyList.resolveWith( document, [ jQuery ] );

		// Trigger any bound ready events
		if ( jQuery.fn.triggerHandler ) {
			jQuery( document ).triggerHandler( "ready" );
			jQuery( document ).off( "ready" );
		}
	}
});

/**
 * The ready event handler and self cleanup method
 */
function completed() {
	document.removeEventListener( "DOMContentLoaded", completed, false );
	window.removeEventListener( "load", completed, false );
	jQuery.ready();
}

jQuery.ready.promise = function( obj ) {
	if ( !readyList ) {

		readyList = jQuery.Deferred();

		// Catch cases where $(document).ready() is called after the browser event has already occurred.
		// We once tried to use readyState "interactive" here, but it caused issues like the one
		// discovered by ChrisS here: http://bugs.jquery.com/ticket/12282#comment:15
		if ( document.readyState === "complete" ) {
			// Handle it asynchronously to allow scripts the opportunity to delay ready
			setTimeout( jQuery.ready );

		} else {

			// Use the handy event callback
			document.addEventListener( "DOMContentLoaded", completed, false );

			// A fallback to window.onload, that will always work
			window.addEventListener( "load", completed, false );
		}
	}
	return readyList.promise( obj );
};

// Kick off the DOM ready check even if the user does not
jQuery.ready.promise();




// Multifunctional method to get and set values of a collection
// The value/s can optionally be executed if it's a function
var access = jQuery.access = function( elems, fn, key, value, chainable, emptyGet, raw ) {
	var i = 0,
		len = elems.length,
		bulk = key == null;

	// Sets many values
	if ( jQuery.type( key ) === "object" ) {
		chainable = true;
		for ( i in key ) {
			jQuery.access( elems, fn, i, key[i], true, emptyGet, raw );
		}

	// Sets one value
	} else if ( value !== undefined ) {
		chainable = true;

		if ( !jQuery.isFunction( value ) ) {
			raw = true;
		}

		if ( bulk ) {
			// Bulk operations run against the entire set
			if ( raw ) {
				fn.call( elems, value );
				fn = null;

			// ...except when executing function values
			} else {
				bulk = fn;
				fn = function( elem, key, value ) {
					return bulk.call( jQuery( elem ), value );
				};
			}
		}

		if ( fn ) {
			for ( ; i < len; i++ ) {
				fn( elems[i], key, raw ? value : value.call( elems[i], i, fn( elems[i], key ) ) );
			}
		}
	}

	return chainable ?
		elems :

		// Gets
		bulk ?
			fn.call( elems ) :
			len ? fn( elems[0], key ) : emptyGet;
};


/**
 * Determines whether an object can have data
 */
jQuery.acceptData = function( owner ) {
	// Accepts only:
	//  - Node
	//    - Node.ELEMENT_NODE
	//    - Node.DOCUMENT_NODE
	//  - Object
	//    - Any
	/* jshint -W018 */
	return owner.nodeType === 1 || owner.nodeType === 9 || !( +owner.nodeType );
};


function Data() {
	// Support: Android<4,
	// Old WebKit does not have Object.preventExtensions/freeze method,
	// return new empty object instead with no [[set]] accessor
	Object.defineProperty( this.cache = {}, 0, {
		get: function() {
			return {};
		}
	});

	this.expando = jQuery.expando + Data.uid++;
}

Data.uid = 1;
Data.accepts = jQuery.acceptData;

Data.prototype = {
	key: function( owner ) {
		// We can accept data for non-element nodes in modern browsers,
		// but we should not, see #8335.
		// Always return the key for a frozen object.
		if ( !Data.accepts( owner ) ) {
			return 0;
		}

		var descriptor = {},
			// Check if the owner object already has a cache key
			unlock = owner[ this.expando ];

		// If not, create one
		if ( !unlock ) {
			unlock = Data.uid++;

			// Secure it in a non-enumerable, non-writable property
			try {
				descriptor[ this.expando ] = { value: unlock };
				Object.defineProperties( owner, descriptor );

			// Support: Android<4
			// Fallback to a less secure definition
			} catch ( e ) {
				descriptor[ this.expando ] = unlock;
				jQuery.extend( owner, descriptor );
			}
		}

		// Ensure the cache object
		if ( !this.cache[ unlock ] ) {
			this.cache[ unlock ] = {};
		}

		return unlock;
	},
	set: function( owner, data, value ) {
		var prop,
			// There may be an unlock assigned to this node,
			// if there is no entry for this "owner", create one inline
			// and set the unlock as though an owner entry had always existed
			unlock = this.key( owner ),
			cache = this.cache[ unlock ];

		// Handle: [ owner, key, value ] args
		if ( typeof data === "string" ) {
			cache[ data ] = value;

		// Handle: [ owner, { properties } ] args
		} else {
			// Fresh assignments by object are shallow copied
			if ( jQuery.isEmptyObject( cache ) ) {
				jQuery.extend( this.cache[ unlock ], data );
			// Otherwise, copy the properties one-by-one to the cache object
			} else {
				for ( prop in data ) {
					cache[ prop ] = data[ prop ];
				}
			}
		}
		return cache;
	},
	get: function( owner, key ) {
		// Either a valid cache is found, or will be created.
		// New caches will be created and the unlock returned,
		// allowing direct access to the newly created
		// empty data object. A valid owner object must be provided.
		var cache = this.cache[ this.key( owner ) ];

		return key === undefined ?
			cache : cache[ key ];
	},
	access: function( owner, key, value ) {
		var stored;
		// In cases where either:
		//
		//   1. No key was specified
		//   2. A string key was specified, but no value provided
		//
		// Take the "read" path and allow the get method to determine
		// which value to return, respectively either:
		//
		//   1. The entire cache object
		//   2. The data stored at the key
		//
		if ( key === undefined ||
				((key && typeof key === "string") && value === undefined) ) {

			stored = this.get( owner, key );

			return stored !== undefined ?
				stored : this.get( owner, jQuery.camelCase(key) );
		}

		// [*]When the key is not a string, or both a key and value
		// are specified, set or extend (existing objects) with either:
		//
		//   1. An object of properties
		//   2. A key and value
		//
		this.set( owner, key, value );

		// Since the "set" path can have two possible entry points
		// return the expected data based on which path was taken[*]
		return value !== undefined ? value : key;
	},
	remove: function( owner, key ) {
		var i, name, camel,
			unlock = this.key( owner ),
			cache = this.cache[ unlock ];

		if ( key === undefined ) {
			this.cache[ unlock ] = {};

		} else {
			// Support array or space separated string of keys
			if ( jQuery.isArray( key ) ) {
				// If "name" is an array of keys...
				// When data is initially created, via ("key", "val") signature,
				// keys will be converted to camelCase.
				// Since there is no way to tell _how_ a key was added, remove
				// both plain key and camelCase key. #12786
				// This will only penalize the array argument path.
				name = key.concat( key.map( jQuery.camelCase ) );
			} else {
				camel = jQuery.camelCase( key );
				// Try the string as a key before any manipulation
				if ( key in cache ) {
					name = [ key, camel ];
				} else {
					// If a key with the spaces exists, use it.
					// Otherwise, create an array by matching non-whitespace
					name = camel;
					name = name in cache ?
						[ name ] : ( name.match( rnotwhite ) || [] );
				}
			}

			i = name.length;
			while ( i-- ) {
				delete cache[ name[ i ] ];
			}
		}
	},
	hasData: function( owner ) {
		return !jQuery.isEmptyObject(
			this.cache[ owner[ this.expando ] ] || {}
		);
	},
	discard: function( owner ) {
		if ( owner[ this.expando ] ) {
			delete this.cache[ owner[ this.expando ] ];
		}
	}
};
var data_priv = new Data();

var data_user = new Data();



//	Implementation Summary
//
//	1. Enforce API surface and semantic compatibility with 1.9.x branch
//	2. Improve the module's maintainability by reducing the storage
//		paths to a single mechanism.
//	3. Use the same single mechanism to support "private" and "user" data.
//	4. _Never_ expose "private" data to user code (TODO: Drop _data, _removeData)
//	5. Avoid exposing implementation details on user objects (eg. expando properties)
//	6. Provide a clear path for implementation upgrade to WeakMap in 2014

var rbrace = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
	rmultiDash = /([A-Z])/g;

function dataAttr( elem, key, data ) {
	var name;

	// If nothing was found internally, try to fetch any
	// data from the HTML5 data-* attribute
	if ( data === undefined && elem.nodeType === 1 ) {
		name = "data-" + key.replace( rmultiDash, "-$1" ).toLowerCase();
		data = elem.getAttribute( name );

		if ( typeof data === "string" ) {
			try {
				data = data === "true" ? true :
					data === "false" ? false :
					data === "null" ? null :
					// Only convert to a number if it doesn't change the string
					+data + "" === data ? +data :
					rbrace.test( data ) ? jQuery.parseJSON( data ) :
					data;
			} catch( e ) {}

			// Make sure we set the data so it isn't changed later
			data_user.set( elem, key, data );
		} else {
			data = undefined;
		}
	}
	return data;
}

jQuery.extend({
	hasData: function( elem ) {
		return data_user.hasData( elem ) || data_priv.hasData( elem );
	},

	data: function( elem, name, data ) {
		return data_user.access( elem, name, data );
	},

	removeData: function( elem, name ) {
		data_user.remove( elem, name );
	},

	// TODO: Now that all calls to _data and _removeData have been replaced
	// with direct calls to data_priv methods, these can be deprecated.
	_data: function( elem, name, data ) {
		return data_priv.access( elem, name, data );
	},

	_removeData: function( elem, name ) {
		data_priv.remove( elem, name );
	}
});

jQuery.fn.extend({
	data: function( key, value ) {
		var i, name, data,
			elem = this[ 0 ],
			attrs = elem && elem.attributes;

		// Gets all values
		if ( key === undefined ) {
			if ( this.length ) {
				data = data_user.get( elem );

				if ( elem.nodeType === 1 && !data_priv.get( elem, "hasDataAttrs" ) ) {
					i = attrs.length;
					while ( i-- ) {

						// Support: IE11+
						// The attrs elements can be null (#14894)
						if ( attrs[ i ] ) {
							name = attrs[ i ].name;
							if ( name.indexOf( "data-" ) === 0 ) {
								name = jQuery.camelCase( name.slice(5) );
								dataAttr( elem, name, data[ name ] );
							}
						}
					}
					data_priv.set( elem, "hasDataAttrs", true );
				}
			}

			return data;
		}

		// Sets multiple values
		if ( typeof key === "object" ) {
			return this.each(function() {
				data_user.set( this, key );
			});
		}

		return access( this, function( value ) {
			var data,
				camelKey = jQuery.camelCase( key );

			// The calling jQuery object (element matches) is not empty
			// (and therefore has an element appears at this[ 0 ]) and the
			// `value` parameter was not undefined. An empty jQuery object
			// will result in `undefined` for elem = this[ 0 ] which will
			// throw an exception if an attempt to read a data cache is made.
			if ( elem && value === undefined ) {
				// Attempt to get data from the cache
				// with the key as-is
				data = data_user.get( elem, key );
				if ( data !== undefined ) {
					return data;
				}

				// Attempt to get data from the cache
				// with the key camelized
				data = data_user.get( elem, camelKey );
				if ( data !== undefined ) {
					return data;
				}

				// Attempt to "discover" the data in
				// HTML5 custom data-* attrs
				data = dataAttr( elem, camelKey, undefined );
				if ( data !== undefined ) {
					return data;
				}

				// We tried really hard, but the data doesn't exist.
				return;
			}

			// Set the data...
			this.each(function() {
				// First, attempt to store a copy or reference of any
				// data that might've been store with a camelCased key.
				var data = data_user.get( this, camelKey );

				// For HTML5 data-* attribute interop, we have to
				// store property names with dashes in a camelCase form.
				// This might not apply to all properties...*
				data_user.set( this, camelKey, value );

				// *... In the case of properties that might _actually_
				// have dashes, we need to also store a copy of that
				// unchanged property.
				if ( key.indexOf("-") !== -1 && data !== undefined ) {
					data_user.set( this, key, value );
				}
			});
		}, null, value, arguments.length > 1, null, true );
	},

	removeData: function( key ) {
		return this.each(function() {
			data_user.remove( this, key );
		});
	}
});


jQuery.extend({
	queue: function( elem, type, data ) {
		var queue;

		if ( elem ) {
			type = ( type || "fx" ) + "queue";
			queue = data_priv.get( elem, type );

			// Speed up dequeue by getting out quickly if this is just a lookup
			if ( data ) {
				if ( !queue || jQuery.isArray( data ) ) {
					queue = data_priv.access( elem, type, jQuery.makeArray(data) );
				} else {
					queue.push( data );
				}
			}
			return queue || [];
		}
	},

	dequeue: function( elem, type ) {
		type = type || "fx";

		var queue = jQuery.queue( elem, type ),
			startLength = queue.length,
			fn = queue.shift(),
			hooks = jQuery._queueHooks( elem, type ),
			next = function() {
				jQuery.dequeue( elem, type );
			};

		// If the fx queue is dequeued, always remove the progress sentinel
		if ( fn === "inprogress" ) {
			fn = queue.shift();
			startLength--;
		}

		if ( fn ) {

			// Add a progress sentinel to prevent the fx queue from being
			// automatically dequeued
			if ( type === "fx" ) {
				queue.unshift( "inprogress" );
			}

			// Clear up the last queue stop function
			delete hooks.stop;
			fn.call( elem, next, hooks );
		}

		if ( !startLength && hooks ) {
			hooks.empty.fire();
		}
	},

	// Not public - generate a queueHooks object, or return the current one
	_queueHooks: function( elem, type ) {
		var key = type + "queueHooks";
		return data_priv.get( elem, key ) || data_priv.access( elem, key, {
			empty: jQuery.Callbacks("once memory").add(function() {
				data_priv.remove( elem, [ type + "queue", key ] );
			})
		});
	}
});

jQuery.fn.extend({
	queue: function( type, data ) {
		var setter = 2;

		if ( typeof type !== "string" ) {
			data = type;
			type = "fx";
			setter--;
		}

		if ( arguments.length < setter ) {
			return jQuery.queue( this[0], type );
		}

		return data === undefined ?
			this :
			this.each(function() {
				var queue = jQuery.queue( this, type, data );

				// Ensure a hooks for this queue
				jQuery._queueHooks( this, type );

				if ( type === "fx" && queue[0] !== "inprogress" ) {
					jQuery.dequeue( this, type );
				}
			});
	},
	dequeue: function( type ) {
		return this.each(function() {
			jQuery.dequeue( this, type );
		});
	},
	clearQueue: function( type ) {
		return this.queue( type || "fx", [] );
	},
	// Get a promise resolved when queues of a certain type
	// are emptied (fx is the type by default)
	promise: function( type, obj ) {
		var tmp,
			count = 1,
			defer = jQuery.Deferred(),
			elements = this,
			i = this.length,
			resolve = function() {
				if ( !( --count ) ) {
					defer.resolveWith( elements, [ elements ] );
				}
			};

		if ( typeof type !== "string" ) {
			obj = type;
			type = undefined;
		}
		type = type || "fx";

		while ( i-- ) {
			tmp = data_priv.get( elements[ i ], type + "queueHooks" );
			if ( tmp && tmp.empty ) {
				count++;
				tmp.empty.add( resolve );
			}
		}
		resolve();
		return defer.promise( obj );
	}
});
var pnum = (/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/).source;

var cssExpand = [ "Top", "Right", "Bottom", "Left" ];

var isHidden = function( elem, el ) {
		// isHidden might be called from jQuery#filter function;
		// in that case, element will be second argument
		elem = el || elem;
		return jQuery.css( elem, "display" ) === "none" || !jQuery.contains( elem.ownerDocument, elem );
	};

var rcheckableType = (/^(?:checkbox|radio)$/i);



(function() {
	var fragment = document.createDocumentFragment(),
		div = fragment.appendChild( document.createElement( "div" ) ),
		input = document.createElement( "input" );

	// Support: Safari<=5.1
	// Check state lost if the name is set (#11217)
	// Support: Windows Web Apps (WWA)
	// `name` and `type` must use .setAttribute for WWA (#14901)
	input.setAttribute( "type", "radio" );
	input.setAttribute( "checked", "checked" );
	input.setAttribute( "name", "t" );

	div.appendChild( input );

	// Support: Safari<=5.1, Android<4.2
	// Older WebKit doesn't clone checked state correctly in fragments
	support.checkClone = div.cloneNode( true ).cloneNode( true ).lastChild.checked;

	// Support: IE<=11+
	// Make sure textarea (and checkbox) defaultValue is properly cloned
	div.innerHTML = "<textarea>x</textarea>";
	support.noCloneChecked = !!div.cloneNode( true ).lastChild.defaultValue;
})();
var strundefined = typeof undefined;



support.focusinBubbles = "onfocusin" in window;


var
	rkeyEvent = /^key/,
	rmouseEvent = /^(?:mouse|pointer|contextmenu)|click/,
	rfocusMorph = /^(?:focusinfocus|focusoutblur)$/,
	rtypenamespace = /^([^.]*)(?:\.(.+)|)$/;

function returnTrue() {
	return true;
}

function returnFalse() {
	return false;
}

function safeActiveElement() {
	try {
		return document.activeElement;
	} catch ( err ) { }
}

/*
 * Helper functions for managing events -- not part of the public interface.
 * Props to Dean Edwards' addEvent library for many of the ideas.
 */
jQuery.event = {

	global: {},

	add: function( elem, types, handler, data, selector ) {

		var handleObjIn, eventHandle, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = data_priv.get( elem );

		// Don't attach events to noData or text/comment nodes (but allow plain objects)
		if ( !elemData ) {
			return;
		}

		// Caller can pass in an object of custom data in lieu of the handler
		if ( handler.handler ) {
			handleObjIn = handler;
			handler = handleObjIn.handler;
			selector = handleObjIn.selector;
		}

		// Make sure that the handler has a unique ID, used to find/remove it later
		if ( !handler.guid ) {
			handler.guid = jQuery.guid++;
		}

		// Init the element's event structure and main handler, if this is the first
		if ( !(events = elemData.events) ) {
			events = elemData.events = {};
		}
		if ( !(eventHandle = elemData.handle) ) {
			eventHandle = elemData.handle = function( e ) {
				// Discard the second event of a jQuery.event.trigger() and
				// when an event is called after a page has unloaded
				return typeof jQuery !== strundefined && jQuery.event.triggered !== e.type ?
					jQuery.event.dispatch.apply( elem, arguments ) : undefined;
			};
		}

		// Handle multiple events separated by a space
		types = ( types || "" ).match( rnotwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[t] ) || [];
			type = origType = tmp[1];
			namespaces = ( tmp[2] || "" ).split( "." ).sort();

			// There *must* be a type, no attaching namespace-only handlers
			if ( !type ) {
				continue;
			}

			// If event changes its type, use the special event handlers for the changed type
			special = jQuery.event.special[ type ] || {};

			// If selector defined, determine special event api type, otherwise given type
			type = ( selector ? special.delegateType : special.bindType ) || type;

			// Update special based on newly reset type
			special = jQuery.event.special[ type ] || {};

			// handleObj is passed to all event handlers
			handleObj = jQuery.extend({
				type: type,
				origType: origType,
				data: data,
				handler: handler,
				guid: handler.guid,
				selector: selector,
				needsContext: selector && jQuery.expr.match.needsContext.test( selector ),
				namespace: namespaces.join(".")
			}, handleObjIn );

			// Init the event handler queue if we're the first
			if ( !(handlers = events[ type ]) ) {
				handlers = events[ type ] = [];
				handlers.delegateCount = 0;

				// Only use addEventListener if the special events handler returns false
				if ( !special.setup || special.setup.call( elem, data, namespaces, eventHandle ) === false ) {
					if ( elem.addEventListener ) {
						elem.addEventListener( type, eventHandle, false );
					}
				}
			}

			if ( special.add ) {
				special.add.call( elem, handleObj );

				if ( !handleObj.handler.guid ) {
					handleObj.handler.guid = handler.guid;
				}
			}

			// Add to the element's handler list, delegates in front
			if ( selector ) {
				handlers.splice( handlers.delegateCount++, 0, handleObj );
			} else {
				handlers.push( handleObj );
			}

			// Keep track of which events have ever been used, for event optimization
			jQuery.event.global[ type ] = true;
		}

	},

	// Detach an event or set of events from an element
	remove: function( elem, types, handler, selector, mappedTypes ) {

		var j, origCount, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = data_priv.hasData( elem ) && data_priv.get( elem );

		if ( !elemData || !(events = elemData.events) ) {
			return;
		}

		// Once for each type.namespace in types; type may be omitted
		types = ( types || "" ).match( rnotwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[t] ) || [];
			type = origType = tmp[1];
			namespaces = ( tmp[2] || "" ).split( "." ).sort();

			// Unbind all events (on this namespace, if provided) for the element
			if ( !type ) {
				for ( type in events ) {
					jQuery.event.remove( elem, type + types[ t ], handler, selector, true );
				}
				continue;
			}

			special = jQuery.event.special[ type ] || {};
			type = ( selector ? special.delegateType : special.bindType ) || type;
			handlers = events[ type ] || [];
			tmp = tmp[2] && new RegExp( "(^|\\.)" + namespaces.join("\\.(?:.*\\.|)") + "(\\.|$)" );

			// Remove matching events
			origCount = j = handlers.length;
			while ( j-- ) {
				handleObj = handlers[ j ];

				if ( ( mappedTypes || origType === handleObj.origType ) &&
					( !handler || handler.guid === handleObj.guid ) &&
					( !tmp || tmp.test( handleObj.namespace ) ) &&
					( !selector || selector === handleObj.selector || selector === "**" && handleObj.selector ) ) {
					handlers.splice( j, 1 );

					if ( handleObj.selector ) {
						handlers.delegateCount--;
					}
					if ( special.remove ) {
						special.remove.call( elem, handleObj );
					}
				}
			}

			// Remove generic event handler if we removed something and no more handlers exist
			// (avoids potential for endless recursion during removal of special event handlers)
			if ( origCount && !handlers.length ) {
				if ( !special.teardown || special.teardown.call( elem, namespaces, elemData.handle ) === false ) {
					jQuery.removeEvent( elem, type, elemData.handle );
				}

				delete events[ type ];
			}
		}

		// Remove the expando if it's no longer used
		if ( jQuery.isEmptyObject( events ) ) {
			delete elemData.handle;
			data_priv.remove( elem, "events" );
		}
	},

	trigger: function( event, data, elem, onlyHandlers ) {

		var i, cur, tmp, bubbleType, ontype, handle, special,
			eventPath = [ elem || document ],
			type = hasOwn.call( event, "type" ) ? event.type : event,
			namespaces = hasOwn.call( event, "namespace" ) ? event.namespace.split(".") : [];

		cur = tmp = elem = elem || document;

		// Don't do events on text and comment nodes
		if ( elem.nodeType === 3 || elem.nodeType === 8 ) {
			return;
		}

		// focus/blur morphs to focusin/out; ensure we're not firing them right now
		if ( rfocusMorph.test( type + jQuery.event.triggered ) ) {
			return;
		}

		if ( type.indexOf(".") >= 0 ) {
			// Namespaced trigger; create a regexp to match event type in handle()
			namespaces = type.split(".");
			type = namespaces.shift();
			namespaces.sort();
		}
		ontype = type.indexOf(":") < 0 && "on" + type;

		// Caller can pass in a jQuery.Event object, Object, or just an event type string
		event = event[ jQuery.expando ] ?
			event :
			new jQuery.Event( type, typeof event === "object" && event );

		// Trigger bitmask: & 1 for native handlers; & 2 for jQuery (always true)
		event.isTrigger = onlyHandlers ? 2 : 3;
		event.namespace = namespaces.join(".");
		event.namespace_re = event.namespace ?
			new RegExp( "(^|\\.)" + namespaces.join("\\.(?:.*\\.|)") + "(\\.|$)" ) :
			null;

		// Clean up the event in case it is being reused
		event.result = undefined;
		if ( !event.target ) {
			event.target = elem;
		}

		// Clone any incoming data and prepend the event, creating the handler arg list
		data = data == null ?
			[ event ] :
			jQuery.makeArray( data, [ event ] );

		// Allow special events to draw outside the lines
		special = jQuery.event.special[ type ] || {};
		if ( !onlyHandlers && special.trigger && special.trigger.apply( elem, data ) === false ) {
			return;
		}

		// Determine event propagation path in advance, per W3C events spec (#9951)
		// Bubble up to document, then to window; watch for a global ownerDocument var (#9724)
		if ( !onlyHandlers && !special.noBubble && !jQuery.isWindow( elem ) ) {

			bubbleType = special.delegateType || type;
			if ( !rfocusMorph.test( bubbleType + type ) ) {
				cur = cur.parentNode;
			}
			for ( ; cur; cur = cur.parentNode ) {
				eventPath.push( cur );
				tmp = cur;
			}

			// Only add window if we got to document (e.g., not plain obj or detached DOM)
			if ( tmp === (elem.ownerDocument || document) ) {
				eventPath.push( tmp.defaultView || tmp.parentWindow || window );
			}
		}

		// Fire handlers on the event path
		i = 0;
		while ( (cur = eventPath[i++]) && !event.isPropagationStopped() ) {

			event.type = i > 1 ?
				bubbleType :
				special.bindType || type;

			// jQuery handler
			handle = ( data_priv.get( cur, "events" ) || {} )[ event.type ] && data_priv.get( cur, "handle" );
			if ( handle ) {
				handle.apply( cur, data );
			}

			// Native handler
			handle = ontype && cur[ ontype ];
			if ( handle && handle.apply && jQuery.acceptData( cur ) ) {
				event.result = handle.apply( cur, data );
				if ( event.result === false ) {
					event.preventDefault();
				}
			}
		}
		event.type = type;

		// If nobody prevented the default action, do it now
		if ( !onlyHandlers && !event.isDefaultPrevented() ) {

			if ( (!special._default || special._default.apply( eventPath.pop(), data ) === false) &&
				jQuery.acceptData( elem ) ) {

				// Call a native DOM method on the target with the same name name as the event.
				// Don't do default actions on window, that's where global variables be (#6170)
				if ( ontype && jQuery.isFunction( elem[ type ] ) && !jQuery.isWindow( elem ) ) {

					// Don't re-trigger an onFOO event when we call its FOO() method
					tmp = elem[ ontype ];

					if ( tmp ) {
						elem[ ontype ] = null;
					}

					// Prevent re-triggering of the same event, since we already bubbled it above
					jQuery.event.triggered = type;
					elem[ type ]();
					jQuery.event.triggered = undefined;

					if ( tmp ) {
						elem[ ontype ] = tmp;
					}
				}
			}
		}

		return event.result;
	},

	dispatch: function( event ) {

		// Make a writable jQuery.Event from the native event object
		event = jQuery.event.fix( event );

		var i, j, ret, matched, handleObj,
			handlerQueue = [],
			args = slice.call( arguments ),
			handlers = ( data_priv.get( this, "events" ) || {} )[ event.type ] || [],
			special = jQuery.event.special[ event.type ] || {};

		// Use the fix-ed jQuery.Event rather than the (read-only) native event
		args[0] = event;
		event.delegateTarget = this;

		// Call the preDispatch hook for the mapped type, and let it bail if desired
		if ( special.preDispatch && special.preDispatch.call( this, event ) === false ) {
			return;
		}

		// Determine handlers
		handlerQueue = jQuery.event.handlers.call( this, event, handlers );

		// Run delegates first; they may want to stop propagation beneath us
		i = 0;
		while ( (matched = handlerQueue[ i++ ]) && !event.isPropagationStopped() ) {
			event.currentTarget = matched.elem;

			j = 0;
			while ( (handleObj = matched.handlers[ j++ ]) && !event.isImmediatePropagationStopped() ) {

				// Triggered event must either 1) have no namespace, or 2) have namespace(s)
				// a subset or equal to those in the bound event (both can have no namespace).
				if ( !event.namespace_re || event.namespace_re.test( handleObj.namespace ) ) {

					event.handleObj = handleObj;
					event.data = handleObj.data;

					ret = ( (jQuery.event.special[ handleObj.origType ] || {}).handle || handleObj.handler )
							.apply( matched.elem, args );

					if ( ret !== undefined ) {
						if ( (event.result = ret) === false ) {
							event.preventDefault();
							event.stopPropagation();
						}
					}
				}
			}
		}

		// Call the postDispatch hook for the mapped type
		if ( special.postDispatch ) {
			special.postDispatch.call( this, event );
		}

		return event.result;
	},

	handlers: function( event, handlers ) {
		var i, matches, sel, handleObj,
			handlerQueue = [],
			delegateCount = handlers.delegateCount,
			cur = event.target;

		// Find delegate handlers
		// Black-hole SVG <use> instance trees (#13180)
		// Avoid non-left-click bubbling in Firefox (#3861)
		if ( delegateCount && cur.nodeType && (!event.button || event.type !== "click") ) {

			for ( ; cur !== this; cur = cur.parentNode || this ) {

				// Don't process clicks on disabled elements (#6911, #8165, #11382, #11764)
				if ( cur.disabled !== true || event.type !== "click" ) {
					matches = [];
					for ( i = 0; i < delegateCount; i++ ) {
						handleObj = handlers[ i ];

						// Don't conflict with Object.prototype properties (#13203)
						sel = handleObj.selector + " ";

						if ( matches[ sel ] === undefined ) {
							matches[ sel ] = handleObj.needsContext ?
								jQuery( sel, this ).index( cur ) >= 0 :
								jQuery.find( sel, this, null, [ cur ] ).length;
						}
						if ( matches[ sel ] ) {
							matches.push( handleObj );
						}
					}
					if ( matches.length ) {
						handlerQueue.push({ elem: cur, handlers: matches });
					}
				}
			}
		}

		// Add the remaining (directly-bound) handlers
		if ( delegateCount < handlers.length ) {
			handlerQueue.push({ elem: this, handlers: handlers.slice( delegateCount ) });
		}

		return handlerQueue;
	},

	// Includes some event props shared by KeyEvent and MouseEvent
	props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),

	fixHooks: {},

	keyHooks: {
		props: "char charCode key keyCode".split(" "),
		filter: function( event, original ) {

			// Add which for key events
			if ( event.which == null ) {
				event.which = original.charCode != null ? original.charCode : original.keyCode;
			}

			return event;
		}
	},

	mouseHooks: {
		props: "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
		filter: function( event, original ) {
			var eventDoc, doc, body,
				button = original.button;

			// Calculate pageX/Y if missing and clientX/Y available
			if ( event.pageX == null && original.clientX != null ) {
				eventDoc = event.target.ownerDocument || document;
				doc = eventDoc.documentElement;
				body = eventDoc.body;

				event.pageX = original.clientX + ( doc && doc.scrollLeft || body && body.scrollLeft || 0 ) - ( doc && doc.clientLeft || body && body.clientLeft || 0 );
				event.pageY = original.clientY + ( doc && doc.scrollTop  || body && body.scrollTop  || 0 ) - ( doc && doc.clientTop  || body && body.clientTop  || 0 );
			}

			// Add which for click: 1 === left; 2 === middle; 3 === right
			// Note: button is not normalized, so don't use it
			if ( !event.which && button !== undefined ) {
				event.which = ( button & 1 ? 1 : ( button & 2 ? 3 : ( button & 4 ? 2 : 0 ) ) );
			}

			return event;
		}
	},

	fix: function( event ) {
		if ( event[ jQuery.expando ] ) {
			return event;
		}

		// Create a writable copy of the event object and normalize some properties
		var i, prop, copy,
			type = event.type,
			originalEvent = event,
			fixHook = this.fixHooks[ type ];

		if ( !fixHook ) {
			this.fixHooks[ type ] = fixHook =
				rmouseEvent.test( type ) ? this.mouseHooks :
				rkeyEvent.test( type ) ? this.keyHooks :
				{};
		}
		copy = fixHook.props ? this.props.concat( fixHook.props ) : this.props;

		event = new jQuery.Event( originalEvent );

		i = copy.length;
		while ( i-- ) {
			prop = copy[ i ];
			event[ prop ] = originalEvent[ prop ];
		}

		// Support: Cordova 2.5 (WebKit) (#13255)
		// All events should have a target; Cordova deviceready doesn't
		if ( !event.target ) {
			event.target = document;
		}

		// Support: Safari 6.0+, Chrome<28
		// Target should not be a text node (#504, #13143)
		if ( event.target.nodeType === 3 ) {
			event.target = event.target.parentNode;
		}

		return fixHook.filter ? fixHook.filter( event, originalEvent ) : event;
	},

	special: {
		load: {
			// Prevent triggered image.load events from bubbling to window.load
			noBubble: true
		},
		focus: {
			// Fire native event if possible so blur/focus sequence is correct
			trigger: function() {
				if ( this !== safeActiveElement() && this.focus ) {
					this.focus();
					return false;
				}
			},
			delegateType: "focusin"
		},
		blur: {
			trigger: function() {
				if ( this === safeActiveElement() && this.blur ) {
					this.blur();
					return false;
				}
			},
			delegateType: "focusout"
		},
		click: {
			// For checkbox, fire native event so checked state will be right
			trigger: function() {
				if ( this.type === "checkbox" && this.click && jQuery.nodeName( this, "input" ) ) {
					this.click();
					return false;
				}
			},

			// For cross-browser consistency, don't fire native .click() on links
			_default: function( event ) {
				return jQuery.nodeName( event.target, "a" );
			}
		},

		beforeunload: {
			postDispatch: function( event ) {

				// Support: Firefox 20+
				// Firefox doesn't alert if the returnValue field is not set.
				if ( event.result !== undefined && event.originalEvent ) {
					event.originalEvent.returnValue = event.result;
				}
			}
		}
	},

	simulate: function( type, elem, event, bubble ) {
		// Piggyback on a donor event to simulate a different one.
		// Fake originalEvent to avoid donor's stopPropagation, but if the
		// simulated event prevents default then we do the same on the donor.
		var e = jQuery.extend(
			new jQuery.Event(),
			event,
			{
				type: type,
				isSimulated: true,
				originalEvent: {}
			}
		);
		if ( bubble ) {
			jQuery.event.trigger( e, null, elem );
		} else {
			jQuery.event.dispatch.call( elem, e );
		}
		if ( e.isDefaultPrevented() ) {
			event.preventDefault();
		}
	}
};

jQuery.removeEvent = function( elem, type, handle ) {
	if ( elem.removeEventListener ) {
		elem.removeEventListener( type, handle, false );
	}
};

jQuery.Event = function( src, props ) {
	// Allow instantiation without the 'new' keyword
	if ( !(this instanceof jQuery.Event) ) {
		return new jQuery.Event( src, props );
	}

	// Event object
	if ( src && src.type ) {
		this.originalEvent = src;
		this.type = src.type;

		// Events bubbling up the document may have been marked as prevented
		// by a handler lower down the tree; reflect the correct value.
		this.isDefaultPrevented = src.defaultPrevented ||
				src.defaultPrevented === undefined &&
				// Support: Android<4.0
				src.returnValue === false ?
			returnTrue :
			returnFalse;

	// Event type
	} else {
		this.type = src;
	}

	// Put explicitly provided properties onto the event object
	if ( props ) {
		jQuery.extend( this, props );
	}

	// Create a timestamp if incoming event doesn't have one
	this.timeStamp = src && src.timeStamp || jQuery.now();

	// Mark it as fixed
	this[ jQuery.expando ] = true;
};

// jQuery.Event is based on DOM3 Events as specified by the ECMAScript Language Binding
// http://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
jQuery.Event.prototype = {
	isDefaultPrevented: returnFalse,
	isPropagationStopped: returnFalse,
	isImmediatePropagationStopped: returnFalse,

	preventDefault: function() {
		var e = this.originalEvent;

		this.isDefaultPrevented = returnTrue;

		if ( e && e.preventDefault ) {
			e.preventDefault();
		}
	},
	stopPropagation: function() {
		var e = this.originalEvent;

		this.isPropagationStopped = returnTrue;

		if ( e && e.stopPropagation ) {
			e.stopPropagation();
		}
	},
	stopImmediatePropagation: function() {
		var e = this.originalEvent;

		this.isImmediatePropagationStopped = returnTrue;

		if ( e && e.stopImmediatePropagation ) {
			e.stopImmediatePropagation();
		}

		this.stopPropagation();
	}
};

// Create mouseenter/leave events using mouseover/out and event-time checks
// Support: Chrome 15+
jQuery.each({
	mouseenter: "mouseover",
	mouseleave: "mouseout",
	pointerenter: "pointerover",
	pointerleave: "pointerout"
}, function( orig, fix ) {
	jQuery.event.special[ orig ] = {
		delegateType: fix,
		bindType: fix,

		handle: function( event ) {
			var ret,
				target = this,
				related = event.relatedTarget,
				handleObj = event.handleObj;

			// For mousenter/leave call the handler if related is outside the target.
			// NB: No relatedTarget if the mouse left/entered the browser window
			if ( !related || (related !== target && !jQuery.contains( target, related )) ) {
				event.type = handleObj.origType;
				ret = handleObj.handler.apply( this, arguments );
				event.type = fix;
			}
			return ret;
		}
	};
});

// Support: Firefox, Chrome, Safari
// Create "bubbling" focus and blur events
if ( !support.focusinBubbles ) {
	jQuery.each({ focus: "focusin", blur: "focusout" }, function( orig, fix ) {

		// Attach a single capturing handler on the document while someone wants focusin/focusout
		var handler = function( event ) {
				jQuery.event.simulate( fix, event.target, jQuery.event.fix( event ), true );
			};

		jQuery.event.special[ fix ] = {
			setup: function() {
				var doc = this.ownerDocument || this,
					attaches = data_priv.access( doc, fix );

				if ( !attaches ) {
					doc.addEventListener( orig, handler, true );
				}
				data_priv.access( doc, fix, ( attaches || 0 ) + 1 );
			},
			teardown: function() {
				var doc = this.ownerDocument || this,
					attaches = data_priv.access( doc, fix ) - 1;

				if ( !attaches ) {
					doc.removeEventListener( orig, handler, true );
					data_priv.remove( doc, fix );

				} else {
					data_priv.access( doc, fix, attaches );
				}
			}
		};
	});
}

jQuery.fn.extend({

	on: function( types, selector, data, fn, /*INTERNAL*/ one ) {
		var origFn, type;

		// Types can be a map of types/handlers
		if ( typeof types === "object" ) {
			// ( types-Object, selector, data )
			if ( typeof selector !== "string" ) {
				// ( types-Object, data )
				data = data || selector;
				selector = undefined;
			}
			for ( type in types ) {
				this.on( type, selector, data, types[ type ], one );
			}
			return this;
		}

		if ( data == null && fn == null ) {
			// ( types, fn )
			fn = selector;
			data = selector = undefined;
		} else if ( fn == null ) {
			if ( typeof selector === "string" ) {
				// ( types, selector, fn )
				fn = data;
				data = undefined;
			} else {
				// ( types, data, fn )
				fn = data;
				data = selector;
				selector = undefined;
			}
		}
		if ( fn === false ) {
			fn = returnFalse;
		} else if ( !fn ) {
			return this;
		}

		if ( one === 1 ) {
			origFn = fn;
			fn = function( event ) {
				// Can use an empty set, since event contains the info
				jQuery().off( event );
				return origFn.apply( this, arguments );
			};
			// Use same guid so caller can remove using origFn
			fn.guid = origFn.guid || ( origFn.guid = jQuery.guid++ );
		}
		return this.each( function() {
			jQuery.event.add( this, types, fn, data, selector );
		});
	},
	one: function( types, selector, data, fn ) {
		return this.on( types, selector, data, fn, 1 );
	},
	off: function( types, selector, fn ) {
		var handleObj, type;
		if ( types && types.preventDefault && types.handleObj ) {
			// ( event )  dispatched jQuery.Event
			handleObj = types.handleObj;
			jQuery( types.delegateTarget ).off(
				handleObj.namespace ? handleObj.origType + "." + handleObj.namespace : handleObj.origType,
				handleObj.selector,
				handleObj.handler
			);
			return this;
		}
		if ( typeof types === "object" ) {
			// ( types-object [, selector] )
			for ( type in types ) {
				this.off( type, selector, types[ type ] );
			}
			return this;
		}
		if ( selector === false || typeof selector === "function" ) {
			// ( types [, fn] )
			fn = selector;
			selector = undefined;
		}
		if ( fn === false ) {
			fn = returnFalse;
		}
		return this.each(function() {
			jQuery.event.remove( this, types, fn, selector );
		});
	},

	trigger: function( type, data ) {
		return this.each(function() {
			jQuery.event.trigger( type, data, this );
		});
	},
	triggerHandler: function( type, data ) {
		var elem = this[0];
		if ( elem ) {
			return jQuery.event.trigger( type, data, elem, true );
		}
	}
});


var
	rxhtmlTag = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
	rtagName = /<([\w:]+)/,
	rhtml = /<|&#?\w+;/,
	rnoInnerhtml = /<(?:script|style|link)/i,
	// checked="checked" or checked
	rchecked = /checked\s*(?:[^=]|=\s*.checked.)/i,
	rscriptType = /^$|\/(?:java|ecma)script/i,
	rscriptTypeMasked = /^true\/(.*)/,
	rcleanScript = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,

	// We have to close these tags to support XHTML (#13200)
	wrapMap = {

		// Support: IE9
		option: [ 1, "<select multiple='multiple'>", "</select>" ],

		thead: [ 1, "<table>", "</table>" ],
		col: [ 2, "<table><colgroup>", "</colgroup></table>" ],
		tr: [ 2, "<table><tbody>", "</tbody></table>" ],
		td: [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ],

		_default: [ 0, "", "" ]
	};

// Support: IE9
wrapMap.optgroup = wrapMap.option;

wrapMap.tbody = wrapMap.tfoot = wrapMap.colgroup = wrapMap.caption = wrapMap.thead;
wrapMap.th = wrapMap.td;

// Support: 1.x compatibility
// Manipulating tables requires a tbody
function manipulationTarget( elem, content ) {
	return jQuery.nodeName( elem, "table" ) &&
		jQuery.nodeName( content.nodeType !== 11 ? content : content.firstChild, "tr" ) ?

		elem.getElementsByTagName("tbody")[0] ||
			elem.appendChild( elem.ownerDocument.createElement("tbody") ) :
		elem;
}

// Replace/restore the type attribute of script elements for safe DOM manipulation
function disableScript( elem ) {
	elem.type = (elem.getAttribute("type") !== null) + "/" + elem.type;
	return elem;
}
function restoreScript( elem ) {
	var match = rscriptTypeMasked.exec( elem.type );

	if ( match ) {
		elem.type = match[ 1 ];
	} else {
		elem.removeAttribute("type");
	}

	return elem;
}

// Mark scripts as having already been evaluated
function setGlobalEval( elems, refElements ) {
	var i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		data_priv.set(
			elems[ i ], "globalEval", !refElements || data_priv.get( refElements[ i ], "globalEval" )
		);
	}
}

function cloneCopyEvent( src, dest ) {
	var i, l, type, pdataOld, pdataCur, udataOld, udataCur, events;

	if ( dest.nodeType !== 1 ) {
		return;
	}

	// 1. Copy private data: events, handlers, etc.
	if ( data_priv.hasData( src ) ) {
		pdataOld = data_priv.access( src );
		pdataCur = data_priv.set( dest, pdataOld );
		events = pdataOld.events;

		if ( events ) {
			delete pdataCur.handle;
			pdataCur.events = {};

			for ( type in events ) {
				for ( i = 0, l = events[ type ].length; i < l; i++ ) {
					jQuery.event.add( dest, type, events[ type ][ i ] );
				}
			}
		}
	}

	// 2. Copy user data
	if ( data_user.hasData( src ) ) {
		udataOld = data_user.access( src );
		udataCur = jQuery.extend( {}, udataOld );

		data_user.set( dest, udataCur );
	}
}

function getAll( context, tag ) {
	var ret = context.getElementsByTagName ? context.getElementsByTagName( tag || "*" ) :
			context.querySelectorAll ? context.querySelectorAll( tag || "*" ) :
			[];

	return tag === undefined || tag && jQuery.nodeName( context, tag ) ?
		jQuery.merge( [ context ], ret ) :
		ret;
}

// Fix IE bugs, see support tests
function fixInput( src, dest ) {
	var nodeName = dest.nodeName.toLowerCase();

	// Fails to persist the checked state of a cloned checkbox or radio button.
	if ( nodeName === "input" && rcheckableType.test( src.type ) ) {
		dest.checked = src.checked;

	// Fails to return the selected option to the default selected state when cloning options
	} else if ( nodeName === "input" || nodeName === "textarea" ) {
		dest.defaultValue = src.defaultValue;
	}
}

jQuery.extend({
	clone: function( elem, dataAndEvents, deepDataAndEvents ) {
		var i, l, srcElements, destElements,
			clone = elem.cloneNode( true ),
			inPage = jQuery.contains( elem.ownerDocument, elem );

		// Fix IE cloning issues
		if ( !support.noCloneChecked && ( elem.nodeType === 1 || elem.nodeType === 11 ) &&
				!jQuery.isXMLDoc( elem ) ) {

			// We eschew Sizzle here for performance reasons: http://jsperf.com/getall-vs-sizzle/2
			destElements = getAll( clone );
			srcElements = getAll( elem );

			for ( i = 0, l = srcElements.length; i < l; i++ ) {
				fixInput( srcElements[ i ], destElements[ i ] );
			}
		}

		// Copy the events from the original to the clone
		if ( dataAndEvents ) {
			if ( deepDataAndEvents ) {
				srcElements = srcElements || getAll( elem );
				destElements = destElements || getAll( clone );

				for ( i = 0, l = srcElements.length; i < l; i++ ) {
					cloneCopyEvent( srcElements[ i ], destElements[ i ] );
				}
			} else {
				cloneCopyEvent( elem, clone );
			}
		}

		// Preserve script evaluation history
		destElements = getAll( clone, "script" );
		if ( destElements.length > 0 ) {
			setGlobalEval( destElements, !inPage && getAll( elem, "script" ) );
		}

		// Return the cloned set
		return clone;
	},

	buildFragment: function( elems, context, scripts, selection ) {
		var elem, tmp, tag, wrap, contains, j,
			fragment = context.createDocumentFragment(),
			nodes = [],
			i = 0,
			l = elems.length;

		for ( ; i < l; i++ ) {
			elem = elems[ i ];

			if ( elem || elem === 0 ) {

				// Add nodes directly
				if ( jQuery.type( elem ) === "object" ) {
					// Support: QtWebKit, PhantomJS
					// push.apply(_, arraylike) throws on ancient WebKit
					jQuery.merge( nodes, elem.nodeType ? [ elem ] : elem );

				// Convert non-html into a text node
				} else if ( !rhtml.test( elem ) ) {
					nodes.push( context.createTextNode( elem ) );

				// Convert html into DOM nodes
				} else {
					tmp = tmp || fragment.appendChild( context.createElement("div") );

					// Deserialize a standard representation
					tag = ( rtagName.exec( elem ) || [ "", "" ] )[ 1 ].toLowerCase();
					wrap = wrapMap[ tag ] || wrapMap._default;
					tmp.innerHTML = wrap[ 1 ] + elem.replace( rxhtmlTag, "<$1></$2>" ) + wrap[ 2 ];

					// Descend through wrappers to the right content
					j = wrap[ 0 ];
					while ( j-- ) {
						tmp = tmp.lastChild;
					}

					// Support: QtWebKit, PhantomJS
					// push.apply(_, arraylike) throws on ancient WebKit
					jQuery.merge( nodes, tmp.childNodes );

					// Remember the top-level container
					tmp = fragment.firstChild;

					// Ensure the created nodes are orphaned (#12392)
					tmp.textContent = "";
				}
			}
		}

		// Remove wrapper from fragment
		fragment.textContent = "";

		i = 0;
		while ( (elem = nodes[ i++ ]) ) {

			// #4087 - If origin and destination elements are the same, and this is
			// that element, do not do anything
			if ( selection && jQuery.inArray( elem, selection ) !== -1 ) {
				continue;
			}

			contains = jQuery.contains( elem.ownerDocument, elem );

			// Append to fragment
			tmp = getAll( fragment.appendChild( elem ), "script" );

			// Preserve script evaluation history
			if ( contains ) {
				setGlobalEval( tmp );
			}

			// Capture executables
			if ( scripts ) {
				j = 0;
				while ( (elem = tmp[ j++ ]) ) {
					if ( rscriptType.test( elem.type || "" ) ) {
						scripts.push( elem );
					}
				}
			}
		}

		return fragment;
	},

	cleanData: function( elems ) {
		var data, elem, type, key,
			special = jQuery.event.special,
			i = 0;

		for ( ; (elem = elems[ i ]) !== undefined; i++ ) {
			if ( jQuery.acceptData( elem ) ) {
				key = elem[ data_priv.expando ];

				if ( key && (data = data_priv.cache[ key ]) ) {
					if ( data.events ) {
						for ( type in data.events ) {
							if ( special[ type ] ) {
								jQuery.event.remove( elem, type );

							// This is a shortcut to avoid jQuery.event.remove's overhead
							} else {
								jQuery.removeEvent( elem, type, data.handle );
							}
						}
					}
					if ( data_priv.cache[ key ] ) {
						// Discard any remaining `private` data
						delete data_priv.cache[ key ];
					}
				}
			}
			// Discard any remaining `user` data
			delete data_user.cache[ elem[ data_user.expando ] ];
		}
	}
});

jQuery.fn.extend({
	text: function( value ) {
		return access( this, function( value ) {
			return value === undefined ?
				jQuery.text( this ) :
				this.empty().each(function() {
					if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
						this.textContent = value;
					}
				});
		}, null, value, arguments.length );
	},

	append: function() {
		return this.domManip( arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.appendChild( elem );
			}
		});
	},

	prepend: function() {
		return this.domManip( arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.insertBefore( elem, target.firstChild );
			}
		});
	},

	before: function() {
		return this.domManip( arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this );
			}
		});
	},

	after: function() {
		return this.domManip( arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this.nextSibling );
			}
		});
	},

	remove: function( selector, keepData /* Internal Use Only */ ) {
		var elem,
			elems = selector ? jQuery.filter( selector, this ) : this,
			i = 0;

		for ( ; (elem = elems[i]) != null; i++ ) {
			if ( !keepData && elem.nodeType === 1 ) {
				jQuery.cleanData( getAll( elem ) );
			}

			if ( elem.parentNode ) {
				if ( keepData && jQuery.contains( elem.ownerDocument, elem ) ) {
					setGlobalEval( getAll( elem, "script" ) );
				}
				elem.parentNode.removeChild( elem );
			}
		}

		return this;
	},

	empty: function() {
		var elem,
			i = 0;

		for ( ; (elem = this[i]) != null; i++ ) {
			if ( elem.nodeType === 1 ) {

				// Prevent memory leaks
				jQuery.cleanData( getAll( elem, false ) );

				// Remove any remaining nodes
				elem.textContent = "";
			}
		}

		return this;
	},

	clone: function( dataAndEvents, deepDataAndEvents ) {
		dataAndEvents = dataAndEvents == null ? false : dataAndEvents;
		deepDataAndEvents = deepDataAndEvents == null ? dataAndEvents : deepDataAndEvents;

		return this.map(function() {
			return jQuery.clone( this, dataAndEvents, deepDataAndEvents );
		});
	},

	html: function( value ) {
		return access( this, function( value ) {
			var elem = this[ 0 ] || {},
				i = 0,
				l = this.length;

			if ( value === undefined && elem.nodeType === 1 ) {
				return elem.innerHTML;
			}

			// See if we can take a shortcut and just use innerHTML
			if ( typeof value === "string" && !rnoInnerhtml.test( value ) &&
				!wrapMap[ ( rtagName.exec( value ) || [ "", "" ] )[ 1 ].toLowerCase() ] ) {

				value = value.replace( rxhtmlTag, "<$1></$2>" );

				try {
					for ( ; i < l; i++ ) {
						elem = this[ i ] || {};

						// Remove element nodes and prevent memory leaks
						if ( elem.nodeType === 1 ) {
							jQuery.cleanData( getAll( elem, false ) );
							elem.innerHTML = value;
						}
					}

					elem = 0;

				// If using innerHTML throws an exception, use the fallback method
				} catch( e ) {}
			}

			if ( elem ) {
				this.empty().append( value );
			}
		}, null, value, arguments.length );
	},

	replaceWith: function() {
		var arg = arguments[ 0 ];

		// Make the changes, replacing each context element with the new content
		this.domManip( arguments, function( elem ) {
			arg = this.parentNode;

			jQuery.cleanData( getAll( this ) );

			if ( arg ) {
				arg.replaceChild( elem, this );
			}
		});

		// Force removal if there was no new content (e.g., from empty arguments)
		return arg && (arg.length || arg.nodeType) ? this : this.remove();
	},

	detach: function( selector ) {
		return this.remove( selector, true );
	},

	domManip: function( args, callback ) {

		// Flatten any nested arrays
		args = concat.apply( [], args );

		var fragment, first, scripts, hasScripts, node, doc,
			i = 0,
			l = this.length,
			set = this,
			iNoClone = l - 1,
			value = args[ 0 ],
			isFunction = jQuery.isFunction( value );

		// We can't cloneNode fragments that contain checked, in WebKit
		if ( isFunction ||
				( l > 1 && typeof value === "string" &&
					!support.checkClone && rchecked.test( value ) ) ) {
			return this.each(function( index ) {
				var self = set.eq( index );
				if ( isFunction ) {
					args[ 0 ] = value.call( this, index, self.html() );
				}
				self.domManip( args, callback );
			});
		}

		if ( l ) {
			fragment = jQuery.buildFragment( args, this[ 0 ].ownerDocument, false, this );
			first = fragment.firstChild;

			if ( fragment.childNodes.length === 1 ) {
				fragment = first;
			}

			if ( first ) {
				scripts = jQuery.map( getAll( fragment, "script" ), disableScript );
				hasScripts = scripts.length;

				// Use the original fragment for the last item instead of the first because it can end up
				// being emptied incorrectly in certain situations (#8070).
				for ( ; i < l; i++ ) {
					node = fragment;

					if ( i !== iNoClone ) {
						node = jQuery.clone( node, true, true );

						// Keep references to cloned scripts for later restoration
						if ( hasScripts ) {
							// Support: QtWebKit
							// jQuery.merge because push.apply(_, arraylike) throws
							jQuery.merge( scripts, getAll( node, "script" ) );
						}
					}

					callback.call( this[ i ], node, i );
				}

				if ( hasScripts ) {
					doc = scripts[ scripts.length - 1 ].ownerDocument;

					// Reenable scripts
					jQuery.map( scripts, restoreScript );

					// Evaluate executable scripts on first document insertion
					for ( i = 0; i < hasScripts; i++ ) {
						node = scripts[ i ];
						if ( rscriptType.test( node.type || "" ) &&
							!data_priv.access( node, "globalEval" ) && jQuery.contains( doc, node ) ) {

							if ( node.src ) {
								// Optional AJAX dependency, but won't run scripts if not present
								if ( jQuery._evalUrl ) {
									jQuery._evalUrl( node.src );
								}
							} else {
								jQuery.globalEval( node.textContent.replace( rcleanScript, "" ) );
							}
						}
					}
				}
			}
		}

		return this;
	}
});

jQuery.each({
	appendTo: "append",
	prependTo: "prepend",
	insertBefore: "before",
	insertAfter: "after",
	replaceAll: "replaceWith"
}, function( name, original ) {
	jQuery.fn[ name ] = function( selector ) {
		var elems,
			ret = [],
			insert = jQuery( selector ),
			last = insert.length - 1,
			i = 0;

		for ( ; i <= last; i++ ) {
			elems = i === last ? this : this.clone( true );
			jQuery( insert[ i ] )[ original ]( elems );

			// Support: QtWebKit
			// .get() because push.apply(_, arraylike) throws
			push.apply( ret, elems.get() );
		}

		return this.pushStack( ret );
	};
});


var iframe,
	elemdisplay = {};

/**
 * Retrieve the actual display of a element
 * @param {String} name nodeName of the element
 * @param {Object} doc Document object
 */
// Called only from within defaultDisplay
function actualDisplay( name, doc ) {
	var style,
		elem = jQuery( doc.createElement( name ) ).appendTo( doc.body ),

		// getDefaultComputedStyle might be reliably used only on attached element
		display = window.getDefaultComputedStyle && ( style = window.getDefaultComputedStyle( elem[ 0 ] ) ) ?

			// Use of this method is a temporary fix (more like optimization) until something better comes along,
			// since it was removed from specification and supported only in FF
			style.display : jQuery.css( elem[ 0 ], "display" );

	// We don't have any data stored on the element,
	// so use "detach" method as fast way to get rid of the element
	elem.detach();

	return display;
}

/**
 * Try to determine the default display value of an element
 * @param {String} nodeName
 */
function defaultDisplay( nodeName ) {
	var doc = document,
		display = elemdisplay[ nodeName ];

	if ( !display ) {
		display = actualDisplay( nodeName, doc );

		// If the simple way fails, read from inside an iframe
		if ( display === "none" || !display ) {

			// Use the already-created iframe if possible
			iframe = (iframe || jQuery( "<iframe frameborder='0' width='0' height='0'/>" )).appendTo( doc.documentElement );

			// Always write a new HTML skeleton so Webkit and Firefox don't choke on reuse
			doc = iframe[ 0 ].contentDocument;

			// Support: IE
			doc.write();
			doc.close();

			display = actualDisplay( nodeName, doc );
			iframe.detach();
		}

		// Store the correct default display
		elemdisplay[ nodeName ] = display;
	}

	return display;
}
var rmargin = (/^margin/);

var rnumnonpx = new RegExp( "^(" + pnum + ")(?!px)[a-z%]+$", "i" );

var getStyles = function( elem ) {
		// Support: IE<=11+, Firefox<=30+ (#15098, #14150)
		// IE throws on elements created in popups
		// FF meanwhile throws on frame elements through "defaultView.getComputedStyle"
		if ( elem.ownerDocument.defaultView.opener ) {
			return elem.ownerDocument.defaultView.getComputedStyle( elem, null );
		}

		return window.getComputedStyle( elem, null );
	};



function curCSS( elem, name, computed ) {
	var width, minWidth, maxWidth, ret,
		style = elem.style;

	computed = computed || getStyles( elem );

	// Support: IE9
	// getPropertyValue is only needed for .css('filter') (#12537)
	if ( computed ) {
		ret = computed.getPropertyValue( name ) || computed[ name ];
	}

	if ( computed ) {

		if ( ret === "" && !jQuery.contains( elem.ownerDocument, elem ) ) {
			ret = jQuery.style( elem, name );
		}

		// Support: iOS < 6
		// A tribute to the "awesome hack by Dean Edwards"
		// iOS < 6 (at least) returns percentage for a larger set of values, but width seems to be reliably pixels
		// this is against the CSSOM draft spec: http://dev.w3.org/csswg/cssom/#resolved-values
		if ( rnumnonpx.test( ret ) && rmargin.test( name ) ) {

			// Remember the original values
			width = style.width;
			minWidth = style.minWidth;
			maxWidth = style.maxWidth;

			// Put in the new values to get a computed value out
			style.minWidth = style.maxWidth = style.width = ret;
			ret = computed.width;

			// Revert the changed values
			style.width = width;
			style.minWidth = minWidth;
			style.maxWidth = maxWidth;
		}
	}

	return ret !== undefined ?
		// Support: IE
		// IE returns zIndex value as an integer.
		ret + "" :
		ret;
}


function addGetHookIf( conditionFn, hookFn ) {
	// Define the hook, we'll check on the first run if it's really needed.
	return {
		get: function() {
			if ( conditionFn() ) {
				// Hook not needed (or it's not possible to use it due
				// to missing dependency), remove it.
				delete this.get;
				return;
			}

			// Hook needed; redefine it so that the support test is not executed again.
			return (this.get = hookFn).apply( this, arguments );
		}
	};
}


(function() {
	var pixelPositionVal, boxSizingReliableVal,
		docElem = document.documentElement,
		container = document.createElement( "div" ),
		div = document.createElement( "div" );

	if ( !div.style ) {
		return;
	}

	// Support: IE9-11+
	// Style of cloned element affects source element cloned (#8908)
	div.style.backgroundClip = "content-box";
	div.cloneNode( true ).style.backgroundClip = "";
	support.clearCloneStyle = div.style.backgroundClip === "content-box";

	container.style.cssText = "border:0;width:0;height:0;top:0;left:-9999px;margin-top:1px;" +
		"position:absolute";
	container.appendChild( div );

	// Executing both pixelPosition & boxSizingReliable tests require only one layout
	// so they're executed at the same time to save the second computation.
	function computePixelPositionAndBoxSizingReliable() {
		div.style.cssText =
			// Support: Firefox<29, Android 2.3
			// Vendor-prefix box-sizing
			"-webkit-box-sizing:border-box;-moz-box-sizing:border-box;" +
			"box-sizing:border-box;display:block;margin-top:1%;top:1%;" +
			"border:1px;padding:1px;width:4px;position:absolute";
		div.innerHTML = "";
		docElem.appendChild( container );

		var divStyle = window.getComputedStyle( div, null );
		pixelPositionVal = divStyle.top !== "1%";
		boxSizingReliableVal = divStyle.width === "4px";

		docElem.removeChild( container );
	}

	// Support: node.js jsdom
	// Don't assume that getComputedStyle is a property of the global object
	if ( window.getComputedStyle ) {
		jQuery.extend( support, {
			pixelPosition: function() {

				// This test is executed only once but we still do memoizing
				// since we can use the boxSizingReliable pre-computing.
				// No need to check if the test was already performed, though.
				computePixelPositionAndBoxSizingReliable();
				return pixelPositionVal;
			},
			boxSizingReliable: function() {
				if ( boxSizingReliableVal == null ) {
					computePixelPositionAndBoxSizingReliable();
				}
				return boxSizingReliableVal;
			},
			reliableMarginRight: function() {

				// Support: Android 2.3
				// Check if div with explicit width and no margin-right incorrectly
				// gets computed margin-right based on width of container. (#3333)
				// WebKit Bug 13343 - getComputedStyle returns wrong value for margin-right
				// This support function is only executed once so no memoizing is needed.
				var ret,
					marginDiv = div.appendChild( document.createElement( "div" ) );

				// Reset CSS: box-sizing; display; margin; border; padding
				marginDiv.style.cssText = div.style.cssText =
					// Support: Firefox<29, Android 2.3
					// Vendor-prefix box-sizing
					"-webkit-box-sizing:content-box;-moz-box-sizing:content-box;" +
					"box-sizing:content-box;display:block;margin:0;border:0;padding:0";
				marginDiv.style.marginRight = marginDiv.style.width = "0";
				div.style.width = "1px";
				docElem.appendChild( container );

				ret = !parseFloat( window.getComputedStyle( marginDiv, null ).marginRight );

				docElem.removeChild( container );
				div.removeChild( marginDiv );

				return ret;
			}
		});
	}
})();


// A method for quickly swapping in/out CSS properties to get correct calculations.
jQuery.swap = function( elem, options, callback, args ) {
	var ret, name,
		old = {};

	// Remember the old values, and insert the new ones
	for ( name in options ) {
		old[ name ] = elem.style[ name ];
		elem.style[ name ] = options[ name ];
	}

	ret = callback.apply( elem, args || [] );

	// Revert the old values
	for ( name in options ) {
		elem.style[ name ] = old[ name ];
	}

	return ret;
};


var
	// Swappable if display is none or starts with table except "table", "table-cell", or "table-caption"
	// See here for display values: https://developer.mozilla.org/en-US/docs/CSS/display
	rdisplayswap = /^(none|table(?!-c[ea]).+)/,
	rnumsplit = new RegExp( "^(" + pnum + ")(.*)$", "i" ),
	rrelNum = new RegExp( "^([+-])=(" + pnum + ")", "i" ),

	cssShow = { position: "absolute", visibility: "hidden", display: "block" },
	cssNormalTransform = {
		letterSpacing: "0",
		fontWeight: "400"
	},

	cssPrefixes = [ "Webkit", "O", "Moz", "ms" ];

// Return a css property mapped to a potentially vendor prefixed property
function vendorPropName( style, name ) {

	// Shortcut for names that are not vendor prefixed
	if ( name in style ) {
		return name;
	}

	// Check for vendor prefixed names
	var capName = name[0].toUpperCase() + name.slice(1),
		origName = name,
		i = cssPrefixes.length;

	while ( i-- ) {
		name = cssPrefixes[ i ] + capName;
		if ( name in style ) {
			return name;
		}
	}

	return origName;
}

function setPositiveNumber( elem, value, subtract ) {
	var matches = rnumsplit.exec( value );
	return matches ?
		// Guard against undefined "subtract", e.g., when used as in cssHooks
		Math.max( 0, matches[ 1 ] - ( subtract || 0 ) ) + ( matches[ 2 ] || "px" ) :
		value;
}

function augmentWidthOrHeight( elem, name, extra, isBorderBox, styles ) {
	var i = extra === ( isBorderBox ? "border" : "content" ) ?
		// If we already have the right measurement, avoid augmentation
		4 :
		// Otherwise initialize for horizontal or vertical properties
		name === "width" ? 1 : 0,

		val = 0;

	for ( ; i < 4; i += 2 ) {
		// Both box models exclude margin, so add it if we want it
		if ( extra === "margin" ) {
			val += jQuery.css( elem, extra + cssExpand[ i ], true, styles );
		}

		if ( isBorderBox ) {
			// border-box includes padding, so remove it if we want content
			if ( extra === "content" ) {
				val -= jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );
			}

			// At this point, extra isn't border nor margin, so remove border
			if ( extra !== "margin" ) {
				val -= jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}
		} else {
			// At this point, extra isn't content, so add padding
			val += jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );

			// At this point, extra isn't content nor padding, so add border
			if ( extra !== "padding" ) {
				val += jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}
		}
	}

	return val;
}

function getWidthOrHeight( elem, name, extra ) {

	// Start with offset property, which is equivalent to the border-box value
	var valueIsBorderBox = true,
		val = name === "width" ? elem.offsetWidth : elem.offsetHeight,
		styles = getStyles( elem ),
		isBorderBox = jQuery.css( elem, "boxSizing", false, styles ) === "border-box";

	// Some non-html elements return undefined for offsetWidth, so check for null/undefined
	// svg - https://bugzilla.mozilla.org/show_bug.cgi?id=649285
	// MathML - https://bugzilla.mozilla.org/show_bug.cgi?id=491668
	if ( val <= 0 || val == null ) {
		// Fall back to computed then uncomputed css if necessary
		val = curCSS( elem, name, styles );
		if ( val < 0 || val == null ) {
			val = elem.style[ name ];
		}

		// Computed unit is not pixels. Stop here and return.
		if ( rnumnonpx.test(val) ) {
			return val;
		}

		// Check for style in case a browser which returns unreliable values
		// for getComputedStyle silently falls back to the reliable elem.style
		valueIsBorderBox = isBorderBox &&
			( support.boxSizingReliable() || val === elem.style[ name ] );

		// Normalize "", auto, and prepare for extra
		val = parseFloat( val ) || 0;
	}

	// Use the active box-sizing model to add/subtract irrelevant styles
	return ( val +
		augmentWidthOrHeight(
			elem,
			name,
			extra || ( isBorderBox ? "border" : "content" ),
			valueIsBorderBox,
			styles
		)
	) + "px";
}

function showHide( elements, show ) {
	var display, elem, hidden,
		values = [],
		index = 0,
		length = elements.length;

	for ( ; index < length; index++ ) {
		elem = elements[ index ];
		if ( !elem.style ) {
			continue;
		}

		values[ index ] = data_priv.get( elem, "olddisplay" );
		display = elem.style.display;
		if ( show ) {
			// Reset the inline display of this element to learn if it is
			// being hidden by cascaded rules or not
			if ( !values[ index ] && display === "none" ) {
				elem.style.display = "";
			}

			// Set elements which have been overridden with display: none
			// in a stylesheet to whatever the default browser style is
			// for such an element
			if ( elem.style.display === "" && isHidden( elem ) ) {
				values[ index ] = data_priv.access( elem, "olddisplay", defaultDisplay(elem.nodeName) );
			}
		} else {
			hidden = isHidden( elem );

			if ( display !== "none" || !hidden ) {
				data_priv.set( elem, "olddisplay", hidden ? display : jQuery.css( elem, "display" ) );
			}
		}
	}

	// Set the display of most of the elements in a second loop
	// to avoid the constant reflow
	for ( index = 0; index < length; index++ ) {
		elem = elements[ index ];
		if ( !elem.style ) {
			continue;
		}
		if ( !show || elem.style.display === "none" || elem.style.display === "" ) {
			elem.style.display = show ? values[ index ] || "" : "none";
		}
	}

	return elements;
}

jQuery.extend({

	// Add in style property hooks for overriding the default
	// behavior of getting and setting a style property
	cssHooks: {
		opacity: {
			get: function( elem, computed ) {
				if ( computed ) {

					// We should always get a number back from opacity
					var ret = curCSS( elem, "opacity" );
					return ret === "" ? "1" : ret;
				}
			}
		}
	},

	// Don't automatically add "px" to these possibly-unitless properties
	cssNumber: {
		"columnCount": true,
		"fillOpacity": true,
		"flexGrow": true,
		"flexShrink": true,
		"fontWeight": true,
		"lineHeight": true,
		"opacity": true,
		"order": true,
		"orphans": true,
		"widows": true,
		"zIndex": true,
		"zoom": true
	},

	// Add in properties whose names you wish to fix before
	// setting or getting the value
	cssProps: {
		"float": "cssFloat"
	},

	// Get and set the style property on a DOM Node
	style: function( elem, name, value, extra ) {

		// Don't set styles on text and comment nodes
		if ( !elem || elem.nodeType === 3 || elem.nodeType === 8 || !elem.style ) {
			return;
		}

		// Make sure that we're working with the right name
		var ret, type, hooks,
			origName = jQuery.camelCase( name ),
			style = elem.style;

		name = jQuery.cssProps[ origName ] || ( jQuery.cssProps[ origName ] = vendorPropName( style, origName ) );

		// Gets hook for the prefixed version, then unprefixed version
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// Check if we're setting a value
		if ( value !== undefined ) {
			type = typeof value;

			// Convert "+=" or "-=" to relative numbers (#7345)
			if ( type === "string" && (ret = rrelNum.exec( value )) ) {
				value = ( ret[1] + 1 ) * ret[2] + parseFloat( jQuery.css( elem, name ) );
				// Fixes bug #9237
				type = "number";
			}

			// Make sure that null and NaN values aren't set (#7116)
			if ( value == null || value !== value ) {
				return;
			}

			// If a number, add 'px' to the (except for certain CSS properties)
			if ( type === "number" && !jQuery.cssNumber[ origName ] ) {
				value += "px";
			}

			// Support: IE9-11+
			// background-* props affect original clone's values
			if ( !support.clearCloneStyle && value === "" && name.indexOf( "background" ) === 0 ) {
				style[ name ] = "inherit";
			}

			// If a hook was provided, use that value, otherwise just set the specified value
			if ( !hooks || !("set" in hooks) || (value = hooks.set( elem, value, extra )) !== undefined ) {
				style[ name ] = value;
			}

		} else {
			// If a hook was provided get the non-computed value from there
			if ( hooks && "get" in hooks && (ret = hooks.get( elem, false, extra )) !== undefined ) {
				return ret;
			}

			// Otherwise just get the value from the style object
			return style[ name ];
		}
	},

	css: function( elem, name, extra, styles ) {
		var val, num, hooks,
			origName = jQuery.camelCase( name );

		// Make sure that we're working with the right name
		name = jQuery.cssProps[ origName ] || ( jQuery.cssProps[ origName ] = vendorPropName( elem.style, origName ) );

		// Try prefixed name followed by the unprefixed name
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// If a hook was provided get the computed value from there
		if ( hooks && "get" in hooks ) {
			val = hooks.get( elem, true, extra );
		}

		// Otherwise, if a way to get the computed value exists, use that
		if ( val === undefined ) {
			val = curCSS( elem, name, styles );
		}

		// Convert "normal" to computed value
		if ( val === "normal" && name in cssNormalTransform ) {
			val = cssNormalTransform[ name ];
		}

		// Make numeric if forced or a qualifier was provided and val looks numeric
		if ( extra === "" || extra ) {
			num = parseFloat( val );
			return extra === true || jQuery.isNumeric( num ) ? num || 0 : val;
		}
		return val;
	}
});

jQuery.each([ "height", "width" ], function( i, name ) {
	jQuery.cssHooks[ name ] = {
		get: function( elem, computed, extra ) {
			if ( computed ) {

				// Certain elements can have dimension info if we invisibly show them
				// but it must have a current display style that would benefit
				return rdisplayswap.test( jQuery.css( elem, "display" ) ) && elem.offsetWidth === 0 ?
					jQuery.swap( elem, cssShow, function() {
						return getWidthOrHeight( elem, name, extra );
					}) :
					getWidthOrHeight( elem, name, extra );
			}
		},

		set: function( elem, value, extra ) {
			var styles = extra && getStyles( elem );
			return setPositiveNumber( elem, value, extra ?
				augmentWidthOrHeight(
					elem,
					name,
					extra,
					jQuery.css( elem, "boxSizing", false, styles ) === "border-box",
					styles
				) : 0
			);
		}
	};
});

// Support: Android 2.3
jQuery.cssHooks.marginRight = addGetHookIf( support.reliableMarginRight,
	function( elem, computed ) {
		if ( computed ) {
			return jQuery.swap( elem, { "display": "inline-block" },
				curCSS, [ elem, "marginRight" ] );
		}
	}
);

// These hooks are used by animate to expand properties
jQuery.each({
	margin: "",
	padding: "",
	border: "Width"
}, function( prefix, suffix ) {
	jQuery.cssHooks[ prefix + suffix ] = {
		expand: function( value ) {
			var i = 0,
				expanded = {},

				// Assumes a single number if not a string
				parts = typeof value === "string" ? value.split(" ") : [ value ];

			for ( ; i < 4; i++ ) {
				expanded[ prefix + cssExpand[ i ] + suffix ] =
					parts[ i ] || parts[ i - 2 ] || parts[ 0 ];
			}

			return expanded;
		}
	};

	if ( !rmargin.test( prefix ) ) {
		jQuery.cssHooks[ prefix + suffix ].set = setPositiveNumber;
	}
});

jQuery.fn.extend({
	css: function( name, value ) {
		return access( this, function( elem, name, value ) {
			var styles, len,
				map = {},
				i = 0;

			if ( jQuery.isArray( name ) ) {
				styles = getStyles( elem );
				len = name.length;

				for ( ; i < len; i++ ) {
					map[ name[ i ] ] = jQuery.css( elem, name[ i ], false, styles );
				}

				return map;
			}

			return value !== undefined ?
				jQuery.style( elem, name, value ) :
				jQuery.css( elem, name );
		}, name, value, arguments.length > 1 );
	},
	show: function() {
		return showHide( this, true );
	},
	hide: function() {
		return showHide( this );
	},
	toggle: function( state ) {
		if ( typeof state === "boolean" ) {
			return state ? this.show() : this.hide();
		}

		return this.each(function() {
			if ( isHidden( this ) ) {
				jQuery( this ).show();
			} else {
				jQuery( this ).hide();
			}
		});
	}
});


function Tween( elem, options, prop, end, easing ) {
	return new Tween.prototype.init( elem, options, prop, end, easing );
}
jQuery.Tween = Tween;

Tween.prototype = {
	constructor: Tween,
	init: function( elem, options, prop, end, easing, unit ) {
		this.elem = elem;
		this.prop = prop;
		this.easing = easing || "swing";
		this.options = options;
		this.start = this.now = this.cur();
		this.end = end;
		this.unit = unit || ( jQuery.cssNumber[ prop ] ? "" : "px" );
	},
	cur: function() {
		var hooks = Tween.propHooks[ this.prop ];

		return hooks && hooks.get ?
			hooks.get( this ) :
			Tween.propHooks._default.get( this );
	},
	run: function( percent ) {
		var eased,
			hooks = Tween.propHooks[ this.prop ];

		if ( this.options.duration ) {
			this.pos = eased = jQuery.easing[ this.easing ](
				percent, this.options.duration * percent, 0, 1, this.options.duration
			);
		} else {
			this.pos = eased = percent;
		}
		this.now = ( this.end - this.start ) * eased + this.start;

		if ( this.options.step ) {
			this.options.step.call( this.elem, this.now, this );
		}

		if ( hooks && hooks.set ) {
			hooks.set( this );
		} else {
			Tween.propHooks._default.set( this );
		}
		return this;
	}
};

Tween.prototype.init.prototype = Tween.prototype;

Tween.propHooks = {
	_default: {
		get: function( tween ) {
			var result;

			if ( tween.elem[ tween.prop ] != null &&
				(!tween.elem.style || tween.elem.style[ tween.prop ] == null) ) {
				return tween.elem[ tween.prop ];
			}

			// Passing an empty string as a 3rd parameter to .css will automatically
			// attempt a parseFloat and fallback to a string if the parse fails.
			// Simple values such as "10px" are parsed to Float;
			// complex values such as "rotate(1rad)" are returned as-is.
			result = jQuery.css( tween.elem, tween.prop, "" );
			// Empty strings, null, undefined and "auto" are converted to 0.
			return !result || result === "auto" ? 0 : result;
		},
		set: function( tween ) {
			// Use step hook for back compat.
			// Use cssHook if its there.
			// Use .style if available and use plain properties where available.
			if ( jQuery.fx.step[ tween.prop ] ) {
				jQuery.fx.step[ tween.prop ]( tween );
			} else if ( tween.elem.style && ( tween.elem.style[ jQuery.cssProps[ tween.prop ] ] != null || jQuery.cssHooks[ tween.prop ] ) ) {
				jQuery.style( tween.elem, tween.prop, tween.now + tween.unit );
			} else {
				tween.elem[ tween.prop ] = tween.now;
			}
		}
	}
};

// Support: IE9
// Panic based approach to setting things on disconnected nodes
Tween.propHooks.scrollTop = Tween.propHooks.scrollLeft = {
	set: function( tween ) {
		if ( tween.elem.nodeType && tween.elem.parentNode ) {
			tween.elem[ tween.prop ] = tween.now;
		}
	}
};

jQuery.easing = {
	linear: function( p ) {
		return p;
	},
	swing: function( p ) {
		return 0.5 - Math.cos( p * Math.PI ) / 2;
	}
};

jQuery.fx = Tween.prototype.init;

// Back Compat <1.8 extension point
jQuery.fx.step = {};




var
	fxNow, timerId,
	rfxtypes = /^(?:toggle|show|hide)$/,
	rfxnum = new RegExp( "^(?:([+-])=|)(" + pnum + ")([a-z%]*)$", "i" ),
	rrun = /queueHooks$/,
	animationPrefilters = [ defaultPrefilter ],
	tweeners = {
		"*": [ function( prop, value ) {
			var tween = this.createTween( prop, value ),
				target = tween.cur(),
				parts = rfxnum.exec( value ),
				unit = parts && parts[ 3 ] || ( jQuery.cssNumber[ prop ] ? "" : "px" ),

				// Starting value computation is required for potential unit mismatches
				start = ( jQuery.cssNumber[ prop ] || unit !== "px" && +target ) &&
					rfxnum.exec( jQuery.css( tween.elem, prop ) ),
				scale = 1,
				maxIterations = 20;

			if ( start && start[ 3 ] !== unit ) {
				// Trust units reported by jQuery.css
				unit = unit || start[ 3 ];

				// Make sure we update the tween properties later on
				parts = parts || [];

				// Iteratively approximate from a nonzero starting point
				start = +target || 1;

				do {
					// If previous iteration zeroed out, double until we get *something*.
					// Use string for doubling so we don't accidentally see scale as unchanged below
					scale = scale || ".5";

					// Adjust and apply
					start = start / scale;
					jQuery.style( tween.elem, prop, start + unit );

				// Update scale, tolerating zero or NaN from tween.cur(),
				// break the loop if scale is unchanged or perfect, or if we've just had enough
				} while ( scale !== (scale = tween.cur() / target) && scale !== 1 && --maxIterations );
			}

			// Update tween properties
			if ( parts ) {
				start = tween.start = +start || +target || 0;
				tween.unit = unit;
				// If a +=/-= token was provided, we're doing a relative animation
				tween.end = parts[ 1 ] ?
					start + ( parts[ 1 ] + 1 ) * parts[ 2 ] :
					+parts[ 2 ];
			}

			return tween;
		} ]
	};

// Animations created synchronously will run synchronously
function createFxNow() {
	setTimeout(function() {
		fxNow = undefined;
	});
	return ( fxNow = jQuery.now() );
}

// Generate parameters to create a standard animation
function genFx( type, includeWidth ) {
	var which,
		i = 0,
		attrs = { height: type };

	// If we include width, step value is 1 to do all cssExpand values,
	// otherwise step value is 2 to skip over Left and Right
	includeWidth = includeWidth ? 1 : 0;
	for ( ; i < 4 ; i += 2 - includeWidth ) {
		which = cssExpand[ i ];
		attrs[ "margin" + which ] = attrs[ "padding" + which ] = type;
	}

	if ( includeWidth ) {
		attrs.opacity = attrs.width = type;
	}

	return attrs;
}

function createTween( value, prop, animation ) {
	var tween,
		collection = ( tweeners[ prop ] || [] ).concat( tweeners[ "*" ] ),
		index = 0,
		length = collection.length;
	for ( ; index < length; index++ ) {
		if ( (tween = collection[ index ].call( animation, prop, value )) ) {

			// We're done with this property
			return tween;
		}
	}
}

function defaultPrefilter( elem, props, opts ) {
	/* jshint validthis: true */
	var prop, value, toggle, tween, hooks, oldfire, display, checkDisplay,
		anim = this,
		orig = {},
		style = elem.style,
		hidden = elem.nodeType && isHidden( elem ),
		dataShow = data_priv.get( elem, "fxshow" );

	// Handle queue: false promises
	if ( !opts.queue ) {
		hooks = jQuery._queueHooks( elem, "fx" );
		if ( hooks.unqueued == null ) {
			hooks.unqueued = 0;
			oldfire = hooks.empty.fire;
			hooks.empty.fire = function() {
				if ( !hooks.unqueued ) {
					oldfire();
				}
			};
		}
		hooks.unqueued++;

		anim.always(function() {
			// Ensure the complete handler is called before this completes
			anim.always(function() {
				hooks.unqueued--;
				if ( !jQuery.queue( elem, "fx" ).length ) {
					hooks.empty.fire();
				}
			});
		});
	}

	// Height/width overflow pass
	if ( elem.nodeType === 1 && ( "height" in props || "width" in props ) ) {
		// Make sure that nothing sneaks out
		// Record all 3 overflow attributes because IE9-10 do not
		// change the overflow attribute when overflowX and
		// overflowY are set to the same value
		opts.overflow = [ style.overflow, style.overflowX, style.overflowY ];

		// Set display property to inline-block for height/width
		// animations on inline elements that are having width/height animated
		display = jQuery.css( elem, "display" );

		// Test default display if display is currently "none"
		checkDisplay = display === "none" ?
			data_priv.get( elem, "olddisplay" ) || defaultDisplay( elem.nodeName ) : display;

		if ( checkDisplay === "inline" && jQuery.css( elem, "float" ) === "none" ) {
			style.display = "inline-block";
		}
	}

	if ( opts.overflow ) {
		style.overflow = "hidden";
		anim.always(function() {
			style.overflow = opts.overflow[ 0 ];
			style.overflowX = opts.overflow[ 1 ];
			style.overflowY = opts.overflow[ 2 ];
		});
	}

	// show/hide pass
	for ( prop in props ) {
		value = props[ prop ];
		if ( rfxtypes.exec( value ) ) {
			delete props[ prop ];
			toggle = toggle || value === "toggle";
			if ( value === ( hidden ? "hide" : "show" ) ) {

				// If there is dataShow left over from a stopped hide or show and we are going to proceed with show, we should pretend to be hidden
				if ( value === "show" && dataShow && dataShow[ prop ] !== undefined ) {
					hidden = true;
				} else {
					continue;
				}
			}
			orig[ prop ] = dataShow && dataShow[ prop ] || jQuery.style( elem, prop );

		// Any non-fx value stops us from restoring the original display value
		} else {
			display = undefined;
		}
	}

	if ( !jQuery.isEmptyObject( orig ) ) {
		if ( dataShow ) {
			if ( "hidden" in dataShow ) {
				hidden = dataShow.hidden;
			}
		} else {
			dataShow = data_priv.access( elem, "fxshow", {} );
		}

		// Store state if its toggle - enables .stop().toggle() to "reverse"
		if ( toggle ) {
			dataShow.hidden = !hidden;
		}
		if ( hidden ) {
			jQuery( elem ).show();
		} else {
			anim.done(function() {
				jQuery( elem ).hide();
			});
		}
		anim.done(function() {
			var prop;

			data_priv.remove( elem, "fxshow" );
			for ( prop in orig ) {
				jQuery.style( elem, prop, orig[ prop ] );
			}
		});
		for ( prop in orig ) {
			tween = createTween( hidden ? dataShow[ prop ] : 0, prop, anim );

			if ( !( prop in dataShow ) ) {
				dataShow[ prop ] = tween.start;
				if ( hidden ) {
					tween.end = tween.start;
					tween.start = prop === "width" || prop === "height" ? 1 : 0;
				}
			}
		}

	// If this is a noop like .hide().hide(), restore an overwritten display value
	} else if ( (display === "none" ? defaultDisplay( elem.nodeName ) : display) === "inline" ) {
		style.display = display;
	}
}

function propFilter( props, specialEasing ) {
	var index, name, easing, value, hooks;

	// camelCase, specialEasing and expand cssHook pass
	for ( index in props ) {
		name = jQuery.camelCase( index );
		easing = specialEasing[ name ];
		value = props[ index ];
		if ( jQuery.isArray( value ) ) {
			easing = value[ 1 ];
			value = props[ index ] = value[ 0 ];
		}

		if ( index !== name ) {
			props[ name ] = value;
			delete props[ index ];
		}

		hooks = jQuery.cssHooks[ name ];
		if ( hooks && "expand" in hooks ) {
			value = hooks.expand( value );
			delete props[ name ];

			// Not quite $.extend, this won't overwrite existing keys.
			// Reusing 'index' because we have the correct "name"
			for ( index in value ) {
				if ( !( index in props ) ) {
					props[ index ] = value[ index ];
					specialEasing[ index ] = easing;
				}
			}
		} else {
			specialEasing[ name ] = easing;
		}
	}
}

function Animation( elem, properties, options ) {
	var result,
		stopped,
		index = 0,
		length = animationPrefilters.length,
		deferred = jQuery.Deferred().always( function() {
			// Don't match elem in the :animated selector
			delete tick.elem;
		}),
		tick = function() {
			if ( stopped ) {
				return false;
			}
			var currentTime = fxNow || createFxNow(),
				remaining = Math.max( 0, animation.startTime + animation.duration - currentTime ),
				// Support: Android 2.3
				// Archaic crash bug won't allow us to use `1 - ( 0.5 || 0 )` (#12497)
				temp = remaining / animation.duration || 0,
				percent = 1 - temp,
				index = 0,
				length = animation.tweens.length;

			for ( ; index < length ; index++ ) {
				animation.tweens[ index ].run( percent );
			}

			deferred.notifyWith( elem, [ animation, percent, remaining ]);

			if ( percent < 1 && length ) {
				return remaining;
			} else {
				deferred.resolveWith( elem, [ animation ] );
				return false;
			}
		},
		animation = deferred.promise({
			elem: elem,
			props: jQuery.extend( {}, properties ),
			opts: jQuery.extend( true, { specialEasing: {} }, options ),
			originalProperties: properties,
			originalOptions: options,
			startTime: fxNow || createFxNow(),
			duration: options.duration,
			tweens: [],
			createTween: function( prop, end ) {
				var tween = jQuery.Tween( elem, animation.opts, prop, end,
						animation.opts.specialEasing[ prop ] || animation.opts.easing );
				animation.tweens.push( tween );
				return tween;
			},
			stop: function( gotoEnd ) {
				var index = 0,
					// If we are going to the end, we want to run all the tweens
					// otherwise we skip this part
					length = gotoEnd ? animation.tweens.length : 0;
				if ( stopped ) {
					return this;
				}
				stopped = true;
				for ( ; index < length ; index++ ) {
					animation.tweens[ index ].run( 1 );
				}

				// Resolve when we played the last frame; otherwise, reject
				if ( gotoEnd ) {
					deferred.resolveWith( elem, [ animation, gotoEnd ] );
				} else {
					deferred.rejectWith( elem, [ animation, gotoEnd ] );
				}
				return this;
			}
		}),
		props = animation.props;

	propFilter( props, animation.opts.specialEasing );

	for ( ; index < length ; index++ ) {
		result = animationPrefilters[ index ].call( animation, elem, props, animation.opts );
		if ( result ) {
			return result;
		}
	}

	jQuery.map( props, createTween, animation );

	if ( jQuery.isFunction( animation.opts.start ) ) {
		animation.opts.start.call( elem, animation );
	}

	jQuery.fx.timer(
		jQuery.extend( tick, {
			elem: elem,
			anim: animation,
			queue: animation.opts.queue
		})
	);

	// attach callbacks from options
	return animation.progress( animation.opts.progress )
		.done( animation.opts.done, animation.opts.complete )
		.fail( animation.opts.fail )
		.always( animation.opts.always );
}

jQuery.Animation = jQuery.extend( Animation, {

	tweener: function( props, callback ) {
		if ( jQuery.isFunction( props ) ) {
			callback = props;
			props = [ "*" ];
		} else {
			props = props.split(" ");
		}

		var prop,
			index = 0,
			length = props.length;

		for ( ; index < length ; index++ ) {
			prop = props[ index ];
			tweeners[ prop ] = tweeners[ prop ] || [];
			tweeners[ prop ].unshift( callback );
		}
	},

	prefilter: function( callback, prepend ) {
		if ( prepend ) {
			animationPrefilters.unshift( callback );
		} else {
			animationPrefilters.push( callback );
		}
	}
});

jQuery.speed = function( speed, easing, fn ) {
	var opt = speed && typeof speed === "object" ? jQuery.extend( {}, speed ) : {
		complete: fn || !fn && easing ||
			jQuery.isFunction( speed ) && speed,
		duration: speed,
		easing: fn && easing || easing && !jQuery.isFunction( easing ) && easing
	};

	opt.duration = jQuery.fx.off ? 0 : typeof opt.duration === "number" ? opt.duration :
		opt.duration in jQuery.fx.speeds ? jQuery.fx.speeds[ opt.duration ] : jQuery.fx.speeds._default;

	// Normalize opt.queue - true/undefined/null -> "fx"
	if ( opt.queue == null || opt.queue === true ) {
		opt.queue = "fx";
	}

	// Queueing
	opt.old = opt.complete;

	opt.complete = function() {
		if ( jQuery.isFunction( opt.old ) ) {
			opt.old.call( this );
		}

		if ( opt.queue ) {
			jQuery.dequeue( this, opt.queue );
		}
	};

	return opt;
};

jQuery.fn.extend({
	fadeTo: function( speed, to, easing, callback ) {

		// Show any hidden elements after setting opacity to 0
		return this.filter( isHidden ).css( "opacity", 0 ).show()

			// Animate to the value specified
			.end().animate({ opacity: to }, speed, easing, callback );
	},
	animate: function( prop, speed, easing, callback ) {
		var empty = jQuery.isEmptyObject( prop ),
			optall = jQuery.speed( speed, easing, callback ),
			doAnimation = function() {
				// Operate on a copy of prop so per-property easing won't be lost
				var anim = Animation( this, jQuery.extend( {}, prop ), optall );

				// Empty animations, or finishing resolves immediately
				if ( empty || data_priv.get( this, "finish" ) ) {
					anim.stop( true );
				}
			};
			doAnimation.finish = doAnimation;

		return empty || optall.queue === false ?
			this.each( doAnimation ) :
			this.queue( optall.queue, doAnimation );
	},
	stop: function( type, clearQueue, gotoEnd ) {
		var stopQueue = function( hooks ) {
			var stop = hooks.stop;
			delete hooks.stop;
			stop( gotoEnd );
		};

		if ( typeof type !== "string" ) {
			gotoEnd = clearQueue;
			clearQueue = type;
			type = undefined;
		}
		if ( clearQueue && type !== false ) {
			this.queue( type || "fx", [] );
		}

		return this.each(function() {
			var dequeue = true,
				index = type != null && type + "queueHooks",
				timers = jQuery.timers,
				data = data_priv.get( this );

			if ( index ) {
				if ( data[ index ] && data[ index ].stop ) {
					stopQueue( data[ index ] );
				}
			} else {
				for ( index in data ) {
					if ( data[ index ] && data[ index ].stop && rrun.test( index ) ) {
						stopQueue( data[ index ] );
					}
				}
			}

			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this && (type == null || timers[ index ].queue === type) ) {
					timers[ index ].anim.stop( gotoEnd );
					dequeue = false;
					timers.splice( index, 1 );
				}
			}

			// Start the next in the queue if the last step wasn't forced.
			// Timers currently will call their complete callbacks, which
			// will dequeue but only if they were gotoEnd.
			if ( dequeue || !gotoEnd ) {
				jQuery.dequeue( this, type );
			}
		});
	},
	finish: function( type ) {
		if ( type !== false ) {
			type = type || "fx";
		}
		return this.each(function() {
			var index,
				data = data_priv.get( this ),
				queue = data[ type + "queue" ],
				hooks = data[ type + "queueHooks" ],
				timers = jQuery.timers,
				length = queue ? queue.length : 0;

			// Enable finishing flag on private data
			data.finish = true;

			// Empty the queue first
			jQuery.queue( this, type, [] );

			if ( hooks && hooks.stop ) {
				hooks.stop.call( this, true );
			}

			// Look for any active animations, and finish them
			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this && timers[ index ].queue === type ) {
					timers[ index ].anim.stop( true );
					timers.splice( index, 1 );
				}
			}

			// Look for any animations in the old queue and finish them
			for ( index = 0; index < length; index++ ) {
				if ( queue[ index ] && queue[ index ].finish ) {
					queue[ index ].finish.call( this );
				}
			}

			// Turn off finishing flag
			delete data.finish;
		});
	}
});

jQuery.each([ "toggle", "show", "hide" ], function( i, name ) {
	var cssFn = jQuery.fn[ name ];
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return speed == null || typeof speed === "boolean" ?
			cssFn.apply( this, arguments ) :
			this.animate( genFx( name, true ), speed, easing, callback );
	};
});

// Generate shortcuts for custom animations
jQuery.each({
	slideDown: genFx("show"),
	slideUp: genFx("hide"),
	slideToggle: genFx("toggle"),
	fadeIn: { opacity: "show" },
	fadeOut: { opacity: "hide" },
	fadeToggle: { opacity: "toggle" }
}, function( name, props ) {
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return this.animate( props, speed, easing, callback );
	};
});

jQuery.timers = [];
jQuery.fx.tick = function() {
	var timer,
		i = 0,
		timers = jQuery.timers;

	fxNow = jQuery.now();

	for ( ; i < timers.length; i++ ) {
		timer = timers[ i ];
		// Checks the timer has not already been removed
		if ( !timer() && timers[ i ] === timer ) {
			timers.splice( i--, 1 );
		}
	}

	if ( !timers.length ) {
		jQuery.fx.stop();
	}
	fxNow = undefined;
};

jQuery.fx.timer = function( timer ) {
	jQuery.timers.push( timer );
	if ( timer() ) {
		jQuery.fx.start();
	} else {
		jQuery.timers.pop();
	}
};

jQuery.fx.interval = 13;

jQuery.fx.start = function() {
	if ( !timerId ) {
		timerId = setInterval( jQuery.fx.tick, jQuery.fx.interval );
	}
};

jQuery.fx.stop = function() {
	clearInterval( timerId );
	timerId = null;
};

jQuery.fx.speeds = {
	slow: 600,
	fast: 200,
	// Default speed
	_default: 400
};


// Based off of the plugin by Clint Helfers, with permission.
// http://blindsignals.com/index.php/2009/07/jquery-delay/
jQuery.fn.delay = function( time, type ) {
	time = jQuery.fx ? jQuery.fx.speeds[ time ] || time : time;
	type = type || "fx";

	return this.queue( type, function( next, hooks ) {
		var timeout = setTimeout( next, time );
		hooks.stop = function() {
			clearTimeout( timeout );
		};
	});
};


(function() {
	var input = document.createElement( "input" ),
		select = document.createElement( "select" ),
		opt = select.appendChild( document.createElement( "option" ) );

	input.type = "checkbox";

	// Support: iOS<=5.1, Android<=4.2+
	// Default value for a checkbox should be "on"
	support.checkOn = input.value !== "";

	// Support: IE<=11+
	// Must access selectedIndex to make default options select
	support.optSelected = opt.selected;

	// Support: Android<=2.3
	// Options inside disabled selects are incorrectly marked as disabled
	select.disabled = true;
	support.optDisabled = !opt.disabled;

	// Support: IE<=11+
	// An input loses its value after becoming a radio
	input = document.createElement( "input" );
	input.value = "t";
	input.type = "radio";
	support.radioValue = input.value === "t";
})();


var nodeHook, boolHook,
	attrHandle = jQuery.expr.attrHandle;

jQuery.fn.extend({
	attr: function( name, value ) {
		return access( this, jQuery.attr, name, value, arguments.length > 1 );
	},

	removeAttr: function( name ) {
		return this.each(function() {
			jQuery.removeAttr( this, name );
		});
	}
});

jQuery.extend({
	attr: function( elem, name, value ) {
		var hooks, ret,
			nType = elem.nodeType;

		// don't get/set attributes on text, comment and attribute nodes
		if ( !elem || nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		// Fallback to prop when attributes are not supported
		if ( typeof elem.getAttribute === strundefined ) {
			return jQuery.prop( elem, name, value );
		}

		// All attributes are lowercase
		// Grab necessary hook if one is defined
		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {
			name = name.toLowerCase();
			hooks = jQuery.attrHooks[ name ] ||
				( jQuery.expr.match.bool.test( name ) ? boolHook : nodeHook );
		}

		if ( value !== undefined ) {

			if ( value === null ) {
				jQuery.removeAttr( elem, name );

			} else if ( hooks && "set" in hooks && (ret = hooks.set( elem, value, name )) !== undefined ) {
				return ret;

			} else {
				elem.setAttribute( name, value + "" );
				return value;
			}

		} else if ( hooks && "get" in hooks && (ret = hooks.get( elem, name )) !== null ) {
			return ret;

		} else {
			ret = jQuery.find.attr( elem, name );

			// Non-existent attributes return null, we normalize to undefined
			return ret == null ?
				undefined :
				ret;
		}
	},

	removeAttr: function( elem, value ) {
		var name, propName,
			i = 0,
			attrNames = value && value.match( rnotwhite );

		if ( attrNames && elem.nodeType === 1 ) {
			while ( (name = attrNames[i++]) ) {
				propName = jQuery.propFix[ name ] || name;

				// Boolean attributes get special treatment (#10870)
				if ( jQuery.expr.match.bool.test( name ) ) {
					// Set corresponding property to false
					elem[ propName ] = false;
				}

				elem.removeAttribute( name );
			}
		}
	},

	attrHooks: {
		type: {
			set: function( elem, value ) {
				if ( !support.radioValue && value === "radio" &&
					jQuery.nodeName( elem, "input" ) ) {
					var val = elem.value;
					elem.setAttribute( "type", value );
					if ( val ) {
						elem.value = val;
					}
					return value;
				}
			}
		}
	}
});

// Hooks for boolean attributes
boolHook = {
	set: function( elem, value, name ) {
		if ( value === false ) {
			// Remove boolean attributes when set to false
			jQuery.removeAttr( elem, name );
		} else {
			elem.setAttribute( name, name );
		}
		return name;
	}
};
jQuery.each( jQuery.expr.match.bool.source.match( /\w+/g ), function( i, name ) {
	var getter = attrHandle[ name ] || jQuery.find.attr;

	attrHandle[ name ] = function( elem, name, isXML ) {
		var ret, handle;
		if ( !isXML ) {
			// Avoid an infinite loop by temporarily removing this function from the getter
			handle = attrHandle[ name ];
			attrHandle[ name ] = ret;
			ret = getter( elem, name, isXML ) != null ?
				name.toLowerCase() :
				null;
			attrHandle[ name ] = handle;
		}
		return ret;
	};
});




var rfocusable = /^(?:input|select|textarea|button)$/i;

jQuery.fn.extend({
	prop: function( name, value ) {
		return access( this, jQuery.prop, name, value, arguments.length > 1 );
	},

	removeProp: function( name ) {
		return this.each(function() {
			delete this[ jQuery.propFix[ name ] || name ];
		});
	}
});

jQuery.extend({
	propFix: {
		"for": "htmlFor",
		"class": "className"
	},

	prop: function( elem, name, value ) {
		var ret, hooks, notxml,
			nType = elem.nodeType;

		// Don't get/set properties on text, comment and attribute nodes
		if ( !elem || nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		notxml = nType !== 1 || !jQuery.isXMLDoc( elem );

		if ( notxml ) {
			// Fix name and attach hooks
			name = jQuery.propFix[ name ] || name;
			hooks = jQuery.propHooks[ name ];
		}

		if ( value !== undefined ) {
			return hooks && "set" in hooks && (ret = hooks.set( elem, value, name )) !== undefined ?
				ret :
				( elem[ name ] = value );

		} else {
			return hooks && "get" in hooks && (ret = hooks.get( elem, name )) !== null ?
				ret :
				elem[ name ];
		}
	},

	propHooks: {
		tabIndex: {
			get: function( elem ) {
				return elem.hasAttribute( "tabindex" ) || rfocusable.test( elem.nodeName ) || elem.href ?
					elem.tabIndex :
					-1;
			}
		}
	}
});

if ( !support.optSelected ) {
	jQuery.propHooks.selected = {
		get: function( elem ) {
			var parent = elem.parentNode;
			if ( parent && parent.parentNode ) {
				parent.parentNode.selectedIndex;
			}
			return null;
		}
	};
}

jQuery.each([
	"tabIndex",
	"readOnly",
	"maxLength",
	"cellSpacing",
	"cellPadding",
	"rowSpan",
	"colSpan",
	"useMap",
	"frameBorder",
	"contentEditable"
], function() {
	jQuery.propFix[ this.toLowerCase() ] = this;
});




var rclass = /[\t\r\n\f]/g;

jQuery.fn.extend({
	addClass: function( value ) {
		var classes, elem, cur, clazz, j, finalValue,
			proceed = typeof value === "string" && value,
			i = 0,
			len = this.length;

		if ( jQuery.isFunction( value ) ) {
			return this.each(function( j ) {
				jQuery( this ).addClass( value.call( this, j, this.className ) );
			});
		}

		if ( proceed ) {
			// The disjunction here is for better compressibility (see removeClass)
			classes = ( value || "" ).match( rnotwhite ) || [];

			for ( ; i < len; i++ ) {
				elem = this[ i ];
				cur = elem.nodeType === 1 && ( elem.className ?
					( " " + elem.className + " " ).replace( rclass, " " ) :
					" "
				);

				if ( cur ) {
					j = 0;
					while ( (clazz = classes[j++]) ) {
						if ( cur.indexOf( " " + clazz + " " ) < 0 ) {
							cur += clazz + " ";
						}
					}

					// only assign if different to avoid unneeded rendering.
					finalValue = jQuery.trim( cur );
					if ( elem.className !== finalValue ) {
						elem.className = finalValue;
					}
				}
			}
		}

		return this;
	},

	removeClass: function( value ) {
		var classes, elem, cur, clazz, j, finalValue,
			proceed = arguments.length === 0 || typeof value === "string" && value,
			i = 0,
			len = this.length;

		if ( jQuery.isFunction( value ) ) {
			return this.each(function( j ) {
				jQuery( this ).removeClass( value.call( this, j, this.className ) );
			});
		}
		if ( proceed ) {
			classes = ( value || "" ).match( rnotwhite ) || [];

			for ( ; i < len; i++ ) {
				elem = this[ i ];
				// This expression is here for better compressibility (see addClass)
				cur = elem.nodeType === 1 && ( elem.className ?
					( " " + elem.className + " " ).replace( rclass, " " ) :
					""
				);

				if ( cur ) {
					j = 0;
					while ( (clazz = classes[j++]) ) {
						// Remove *all* instances
						while ( cur.indexOf( " " + clazz + " " ) >= 0 ) {
							cur = cur.replace( " " + clazz + " ", " " );
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = value ? jQuery.trim( cur ) : "";
					if ( elem.className !== finalValue ) {
						elem.className = finalValue;
					}
				}
			}
		}

		return this;
	},

	toggleClass: function( value, stateVal ) {
		var type = typeof value;

		if ( typeof stateVal === "boolean" && type === "string" ) {
			return stateVal ? this.addClass( value ) : this.removeClass( value );
		}

		if ( jQuery.isFunction( value ) ) {
			return this.each(function( i ) {
				jQuery( this ).toggleClass( value.call(this, i, this.className, stateVal), stateVal );
			});
		}

		return this.each(function() {
			if ( type === "string" ) {
				// Toggle individual class names
				var className,
					i = 0,
					self = jQuery( this ),
					classNames = value.match( rnotwhite ) || [];

				while ( (className = classNames[ i++ ]) ) {
					// Check each className given, space separated list
					if ( self.hasClass( className ) ) {
						self.removeClass( className );
					} else {
						self.addClass( className );
					}
				}

			// Toggle whole class name
			} else if ( type === strundefined || type === "boolean" ) {
				if ( this.className ) {
					// store className if set
					data_priv.set( this, "__className__", this.className );
				}

				// If the element has a class name or if we're passed `false`,
				// then remove the whole classname (if there was one, the above saved it).
				// Otherwise bring back whatever was previously saved (if anything),
				// falling back to the empty string if nothing was stored.
				this.className = this.className || value === false ? "" : data_priv.get( this, "__className__" ) || "";
			}
		});
	},

	hasClass: function( selector ) {
		var className = " " + selector + " ",
			i = 0,
			l = this.length;
		for ( ; i < l; i++ ) {
			if ( this[i].nodeType === 1 && (" " + this[i].className + " ").replace(rclass, " ").indexOf( className ) >= 0 ) {
				return true;
			}
		}

		return false;
	}
});




var rreturn = /\r/g;

jQuery.fn.extend({
	val: function( value ) {
		var hooks, ret, isFunction,
			elem = this[0];

		if ( !arguments.length ) {
			if ( elem ) {
				hooks = jQuery.valHooks[ elem.type ] || jQuery.valHooks[ elem.nodeName.toLowerCase() ];

				if ( hooks && "get" in hooks && (ret = hooks.get( elem, "value" )) !== undefined ) {
					return ret;
				}

				ret = elem.value;

				return typeof ret === "string" ?
					// Handle most common string cases
					ret.replace(rreturn, "") :
					// Handle cases where value is null/undef or number
					ret == null ? "" : ret;
			}

			return;
		}

		isFunction = jQuery.isFunction( value );

		return this.each(function( i ) {
			var val;

			if ( this.nodeType !== 1 ) {
				return;
			}

			if ( isFunction ) {
				val = value.call( this, i, jQuery( this ).val() );
			} else {
				val = value;
			}

			// Treat null/undefined as ""; convert numbers to string
			if ( val == null ) {
				val = "";

			} else if ( typeof val === "number" ) {
				val += "";

			} else if ( jQuery.isArray( val ) ) {
				val = jQuery.map( val, function( value ) {
					return value == null ? "" : value + "";
				});
			}

			hooks = jQuery.valHooks[ this.type ] || jQuery.valHooks[ this.nodeName.toLowerCase() ];

			// If set returns undefined, fall back to normal setting
			if ( !hooks || !("set" in hooks) || hooks.set( this, val, "value" ) === undefined ) {
				this.value = val;
			}
		});
	}
});

jQuery.extend({
	valHooks: {
		option: {
			get: function( elem ) {
				var val = jQuery.find.attr( elem, "value" );
				return val != null ?
					val :
					// Support: IE10-11+
					// option.text throws exceptions (#14686, #14858)
					jQuery.trim( jQuery.text( elem ) );
			}
		},
		select: {
			get: function( elem ) {
				var value, option,
					options = elem.options,
					index = elem.selectedIndex,
					one = elem.type === "select-one" || index < 0,
					values = one ? null : [],
					max = one ? index + 1 : options.length,
					i = index < 0 ?
						max :
						one ? index : 0;

				// Loop through all the selected options
				for ( ; i < max; i++ ) {
					option = options[ i ];

					// IE6-9 doesn't update selected after form reset (#2551)
					if ( ( option.selected || i === index ) &&
							// Don't return options that are disabled or in a disabled optgroup
							( support.optDisabled ? !option.disabled : option.getAttribute( "disabled" ) === null ) &&
							( !option.parentNode.disabled || !jQuery.nodeName( option.parentNode, "optgroup" ) ) ) {

						// Get the specific value for the option
						value = jQuery( option ).val();

						// We don't need an array for one selects
						if ( one ) {
							return value;
						}

						// Multi-Selects return an array
						values.push( value );
					}
				}

				return values;
			},

			set: function( elem, value ) {
				var optionSet, option,
					options = elem.options,
					values = jQuery.makeArray( value ),
					i = options.length;

				while ( i-- ) {
					option = options[ i ];
					if ( (option.selected = jQuery.inArray( option.value, values ) >= 0) ) {
						optionSet = true;
					}
				}

				// Force browsers to behave consistently when non-matching value is set
				if ( !optionSet ) {
					elem.selectedIndex = -1;
				}
				return values;
			}
		}
	}
});

// Radios and checkboxes getter/setter
jQuery.each([ "radio", "checkbox" ], function() {
	jQuery.valHooks[ this ] = {
		set: function( elem, value ) {
			if ( jQuery.isArray( value ) ) {
				return ( elem.checked = jQuery.inArray( jQuery(elem).val(), value ) >= 0 );
			}
		}
	};
	if ( !support.checkOn ) {
		jQuery.valHooks[ this ].get = function( elem ) {
			return elem.getAttribute("value") === null ? "on" : elem.value;
		};
	}
});




// Return jQuery for attributes-only inclusion


jQuery.each( ("blur focus focusin focusout load resize scroll unload click dblclick " +
	"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave " +
	"change select submit keydown keypress keyup error contextmenu").split(" "), function( i, name ) {

	// Handle event binding
	jQuery.fn[ name ] = function( data, fn ) {
		return arguments.length > 0 ?
			this.on( name, null, data, fn ) :
			this.trigger( name );
	};
});

jQuery.fn.extend({
	hover: function( fnOver, fnOut ) {
		return this.mouseenter( fnOver ).mouseleave( fnOut || fnOver );
	},

	bind: function( types, data, fn ) {
		return this.on( types, null, data, fn );
	},
	unbind: function( types, fn ) {
		return this.off( types, null, fn );
	},

	delegate: function( selector, types, data, fn ) {
		return this.on( types, selector, data, fn );
	},
	undelegate: function( selector, types, fn ) {
		// ( namespace ) or ( selector, types [, fn] )
		return arguments.length === 1 ? this.off( selector, "**" ) : this.off( types, selector || "**", fn );
	}
});


var nonce = jQuery.now();

var rquery = (/\?/);



// Support: Android 2.3
// Workaround failure to string-cast null input
jQuery.parseJSON = function( data ) {
	return JSON.parse( data + "" );
};


// Cross-browser xml parsing
jQuery.parseXML = function( data ) {
	var xml, tmp;
	if ( !data || typeof data !== "string" ) {
		return null;
	}

	// Support: IE9
	try {
		tmp = new DOMParser();
		xml = tmp.parseFromString( data, "text/xml" );
	} catch ( e ) {
		xml = undefined;
	}

	if ( !xml || xml.getElementsByTagName( "parsererror" ).length ) {
		jQuery.error( "Invalid XML: " + data );
	}
	return xml;
};


var
	rhash = /#.*$/,
	rts = /([?&])_=[^&]*/,
	rheaders = /^(.*?):[ \t]*([^\r\n]*)$/mg,
	// #7653, #8125, #8152: local protocol detection
	rlocalProtocol = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
	rnoContent = /^(?:GET|HEAD)$/,
	rprotocol = /^\/\//,
	rurl = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,

	/* Prefilters
	 * 1) They are useful to introduce custom dataTypes (see ajax/jsonp.js for an example)
	 * 2) These are called:
	 *    - BEFORE asking for a transport
	 *    - AFTER param serialization (s.data is a string if s.processData is true)
	 * 3) key is the dataType
	 * 4) the catchall symbol "*" can be used
	 * 5) execution will start with transport dataType and THEN continue down to "*" if needed
	 */
	prefilters = {},

	/* Transports bindings
	 * 1) key is the dataType
	 * 2) the catchall symbol "*" can be used
	 * 3) selection will start with transport dataType and THEN go to "*" if needed
	 */
	transports = {},

	// Avoid comment-prolog char sequence (#10098); must appease lint and evade compression
	allTypes = "*/".concat( "*" ),

	// Document location
	ajaxLocation = window.location.href,

	// Segment location into parts
	ajaxLocParts = rurl.exec( ajaxLocation.toLowerCase() ) || [];

// Base "constructor" for jQuery.ajaxPrefilter and jQuery.ajaxTransport
function addToPrefiltersOrTransports( structure ) {

	// dataTypeExpression is optional and defaults to "*"
	return function( dataTypeExpression, func ) {

		if ( typeof dataTypeExpression !== "string" ) {
			func = dataTypeExpression;
			dataTypeExpression = "*";
		}

		var dataType,
			i = 0,
			dataTypes = dataTypeExpression.toLowerCase().match( rnotwhite ) || [];

		if ( jQuery.isFunction( func ) ) {
			// For each dataType in the dataTypeExpression
			while ( (dataType = dataTypes[i++]) ) {
				// Prepend if requested
				if ( dataType[0] === "+" ) {
					dataType = dataType.slice( 1 ) || "*";
					(structure[ dataType ] = structure[ dataType ] || []).unshift( func );

				// Otherwise append
				} else {
					(structure[ dataType ] = structure[ dataType ] || []).push( func );
				}
			}
		}
	};
}

// Base inspection function for prefilters and transports
function inspectPrefiltersOrTransports( structure, options, originalOptions, jqXHR ) {

	var inspected = {},
		seekingTransport = ( structure === transports );

	function inspect( dataType ) {
		var selected;
		inspected[ dataType ] = true;
		jQuery.each( structure[ dataType ] || [], function( _, prefilterOrFactory ) {
			var dataTypeOrTransport = prefilterOrFactory( options, originalOptions, jqXHR );
			if ( typeof dataTypeOrTransport === "string" && !seekingTransport && !inspected[ dataTypeOrTransport ] ) {
				options.dataTypes.unshift( dataTypeOrTransport );
				inspect( dataTypeOrTransport );
				return false;
			} else if ( seekingTransport ) {
				return !( selected = dataTypeOrTransport );
			}
		});
		return selected;
	}

	return inspect( options.dataTypes[ 0 ] ) || !inspected[ "*" ] && inspect( "*" );
}

// A special extend for ajax options
// that takes "flat" options (not to be deep extended)
// Fixes #9887
function ajaxExtend( target, src ) {
	var key, deep,
		flatOptions = jQuery.ajaxSettings.flatOptions || {};

	for ( key in src ) {
		if ( src[ key ] !== undefined ) {
			( flatOptions[ key ] ? target : ( deep || (deep = {}) ) )[ key ] = src[ key ];
		}
	}
	if ( deep ) {
		jQuery.extend( true, target, deep );
	}

	return target;
}

/* Handles responses to an ajax request:
 * - finds the right dataType (mediates between content-type and expected dataType)
 * - returns the corresponding response
 */
function ajaxHandleResponses( s, jqXHR, responses ) {

	var ct, type, finalDataType, firstDataType,
		contents = s.contents,
		dataTypes = s.dataTypes;

	// Remove auto dataType and get content-type in the process
	while ( dataTypes[ 0 ] === "*" ) {
		dataTypes.shift();
		if ( ct === undefined ) {
			ct = s.mimeType || jqXHR.getResponseHeader("Content-Type");
		}
	}

	// Check if we're dealing with a known content-type
	if ( ct ) {
		for ( type in contents ) {
			if ( contents[ type ] && contents[ type ].test( ct ) ) {
				dataTypes.unshift( type );
				break;
			}
		}
	}

	// Check to see if we have a response for the expected dataType
	if ( dataTypes[ 0 ] in responses ) {
		finalDataType = dataTypes[ 0 ];
	} else {
		// Try convertible dataTypes
		for ( type in responses ) {
			if ( !dataTypes[ 0 ] || s.converters[ type + " " + dataTypes[0] ] ) {
				finalDataType = type;
				break;
			}
			if ( !firstDataType ) {
				firstDataType = type;
			}
		}
		// Or just use first one
		finalDataType = finalDataType || firstDataType;
	}

	// If we found a dataType
	// We add the dataType to the list if needed
	// and return the corresponding response
	if ( finalDataType ) {
		if ( finalDataType !== dataTypes[ 0 ] ) {
			dataTypes.unshift( finalDataType );
		}
		return responses[ finalDataType ];
	}
}

/* Chain conversions given the request and the original response
 * Also sets the responseXXX fields on the jqXHR instance
 */
function ajaxConvert( s, response, jqXHR, isSuccess ) {
	var conv2, current, conv, tmp, prev,
		converters = {},
		// Work with a copy of dataTypes in case we need to modify it for conversion
		dataTypes = s.dataTypes.slice();

	// Create converters map with lowercased keys
	if ( dataTypes[ 1 ] ) {
		for ( conv in s.converters ) {
			converters[ conv.toLowerCase() ] = s.converters[ conv ];
		}
	}

	current = dataTypes.shift();

	// Convert to each sequential dataType
	while ( current ) {

		if ( s.responseFields[ current ] ) {
			jqXHR[ s.responseFields[ current ] ] = response;
		}

		// Apply the dataFilter if provided
		if ( !prev && isSuccess && s.dataFilter ) {
			response = s.dataFilter( response, s.dataType );
		}

		prev = current;
		current = dataTypes.shift();

		if ( current ) {

		// There's only work to do if current dataType is non-auto
			if ( current === "*" ) {

				current = prev;

			// Convert response if prev dataType is non-auto and differs from current
			} else if ( prev !== "*" && prev !== current ) {

				// Seek a direct converter
				conv = converters[ prev + " " + current ] || converters[ "* " + current ];

				// If none found, seek a pair
				if ( !conv ) {
					for ( conv2 in converters ) {

						// If conv2 outputs current
						tmp = conv2.split( " " );
						if ( tmp[ 1 ] === current ) {

							// If prev can be converted to accepted input
							conv = converters[ prev + " " + tmp[ 0 ] ] ||
								converters[ "* " + tmp[ 0 ] ];
							if ( conv ) {
								// Condense equivalence converters
								if ( conv === true ) {
									conv = converters[ conv2 ];

								// Otherwise, insert the intermediate dataType
								} else if ( converters[ conv2 ] !== true ) {
									current = tmp[ 0 ];
									dataTypes.unshift( tmp[ 1 ] );
								}
								break;
							}
						}
					}
				}

				// Apply converter (if not an equivalence)
				if ( conv !== true ) {

					// Unless errors are allowed to bubble, catch and return them
					if ( conv && s[ "throws" ] ) {
						response = conv( response );
					} else {
						try {
							response = conv( response );
						} catch ( e ) {
							return { state: "parsererror", error: conv ? e : "No conversion from " + prev + " to " + current };
						}
					}
				}
			}
		}
	}

	return { state: "success", data: response };
}

jQuery.extend({

	// Counter for holding the number of active queries
	active: 0,

	// Last-Modified header cache for next request
	lastModified: {},
	etag: {},

	ajaxSettings: {
		url: ajaxLocation,
		type: "GET",
		isLocal: rlocalProtocol.test( ajaxLocParts[ 1 ] ),
		global: true,
		processData: true,
		async: true,
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		/*
		timeout: 0,
		data: null,
		dataType: null,
		username: null,
		password: null,
		cache: null,
		throws: false,
		traditional: false,
		headers: {},
		*/

		accepts: {
			"*": allTypes,
			text: "text/plain",
			html: "text/html",
			xml: "application/xml, text/xml",
			json: "application/json, text/javascript"
		},

		contents: {
			xml: /xml/,
			html: /html/,
			json: /json/
		},

		responseFields: {
			xml: "responseXML",
			text: "responseText",
			json: "responseJSON"
		},

		// Data converters
		// Keys separate source (or catchall "*") and destination types with a single space
		converters: {

			// Convert anything to text
			"* text": String,

			// Text to html (true = no transformation)
			"text html": true,

			// Evaluate text as a json expression
			"text json": jQuery.parseJSON,

			// Parse text as xml
			"text xml": jQuery.parseXML
		},

		// For options that shouldn't be deep extended:
		// you can add your own custom options here if
		// and when you create one that shouldn't be
		// deep extended (see ajaxExtend)
		flatOptions: {
			url: true,
			context: true
		}
	},

	// Creates a full fledged settings object into target
	// with both ajaxSettings and settings fields.
	// If target is omitted, writes into ajaxSettings.
	ajaxSetup: function( target, settings ) {
		return settings ?

			// Building a settings object
			ajaxExtend( ajaxExtend( target, jQuery.ajaxSettings ), settings ) :

			// Extending ajaxSettings
			ajaxExtend( jQuery.ajaxSettings, target );
	},

	ajaxPrefilter: addToPrefiltersOrTransports( prefilters ),
	ajaxTransport: addToPrefiltersOrTransports( transports ),

	// Main method
	ajax: function( url, options ) {

		// If url is an object, simulate pre-1.5 signature
		if ( typeof url === "object" ) {
			options = url;
			url = undefined;
		}

		// Force options to be an object
		options = options || {};

		var transport,
			// URL without anti-cache param
			cacheURL,
			// Response headers
			responseHeadersString,
			responseHeaders,
			// timeout handle
			timeoutTimer,
			// Cross-domain detection vars
			parts,
			// To know if global events are to be dispatched
			fireGlobals,
			// Loop variable
			i,
			// Create the final options object
			s = jQuery.ajaxSetup( {}, options ),
			// Callbacks context
			callbackContext = s.context || s,
			// Context for global events is callbackContext if it is a DOM node or jQuery collection
			globalEventContext = s.context && ( callbackContext.nodeType || callbackContext.jquery ) ?
				jQuery( callbackContext ) :
				jQuery.event,
			// Deferreds
			deferred = jQuery.Deferred(),
			completeDeferred = jQuery.Callbacks("once memory"),
			// Status-dependent callbacks
			statusCode = s.statusCode || {},
			// Headers (they are sent all at once)
			requestHeaders = {},
			requestHeadersNames = {},
			// The jqXHR state
			state = 0,
			// Default abort message
			strAbort = "canceled",
			// Fake xhr
			jqXHR = {
				readyState: 0,

				// Builds headers hashtable if needed
				getResponseHeader: function( key ) {
					var match;
					if ( state === 2 ) {
						if ( !responseHeaders ) {
							responseHeaders = {};
							while ( (match = rheaders.exec( responseHeadersString )) ) {
								responseHeaders[ match[1].toLowerCase() ] = match[ 2 ];
							}
						}
						match = responseHeaders[ key.toLowerCase() ];
					}
					return match == null ? null : match;
				},

				// Raw string
				getAllResponseHeaders: function() {
					return state === 2 ? responseHeadersString : null;
				},

				// Caches the header
				setRequestHeader: function( name, value ) {
					var lname = name.toLowerCase();
					if ( !state ) {
						name = requestHeadersNames[ lname ] = requestHeadersNames[ lname ] || name;
						requestHeaders[ name ] = value;
					}
					return this;
				},

				// Overrides response content-type header
				overrideMimeType: function( type ) {
					if ( !state ) {
						s.mimeType = type;
					}
					return this;
				},

				// Status-dependent callbacks
				statusCode: function( map ) {
					var code;
					if ( map ) {
						if ( state < 2 ) {
							for ( code in map ) {
								// Lazy-add the new callback in a way that preserves old ones
								statusCode[ code ] = [ statusCode[ code ], map[ code ] ];
							}
						} else {
							// Execute the appropriate callbacks
							jqXHR.always( map[ jqXHR.status ] );
						}
					}
					return this;
				},

				// Cancel the request
				abort: function( statusText ) {
					var finalText = statusText || strAbort;
					if ( transport ) {
						transport.abort( finalText );
					}
					done( 0, finalText );
					return this;
				}
			};

		// Attach deferreds
		deferred.promise( jqXHR ).complete = completeDeferred.add;
		jqXHR.success = jqXHR.done;
		jqXHR.error = jqXHR.fail;

		// Remove hash character (#7531: and string promotion)
		// Add protocol if not provided (prefilters might expect it)
		// Handle falsy url in the settings object (#10093: consistency with old signature)
		// We also use the url parameter if available
		s.url = ( ( url || s.url || ajaxLocation ) + "" ).replace( rhash, "" )
			.replace( rprotocol, ajaxLocParts[ 1 ] + "//" );

		// Alias method option to type as per ticket #12004
		s.type = options.method || options.type || s.method || s.type;

		// Extract dataTypes list
		s.dataTypes = jQuery.trim( s.dataType || "*" ).toLowerCase().match( rnotwhite ) || [ "" ];

		// A cross-domain request is in order when we have a protocol:host:port mismatch
		if ( s.crossDomain == null ) {
			parts = rurl.exec( s.url.toLowerCase() );
			s.crossDomain = !!( parts &&
				( parts[ 1 ] !== ajaxLocParts[ 1 ] || parts[ 2 ] !== ajaxLocParts[ 2 ] ||
					( parts[ 3 ] || ( parts[ 1 ] === "http:" ? "80" : "443" ) ) !==
						( ajaxLocParts[ 3 ] || ( ajaxLocParts[ 1 ] === "http:" ? "80" : "443" ) ) )
			);
		}

		// Convert data if not already a string
		if ( s.data && s.processData && typeof s.data !== "string" ) {
			s.data = jQuery.param( s.data, s.traditional );
		}

		// Apply prefilters
		inspectPrefiltersOrTransports( prefilters, s, options, jqXHR );

		// If request was aborted inside a prefilter, stop there
		if ( state === 2 ) {
			return jqXHR;
		}

		// We can fire global events as of now if asked to
		// Don't fire events if jQuery.event is undefined in an AMD-usage scenario (#15118)
		fireGlobals = jQuery.event && s.global;

		// Watch for a new set of requests
		if ( fireGlobals && jQuery.active++ === 0 ) {
			jQuery.event.trigger("ajaxStart");
		}

		// Uppercase the type
		s.type = s.type.toUpperCase();

		// Determine if request has content
		s.hasContent = !rnoContent.test( s.type );

		// Save the URL in case we're toying with the If-Modified-Since
		// and/or If-None-Match header later on
		cacheURL = s.url;

		// More options handling for requests with no content
		if ( !s.hasContent ) {

			// If data is available, append data to url
			if ( s.data ) {
				cacheURL = ( s.url += ( rquery.test( cacheURL ) ? "&" : "?" ) + s.data );
				// #9682: remove data so that it's not used in an eventual retry
				delete s.data;
			}

			// Add anti-cache in url if needed
			if ( s.cache === false ) {
				s.url = rts.test( cacheURL ) ?

					// If there is already a '_' parameter, set its value
					cacheURL.replace( rts, "$1_=" + nonce++ ) :

					// Otherwise add one to the end
					cacheURL + ( rquery.test( cacheURL ) ? "&" : "?" ) + "_=" + nonce++;
			}
		}

		// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
		if ( s.ifModified ) {
			if ( jQuery.lastModified[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-Modified-Since", jQuery.lastModified[ cacheURL ] );
			}
			if ( jQuery.etag[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-None-Match", jQuery.etag[ cacheURL ] );
			}
		}

		// Set the correct header, if data is being sent
		if ( s.data && s.hasContent && s.contentType !== false || options.contentType ) {
			jqXHR.setRequestHeader( "Content-Type", s.contentType );
		}

		// Set the Accepts header for the server, depending on the dataType
		jqXHR.setRequestHeader(
			"Accept",
			s.dataTypes[ 0 ] && s.accepts[ s.dataTypes[0] ] ?
				s.accepts[ s.dataTypes[0] ] + ( s.dataTypes[ 0 ] !== "*" ? ", " + allTypes + "; q=0.01" : "" ) :
				s.accepts[ "*" ]
		);

		// Check for headers option
		for ( i in s.headers ) {
			jqXHR.setRequestHeader( i, s.headers[ i ] );
		}

		// Allow custom headers/mimetypes and early abort
		if ( s.beforeSend && ( s.beforeSend.call( callbackContext, jqXHR, s ) === false || state === 2 ) ) {
			// Abort if not done already and return
			return jqXHR.abort();
		}

		// Aborting is no longer a cancellation
		strAbort = "abort";

		// Install callbacks on deferreds
		for ( i in { success: 1, error: 1, complete: 1 } ) {
			jqXHR[ i ]( s[ i ] );
		}

		// Get transport
		transport = inspectPrefiltersOrTransports( transports, s, options, jqXHR );

		// If no transport, we auto-abort
		if ( !transport ) {
			done( -1, "No Transport" );
		} else {
			jqXHR.readyState = 1;

			// Send global event
			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxSend", [ jqXHR, s ] );
			}
			// Timeout
			if ( s.async && s.timeout > 0 ) {
				timeoutTimer = setTimeout(function() {
					jqXHR.abort("timeout");
				}, s.timeout );
			}

			try {
				state = 1;
				transport.send( requestHeaders, done );
			} catch ( e ) {
				// Propagate exception as error if not done
				if ( state < 2 ) {
					done( -1, e );
				// Simply rethrow otherwise
				} else {
					throw e;
				}
			}
		}

		// Callback for when everything is done
		function done( status, nativeStatusText, responses, headers ) {
			var isSuccess, success, error, response, modified,
				statusText = nativeStatusText;

			// Called once
			if ( state === 2 ) {
				return;
			}

			// State is "done" now
			state = 2;

			// Clear timeout if it exists
			if ( timeoutTimer ) {
				clearTimeout( timeoutTimer );
			}

			// Dereference transport for early garbage collection
			// (no matter how long the jqXHR object will be used)
			transport = undefined;

			// Cache response headers
			responseHeadersString = headers || "";

			// Set readyState
			jqXHR.readyState = status > 0 ? 4 : 0;

			// Determine if successful
			isSuccess = status >= 200 && status < 300 || status === 304;

			// Get response data
			if ( responses ) {
				response = ajaxHandleResponses( s, jqXHR, responses );
			}

			// Convert no matter what (that way responseXXX fields are always set)
			response = ajaxConvert( s, response, jqXHR, isSuccess );

			// If successful, handle type chaining
			if ( isSuccess ) {

				// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
				if ( s.ifModified ) {
					modified = jqXHR.getResponseHeader("Last-Modified");
					if ( modified ) {
						jQuery.lastModified[ cacheURL ] = modified;
					}
					modified = jqXHR.getResponseHeader("etag");
					if ( modified ) {
						jQuery.etag[ cacheURL ] = modified;
					}
				}

				// if no content
				if ( status === 204 || s.type === "HEAD" ) {
					statusText = "nocontent";

				// if not modified
				} else if ( status === 304 ) {
					statusText = "notmodified";

				// If we have data, let's convert it
				} else {
					statusText = response.state;
					success = response.data;
					error = response.error;
					isSuccess = !error;
				}
			} else {
				// Extract error from statusText and normalize for non-aborts
				error = statusText;
				if ( status || !statusText ) {
					statusText = "error";
					if ( status < 0 ) {
						status = 0;
					}
				}
			}

			// Set data for the fake xhr object
			jqXHR.status = status;
			jqXHR.statusText = ( nativeStatusText || statusText ) + "";

			// Success/Error
			if ( isSuccess ) {
				deferred.resolveWith( callbackContext, [ success, statusText, jqXHR ] );
			} else {
				deferred.rejectWith( callbackContext, [ jqXHR, statusText, error ] );
			}

			// Status-dependent callbacks
			jqXHR.statusCode( statusCode );
			statusCode = undefined;

			if ( fireGlobals ) {
				globalEventContext.trigger( isSuccess ? "ajaxSuccess" : "ajaxError",
					[ jqXHR, s, isSuccess ? success : error ] );
			}

			// Complete
			completeDeferred.fireWith( callbackContext, [ jqXHR, statusText ] );

			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxComplete", [ jqXHR, s ] );
				// Handle the global AJAX counter
				if ( !( --jQuery.active ) ) {
					jQuery.event.trigger("ajaxStop");
				}
			}
		}

		return jqXHR;
	},

	getJSON: function( url, data, callback ) {
		return jQuery.get( url, data, callback, "json" );
	},

	getScript: function( url, callback ) {
		return jQuery.get( url, undefined, callback, "script" );
	}
});

jQuery.each( [ "get", "post" ], function( i, method ) {
	jQuery[ method ] = function( url, data, callback, type ) {
		// Shift arguments if data argument was omitted
		if ( jQuery.isFunction( data ) ) {
			type = type || callback;
			callback = data;
			data = undefined;
		}

		return jQuery.ajax({
			url: url,
			type: method,
			dataType: type,
			data: data,
			success: callback
		});
	};
});


jQuery._evalUrl = function( url ) {
	return jQuery.ajax({
		url: url,
		type: "GET",
		dataType: "script",
		async: false,
		global: false,
		"throws": true
	});
};


jQuery.fn.extend({
	wrapAll: function( html ) {
		var wrap;

		if ( jQuery.isFunction( html ) ) {
			return this.each(function( i ) {
				jQuery( this ).wrapAll( html.call(this, i) );
			});
		}

		if ( this[ 0 ] ) {

			// The elements to wrap the target around
			wrap = jQuery( html, this[ 0 ].ownerDocument ).eq( 0 ).clone( true );

			if ( this[ 0 ].parentNode ) {
				wrap.insertBefore( this[ 0 ] );
			}

			wrap.map(function() {
				var elem = this;

				while ( elem.firstElementChild ) {
					elem = elem.firstElementChild;
				}

				return elem;
			}).append( this );
		}

		return this;
	},

	wrapInner: function( html ) {
		if ( jQuery.isFunction( html ) ) {
			return this.each(function( i ) {
				jQuery( this ).wrapInner( html.call(this, i) );
			});
		}

		return this.each(function() {
			var self = jQuery( this ),
				contents = self.contents();

			if ( contents.length ) {
				contents.wrapAll( html );

			} else {
				self.append( html );
			}
		});
	},

	wrap: function( html ) {
		var isFunction = jQuery.isFunction( html );

		return this.each(function( i ) {
			jQuery( this ).wrapAll( isFunction ? html.call(this, i) : html );
		});
	},

	unwrap: function() {
		return this.parent().each(function() {
			if ( !jQuery.nodeName( this, "body" ) ) {
				jQuery( this ).replaceWith( this.childNodes );
			}
		}).end();
	}
});


jQuery.expr.filters.hidden = function( elem ) {
	// Support: Opera <= 12.12
	// Opera reports offsetWidths and offsetHeights less than zero on some elements
	return elem.offsetWidth <= 0 && elem.offsetHeight <= 0;
};
jQuery.expr.filters.visible = function( elem ) {
	return !jQuery.expr.filters.hidden( elem );
};




var r20 = /%20/g,
	rbracket = /\[\]$/,
	rCRLF = /\r?\n/g,
	rsubmitterTypes = /^(?:submit|button|image|reset|file)$/i,
	rsubmittable = /^(?:input|select|textarea|keygen)/i;

function buildParams( prefix, obj, traditional, add ) {
	var name;

	if ( jQuery.isArray( obj ) ) {
		// Serialize array item.
		jQuery.each( obj, function( i, v ) {
			if ( traditional || rbracket.test( prefix ) ) {
				// Treat each array item as a scalar.
				add( prefix, v );

			} else {
				// Item is non-scalar (array or object), encode its numeric index.
				buildParams( prefix + "[" + ( typeof v === "object" ? i : "" ) + "]", v, traditional, add );
			}
		});

	} else if ( !traditional && jQuery.type( obj ) === "object" ) {
		// Serialize object item.
		for ( name in obj ) {
			buildParams( prefix + "[" + name + "]", obj[ name ], traditional, add );
		}

	} else {
		// Serialize scalar item.
		add( prefix, obj );
	}
}

// Serialize an array of form elements or a set of
// key/values into a query string
jQuery.param = function( a, traditional ) {
	var prefix,
		s = [],
		add = function( key, value ) {
			// If value is a function, invoke it and return its value
			value = jQuery.isFunction( value ) ? value() : ( value == null ? "" : value );
			s[ s.length ] = encodeURIComponent( key ) + "=" + encodeURIComponent( value );
		};

	// Set traditional to true for jQuery <= 1.3.2 behavior.
	if ( traditional === undefined ) {
		traditional = jQuery.ajaxSettings && jQuery.ajaxSettings.traditional;
	}

	// If an array was passed in, assume that it is an array of form elements.
	if ( jQuery.isArray( a ) || ( a.jquery && !jQuery.isPlainObject( a ) ) ) {
		// Serialize the form elements
		jQuery.each( a, function() {
			add( this.name, this.value );
		});

	} else {
		// If traditional, encode the "old" way (the way 1.3.2 or older
		// did it), otherwise encode params recursively.
		for ( prefix in a ) {
			buildParams( prefix, a[ prefix ], traditional, add );
		}
	}

	// Return the resulting serialization
	return s.join( "&" ).replace( r20, "+" );
};

jQuery.fn.extend({
	serialize: function() {
		return jQuery.param( this.serializeArray() );
	},
	serializeArray: function() {
		return this.map(function() {
			// Can add propHook for "elements" to filter or add form elements
			var elements = jQuery.prop( this, "elements" );
			return elements ? jQuery.makeArray( elements ) : this;
		})
		.filter(function() {
			var type = this.type;

			// Use .is( ":disabled" ) so that fieldset[disabled] works
			return this.name && !jQuery( this ).is( ":disabled" ) &&
				rsubmittable.test( this.nodeName ) && !rsubmitterTypes.test( type ) &&
				( this.checked || !rcheckableType.test( type ) );
		})
		.map(function( i, elem ) {
			var val = jQuery( this ).val();

			return val == null ?
				null :
				jQuery.isArray( val ) ?
					jQuery.map( val, function( val ) {
						return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
					}) :
					{ name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
		}).get();
	}
});


jQuery.ajaxSettings.xhr = function() {
	try {
		return new XMLHttpRequest();
	} catch( e ) {}
};

var xhrId = 0,
	xhrCallbacks = {},
	xhrSuccessStatus = {
		// file protocol always yields status code 0, assume 200
		0: 200,
		// Support: IE9
		// #1450: sometimes IE returns 1223 when it should be 204
		1223: 204
	},
	xhrSupported = jQuery.ajaxSettings.xhr();

// Support: IE9
// Open requests must be manually aborted on unload (#5280)
// See https://support.microsoft.com/kb/2856746 for more info
if ( window.attachEvent ) {
	window.attachEvent( "onunload", function() {
		for ( var key in xhrCallbacks ) {
			xhrCallbacks[ key ]();
		}
	});
}

support.cors = !!xhrSupported && ( "withCredentials" in xhrSupported );
support.ajax = xhrSupported = !!xhrSupported;

jQuery.ajaxTransport(function( options ) {
	var callback;

	// Cross domain only allowed if supported through XMLHttpRequest
	if ( support.cors || xhrSupported && !options.crossDomain ) {
		return {
			send: function( headers, complete ) {
				var i,
					xhr = options.xhr(),
					id = ++xhrId;

				xhr.open( options.type, options.url, options.async, options.username, options.password );

				// Apply custom fields if provided
				if ( options.xhrFields ) {
					for ( i in options.xhrFields ) {
						xhr[ i ] = options.xhrFields[ i ];
					}
				}

				// Override mime type if needed
				if ( options.mimeType && xhr.overrideMimeType ) {
					xhr.overrideMimeType( options.mimeType );
				}

				// X-Requested-With header
				// For cross-domain requests, seeing as conditions for a preflight are
				// akin to a jigsaw puzzle, we simply never set it to be sure.
				// (it can always be set on a per-request basis or even using ajaxSetup)
				// For same-domain requests, won't change header if already provided.
				if ( !options.crossDomain && !headers["X-Requested-With"] ) {
					headers["X-Requested-With"] = "XMLHttpRequest";
				}

				// Set headers
				for ( i in headers ) {
					xhr.setRequestHeader( i, headers[ i ] );
				}

				// Callback
				callback = function( type ) {
					return function() {
						if ( callback ) {
							delete xhrCallbacks[ id ];
							callback = xhr.onload = xhr.onerror = null;

							if ( type === "abort" ) {
								xhr.abort();
							} else if ( type === "error" ) {
								complete(
									// file: protocol always yields status 0; see #8605, #14207
									xhr.status,
									xhr.statusText
								);
							} else {
								complete(
									xhrSuccessStatus[ xhr.status ] || xhr.status,
									xhr.statusText,
									// Support: IE9
									// Accessing binary-data responseText throws an exception
									// (#11426)
									typeof xhr.responseText === "string" ? {
										text: xhr.responseText
									} : undefined,
									xhr.getAllResponseHeaders()
								);
							}
						}
					};
				};

				// Listen to events
				xhr.onload = callback();
				xhr.onerror = callback("error");

				// Create the abort callback
				callback = xhrCallbacks[ id ] = callback("abort");

				try {
					// Do send the request (this may raise an exception)
					xhr.send( options.hasContent && options.data || null );
				} catch ( e ) {
					// #14683: Only rethrow if this hasn't been notified as an error yet
					if ( callback ) {
						throw e;
					}
				}
			},

			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
});




// Install script dataType
jQuery.ajaxSetup({
	accepts: {
		script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
	},
	contents: {
		script: /(?:java|ecma)script/
	},
	converters: {
		"text script": function( text ) {
			jQuery.globalEval( text );
			return text;
		}
	}
});

// Handle cache's special case and crossDomain
jQuery.ajaxPrefilter( "script", function( s ) {
	if ( s.cache === undefined ) {
		s.cache = false;
	}
	if ( s.crossDomain ) {
		s.type = "GET";
	}
});

// Bind script tag hack transport
jQuery.ajaxTransport( "script", function( s ) {
	// This transport only deals with cross domain requests
	if ( s.crossDomain ) {
		var script, callback;
		return {
			send: function( _, complete ) {
				script = jQuery("<script>").prop({
					async: true,
					charset: s.scriptCharset,
					src: s.url
				}).on(
					"load error",
					callback = function( evt ) {
						script.remove();
						callback = null;
						if ( evt ) {
							complete( evt.type === "error" ? 404 : 200, evt.type );
						}
					}
				);
				document.head.appendChild( script[ 0 ] );
			},
			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
});




var oldCallbacks = [],
	rjsonp = /(=)\?(?=&|$)|\?\?/;

// Default jsonp settings
jQuery.ajaxSetup({
	jsonp: "callback",
	jsonpCallback: function() {
		var callback = oldCallbacks.pop() || ( jQuery.expando + "_" + ( nonce++ ) );
		this[ callback ] = true;
		return callback;
	}
});

// Detect, normalize options and install callbacks for jsonp requests
jQuery.ajaxPrefilter( "json jsonp", function( s, originalSettings, jqXHR ) {

	var callbackName, overwritten, responseContainer,
		jsonProp = s.jsonp !== false && ( rjsonp.test( s.url ) ?
			"url" :
			typeof s.data === "string" && !( s.contentType || "" ).indexOf("application/x-www-form-urlencoded") && rjsonp.test( s.data ) && "data"
		);

	// Handle iff the expected data type is "jsonp" or we have a parameter to set
	if ( jsonProp || s.dataTypes[ 0 ] === "jsonp" ) {

		// Get callback name, remembering preexisting value associated with it
		callbackName = s.jsonpCallback = jQuery.isFunction( s.jsonpCallback ) ?
			s.jsonpCallback() :
			s.jsonpCallback;

		// Insert callback into url or form data
		if ( jsonProp ) {
			s[ jsonProp ] = s[ jsonProp ].replace( rjsonp, "$1" + callbackName );
		} else if ( s.jsonp !== false ) {
			s.url += ( rquery.test( s.url ) ? "&" : "?" ) + s.jsonp + "=" + callbackName;
		}

		// Use data converter to retrieve json after script execution
		s.converters["script json"] = function() {
			if ( !responseContainer ) {
				jQuery.error( callbackName + " was not called" );
			}
			return responseContainer[ 0 ];
		};

		// force json dataType
		s.dataTypes[ 0 ] = "json";

		// Install callback
		overwritten = window[ callbackName ];
		window[ callbackName ] = function() {
			responseContainer = arguments;
		};

		// Clean-up function (fires after converters)
		jqXHR.always(function() {
			// Restore preexisting value
			window[ callbackName ] = overwritten;

			// Save back as free
			if ( s[ callbackName ] ) {
				// make sure that re-using the options doesn't screw things around
				s.jsonpCallback = originalSettings.jsonpCallback;

				// save the callback name for future use
				oldCallbacks.push( callbackName );
			}

			// Call if it was a function and we have a response
			if ( responseContainer && jQuery.isFunction( overwritten ) ) {
				overwritten( responseContainer[ 0 ] );
			}

			responseContainer = overwritten = undefined;
		});

		// Delegate to script
		return "script";
	}
});




// data: string of html
// context (optional): If specified, the fragment will be created in this context, defaults to document
// keepScripts (optional): If true, will include scripts passed in the html string
jQuery.parseHTML = function( data, context, keepScripts ) {
	if ( !data || typeof data !== "string" ) {
		return null;
	}
	if ( typeof context === "boolean" ) {
		keepScripts = context;
		context = false;
	}
	context = context || document;

	var parsed = rsingleTag.exec( data ),
		scripts = !keepScripts && [];

	// Single tag
	if ( parsed ) {
		return [ context.createElement( parsed[1] ) ];
	}

	parsed = jQuery.buildFragment( [ data ], context, scripts );

	if ( scripts && scripts.length ) {
		jQuery( scripts ).remove();
	}

	return jQuery.merge( [], parsed.childNodes );
};


// Keep a copy of the old load method
var _load = jQuery.fn.load;

/**
 * Load a url into a page
 */
jQuery.fn.load = function( url, params, callback ) {
	if ( typeof url !== "string" && _load ) {
		return _load.apply( this, arguments );
	}

	var selector, type, response,
		self = this,
		off = url.indexOf(" ");

	if ( off >= 0 ) {
		selector = jQuery.trim( url.slice( off ) );
		url = url.slice( 0, off );
	}

	// If it's a function
	if ( jQuery.isFunction( params ) ) {

		// We assume that it's the callback
		callback = params;
		params = undefined;

	// Otherwise, build a param string
	} else if ( params && typeof params === "object" ) {
		type = "POST";
	}

	// If we have elements to modify, make the request
	if ( self.length > 0 ) {
		jQuery.ajax({
			url: url,

			// if "type" variable is undefined, then "GET" method will be used
			type: type,
			dataType: "html",
			data: params
		}).done(function( responseText ) {

			// Save response for use in complete callback
			response = arguments;

			self.html( selector ?

				// If a selector was specified, locate the right elements in a dummy div
				// Exclude scripts to avoid IE 'Permission Denied' errors
				jQuery("<div>").append( jQuery.parseHTML( responseText ) ).find( selector ) :

				// Otherwise use the full result
				responseText );

		}).complete( callback && function( jqXHR, status ) {
			self.each( callback, response || [ jqXHR.responseText, status, jqXHR ] );
		});
	}

	return this;
};




// Attach a bunch of functions for handling common AJAX events
jQuery.each( [ "ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend" ], function( i, type ) {
	jQuery.fn[ type ] = function( fn ) {
		return this.on( type, fn );
	};
});




jQuery.expr.filters.animated = function( elem ) {
	return jQuery.grep(jQuery.timers, function( fn ) {
		return elem === fn.elem;
	}).length;
};




var docElem = window.document.documentElement;

/**
 * Gets a window from an element
 */
function getWindow( elem ) {
	return jQuery.isWindow( elem ) ? elem : elem.nodeType === 9 && elem.defaultView;
}

jQuery.offset = {
	setOffset: function( elem, options, i ) {
		var curPosition, curLeft, curCSSTop, curTop, curOffset, curCSSLeft, calculatePosition,
			position = jQuery.css( elem, "position" ),
			curElem = jQuery( elem ),
			props = {};

		// Set position first, in-case top/left are set even on static elem
		if ( position === "static" ) {
			elem.style.position = "relative";
		}

		curOffset = curElem.offset();
		curCSSTop = jQuery.css( elem, "top" );
		curCSSLeft = jQuery.css( elem, "left" );
		calculatePosition = ( position === "absolute" || position === "fixed" ) &&
			( curCSSTop + curCSSLeft ).indexOf("auto") > -1;

		// Need to be able to calculate position if either
		// top or left is auto and position is either absolute or fixed
		if ( calculatePosition ) {
			curPosition = curElem.position();
			curTop = curPosition.top;
			curLeft = curPosition.left;

		} else {
			curTop = parseFloat( curCSSTop ) || 0;
			curLeft = parseFloat( curCSSLeft ) || 0;
		}

		if ( jQuery.isFunction( options ) ) {
			options = options.call( elem, i, curOffset );
		}

		if ( options.top != null ) {
			props.top = ( options.top - curOffset.top ) + curTop;
		}
		if ( options.left != null ) {
			props.left = ( options.left - curOffset.left ) + curLeft;
		}

		if ( "using" in options ) {
			options.using.call( elem, props );

		} else {
			curElem.css( props );
		}
	}
};

jQuery.fn.extend({
	offset: function( options ) {
		if ( arguments.length ) {
			return options === undefined ?
				this :
				this.each(function( i ) {
					jQuery.offset.setOffset( this, options, i );
				});
		}

		var docElem, win,
			elem = this[ 0 ],
			box = { top: 0, left: 0 },
			doc = elem && elem.ownerDocument;

		if ( !doc ) {
			return;
		}

		docElem = doc.documentElement;

		// Make sure it's not a disconnected DOM node
		if ( !jQuery.contains( docElem, elem ) ) {
			return box;
		}

		// Support: BlackBerry 5, iOS 3 (original iPhone)
		// If we don't have gBCR, just use 0,0 rather than error
		if ( typeof elem.getBoundingClientRect !== strundefined ) {
			box = elem.getBoundingClientRect();
		}
		win = getWindow( doc );
		return {
			top: box.top + win.pageYOffset - docElem.clientTop,
			left: box.left + win.pageXOffset - docElem.clientLeft
		};
	},

	position: function() {
		if ( !this[ 0 ] ) {
			return;
		}

		var offsetParent, offset,
			elem = this[ 0 ],
			parentOffset = { top: 0, left: 0 };

		// Fixed elements are offset from window (parentOffset = {top:0, left: 0}, because it is its only offset parent
		if ( jQuery.css( elem, "position" ) === "fixed" ) {
			// Assume getBoundingClientRect is there when computed position is fixed
			offset = elem.getBoundingClientRect();

		} else {
			// Get *real* offsetParent
			offsetParent = this.offsetParent();

			// Get correct offsets
			offset = this.offset();
			if ( !jQuery.nodeName( offsetParent[ 0 ], "html" ) ) {
				parentOffset = offsetParent.offset();
			}

			// Add offsetParent borders
			parentOffset.top += jQuery.css( offsetParent[ 0 ], "borderTopWidth", true );
			parentOffset.left += jQuery.css( offsetParent[ 0 ], "borderLeftWidth", true );
		}

		// Subtract parent offsets and element margins
		return {
			top: offset.top - parentOffset.top - jQuery.css( elem, "marginTop", true ),
			left: offset.left - parentOffset.left - jQuery.css( elem, "marginLeft", true )
		};
	},

	offsetParent: function() {
		return this.map(function() {
			var offsetParent = this.offsetParent || docElem;

			while ( offsetParent && ( !jQuery.nodeName( offsetParent, "html" ) && jQuery.css( offsetParent, "position" ) === "static" ) ) {
				offsetParent = offsetParent.offsetParent;
			}

			return offsetParent || docElem;
		});
	}
});

// Create scrollLeft and scrollTop methods
jQuery.each( { scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function( method, prop ) {
	var top = "pageYOffset" === prop;

	jQuery.fn[ method ] = function( val ) {
		return access( this, function( elem, method, val ) {
			var win = getWindow( elem );

			if ( val === undefined ) {
				return win ? win[ prop ] : elem[ method ];
			}

			if ( win ) {
				win.scrollTo(
					!top ? val : window.pageXOffset,
					top ? val : window.pageYOffset
				);

			} else {
				elem[ method ] = val;
			}
		}, method, val, arguments.length, null );
	};
});

// Support: Safari<7+, Chrome<37+
// Add the top/left cssHooks using jQuery.fn.position
// Webkit bug: https://bugs.webkit.org/show_bug.cgi?id=29084
// Blink bug: https://code.google.com/p/chromium/issues/detail?id=229280
// getComputedStyle returns percent when specified for top/left/bottom/right;
// rather than make the css module depend on the offset module, just check for it here
jQuery.each( [ "top", "left" ], function( i, prop ) {
	jQuery.cssHooks[ prop ] = addGetHookIf( support.pixelPosition,
		function( elem, computed ) {
			if ( computed ) {
				computed = curCSS( elem, prop );
				// If curCSS returns percentage, fallback to offset
				return rnumnonpx.test( computed ) ?
					jQuery( elem ).position()[ prop ] + "px" :
					computed;
			}
		}
	);
});


// Create innerHeight, innerWidth, height, width, outerHeight and outerWidth methods
jQuery.each( { Height: "height", Width: "width" }, function( name, type ) {
	jQuery.each( { padding: "inner" + name, content: type, "": "outer" + name }, function( defaultExtra, funcName ) {
		// Margin is only for outerHeight, outerWidth
		jQuery.fn[ funcName ] = function( margin, value ) {
			var chainable = arguments.length && ( defaultExtra || typeof margin !== "boolean" ),
				extra = defaultExtra || ( margin === true || value === true ? "margin" : "border" );

			return access( this, function( elem, type, value ) {
				var doc;

				if ( jQuery.isWindow( elem ) ) {
					// As of 5/8/2012 this will yield incorrect results for Mobile Safari, but there
					// isn't a whole lot we can do. See pull request at this URL for discussion:
					// https://github.com/jquery/jquery/pull/764
					return elem.document.documentElement[ "client" + name ];
				}

				// Get document width or height
				if ( elem.nodeType === 9 ) {
					doc = elem.documentElement;

					// Either scroll[Width/Height] or offset[Width/Height] or client[Width/Height],
					// whichever is greatest
					return Math.max(
						elem.body[ "scroll" + name ], doc[ "scroll" + name ],
						elem.body[ "offset" + name ], doc[ "offset" + name ],
						doc[ "client" + name ]
					);
				}

				return value === undefined ?
					// Get width or height on the element, requesting but not forcing parseFloat
					jQuery.css( elem, type, extra ) :

					// Set width or height on the element
					jQuery.style( elem, type, value, extra );
			}, type, chainable ? margin : undefined, chainable, null );
		};
	});
});


// The number of elements contained in the matched element set
jQuery.fn.size = function() {
	return this.length;
};

jQuery.fn.andSelf = jQuery.fn.addBack;




// Register as a named AMD module, since jQuery can be concatenated with other
// files that may use define, but not via a proper concatenation script that
// understands anonymous AMD modules. A named AMD is safest and most robust
// way to register. Lowercase jquery is used because AMD module names are
// derived from file names, and jQuery is normally delivered in a lowercase
// file name. Do this after creating the global so that if an AMD module wants
// to call noConflict to hide this version of jQuery, it will work.

// Note that for maximum portability, libraries that are not jQuery should
// declare themselves as anonymous modules, and avoid setting a global if an
// AMD loader is present. jQuery is a special case. For more information, see
// https://github.com/jrburke/requirejs/wiki/Updating-existing-libraries#wiki-anon

if ( typeof define === "function" && define.amd ) {
	define( "jquery", [], function() {
		return jQuery;
	});
}




var
	// Map over jQuery in case of overwrite
	_jQuery = window.jQuery,

	// Map over the $ in case of overwrite
	_$ = window.$;

jQuery.noConflict = function( deep ) {
	if ( window.$ === jQuery ) {
		window.$ = _$;
	}

	if ( deep && window.jQuery === jQuery ) {
		window.jQuery = _jQuery;
	}

	return jQuery;
};

// Expose jQuery and $ identifiers, even in AMD
// (#7102#comment:10, https://github.com/jquery/jquery/pull/557)
// and CommonJS for browser emulators (#13566)
if ( typeof noGlobal === strundefined ) {
	window.jQuery = window.$ = jQuery;
}




return jQuery;

}));

/*!
 * Bootstrap v3.3.5 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under the MIT license
 */

if (typeof jQuery === 'undefined') {
  throw new Error('Bootstrap\'s JavaScript requires jQuery')
}

+function ($) {
  'use strict';
  var version = $.fn.jquery.split(' ')[0].split('.')
  if ((version[0] < 2 && version[1] < 9) || (version[0] == 1 && version[1] == 9 && version[2] < 1)) {
    throw new Error('Bootstrap\'s JavaScript requires jQuery version 1.9.1 or higher')
  }
}(jQuery);

/* ========================================================================
 * Bootstrap: transition.js v3.3.5
 * http://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // CSS TRANSITION SUPPORT (Shoutout: http://www.modernizr.com/)
  // ============================================================

  function transitionEnd() {
    var el = document.createElement('bootstrap')

    var transEndEventNames = {
      WebkitTransition : 'webkitTransitionEnd',
      MozTransition    : 'transitionend',
      OTransition      : 'oTransitionEnd otransitionend',
      transition       : 'transitionend'
    }

    for (var name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return { end: transEndEventNames[name] }
      }
    }

    return false // explicit for ie8 (  ._.)
  }

  // http://blog.alexmaccaw.com/css-transitions
  $.fn.emulateTransitionEnd = function (duration) {
    var called = false
    var $el = this
    $(this).one('bsTransitionEnd', function () { called = true })
    var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
    setTimeout(callback, duration)
    return this
  }

  $(function () {
    $.support.transition = transitionEnd()

    if (!$.support.transition) return

    $.event.special.bsTransitionEnd = {
      bindType: $.support.transition.end,
      delegateType: $.support.transition.end,
      handle: function (e) {
        if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
      }
    }
  })

}(jQuery);

/* ========================================================================
 * Bootstrap: alert.js v3.3.5
 * http://getbootstrap.com/javascript/#alerts
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // ALERT CLASS DEFINITION
  // ======================

  var dismiss = '[data-dismiss="alert"]'
  var Alert   = function (el) {
    $(el).on('click', dismiss, this.close)
  }

  Alert.VERSION = '3.3.5'

  Alert.TRANSITION_DURATION = 150

  Alert.prototype.close = function (e) {
    var $this    = $(this)
    var selector = $this.attr('data-target')

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
    }

    var $parent = $(selector)

    if (e) e.preventDefault()

    if (!$parent.length) {
      $parent = $this.closest('.alert')
    }

    $parent.trigger(e = $.Event('close.bs.alert'))

    if (e.isDefaultPrevented()) return

    $parent.removeClass('in')

    function removeElement() {
      // detach from parent, fire event then clean up data
      $parent.detach().trigger('closed.bs.alert').remove()
    }

    $.support.transition && $parent.hasClass('fade') ?
      $parent
        .one('bsTransitionEnd', removeElement)
        .emulateTransitionEnd(Alert.TRANSITION_DURATION) :
      removeElement()
  }


  // ALERT PLUGIN DEFINITION
  // =======================

  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data('bs.alert')

      if (!data) $this.data('bs.alert', (data = new Alert(this)))
      if (typeof option == 'string') data[option].call($this)
    })
  }

  var old = $.fn.alert

  $.fn.alert             = Plugin
  $.fn.alert.Constructor = Alert


  // ALERT NO CONFLICT
  // =================

  $.fn.alert.noConflict = function () {
    $.fn.alert = old
    return this
  }


  // ALERT DATA-API
  // ==============

  $(document).on('click.bs.alert.data-api', dismiss, Alert.prototype.close)

}(jQuery);

/* ========================================================================
 * Bootstrap: button.js v3.3.5
 * http://getbootstrap.com/javascript/#buttons
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // BUTTON PUBLIC CLASS DEFINITION
  // ==============================

  var Button = function (element, options) {
    this.$element  = $(element)
    this.options   = $.extend({}, Button.DEFAULTS, options)
    this.isLoading = false
  }

  Button.VERSION  = '3.3.5'

  Button.DEFAULTS = {
    loadingText: 'loading...'
  }

  Button.prototype.setState = function (state) {
    var d    = 'disabled'
    var $el  = this.$element
    var val  = $el.is('input') ? 'val' : 'html'
    var data = $el.data()

    state += 'Text'

    if (data.resetText == null) $el.data('resetText', $el[val]())

    // push to event loop to allow forms to submit
    setTimeout($.proxy(function () {
      $el[val](data[state] == null ? this.options[state] : data[state])

      if (state == 'loadingText') {
        this.isLoading = true
        $el.addClass(d).attr(d, d)
      } else if (this.isLoading) {
        this.isLoading = false
        $el.removeClass(d).removeAttr(d)
      }
    }, this), 0)
  }

  Button.prototype.toggle = function () {
    var changed = true
    var $parent = this.$element.closest('[data-toggle="buttons"]')

    if ($parent.length) {
      var $input = this.$element.find('input')
      if ($input.prop('type') == 'radio') {
        if ($input.prop('checked')) changed = false
        $parent.find('.active').removeClass('active')
        this.$element.addClass('active')
      } else if ($input.prop('type') == 'checkbox') {
        if (($input.prop('checked')) !== this.$element.hasClass('active')) changed = false
        this.$element.toggleClass('active')
      }
      $input.prop('checked', this.$element.hasClass('active'))
      if (changed) $input.trigger('change')
    } else {
      this.$element.attr('aria-pressed', !this.$element.hasClass('active'))
      this.$element.toggleClass('active')
    }
  }


  // BUTTON PLUGIN DEFINITION
  // ========================

  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.button')
      var options = typeof option == 'object' && option

      if (!data) $this.data('bs.button', (data = new Button(this, options)))

      if (option == 'toggle') data.toggle()
      else if (option) data.setState(option)
    })
  }

  var old = $.fn.button

  $.fn.button             = Plugin
  $.fn.button.Constructor = Button


  // BUTTON NO CONFLICT
  // ==================

  $.fn.button.noConflict = function () {
    $.fn.button = old
    return this
  }


  // BUTTON DATA-API
  // ===============

  $(document)
    .on('click.bs.button.data-api', '[data-toggle^="button"]', function (e) {
      var $btn = $(e.target)
      if (!$btn.hasClass('btn')) $btn = $btn.closest('.btn')
      Plugin.call($btn, 'toggle')
      if (!($(e.target).is('input[type="radio"]') || $(e.target).is('input[type="checkbox"]'))) e.preventDefault()
    })
    .on('focus.bs.button.data-api blur.bs.button.data-api', '[data-toggle^="button"]', function (e) {
      $(e.target).closest('.btn').toggleClass('focus', /^focus(in)?$/.test(e.type))
    })

}(jQuery);

/* ========================================================================
 * Bootstrap: carousel.js v3.3.5
 * http://getbootstrap.com/javascript/#carousel
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // CAROUSEL CLASS DEFINITION
  // =========================

  var Carousel = function (element, options) {
    this.$element    = $(element)
    this.$indicators = this.$element.find('.carousel-indicators')
    this.options     = options
    this.paused      = null
    this.sliding     = null
    this.interval    = null
    this.$active     = null
    this.$items      = null

    this.options.keyboard && this.$element.on('keydown.bs.carousel', $.proxy(this.keydown, this))

    this.options.pause == 'hover' && !('ontouchstart' in document.documentElement) && this.$element
      .on('mouseenter.bs.carousel', $.proxy(this.pause, this))
      .on('mouseleave.bs.carousel', $.proxy(this.cycle, this))
  }

  Carousel.VERSION  = '3.3.5'

  Carousel.TRANSITION_DURATION = 600

  Carousel.DEFAULTS = {
    interval: 5000,
    pause: 'hover',
    wrap: true,
    keyboard: true
  }

  Carousel.prototype.keydown = function (e) {
    if (/input|textarea/i.test(e.target.tagName)) return
    switch (e.which) {
      case 37: this.prev(); break
      case 39: this.next(); break
      default: return
    }

    e.preventDefault()
  }

  Carousel.prototype.cycle = function (e) {
    e || (this.paused = false)

    this.interval && clearInterval(this.interval)

    this.options.interval
      && !this.paused
      && (this.interval = setInterval($.proxy(this.next, this), this.options.interval))

    return this
  }

  Carousel.prototype.getItemIndex = function (item) {
    this.$items = item.parent().children('.item')
    return this.$items.index(item || this.$active)
  }

  Carousel.prototype.getItemForDirection = function (direction, active) {
    var activeIndex = this.getItemIndex(active)
    var willWrap = (direction == 'prev' && activeIndex === 0)
                || (direction == 'next' && activeIndex == (this.$items.length - 1))
    if (willWrap && !this.options.wrap) return active
    var delta = direction == 'prev' ? -1 : 1
    var itemIndex = (activeIndex + delta) % this.$items.length
    return this.$items.eq(itemIndex)
  }

  Carousel.prototype.to = function (pos) {
    var that        = this
    var activeIndex = this.getItemIndex(this.$active = this.$element.find('.item.active'))

    if (pos > (this.$items.length - 1) || pos < 0) return

    if (this.sliding)       return this.$element.one('slid.bs.carousel', function () { that.to(pos) }) // yes, "slid"
    if (activeIndex == pos) return this.pause().cycle()

    return this.slide(pos > activeIndex ? 'next' : 'prev', this.$items.eq(pos))
  }

  Carousel.prototype.pause = function (e) {
    e || (this.paused = true)

    if (this.$element.find('.next, .prev').length && $.support.transition) {
      this.$element.trigger($.support.transition.end)
      this.cycle(true)
    }

    this.interval = clearInterval(this.interval)

    return this
  }

  Carousel.prototype.next = function () {
    if (this.sliding) return
    return this.slide('next')
  }

  Carousel.prototype.prev = function () {
    if (this.sliding) return
    return this.slide('prev')
  }

  Carousel.prototype.slide = function (type, next) {
    var $active   = this.$element.find('.item.active')
    var $next     = next || this.getItemForDirection(type, $active)
    var isCycling = this.interval
    var direction = type == 'next' ? 'left' : 'right'
    var that      = this

    if ($next.hasClass('active')) return (this.sliding = false)

    var relatedTarget = $next[0]
    var slideEvent = $.Event('slide.bs.carousel', {
      relatedTarget: relatedTarget,
      direction: direction
    })
    this.$element.trigger(slideEvent)
    if (slideEvent.isDefaultPrevented()) return

    this.sliding = true

    isCycling && this.pause()

    if (this.$indicators.length) {
      this.$indicators.find('.active').removeClass('active')
      var $nextIndicator = $(this.$indicators.children()[this.getItemIndex($next)])
      $nextIndicator && $nextIndicator.addClass('active')
    }

    var slidEvent = $.Event('slid.bs.carousel', { relatedTarget: relatedTarget, direction: direction }) // yes, "slid"
    if ($.support.transition && this.$element.hasClass('slide')) {
      $next.addClass(type)
      $next[0].offsetWidth // force reflow
      $active.addClass(direction)
      $next.addClass(direction)
      $active
        .one('bsTransitionEnd', function () {
          $next.removeClass([type, direction].join(' ')).addClass('active')
          $active.removeClass(['active', direction].join(' '))
          that.sliding = false
          setTimeout(function () {
            that.$element.trigger(slidEvent)
          }, 0)
        })
        .emulateTransitionEnd(Carousel.TRANSITION_DURATION)
    } else {
      $active.removeClass('active')
      $next.addClass('active')
      this.sliding = false
      this.$element.trigger(slidEvent)
    }

    isCycling && this.cycle()

    return this
  }


  // CAROUSEL PLUGIN DEFINITION
  // ==========================

  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.carousel')
      var options = $.extend({}, Carousel.DEFAULTS, $this.data(), typeof option == 'object' && option)
      var action  = typeof option == 'string' ? option : options.slide

      if (!data) $this.data('bs.carousel', (data = new Carousel(this, options)))
      if (typeof option == 'number') data.to(option)
      else if (action) data[action]()
      else if (options.interval) data.pause().cycle()
    })
  }

  var old = $.fn.carousel

  $.fn.carousel             = Plugin
  $.fn.carousel.Constructor = Carousel


  // CAROUSEL NO CONFLICT
  // ====================

  $.fn.carousel.noConflict = function () {
    $.fn.carousel = old
    return this
  }


  // CAROUSEL DATA-API
  // =================

  var clickHandler = function (e) {
    var href
    var $this   = $(this)
    var $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')) // strip for ie7
    if (!$target.hasClass('carousel')) return
    var options = $.extend({}, $target.data(), $this.data())
    var slideIndex = $this.attr('data-slide-to')
    if (slideIndex) options.interval = false

    Plugin.call($target, options)

    if (slideIndex) {
      $target.data('bs.carousel').to(slideIndex)
    }

    e.preventDefault()
  }

  $(document)
    .on('click.bs.carousel.data-api', '[data-slide]', clickHandler)
    .on('click.bs.carousel.data-api', '[data-slide-to]', clickHandler)

  $(window).on('load', function () {
    $('[data-ride="carousel"]').each(function () {
      var $carousel = $(this)
      Plugin.call($carousel, $carousel.data())
    })
  })

}(jQuery);

/* ========================================================================
 * Bootstrap: collapse.js v3.3.5
 * http://getbootstrap.com/javascript/#collapse
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // COLLAPSE PUBLIC CLASS DEFINITION
  // ================================

  var Collapse = function (element, options) {
    this.$element      = $(element)
    this.options       = $.extend({}, Collapse.DEFAULTS, options)
    this.$trigger      = $('[data-toggle="collapse"][href="#' + element.id + '"],' +
                           '[data-toggle="collapse"][data-target="#' + element.id + '"]')
    this.transitioning = null

    if (this.options.parent) {
      this.$parent = this.getParent()
    } else {
      this.addAriaAndCollapsedClass(this.$element, this.$trigger)
    }

    if (this.options.toggle) this.toggle()
  }

  Collapse.VERSION  = '3.3.5'

  Collapse.TRANSITION_DURATION = 350

  Collapse.DEFAULTS = {
    toggle: true
  }

  Collapse.prototype.dimension = function () {
    var hasWidth = this.$element.hasClass('width')
    return hasWidth ? 'width' : 'height'
  }

  Collapse.prototype.show = function () {
    if (this.transitioning || this.$element.hasClass('in')) return

    var activesData
    var actives = this.$parent && this.$parent.children('.panel').children('.in, .collapsing')

    if (actives && actives.length) {
      activesData = actives.data('bs.collapse')
      if (activesData && activesData.transitioning) return
    }

    var startEvent = $.Event('show.bs.collapse')
    this.$element.trigger(startEvent)
    if (startEvent.isDefaultPrevented()) return

    if (actives && actives.length) {
      Plugin.call(actives, 'hide')
      activesData || actives.data('bs.collapse', null)
    }

    var dimension = this.dimension()

    this.$element
      .removeClass('collapse')
      .addClass('collapsing')[dimension](0)
      .attr('aria-expanded', true)

    this.$trigger
      .removeClass('collapsed')
      .attr('aria-expanded', true)

    this.transitioning = 1

    var complete = function () {
      this.$element
        .removeClass('collapsing')
        .addClass('collapse in')[dimension]('')
      this.transitioning = 0
      this.$element
        .trigger('shown.bs.collapse')
    }

    if (!$.support.transition) return complete.call(this)

    var scrollSize = $.camelCase(['scroll', dimension].join('-'))

    this.$element
      .one('bsTransitionEnd', $.proxy(complete, this))
      .emulateTransitionEnd(Collapse.TRANSITION_DURATION)[dimension](this.$element[0][scrollSize])
  }

  Collapse.prototype.hide = function () {
    if (this.transitioning || !this.$element.hasClass('in')) return

    var startEvent = $.Event('hide.bs.collapse')
    this.$element.trigger(startEvent)
    if (startEvent.isDefaultPrevented()) return

    var dimension = this.dimension()

    this.$element[dimension](this.$element[dimension]())[0].offsetHeight

    this.$element
      .addClass('collapsing')
      .removeClass('collapse in')
      .attr('aria-expanded', false)

    this.$trigger
      .addClass('collapsed')
      .attr('aria-expanded', false)

    this.transitioning = 1

    var complete = function () {
      this.transitioning = 0
      this.$element
        .removeClass('collapsing')
        .addClass('collapse')
        .trigger('hidden.bs.collapse')
    }

    if (!$.support.transition) return complete.call(this)

    this.$element
      [dimension](0)
      .one('bsTransitionEnd', $.proxy(complete, this))
      .emulateTransitionEnd(Collapse.TRANSITION_DURATION)
  }

  Collapse.prototype.toggle = function () {
    this[this.$element.hasClass('in') ? 'hide' : 'show']()
  }

  Collapse.prototype.getParent = function () {
    return $(this.options.parent)
      .find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]')
      .each($.proxy(function (i, element) {
        var $element = $(element)
        this.addAriaAndCollapsedClass(getTargetFromTrigger($element), $element)
      }, this))
      .end()
  }

  Collapse.prototype.addAriaAndCollapsedClass = function ($element, $trigger) {
    var isOpen = $element.hasClass('in')

    $element.attr('aria-expanded', isOpen)
    $trigger
      .toggleClass('collapsed', !isOpen)
      .attr('aria-expanded', isOpen)
  }

  function getTargetFromTrigger($trigger) {
    var href
    var target = $trigger.attr('data-target')
      || (href = $trigger.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') // strip for ie7

    return $(target)
  }


  // COLLAPSE PLUGIN DEFINITION
  // ==========================

  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.collapse')
      var options = $.extend({}, Collapse.DEFAULTS, $this.data(), typeof option == 'object' && option)

      if (!data && options.toggle && /show|hide/.test(option)) options.toggle = false
      if (!data) $this.data('bs.collapse', (data = new Collapse(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.collapse

  $.fn.collapse             = Plugin
  $.fn.collapse.Constructor = Collapse


  // COLLAPSE NO CONFLICT
  // ====================

  $.fn.collapse.noConflict = function () {
    $.fn.collapse = old
    return this
  }


  // COLLAPSE DATA-API
  // =================

  $(document).on('click.bs.collapse.data-api', '[data-toggle="collapse"]', function (e) {
    var $this   = $(this)

    if (!$this.attr('data-target')) e.preventDefault()

    var $target = getTargetFromTrigger($this)
    var data    = $target.data('bs.collapse')
    var option  = data ? 'toggle' : $this.data()

    Plugin.call($target, option)
  })

}(jQuery);

/* ========================================================================
 * Bootstrap: dropdown.js v3.3.5
 * http://getbootstrap.com/javascript/#dropdowns
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // DROPDOWN CLASS DEFINITION
  // =========================

  var backdrop = '.dropdown-backdrop'
  var toggle   = '[data-toggle="dropdown"]'
  var Dropdown = function (element) {
    $(element).on('click.bs.dropdown', this.toggle)
  }

  Dropdown.VERSION = '3.3.5'

  function getParent($this) {
    var selector = $this.attr('data-target')

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && /#[A-Za-z]/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
    }

    var $parent = selector && $(selector)

    return $parent && $parent.length ? $parent : $this.parent()
  }

  function clearMenus(e) {
    if (e && e.which === 3) return
    $(backdrop).remove()
    $(toggle).each(function () {
      var $this         = $(this)
      var $parent       = getParent($this)
      var relatedTarget = { relatedTarget: this }

      if (!$parent.hasClass('open')) return

      if (e && e.type == 'click' && /input|textarea/i.test(e.target.tagName) && $.contains($parent[0], e.target)) return

      $parent.trigger(e = $.Event('hide.bs.dropdown', relatedTarget))

      if (e.isDefaultPrevented()) return

      $this.attr('aria-expanded', 'false')
      $parent.removeClass('open').trigger('hidden.bs.dropdown', relatedTarget)
    })
  }

  Dropdown.prototype.toggle = function (e) {
    var $this = $(this)

    if ($this.is('.disabled, :disabled')) return

    var $parent  = getParent($this)
    var isActive = $parent.hasClass('open')

    clearMenus()

    if (!isActive) {
      if ('ontouchstart' in document.documentElement && !$parent.closest('.navbar-nav').length) {
        // if mobile we use a backdrop because click events don't delegate
        $(document.createElement('div'))
          .addClass('dropdown-backdrop')
          .insertAfter($(this))
          .on('click', clearMenus)
      }

      var relatedTarget = { relatedTarget: this }
      $parent.trigger(e = $.Event('show.bs.dropdown', relatedTarget))

      if (e.isDefaultPrevented()) return

      $this
        .trigger('focus')
        .attr('aria-expanded', 'true')

      $parent
        .toggleClass('open')
        .trigger('shown.bs.dropdown', relatedTarget)
    }

    return false
  }

  Dropdown.prototype.keydown = function (e) {
    if (!/(38|40|27|32)/.test(e.which) || /input|textarea/i.test(e.target.tagName)) return

    var $this = $(this)

    e.preventDefault()
    e.stopPropagation()

    if ($this.is('.disabled, :disabled')) return

    var $parent  = getParent($this)
    var isActive = $parent.hasClass('open')

    if (!isActive && e.which != 27 || isActive && e.which == 27) {
      if (e.which == 27) $parent.find(toggle).trigger('focus')
      return $this.trigger('click')
    }

    var desc = ' li:not(.disabled):visible a'
    var $items = $parent.find('.dropdown-menu' + desc)

    if (!$items.length) return

    var index = $items.index(e.target)

    if (e.which == 38 && index > 0)                 index--         // up
    if (e.which == 40 && index < $items.length - 1) index++         // down
    if (!~index)                                    index = 0

    $items.eq(index).trigger('focus')
  }


  // DROPDOWN PLUGIN DEFINITION
  // ==========================

  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data('bs.dropdown')

      if (!data) $this.data('bs.dropdown', (data = new Dropdown(this)))
      if (typeof option == 'string') data[option].call($this)
    })
  }

  var old = $.fn.dropdown

  $.fn.dropdown             = Plugin
  $.fn.dropdown.Constructor = Dropdown


  // DROPDOWN NO CONFLICT
  // ====================

  $.fn.dropdown.noConflict = function () {
    $.fn.dropdown = old
    return this
  }


  // APPLY TO STANDARD DROPDOWN ELEMENTS
  // ===================================

  $(document)
    .on('click.bs.dropdown.data-api', clearMenus)
    .on('click.bs.dropdown.data-api', '.dropdown form', function (e) { e.stopPropagation() })
    .on('click.bs.dropdown.data-api', toggle, Dropdown.prototype.toggle)
    .on('keydown.bs.dropdown.data-api', toggle, Dropdown.prototype.keydown)
    .on('keydown.bs.dropdown.data-api', '.dropdown-menu', Dropdown.prototype.keydown)

}(jQuery);

/* ========================================================================
 * Bootstrap: modal.js v3.3.5
 * http://getbootstrap.com/javascript/#modals
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // MODAL CLASS DEFINITION
  // ======================

  var Modal = function (element, options) {
    this.options             = options
    this.$body               = $(document.body)
    this.$element            = $(element)
    this.$dialog             = this.$element.find('.modal-dialog')
    this.$backdrop           = null
    this.isShown             = null
    this.originalBodyPad     = null
    this.scrollbarWidth      = 0
    this.ignoreBackdropClick = false

    if (this.options.remote) {
      this.$element
        .find('.modal-content')
        .load(this.options.remote, $.proxy(function () {
          this.$element.trigger('loaded.bs.modal')
        }, this))
    }
  }

  Modal.VERSION  = '3.3.5'

  Modal.TRANSITION_DURATION = 300
  Modal.BACKDROP_TRANSITION_DURATION = 150

  Modal.DEFAULTS = {
    backdrop: true,
    keyboard: true,
    show: true
  }

  Modal.prototype.toggle = function (_relatedTarget) {
    return this.isShown ? this.hide() : this.show(_relatedTarget)
  }

  Modal.prototype.show = function (_relatedTarget) {
    var that = this
    var e    = $.Event('show.bs.modal', { relatedTarget: _relatedTarget })

    this.$element.trigger(e)

    if (this.isShown || e.isDefaultPrevented()) return

    this.isShown = true

    this.checkScrollbar()
    this.setScrollbar()
    this.$body.addClass('modal-open')

    this.escape()
    this.resize()

    this.$element.on('click.dismiss.bs.modal', '[data-dismiss="modal"]', $.proxy(this.hide, this))

    this.$dialog.on('mousedown.dismiss.bs.modal', function () {
      that.$element.one('mouseup.dismiss.bs.modal', function (e) {
        if ($(e.target).is(that.$element)) that.ignoreBackdropClick = true
      })
    })

    this.backdrop(function () {
      var transition = $.support.transition && that.$element.hasClass('fade')

      if (!that.$element.parent().length) {
        that.$element.appendTo(that.$body) // don't move modals dom position
      }

      that.$element
        .show()
        .scrollTop(0)

      that.adjustDialog()

      if (transition) {
        that.$element[0].offsetWidth // force reflow
      }

      that.$element.addClass('in')

      that.enforceFocus()

      var e = $.Event('shown.bs.modal', { relatedTarget: _relatedTarget })

      transition ?
        that.$dialog // wait for modal to slide in
          .one('bsTransitionEnd', function () {
            that.$element.trigger('focus').trigger(e)
          })
          .emulateTransitionEnd(Modal.TRANSITION_DURATION) :
        that.$element.trigger('focus').trigger(e)
    })
  }

  Modal.prototype.hide = function (e) {
    if (e) e.preventDefault()

    e = $.Event('hide.bs.modal')

    this.$element.trigger(e)

    if (!this.isShown || e.isDefaultPrevented()) return

    this.isShown = false

    this.escape()
    this.resize()

    $(document).off('focusin.bs.modal')

    this.$element
      .removeClass('in')
      .off('click.dismiss.bs.modal')
      .off('mouseup.dismiss.bs.modal')

    this.$dialog.off('mousedown.dismiss.bs.modal')

    $.support.transition && this.$element.hasClass('fade') ?
      this.$element
        .one('bsTransitionEnd', $.proxy(this.hideModal, this))
        .emulateTransitionEnd(Modal.TRANSITION_DURATION) :
      this.hideModal()
  }

  Modal.prototype.enforceFocus = function () {
    $(document)
      .off('focusin.bs.modal') // guard against infinite focus loop
      .on('focusin.bs.modal', $.proxy(function (e) {
        if (this.$element[0] !== e.target && !this.$element.has(e.target).length) {
          this.$element.trigger('focus')
        }
      }, this))
  }

  Modal.prototype.escape = function () {
    if (this.isShown && this.options.keyboard) {
      this.$element.on('keydown.dismiss.bs.modal', $.proxy(function (e) {
        e.which == 27 && this.hide()
      }, this))
    } else if (!this.isShown) {
      this.$element.off('keydown.dismiss.bs.modal')
    }
  }

  Modal.prototype.resize = function () {
    if (this.isShown) {
      $(window).on('resize.bs.modal', $.proxy(this.handleUpdate, this))
    } else {
      $(window).off('resize.bs.modal')
    }
  }

  Modal.prototype.hideModal = function () {
    var that = this
    this.$element.hide()
    this.backdrop(function () {
      that.$body.removeClass('modal-open')
      that.resetAdjustments()
      that.resetScrollbar()
      that.$element.trigger('hidden.bs.modal')
    })
  }

  Modal.prototype.removeBackdrop = function () {
    this.$backdrop && this.$backdrop.remove()
    this.$backdrop = null
  }

  Modal.prototype.backdrop = function (callback) {
    var that = this
    var animate = this.$element.hasClass('fade') ? 'fade' : ''

    if (this.isShown && this.options.backdrop) {
      var doAnimate = $.support.transition && animate

      this.$backdrop = $(document.createElement('div'))
        .addClass('modal-backdrop ' + animate)
        .appendTo(this.$body)

      this.$element.on('click.dismiss.bs.modal', $.proxy(function (e) {
        if (this.ignoreBackdropClick) {
          this.ignoreBackdropClick = false
          return
        }
        if (e.target !== e.currentTarget) return
        this.options.backdrop == 'static'
          ? this.$element[0].focus()
          : this.hide()
      }, this))

      if (doAnimate) this.$backdrop[0].offsetWidth // force reflow

      this.$backdrop.addClass('in')

      if (!callback) return

      doAnimate ?
        this.$backdrop
          .one('bsTransitionEnd', callback)
          .emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) :
        callback()

    } else if (!this.isShown && this.$backdrop) {
      this.$backdrop.removeClass('in')

      var callbackRemove = function () {
        that.removeBackdrop()
        callback && callback()
      }
      $.support.transition && this.$element.hasClass('fade') ?
        this.$backdrop
          .one('bsTransitionEnd', callbackRemove)
          .emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) :
        callbackRemove()

    } else if (callback) {
      callback()
    }
  }

  // these following methods are used to handle overflowing modals

  Modal.prototype.handleUpdate = function () {
    this.adjustDialog()
  }

  Modal.prototype.adjustDialog = function () {
    var modalIsOverflowing = this.$element[0].scrollHeight > document.documentElement.clientHeight

    this.$element.css({
      paddingLeft:  !this.bodyIsOverflowing && modalIsOverflowing ? this.scrollbarWidth : '',
      paddingRight: this.bodyIsOverflowing && !modalIsOverflowing ? this.scrollbarWidth : ''
    })
  }

  Modal.prototype.resetAdjustments = function () {
    this.$element.css({
      paddingLeft: '',
      paddingRight: ''
    })
  }

  Modal.prototype.checkScrollbar = function () {
    var fullWindowWidth = window.innerWidth
    if (!fullWindowWidth) { // workaround for missing window.innerWidth in IE8
      var documentElementRect = document.documentElement.getBoundingClientRect()
      fullWindowWidth = documentElementRect.right - Math.abs(documentElementRect.left)
    }
    this.bodyIsOverflowing = document.body.clientWidth < fullWindowWidth
    this.scrollbarWidth = this.measureScrollbar()
  }

  Modal.prototype.setScrollbar = function () {
    var bodyPad = parseInt((this.$body.css('padding-right') || 0), 10)
    this.originalBodyPad = document.body.style.paddingRight || ''
    if (this.bodyIsOverflowing) this.$body.css('padding-right', bodyPad + this.scrollbarWidth)
  }

  Modal.prototype.resetScrollbar = function () {
    this.$body.css('padding-right', this.originalBodyPad)
  }

  Modal.prototype.measureScrollbar = function () { // thx walsh
    var scrollDiv = document.createElement('div')
    scrollDiv.className = 'modal-scrollbar-measure'
    this.$body.append(scrollDiv)
    var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth
    this.$body[0].removeChild(scrollDiv)
    return scrollbarWidth
  }


  // MODAL PLUGIN DEFINITION
  // =======================

  function Plugin(option, _relatedTarget) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.modal')
      var options = $.extend({}, Modal.DEFAULTS, $this.data(), typeof option == 'object' && option)

      if (!data) $this.data('bs.modal', (data = new Modal(this, options)))
      if (typeof option == 'string') data[option](_relatedTarget)
      else if (options.show) data.show(_relatedTarget)
    })
  }

  var old = $.fn.modal

  $.fn.modal             = Plugin
  $.fn.modal.Constructor = Modal


  // MODAL NO CONFLICT
  // =================

  $.fn.modal.noConflict = function () {
    $.fn.modal = old
    return this
  }


  // MODAL DATA-API
  // ==============

  $(document).on('click.bs.modal.data-api', '[data-toggle="modal"]', function (e) {
    var $this   = $(this)
    var href    = $this.attr('href')
    var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))) // strip for ie7
    var option  = $target.data('bs.modal') ? 'toggle' : $.extend({ remote: !/#/.test(href) && href }, $target.data(), $this.data())

    if ($this.is('a')) e.preventDefault()

    $target.one('show.bs.modal', function (showEvent) {
      if (showEvent.isDefaultPrevented()) return // only register focus restorer if modal will actually get shown
      $target.one('hidden.bs.modal', function () {
        $this.is(':visible') && $this.trigger('focus')
      })
    })
    Plugin.call($target, option, this)
  })

}(jQuery);

/* ========================================================================
 * Bootstrap: tooltip.js v3.3.5
 * http://getbootstrap.com/javascript/#tooltip
 * Inspired by the original jQuery.tipsy by Jason Frame
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // TOOLTIP PUBLIC CLASS DEFINITION
  // ===============================

  var Tooltip = function (element, options) {
    this.type       = null
    this.options    = null
    this.enabled    = null
    this.timeout    = null
    this.hoverState = null
    this.$element   = null
    this.inState    = null

    this.init('tooltip', element, options)
  }

  Tooltip.VERSION  = '3.3.5'

  Tooltip.TRANSITION_DURATION = 150

  Tooltip.DEFAULTS = {
    animation: true,
    placement: 'top',
    selector: false,
    template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
    trigger: 'hover focus',
    title: '',
    delay: 0,
    html: false,
    container: false,
    viewport: {
      selector: 'body',
      padding: 0
    }
  }

  Tooltip.prototype.init = function (type, element, options) {
    this.enabled   = true
    this.type      = type
    this.$element  = $(element)
    this.options   = this.getOptions(options)
    this.$viewport = this.options.viewport && $($.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : (this.options.viewport.selector || this.options.viewport))
    this.inState   = { click: false, hover: false, focus: false }

    if (this.$element[0] instanceof document.constructor && !this.options.selector) {
      throw new Error('`selector` option must be specified when initializing ' + this.type + ' on the window.document object!')
    }

    var triggers = this.options.trigger.split(' ')

    for (var i = triggers.length; i--;) {
      var trigger = triggers[i]

      if (trigger == 'click') {
        this.$element.on('click.' + this.type, this.options.selector, $.proxy(this.toggle, this))
      } else if (trigger != 'manual') {
        var eventIn  = trigger == 'hover' ? 'mouseenter' : 'focusin'
        var eventOut = trigger == 'hover' ? 'mouseleave' : 'focusout'

        this.$element.on(eventIn  + '.' + this.type, this.options.selector, $.proxy(this.enter, this))
        this.$element.on(eventOut + '.' + this.type, this.options.selector, $.proxy(this.leave, this))
      }
    }

    this.options.selector ?
      (this._options = $.extend({}, this.options, { trigger: 'manual', selector: '' })) :
      this.fixTitle()
  }

  Tooltip.prototype.getDefaults = function () {
    return Tooltip.DEFAULTS
  }

  Tooltip.prototype.getOptions = function (options) {
    options = $.extend({}, this.getDefaults(), this.$element.data(), options)

    if (options.delay && typeof options.delay == 'number') {
      options.delay = {
        show: options.delay,
        hide: options.delay
      }
    }

    return options
  }

  Tooltip.prototype.getDelegateOptions = function () {
    var options  = {}
    var defaults = this.getDefaults()

    this._options && $.each(this._options, function (key, value) {
      if (defaults[key] != value) options[key] = value
    })

    return options
  }

  Tooltip.prototype.enter = function (obj) {
    var self = obj instanceof this.constructor ?
      obj : $(obj.currentTarget).data('bs.' + this.type)

    if (!self) {
      self = new this.constructor(obj.currentTarget, this.getDelegateOptions())
      $(obj.currentTarget).data('bs.' + this.type, self)
    }

    if (obj instanceof $.Event) {
      self.inState[obj.type == 'focusin' ? 'focus' : 'hover'] = true
    }

    if (self.tip().hasClass('in') || self.hoverState == 'in') {
      self.hoverState = 'in'
      return
    }

    clearTimeout(self.timeout)

    self.hoverState = 'in'

    if (!self.options.delay || !self.options.delay.show) return self.show()

    self.timeout = setTimeout(function () {
      if (self.hoverState == 'in') self.show()
    }, self.options.delay.show)
  }

  Tooltip.prototype.isInStateTrue = function () {
    for (var key in this.inState) {
      if (this.inState[key]) return true
    }

    return false
  }

  Tooltip.prototype.leave = function (obj) {
    var self = obj instanceof this.constructor ?
      obj : $(obj.currentTarget).data('bs.' + this.type)

    if (!self) {
      self = new this.constructor(obj.currentTarget, this.getDelegateOptions())
      $(obj.currentTarget).data('bs.' + this.type, self)
    }

    if (obj instanceof $.Event) {
      self.inState[obj.type == 'focusout' ? 'focus' : 'hover'] = false
    }

    if (self.isInStateTrue()) return

    clearTimeout(self.timeout)

    self.hoverState = 'out'

    if (!self.options.delay || !self.options.delay.hide) return self.hide()

    self.timeout = setTimeout(function () {
      if (self.hoverState == 'out') self.hide()
    }, self.options.delay.hide)
  }

  Tooltip.prototype.show = function () {
    var e = $.Event('show.bs.' + this.type)

    if (this.hasContent() && this.enabled) {
      this.$element.trigger(e)

      var inDom = $.contains(this.$element[0].ownerDocument.documentElement, this.$element[0])
      if (e.isDefaultPrevented() || !inDom) return
      var that = this

      var $tip = this.tip()

      var tipId = this.getUID(this.type)

      this.setContent()
      $tip.attr('id', tipId)
      this.$element.attr('aria-describedby', tipId)

      if (this.options.animation) $tip.addClass('fade')

      var placement = typeof this.options.placement == 'function' ?
        this.options.placement.call(this, $tip[0], this.$element[0]) :
        this.options.placement

      var autoToken = /\s?auto?\s?/i
      var autoPlace = autoToken.test(placement)
      if (autoPlace) placement = placement.replace(autoToken, '') || 'top'

      $tip
        .detach()
        .css({ top: 0, left: 0, display: 'block' })
        .addClass(placement)
        .data('bs.' + this.type, this)

      this.options.container ? $tip.appendTo(this.options.container) : $tip.insertAfter(this.$element)
      this.$element.trigger('inserted.bs.' + this.type)

      var pos          = this.getPosition()
      var actualWidth  = $tip[0].offsetWidth
      var actualHeight = $tip[0].offsetHeight

      if (autoPlace) {
        var orgPlacement = placement
        var viewportDim = this.getPosition(this.$viewport)

        placement = placement == 'bottom' && pos.bottom + actualHeight > viewportDim.bottom ? 'top'    :
                    placement == 'top'    && pos.top    - actualHeight < viewportDim.top    ? 'bottom' :
                    placement == 'right'  && pos.right  + actualWidth  > viewportDim.width  ? 'left'   :
                    placement == 'left'   && pos.left   - actualWidth  < viewportDim.left   ? 'right'  :
                    placement

        $tip
          .removeClass(orgPlacement)
          .addClass(placement)
      }

      var calculatedOffset = this.getCalculatedOffset(placement, pos, actualWidth, actualHeight)

      this.applyPlacement(calculatedOffset, placement)

      var complete = function () {
        var prevHoverState = that.hoverState
        that.$element.trigger('shown.bs.' + that.type)
        that.hoverState = null

        if (prevHoverState == 'out') that.leave(that)
      }

      $.support.transition && this.$tip.hasClass('fade') ?
        $tip
          .one('bsTransitionEnd', complete)
          .emulateTransitionEnd(Tooltip.TRANSITION_DURATION) :
        complete()
    }
  }

  Tooltip.prototype.applyPlacement = function (offset, placement) {
    var $tip   = this.tip()
    var width  = $tip[0].offsetWidth
    var height = $tip[0].offsetHeight

    // manually read margins because getBoundingClientRect includes difference
    var marginTop = parseInt($tip.css('margin-top'), 10)
    var marginLeft = parseInt($tip.css('margin-left'), 10)

    // we must check for NaN for ie 8/9
    if (isNaN(marginTop))  marginTop  = 0
    if (isNaN(marginLeft)) marginLeft = 0

    offset.top  += marginTop
    offset.left += marginLeft

    // $.fn.offset doesn't round pixel values
    // so we use setOffset directly with our own function B-0
    $.offset.setOffset($tip[0], $.extend({
      using: function (props) {
        $tip.css({
          top: Math.round(props.top),
          left: Math.round(props.left)
        })
      }
    }, offset), 0)

    $tip.addClass('in')

    // check to see if placing tip in new offset caused the tip to resize itself
    var actualWidth  = $tip[0].offsetWidth
    var actualHeight = $tip[0].offsetHeight

    if (placement == 'top' && actualHeight != height) {
      offset.top = offset.top + height - actualHeight
    }

    var delta = this.getViewportAdjustedDelta(placement, offset, actualWidth, actualHeight)

    if (delta.left) offset.left += delta.left
    else offset.top += delta.top

    var isVertical          = /top|bottom/.test(placement)
    var arrowDelta          = isVertical ? delta.left * 2 - width + actualWidth : delta.top * 2 - height + actualHeight
    var arrowOffsetPosition = isVertical ? 'offsetWidth' : 'offsetHeight'

    $tip.offset(offset)
    this.replaceArrow(arrowDelta, $tip[0][arrowOffsetPosition], isVertical)
  }

  Tooltip.prototype.replaceArrow = function (delta, dimension, isVertical) {
    this.arrow()
      .css(isVertical ? 'left' : 'top', 50 * (1 - delta / dimension) + '%')
      .css(isVertical ? 'top' : 'left', '')
  }

  Tooltip.prototype.setContent = function () {
    var $tip  = this.tip()
    var title = this.getTitle()

    $tip.find('.tooltip-inner')[this.options.html ? 'html' : 'text'](title)
    $tip.removeClass('fade in top bottom left right')
  }

  Tooltip.prototype.hide = function (callback) {
    var that = this
    var $tip = $(this.$tip)
    var e    = $.Event('hide.bs.' + this.type)

    function complete() {
      if (that.hoverState != 'in') $tip.detach()
      that.$element
        .removeAttr('aria-describedby')
        .trigger('hidden.bs.' + that.type)
      callback && callback()
    }

    this.$element.trigger(e)

    if (e.isDefaultPrevented()) return

    $tip.removeClass('in')

    $.support.transition && $tip.hasClass('fade') ?
      $tip
        .one('bsTransitionEnd', complete)
        .emulateTransitionEnd(Tooltip.TRANSITION_DURATION) :
      complete()

    this.hoverState = null

    return this
  }

  Tooltip.prototype.fixTitle = function () {
    var $e = this.$element
    if ($e.attr('title') || typeof $e.attr('data-original-title') != 'string') {
      $e.attr('data-original-title', $e.attr('title') || '').attr('title', '')
    }
  }

  Tooltip.prototype.hasContent = function () {
    return this.getTitle()
  }

  Tooltip.prototype.getPosition = function ($element) {
    $element   = $element || this.$element

    var el     = $element[0]
    var isBody = el.tagName == 'BODY'

    var elRect    = el.getBoundingClientRect()
    if (elRect.width == null) {
      // width and height are missing in IE8, so compute them manually; see https://github.com/twbs/bootstrap/issues/14093
      elRect = $.extend({}, elRect, { width: elRect.right - elRect.left, height: elRect.bottom - elRect.top })
    }
    var elOffset  = isBody ? { top: 0, left: 0 } : $element.offset()
    var scroll    = { scroll: isBody ? document.documentElement.scrollTop || document.body.scrollTop : $element.scrollTop() }
    var outerDims = isBody ? { width: $(window).width(), height: $(window).height() } : null

    return $.extend({}, elRect, scroll, outerDims, elOffset)
  }

  Tooltip.prototype.getCalculatedOffset = function (placement, pos, actualWidth, actualHeight) {
    return placement == 'bottom' ? { top: pos.top + pos.height,   left: pos.left + pos.width / 2 - actualWidth / 2 } :
           placement == 'top'    ? { top: pos.top - actualHeight, left: pos.left + pos.width / 2 - actualWidth / 2 } :
           placement == 'left'   ? { top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth } :
        /* placement == 'right' */ { top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width }

  }

  Tooltip.prototype.getViewportAdjustedDelta = function (placement, pos, actualWidth, actualHeight) {
    var delta = { top: 0, left: 0 }
    if (!this.$viewport) return delta

    var viewportPadding = this.options.viewport && this.options.viewport.padding || 0
    var viewportDimensions = this.getPosition(this.$viewport)

    if (/right|left/.test(placement)) {
      var topEdgeOffset    = pos.top - viewportPadding - viewportDimensions.scroll
      var bottomEdgeOffset = pos.top + viewportPadding - viewportDimensions.scroll + actualHeight
      if (topEdgeOffset < viewportDimensions.top) { // top overflow
        delta.top = viewportDimensions.top - topEdgeOffset
      } else if (bottomEdgeOffset > viewportDimensions.top + viewportDimensions.height) { // bottom overflow
        delta.top = viewportDimensions.top + viewportDimensions.height - bottomEdgeOffset
      }
    } else {
      var leftEdgeOffset  = pos.left - viewportPadding
      var rightEdgeOffset = pos.left + viewportPadding + actualWidth
      if (leftEdgeOffset < viewportDimensions.left) { // left overflow
        delta.left = viewportDimensions.left - leftEdgeOffset
      } else if (rightEdgeOffset > viewportDimensions.right) { // right overflow
        delta.left = viewportDimensions.left + viewportDimensions.width - rightEdgeOffset
      }
    }

    return delta
  }

  Tooltip.prototype.getTitle = function () {
    var title
    var $e = this.$element
    var o  = this.options

    title = $e.attr('data-original-title')
      || (typeof o.title == 'function' ? o.title.call($e[0]) :  o.title)

    return title
  }

  Tooltip.prototype.getUID = function (prefix) {
    do prefix += ~~(Math.random() * 1000000)
    while (document.getElementById(prefix))
    return prefix
  }

  Tooltip.prototype.tip = function () {
    if (!this.$tip) {
      this.$tip = $(this.options.template)
      if (this.$tip.length != 1) {
        throw new Error(this.type + ' `template` option must consist of exactly 1 top-level element!')
      }
    }
    return this.$tip
  }

  Tooltip.prototype.arrow = function () {
    return (this.$arrow = this.$arrow || this.tip().find('.tooltip-arrow'))
  }

  Tooltip.prototype.enable = function () {
    this.enabled = true
  }

  Tooltip.prototype.disable = function () {
    this.enabled = false
  }

  Tooltip.prototype.toggleEnabled = function () {
    this.enabled = !this.enabled
  }

  Tooltip.prototype.toggle = function (e) {
    var self = this
    if (e) {
      self = $(e.currentTarget).data('bs.' + this.type)
      if (!self) {
        self = new this.constructor(e.currentTarget, this.getDelegateOptions())
        $(e.currentTarget).data('bs.' + this.type, self)
      }
    }

    if (e) {
      self.inState.click = !self.inState.click
      if (self.isInStateTrue()) self.enter(self)
      else self.leave(self)
    } else {
      self.tip().hasClass('in') ? self.leave(self) : self.enter(self)
    }
  }

  Tooltip.prototype.destroy = function () {
    var that = this
    clearTimeout(this.timeout)
    this.hide(function () {
      that.$element.off('.' + that.type).removeData('bs.' + that.type)
      if (that.$tip) {
        that.$tip.detach()
      }
      that.$tip = null
      that.$arrow = null
      that.$viewport = null
    })
  }


  // TOOLTIP PLUGIN DEFINITION
  // =========================

  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.tooltip')
      var options = typeof option == 'object' && option

      if (!data && /destroy|hide/.test(option)) return
      if (!data) $this.data('bs.tooltip', (data = new Tooltip(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.tooltip

  $.fn.tooltip             = Plugin
  $.fn.tooltip.Constructor = Tooltip


  // TOOLTIP NO CONFLICT
  // ===================

  $.fn.tooltip.noConflict = function () {
    $.fn.tooltip = old
    return this
  }

}(jQuery);

/* ========================================================================
 * Bootstrap: popover.js v3.3.5
 * http://getbootstrap.com/javascript/#popovers
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // POPOVER PUBLIC CLASS DEFINITION
  // ===============================

  var Popover = function (element, options) {
    this.init('popover', element, options)
  }

  if (!$.fn.tooltip) throw new Error('Popover requires tooltip.js')

  Popover.VERSION  = '3.3.5'

  Popover.DEFAULTS = $.extend({}, $.fn.tooltip.Constructor.DEFAULTS, {
    placement: 'right',
    trigger: 'click',
    content: '',
    template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
  })


  // NOTE: POPOVER EXTENDS tooltip.js
  // ================================

  Popover.prototype = $.extend({}, $.fn.tooltip.Constructor.prototype)

  Popover.prototype.constructor = Popover

  Popover.prototype.getDefaults = function () {
    return Popover.DEFAULTS
  }

  Popover.prototype.setContent = function () {
    var $tip    = this.tip()
    var title   = this.getTitle()
    var content = this.getContent()

    $tip.find('.popover-title')[this.options.html ? 'html' : 'text'](title)
    $tip.find('.popover-content').children().detach().end()[ // we use append for html objects to maintain js events
      this.options.html ? (typeof content == 'string' ? 'html' : 'append') : 'text'
    ](content)

    $tip.removeClass('fade top bottom left right in')

    // IE8 doesn't accept hiding via the `:empty` pseudo selector, we have to do
    // this manually by checking the contents.
    if (!$tip.find('.popover-title').html()) $tip.find('.popover-title').hide()
  }

  Popover.prototype.hasContent = function () {
    return this.getTitle() || this.getContent()
  }

  Popover.prototype.getContent = function () {
    var $e = this.$element
    var o  = this.options

    return $e.attr('data-content')
      || (typeof o.content == 'function' ?
            o.content.call($e[0]) :
            o.content)
  }

  Popover.prototype.arrow = function () {
    return (this.$arrow = this.$arrow || this.tip().find('.arrow'))
  }


  // POPOVER PLUGIN DEFINITION
  // =========================

  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.popover')
      var options = typeof option == 'object' && option

      if (!data && /destroy|hide/.test(option)) return
      if (!data) $this.data('bs.popover', (data = new Popover(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.popover

  $.fn.popover             = Plugin
  $.fn.popover.Constructor = Popover


  // POPOVER NO CONFLICT
  // ===================

  $.fn.popover.noConflict = function () {
    $.fn.popover = old
    return this
  }

}(jQuery);

/* ========================================================================
 * Bootstrap: scrollspy.js v3.3.5
 * http://getbootstrap.com/javascript/#scrollspy
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // SCROLLSPY CLASS DEFINITION
  // ==========================

  function ScrollSpy(element, options) {
    this.$body          = $(document.body)
    this.$scrollElement = $(element).is(document.body) ? $(window) : $(element)
    this.options        = $.extend({}, ScrollSpy.DEFAULTS, options)
    this.selector       = (this.options.target || '') + ' .nav li > a'
    this.offsets        = []
    this.targets        = []
    this.activeTarget   = null
    this.scrollHeight   = 0

    this.$scrollElement.on('scroll.bs.scrollspy', $.proxy(this.process, this))
    this.refresh()
    this.process()
  }

  ScrollSpy.VERSION  = '3.3.5'

  ScrollSpy.DEFAULTS = {
    offset: 10
  }

  ScrollSpy.prototype.getScrollHeight = function () {
    return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
  }

  ScrollSpy.prototype.refresh = function () {
    var that          = this
    var offsetMethod  = 'offset'
    var offsetBase    = 0

    this.offsets      = []
    this.targets      = []
    this.scrollHeight = this.getScrollHeight()

    if (!$.isWindow(this.$scrollElement[0])) {
      offsetMethod = 'position'
      offsetBase   = this.$scrollElement.scrollTop()
    }

    this.$body
      .find(this.selector)
      .map(function () {
        var $el   = $(this)
        var href  = $el.data('target') || $el.attr('href')
        var $href = /^#./.test(href) && $(href)

        return ($href
          && $href.length
          && $href.is(':visible')
          && [[$href[offsetMethod]().top + offsetBase, href]]) || null
      })
      .sort(function (a, b) { return a[0] - b[0] })
      .each(function () {
        that.offsets.push(this[0])
        that.targets.push(this[1])
      })
  }

  ScrollSpy.prototype.process = function () {
    var scrollTop    = this.$scrollElement.scrollTop() + this.options.offset
    var scrollHeight = this.getScrollHeight()
    var maxScroll    = this.options.offset + scrollHeight - this.$scrollElement.height()
    var offsets      = this.offsets
    var targets      = this.targets
    var activeTarget = this.activeTarget
    var i

    if (this.scrollHeight != scrollHeight) {
      this.refresh()
    }

    if (scrollTop >= maxScroll) {
      return activeTarget != (i = targets[targets.length - 1]) && this.activate(i)
    }

    if (activeTarget && scrollTop < offsets[0]) {
      this.activeTarget = null
      return this.clear()
    }

    for (i = offsets.length; i--;) {
      activeTarget != targets[i]
        && scrollTop >= offsets[i]
        && (offsets[i + 1] === undefined || scrollTop < offsets[i + 1])
        && this.activate(targets[i])
    }
  }

  ScrollSpy.prototype.activate = function (target) {
    this.activeTarget = target

    this.clear()

    var selector = this.selector +
      '[data-target="' + target + '"],' +
      this.selector + '[href="' + target + '"]'

    var active = $(selector)
      .parents('li')
      .addClass('active')

    if (active.parent('.dropdown-menu').length) {
      active = active
        .closest('li.dropdown')
        .addClass('active')
    }

    active.trigger('activate.bs.scrollspy')
  }

  ScrollSpy.prototype.clear = function () {
    $(this.selector)
      .parentsUntil(this.options.target, '.active')
      .removeClass('active')
  }


  // SCROLLSPY PLUGIN DEFINITION
  // ===========================

  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.scrollspy')
      var options = typeof option == 'object' && option

      if (!data) $this.data('bs.scrollspy', (data = new ScrollSpy(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.scrollspy

  $.fn.scrollspy             = Plugin
  $.fn.scrollspy.Constructor = ScrollSpy


  // SCROLLSPY NO CONFLICT
  // =====================

  $.fn.scrollspy.noConflict = function () {
    $.fn.scrollspy = old
    return this
  }


  // SCROLLSPY DATA-API
  // ==================

  $(window).on('load.bs.scrollspy.data-api', function () {
    $('[data-spy="scroll"]').each(function () {
      var $spy = $(this)
      Plugin.call($spy, $spy.data())
    })
  })

}(jQuery);

/* ========================================================================
 * Bootstrap: tab.js v3.3.5
 * http://getbootstrap.com/javascript/#tabs
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // TAB CLASS DEFINITION
  // ====================

  var Tab = function (element) {
    // jscs:disable requireDollarBeforejQueryAssignment
    this.element = $(element)
    // jscs:enable requireDollarBeforejQueryAssignment
  }

  Tab.VERSION = '3.3.5'

  Tab.TRANSITION_DURATION = 150

  Tab.prototype.show = function () {
    var $this    = this.element
    var $ul      = $this.closest('ul:not(.dropdown-menu)')
    var selector = $this.data('target')

    if (!selector) {
      selector = $this.attr('href')
      selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
    }

    if ($this.parent('li').hasClass('active')) return

    var $previous = $ul.find('.active:last a')
    var hideEvent = $.Event('hide.bs.tab', {
      relatedTarget: $this[0]
    })
    var showEvent = $.Event('show.bs.tab', {
      relatedTarget: $previous[0]
    })

    $previous.trigger(hideEvent)
    $this.trigger(showEvent)

    if (showEvent.isDefaultPrevented() || hideEvent.isDefaultPrevented()) return

    var $target = $(selector)

    this.activate($this.closest('li'), $ul)
    this.activate($target, $target.parent(), function () {
      $previous.trigger({
        type: 'hidden.bs.tab',
        relatedTarget: $this[0]
      })
      $this.trigger({
        type: 'shown.bs.tab',
        relatedTarget: $previous[0]
      })
    })
  }

  Tab.prototype.activate = function (element, container, callback) {
    var $active    = container.find('> .active')
    var transition = callback
      && $.support.transition
      && ($active.length && $active.hasClass('fade') || !!container.find('> .fade').length)

    function next() {
      $active
        .removeClass('active')
        .find('> .dropdown-menu > .active')
          .removeClass('active')
        .end()
        .find('[data-toggle="tab"]')
          .attr('aria-expanded', false)

      element
        .addClass('active')
        .find('[data-toggle="tab"]')
          .attr('aria-expanded', true)

      if (transition) {
        element[0].offsetWidth // reflow for transition
        element.addClass('in')
      } else {
        element.removeClass('fade')
      }

      if (element.parent('.dropdown-menu').length) {
        element
          .closest('li.dropdown')
            .addClass('active')
          .end()
          .find('[data-toggle="tab"]')
            .attr('aria-expanded', true)
      }

      callback && callback()
    }

    $active.length && transition ?
      $active
        .one('bsTransitionEnd', next)
        .emulateTransitionEnd(Tab.TRANSITION_DURATION) :
      next()

    $active.removeClass('in')
  }


  // TAB PLUGIN DEFINITION
  // =====================

  function Plugin(option) {
    return this.each(function () {
      var $this = $(this)
      var data  = $this.data('bs.tab')

      if (!data) $this.data('bs.tab', (data = new Tab(this)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.tab

  $.fn.tab             = Plugin
  $.fn.tab.Constructor = Tab


  // TAB NO CONFLICT
  // ===============

  $.fn.tab.noConflict = function () {
    $.fn.tab = old
    return this
  }


  // TAB DATA-API
  // ============

  var clickHandler = function (e) {
    e.preventDefault()
    Plugin.call($(this), 'show')
  }

  $(document)
    .on('click.bs.tab.data-api', '[data-toggle="tab"]', clickHandler)
    .on('click.bs.tab.data-api', '[data-toggle="pill"]', clickHandler)

}(jQuery);

/* ========================================================================
 * Bootstrap: affix.js v3.3.5
 * http://getbootstrap.com/javascript/#affix
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
  'use strict';

  // AFFIX CLASS DEFINITION
  // ======================

  var Affix = function (element, options) {
    this.options = $.extend({}, Affix.DEFAULTS, options)

    this.$target = $(this.options.target)
      .on('scroll.bs.affix.data-api', $.proxy(this.checkPosition, this))
      .on('click.bs.affix.data-api',  $.proxy(this.checkPositionWithEventLoop, this))

    this.$element     = $(element)
    this.affixed      = null
    this.unpin        = null
    this.pinnedOffset = null

    this.checkPosition()
  }

  Affix.VERSION  = '3.3.5'

  Affix.RESET    = 'affix affix-top affix-bottom'

  Affix.DEFAULTS = {
    offset: 0,
    target: window
  }

  Affix.prototype.getState = function (scrollHeight, height, offsetTop, offsetBottom) {
    var scrollTop    = this.$target.scrollTop()
    var position     = this.$element.offset()
    var targetHeight = this.$target.height()

    if (offsetTop != null && this.affixed == 'top') return scrollTop < offsetTop ? 'top' : false

    if (this.affixed == 'bottom') {
      if (offsetTop != null) return (scrollTop + this.unpin <= position.top) ? false : 'bottom'
      return (scrollTop + targetHeight <= scrollHeight - offsetBottom) ? false : 'bottom'
    }

    var initializing   = this.affixed == null
    var colliderTop    = initializing ? scrollTop : position.top
    var colliderHeight = initializing ? targetHeight : height

    if (offsetTop != null && scrollTop <= offsetTop) return 'top'
    if (offsetBottom != null && (colliderTop + colliderHeight >= scrollHeight - offsetBottom)) return 'bottom'

    return false
  }

  Affix.prototype.getPinnedOffset = function () {
    if (this.pinnedOffset) return this.pinnedOffset
    this.$element.removeClass(Affix.RESET).addClass('affix')
    var scrollTop = this.$target.scrollTop()
    var position  = this.$element.offset()
    return (this.pinnedOffset = position.top - scrollTop)
  }

  Affix.prototype.checkPositionWithEventLoop = function () {
    setTimeout($.proxy(this.checkPosition, this), 1)
  }

  Affix.prototype.checkPosition = function () {
    if (!this.$element.is(':visible')) return

    var height       = this.$element.height()
    var offset       = this.options.offset
    var offsetTop    = offset.top
    var offsetBottom = offset.bottom
    var scrollHeight = Math.max($(document).height(), $(document.body).height())

    if (typeof offset != 'object')         offsetBottom = offsetTop = offset
    if (typeof offsetTop == 'function')    offsetTop    = offset.top(this.$element)
    if (typeof offsetBottom == 'function') offsetBottom = offset.bottom(this.$element)

    var affix = this.getState(scrollHeight, height, offsetTop, offsetBottom)

    if (this.affixed != affix) {
      if (this.unpin != null) this.$element.css('top', '')

      var affixType = 'affix' + (affix ? '-' + affix : '')
      var e         = $.Event(affixType + '.bs.affix')

      this.$element.trigger(e)

      if (e.isDefaultPrevented()) return

      this.affixed = affix
      this.unpin = affix == 'bottom' ? this.getPinnedOffset() : null

      this.$element
        .removeClass(Affix.RESET)
        .addClass(affixType)
        .trigger(affixType.replace('affix', 'affixed') + '.bs.affix')
    }

    if (affix == 'bottom') {
      this.$element.offset({
        top: scrollHeight - height - offsetBottom
      })
    }
  }


  // AFFIX PLUGIN DEFINITION
  // =======================

  function Plugin(option) {
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.affix')
      var options = typeof option == 'object' && option

      if (!data) $this.data('bs.affix', (data = new Affix(this, options)))
      if (typeof option == 'string') data[option]()
    })
  }

  var old = $.fn.affix

  $.fn.affix             = Plugin
  $.fn.affix.Constructor = Affix


  // AFFIX NO CONFLICT
  // =================

  $.fn.affix.noConflict = function () {
    $.fn.affix = old
    return this
  }


  // AFFIX DATA-API
  // ==============

  $(window).on('load', function () {
    $('[data-spy="affix"]').each(function () {
      var $spy = $(this)
      var data = $spy.data()

      data.offset = data.offset || {}

      if (data.offsetBottom != null) data.offset.bottom = data.offsetBottom
      if (data.offsetTop    != null) data.offset.top    = data.offsetTop

      Plugin.call($spy, data)
    })
  })

}(jQuery);

/**
 * @summary     DataTables
 * @description Paginate, search and sort HTML tables
 * @version     1.9.4
 * @file        jquery.dataTables.js
 * @author      Allan Jardine (www.sprymedia.co.uk)
 * @contact     www.sprymedia.co.uk/contact
 *
 * @copyright Copyright 2008-2012 Allan Jardine, all rights reserved.
 *
 * This source file is free software, under either the GPL v2 license or a
 * BSD style license, available at:
 *   http://datatables.net/license_gpl2
 *   http://datatables.net/license_bsd
 *
 * This source file is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.
 *
 * For details please refer to: http://www.datatables.net
 */

/*jslint evil: true, undef: true, browser: true */
/*globals $, jQuery,define,_fnExternApiFunc,_fnInitialise,_fnInitComplete,_fnLanguageCompat,_fnAddColumn,_fnColumnOptions,_fnAddData,_fnCreateTr,_fnGatherData,_fnBuildHead,_fnDrawHead,_fnDraw,_fnReDraw,_fnAjaxUpdate,_fnAjaxParameters,_fnAjaxUpdateDraw,_fnServerParams,_fnAddOptionsHtml,_fnFeatureHtmlTable,_fnScrollDraw,_fnAdjustColumnSizing,_fnFeatureHtmlFilter,_fnFilterComplete,_fnFilterCustom,_fnFilterColumn,_fnFilter,_fnBuildSearchArray,_fnBuildSearchRow,_fnFilterCreateSearch,_fnDataToSearch,_fnSort,_fnSortAttachListener,_fnSortingClasses,_fnFeatureHtmlPaginate,_fnPageChange,_fnFeatureHtmlInfo,_fnUpdateInfo,_fnFeatureHtmlLength,_fnFeatureHtmlProcessing,_fnProcessingDisplay,_fnVisibleToColumnIndex,_fnColumnIndexToVisible,_fnNodeToDataIndex,_fnVisbleColumns,_fnCalculateEnd,_fnConvertToWidth,_fnCalculateColumnWidths,_fnScrollingWidthAdjust,_fnGetWidestNode,_fnGetMaxLenString,_fnStringToCss,_fnDetectType,_fnSettingsFromNode,_fnGetDataMaster,_fnGetTrNodes,_fnGetTdNodes,_fnEscapeRegex,_fnDeleteIndex,_fnReOrderIndex,_fnColumnOrdering,_fnLog,_fnClearTable,_fnSaveState,_fnLoadState,_fnCreateCookie,_fnReadCookie,_fnDetectHeader,_fnGetUniqueThs,_fnScrollBarWidth,_fnApplyToChildren,_fnMap,_fnGetRowData,_fnGetCellData,_fnSetCellData,_fnGetObjectDataFn,_fnSetObjectDataFn,_fnApplyColumnDefs,_fnBindAction,_fnCallbackReg,_fnCallbackFire,_fnJsonString,_fnRender,_fnNodeToColumnIndex,_fnInfoMacros,_fnBrowserDetect,_fnGetColumns*/

(/** @lends <global> */function( window, document, undefined ) {

	(function( factory ) {
		"use strict";

		// Define as an AMD module if possible
		if ( typeof define === 'function' && define.amd )
		{
			define( ['jquery'], factory );
		}
		/* Define using browser globals otherwise
		 * Prevent multiple instantiations if the script is loaded twice
		 */
		else if ( jQuery && !jQuery.fn.dataTable )
		{
			factory( jQuery );
		}
	}
	(/** @lends <global> */function( $ ) {
		"use strict";
		/**
		 * DataTables is a plug-in for the jQuery Javascript library. It is a
		 * highly flexible tool, based upon the foundations of progressive
		 * enhancement, which will add advanced interaction controls to any
		 * HTML table. For a full list of features please refer to
		 * <a href="http://datatables.net">DataTables.net</a>.
		 *
		 * Note that the <i>DataTable</i> object is not a global variable but is
		 * aliased to <i>jQuery.fn.DataTable</i> and <i>jQuery.fn.dataTable</i> through which
		 * it may be  accessed.
		 *
		 *  @class
		 *  @param {object} [oInit={}] Configuration object for DataTables. Options
		 *    are defined by {@link DataTable.defaults}
		 *  @requires jQuery 1.3+
		 *
		 *  @example
		 *    // Basic initialisation
		 *    $(document).ready( function {
	 *      $('#example').dataTable();
	 *    } );
		 *
		 *  @example
		 *    // Initialisation with configuration options - in this case, disable
		 *    // pagination and sorting.
		 *    $(document).ready( function {
	 *      $('#example').dataTable( {
	 *        "bPaginate": false,
	 *        "bSort": false 
	 *      } );
	 *    } );
		 */
		var DataTable = function( oInit )
		{


			/**
			 * Add a column to the list used for the table with default values
			 *  @param {object} oSettings dataTables settings object
			 *  @param {node} nTh The th element for this column
			 *  @memberof DataTable#oApi
			 */
			function _fnAddColumn( oSettings, nTh )
			{
				var oDefaults = DataTable.defaults.columns;
				var iCol = oSettings.aoColumns.length;
				var oCol = $.extend( {}, DataTable.models.oColumn, oDefaults, {
					"sSortingClass": oSettings.oClasses.sSortable,
					"sSortingClassJUI": oSettings.oClasses.sSortJUI,
					"nTh": nTh ? nTh : document.createElement('th'),
					"sTitle":    oDefaults.sTitle    ? oDefaults.sTitle    : nTh ? nTh.innerHTML : '',
					"aDataSort": oDefaults.aDataSort ? oDefaults.aDataSort : [iCol],
					"mData": oDefaults.mData ? oDefaults.oDefaults : iCol
				} );
				oSettings.aoColumns.push( oCol );

				/* Add a column specific filter */
				if ( oSettings.aoPreSearchCols[ iCol ] === undefined || oSettings.aoPreSearchCols[ iCol ] === null )
				{
					oSettings.aoPreSearchCols[ iCol ] = $.extend( {}, DataTable.models.oSearch );
				}
				else
				{
					var oPre = oSettings.aoPreSearchCols[ iCol ];

					/* Don't require that the user must specify bRegex, bSmart or bCaseInsensitive */
					if ( oPre.bRegex === undefined )
					{
						oPre.bRegex = true;
					}

					if ( oPre.bSmart === undefined )
					{
						oPre.bSmart = true;
					}

					if ( oPre.bCaseInsensitive === undefined )
					{
						oPre.bCaseInsensitive = true;
					}
				}

				/* Use the column options function to initialise classes etc */
				_fnColumnOptions( oSettings, iCol, null );
			}


			/**
			 * Apply options for a column
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iCol column index to consider
			 *  @param {object} oOptions object with sType, bVisible and bSearchable etc
			 *  @memberof DataTable#oApi
			 */
			function _fnColumnOptions( oSettings, iCol, oOptions )
			{
				var oCol = oSettings.aoColumns[ iCol ];

				/* User specified column options */
				if ( oOptions !== undefined && oOptions !== null )
				{
					/* Backwards compatibility for mDataProp */
					if ( oOptions.mDataProp && !oOptions.mData )
					{
						oOptions.mData = oOptions.mDataProp;
					}

					if ( oOptions.sType !== undefined )
					{
						oCol.sType = oOptions.sType;
						oCol._bAutoType = false;
					}

					$.extend( oCol, oOptions );
					_fnMap( oCol, oOptions, "sWidth", "sWidthOrig" );

					/* iDataSort to be applied (backwards compatibility), but aDataSort will take
					 * priority if defined
					 */
					if ( oOptions.iDataSort !== undefined )
					{
						oCol.aDataSort = [ oOptions.iDataSort ];
					}
					_fnMap( oCol, oOptions, "aDataSort" );
				}

				/* Cache the data get and set functions for speed */
				var mRender = oCol.mRender ? _fnGetObjectDataFn( oCol.mRender ) : null;
				var mData = _fnGetObjectDataFn( oCol.mData );

				oCol.fnGetData = function (oData, sSpecific) {
					var innerData = mData( oData, sSpecific );

					if ( oCol.mRender && (sSpecific && sSpecific !== '') )
					{
						return mRender( innerData, sSpecific, oData );
					}
					return innerData;
				};
				oCol.fnSetData = _fnSetObjectDataFn( oCol.mData );

				/* Feature sorting overrides column specific when off */
				if ( !oSettings.oFeatures.bSort )
				{
					oCol.bSortable = false;
				}

				/* Check that the class assignment is correct for sorting */
				if ( !oCol.bSortable ||
					($.inArray('asc', oCol.asSorting) == -1 && $.inArray('desc', oCol.asSorting) == -1) )
				{
					oCol.sSortingClass = oSettings.oClasses.sSortableNone;
					oCol.sSortingClassJUI = "";
				}
				else if ( $.inArray('asc', oCol.asSorting) == -1 && $.inArray('desc', oCol.asSorting) == -1 )
				{
					oCol.sSortingClass = oSettings.oClasses.sSortable;
					oCol.sSortingClassJUI = oSettings.oClasses.sSortJUI;
				}
				else if ( $.inArray('asc', oCol.asSorting) != -1 && $.inArray('desc', oCol.asSorting) == -1 )
				{
					oCol.sSortingClass = oSettings.oClasses.sSortableAsc;
					oCol.sSortingClassJUI = oSettings.oClasses.sSortJUIAscAllowed;
				}
				else if ( $.inArray('asc', oCol.asSorting) == -1 && $.inArray('desc', oCol.asSorting) != -1 )
				{
					oCol.sSortingClass = oSettings.oClasses.sSortableDesc;
					oCol.sSortingClassJUI = oSettings.oClasses.sSortJUIDescAllowed;
				}
			}


			/**
			 * Adjust the table column widths for new data. Note: you would probably want to
			 * do a redraw after calling this function!
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnAdjustColumnSizing ( oSettings )
			{
				/* Not interested in doing column width calculation if auto-width is disabled */
				if ( oSettings.oFeatures.bAutoWidth === false )
				{
					return false;
				}

				_fnCalculateColumnWidths( oSettings );
				for ( var i=0 , iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					oSettings.aoColumns[i].nTh.style.width = oSettings.aoColumns[i].sWidth;
				}
			}


			/**
			 * Covert the index of a visible column to the index in the data array (take account
			 * of hidden columns)
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iMatch Visible column index to lookup
			 *  @returns {int} i the data index
			 *  @memberof DataTable#oApi
			 */
			function _fnVisibleToColumnIndex( oSettings, iMatch )
			{
				var aiVis = _fnGetColumns( oSettings, 'bVisible' );

				return typeof aiVis[iMatch] === 'number' ?
					aiVis[iMatch] :
					null;
			}


			/**
			 * Covert the index of an index in the data array and convert it to the visible
			 *   column index (take account of hidden columns)
			 *  @param {int} iMatch Column index to lookup
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {int} i the data index
			 *  @memberof DataTable#oApi
			 */
			function _fnColumnIndexToVisible( oSettings, iMatch )
			{
				var aiVis = _fnGetColumns( oSettings, 'bVisible' );
				var iPos = $.inArray( iMatch, aiVis );

				return iPos !== -1 ? iPos : null;
			}


			/**
			 * Get the number of visible columns
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {int} i the number of visible columns
			 *  @memberof DataTable#oApi
			 */
			function _fnVisbleColumns( oSettings )
			{
				return _fnGetColumns( oSettings, 'bVisible' ).length;
			}


			/**
			 * Get an array of column indexes that match a given property
			 *  @param {object} oSettings dataTables settings object
			 *  @param {string} sParam Parameter in aoColumns to look for - typically
			 *    bVisible or bSearchable
			 *  @returns {array} Array of indexes with matched properties
			 *  @memberof DataTable#oApi
			 */
			function _fnGetColumns( oSettings, sParam )
			{
				var a = [];

				$.map( oSettings.aoColumns, function(val, i) {
					if ( val[sParam] ) {
						a.push( i );
					}
				} );

				return a;
			}


			/**
			 * Get the sort type based on an input string
			 *  @param {string} sData data we wish to know the type of
			 *  @returns {string} type (defaults to 'string' if no type can be detected)
			 *  @memberof DataTable#oApi
			 */
			function _fnDetectType( sData )
			{
				var aTypes = DataTable.ext.aTypes;
				var iLen = aTypes.length;

				for ( var i=0 ; i<iLen ; i++ )
				{
					var sType = aTypes[i]( sData );
					if ( sType !== null )
					{
						return sType;
					}
				}

				return 'string';
			}


			/**
			 * Figure out how to reorder a display list
			 *  @param {object} oSettings dataTables settings object
			 *  @returns array {int} aiReturn index list for reordering
			 *  @memberof DataTable#oApi
			 */
			function _fnReOrderIndex ( oSettings, sColumns )
			{
				var aColumns = sColumns.split(',');
				var aiReturn = [];

				for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					for ( var j=0 ; j<iLen ; j++ )
					{
						if ( oSettings.aoColumns[i].sName == aColumns[j] )
						{
							aiReturn.push( j );
							break;
						}
					}
				}

				return aiReturn;
			}


			/**
			 * Get the column ordering that DataTables expects
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {string} comma separated list of names
			 *  @memberof DataTable#oApi
			 */
			function _fnColumnOrdering ( oSettings )
			{
				var sNames = '';
				for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					sNames += oSettings.aoColumns[i].sName+',';
				}
				if ( sNames.length == iLen )
				{
					return "";
				}
				return sNames.slice(0, -1);
			}


			/**
			 * Take the column definitions and static columns arrays and calculate how
			 * they relate to column indexes. The callback function will then apply the
			 * definition found for a column to a suitable configuration object.
			 *  @param {object} oSettings dataTables settings object
			 *  @param {array} aoColDefs The aoColumnDefs array that is to be applied
			 *  @param {array} aoCols The aoColumns array that defines columns individually
			 *  @param {function} fn Callback function - takes two parameters, the calculated
			 *    column index and the definition for that column.
			 *  @memberof DataTable#oApi
			 */
			function _fnApplyColumnDefs( oSettings, aoColDefs, aoCols, fn )
			{
				var i, iLen, j, jLen, k, kLen;

				// Column definitions with aTargets
				if ( aoColDefs )
				{
					/* Loop over the definitions array - loop in reverse so first instance has priority */
					for ( i=aoColDefs.length-1 ; i>=0 ; i-- )
					{
						/* Each definition can target multiple columns, as it is an array */
						var aTargets = aoColDefs[i].aTargets;
						if ( !$.isArray( aTargets ) )
						{
							_fnLog( oSettings, 1, 'aTargets must be an array of targets, not a '+(typeof aTargets) );
						}

						for ( j=0, jLen=aTargets.length ; j<jLen ; j++ )
						{
							if ( typeof aTargets[j] === 'number' && aTargets[j] >= 0 )
							{
								/* Add columns that we don't yet know about */
								while( oSettings.aoColumns.length <= aTargets[j] )
								{
									_fnAddColumn( oSettings );
								}

								/* Integer, basic index */
								fn( aTargets[j], aoColDefs[i] );
							}
							else if ( typeof aTargets[j] === 'number' && aTargets[j] < 0 )
							{
								/* Negative integer, right to left column counting */
								fn( oSettings.aoColumns.length+aTargets[j], aoColDefs[i] );
							}
							else if ( typeof aTargets[j] === 'string' )
							{
								/* Class name matching on TH element */
								for ( k=0, kLen=oSettings.aoColumns.length ; k<kLen ; k++ )
								{
									if ( aTargets[j] == "_all" ||
										$(oSettings.aoColumns[k].nTh).hasClass( aTargets[j] ) )
									{
										fn( k, aoColDefs[i] );
									}
								}
							}
						}
					}
				}

				// Statically defined columns array
				if ( aoCols )
				{
					for ( i=0, iLen=aoCols.length ; i<iLen ; i++ )
					{
						fn( i, aoCols[i] );
					}
				}
			}

			/**
			 * Add a data array to the table, creating DOM node etc. This is the parallel to
			 * _fnGatherData, but for adding rows from a Javascript source, rather than a
			 * DOM source.
			 *  @param {object} oSettings dataTables settings object
			 *  @param {array} aData data array to be added
			 *  @returns {int} >=0 if successful (index of new aoData entry), -1 if failed
			 *  @memberof DataTable#oApi
			 */
			function _fnAddData ( oSettings, aDataSupplied )
			{
				var oCol;

				/* Take an independent copy of the data source so we can bash it about as we wish */
				var aDataIn = ($.isArray(aDataSupplied)) ?
					aDataSupplied.slice() :
					$.extend( true, {}, aDataSupplied );

				/* Create the object for storing information about this new row */
				var iRow = oSettings.aoData.length;
				var oData = $.extend( true, {}, DataTable.models.oRow );
				oData._aData = aDataIn;
				oSettings.aoData.push( oData );

				/* Create the cells */
				var nTd, sThisType;
				for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					oCol = oSettings.aoColumns[i];

					/* Use rendered data for filtering / sorting */
					if ( typeof oCol.fnRender === 'function' && oCol.bUseRendered && oCol.mData !== null )
					{
						_fnSetCellData( oSettings, iRow, i, _fnRender(oSettings, iRow, i) );
					}
					else
					{
						_fnSetCellData( oSettings, iRow, i, _fnGetCellData( oSettings, iRow, i ) );
					}

					/* See if we should auto-detect the column type */
					if ( oCol._bAutoType && oCol.sType != 'string' )
					{
						/* Attempt to auto detect the type - same as _fnGatherData() */
						var sVarType = _fnGetCellData( oSettings, iRow, i, 'type' );
						if ( sVarType !== null && sVarType !== '' )
						{
							sThisType = _fnDetectType( sVarType );
							if ( oCol.sType === null )
							{
								oCol.sType = sThisType;
							}
							else if ( oCol.sType != sThisType && oCol.sType != "html" )
							{
								/* String is always the 'fallback' option */
								oCol.sType = 'string';
							}
						}
					}
				}

				/* Add to the display array */
				oSettings.aiDisplayMaster.push( iRow );

				/* Create the DOM information */
				if ( !oSettings.oFeatures.bDeferRender )
				{
					_fnCreateTr( oSettings, iRow );
				}

				return iRow;
			}


			/**
			 * Read in the data from the target table from the DOM
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnGatherData( oSettings )
			{
				var iLoop, i, iLen, j, jLen, jInner,
					nTds, nTrs, nTd, nTr, aLocalData, iThisIndex,
					iRow, iRows, iColumn, iColumns, sNodeName,
					oCol, oData;

				/*
				 * Process by row first
				 * Add the data object for the whole table - storing the tr node. Note - no point in getting
				 * DOM based data if we are going to go and replace it with Ajax source data.
				 */
				if ( oSettings.bDeferLoading || oSettings.sAjaxSource === null )
				{
					nTr = oSettings.nTBody.firstChild;
					while ( nTr )
					{
						if ( nTr.nodeName.toUpperCase() == "TR" )
						{
							iThisIndex = oSettings.aoData.length;
							nTr._DT_RowIndex = iThisIndex;
							oSettings.aoData.push( $.extend( true, {}, DataTable.models.oRow, {
								"nTr": nTr
							} ) );

							oSettings.aiDisplayMaster.push( iThisIndex );
							nTd = nTr.firstChild;
							jInner = 0;
							while ( nTd )
							{
								sNodeName = nTd.nodeName.toUpperCase();
								if ( sNodeName == "TD" || sNodeName == "TH" )
								{
									_fnSetCellData( oSettings, iThisIndex, jInner, $.trim(nTd.innerHTML) );
									jInner++;
								}
								nTd = nTd.nextSibling;
							}
						}
						nTr = nTr.nextSibling;
					}
				}

				/* Gather in the TD elements of the Table - note that this is basically the same as
				 * fnGetTdNodes, but that function takes account of hidden columns, which we haven't yet
				 * setup!
				 */
				nTrs = _fnGetTrNodes( oSettings );
				nTds = [];
				for ( i=0, iLen=nTrs.length ; i<iLen ; i++ )
				{
					nTd = nTrs[i].firstChild;
					while ( nTd )
					{
						sNodeName = nTd.nodeName.toUpperCase();
						if ( sNodeName == "TD" || sNodeName == "TH" )
						{
							nTds.push( nTd );
						}
						nTd = nTd.nextSibling;
					}
				}

				/* Now process by column */
				for ( iColumn=0, iColumns=oSettings.aoColumns.length ; iColumn<iColumns ; iColumn++ )
				{
					oCol = oSettings.aoColumns[iColumn];

					/* Get the title of the column - unless there is a user set one */
					if ( oCol.sTitle === null )
					{
						oCol.sTitle = oCol.nTh.innerHTML;
					}

					var
						bAutoType = oCol._bAutoType,
						bRender = typeof oCol.fnRender === 'function',
						bClass = oCol.sClass !== null,
						bVisible = oCol.bVisible,
						nCell, sThisType, sRendered, sValType;

					/* A single loop to rule them all (and be more efficient) */
					if ( bAutoType || bRender || bClass || !bVisible )
					{
						for ( iRow=0, iRows=oSettings.aoData.length ; iRow<iRows ; iRow++ )
						{
							oData = oSettings.aoData[iRow];
							nCell = nTds[ (iRow*iColumns) + iColumn ];

							/* Type detection */
							if ( bAutoType && oCol.sType != 'string' )
							{
								sValType = _fnGetCellData( oSettings, iRow, iColumn, 'type' );
								if ( sValType !== '' )
								{
									sThisType = _fnDetectType( sValType );
									if ( oCol.sType === null )
									{
										oCol.sType = sThisType;
									}
									else if ( oCol.sType != sThisType &&
										oCol.sType != "html" )
									{
										/* String is always the 'fallback' option */
										oCol.sType = 'string';
									}
								}
							}

							if ( oCol.mRender )
							{
								// mRender has been defined, so we need to get the value and set it
								nCell.innerHTML = _fnGetCellData( oSettings, iRow, iColumn, 'display' );
							}
							else if ( oCol.mData !== iColumn )
							{
								// If mData is not the same as the column number, then we need to
								// get the dev set value. If it is the column, no point in wasting
								// time setting the value that is already there!
								nCell.innerHTML = _fnGetCellData( oSettings, iRow, iColumn, 'display' );
							}

							/* Rendering */
							if ( bRender )
							{
								sRendered = _fnRender( oSettings, iRow, iColumn );
								nCell.innerHTML = sRendered;
								if ( oCol.bUseRendered )
								{
									/* Use the rendered data for filtering / sorting */
									_fnSetCellData( oSettings, iRow, iColumn, sRendered );
								}
							}

							/* Classes */
							if ( bClass )
							{
								nCell.className += ' '+oCol.sClass;
							}

							/* Column visibility */
							if ( !bVisible )
							{
								oData._anHidden[iColumn] = nCell;
								nCell.parentNode.removeChild( nCell );
							}
							else
							{
								oData._anHidden[iColumn] = null;
							}

							if ( oCol.fnCreatedCell )
							{
								oCol.fnCreatedCell.call( oSettings.oInstance,
									nCell, _fnGetCellData( oSettings, iRow, iColumn, 'display' ), oData._aData, iRow, iColumn
								);
							}
						}
					}
				}

				/* Row created callbacks */
				if ( oSettings.aoRowCreatedCallback.length !== 0 )
				{
					for ( i=0, iLen=oSettings.aoData.length ; i<iLen ; i++ )
					{
						oData = oSettings.aoData[i];
						_fnCallbackFire( oSettings, 'aoRowCreatedCallback', null, [oData.nTr, oData._aData, i] );
					}
				}
			}


			/**
			 * Take a TR element and convert it to an index in aoData
			 *  @param {object} oSettings dataTables settings object
			 *  @param {node} n the TR element to find
			 *  @returns {int} index if the node is found, null if not
			 *  @memberof DataTable#oApi
			 */
			function _fnNodeToDataIndex( oSettings, n )
			{
				return (n._DT_RowIndex!==undefined) ? n._DT_RowIndex : null;
			}


			/**
			 * Take a TD element and convert it into a column data index (not the visible index)
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iRow The row number the TD/TH can be found in
			 *  @param {node} n The TD/TH element to find
			 *  @returns {int} index if the node is found, -1 if not
			 *  @memberof DataTable#oApi
			 */
			function _fnNodeToColumnIndex( oSettings, iRow, n )
			{
				var anCells = _fnGetTdNodes( oSettings, iRow );

				for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					if ( anCells[i] === n )
					{
						return i;
					}
				}
				return -1;
			}


			/**
			 * Get an array of data for a given row from the internal data cache
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iRow aoData row id
			 *  @param {string} sSpecific data get type ('type' 'filter' 'sort')
			 *  @param {array} aiColumns Array of column indexes to get data from
			 *  @returns {array} Data array
			 *  @memberof DataTable#oApi
			 */
			function _fnGetRowData( oSettings, iRow, sSpecific, aiColumns )
			{
				var out = [];
				for ( var i=0, iLen=aiColumns.length ; i<iLen ; i++ )
				{
					out.push( _fnGetCellData( oSettings, iRow, aiColumns[i], sSpecific ) );
				}
				return out;
			}


			/**
			 * Get the data for a given cell from the internal cache, taking into account data mapping
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iRow aoData row id
			 *  @param {int} iCol Column index
			 *  @param {string} sSpecific data get type ('display', 'type' 'filter' 'sort')
			 *  @returns {*} Cell data
			 *  @memberof DataTable#oApi
			 */
			function _fnGetCellData( oSettings, iRow, iCol, sSpecific )
			{
				var sData;
				var oCol = oSettings.aoColumns[iCol];
				var oData = oSettings.aoData[iRow]._aData;

				if ( (sData=oCol.fnGetData( oData, sSpecific )) === undefined )
				{
					if ( oSettings.iDrawError != oSettings.iDraw && oCol.sDefaultContent === null )
					{
						_fnLog( oSettings, 0, "Requested unknown parameter "+
							(typeof oCol.mData=='function' ? '{mData function}' : "'"+oCol.mData+"'")+
							" from the data source for row "+iRow );
						oSettings.iDrawError = oSettings.iDraw;
					}
					return oCol.sDefaultContent;
				}

				/* When the data source is null, we can use default column data */
				if ( sData === null && oCol.sDefaultContent !== null )
				{
					sData = oCol.sDefaultContent;
				}
				else if ( typeof sData === 'function' )
				{
					/* If the data source is a function, then we run it and use the return */
					return sData();
				}

				if ( sSpecific == 'display' && sData === null )
				{
					return '';
				}
				return sData;
			}


			/**
			 * Set the value for a specific cell, into the internal data cache
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iRow aoData row id
			 *  @param {int} iCol Column index
			 *  @param {*} val Value to set
			 *  @memberof DataTable#oApi
			 */
			function _fnSetCellData( oSettings, iRow, iCol, val )
			{
				var oCol = oSettings.aoColumns[iCol];
				var oData = oSettings.aoData[iRow]._aData;

				oCol.fnSetData( oData, val );
			}


			// Private variable that is used to match array syntax in the data property object
			var __reArray = /\[.*?\]$/;

			/**
			 * Return a function that can be used to get data from a source object, taking
			 * into account the ability to use nested objects as a source
			 *  @param {string|int|function} mSource The data source for the object
			 *  @returns {function} Data get function
			 *  @memberof DataTable#oApi
			 */
			function _fnGetObjectDataFn( mSource )
			{
				if ( mSource === null )
				{
					/* Give an empty string for rendering / sorting etc */
					return function (data, type) {
						return null;
					};
				}
				else if ( typeof mSource === 'function' )
				{
					return function (data, type, extra) {
						return mSource( data, type, extra );
					};
				}
				else if ( typeof mSource === 'string' && (mSource.indexOf('.') !== -1 || mSource.indexOf('[') !== -1) )
				{
					/* If there is a . in the source string then the data source is in a 
					 * nested object so we loop over the data for each level to get the next
					 * level down. On each loop we test for undefined, and if found immediately
					 * return. This allows entire objects to be missing and sDefaultContent to
					 * be used if defined, rather than throwing an error
					 */
					var fetchData = function (data, type, src) {
						var a = src.split('.');
						var arrayNotation, out, innerSrc;

						if ( src !== "" )
						{
							for ( var i=0, iLen=a.length ; i<iLen ; i++ )
							{
								// Check if we are dealing with an array notation request
								arrayNotation = a[i].match(__reArray);

								if ( arrayNotation ) {
									a[i] = a[i].replace(__reArray, '');

									// Condition allows simply [] to be passed in
									if ( a[i] !== "" ) {
										data = data[ a[i] ];
									}
									out = [];

									// Get the remainder of the nested object to get
									a.splice( 0, i+1 );
									innerSrc = a.join('.');

									// Traverse each entry in the array getting the properties requested
									for ( var j=0, jLen=data.length ; j<jLen ; j++ ) {
										out.push( fetchData( data[j], type, innerSrc ) );
									}

									// If a string is given in between the array notation indicators, that
									// is used to join the strings together, otherwise an array is returned
									var join = arrayNotation[0].substring(1, arrayNotation[0].length-1);
									data = (join==="") ? out : out.join(join);

									// The inner call to fetchData has already traversed through the remainder
									// of the source requested, so we exit from the loop
									break;
								}

								if ( data === null || data[ a[i] ] === undefined )
								{
									return undefined;
								}
								data = data[ a[i] ];
							}
						}

						return data;
					};

					return function (data, type) {
						return fetchData( data, type, mSource );
					};
				}
				else
				{
					/* Array or flat object mapping */
					return function (data, type) {
						return data[mSource];
					};
				}
			}


			/**
			 * Return a function that can be used to set data from a source object, taking
			 * into account the ability to use nested objects as a source
			 *  @param {string|int|function} mSource The data source for the object
			 *  @returns {function} Data set function
			 *  @memberof DataTable#oApi
			 */
			function _fnSetObjectDataFn( mSource )
			{
				if ( mSource === null )
				{
					/* Nothing to do when the data source is null */
					return function (data, val) {};
				}
				else if ( typeof mSource === 'function' )
				{
					return function (data, val) {
						mSource( data, 'set', val );
					};
				}
				else if ( typeof mSource === 'string' && (mSource.indexOf('.') !== -1 || mSource.indexOf('[') !== -1) )
				{
					/* Like the get, we need to get data from a nested object */
					var setData = function (data, val, src) {
						var a = src.split('.'), b;
						var arrayNotation, o, innerSrc;

						for ( var i=0, iLen=a.length-1 ; i<iLen ; i++ )
						{
							// Check if we are dealing with an array notation request
							arrayNotation = a[i].match(__reArray);

							if ( arrayNotation )
							{
								a[i] = a[i].replace(__reArray, '');
								data[ a[i] ] = [];

								// Get the remainder of the nested object to set so we can recurse
								b = a.slice();
								b.splice( 0, i+1 );
								innerSrc = b.join('.');

								// Traverse each entry in the array setting the properties requested
								for ( var j=0, jLen=val.length ; j<jLen ; j++ )
								{
									o = {};
									setData( o, val[j], innerSrc );
									data[ a[i] ].push( o );
								}

								// The inner call to setData has already traversed through the remainder
								// of the source and has set the data, thus we can exit here
								return;
							}

							// If the nested object doesn't currently exist - since we are
							// trying to set the value - create it
							if ( data[ a[i] ] === null || data[ a[i] ] === undefined )
							{
								data[ a[i] ] = {};
							}
							data = data[ a[i] ];
						}

						// If array notation is used, we just want to strip it and use the property name
						// and assign the value. If it isn't used, then we get the result we want anyway
						data[ a[a.length-1].replace(__reArray, '') ] = val;
					};

					return function (data, val) {
						return setData( data, val, mSource );
					};
				}
				else
				{
					/* Array or flat object mapping */
					return function (data, val) {
						data[mSource] = val;
					};
				}
			}


			/**
			 * Return an array with the full table data
			 *  @param {object} oSettings dataTables settings object
			 *  @returns array {array} aData Master data array
			 *  @memberof DataTable#oApi
			 */
			function _fnGetDataMaster ( oSettings )
			{
				var aData = [];
				var iLen = oSettings.aoData.length;
				for ( var i=0 ; i<iLen; i++ )
				{
					aData.push( oSettings.aoData[i]._aData );
				}
				return aData;
			}


			/**
			 * Nuke the table
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnClearTable( oSettings )
			{
				oSettings.aoData.splice( 0, oSettings.aoData.length );
				oSettings.aiDisplayMaster.splice( 0, oSettings.aiDisplayMaster.length );
				oSettings.aiDisplay.splice( 0, oSettings.aiDisplay.length );
				_fnCalculateEnd( oSettings );
			}


			/**
			 * Take an array of integers (index array) and remove a target integer (value - not
			 * the key!)
			 *  @param {array} a Index array to target
			 *  @param {int} iTarget value to find
			 *  @memberof DataTable#oApi
			 */
			function _fnDeleteIndex( a, iTarget )
			{
				var iTargetIndex = -1;

				for ( var i=0, iLen=a.length ; i<iLen ; i++ )
				{
					if ( a[i] == iTarget )
					{
						iTargetIndex = i;
					}
					else if ( a[i] > iTarget )
					{
						a[i]--;
					}
				}

				if ( iTargetIndex != -1 )
				{
					a.splice( iTargetIndex, 1 );
				}
			}


			/**
			 * Call the developer defined fnRender function for a given cell (row/column) with
			 * the required parameters and return the result.
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iRow aoData index for the row
			 *  @param {int} iCol aoColumns index for the column
			 *  @returns {*} Return of the developer's fnRender function
			 *  @memberof DataTable#oApi
			 */
			function _fnRender( oSettings, iRow, iCol )
			{
				var oCol = oSettings.aoColumns[iCol];

				return oCol.fnRender( {
					"iDataRow":    iRow,
					"iDataColumn": iCol,
					"oSettings":   oSettings,
					"aData":       oSettings.aoData[iRow]._aData,
					"mDataProp":   oCol.mData
				}, _fnGetCellData(oSettings, iRow, iCol, 'display') );
			}
			/**
			 * Create a new TR element (and it's TD children) for a row
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iRow Row to consider
			 *  @memberof DataTable#oApi
			 */
			function _fnCreateTr ( oSettings, iRow )
			{
				var oData = oSettings.aoData[iRow];
				var nTd;

				if ( oData.nTr === null )
				{
					oData.nTr = document.createElement('tr');

					/* Use a private property on the node to allow reserve mapping from the node
					 * to the aoData array for fast look up
					 */
					oData.nTr._DT_RowIndex = iRow;

					/* Special parameters can be given by the data source to be used on the row */
					if ( oData._aData.DT_RowId )
					{
						oData.nTr.id = oData._aData.DT_RowId;
					}

					if ( oData._aData.DT_RowClass )
					{
						oData.nTr.className = oData._aData.DT_RowClass;
					}

					/* Process each column */
					for ( var i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
					{
						var oCol = oSettings.aoColumns[i];
						nTd = document.createElement( oCol.sCellType );

						/* Render if needed - if bUseRendered is true then we already have the rendered
						 * value in the data source - so can just use that
						 */
						nTd.innerHTML = (typeof oCol.fnRender === 'function' && (!oCol.bUseRendered || oCol.mData === null)) ?
							_fnRender( oSettings, iRow, i ) :
							_fnGetCellData( oSettings, iRow, i, 'display' );

						/* Add user defined class */
						if ( oCol.sClass !== null )
						{
							nTd.className = oCol.sClass;
						}

						if ( oCol.bVisible )
						{
							oData.nTr.appendChild( nTd );
							oData._anHidden[i] = null;
						}
						else
						{
							oData._anHidden[i] = nTd;
						}

						if ( oCol.fnCreatedCell )
						{
							oCol.fnCreatedCell.call( oSettings.oInstance,
								nTd, _fnGetCellData( oSettings, iRow, i, 'display' ), oData._aData, iRow, i
							);
						}
					}

					_fnCallbackFire( oSettings, 'aoRowCreatedCallback', null, [oData.nTr, oData._aData, iRow] );
				}
			}


			/**
			 * Create the HTML header for the table
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnBuildHead( oSettings )
			{
				var i, nTh, iLen, j, jLen;
				var iThs = $('th, td', oSettings.nTHead).length;
				var iCorrector = 0;
				var jqChildren;

				/* If there is a header in place - then use it - otherwise it's going to get nuked... */
				if ( iThs !== 0 )
				{
					/* We've got a thead from the DOM, so remove hidden columns and apply width to vis cols */
					for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
					{
						nTh = oSettings.aoColumns[i].nTh;
						nTh.setAttribute('role', 'columnheader');
						if ( oSettings.aoColumns[i].bSortable )
						{
							nTh.setAttribute('tabindex', oSettings.iTabIndex);
							nTh.setAttribute('aria-controls', oSettings.sTableId);
						}

						if ( oSettings.aoColumns[i].sClass !== null )
						{
							$(nTh).addClass( oSettings.aoColumns[i].sClass );
						}

						/* Set the title of the column if it is user defined (not what was auto detected) */
						if ( oSettings.aoColumns[i].sTitle != nTh.innerHTML )
						{
							nTh.innerHTML = oSettings.aoColumns[i].sTitle;
						}
					}
				}
				else
				{
					/* We don't have a header in the DOM - so we are going to have to create one */
					var nTr = document.createElement( "tr" );

					for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
					{
						nTh = oSettings.aoColumns[i].nTh;
						nTh.innerHTML = oSettings.aoColumns[i].sTitle;
						nTh.setAttribute('tabindex', '0');

						if ( oSettings.aoColumns[i].sClass !== null )
						{
							$(nTh).addClass( oSettings.aoColumns[i].sClass );
						}

						nTr.appendChild( nTh );
					}
					$(oSettings.nTHead).html( '' )[0].appendChild( nTr );
					_fnDetectHeader( oSettings.aoHeader, oSettings.nTHead );
				}

				/* ARIA role for the rows */
				$(oSettings.nTHead).children('tr').attr('role', 'row');

				/* Add the extra markup needed by jQuery UI's themes */
				if ( oSettings.bJUI )
				{
					for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
					{
						nTh = oSettings.aoColumns[i].nTh;

						var nDiv = document.createElement('div');
						nDiv.className = oSettings.oClasses.sSortJUIWrapper;
						$(nTh).contents().appendTo(nDiv);

						var nSpan = document.createElement('span');
						nSpan.className = oSettings.oClasses.sSortIcon;
						nDiv.appendChild( nSpan );
						nTh.appendChild( nDiv );
					}
				}

				if ( oSettings.oFeatures.bSort )
				{
					for ( i=0 ; i<oSettings.aoColumns.length ; i++ )
					{
						if ( oSettings.aoColumns[i].bSortable !== false )
						{
							_fnSortAttachListener( oSettings, oSettings.aoColumns[i].nTh, i );
						}
						else
						{
							$(oSettings.aoColumns[i].nTh).addClass( oSettings.oClasses.sSortableNone );
						}
					}
				}

				/* Deal with the footer - add classes if required */
				if ( oSettings.oClasses.sFooterTH !== "" )
				{
					$(oSettings.nTFoot).children('tr').children('th').addClass( oSettings.oClasses.sFooterTH );
				}

				/* Cache the footer elements */
				if ( oSettings.nTFoot !== null )
				{
					var anCells = _fnGetUniqueThs( oSettings, null, oSettings.aoFooter );
					for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
					{
						if ( anCells[i] )
						{
							oSettings.aoColumns[i].nTf = anCells[i];
							if ( oSettings.aoColumns[i].sClass )
							{
								$(anCells[i]).addClass( oSettings.aoColumns[i].sClass );
							}
						}
					}
				}
			}


			/**
			 * Draw the header (or footer) element based on the column visibility states. The
			 * methodology here is to use the layout array from _fnDetectHeader, modified for
			 * the instantaneous column visibility, to construct the new layout. The grid is
			 * traversed over cell at a time in a rows x columns grid fashion, although each
			 * cell insert can cover multiple elements in the grid - which is tracks using the
			 * aApplied array. Cell inserts in the grid will only occur where there isn't
			 * already a cell in that position.
			 *  @param {object} oSettings dataTables settings object
			 *  @param array {objects} aoSource Layout array from _fnDetectHeader
			 *  @param {boolean} [bIncludeHidden=false] If true then include the hidden columns in the calc,
			 *  @memberof DataTable#oApi
			 */
			function _fnDrawHead( oSettings, aoSource, bIncludeHidden )
			{
				var i, iLen, j, jLen, k, kLen, n, nLocalTr;
				var aoLocal = [];
				var aApplied = [];
				var iColumns = oSettings.aoColumns.length;
				var iRowspan, iColspan;

				if (  bIncludeHidden === undefined )
				{
					bIncludeHidden = false;
				}

				/* Make a copy of the master layout array, but without the visible columns in it */
				for ( i=0, iLen=aoSource.length ; i<iLen ; i++ )
				{
					aoLocal[i] = aoSource[i].slice();
					aoLocal[i].nTr = aoSource[i].nTr;

					/* Remove any columns which are currently hidden */
					for ( j=iColumns-1 ; j>=0 ; j-- )
					{
						if ( !oSettings.aoColumns[j].bVisible && !bIncludeHidden )
						{
							aoLocal[i].splice( j, 1 );
						}
					}

					/* Prep the applied array - it needs an element for each row */
					aApplied.push( [] );
				}

				for ( i=0, iLen=aoLocal.length ; i<iLen ; i++ )
				{
					nLocalTr = aoLocal[i].nTr;

					/* All cells are going to be replaced, so empty out the row */
					if ( nLocalTr )
					{
						while( (n = nLocalTr.firstChild) )
						{
							nLocalTr.removeChild( n );
						}
					}

					for ( j=0, jLen=aoLocal[i].length ; j<jLen ; j++ )
					{
						iRowspan = 1;
						iColspan = 1;

						/* Check to see if there is already a cell (row/colspan) covering our target
						 * insert point. If there is, then there is nothing to do.
						 */
						if ( aApplied[i][j] === undefined )
						{
							nLocalTr.appendChild( aoLocal[i][j].cell );
							aApplied[i][j] = 1;

							/* Expand the cell to cover as many rows as needed */
							while ( aoLocal[i+iRowspan] !== undefined &&
							aoLocal[i][j].cell == aoLocal[i+iRowspan][j].cell )
							{
								aApplied[i+iRowspan][j] = 1;
								iRowspan++;
							}

							/* Expand the cell to cover as many columns as needed */
							while ( aoLocal[i][j+iColspan] !== undefined &&
							aoLocal[i][j].cell == aoLocal[i][j+iColspan].cell )
							{
								/* Must update the applied array over the rows for the columns */
								for ( k=0 ; k<iRowspan ; k++ )
								{
									aApplied[i+k][j+iColspan] = 1;
								}
								iColspan++;
							}

							/* Do the actual expansion in the DOM */
							aoLocal[i][j].cell.rowSpan = iRowspan;
							aoLocal[i][j].cell.colSpan = iColspan;
						}
					}
				}
			}


			/**
			 * Insert the required TR nodes into the table for display
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnDraw( oSettings )
			{
				/* Provide a pre-callback function which can be used to cancel the draw is false is returned */
				var aPreDraw = _fnCallbackFire( oSettings, 'aoPreDrawCallback', 'preDraw', [oSettings] );
				if ( $.inArray( false, aPreDraw ) !== -1 )
				{
					_fnProcessingDisplay( oSettings, false );
					return;
				}

				var i, iLen, n;
				var anRows = [];
				var iRowCount = 0;
				var iStripes = oSettings.asStripeClasses.length;
				var iOpenRows = oSettings.aoOpenRows.length;

				oSettings.bDrawing = true;

				/* Check and see if we have an initial draw position from state saving */
				if ( oSettings.iInitDisplayStart !== undefined && oSettings.iInitDisplayStart != -1 )
				{
					if ( oSettings.oFeatures.bServerSide )
					{
						oSettings._iDisplayStart = oSettings.iInitDisplayStart;
					}
					else
					{
						oSettings._iDisplayStart = (oSettings.iInitDisplayStart >= oSettings.fnRecordsDisplay()) ?
							0 : oSettings.iInitDisplayStart;
					}
					oSettings.iInitDisplayStart = -1;
					_fnCalculateEnd( oSettings );
				}

				/* Server-side processing draw intercept */
				if ( oSettings.bDeferLoading )
				{
					oSettings.bDeferLoading = false;
					oSettings.iDraw++;
				}
				else if ( !oSettings.oFeatures.bServerSide )
				{
					oSettings.iDraw++;
				}
				else if ( !oSettings.bDestroying && !_fnAjaxUpdate( oSettings ) )
				{
					return;
				}

				if ( oSettings.aiDisplay.length !== 0 )
				{
					var iStart = oSettings._iDisplayStart;
					var iEnd = oSettings._iDisplayEnd;

					if ( oSettings.oFeatures.bServerSide )
					{
						iStart = 0;
						iEnd = oSettings.aoData.length;
					}

					for ( var j=iStart ; j<iEnd ; j++ )
					{
						var aoData = oSettings.aoData[ oSettings.aiDisplay[j] ];
						if ( aoData.nTr === null )
						{
							_fnCreateTr( oSettings, oSettings.aiDisplay[j] );
						}

						var nRow = aoData.nTr;

						/* Remove the old striping classes and then add the new one */
						if ( iStripes !== 0 )
						{
							var sStripe = oSettings.asStripeClasses[ iRowCount % iStripes ];
							if ( aoData._sRowStripe != sStripe )
							{
								$(nRow).removeClass( aoData._sRowStripe ).addClass( sStripe );
								aoData._sRowStripe = sStripe;
							}
						}

						/* Row callback functions - might want to manipulate the row */
						_fnCallbackFire( oSettings, 'aoRowCallback', null,
							[nRow, oSettings.aoData[ oSettings.aiDisplay[j] ]._aData, iRowCount, j] );

						anRows.push( nRow );
						iRowCount++;

						/* If there is an open row - and it is attached to this parent - attach it on redraw */
						if ( iOpenRows !== 0 )
						{
							for ( var k=0 ; k<iOpenRows ; k++ )
							{
								if ( nRow == oSettings.aoOpenRows[k].nParent )
								{
									anRows.push( oSettings.aoOpenRows[k].nTr );
									break;
								}
							}
						}
					}
				}
				else
				{
					/* Table is empty - create a row with an empty message in it */
					anRows[ 0 ] = document.createElement( 'tr' );

					if ( oSettings.asStripeClasses[0] )
					{
						anRows[ 0 ].className = oSettings.asStripeClasses[0];
					}

					var oLang = oSettings.oLanguage;
					var sZero = oLang.sZeroRecords;
					if ( oSettings.iDraw == 1 && oSettings.sAjaxSource !== null && !oSettings.oFeatures.bServerSide )
					{
						sZero = oLang.sLoadingRecords;
					}
					else if ( oLang.sEmptyTable && oSettings.fnRecordsTotal() === 0 )
					{
						sZero = oLang.sEmptyTable;
					}

					var nTd = document.createElement( 'td' );
					nTd.setAttribute( 'valign', "top" );
					nTd.colSpan = _fnVisbleColumns( oSettings );
					nTd.className = oSettings.oClasses.sRowEmpty;
					nTd.innerHTML = _fnInfoMacros( oSettings, sZero );

					anRows[ iRowCount ].appendChild( nTd );
				}

				/* Header and footer callbacks */
				_fnCallbackFire( oSettings, 'aoHeaderCallback', 'header', [ $(oSettings.nTHead).children('tr')[0],
					_fnGetDataMaster( oSettings ), oSettings._iDisplayStart, oSettings.fnDisplayEnd(), oSettings.aiDisplay ] );

				_fnCallbackFire( oSettings, 'aoFooterCallback', 'footer', [ $(oSettings.nTFoot).children('tr')[0],
					_fnGetDataMaster( oSettings ), oSettings._iDisplayStart, oSettings.fnDisplayEnd(), oSettings.aiDisplay ] );

				/* 
				 * Need to remove any old row from the display - note we can't just empty the tbody using
				 * $().html('') since this will unbind the jQuery event handlers (even although the node 
				 * still exists!) - equally we can't use innerHTML, since IE throws an exception.
				 */
				var
					nAddFrag = document.createDocumentFragment(),
					nRemoveFrag = document.createDocumentFragment(),
					nBodyPar, nTrs;

				if ( oSettings.nTBody )
				{
					nBodyPar = oSettings.nTBody.parentNode;
					nRemoveFrag.appendChild( oSettings.nTBody );

					/* When doing infinite scrolling, only remove child rows when sorting, filtering or start
					 * up. When not infinite scroll, always do it.
					 */
					if ( !oSettings.oScroll.bInfinite || !oSettings._bInitComplete ||
						oSettings.bSorted || oSettings.bFiltered )
					{
						while( (n = oSettings.nTBody.firstChild) )
						{
							oSettings.nTBody.removeChild( n );
						}
					}

					/* Put the draw table into the dom */
					for ( i=0, iLen=anRows.length ; i<iLen ; i++ )
					{
						nAddFrag.appendChild( anRows[i] );
					}

					oSettings.nTBody.appendChild( nAddFrag );
					if ( nBodyPar !== null )
					{
						nBodyPar.appendChild( oSettings.nTBody );
					}
				}

				/* Call all required callback functions for the end of a draw */
				_fnCallbackFire( oSettings, 'aoDrawCallback', 'draw', [oSettings] );

				/* Draw is complete, sorting and filtering must be as well */
				oSettings.bSorted = false;
				oSettings.bFiltered = false;
				oSettings.bDrawing = false;

				if ( oSettings.oFeatures.bServerSide )
				{
					_fnProcessingDisplay( oSettings, false );
					if ( !oSettings._bInitComplete )
					{
						_fnInitComplete( oSettings );
					}
				}
			}


			/**
			 * Redraw the table - taking account of the various features which are enabled
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnReDraw( oSettings )
			{
				if ( oSettings.oFeatures.bSort )
				{
					/* Sorting will refilter and draw for us */
					_fnSort( oSettings, oSettings.oPreviousSearch );
				}
				else if ( oSettings.oFeatures.bFilter )
				{
					/* Filtering will redraw for us */
					_fnFilterComplete( oSettings, oSettings.oPreviousSearch );
				}
				else
				{
					_fnCalculateEnd( oSettings );
					_fnDraw( oSettings );
				}
			}


			/**
			 * Add the options to the page HTML for the table
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnAddOptionsHtml ( oSettings )
			{
				/*
				 * Create a temporary, empty, div which we can later on replace with what we have generated
				 * we do it this way to rendering the 'options' html offline - speed :-)
				 */
				var nHolding = $('<div></div>')[0];
				oSettings.nTable.parentNode.insertBefore( nHolding, oSettings.nTable );

				/* 
				 * All DataTables are wrapped in a div
				 */
				oSettings.nTableWrapper = $('<div id="'+oSettings.sTableId+'_wrapper" class="'+oSettings.oClasses.sWrapper+'" role="grid"></div>')[0];
				oSettings.nTableReinsertBefore = oSettings.nTable.nextSibling;

				/* Track where we want to insert the option */
				var nInsertNode = oSettings.nTableWrapper;

				/* Loop over the user set positioning and place the elements as needed */
				var aDom = oSettings.sDom.split('');
				var nTmp, iPushFeature, cOption, nNewNode, cNext, sAttr, j;
				for ( var i=0 ; i<aDom.length ; i++ )
				{
					iPushFeature = 0;
					cOption = aDom[i];

					if ( cOption == '<' )
					{
						/* New container div */
						nNewNode = $('<div></div>')[0];

						/* Check to see if we should append an id and/or a class name to the container */
						cNext = aDom[i+1];
						if ( cNext == "'" || cNext == '"' )
						{
							sAttr = "";
							j = 2;
							while ( aDom[i+j] != cNext )
							{
								sAttr += aDom[i+j];
								j++;
							}

							/* Replace jQuery UI constants */
							if ( sAttr == "H" )
							{
								sAttr = oSettings.oClasses.sJUIHeader;
							}
							else if ( sAttr == "F" )
							{
								sAttr = oSettings.oClasses.sJUIFooter;
							}

							/* The attribute can be in the format of "#id.class", "#id" or "class" This logic
							 * breaks the string into parts and applies them as needed
							 */
							if ( sAttr.indexOf('.') != -1 )
							{
								var aSplit = sAttr.split('.');
								nNewNode.id = aSplit[0].substr(1, aSplit[0].length-1);
								nNewNode.className = aSplit[1];
							}
							else if ( sAttr.charAt(0) == "#" )
							{
								nNewNode.id = sAttr.substr(1, sAttr.length-1);
							}
							else
							{
								nNewNode.className = sAttr;
							}

							i += j; /* Move along the position array */
						}

						nInsertNode.appendChild( nNewNode );
						nInsertNode = nNewNode;
					}
					else if ( cOption == '>' )
					{
						/* End container div */
						nInsertNode = nInsertNode.parentNode;
					}
					else if ( cOption == 'l' && oSettings.oFeatures.bPaginate && oSettings.oFeatures.bLengthChange )
					{
						/* Length */
						nTmp = _fnFeatureHtmlLength( oSettings );
						iPushFeature = 1;
					}
					else if ( cOption == 'f' && oSettings.oFeatures.bFilter )
					{
						/* Filter */
						nTmp = _fnFeatureHtmlFilter( oSettings );
						iPushFeature = 1;
					}
					else if ( cOption == 'r' && oSettings.oFeatures.bProcessing )
					{
						/* pRocessing */
						nTmp = _fnFeatureHtmlProcessing( oSettings );
						iPushFeature = 1;
					}
					else if ( cOption == 't' )
					{
						/* Table */
						nTmp = _fnFeatureHtmlTable( oSettings );
						iPushFeature = 1;
					}
					else if ( cOption ==  'i' && oSettings.oFeatures.bInfo )
					{
						/* Info */
						nTmp = _fnFeatureHtmlInfo( oSettings );
						iPushFeature = 1;
					}
					else if ( cOption == 'p' && oSettings.oFeatures.bPaginate )
					{
						/* Pagination */
						nTmp = _fnFeatureHtmlPaginate( oSettings );
						iPushFeature = 1;
					}
					else if ( DataTable.ext.aoFeatures.length !== 0 )
					{
						/* Plug-in features */
						var aoFeatures = DataTable.ext.aoFeatures;
						for ( var k=0, kLen=aoFeatures.length ; k<kLen ; k++ )
						{
							if ( cOption == aoFeatures[k].cFeature )
							{
								nTmp = aoFeatures[k].fnInit( oSettings );
								if ( nTmp )
								{
									iPushFeature = 1;
								}
								break;
							}
						}
					}

					/* Add to the 2D features array */
					if ( iPushFeature == 1 && nTmp !== null )
					{
						if ( typeof oSettings.aanFeatures[cOption] !== 'object' )
						{
							oSettings.aanFeatures[cOption] = [];
						}
						oSettings.aanFeatures[cOption].push( nTmp );
						nInsertNode.appendChild( nTmp );
					}
				}

				/* Built our DOM structure - replace the holding div with what we want */
				nHolding.parentNode.replaceChild( oSettings.nTableWrapper, nHolding );
			}


			/**
			 * Use the DOM source to create up an array of header cells. The idea here is to
			 * create a layout grid (array) of rows x columns, which contains a reference
			 * to the cell that that point in the grid (regardless of col/rowspan), such that
			 * any column / row could be removed and the new grid constructed
			 *  @param array {object} aLayout Array to store the calculated layout in
			 *  @param {node} nThead The header/footer element for the table
			 *  @memberof DataTable#oApi
			 */
			function _fnDetectHeader ( aLayout, nThead )
			{
				var nTrs = $(nThead).children('tr');
				var nTr, nCell;
				var i, k, l, iLen, jLen, iColShifted, iColumn, iColspan, iRowspan;
				var bUnique;
				var fnShiftCol = function ( a, i, j ) {
					var k = a[i];
					while ( k[j] ) {
						j++;
					}
					return j;
				};

				aLayout.splice( 0, aLayout.length );

				/* We know how many rows there are in the layout - so prep it */
				for ( i=0, iLen=nTrs.length ; i<iLen ; i++ )
				{
					aLayout.push( [] );
				}

				/* Calculate a layout array */
				for ( i=0, iLen=nTrs.length ; i<iLen ; i++ )
				{
					nTr = nTrs[i];
					iColumn = 0;

					/* For every cell in the row... */
					nCell = nTr.firstChild;
					while ( nCell ) {
						if ( nCell.nodeName.toUpperCase() == "TD" ||
							nCell.nodeName.toUpperCase() == "TH" )
						{
							/* Get the col and rowspan attributes from the DOM and sanitise them */
							iColspan = nCell.getAttribute('colspan') * 1;
							iRowspan = nCell.getAttribute('rowspan') * 1;
							iColspan = (!iColspan || iColspan===0 || iColspan===1) ? 1 : iColspan;
							iRowspan = (!iRowspan || iRowspan===0 || iRowspan===1) ? 1 : iRowspan;

							/* There might be colspan cells already in this row, so shift our target 
							 * accordingly
							 */
							iColShifted = fnShiftCol( aLayout, i, iColumn );

							/* Cache calculation for unique columns */
							bUnique = iColspan === 1 ? true : false;

							/* If there is col / rowspan, copy the information into the layout grid */
							for ( l=0 ; l<iColspan ; l++ )
							{
								for ( k=0 ; k<iRowspan ; k++ )
								{
									aLayout[i+k][iColShifted+l] = {
										"cell": nCell,
										"unique": bUnique
									};
									aLayout[i+k].nTr = nTr;
								}
							}
						}
						nCell = nCell.nextSibling;
					}
				}
			}


			/**
			 * Get an array of unique th elements, one for each column
			 *  @param {object} oSettings dataTables settings object
			 *  @param {node} nHeader automatically detect the layout from this node - optional
			 *  @param {array} aLayout thead/tfoot layout from _fnDetectHeader - optional
			 *  @returns array {node} aReturn list of unique th's
			 *  @memberof DataTable#oApi
			 */
			function _fnGetUniqueThs ( oSettings, nHeader, aLayout )
			{
				var aReturn = [];
				if ( !aLayout )
				{
					aLayout = oSettings.aoHeader;
					if ( nHeader )
					{
						aLayout = [];
						_fnDetectHeader( aLayout, nHeader );
					}
				}

				for ( var i=0, iLen=aLayout.length ; i<iLen ; i++ )
				{
					for ( var j=0, jLen=aLayout[i].length ; j<jLen ; j++ )
					{
						if ( aLayout[i][j].unique &&
							(!aReturn[j] || !oSettings.bSortCellsTop) )
						{
							aReturn[j] = aLayout[i][j].cell;
						}
					}
				}

				return aReturn;
			}



			/**
			 * Update the table using an Ajax call
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {boolean} Block the table drawing or not
			 *  @memberof DataTable#oApi
			 */
			function _fnAjaxUpdate( oSettings )
			{
				if ( oSettings.bAjaxDataGet )
				{
					oSettings.iDraw++;
					_fnProcessingDisplay( oSettings, true );
					var iColumns = oSettings.aoColumns.length;
					var aoData = _fnAjaxParameters( oSettings );
					_fnServerParams( oSettings, aoData );

					oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aoData,
						function(json) {
							_fnAjaxUpdateDraw( oSettings, json );
						}, oSettings );
					return false;
				}
				else
				{
					return true;
				}
			}


			/**
			 * Build up the parameters in an object needed for a server-side processing request
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {bool} block the table drawing or not
			 *  @memberof DataTable#oApi
			 */
			function _fnAjaxParameters( oSettings )
			{
				var iColumns = oSettings.aoColumns.length;
				var aoData = [], mDataProp, aaSort, aDataSort;
				var i, j;

				aoData.push( { "name": "sEcho",          "value": oSettings.iDraw } );
				aoData.push( { "name": "iColumns",       "value": iColumns } );
				aoData.push( { "name": "sColumns",       "value": _fnColumnOrdering(oSettings) } );
				aoData.push( { "name": "iDisplayStart",  "value": oSettings._iDisplayStart } );
				aoData.push( { "name": "iDisplayLength", "value": oSettings.oFeatures.bPaginate !== false ?
					oSettings._iDisplayLength : -1 } );

				for ( i=0 ; i<iColumns ; i++ )
				{
					mDataProp = oSettings.aoColumns[i].mData;
					aoData.push( { "name": "mDataProp_"+i, "value": typeof(mDataProp)==="function" ? 'function' : mDataProp } );
				}

				/* Filtering */
				if ( oSettings.oFeatures.bFilter !== false )
				{
					aoData.push( { "name": "sSearch", "value": oSettings.oPreviousSearch.sSearch } );
					aoData.push( { "name": "bRegex",  "value": oSettings.oPreviousSearch.bRegex } );
					for ( i=0 ; i<iColumns ; i++ )
					{
						aoData.push( { "name": "sSearch_"+i,     "value": oSettings.aoPreSearchCols[i].sSearch } );
						aoData.push( { "name": "bRegex_"+i,      "value": oSettings.aoPreSearchCols[i].bRegex } );
						aoData.push( { "name": "bSearchable_"+i, "value": oSettings.aoColumns[i].bSearchable } );
					}
				}

				/* Sorting */
				if ( oSettings.oFeatures.bSort !== false )
				{
					var iCounter = 0;

					aaSort = ( oSettings.aaSortingFixed !== null ) ?
						oSettings.aaSortingFixed.concat( oSettings.aaSorting ) :
						oSettings.aaSorting.slice();

					for ( i=0 ; i<aaSort.length ; i++ )
					{
						aDataSort = oSettings.aoColumns[ aaSort[i][0] ].aDataSort;

						for ( j=0 ; j<aDataSort.length ; j++ )
						{
							aoData.push( { "name": "iSortCol_"+iCounter,  "value": aDataSort[j] } );
							aoData.push( { "name": "sSortDir_"+iCounter,  "value": aaSort[i][1] } );
							iCounter++;
						}
					}
					aoData.push( { "name": "iSortingCols",   "value": iCounter } );

					for ( i=0 ; i<iColumns ; i++ )
					{
						aoData.push( { "name": "bSortable_"+i,  "value": oSettings.aoColumns[i].bSortable } );
					}
				}

				return aoData;
			}


			/**
			 * Add Ajax parameters from plug-ins
			 *  @param {object} oSettings dataTables settings object
			 *  @param array {objects} aoData name/value pairs to send to the server
			 *  @memberof DataTable#oApi
			 */
			function _fnServerParams( oSettings, aoData )
			{
				_fnCallbackFire( oSettings, 'aoServerParams', 'serverParams', [aoData] );
			}


			/**
			 * Data the data from the server (nuking the old) and redraw the table
			 *  @param {object} oSettings dataTables settings object
			 *  @param {object} json json data return from the server.
			 *  @param {string} json.sEcho Tracking flag for DataTables to match requests
			 *  @param {int} json.iTotalRecords Number of records in the data set, not accounting for filtering
			 *  @param {int} json.iTotalDisplayRecords Number of records in the data set, accounting for filtering
			 *  @param {array} json.aaData The data to display on this page
			 *  @param {string} [json.sColumns] Column ordering (sName, comma separated)
			 *  @memberof DataTable#oApi
			 */
			function _fnAjaxUpdateDraw ( oSettings, json )
			{
				if ( json.sEcho !== undefined )
				{
					/* Protect against old returns over-writing a new one. Possible when you get
					 * very fast interaction, and later queries are completed much faster
					 */
					if ( json.sEcho*1 < oSettings.iDraw )
					{
						return;
					}
					else
					{
						oSettings.iDraw = json.sEcho * 1;
					}
				}

				if ( !oSettings.oScroll.bInfinite ||
					(oSettings.oScroll.bInfinite && (oSettings.bSorted || oSettings.bFiltered)) )
				{
					_fnClearTable( oSettings );
				}
				oSettings._iRecordsTotal = parseInt(json.iTotalRecords, 10);
				oSettings._iRecordsDisplay = parseInt(json.iTotalDisplayRecords, 10);

				/* Determine if reordering is required */
				var sOrdering = _fnColumnOrdering(oSettings);
				var bReOrder = (json.sColumns !== undefined && sOrdering !== "" && json.sColumns != sOrdering );
				var aiIndex;
				if ( bReOrder )
				{
					aiIndex = _fnReOrderIndex( oSettings, json.sColumns );
				}

				var aData = _fnGetObjectDataFn( oSettings.sAjaxDataProp )( json );
				for ( var i=0, iLen=aData.length ; i<iLen ; i++ )
				{
					if ( bReOrder )
					{
						/* If we need to re-order, then create a new array with the correct order and add it */
						var aDataSorted = [];
						for ( var j=0, jLen=oSettings.aoColumns.length ; j<jLen ; j++ )
						{
							aDataSorted.push( aData[i][ aiIndex[j] ] );
						}
						_fnAddData( oSettings, aDataSorted );
					}
					else
					{
						/* No re-order required, sever got it "right" - just straight add */
						_fnAddData( oSettings, aData[i] );
					}
				}
				oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

				oSettings.bAjaxDataGet = false;
				_fnDraw( oSettings );
				oSettings.bAjaxDataGet = true;
				_fnProcessingDisplay( oSettings, false );
			}



			/**
			 * Generate the node required for filtering text
			 *  @returns {node} Filter control element
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnFeatureHtmlFilter ( oSettings )
			{
				var oPreviousSearch = oSettings.oPreviousSearch;

				var sSearchStr = oSettings.oLanguage.sSearch;
				sSearchStr = (sSearchStr.indexOf('_INPUT_') !== -1) ?
					sSearchStr.replace('_INPUT_', '<input type="text" />') :
					sSearchStr==="" ? '<input type="text" />' : sSearchStr+' <input type="text" />';

				var nFilter = document.createElement( 'div' );
				nFilter.className = oSettings.oClasses.sFilter;
				nFilter.innerHTML = '<label>'+sSearchStr+'</label>';
				if ( !oSettings.aanFeatures.f )
				{
					nFilter.id = oSettings.sTableId+'_filter';
				}

				var jqFilter = $('input[type="text"]', nFilter);

				// Store a reference to the input element, so other input elements could be
				// added to the filter wrapper if needed (submit button for example)
				nFilter._DT_Input = jqFilter[0];

				jqFilter.val( oPreviousSearch.sSearch.replace('"','&quot;') );
				jqFilter.bind( 'keyup.DT', function(e) {
					/* Update all other filter input elements for the new display */
					var n = oSettings.aanFeatures.f;
					var val = this.value==="" ? "" : this.value; // mental IE8 fix :-(

					for ( var i=0, iLen=n.length ; i<iLen ; i++ )
					{
						if ( n[i] != $(this).parents('div.dataTables_filter')[0] )
						{
							$(n[i]._DT_Input).val( val );
						}
					}

					/* Now do the filter */
					if ( val != oPreviousSearch.sSearch )
					{
						_fnFilterComplete( oSettings, {
							"sSearch": val,
							"bRegex": oPreviousSearch.bRegex,
							"bSmart": oPreviousSearch.bSmart ,
							"bCaseInsensitive": oPreviousSearch.bCaseInsensitive
						} );
					}
				} );

				jqFilter
					.attr('aria-controls', oSettings.sTableId)
					.bind( 'keypress.DT', function(e) {
						/* Prevent form submission */
						if ( e.keyCode == 13 )
						{
							return false;
						}
					}
				);

				return nFilter;
			}


			/**
			 * Filter the table using both the global filter and column based filtering
			 *  @param {object} oSettings dataTables settings object
			 *  @param {object} oSearch search information
			 *  @param {int} [iForce] force a research of the master array (1) or not (undefined or 0)
			 *  @memberof DataTable#oApi
			 */
			function _fnFilterComplete ( oSettings, oInput, iForce )
			{
				var oPrevSearch = oSettings.oPreviousSearch;
				var aoPrevSearch = oSettings.aoPreSearchCols;
				var fnSaveFilter = function ( oFilter ) {
					/* Save the filtering values */
					oPrevSearch.sSearch = oFilter.sSearch;
					oPrevSearch.bRegex = oFilter.bRegex;
					oPrevSearch.bSmart = oFilter.bSmart;
					oPrevSearch.bCaseInsensitive = oFilter.bCaseInsensitive;
				};

				/* In server-side processing all filtering is done by the server, so no point hanging around here */
				if ( !oSettings.oFeatures.bServerSide )
				{
					/* Global filter */
					_fnFilter( oSettings, oInput.sSearch, iForce, oInput.bRegex, oInput.bSmart, oInput.bCaseInsensitive );
					fnSaveFilter( oInput );

					/* Now do the individual column filter */
					for ( var i=0 ; i<oSettings.aoPreSearchCols.length ; i++ )
					{
						_fnFilterColumn( oSettings, aoPrevSearch[i].sSearch, i, aoPrevSearch[i].bRegex,
							aoPrevSearch[i].bSmart, aoPrevSearch[i].bCaseInsensitive );
					}

					/* Custom filtering */
					_fnFilterCustom( oSettings );
				}
				else
				{
					fnSaveFilter( oInput );
				}

				/* Tell the draw function we have been filtering */
				oSettings.bFiltered = true;
				$(oSettings.oInstance).trigger('filter', oSettings);

				/* Redraw the table */
				oSettings._iDisplayStart = 0;
				_fnCalculateEnd( oSettings );
				_fnDraw( oSettings );

				/* Rebuild search array 'offline' */
				_fnBuildSearchArray( oSettings, 0 );
			}


			/**
			 * Apply custom filtering functions
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnFilterCustom( oSettings )
			{
				var afnFilters = DataTable.ext.afnFiltering;
				var aiFilterColumns = _fnGetColumns( oSettings, 'bSearchable' );

				for ( var i=0, iLen=afnFilters.length ; i<iLen ; i++ )
				{
					var iCorrector = 0;
					for ( var j=0, jLen=oSettings.aiDisplay.length ; j<jLen ; j++ )
					{
						var iDisIndex = oSettings.aiDisplay[j-iCorrector];
						var bTest = afnFilters[i](
							oSettings,
							_fnGetRowData( oSettings, iDisIndex, 'filter', aiFilterColumns ),
							iDisIndex
						);

						/* Check if we should use this row based on the filtering function */
						if ( !bTest )
						{
							oSettings.aiDisplay.splice( j-iCorrector, 1 );
							iCorrector++;
						}
					}
				}
			}


			/**
			 * Filter the table on a per-column basis
			 *  @param {object} oSettings dataTables settings object
			 *  @param {string} sInput string to filter on
			 *  @param {int} iColumn column to filter
			 *  @param {bool} bRegex treat search string as a regular expression or not
			 *  @param {bool} bSmart use smart filtering or not
			 *  @param {bool} bCaseInsensitive Do case insenstive matching or not
			 *  @memberof DataTable#oApi
			 */
			function _fnFilterColumn ( oSettings, sInput, iColumn, bRegex, bSmart, bCaseInsensitive )
			{
				if ( sInput === "" )
				{
					return;
				}

				var iIndexCorrector = 0;
				var rpSearch = _fnFilterCreateSearch( sInput, bRegex, bSmart, bCaseInsensitive );

				for ( var i=oSettings.aiDisplay.length-1 ; i>=0 ; i-- )
				{
					var sData = _fnDataToSearch( _fnGetCellData( oSettings, oSettings.aiDisplay[i], iColumn, 'filter' ),
						oSettings.aoColumns[iColumn].sType );
					if ( ! rpSearch.test( sData ) )
					{
						oSettings.aiDisplay.splice( i, 1 );
						iIndexCorrector++;
					}
				}
			}


			/**
			 * Filter the data table based on user input and draw the table
			 *  @param {object} oSettings dataTables settings object
			 *  @param {string} sInput string to filter on
			 *  @param {int} iForce optional - force a research of the master array (1) or not (undefined or 0)
			 *  @param {bool} bRegex treat as a regular expression or not
			 *  @param {bool} bSmart perform smart filtering or not
			 *  @param {bool} bCaseInsensitive Do case insenstive matching or not
			 *  @memberof DataTable#oApi
			 */
			function _fnFilter( oSettings, sInput, iForce, bRegex, bSmart, bCaseInsensitive )
			{
				var i;
				var rpSearch = _fnFilterCreateSearch( sInput, bRegex, bSmart, bCaseInsensitive );
				var oPrevSearch = oSettings.oPreviousSearch;

				/* Check if we are forcing or not - optional parameter */
				if ( !iForce )
				{
					iForce = 0;
				}

				/* Need to take account of custom filtering functions - always filter */
				if ( DataTable.ext.afnFiltering.length !== 0 )
				{
					iForce = 1;
				}

				/*
				 * If the input is blank - we want the full data set
				 */
				if ( sInput.length <= 0 )
				{
					oSettings.aiDisplay.splice( 0, oSettings.aiDisplay.length);
					oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
				}
				else
				{
					/*
					 * We are starting a new search or the new search string is smaller 
					 * then the old one (i.e. delete). Search from the master array
					 */
					if ( oSettings.aiDisplay.length == oSettings.aiDisplayMaster.length ||
						oPrevSearch.sSearch.length > sInput.length || iForce == 1 ||
						sInput.indexOf(oPrevSearch.sSearch) !== 0 )
					{
						/* Nuke the old display array - we are going to rebuild it */
						oSettings.aiDisplay.splice( 0, oSettings.aiDisplay.length);

						/* Force a rebuild of the search array */
						_fnBuildSearchArray( oSettings, 1 );

						/* Search through all records to populate the search array
						 * The the oSettings.aiDisplayMaster and asDataSearch arrays have 1 to 1 
						 * mapping
						 */
						for ( i=0 ; i<oSettings.aiDisplayMaster.length ; i++ )
						{
							if ( rpSearch.test(oSettings.asDataSearch[i]) )
							{
								oSettings.aiDisplay.push( oSettings.aiDisplayMaster[i] );
							}
						}
					}
					else
					{
						/* Using old search array - refine it - do it this way for speed
						 * Don't have to search the whole master array again
						 */
						var iIndexCorrector = 0;

						/* Search the current results */
						for ( i=0 ; i<oSettings.asDataSearch.length ; i++ )
						{
							if ( ! rpSearch.test(oSettings.asDataSearch[i]) )
							{
								oSettings.aiDisplay.splice( i-iIndexCorrector, 1 );
								iIndexCorrector++;
							}
						}
					}
				}
			}


			/**
			 * Create an array which can be quickly search through
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iMaster use the master data array - optional
			 *  @memberof DataTable#oApi
			 */
			function _fnBuildSearchArray ( oSettings, iMaster )
			{
				if ( !oSettings.oFeatures.bServerSide )
				{
					/* Clear out the old data */
					oSettings.asDataSearch = [];

					var aiFilterColumns = _fnGetColumns( oSettings, 'bSearchable' );
					var aiIndex = (iMaster===1) ?
						oSettings.aiDisplayMaster :
						oSettings.aiDisplay;

					for ( var i=0, iLen=aiIndex.length ; i<iLen ; i++ )
					{
						oSettings.asDataSearch[i] = _fnBuildSearchRow(
							oSettings,
							_fnGetRowData( oSettings, aiIndex[i], 'filter', aiFilterColumns )
						);
					}
				}
			}


			/**
			 * Create a searchable string from a single data row
			 *  @param {object} oSettings dataTables settings object
			 *  @param {array} aData Row data array to use for the data to search
			 *  @memberof DataTable#oApi
			 */
			function _fnBuildSearchRow( oSettings, aData )
			{
				var sSearch = aData.join('  ');

				/* If it looks like there is an HTML entity in the string, attempt to decode it */
				if ( sSearch.indexOf('&') !== -1 )
				{
					sSearch = $('<div>').html(sSearch).text();
				}

				// Strip newline characters
				return sSearch.replace( /[\n\r]/g, " " );
			}

			/**
			 * Build a regular expression object suitable for searching a table
			 *  @param {string} sSearch string to search for
			 *  @param {bool} bRegex treat as a regular expression or not
			 *  @param {bool} bSmart perform smart filtering or not
			 *  @param {bool} bCaseInsensitive Do case insensitive matching or not
			 *  @returns {RegExp} constructed object
			 *  @memberof DataTable#oApi
			 */
			function _fnFilterCreateSearch( sSearch, bRegex, bSmart, bCaseInsensitive )
			{
				var asSearch, sRegExpString;

				if ( bSmart )
				{
					/* Generate the regular expression to use. Something along the lines of:
					 * ^(?=.*?\bone\b)(?=.*?\btwo\b)(?=.*?\bthree\b).*$
					 */
					asSearch = bRegex ? sSearch.split( ' ' ) : _fnEscapeRegex( sSearch ).split( ' ' );
					sRegExpString = '^(?=.*?'+asSearch.join( ')(?=.*?' )+').*$';
					return new RegExp( sRegExpString, bCaseInsensitive ? "i" : "" );
				}
				else
				{
					sSearch = bRegex ? sSearch : _fnEscapeRegex( sSearch );
					return new RegExp( sSearch, bCaseInsensitive ? "i" : "" );
				}
			}


			/**
			 * Convert raw data into something that the user can search on
			 *  @param {string} sData data to be modified
			 *  @param {string} sType data type
			 *  @returns {string} search string
			 *  @memberof DataTable#oApi
			 */
			function _fnDataToSearch ( sData, sType )
			{
				if ( typeof DataTable.ext.ofnSearch[sType] === "function" )
				{
					return DataTable.ext.ofnSearch[sType]( sData );
				}
				else if ( sData === null )
				{
					return '';
				}
				else if ( sType == "html" )
				{
					return sData.replace(/[\r\n]/g," ").replace( /<.*?>/g, "" );
				}
				else if ( typeof sData === "string" )
				{
					return sData.replace(/[\r\n]/g," ");
				}
				return sData;
			}


			/**
			 * scape a string such that it can be used in a regular expression
			 *  @param {string} sVal string to escape
			 *  @returns {string} escaped string
			 *  @memberof DataTable#oApi
			 */
			function _fnEscapeRegex ( sVal )
			{
				var acEscape = [ '/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}', '\\', '$', '^', '-' ];
				var reReplace = new RegExp( '(\\' + acEscape.join('|\\') + ')', 'g' );
				return sVal.replace(reReplace, '\\$1');
			}


			/**
			 * Generate the node required for the info display
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {node} Information element
			 *  @memberof DataTable#oApi
			 */
			function _fnFeatureHtmlInfo ( oSettings )
			{
				var nInfo = document.createElement( 'div' );
				nInfo.className = oSettings.oClasses.sInfo;

				/* Actions that are to be taken once only for this feature */
				if ( !oSettings.aanFeatures.i )
				{
					/* Add draw callback */
					oSettings.aoDrawCallback.push( {
						"fn": _fnUpdateInfo,
						"sName": "information"
					} );

					/* Add id */
					nInfo.id = oSettings.sTableId+'_info';
				}
				oSettings.nTable.setAttribute( 'aria-describedby', oSettings.sTableId+'_info' );

				return nInfo;
			}


			/**
			 * Update the information elements in the display
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnUpdateInfo ( oSettings )
			{
				/* Show information about the table */
				if ( !oSettings.oFeatures.bInfo || oSettings.aanFeatures.i.length === 0 )
				{
					return;
				}

				var
					oLang = oSettings.oLanguage,
					iStart = oSettings._iDisplayStart+1,
					iEnd = oSettings.fnDisplayEnd(),
					iMax = oSettings.fnRecordsTotal(),
					iTotal = oSettings.fnRecordsDisplay(),
					sOut;

				if ( iTotal === 0 )
				{
					/* Empty record set */
					sOut = oLang.sInfoEmpty;
				}
				else {
					/* Normal record set */
					sOut = oLang.sInfo;
				}

				if ( iTotal != iMax )
				{
					/* Record set after filtering */
					sOut += ' ' + oLang.sInfoFiltered;
				}

				// Convert the macros
				sOut += oLang.sInfoPostFix;
				sOut = _fnInfoMacros( oSettings, sOut );

				if ( oLang.fnInfoCallback !== null )
				{
					sOut = oLang.fnInfoCallback.call( oSettings.oInstance,
						oSettings, iStart, iEnd, iMax, iTotal, sOut );
				}

				var n = oSettings.aanFeatures.i;
				for ( var i=0, iLen=n.length ; i<iLen ; i++ )
				{
					$(n[i]).html( sOut );
				}
			}


			function _fnInfoMacros ( oSettings, str )
			{
				var
					iStart = oSettings._iDisplayStart+1,
					sStart = oSettings.fnFormatNumber( iStart ),
					iEnd = oSettings.fnDisplayEnd(),
					sEnd = oSettings.fnFormatNumber( iEnd ),
					iTotal = oSettings.fnRecordsDisplay(),
					sTotal = oSettings.fnFormatNumber( iTotal ),
					iMax = oSettings.fnRecordsTotal(),
					sMax = oSettings.fnFormatNumber( iMax );

				// When infinite scrolling, we are always starting at 1. _iDisplayStart is used only
				// internally
				if ( oSettings.oScroll.bInfinite )
				{
					sStart = oSettings.fnFormatNumber( 1 );
				}

				return str.
					replace(/_START_/g, sStart).
					replace(/_END_/g,   sEnd).
					replace(/_TOTAL_/g, sTotal).
					replace(/_MAX_/g,   sMax);
			}



			/**
			 * Draw the table for the first time, adding all required features
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnInitialise ( oSettings )
			{
				var i, iLen, iAjaxStart=oSettings.iInitDisplayStart;

				/* Ensure that the table data is fully initialised */
				if ( oSettings.bInitialised === false )
				{
					setTimeout( function(){ _fnInitialise( oSettings ); }, 200 );
					return;
				}

				/* Show the display HTML options */
				_fnAddOptionsHtml( oSettings );

				/* Build and draw the header / footer for the table */
				_fnBuildHead( oSettings );
				_fnDrawHead( oSettings, oSettings.aoHeader );
				if ( oSettings.nTFoot )
				{
					_fnDrawHead( oSettings, oSettings.aoFooter );
				}

				/* Okay to show that something is going on now */
				_fnProcessingDisplay( oSettings, true );

				/* Calculate sizes for columns */
				if ( oSettings.oFeatures.bAutoWidth )
				{
					_fnCalculateColumnWidths( oSettings );
				}

				for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					if ( oSettings.aoColumns[i].sWidth !== null )
					{
						oSettings.aoColumns[i].nTh.style.width = _fnStringToCss( oSettings.aoColumns[i].sWidth );
					}
				}

				/* If there is default sorting required - let's do it. The sort function will do the
				 * drawing for us. Otherwise we draw the table regardless of the Ajax source - this allows
				 * the table to look initialised for Ajax sourcing data (show 'loading' message possibly)
				 */
				if ( oSettings.oFeatures.bSort )
				{
					_fnSort( oSettings );
				}
				else if ( oSettings.oFeatures.bFilter )
				{
					_fnFilterComplete( oSettings, oSettings.oPreviousSearch );
				}
				else
				{
					oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
					_fnCalculateEnd( oSettings );
					_fnDraw( oSettings );
				}

				/* if there is an ajax source load the data */
				if ( oSettings.sAjaxSource !== null && !oSettings.oFeatures.bServerSide )
				{
					var aoData = [];
					_fnServerParams( oSettings, aoData );
					oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aoData, function(json) {
						var aData = (oSettings.sAjaxDataProp !== "") ?
							_fnGetObjectDataFn( oSettings.sAjaxDataProp )(json) : json;

						/* Got the data - add it to the table */
						for ( i=0 ; i<aData.length ; i++ )
						{
							_fnAddData( oSettings, aData[i] );
						}

						/* Reset the init display for cookie saving. We've already done a filter, and
						 * therefore cleared it before. So we need to make it appear 'fresh'
						 */
						oSettings.iInitDisplayStart = iAjaxStart;

						if ( oSettings.oFeatures.bSort )
						{
							_fnSort( oSettings );
						}
						else
						{
							oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
							_fnCalculateEnd( oSettings );
							_fnDraw( oSettings );
						}

						_fnProcessingDisplay( oSettings, false );
						_fnInitComplete( oSettings, json );
					}, oSettings );
					return;
				}

				/* Server-side processing initialisation complete is done at the end of _fnDraw */
				if ( !oSettings.oFeatures.bServerSide )
				{
					_fnProcessingDisplay( oSettings, false );
					_fnInitComplete( oSettings );
				}
			}


			/**
			 * Draw the table for the first time, adding all required features
			 *  @param {object} oSettings dataTables settings object
			 *  @param {object} [json] JSON from the server that completed the table, if using Ajax source
			 *    with client-side processing (optional)
			 *  @memberof DataTable#oApi
			 */
			function _fnInitComplete ( oSettings, json )
			{
				oSettings._bInitComplete = true;
				_fnCallbackFire( oSettings, 'aoInitComplete', 'init', [oSettings, json] );
			}


			/**
			 * Language compatibility - when certain options are given, and others aren't, we
			 * need to duplicate the values over, in order to provide backwards compatibility
			 * with older language files.
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnLanguageCompat( oLanguage )
			{
				var oDefaults = DataTable.defaults.oLanguage;

				/* Backwards compatibility - if there is no sEmptyTable given, then use the same as
				 * sZeroRecords - assuming that is given.
				 */
				if ( !oLanguage.sEmptyTable && oLanguage.sZeroRecords &&
					oDefaults.sEmptyTable === "No data available in table" )
				{
					_fnMap( oLanguage, oLanguage, 'sZeroRecords', 'sEmptyTable' );
				}

				/* Likewise with loading records */
				if ( !oLanguage.sLoadingRecords && oLanguage.sZeroRecords &&
					oDefaults.sLoadingRecords === "Loading..." )
				{
					_fnMap( oLanguage, oLanguage, 'sZeroRecords', 'sLoadingRecords' );
				}
			}



			/**
			 * Generate the node required for user display length changing
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {node} Display length feature node
			 *  @memberof DataTable#oApi
			 */
			function _fnFeatureHtmlLength ( oSettings )
			{
				if ( oSettings.oScroll.bInfinite )
				{
					return null;
				}

				/* This can be overruled by not using the _MENU_ var/macro in the language variable */
				var sName = 'name="'+oSettings.sTableId+'_length"';
				var sStdMenu = '<select size="1" '+sName+'>';
				var i, iLen;
				var aLengthMenu = oSettings.aLengthMenu;

				if ( aLengthMenu.length == 2 && typeof aLengthMenu[0] === 'object' &&
					typeof aLengthMenu[1] === 'object' )
				{
					for ( i=0, iLen=aLengthMenu[0].length ; i<iLen ; i++ )
					{
						sStdMenu += '<option value="'+aLengthMenu[0][i]+'">'+aLengthMenu[1][i]+'</option>';
					}
				}
				else
				{
					for ( i=0, iLen=aLengthMenu.length ; i<iLen ; i++ )
					{
						sStdMenu += '<option value="'+aLengthMenu[i]+'">'+aLengthMenu[i]+'</option>';
					}
				}
				sStdMenu += '</select>';

				var nLength = document.createElement( 'div' );
				if ( !oSettings.aanFeatures.l )
				{
					nLength.id = oSettings.sTableId+'_length';
				}
				nLength.className = oSettings.oClasses.sLength;
				nLength.innerHTML = '<label>'+oSettings.oLanguage.sLengthMenu.replace( '_MENU_', sStdMenu )+'</label>';

				/*
				 * Set the length to the current display length - thanks to Andrea Pavlovic for this fix,
				 * and Stefan Skopnik for fixing the fix!
				 */
				$('select option[value="'+oSettings._iDisplayLength+'"]', nLength).attr("selected", true);

				$('select', nLength).bind( 'change.DT', function(e) {
					var iVal = $(this).val();

					/* Update all other length options for the new display */
					var n = oSettings.aanFeatures.l;
					for ( i=0, iLen=n.length ; i<iLen ; i++ )
					{
						if ( n[i] != this.parentNode )
						{
							$('select', n[i]).val( iVal );
						}
					}

					/* Redraw the table */
					oSettings._iDisplayLength = parseInt(iVal, 10);
					_fnCalculateEnd( oSettings );

					/* If we have space to show extra rows (backing up from the end point - then do so */
					if ( oSettings.fnDisplayEnd() == oSettings.fnRecordsDisplay() )
					{
						oSettings._iDisplayStart = oSettings.fnDisplayEnd() - oSettings._iDisplayLength;
						if ( oSettings._iDisplayStart < 0 )
						{
							oSettings._iDisplayStart = 0;
						}
					}

					if ( oSettings._iDisplayLength == -1 )
					{
						oSettings._iDisplayStart = 0;
					}

					_fnDraw( oSettings );
				} );


				$('select', nLength).attr('aria-controls', oSettings.sTableId);

				return nLength;
			}


			/**
			 * Recalculate the end point based on the start point
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnCalculateEnd( oSettings )
			{
				if ( oSettings.oFeatures.bPaginate === false )
				{
					oSettings._iDisplayEnd = oSettings.aiDisplay.length;
				}
				else
				{
					/* Set the end point of the display - based on how many elements there are
					 * still to display
					 */
					if ( oSettings._iDisplayStart + oSettings._iDisplayLength > oSettings.aiDisplay.length ||
						oSettings._iDisplayLength == -1 )
					{
						oSettings._iDisplayEnd = oSettings.aiDisplay.length;
					}
					else
					{
						oSettings._iDisplayEnd = oSettings._iDisplayStart + oSettings._iDisplayLength;
					}
				}
			}



			/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
			 * Note that most of the paging logic is done in 
			 * DataTable.ext.oPagination
			 */

			/**
			 * Generate the node required for default pagination
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {node} Pagination feature node
			 *  @memberof DataTable#oApi
			 */
			function _fnFeatureHtmlPaginate ( oSettings )
			{
				if ( oSettings.oScroll.bInfinite )
				{
					return null;
				}

				var nPaginate = document.createElement( 'div' );
				nPaginate.className = oSettings.oClasses.sPaging+oSettings.sPaginationType;

				DataTable.ext.oPagination[ oSettings.sPaginationType ].fnInit( oSettings, nPaginate,
					function( oSettings ) {
						_fnCalculateEnd( oSettings );
						_fnDraw( oSettings );
					}
				);

				/* Add a draw callback for the pagination on first instance, to update the paging display */
				if ( !oSettings.aanFeatures.p )
				{
					oSettings.aoDrawCallback.push( {
						"fn": function( oSettings ) {
							DataTable.ext.oPagination[ oSettings.sPaginationType ].fnUpdate( oSettings, function( oSettings ) {
								_fnCalculateEnd( oSettings );
								_fnDraw( oSettings );
							} );
						},
						"sName": "pagination"
					} );
				}
				return nPaginate;
			}


			/**
			 * Alter the display settings to change the page
			 *  @param {object} oSettings dataTables settings object
			 *  @param {string|int} mAction Paging action to take: "first", "previous", "next" or "last"
			 *    or page number to jump to (integer)
			 *  @returns {bool} true page has changed, false - no change (no effect) eg 'first' on page 1
			 *  @memberof DataTable#oApi
			 */
			function _fnPageChange ( oSettings, mAction )
			{
				var iOldStart = oSettings._iDisplayStart;

				if ( typeof mAction === "number" )
				{
					oSettings._iDisplayStart = mAction * oSettings._iDisplayLength;
					if ( oSettings._iDisplayStart > oSettings.fnRecordsDisplay() )
					{
						oSettings._iDisplayStart = 0;
					}
				}
				else if ( mAction == "first" )
				{
					oSettings._iDisplayStart = 0;
				}
				else if ( mAction == "previous" )
				{
					oSettings._iDisplayStart = oSettings._iDisplayLength>=0 ?
					oSettings._iDisplayStart - oSettings._iDisplayLength :
						0;

					/* Correct for under-run */
					if ( oSettings._iDisplayStart < 0 )
					{
						oSettings._iDisplayStart = 0;
					}
				}
				else if ( mAction == "next" )
				{
					if ( oSettings._iDisplayLength >= 0 )
					{
						/* Make sure we are not over running the display array */
						if ( oSettings._iDisplayStart + oSettings._iDisplayLength < oSettings.fnRecordsDisplay() )
						{
							oSettings._iDisplayStart += oSettings._iDisplayLength;
						}
					}
					else
					{
						oSettings._iDisplayStart = 0;
					}
				}
				else if ( mAction == "last" )
				{
					if ( oSettings._iDisplayLength >= 0 )
					{
						var iPages = parseInt( (oSettings.fnRecordsDisplay()-1) / oSettings._iDisplayLength, 10 ) + 1;
						oSettings._iDisplayStart = (iPages-1) * oSettings._iDisplayLength;
					}
					else
					{
						oSettings._iDisplayStart = 0;
					}
				}
				else
				{
					_fnLog( oSettings, 0, "Unknown paging action: "+mAction );
				}
				$(oSettings.oInstance).trigger('page', oSettings);

				return iOldStart != oSettings._iDisplayStart;
			}



			/**
			 * Generate the node required for the processing node
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {node} Processing element
			 *  @memberof DataTable#oApi
			 */
			function _fnFeatureHtmlProcessing ( oSettings )
			{
				var nProcessing = document.createElement( 'div' );

				if ( !oSettings.aanFeatures.r )
				{
					nProcessing.id = oSettings.sTableId+'_processing';
				}
				nProcessing.innerHTML = oSettings.oLanguage.sProcessing;
				nProcessing.className = oSettings.oClasses.sProcessing;
				oSettings.nTable.parentNode.insertBefore( nProcessing, oSettings.nTable );

				return nProcessing;
			}


			/**
			 * Display or hide the processing indicator
			 *  @param {object} oSettings dataTables settings object
			 *  @param {bool} bShow Show the processing indicator (true) or not (false)
			 *  @memberof DataTable#oApi
			 */
			function _fnProcessingDisplay ( oSettings, bShow )
			{
				if ( oSettings.oFeatures.bProcessing )
				{
					var an = oSettings.aanFeatures.r;
					for ( var i=0, iLen=an.length ; i<iLen ; i++ )
					{
						an[i].style.visibility = bShow ? "visible" : "hidden";
					}
				}

				$(oSettings.oInstance).trigger('processing', [oSettings, bShow]);
			}

			/**
			 * Add any control elements for the table - specifically scrolling
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {node} Node to add to the DOM
			 *  @memberof DataTable#oApi
			 */
			function _fnFeatureHtmlTable ( oSettings )
			{
				/* Check if scrolling is enabled or not - if not then leave the DOM unaltered */
				if ( oSettings.oScroll.sX === "" && oSettings.oScroll.sY === "" )
				{
					return oSettings.nTable;
				}

				/*
				 * The HTML structure that we want to generate in this function is:
				 *  div - nScroller
				 *    div - nScrollHead
				 *      div - nScrollHeadInner
				 *        table - nScrollHeadTable
				 *          thead - nThead
				 *    div - nScrollBody
				 *      table - oSettings.nTable
				 *        thead - nTheadSize
				 *        tbody - nTbody
				 *    div - nScrollFoot
				 *      div - nScrollFootInner
				 *        table - nScrollFootTable
				 *          tfoot - nTfoot
				 */
				var
					nScroller = document.createElement('div'),
					nScrollHead = document.createElement('div'),
					nScrollHeadInner = document.createElement('div'),
					nScrollBody = document.createElement('div'),
					nScrollFoot = document.createElement('div'),
					nScrollFootInner = document.createElement('div'),
					nScrollHeadTable = oSettings.nTable.cloneNode(false),
					nScrollFootTable = oSettings.nTable.cloneNode(false),
					nThead = oSettings.nTable.getElementsByTagName('thead')[0],
					nTfoot = oSettings.nTable.getElementsByTagName('tfoot').length === 0 ? null :
						oSettings.nTable.getElementsByTagName('tfoot')[0],
					oClasses = oSettings.oClasses;

				nScrollHead.appendChild( nScrollHeadInner );
				nScrollFoot.appendChild( nScrollFootInner );
				nScrollBody.appendChild( oSettings.nTable );
				nScroller.appendChild( nScrollHead );
				nScroller.appendChild( nScrollBody );
				nScrollHeadInner.appendChild( nScrollHeadTable );
				nScrollHeadTable.appendChild( nThead );
				if ( nTfoot !== null )
				{
					nScroller.appendChild( nScrollFoot );
					nScrollFootInner.appendChild( nScrollFootTable );
					nScrollFootTable.appendChild( nTfoot );
				}

				nScroller.className = oClasses.sScrollWrapper;
				nScrollHead.className = oClasses.sScrollHead;
				nScrollHeadInner.className = oClasses.sScrollHeadInner;
				nScrollBody.className = oClasses.sScrollBody;
				nScrollFoot.className = oClasses.sScrollFoot;
				nScrollFootInner.className = oClasses.sScrollFootInner;

				if ( oSettings.oScroll.bAutoCss )
				{
					nScrollHead.style.overflow = "hidden";
					nScrollHead.style.position = "relative";
					nScrollFoot.style.overflow = "hidden";
					nScrollBody.style.overflow = "auto";
				}

				nScrollHead.style.border = "0";
				nScrollHead.style.width = "100%";
				nScrollFoot.style.border = "0";
				nScrollHeadInner.style.width = oSettings.oScroll.sXInner !== "" ?
					oSettings.oScroll.sXInner : "100%"; /* will be overwritten */

				/* Modify attributes to respect the clones */
				nScrollHeadTable.removeAttribute('id');
				nScrollHeadTable.style.marginLeft = "0";
				oSettings.nTable.style.marginLeft = "0";
				if ( nTfoot !== null )
				{
					nScrollFootTable.removeAttribute('id');
					nScrollFootTable.style.marginLeft = "0";
				}

				/* Move caption elements from the body to the header, footer or leave where it is
				 * depending on the configuration. Note that the DTD says there can be only one caption */
				var nCaption = $(oSettings.nTable).children('caption');
				if ( nCaption.length > 0 )
				{
					nCaption = nCaption[0];
					if ( nCaption._captionSide === "top" )
					{
						nScrollHeadTable.appendChild( nCaption );
					}
					else if ( nCaption._captionSide === "bottom" && nTfoot )
					{
						nScrollFootTable.appendChild( nCaption );
					}
				}

				/*
				 * Sizing
				 */
				/* When x-scrolling add the width and a scroller to move the header with the body */
				if ( oSettings.oScroll.sX !== "" )
				{
					nScrollHead.style.width = _fnStringToCss( oSettings.oScroll.sX );
					nScrollBody.style.width = _fnStringToCss( oSettings.oScroll.sX );

					if ( nTfoot !== null )
					{
						nScrollFoot.style.width = _fnStringToCss( oSettings.oScroll.sX );
					}

					/* When the body is scrolled, then we also want to scroll the headers */
					$(nScrollBody).scroll( function (e) {
						nScrollHead.scrollLeft = this.scrollLeft;

						if ( nTfoot !== null )
						{
							nScrollFoot.scrollLeft = this.scrollLeft;
						}
					} );
				}

				/* When yscrolling, add the height */
				if ( oSettings.oScroll.sY !== "" )
				{
					nScrollBody.style.height = _fnStringToCss( oSettings.oScroll.sY );
				}

				/* Redraw - align columns across the tables */
				oSettings.aoDrawCallback.push( {
					"fn": _fnScrollDraw,
					"sName": "scrolling"
				} );

				/* Infinite scrolling event handlers */
				if ( oSettings.oScroll.bInfinite )
				{
					$(nScrollBody).scroll( function() {
						/* Use a blocker to stop scrolling from loading more data while other data is still loading */
						if ( !oSettings.bDrawing && $(this).scrollTop() !== 0 )
						{
							/* Check if we should load the next data set */
							if ( $(this).scrollTop() + $(this).height() >
								$(oSettings.nTable).height() - oSettings.oScroll.iLoadGap )
							{
								/* Only do the redraw if we have to - we might be at the end of the data */
								if ( oSettings.fnDisplayEnd() < oSettings.fnRecordsDisplay() )
								{
									_fnPageChange( oSettings, 'next' );
									_fnCalculateEnd( oSettings );
									_fnDraw( oSettings );
								}
							}
						}
					} );
				}

				oSettings.nScrollHead = nScrollHead;
				oSettings.nScrollFoot = nScrollFoot;

				return nScroller;
			}


			/**
			 * Update the various tables for resizing. It's a bit of a pig this function, but
			 * basically the idea to:
			 *   1. Re-create the table inside the scrolling div
			 *   2. Take live measurements from the DOM
			 *   3. Apply the measurements
			 *   4. Clean up
			 *  @param {object} o dataTables settings object
			 *  @returns {node} Node to add to the DOM
			 *  @memberof DataTable#oApi
			 */
			function _fnScrollDraw ( o )
			{
				var
					nScrollHeadInner = o.nScrollHead.getElementsByTagName('div')[0],
					nScrollHeadTable = nScrollHeadInner.getElementsByTagName('table')[0],
					nScrollBody = o.nTable.parentNode,
					i, iLen, j, jLen, anHeadToSize, anHeadSizers, anFootSizers, anFootToSize, oStyle, iVis,
					nTheadSize, nTfootSize,
					iWidth, aApplied=[], aAppliedFooter=[], iSanityWidth,
					nScrollFootInner = (o.nTFoot !== null) ? o.nScrollFoot.getElementsByTagName('div')[0] : null,
					nScrollFootTable = (o.nTFoot !== null) ? nScrollFootInner.getElementsByTagName('table')[0] : null,
					ie67 = o.oBrowser.bScrollOversize,
					zeroOut = function(nSizer) {
						oStyle = nSizer.style;
						oStyle.paddingTop = "0";
						oStyle.paddingBottom = "0";
						oStyle.borderTopWidth = "0";
						oStyle.borderBottomWidth = "0";
						oStyle.height = 0;
					};

				/*
				 * 1. Re-create the table inside the scrolling div
				 */

				/* Remove the old minimised thead and tfoot elements in the inner table */
				$(o.nTable).children('thead, tfoot').remove();

				/* Clone the current header and footer elements and then place it into the inner table */
				nTheadSize = $(o.nTHead).clone()[0];
				o.nTable.insertBefore( nTheadSize, o.nTable.childNodes[0] );
				anHeadToSize = o.nTHead.getElementsByTagName('tr');
				anHeadSizers = nTheadSize.getElementsByTagName('tr');

				if ( o.nTFoot !== null )
				{
					nTfootSize = $(o.nTFoot).clone()[0];
					o.nTable.insertBefore( nTfootSize, o.nTable.childNodes[1] );
					anFootToSize = o.nTFoot.getElementsByTagName('tr');
					anFootSizers = nTfootSize.getElementsByTagName('tr');
				}

				/*
				 * 2. Take live measurements from the DOM - do not alter the DOM itself!
				 */

				/* Remove old sizing and apply the calculated column widths
				 * Get the unique column headers in the newly created (cloned) header. We want to apply the
				 * calculated sizes to this header
				 */
				if ( o.oScroll.sX === "" )
				{
					nScrollBody.style.width = '100%';
					nScrollHeadInner.parentNode.style.width = '100%';
				}

				var nThs = _fnGetUniqueThs( o, nTheadSize );
				for ( i=0, iLen=nThs.length ; i<iLen ; i++ )
				{
					iVis = _fnVisibleToColumnIndex( o, i );
					nThs[i].style.width = o.aoColumns[iVis].sWidth;
				}

				if ( o.nTFoot !== null )
				{
					_fnApplyToChildren( function(n) {
						n.style.width = "";
					}, anFootSizers );
				}

				// If scroll collapse is enabled, when we put the headers back into the body for sizing, we
				// will end up forcing the scrollbar to appear, making our measurements wrong for when we
				// then hide it (end of this function), so add the header height to the body scroller.
				if ( o.oScroll.bCollapse && o.oScroll.sY !== "" )
				{
					nScrollBody.style.height = (nScrollBody.offsetHeight + o.nTHead.offsetHeight)+"px";
				}

				/* Size the table as a whole */
				iSanityWidth = $(o.nTable).outerWidth();
				if ( o.oScroll.sX === "" )
				{
					/* No x scrolling */
					o.nTable.style.width = "100%";

					/* I know this is rubbish - but IE7 will make the width of the table when 100% include
					 * the scrollbar - which is shouldn't. When there is a scrollbar we need to take this
					 * into account.
					 */
					if ( ie67 && ($('tbody', nScrollBody).height() > nScrollBody.offsetHeight ||
						$(nScrollBody).css('overflow-y') == "scroll")  )
					{
						o.nTable.style.width = _fnStringToCss( $(o.nTable).outerWidth() - o.oScroll.iBarWidth);
					}
				}
				else
				{
					if ( o.oScroll.sXInner !== "" )
					{
						/* x scroll inner has been given - use it */
						o.nTable.style.width = _fnStringToCss(o.oScroll.sXInner);
					}
					else if ( iSanityWidth == $(nScrollBody).width() &&
						$(nScrollBody).height() < $(o.nTable).height() )
					{
						/* There is y-scrolling - try to take account of the y scroll bar */
						o.nTable.style.width = _fnStringToCss( iSanityWidth-o.oScroll.iBarWidth );
						if ( $(o.nTable).outerWidth() > iSanityWidth-o.oScroll.iBarWidth )
						{
							/* Not possible to take account of it */
							o.nTable.style.width = _fnStringToCss( iSanityWidth );
						}
					}
					else
					{
						/* All else fails */
						o.nTable.style.width = _fnStringToCss( iSanityWidth );
					}
				}

				/* Recalculate the sanity width - now that we've applied the required width, before it was
				 * a temporary variable. This is required because the column width calculation is done
				 * before this table DOM is created.
				 */
				iSanityWidth = $(o.nTable).outerWidth();

				/* We want the hidden header to have zero height, so remove padding and borders. Then
				 * set the width based on the real headers
				 */

				// Apply all styles in one pass. Invalidates layout only once because we don't read any 
				// DOM properties.
				_fnApplyToChildren( zeroOut, anHeadSizers );

				// Read all widths in next pass. Forces layout only once because we do not change 
				// any DOM properties.
				_fnApplyToChildren( function(nSizer) {
					aApplied.push( _fnStringToCss( $(nSizer).width() ) );
				}, anHeadSizers );

				// Apply all widths in final pass. Invalidates layout only once because we do not
				// read any DOM properties.
				_fnApplyToChildren( function(nToSize, i) {
					nToSize.style.width = aApplied[i];
				}, anHeadToSize );

				$(anHeadSizers).height(0);

				/* Same again with the footer if we have one */
				if ( o.nTFoot !== null )
				{
					_fnApplyToChildren( zeroOut, anFootSizers );

					_fnApplyToChildren( function(nSizer) {
						aAppliedFooter.push( _fnStringToCss( $(nSizer).width() ) );
					}, anFootSizers );

					_fnApplyToChildren( function(nToSize, i) {
						nToSize.style.width = aAppliedFooter[i];
					}, anFootToSize );

					$(anFootSizers).height(0);
				}

				/*
				 * 3. Apply the measurements
				 */

				/* "Hide" the header and footer that we used for the sizing. We want to also fix their width
				 * to what they currently are
				 */
				_fnApplyToChildren( function(nSizer, i) {
					nSizer.innerHTML = "";
					nSizer.style.width = aApplied[i];
				}, anHeadSizers );

				if ( o.nTFoot !== null )
				{
					_fnApplyToChildren( function(nSizer, i) {
						nSizer.innerHTML = "";
						nSizer.style.width = aAppliedFooter[i];
					}, anFootSizers );
				}

				/* Sanity check that the table is of a sensible width. If not then we are going to get
				 * misalignment - try to prevent this by not allowing the table to shrink below its min width
				 */
				if ( $(o.nTable).outerWidth() < iSanityWidth )
				{
					/* The min width depends upon if we have a vertical scrollbar visible or not */
					var iCorrection = ((nScrollBody.scrollHeight > nScrollBody.offsetHeight ||
					$(nScrollBody).css('overflow-y') == "scroll")) ?
					iSanityWidth+o.oScroll.iBarWidth : iSanityWidth;

					/* IE6/7 are a law unto themselves... */
					if ( ie67 && (nScrollBody.scrollHeight >
						nScrollBody.offsetHeight || $(nScrollBody).css('overflow-y') == "scroll")  )
					{
						o.nTable.style.width = _fnStringToCss( iCorrection-o.oScroll.iBarWidth );
					}

					/* Apply the calculated minimum width to the table wrappers */
					nScrollBody.style.width = _fnStringToCss( iCorrection );
					o.nScrollHead.style.width = _fnStringToCss( iCorrection );

					if ( o.nTFoot !== null )
					{
						o.nScrollFoot.style.width = _fnStringToCss( iCorrection );
					}

					/* And give the user a warning that we've stopped the table getting too small */
					if ( o.oScroll.sX === "" )
					{
						_fnLog( o, 1, "The table cannot fit into the current element which will cause column"+
							" misalignment. The table has been drawn at its minimum possible width." );
					}
					else if ( o.oScroll.sXInner !== "" )
					{
						_fnLog( o, 1, "The table cannot fit into the current element which will cause column"+
							" misalignment. Increase the sScrollXInner value or remove it to allow automatic"+
							" calculation" );
					}
				}
				else
				{
					nScrollBody.style.width = _fnStringToCss( '100%' );
					o.nScrollHead.style.width = _fnStringToCss( '100%' );

					if ( o.nTFoot !== null )
					{
						o.nScrollFoot.style.width = _fnStringToCss( '100%' );
					}
				}


				/*
				 * 4. Clean up
				 */
				if ( o.oScroll.sY === "" )
				{
					/* IE7< puts a vertical scrollbar in place (when it shouldn't be) due to subtracting
					 * the scrollbar height from the visible display, rather than adding it on. We need to
					 * set the height in order to sort this. Don't want to do it in any other browsers.
					 */
					if ( ie67 )
					{
						nScrollBody.style.height = _fnStringToCss( o.nTable.offsetHeight+o.oScroll.iBarWidth );
					}
				}

				if ( o.oScroll.sY !== "" && o.oScroll.bCollapse )
				{
					nScrollBody.style.height = _fnStringToCss( o.oScroll.sY );

					var iExtra = (o.oScroll.sX !== "" && o.nTable.offsetWidth > nScrollBody.offsetWidth) ?
						o.oScroll.iBarWidth : 0;
					if ( o.nTable.offsetHeight < nScrollBody.offsetHeight )
					{
						nScrollBody.style.height = _fnStringToCss( o.nTable.offsetHeight+iExtra );
					}
				}

				/* Finally set the width's of the header and footer tables */
				var iOuterWidth = $(o.nTable).outerWidth();
				nScrollHeadTable.style.width = _fnStringToCss( iOuterWidth );
				nScrollHeadInner.style.width = _fnStringToCss( iOuterWidth );

				// Figure out if there are scrollbar present - if so then we need a the header and footer to
				// provide a bit more space to allow "overflow" scrolling (i.e. past the scrollbar)
				var bScrolling = $(o.nTable).height() > nScrollBody.clientHeight || $(nScrollBody).css('overflow-y') == "scroll";
				nScrollHeadInner.style.paddingRight = bScrolling ? o.oScroll.iBarWidth+"px" : "0px";

				if ( o.nTFoot !== null )
				{
					nScrollFootTable.style.width = _fnStringToCss( iOuterWidth );
					nScrollFootInner.style.width = _fnStringToCss( iOuterWidth );
					nScrollFootInner.style.paddingRight = bScrolling ? o.oScroll.iBarWidth+"px" : "0px";
				}

				/* Adjust the position of the header in case we loose the y-scrollbar */
				$(nScrollBody).scroll();

				/* If sorting or filtering has occurred, jump the scrolling back to the top */
				if ( o.bSorted || o.bFiltered )
				{
					nScrollBody.scrollTop = 0;
				}
			}


			/**
			 * Apply a given function to the display child nodes of an element array (typically
			 * TD children of TR rows
			 *  @param {function} fn Method to apply to the objects
			 *  @param array {nodes} an1 List of elements to look through for display children
			 *  @param array {nodes} an2 Another list (identical structure to the first) - optional
			 *  @memberof DataTable#oApi
			 */
			function _fnApplyToChildren( fn, an1, an2 )
			{
				var index=0, i=0, iLen=an1.length;
				var nNode1, nNode2;

				while ( i < iLen )
				{
					nNode1 = an1[i].firstChild;
					nNode2 = an2 ? an2[i].firstChild : null;
					while ( nNode1 )
					{
						if ( nNode1.nodeType === 1 )
						{
							if ( an2 )
							{
								fn( nNode1, nNode2, index );
							}
							else
							{
								fn( nNode1, index );
							}
							index++;
						}
						nNode1 = nNode1.nextSibling;
						nNode2 = an2 ? nNode2.nextSibling : null;
					}
					i++;
				}
			}

			/**
			 * Convert a CSS unit width to pixels (e.g. 2em)
			 *  @param {string} sWidth width to be converted
			 *  @param {node} nParent parent to get the with for (required for relative widths) - optional
			 *  @returns {int} iWidth width in pixels
			 *  @memberof DataTable#oApi
			 */
			function _fnConvertToWidth ( sWidth, nParent )
			{
				if ( !sWidth || sWidth === null || sWidth === '' )
				{
					return 0;
				}

				if ( !nParent )
				{
					nParent = document.body;
				}

				var iWidth;
				var nTmp = document.createElement( "div" );
				nTmp.style.width = _fnStringToCss( sWidth );

				nParent.appendChild( nTmp );
				iWidth = nTmp.offsetWidth;
				nParent.removeChild( nTmp );

				return ( iWidth );
			}


			/**
			 * Calculate the width of columns for the table
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnCalculateColumnWidths ( oSettings )
			{
				var iTableWidth = oSettings.nTable.offsetWidth;
				var iUserInputs = 0;
				var iTmpWidth;
				var iVisibleColumns = 0;
				var iColums = oSettings.aoColumns.length;
				var i, iIndex, iCorrector, iWidth;
				var oHeaders = $('th', oSettings.nTHead);
				var widthAttr = oSettings.nTable.getAttribute('width');
				var nWrapper = oSettings.nTable.parentNode;

				/* Convert any user input sizes into pixel sizes */
				for ( i=0 ; i<iColums ; i++ )
				{
					if ( oSettings.aoColumns[i].bVisible )
					{
						iVisibleColumns++;

						if ( oSettings.aoColumns[i].sWidth !== null )
						{
							iTmpWidth = _fnConvertToWidth( oSettings.aoColumns[i].sWidthOrig,
								nWrapper );
							if ( iTmpWidth !== null )
							{
								oSettings.aoColumns[i].sWidth = _fnStringToCss( iTmpWidth );
							}

							iUserInputs++;
						}
					}
				}

				/* If the number of columns in the DOM equals the number that we have to process in 
				 * DataTables, then we can use the offsets that are created by the web-browser. No custom 
				 * sizes can be set in order for this to happen, nor scrolling used
				 */
				if ( iColums == oHeaders.length && iUserInputs === 0 && iVisibleColumns == iColums &&
					oSettings.oScroll.sX === "" && oSettings.oScroll.sY === "" )
				{
					for ( i=0 ; i<oSettings.aoColumns.length ; i++ )
					{
						iTmpWidth = $(oHeaders[i]).width();
						if ( iTmpWidth !== null )
						{
							oSettings.aoColumns[i].sWidth = _fnStringToCss( iTmpWidth );
						}
					}
				}
				else
				{
					/* Otherwise we are going to have to do some calculations to get the width of each column.
					 * Construct a 1 row table with the widest node in the data, and any user defined widths,
					 * then insert it into the DOM and allow the browser to do all the hard work of
					 * calculating table widths.
					 */
					var
						nCalcTmp = oSettings.nTable.cloneNode( false ),
						nTheadClone = oSettings.nTHead.cloneNode(true),
						nBody = document.createElement( 'tbody' ),
						nTr = document.createElement( 'tr' ),
						nDivSizing;

					nCalcTmp.removeAttribute( "id" );
					nCalcTmp.appendChild( nTheadClone );
					if ( oSettings.nTFoot !== null )
					{
						nCalcTmp.appendChild( oSettings.nTFoot.cloneNode(true) );
						_fnApplyToChildren( function(n) {
							n.style.width = "";
						}, nCalcTmp.getElementsByTagName('tr') );
					}

					nCalcTmp.appendChild( nBody );
					nBody.appendChild( nTr );

					/* Remove any sizing that was previously applied by the styles */
					var jqColSizing = $('thead th', nCalcTmp);
					if ( jqColSizing.length === 0 )
					{
						jqColSizing = $('tbody tr:eq(0)>td', nCalcTmp);
					}

					/* Apply custom sizing to the cloned header */
					var nThs = _fnGetUniqueThs( oSettings, nTheadClone );
					iCorrector = 0;
					for ( i=0 ; i<iColums ; i++ )
					{
						var oColumn = oSettings.aoColumns[i];
						if ( oColumn.bVisible && oColumn.sWidthOrig !== null && oColumn.sWidthOrig !== "" )
						{
							nThs[i-iCorrector].style.width = _fnStringToCss( oColumn.sWidthOrig );
						}
						else if ( oColumn.bVisible )
						{
							nThs[i-iCorrector].style.width = "";
						}
						else
						{
							iCorrector++;
						}
					}

					/* Find the biggest td for each column and put it into the table */
					for ( i=0 ; i<iColums ; i++ )
					{
						if ( oSettings.aoColumns[i].bVisible )
						{
							var nTd = _fnGetWidestNode( oSettings, i );
							if ( nTd !== null )
							{
								nTd = nTd.cloneNode(true);
								if ( oSettings.aoColumns[i].sContentPadding !== "" )
								{
									nTd.innerHTML += oSettings.aoColumns[i].sContentPadding;
								}
								nTr.appendChild( nTd );
							}
						}
					}

					/* Build the table and 'display' it */
					nWrapper.appendChild( nCalcTmp );

					/* When scrolling (X or Y) we want to set the width of the table as appropriate. However,
					 * when not scrolling leave the table width as it is. This results in slightly different,
					 * but I think correct behaviour
					 */
					if ( oSettings.oScroll.sX !== "" && oSettings.oScroll.sXInner !== "" )
					{
						nCalcTmp.style.width = _fnStringToCss(oSettings.oScroll.sXInner);
					}
					else if ( oSettings.oScroll.sX !== "" )
					{
						nCalcTmp.style.width = "";
						if ( $(nCalcTmp).width() < nWrapper.offsetWidth )
						{
							nCalcTmp.style.width = _fnStringToCss( nWrapper.offsetWidth );
						}
					}
					else if ( oSettings.oScroll.sY !== "" )
					{
						nCalcTmp.style.width = _fnStringToCss( nWrapper.offsetWidth );
					}
					else if ( widthAttr )
					{
						nCalcTmp.style.width = _fnStringToCss( widthAttr );
					}
					nCalcTmp.style.visibility = "hidden";

					/* Scrolling considerations */
					_fnScrollingWidthAdjust( oSettings, nCalcTmp );

					/* Read the width's calculated by the browser and store them for use by the caller. We
					 * first of all try to use the elements in the body, but it is possible that there are
					 * no elements there, under which circumstances we use the header elements
					 */
					var oNodes = $("tbody tr:eq(0)", nCalcTmp).children();
					if ( oNodes.length === 0 )
					{
						oNodes = _fnGetUniqueThs( oSettings, $('thead', nCalcTmp)[0] );
					}

					/* Browsers need a bit of a hand when a width is assigned to any columns when 
					 * x-scrolling as they tend to collapse the table to the min-width, even if
					 * we sent the column widths. So we need to keep track of what the table width
					 * should be by summing the user given values, and the automatic values
					 */
					if ( oSettings.oScroll.sX !== "" )
					{
						var iTotal = 0;
						iCorrector = 0;
						for ( i=0 ; i<oSettings.aoColumns.length ; i++ )
						{
							if ( oSettings.aoColumns[i].bVisible )
							{
								if ( oSettings.aoColumns[i].sWidthOrig === null )
								{
									iTotal += $(oNodes[iCorrector]).outerWidth();
								}
								else
								{
									iTotal += parseInt(oSettings.aoColumns[i].sWidth.replace('px',''), 10) +
										($(oNodes[iCorrector]).outerWidth() - $(oNodes[iCorrector]).width());
								}
								iCorrector++;
							}
						}

						nCalcTmp.style.width = _fnStringToCss( iTotal );
						oSettings.nTable.style.width = _fnStringToCss( iTotal );
					}

					iCorrector = 0;
					for ( i=0 ; i<oSettings.aoColumns.length ; i++ )
					{
						if ( oSettings.aoColumns[i].bVisible )
						{
							iWidth = $(oNodes[iCorrector]).width();
							if ( iWidth !== null && iWidth > 0 )
							{
								oSettings.aoColumns[i].sWidth = _fnStringToCss( iWidth );
							}
							iCorrector++;
						}
					}

					var cssWidth = $(nCalcTmp).css('width');
					oSettings.nTable.style.width = (cssWidth.indexOf('%') !== -1) ?
						cssWidth : _fnStringToCss( $(nCalcTmp).outerWidth() );
					nCalcTmp.parentNode.removeChild( nCalcTmp );
				}

				if ( widthAttr )
				{
					oSettings.nTable.style.width = _fnStringToCss( widthAttr );
				}
			}


			/**
			 * Adjust a table's width to take account of scrolling
			 *  @param {object} oSettings dataTables settings object
			 *  @param {node} n table node
			 *  @memberof DataTable#oApi
			 */
			function _fnScrollingWidthAdjust ( oSettings, n )
			{
				if ( oSettings.oScroll.sX === "" && oSettings.oScroll.sY !== "" )
				{
					/* When y-scrolling only, we want to remove the width of the scroll bar so the table
					 * + scroll bar will fit into the area avaialble.
					 */
					var iOrigWidth = $(n).width();
					n.style.width = _fnStringToCss( $(n).outerWidth()-oSettings.oScroll.iBarWidth );
				}
				else if ( oSettings.oScroll.sX !== "" )
				{
					/* When x-scrolling both ways, fix the table at it's current size, without adjusting */
					n.style.width = _fnStringToCss( $(n).outerWidth() );
				}
			}


			/**
			 * Get the widest node
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iCol column of interest
			 *  @returns {node} widest table node
			 *  @memberof DataTable#oApi
			 */
			function _fnGetWidestNode( oSettings, iCol )
			{
				var iMaxIndex = _fnGetMaxLenString( oSettings, iCol );
				if ( iMaxIndex < 0 )
				{
					return null;
				}

				if ( oSettings.aoData[iMaxIndex].nTr === null )
				{
					var n = document.createElement('td');
					n.innerHTML = _fnGetCellData( oSettings, iMaxIndex, iCol, '' );
					return n;
				}
				return _fnGetTdNodes(oSettings, iMaxIndex)[iCol];
			}


			/**
			 * Get the maximum strlen for each data column
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iCol column of interest
			 *  @returns {string} max string length for each column
			 *  @memberof DataTable#oApi
			 */
			function _fnGetMaxLenString( oSettings, iCol )
			{
				var iMax = -1;
				var iMaxIndex = -1;

				for ( var i=0 ; i<oSettings.aoData.length ; i++ )
				{
					var s = _fnGetCellData( oSettings, i, iCol, 'display' )+"";
					s = s.replace( /<.*?>/g, "" );
					if ( s.length > iMax )
					{
						iMax = s.length;
						iMaxIndex = i;
					}
				}

				return iMaxIndex;
			}


			/**
			 * Append a CSS unit (only if required) to a string
			 *  @param {array} aArray1 first array
			 *  @param {array} aArray2 second array
			 *  @returns {int} 0 if match, 1 if length is different, 2 if no match
			 *  @memberof DataTable#oApi
			 */
			function _fnStringToCss( s )
			{
				if ( s === null )
				{
					return "0px";
				}

				if ( typeof s == 'number' )
				{
					if ( s < 0 )
					{
						return "0px";
					}
					return s+"px";
				}

				/* Check if the last character is not 0-9 */
				var c = s.charCodeAt( s.length-1 );
				if (c < 0x30 || c > 0x39)
				{
					return s;
				}
				return s+"px";
			}


			/**
			 * Get the width of a scroll bar in this browser being used
			 *  @returns {int} width in pixels
			 *  @memberof DataTable#oApi
			 */
			function _fnScrollBarWidth ()
			{
				var inner = document.createElement('p');
				var style = inner.style;
				style.width = "100%";
				style.height = "200px";
				style.padding = "0px";

				var outer = document.createElement('div');
				style = outer.style;
				style.position = "absolute";
				style.top = "0px";
				style.left = "0px";
				style.visibility = "hidden";
				style.width = "200px";
				style.height = "150px";
				style.padding = "0px";
				style.overflow = "hidden";
				outer.appendChild(inner);

				document.body.appendChild(outer);
				var w1 = inner.offsetWidth;
				outer.style.overflow = 'scroll';
				var w2 = inner.offsetWidth;
				if ( w1 == w2 )
				{
					w2 = outer.clientWidth;
				}

				document.body.removeChild(outer);
				return (w1 - w2);
			}

			/**
			 * Change the order of the table
			 *  @param {object} oSettings dataTables settings object
			 *  @param {bool} bApplyClasses optional - should we apply classes or not
			 *  @memberof DataTable#oApi
			 */
			function _fnSort ( oSettings, bApplyClasses )
			{
				var
					i, iLen, j, jLen, k, kLen,
					sDataType, nTh,
					aaSort = [],
					aiOrig = [],
					oSort = DataTable.ext.oSort,
					aoData = oSettings.aoData,
					aoColumns = oSettings.aoColumns,
					oAria = oSettings.oLanguage.oAria;

				/* No sorting required if server-side or no sorting array */
				if ( !oSettings.oFeatures.bServerSide &&
					(oSettings.aaSorting.length !== 0 || oSettings.aaSortingFixed !== null) )
				{
					aaSort = ( oSettings.aaSortingFixed !== null ) ?
						oSettings.aaSortingFixed.concat( oSettings.aaSorting ) :
						oSettings.aaSorting.slice();

					/* If there is a sorting data type, and a function belonging to it, then we need to
					 * get the data from the developer's function and apply it for this column
					 */
					for ( i=0 ; i<aaSort.length ; i++ )
					{
						var iColumn = aaSort[i][0];
						var iVisColumn = _fnColumnIndexToVisible( oSettings, iColumn );
						sDataType = oSettings.aoColumns[ iColumn ].sSortDataType;
						if ( DataTable.ext.afnSortData[sDataType] )
						{
							var aData = DataTable.ext.afnSortData[sDataType].call(
								oSettings.oInstance, oSettings, iColumn, iVisColumn
							);
							if ( aData.length === aoData.length )
							{
								for ( j=0, jLen=aoData.length ; j<jLen ; j++ )
								{
									_fnSetCellData( oSettings, j, iColumn, aData[j] );
								}
							}
							else
							{
								_fnLog( oSettings, 0, "Returned data sort array (col "+iColumn+") is the wrong length" );
							}
						}
					}

					/* Create a value - key array of the current row positions such that we can use their
					 * current position during the sort, if values match, in order to perform stable sorting
					 */
					for ( i=0, iLen=oSettings.aiDisplayMaster.length ; i<iLen ; i++ )
					{
						aiOrig[ oSettings.aiDisplayMaster[i] ] = i;
					}

					/* Build an internal data array which is specific to the sort, so we can get and prep
					 * the data to be sorted only once, rather than needing to do it every time the sorting
					 * function runs. This make the sorting function a very simple comparison
					 */
					var iSortLen = aaSort.length;
					var fnSortFormat, aDataSort;
					for ( i=0, iLen=aoData.length ; i<iLen ; i++ )
					{
						for ( j=0 ; j<iSortLen ; j++ )
						{
							aDataSort = aoColumns[ aaSort[j][0] ].aDataSort;

							for ( k=0, kLen=aDataSort.length ; k<kLen ; k++ )
							{
								sDataType = aoColumns[ aDataSort[k] ].sType;
								fnSortFormat = oSort[ (sDataType ? sDataType : 'string')+"-pre" ];

								aoData[i]._aSortData[ aDataSort[k] ] = fnSortFormat ?
									fnSortFormat( _fnGetCellData( oSettings, i, aDataSort[k], 'sort' ) ) :
									_fnGetCellData( oSettings, i, aDataSort[k], 'sort' );
							}
						}
					}

					/* Do the sort - here we want multi-column sorting based on a given data source (column)
					 * and sorting function (from oSort) in a certain direction. It's reasonably complex to
					 * follow on it's own, but this is what we want (example two column sorting):
					 *  fnLocalSorting = function(a,b){
					 *  	var iTest;
					 *  	iTest = oSort['string-asc']('data11', 'data12');
					 *  	if (iTest !== 0)
					 *  		return iTest;
					 *    iTest = oSort['numeric-desc']('data21', 'data22');
					 *    if (iTest !== 0)
					 *  		return iTest;
					 *  	return oSort['numeric-asc']( aiOrig[a], aiOrig[b] );
					 *  }
					 * Basically we have a test for each sorting column, if the data in that column is equal,
					 * test the next column. If all columns match, then we use a numeric sort on the row 
					 * positions in the original data array to provide a stable sort.
					 */
					oSettings.aiDisplayMaster.sort( function ( a, b ) {
						var k, l, lLen, iTest, aDataSort, sDataType;
						for ( k=0 ; k<iSortLen ; k++ )
						{
							aDataSort = aoColumns[ aaSort[k][0] ].aDataSort;

							for ( l=0, lLen=aDataSort.length ; l<lLen ; l++ )
							{
								sDataType = aoColumns[ aDataSort[l] ].sType;

								iTest = oSort[ (sDataType ? sDataType : 'string')+"-"+aaSort[k][1] ](
									aoData[a]._aSortData[ aDataSort[l] ],
									aoData[b]._aSortData[ aDataSort[l] ]
								);

								if ( iTest !== 0 )
								{
									return iTest;
								}
							}
						}

						return oSort['numeric-asc']( aiOrig[a], aiOrig[b] );
					} );
				}

				/* Alter the sorting classes to take account of the changes */
				if ( (bApplyClasses === undefined || bApplyClasses) && !oSettings.oFeatures.bDeferRender )
				{
					_fnSortingClasses( oSettings );
				}

				for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					var sTitle = aoColumns[i].sTitle.replace( /<.*?>/g, "" );
					nTh = aoColumns[i].nTh;
					nTh.removeAttribute('aria-sort');
					nTh.removeAttribute('aria-label');

					/* In ARIA only the first sorting column can be marked as sorting - no multi-sort option */
					if ( aoColumns[i].bSortable )
					{
						if ( aaSort.length > 0 && aaSort[0][0] == i )
						{
							nTh.setAttribute('aria-sort', aaSort[0][1]=="asc" ? "ascending" : "descending" );

							var nextSort = (aoColumns[i].asSorting[ aaSort[0][2]+1 ]) ?
								aoColumns[i].asSorting[ aaSort[0][2]+1 ] : aoColumns[i].asSorting[0];
							nTh.setAttribute('aria-label', sTitle+
								(nextSort=="asc" ? oAria.sSortAscending : oAria.sSortDescending) );
						}
						else
						{
							nTh.setAttribute('aria-label', sTitle+
								(aoColumns[i].asSorting[0]=="asc" ? oAria.sSortAscending : oAria.sSortDescending) );
						}
					}
					else
					{
						nTh.setAttribute('aria-label', sTitle);
					}
				}

				/* Tell the draw function that we have sorted the data */
				oSettings.bSorted = true;
				$(oSettings.oInstance).trigger('sort', oSettings);

				/* Copy the master data into the draw array and re-draw */
				if ( oSettings.oFeatures.bFilter )
				{
					/* _fnFilter() will redraw the table for us */
					_fnFilterComplete( oSettings, oSettings.oPreviousSearch, 1 );
				}
				else
				{
					oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
					oSettings._iDisplayStart = 0; /* reset display back to page 0 */
					_fnCalculateEnd( oSettings );
					_fnDraw( oSettings );
				}
			}


			/**
			 * Attach a sort handler (click) to a node
			 *  @param {object} oSettings dataTables settings object
			 *  @param {node} nNode node to attach the handler to
			 *  @param {int} iDataIndex column sorting index
			 *  @param {function} [fnCallback] callback function
			 *  @memberof DataTable#oApi
			 */
			function _fnSortAttachListener ( oSettings, nNode, iDataIndex, fnCallback )
			{
				_fnBindAction( nNode, {}, function (e) {
					/* If the column is not sortable - don't to anything */
					if ( oSettings.aoColumns[iDataIndex].bSortable === false )
					{
						return;
					}

					/*
					 * This is a little bit odd I admit... I declare a temporary function inside the scope of
					 * _fnBuildHead and the click handler in order that the code presented here can be used 
					 * twice - once for when bProcessing is enabled, and another time for when it is 
					 * disabled, as we need to perform slightly different actions.
					 *   Basically the issue here is that the Javascript engine in modern browsers don't 
					 * appear to allow the rendering engine to update the display while it is still executing
					 * it's thread (well - it does but only after long intervals). This means that the 
					 * 'processing' display doesn't appear for a table sort. To break the js thread up a bit
					 * I force an execution break by using setTimeout - but this breaks the expected 
					 * thread continuation for the end-developer's point of view (their code would execute
					 * too early), so we only do it when we absolutely have to.
					 */
					var fnInnerSorting = function () {
						var iColumn, iNextSort;

						/* If the shift key is pressed then we are multiple column sorting */
						if ( e.shiftKey )
						{
							/* Are we already doing some kind of sort on this column? */
							var bFound = false;
							for ( var i=0 ; i<oSettings.aaSorting.length ; i++ )
							{
								if ( oSettings.aaSorting[i][0] == iDataIndex )
								{
									bFound = true;
									iColumn = oSettings.aaSorting[i][0];
									iNextSort = oSettings.aaSorting[i][2]+1;

									if ( !oSettings.aoColumns[iColumn].asSorting[iNextSort] )
									{
										/* Reached the end of the sorting options, remove from multi-col sort */
										oSettings.aaSorting.splice( i, 1 );
									}
									else
									{
										/* Move onto next sorting direction */
										oSettings.aaSorting[i][1] = oSettings.aoColumns[iColumn].asSorting[iNextSort];
										oSettings.aaSorting[i][2] = iNextSort;
									}
									break;
								}
							}

							/* No sort yet - add it in */
							if ( bFound === false )
							{
								oSettings.aaSorting.push( [ iDataIndex,
									oSettings.aoColumns[iDataIndex].asSorting[0], 0 ] );
							}
						}
						else
						{
							/* If no shift key then single column sort */
							if ( oSettings.aaSorting.length == 1 && oSettings.aaSorting[0][0] == iDataIndex )
							{
								iColumn = oSettings.aaSorting[0][0];
								iNextSort = oSettings.aaSorting[0][2]+1;
								if ( !oSettings.aoColumns[iColumn].asSorting[iNextSort] )
								{
									iNextSort = 0;
								}
								oSettings.aaSorting[0][1] = oSettings.aoColumns[iColumn].asSorting[iNextSort];
								oSettings.aaSorting[0][2] = iNextSort;
							}
							else
							{
								oSettings.aaSorting.splice( 0, oSettings.aaSorting.length );
								oSettings.aaSorting.push( [ iDataIndex,
									oSettings.aoColumns[iDataIndex].asSorting[0], 0 ] );
							}
						}

						/* Run the sort */
						_fnSort( oSettings );
					}; /* /fnInnerSorting */

					if ( !oSettings.oFeatures.bProcessing )
					{
						fnInnerSorting();
					}
					else
					{
						_fnProcessingDisplay( oSettings, true );
						setTimeout( function() {
							fnInnerSorting();
							if ( !oSettings.oFeatures.bServerSide )
							{
								_fnProcessingDisplay( oSettings, false );
							}
						}, 0 );
					}

					/* Call the user specified callback function - used for async user interaction */
					if ( typeof fnCallback == 'function' )
					{
						fnCallback( oSettings );
					}
				} );
			}


			/**
			 * Set the sorting classes on the header, Note: it is safe to call this function
			 * when bSort and bSortClasses are false
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnSortingClasses( oSettings )
			{
				var i, iLen, j, jLen, iFound;
				var aaSort, sClass;
				var iColumns = oSettings.aoColumns.length;
				var oClasses = oSettings.oClasses;

				for ( i=0 ; i<iColumns ; i++ )
				{
					if ( oSettings.aoColumns[i].bSortable )
					{
						$(oSettings.aoColumns[i].nTh).removeClass( oClasses.sSortAsc +" "+ oClasses.sSortDesc +
							" "+ oSettings.aoColumns[i].sSortingClass );
					}
				}

				if ( oSettings.aaSortingFixed !== null )
				{
					aaSort = oSettings.aaSortingFixed.concat( oSettings.aaSorting );
				}
				else
				{
					aaSort = oSettings.aaSorting.slice();
				}

				/* Apply the required classes to the header */
				for ( i=0 ; i<oSettings.aoColumns.length ; i++ )
				{
					if ( oSettings.aoColumns[i].bSortable )
					{
						sClass = oSettings.aoColumns[i].sSortingClass;
						iFound = -1;
						for ( j=0 ; j<aaSort.length ; j++ )
						{
							if ( aaSort[j][0] == i )
							{
								sClass = ( aaSort[j][1] == "asc" ) ?
									oClasses.sSortAsc : oClasses.sSortDesc;
								iFound = j;
								break;
							}
						}
						$(oSettings.aoColumns[i].nTh).addClass( sClass );

						if ( oSettings.bJUI )
						{
							/* jQuery UI uses extra markup */
							var jqSpan = $("span."+oClasses.sSortIcon,  oSettings.aoColumns[i].nTh);
							jqSpan.removeClass(oClasses.sSortJUIAsc +" "+ oClasses.sSortJUIDesc +" "+
								oClasses.sSortJUI +" "+ oClasses.sSortJUIAscAllowed +" "+ oClasses.sSortJUIDescAllowed );

							var sSpanClass;
							if ( iFound == -1 )
							{
								sSpanClass = oSettings.aoColumns[i].sSortingClassJUI;
							}
							else if ( aaSort[iFound][1] == "asc" )
							{
								sSpanClass = oClasses.sSortJUIAsc;
							}
							else
							{
								sSpanClass = oClasses.sSortJUIDesc;
							}

							jqSpan.addClass( sSpanClass );
						}
					}
					else
					{
						/* No sorting on this column, so add the base class. This will have been assigned by
						 * _fnAddColumn
						 */
						$(oSettings.aoColumns[i].nTh).addClass( oSettings.aoColumns[i].sSortingClass );
					}
				}

				/* 
				 * Apply the required classes to the table body
				 * Note that this is given as a feature switch since it can significantly slow down a sort
				 * on large data sets (adding and removing of classes is always slow at the best of times..)
				 * Further to this, note that this code is admittedly fairly ugly. It could be made a lot 
				 * simpler using jQuery selectors and add/removeClass, but that is significantly slower
				 * (on the order of 5 times slower) - hence the direct DOM manipulation here.
				 * Note that for deferred drawing we do use jQuery - the reason being that taking the first
				 * row found to see if the whole column needs processed can miss classes since the first
				 * column might be new.
				 */
				sClass = oClasses.sSortColumn;

				if ( oSettings.oFeatures.bSort && oSettings.oFeatures.bSortClasses )
				{
					var nTds = _fnGetTdNodes( oSettings );

					/* Determine what the sorting class for each column should be */
					var iClass, iTargetCol;
					var asClasses = [];
					for (i = 0; i < iColumns; i++)
					{
						asClasses.push("");
					}
					for (i = 0, iClass = 1; i < aaSort.length; i++)
					{
						iTargetCol = parseInt( aaSort[i][0], 10 );
						asClasses[iTargetCol] = sClass + iClass;

						if ( iClass < 3 )
						{
							iClass++;
						}
					}

					/* Make changes to the classes for each cell as needed */
					var reClass = new RegExp(sClass + "[123]");
					var sTmpClass, sCurrentClass, sNewClass;
					for ( i=0, iLen=nTds.length; i<iLen; i++ )
					{
						/* Determine which column we're looking at */
						iTargetCol = i % iColumns;

						/* What is the full list of classes now */
						sCurrentClass = nTds[i].className;
						/* What sorting class should be applied? */
						sNewClass = asClasses[iTargetCol];
						/* What would the new full list be if we did a replacement? */
						sTmpClass = sCurrentClass.replace(reClass, sNewClass);

						if ( sTmpClass != sCurrentClass )
						{
							/* We changed something */
							nTds[i].className = $.trim( sTmpClass );
						}
						else if ( sNewClass.length > 0 && sCurrentClass.indexOf(sNewClass) == -1 )
						{
							/* We need to add a class */
							nTds[i].className = sCurrentClass + " " + sNewClass;
						}
					}
				}
			}



			/**
			 * Save the state of a table in a cookie such that the page can be reloaded
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnSaveState ( oSettings )
			{
				if ( !oSettings.oFeatures.bStateSave || oSettings.bDestroying )
				{
					return;
				}

				/* Store the interesting variables */
				var i, iLen, bInfinite=oSettings.oScroll.bInfinite;
				var oState = {
					"iCreate":      new Date().getTime(),
					"iStart":       (bInfinite ? 0 : oSettings._iDisplayStart),
					"iEnd":         (bInfinite ? oSettings._iDisplayLength : oSettings._iDisplayEnd),
					"iLength":      oSettings._iDisplayLength,
					"aaSorting":    $.extend( true, [], oSettings.aaSorting ),
					"oSearch":      $.extend( true, {}, oSettings.oPreviousSearch ),
					"aoSearchCols": $.extend( true, [], oSettings.aoPreSearchCols ),
					"abVisCols":    []
				};

				for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
				{
					oState.abVisCols.push( oSettings.aoColumns[i].bVisible );
				}

				_fnCallbackFire( oSettings, "aoStateSaveParams", 'stateSaveParams', [oSettings, oState] );

				oSettings.fnStateSave.call( oSettings.oInstance, oSettings, oState );
			}


			/**
			 * Attempt to load a saved table state from a cookie
			 *  @param {object} oSettings dataTables settings object
			 *  @param {object} oInit DataTables init object so we can override settings
			 *  @memberof DataTable#oApi
			 */
			function _fnLoadState ( oSettings, oInit )
			{
				if ( !oSettings.oFeatures.bStateSave )
				{
					return;
				}

				var oData = oSettings.fnStateLoad.call( oSettings.oInstance, oSettings );
				if ( !oData )
				{
					return;
				}

				/* Allow custom and plug-in manipulation functions to alter the saved data set and
				 * cancelling of loading by returning false
				 */
				var abStateLoad = _fnCallbackFire( oSettings, 'aoStateLoadParams', 'stateLoadParams', [oSettings, oData] );
				if ( $.inArray( false, abStateLoad ) !== -1 )
				{
					return;
				}

				/* Store the saved state so it might be accessed at any time */
				oSettings.oLoadedState = $.extend( true, {}, oData );

				/* Restore key features */
				oSettings._iDisplayStart    = oData.iStart;
				oSettings.iInitDisplayStart = oData.iStart;
				oSettings._iDisplayEnd      = oData.iEnd;
				oSettings._iDisplayLength   = oData.iLength;
				oSettings.aaSorting         = oData.aaSorting.slice();
				oSettings.saved_aaSorting   = oData.aaSorting.slice();

				/* Search filtering  */
				$.extend( oSettings.oPreviousSearch, oData.oSearch );
				$.extend( true, oSettings.aoPreSearchCols, oData.aoSearchCols );

				/* Column visibility state
				 * Pass back visibility settings to the init handler, but to do not here override
				 * the init object that the user might have passed in
				 */
				oInit.saved_aoColumns = [];
				for ( var i=0 ; i<oData.abVisCols.length ; i++ )
				{
					oInit.saved_aoColumns[i] = {};
					oInit.saved_aoColumns[i].bVisible = oData.abVisCols[i];
				}

				_fnCallbackFire( oSettings, 'aoStateLoaded', 'stateLoaded', [oSettings, oData] );
			}


			/**
			 * Create a new cookie with a value to store the state of a table
			 *  @param {string} sName name of the cookie to create
			 *  @param {string} sValue the value the cookie should take
			 *  @param {int} iSecs duration of the cookie
			 *  @param {string} sBaseName sName is made up of the base + file name - this is the base
			 *  @param {function} fnCallback User definable function to modify the cookie
			 *  @memberof DataTable#oApi
			 */
			function _fnCreateCookie ( sName, sValue, iSecs, sBaseName, fnCallback )
			{
				var date = new Date();
				date.setTime( date.getTime()+(iSecs*1000) );

				/* 
				 * Shocking but true - it would appear IE has major issues with having the path not having
				 * a trailing slash on it. We need the cookie to be available based on the path, so we
				 * have to append the file name to the cookie name. Appalling. Thanks to vex for adding the
				 * patch to use at least some of the path
				 */
				var aParts = window.location.pathname.split('/');
				var sNameFile = sName + '_' + aParts.pop().replace(/[\/:]/g,"").toLowerCase();
				var sFullCookie, oData;

				if ( fnCallback !== null )
				{
					oData = (typeof $.parseJSON === 'function') ?
						$.parseJSON( sValue ) : eval( '('+sValue+')' );
					sFullCookie = fnCallback( sNameFile, oData, date.toGMTString(),
						aParts.join('/')+"/" );
				}
				else
				{
					sFullCookie = sNameFile + "=" + encodeURIComponent(sValue) +
						"; expires=" + date.toGMTString() +"; path=" + aParts.join('/')+"/";
				}

				/* Are we going to go over the cookie limit of 4KiB? If so, try to delete a cookies
				 * belonging to DataTables.
				 */
				var
					aCookies =document.cookie.split(';'),
					iNewCookieLen = sFullCookie.split(';')[0].length,
					aOldCookies = [];

				if ( iNewCookieLen+document.cookie.length+10 > 4096 ) /* Magic 10 for padding */
				{
					for ( var i=0, iLen=aCookies.length ; i<iLen ; i++ )
					{
						if ( aCookies[i].indexOf( sBaseName ) != -1 )
						{
							/* It's a DataTables cookie, so eval it and check the time stamp */
							var aSplitCookie = aCookies[i].split('=');
							try {
								oData = eval( '('+decodeURIComponent(aSplitCookie[1])+')' );

								if ( oData && oData.iCreate )
								{
									aOldCookies.push( {
										"name": aSplitCookie[0],
										"time": oData.iCreate
									} );
								}
							}
							catch( e ) {}
						}
					}

					// Make sure we delete the oldest ones first
					aOldCookies.sort( function (a, b) {
						return b.time - a.time;
					} );

					// Eliminate as many old DataTables cookies as we need to
					while ( iNewCookieLen + document.cookie.length + 10 > 4096 ) {
						if ( aOldCookies.length === 0 ) {
							// Deleted all DT cookies and still not enough space. Can't state save
							return;
						}

						var old = aOldCookies.pop();
						document.cookie = old.name+"=; expires=Thu, 01-Jan-1970 00:00:01 GMT; path="+
							aParts.join('/') + "/";
					}
				}

				document.cookie = sFullCookie;
			}


			/**
			 * Read an old cookie to get a cookie with an old table state
			 *  @param {string} sName name of the cookie to read
			 *  @returns {string} contents of the cookie - or null if no cookie with that name found
			 *  @memberof DataTable#oApi
			 */
			function _fnReadCookie ( sName )
			{
				var
					aParts = window.location.pathname.split('/'),
					sNameEQ = sName + '_' + aParts[aParts.length-1].replace(/[\/:]/g,"").toLowerCase() + '=',
					sCookieContents = document.cookie.split(';');

				for( var i=0 ; i<sCookieContents.length ; i++ )
				{
					var c = sCookieContents[i];

					while (c.charAt(0)==' ')
					{
						c = c.substring(1,c.length);
					}

					if (c.indexOf(sNameEQ) === 0)
					{
						return decodeURIComponent( c.substring(sNameEQ.length,c.length) );
					}
				}
				return null;
			}


			/**
			 * Return the settings object for a particular table
			 *  @param {node} nTable table we are using as a dataTable
			 *  @returns {object} Settings object - or null if not found
			 *  @memberof DataTable#oApi
			 */
			function _fnSettingsFromNode ( nTable )
			{
				for ( var i=0 ; i<DataTable.settings.length ; i++ )
				{
					if ( DataTable.settings[i].nTable === nTable )
					{
						return DataTable.settings[i];
					}
				}

				return null;
			}


			/**
			 * Return an array with the TR nodes for the table
			 *  @param {object} oSettings dataTables settings object
			 *  @returns {array} TR array
			 *  @memberof DataTable#oApi
			 */
			function _fnGetTrNodes ( oSettings )
			{
				var aNodes = [];
				var aoData = oSettings.aoData;
				for ( var i=0, iLen=aoData.length ; i<iLen ; i++ )
				{
					if ( aoData[i].nTr !== null )
					{
						aNodes.push( aoData[i].nTr );
					}
				}
				return aNodes;
			}


			/**
			 * Return an flat array with all TD nodes for the table, or row
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} [iIndividualRow] aoData index to get the nodes for - optional
			 *    if not given then the return array will contain all nodes for the table
			 *  @returns {array} TD array
			 *  @memberof DataTable#oApi
			 */
			function _fnGetTdNodes ( oSettings, iIndividualRow )
			{
				var anReturn = [];
				var iCorrector;
				var anTds, nTd;
				var iRow, iRows=oSettings.aoData.length,
					iColumn, iColumns, oData, sNodeName, iStart=0, iEnd=iRows;

				/* Allow the collection to be limited to just one row */
				if ( iIndividualRow !== undefined )
				{
					iStart = iIndividualRow;
					iEnd = iIndividualRow+1;
				}

				for ( iRow=iStart ; iRow<iEnd ; iRow++ )
				{
					oData = oSettings.aoData[iRow];
					if ( oData.nTr !== null )
					{
						/* get the TD child nodes - taking into account text etc nodes */
						anTds = [];
						nTd = oData.nTr.firstChild;
						while ( nTd )
						{
							sNodeName = nTd.nodeName.toLowerCase();
							if ( sNodeName == 'td' || sNodeName == 'th' )
							{
								anTds.push( nTd );
							}
							nTd = nTd.nextSibling;
						}

						iCorrector = 0;
						for ( iColumn=0, iColumns=oSettings.aoColumns.length ; iColumn<iColumns ; iColumn++ )
						{
							if ( oSettings.aoColumns[iColumn].bVisible )
							{
								anReturn.push( anTds[iColumn-iCorrector] );
							}
							else
							{
								anReturn.push( oData._anHidden[iColumn] );
								iCorrector++;
							}
						}
					}
				}

				return anReturn;
			}


			/**
			 * Log an error message
			 *  @param {object} oSettings dataTables settings object
			 *  @param {int} iLevel log error messages, or display them to the user
			 *  @param {string} sMesg error message
			 *  @memberof DataTable#oApi
			 */
			function _fnLog( oSettings, iLevel, sMesg )
			{
				var sAlert = (oSettings===null) ?
				"DataTables warning: "+sMesg :
				"DataTables warning (table id = '"+oSettings.sTableId+"'): "+sMesg;

				if ( iLevel === 0 )
				{
					if ( DataTable.ext.sErrMode == 'alert' )
					{
						alert( sAlert );
					}
					else
					{
						throw new Error(sAlert);
					}
					return;
				}
				else if ( window.console && console.log )
				{
					console.log( sAlert );
				}
			}


			/**
			 * See if a property is defined on one object, if so assign it to the other object
			 *  @param {object} oRet target object
			 *  @param {object} oSrc source object
			 *  @param {string} sName property
			 *  @param {string} [sMappedName] name to map too - optional, sName used if not given
			 *  @memberof DataTable#oApi
			 */
			function _fnMap( oRet, oSrc, sName, sMappedName )
			{
				if ( sMappedName === undefined )
				{
					sMappedName = sName;
				}
				if ( oSrc[sName] !== undefined )
				{
					oRet[sMappedName] = oSrc[sName];
				}
			}


			/**
			 * Extend objects - very similar to jQuery.extend, but deep copy objects, and shallow
			 * copy arrays. The reason we need to do this, is that we don't want to deep copy array
			 * init values (such as aaSorting) since the dev wouldn't be able to override them, but
			 * we do want to deep copy arrays.
			 *  @param {object} oOut Object to extend
			 *  @param {object} oExtender Object from which the properties will be applied to oOut
			 *  @returns {object} oOut Reference, just for convenience - oOut === the return.
			 *  @memberof DataTable#oApi
			 *  @todo This doesn't take account of arrays inside the deep copied objects.
			 */
			function _fnExtend( oOut, oExtender )
			{
				var val;

				for ( var prop in oExtender )
				{
					if ( oExtender.hasOwnProperty(prop) )
					{
						val = oExtender[prop];

						if ( typeof oInit[prop] === 'object' && val !== null && $.isArray(val) === false )
						{
							$.extend( true, oOut[prop], val );
						}
						else
						{
							oOut[prop] = val;
						}
					}
				}

				return oOut;
			}


			/**
			 * Bind an event handers to allow a click or return key to activate the callback.
			 * This is good for accessibility since a return on the keyboard will have the
			 * same effect as a click, if the element has focus.
			 *  @param {element} n Element to bind the action to
			 *  @param {object} oData Data object to pass to the triggered function
			 *  @param {function} fn Callback function for when the event is triggered
			 *  @memberof DataTable#oApi
			 */
			function _fnBindAction( n, oData, fn )
			{
				$(n)
					.bind( 'click.DT', oData, function (e) {
						n.blur(); // Remove focus outline for mouse users
						fn(e);
					} )
					.bind( 'keypress.DT', oData, function (e){
						if ( e.which === 13 ) {
							fn(e);
						} } )
					.bind( 'selectstart.DT', function () {
						/* Take the brutal approach to cancelling text selection */
						return false;
					} );
			}


			/**
			 * Register a callback function. Easily allows a callback function to be added to
			 * an array store of callback functions that can then all be called together.
			 *  @param {object} oSettings dataTables settings object
			 *  @param {string} sStore Name of the array storage for the callbacks in oSettings
			 *  @param {function} fn Function to be called back
			 *  @param {string} sName Identifying name for the callback (i.e. a label)
			 *  @memberof DataTable#oApi
			 */
			function _fnCallbackReg( oSettings, sStore, fn, sName )
			{
				if ( fn )
				{
					oSettings[sStore].push( {
						"fn": fn,
						"sName": sName
					} );
				}
			}


			/**
			 * Fire callback functions and trigger events. Note that the loop over the callback
			 * array store is done backwards! Further note that you do not want to fire off triggers
			 * in time sensitive applications (for example cell creation) as its slow.
			 *  @param {object} oSettings dataTables settings object
			 *  @param {string} sStore Name of the array storage for the callbacks in oSettings
			 *  @param {string} sTrigger Name of the jQuery custom event to trigger. If null no trigger
			 *    is fired
			 *  @param {array} aArgs Array of arguments to pass to the callback function / trigger
			 *  @memberof DataTable#oApi
			 */
			function _fnCallbackFire( oSettings, sStore, sTrigger, aArgs )
			{
				var aoStore = oSettings[sStore];
				var aRet =[];

				for ( var i=aoStore.length-1 ; i>=0 ; i-- )
				{
					aRet.push( aoStore[i].fn.apply( oSettings.oInstance, aArgs ) );
				}

				if ( sTrigger !== null )
				{
					$(oSettings.oInstance).trigger(sTrigger, aArgs);
				}

				return aRet;
			}


			/**
			 * JSON stringify. If JSON.stringify it provided by the browser, json2.js or any other
			 * library, then we use that as it is fast, safe and accurate. If the function isn't
			 * available then we need to built it ourselves - the inspiration for this function comes
			 * from Craig Buckler ( http://www.sitepoint.com/javascript-json-serialization/ ). It is
			 * not perfect and absolutely should not be used as a replacement to json2.js - but it does
			 * do what we need, without requiring a dependency for DataTables.
			 *  @param {object} o JSON object to be converted
			 *  @returns {string} JSON string
			 *  @memberof DataTable#oApi
			 */
			var _fnJsonString = (window.JSON) ? JSON.stringify : function( o )
			{
				/* Not an object or array */
				var sType = typeof o;
				if (sType !== "object" || o === null)
				{
					// simple data type
					if (sType === "string")
					{
						o = '"'+o+'"';
					}
					return o+"";
				}

				/* If object or array, need to recurse over it */
				var
					sProp, mValue,
					json = [],
					bArr = $.isArray(o);

				for (sProp in o)
				{
					mValue = o[sProp];
					sType = typeof mValue;

					if (sType === "string")
					{
						mValue = '"'+mValue+'"';
					}
					else if (sType === "object" && mValue !== null)
					{
						mValue = _fnJsonString(mValue);
					}

					json.push((bArr ? "" : '"'+sProp+'":') + mValue);
				}

				return (bArr ? "[" : "{") + json + (bArr ? "]" : "}");
			};


			/**
			 * From some browsers (specifically IE6/7) we need special handling to work around browser
			 * bugs - this function is used to detect when these workarounds are needed.
			 *  @param {object} oSettings dataTables settings object
			 *  @memberof DataTable#oApi
			 */
			function _fnBrowserDetect( oSettings )
			{
				/* IE6/7 will oversize a width 100% element inside a scrolling element, to include the
				 * width of the scrollbar, while other browsers ensure the inner element is contained
				 * without forcing scrolling
				 */
				var n = $(
					'<div style="position:absolute; top:0; left:0; height:1px; width:1px; overflow:hidden">'+
					'<div style="position:absolute; top:1px; left:1px; width:100px; overflow:scroll;">'+
					'<div id="DT_BrowserTest" style="width:100%; height:10px;"></div>'+
					'</div>'+
					'</div>')[0];

				document.body.appendChild( n );
				oSettings.oBrowser.bScrollOversize = $('#DT_BrowserTest', n)[0].offsetWidth === 100 ? true : false;
				document.body.removeChild( n );
			}


			/**
			 * Perform a jQuery selector action on the table's TR elements (from the tbody) and
			 * return the resulting jQuery object.
			 *  @param {string|node|jQuery} sSelector jQuery selector or node collection to act on
			 *  @param {object} [oOpts] Optional parameters for modifying the rows to be included
			 *  @param {string} [oOpts.filter=none] Select TR elements that meet the current filter
			 *    criterion ("applied") or all TR elements (i.e. no filter).
			 *  @param {string} [oOpts.order=current] Order of the TR elements in the processed array.
			 *    Can be either 'current', whereby the current sorting of the table is used, or
			 *    'original' whereby the original order the data was read into the table is used.
			 *  @param {string} [oOpts.page=all] Limit the selection to the currently displayed page
			 *    ("current") or not ("all"). If 'current' is given, then order is assumed to be
			 *    'current' and filter is 'applied', regardless of what they might be given as.
			 *  @returns {object} jQuery object, filtered by the given selector.
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *
		 *      // Highlight every second row
		 *      oTable.$('tr:odd').css('backgroundColor', 'blue');
		 *    } );
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *
		 *      // Filter to rows with 'Webkit' in them, add a background colour and then
		 *      // remove the filter, thus highlighting the 'Webkit' rows only.
		 *      oTable.fnFilter('Webkit');
		 *      oTable.$('tr', {"filter": "applied"}).css('backgroundColor', 'blue');
		 *      oTable.fnFilter('');
		 *    } );
			 */
			this.$ = function ( sSelector, oOpts )
			{
				var i, iLen, a = [], tr;
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				var aoData = oSettings.aoData;
				var aiDisplay = oSettings.aiDisplay;
				var aiDisplayMaster = oSettings.aiDisplayMaster;

				if ( !oOpts )
				{
					oOpts = {};
				}

				oOpts = $.extend( {}, {
					"filter": "none", // applied
					"order": "current", // "original"
					"page": "all" // current
				}, oOpts );

				// Current page implies that order=current and fitler=applied, since it is fairly
				// senseless otherwise
				if ( oOpts.page == 'current' )
				{
					for ( i=oSettings._iDisplayStart, iLen=oSettings.fnDisplayEnd() ; i<iLen ; i++ )
					{
						tr = aoData[ aiDisplay[i] ].nTr;
						if ( tr )
						{
							a.push( tr );
						}
					}
				}
				else if ( oOpts.order == "current" && oOpts.filter == "none" )
				{
					for ( i=0, iLen=aiDisplayMaster.length ; i<iLen ; i++ )
					{
						tr = aoData[ aiDisplayMaster[i] ].nTr;
						if ( tr )
						{
							a.push( tr );
						}
					}
				}
				else if ( oOpts.order == "current" && oOpts.filter == "applied" )
				{
					for ( i=0, iLen=aiDisplay.length ; i<iLen ; i++ )
					{
						tr = aoData[ aiDisplay[i] ].nTr;
						if ( tr )
						{
							a.push( tr );
						}
					}
				}
				else if ( oOpts.order == "original" && oOpts.filter == "none" )
				{
					for ( i=0, iLen=aoData.length ; i<iLen ; i++ )
					{
						tr = aoData[ i ].nTr ;
						if ( tr )
						{
							a.push( tr );
						}
					}
				}
				else if ( oOpts.order == "original" && oOpts.filter == "applied" )
				{
					for ( i=0, iLen=aoData.length ; i<iLen ; i++ )
					{
						tr = aoData[ i ].nTr;
						if ( $.inArray( i, aiDisplay ) !== -1 && tr )
						{
							a.push( tr );
						}
					}
				}
				else
				{
					_fnLog( oSettings, 1, "Unknown selection options" );
				}

				/* We need to filter on the TR elements and also 'find' in their descendants
				 * to make the selector act like it would in a full table - so we need
				 * to build both results and then combine them together
				 */
				var jqA = $(a);
				var jqTRs = jqA.filter( sSelector );
				var jqDescendants = jqA.find( sSelector );

				return $( [].concat($.makeArray(jqTRs), $.makeArray(jqDescendants)) );
			};


			/**
			 * Almost identical to $ in operation, but in this case returns the data for the matched
			 * rows - as such, the jQuery selector used should match TR row nodes or TD/TH cell nodes
			 * rather than any descendants, so the data can be obtained for the row/cell. If matching
			 * rows are found, the data returned is the original data array/object that was used to
			 * create the row (or a generated array if from a DOM source).
			 *
			 * This method is often useful in-combination with $ where both functions are given the
			 * same parameters and the array indexes will match identically.
			 *  @param {string|node|jQuery} sSelector jQuery selector or node collection to act on
			 *  @param {object} [oOpts] Optional parameters for modifying the rows to be included
			 *  @param {string} [oOpts.filter=none] Select elements that meet the current filter
			 *    criterion ("applied") or all elements (i.e. no filter).
			 *  @param {string} [oOpts.order=current] Order of the data in the processed array.
			 *    Can be either 'current', whereby the current sorting of the table is used, or
			 *    'original' whereby the original order the data was read into the table is used.
			 *  @param {string} [oOpts.page=all] Limit the selection to the currently displayed page
			 *    ("current") or not ("all"). If 'current' is given, then order is assumed to be
			 *    'current' and filter is 'applied', regardless of what they might be given as.
			 *  @returns {array} Data for the matched elements. If any elements, as a result of the
			 *    selector, were not TR, TD or TH elements in the DataTable, they will have a null
			 *    entry in the array.
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *
		 *      // Get the data from the first row in the table
		 *      var data = oTable._('tr:first');
		 *
		 *      // Do something useful with the data
		 *      alert( "First cell is: "+data[0] );
		 *    } );
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *
		 *      // Filter to 'Webkit' and get all data for 
		 *      oTable.fnFilter('Webkit');
		 *      var data = oTable._('tr', {"filter": "applied"});
		 *      
		 *      // Do something with the data
		 *      alert( data.length+" rows matched the filter" );
		 *    } );
			 */
			this._ = function ( sSelector, oOpts )
			{
				var aOut = [];
				var i, iLen, iIndex;
				var aTrs = this.$( sSelector, oOpts );

				for ( i=0, iLen=aTrs.length ; i<iLen ; i++ )
				{
					aOut.push( this.fnGetData(aTrs[i]) );
				}

				return aOut;
			};


			/**
			 * Add a single new row or multiple rows of data to the table. Please note
			 * that this is suitable for client-side processing only - if you are using
			 * server-side processing (i.e. "bServerSide": true), then to add data, you
			 * must add it to the data source, i.e. the server-side, through an Ajax call.
			 *  @param {array|object} mData The data to be added to the table. This can be:
			 *    <ul>
			 *      <li>1D array of data - add a single row with the data provided</li>
			 *      <li>2D array of arrays - add multiple rows in a single call</li>
			 *      <li>object - data object when using <i>mData</i></li>
			 *      <li>array of objects - multiple data objects when using <i>mData</i></li>
			 *    </ul>
			 *  @param {bool} [bRedraw=true] redraw the table or not
			 *  @returns {array} An array of integers, representing the list of indexes in
			 *    <i>aoData</i> ({@link DataTable.models.oSettings}) that have been added to
			 *    the table.
			 *  @dtopt API
			 *
			 *  @example
			 *    // Global var for counter
			 *    var giCount = 2;
			 *
			 *    $(document).ready(function() {
		 *      $('#example').dataTable();
		 *    } );
			 *
			 *    function fnClickAddRow() {
		 *      $('#example').dataTable().fnAddData( [
		 *        giCount+".1",
		 *        giCount+".2",
		 *        giCount+".3",
		 *        giCount+".4" ]
		 *      );
		 *        
		 *      giCount++;
		 *    }
			 */
			this.fnAddData = function( mData, bRedraw )
			{
				if ( mData.length === 0 )
				{
					return [];
				}

				var aiReturn = [];
				var iTest;

				/* Find settings from table node */
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );

				/* Check if we want to add multiple rows or not */
				if ( typeof mData[0] === "object" && mData[0] !== null )
				{
					for ( var i=0 ; i<mData.length ; i++ )
					{
						iTest = _fnAddData( oSettings, mData[i] );
						if ( iTest == -1 )
						{
							return aiReturn;
						}
						aiReturn.push( iTest );
					}
				}
				else
				{
					iTest = _fnAddData( oSettings, mData );
					if ( iTest == -1 )
					{
						return aiReturn;
					}
					aiReturn.push( iTest );
				}

				oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

				if ( bRedraw === undefined || bRedraw )
				{
					_fnReDraw( oSettings );
				}
				return aiReturn;
			};


			/**
			 * This function will make DataTables recalculate the column sizes, based on the data
			 * contained in the table and the sizes applied to the columns (in the DOM, CSS or
			 * through the sWidth parameter). This can be useful when the width of the table's
			 * parent element changes (for example a window resize).
			 *  @param {boolean} [bRedraw=true] Redraw the table or not, you will typically want to
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable( {
		 *        "sScrollY": "200px",
		 *        "bPaginate": false
		 *      } );
		 *      
		 *      $(window).bind('resize', function () {
		 *        oTable.fnAdjustColumnSizing();
		 *      } );
		 *    } );
			 */
			this.fnAdjustColumnSizing = function ( bRedraw )
			{
				var oSettings = _fnSettingsFromNode(this[DataTable.ext.iApiIndex]);
				_fnAdjustColumnSizing( oSettings );

				if ( bRedraw === undefined || bRedraw )
				{
					this.fnDraw( false );
				}
				else if ( oSettings.oScroll.sX !== "" || oSettings.oScroll.sY !== "" )
				{
					/* If not redrawing, but scrolling, we want to apply the new column sizes anyway */
					this.oApi._fnScrollDraw(oSettings);
				}
			};


			/**
			 * Quickly and simply clear a table
			 *  @param {bool} [bRedraw=true] redraw the table or not
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      
		 *      // Immediately 'nuke' the current rows (perhaps waiting for an Ajax callback...)
		 *      oTable.fnClearTable();
		 *    } );
			 */
			this.fnClearTable = function( bRedraw )
			{
				/* Find settings from table node */
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				_fnClearTable( oSettings );

				if ( bRedraw === undefined || bRedraw )
				{
					_fnDraw( oSettings );
				}
			};


			/**
			 * The exact opposite of 'opening' a row, this function will close any rows which
			 * are currently 'open'.
			 *  @param {node} nTr the table row to 'close'
			 *  @returns {int} 0 on success, or 1 if failed (can't find the row)
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable;
		 *      
		 *      // 'open' an information row when a row is clicked on
		 *      $('#example tbody tr').click( function () {
		 *        if ( oTable.fnIsOpen(this) ) {
		 *          oTable.fnClose( this );
		 *        } else {
		 *          oTable.fnOpen( this, "Temporary row opened", "info_row" );
		 *        }
		 *      } );
		 *      
		 *      oTable = $('#example').dataTable();
		 *    } );
			 */
			this.fnClose = function( nTr )
			{
				/* Find settings from table node */
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );

				for ( var i=0 ; i<oSettings.aoOpenRows.length ; i++ )
				{
					if ( oSettings.aoOpenRows[i].nParent == nTr )
					{
						var nTrParent = oSettings.aoOpenRows[i].nTr.parentNode;
						if ( nTrParent )
						{
							/* Remove it if it is currently on display */
							nTrParent.removeChild( oSettings.aoOpenRows[i].nTr );
						}
						oSettings.aoOpenRows.splice( i, 1 );
						return 0;
					}
				}
				return 1;
			};


			/**
			 * Remove a row for the table
			 *  @param {mixed} mTarget The index of the row from aoData to be deleted, or
			 *    the TR element you want to delete
			 *  @param {function|null} [fnCallBack] Callback function
			 *  @param {bool} [bRedraw=true] Redraw the table or not
			 *  @returns {array} The row that was deleted
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      
		 *      // Immediately remove the first row
		 *      oTable.fnDeleteRow( 0 );
		 *    } );
			 */
			this.fnDeleteRow = function( mTarget, fnCallBack, bRedraw )
			{
				/* Find settings from table node */
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				var i, iLen, iAODataIndex;

				iAODataIndex = (typeof mTarget === 'object') ?
					_fnNodeToDataIndex(oSettings, mTarget) : mTarget;

				/* Return the data array from this row */
				var oData = oSettings.aoData.splice( iAODataIndex, 1 );

				/* Update the _DT_RowIndex parameter */
				for ( i=0, iLen=oSettings.aoData.length ; i<iLen ; i++ )
				{
					if ( oSettings.aoData[i].nTr !== null )
					{
						oSettings.aoData[i].nTr._DT_RowIndex = i;
					}
				}

				/* Remove the target row from the search array */
				var iDisplayIndex = $.inArray( iAODataIndex, oSettings.aiDisplay );
				oSettings.asDataSearch.splice( iDisplayIndex, 1 );

				/* Delete from the display arrays */
				_fnDeleteIndex( oSettings.aiDisplayMaster, iAODataIndex );
				_fnDeleteIndex( oSettings.aiDisplay, iAODataIndex );

				/* If there is a user callback function - call it */
				if ( typeof fnCallBack === "function" )
				{
					fnCallBack.call( this, oSettings, oData );
				}

				/* Check for an 'overflow' they case for displaying the table */
				if ( oSettings._iDisplayStart >= oSettings.fnRecordsDisplay() )
				{
					oSettings._iDisplayStart -= oSettings._iDisplayLength;
					if ( oSettings._iDisplayStart < 0 )
					{
						oSettings._iDisplayStart = 0;
					}
				}

				if ( bRedraw === undefined || bRedraw )
				{
					_fnCalculateEnd( oSettings );
					_fnDraw( oSettings );
				}

				return oData;
			};


			/**
			 * Restore the table to it's original state in the DOM by removing all of DataTables
			 * enhancements, alterations to the DOM structure of the table and event listeners.
			 *  @param {boolean} [bRemove=false] Completely remove the table from the DOM
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      // This example is fairly pointless in reality, but shows how fnDestroy can be used
		 *      var oTable = $('#example').dataTable();
		 *      oTable.fnDestroy();
		 *    } );
			 */
			this.fnDestroy = function ( bRemove )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				var nOrig = oSettings.nTableWrapper.parentNode;
				var nBody = oSettings.nTBody;
				var i, iLen;

				bRemove = (bRemove===undefined) ? false : bRemove;

				/* Flag to note that the table is currently being destroyed - no action should be taken */
				oSettings.bDestroying = true;

				/* Fire off the destroy callbacks for plug-ins etc */
				_fnCallbackFire( oSettings, "aoDestroyCallback", "destroy", [oSettings] );

				/* If the table is not being removed, restore the hidden columns */
				if ( !bRemove )
				{
					for ( i=0, iLen=oSettings.aoColumns.length ; i<iLen ; i++ )
					{
						if ( oSettings.aoColumns[i].bVisible === false )
						{
							this.fnSetColumnVis( i, true );
						}
					}
				}

				/* Blitz all DT events */
				$(oSettings.nTableWrapper).find('*').andSelf().unbind('.DT');

				/* If there is an 'empty' indicator row, remove it */
				$('tbody>tr>td.'+oSettings.oClasses.sRowEmpty, oSettings.nTable).parent().remove();

				/* When scrolling we had to break the table up - restore it */
				if ( oSettings.nTable != oSettings.nTHead.parentNode )
				{
					$(oSettings.nTable).children('thead').remove();
					oSettings.nTable.appendChild( oSettings.nTHead );
				}

				if ( oSettings.nTFoot && oSettings.nTable != oSettings.nTFoot.parentNode )
				{
					$(oSettings.nTable).children('tfoot').remove();
					oSettings.nTable.appendChild( oSettings.nTFoot );
				}

				/* Remove the DataTables generated nodes, events and classes */
				oSettings.nTable.parentNode.removeChild( oSettings.nTable );
				$(oSettings.nTableWrapper).remove();

				oSettings.aaSorting = [];
				oSettings.aaSortingFixed = [];
				_fnSortingClasses( oSettings );

				$(_fnGetTrNodes( oSettings )).removeClass( oSettings.asStripeClasses.join(' ') );

				$('th, td', oSettings.nTHead).removeClass( [
						oSettings.oClasses.sSortable,
						oSettings.oClasses.sSortableAsc,
						oSettings.oClasses.sSortableDesc,
						oSettings.oClasses.sSortableNone ].join(' ')
				);
				if ( oSettings.bJUI )
				{
					$('th span.'+oSettings.oClasses.sSortIcon
						+ ', td span.'+oSettings.oClasses.sSortIcon, oSettings.nTHead).remove();

					$('th, td', oSettings.nTHead).each( function () {
						var jqWrapper = $('div.'+oSettings.oClasses.sSortJUIWrapper, this);
						var kids = jqWrapper.contents();
						$(this).append( kids );
						jqWrapper.remove();
					} );
				}

				/* Add the TR elements back into the table in their original order */
				if ( !bRemove && oSettings.nTableReinsertBefore )
				{
					nOrig.insertBefore( oSettings.nTable, oSettings.nTableReinsertBefore );
				}
				else if ( !bRemove )
				{
					nOrig.appendChild( oSettings.nTable );
				}

				for ( i=0, iLen=oSettings.aoData.length ; i<iLen ; i++ )
				{
					if ( oSettings.aoData[i].nTr !== null )
					{
						nBody.appendChild( oSettings.aoData[i].nTr );
					}
				}

				/* Restore the width of the original table */
				if ( oSettings.oFeatures.bAutoWidth === true )
				{
					oSettings.nTable.style.width = _fnStringToCss(oSettings.sDestroyWidth);
				}

				/* If the were originally stripe classes - then we add them back here. Note
				 * this is not fool proof (for example if not all rows had stripe classes - but
				 * it's a good effort without getting carried away
				 */
				iLen = oSettings.asDestroyStripes.length;
				if (iLen)
				{
					var anRows = $(nBody).children('tr');
					for ( i=0 ; i<iLen ; i++ )
					{
						anRows.filter(':nth-child(' + iLen + 'n + ' + i + ')').addClass( oSettings.asDestroyStripes[i] );
					}
				}

				/* Remove the settings object from the settings array */
				for ( i=0, iLen=DataTable.settings.length ; i<iLen ; i++ )
				{
					if ( DataTable.settings[i] == oSettings )
					{
						DataTable.settings.splice( i, 1 );
					}
				}

				/* End it all */
				oSettings = null;
				oInit = null;
			};


			/**
			 * Redraw the table
			 *  @param {bool} [bComplete=true] Re-filter and resort (if enabled) the table before the draw.
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      
		 *      // Re-draw the table - you wouldn't want to do it here, but it's an example :-)
		 *      oTable.fnDraw();
		 *    } );
			 */
			this.fnDraw = function( bComplete )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				if ( bComplete === false )
				{
					_fnCalculateEnd( oSettings );
					_fnDraw( oSettings );
				}
				else
				{
					_fnReDraw( oSettings );
				}
			};


			/**
			 * Filter the input based on data
			 *  @param {string} sInput String to filter the table on
			 *  @param {int|null} [iColumn] Column to limit filtering to
			 *  @param {bool} [bRegex=false] Treat as regular expression or not
			 *  @param {bool} [bSmart=true] Perform smart filtering or not
			 *  @param {bool} [bShowGlobal=true] Show the input global filter in it's input box(es)
			 *  @param {bool} [bCaseInsensitive=true] Do case-insensitive matching (true) or not (false)
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      
		 *      // Sometime later - filter...
		 *      oTable.fnFilter( 'test string' );
		 *    } );
			 */
			this.fnFilter = function( sInput, iColumn, bRegex, bSmart, bShowGlobal, bCaseInsensitive )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );

				if ( !oSettings.oFeatures.bFilter )
				{
					return;
				}

				if ( bRegex === undefined || bRegex === null )
				{
					bRegex = false;
				}

				if ( bSmart === undefined || bSmart === null )
				{
					bSmart = true;
				}

				if ( bShowGlobal === undefined || bShowGlobal === null )
				{
					bShowGlobal = true;
				}

				if ( bCaseInsensitive === undefined || bCaseInsensitive === null )
				{
					bCaseInsensitive = true;
				}

				if ( iColumn === undefined || iColumn === null )
				{
					/* Global filter */
					_fnFilterComplete( oSettings, {
						"sSearch":sInput+"",
						"bRegex": bRegex,
						"bSmart": bSmart,
						"bCaseInsensitive": bCaseInsensitive
					}, 1 );

					if ( bShowGlobal && oSettings.aanFeatures.f )
					{
						var n = oSettings.aanFeatures.f;
						for ( var i=0, iLen=n.length ; i<iLen ; i++ )
						{
							// IE9 throws an 'unknown error' if document.activeElement is used
							// inside an iframe or frame...
							try {
								if ( n[i]._DT_Input != document.activeElement )
								{
									$(n[i]._DT_Input).val( sInput );
								}
							}
							catch ( e ) {
								$(n[i]._DT_Input).val( sInput );
							}
						}
					}
				}
				else
				{
					/* Single column filter */
					$.extend( oSettings.aoPreSearchCols[ iColumn ], {
						"sSearch": sInput+"",
						"bRegex": bRegex,
						"bSmart": bSmart,
						"bCaseInsensitive": bCaseInsensitive
					} );
					_fnFilterComplete( oSettings, oSettings.oPreviousSearch, 1 );
				}
			};


			/**
			 * Get the data for the whole table, an individual row or an individual cell based on the
			 * provided parameters.
			 *  @param {int|node} [mRow] A TR row node, TD/TH cell node or an integer. If given as
			 *    a TR node then the data source for the whole row will be returned. If given as a
			 *    TD/TH cell node then iCol will be automatically calculated and the data for the
			 *    cell returned. If given as an integer, then this is treated as the aoData internal
			 *    data index for the row (see fnGetPosition) and the data for that row used.
			 *  @param {int} [iCol] Optional column index that you want the data of.
			 *  @returns {array|object|string} If mRow is undefined, then the data for all rows is
			 *    returned. If mRow is defined, just data for that row, and is iCol is
			 *    defined, only data for the designated cell is returned.
			 *  @dtopt API
			 *
			 *  @example
			 *    // Row data
			 *    $(document).ready(function() {
		 *      oTable = $('#example').dataTable();
		 *
		 *      oTable.$('tr').click( function () {
		 *        var data = oTable.fnGetData( this );
		 *        // ... do something with the array / object of data for the row
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Individual cell data
			 *    $(document).ready(function() {
		 *      oTable = $('#example').dataTable();
		 *
		 *      oTable.$('td').click( function () {
		 *        var sData = oTable.fnGetData( this );
		 *        alert( 'The cell clicked on had the value of '+sData );
		 *      } );
		 *    } );
			 */
			this.fnGetData = function( mRow, iCol )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );

				if ( mRow !== undefined )
				{
					var iRow = mRow;
					if ( typeof mRow === 'object' )
					{
						var sNode = mRow.nodeName.toLowerCase();
						if (sNode === "tr" )
						{
							iRow = _fnNodeToDataIndex(oSettings, mRow);
						}
						else if ( sNode === "td" )
						{
							iRow = _fnNodeToDataIndex(oSettings, mRow.parentNode);
							iCol = _fnNodeToColumnIndex( oSettings, iRow, mRow );
						}
					}

					if ( iCol !== undefined )
					{
						return _fnGetCellData( oSettings, iRow, iCol, '' );
					}
					return (oSettings.aoData[iRow]!==undefined) ?
						oSettings.aoData[iRow]._aData : null;
				}
				return _fnGetDataMaster( oSettings );
			};


			/**
			 * Get an array of the TR nodes that are used in the table's body. Note that you will
			 * typically want to use the '$' API method in preference to this as it is more
			 * flexible.
			 *  @param {int} [iRow] Optional row index for the TR element you want
			 *  @returns {array|node} If iRow is undefined, returns an array of all TR elements
			 *    in the table's body, or iRow is defined, just the TR element requested.
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      
		 *      // Get the nodes from the table
		 *      var nNodes = oTable.fnGetNodes( );
		 *    } );
			 */
			this.fnGetNodes = function( iRow )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );

				if ( iRow !== undefined ) {
					return (oSettings.aoData[iRow]!==undefined) ?
						oSettings.aoData[iRow].nTr : null;
				}
				return _fnGetTrNodes( oSettings );
			};


			/**
			 * Get the array indexes of a particular cell from it's DOM element
			 * and column index including hidden columns
			 *  @param {node} nNode this can either be a TR, TD or TH in the table's body
			 *  @returns {int} If nNode is given as a TR, then a single index is returned, or
			 *    if given as a cell, an array of [row index, column index (visible),
			 *    column index (all)] is given.
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      $('#example tbody td').click( function () {
		 *        // Get the position of the current data from the node
		 *        var aPos = oTable.fnGetPosition( this );
		 *        
		 *        // Get the data array for this row
		 *        var aData = oTable.fnGetData( aPos[0] );
		 *        
		 *        // Update the data array and return the value
		 *        aData[ aPos[1] ] = 'clicked';
		 *        this.innerHTML = 'clicked';
		 *      } );
		 *      
		 *      // Init DataTables
		 *      oTable = $('#example').dataTable();
		 *    } );
			 */
			this.fnGetPosition = function( nNode )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				var sNodeName = nNode.nodeName.toUpperCase();

				if ( sNodeName == "TR" )
				{
					return _fnNodeToDataIndex(oSettings, nNode);
				}
				else if ( sNodeName == "TD" || sNodeName == "TH" )
				{
					var iDataIndex = _fnNodeToDataIndex( oSettings, nNode.parentNode );
					var iColumnIndex = _fnNodeToColumnIndex( oSettings, iDataIndex, nNode );
					return [ iDataIndex, _fnColumnIndexToVisible(oSettings, iColumnIndex ), iColumnIndex ];
				}
				return null;
			};


			/**
			 * Check to see if a row is 'open' or not.
			 *  @param {node} nTr the table row to check
			 *  @returns {boolean} true if the row is currently open, false otherwise
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable;
		 *      
		 *      // 'open' an information row when a row is clicked on
		 *      $('#example tbody tr').click( function () {
		 *        if ( oTable.fnIsOpen(this) ) {
		 *          oTable.fnClose( this );
		 *        } else {
		 *          oTable.fnOpen( this, "Temporary row opened", "info_row" );
		 *        }
		 *      } );
		 *      
		 *      oTable = $('#example').dataTable();
		 *    } );
			 */
			this.fnIsOpen = function( nTr )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				var aoOpenRows = oSettings.aoOpenRows;

				for ( var i=0 ; i<oSettings.aoOpenRows.length ; i++ )
				{
					if ( oSettings.aoOpenRows[i].nParent == nTr )
					{
						return true;
					}
				}
				return false;
			};


			/**
			 * This function will place a new row directly after a row which is currently
			 * on display on the page, with the HTML contents that is passed into the
			 * function. This can be used, for example, to ask for confirmation that a
			 * particular record should be deleted.
			 *  @param {node} nTr The table row to 'open'
			 *  @param {string|node|jQuery} mHtml The HTML to put into the row
			 *  @param {string} sClass Class to give the new TD cell
			 *  @returns {node} The row opened. Note that if the table row passed in as the
			 *    first parameter, is not found in the table, this method will silently
			 *    return.
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable;
		 *      
		 *      // 'open' an information row when a row is clicked on
		 *      $('#example tbody tr').click( function () {
		 *        if ( oTable.fnIsOpen(this) ) {
		 *          oTable.fnClose( this );
		 *        } else {
		 *          oTable.fnOpen( this, "Temporary row opened", "info_row" );
		 *        }
		 *      } );
		 *      
		 *      oTable = $('#example').dataTable();
		 *    } );
			 */
			this.fnOpen = function( nTr, mHtml, sClass )
			{
				/* Find settings from table node */
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );

				/* Check that the row given is in the table */
				var nTableRows = _fnGetTrNodes( oSettings );
				if ( $.inArray(nTr, nTableRows) === -1 )
				{
					return;
				}

				/* the old open one if there is one */
				this.fnClose( nTr );

				var nNewRow = document.createElement("tr");
				var nNewCell = document.createElement("td");
				nNewRow.appendChild( nNewCell );
				nNewCell.className = sClass;
				nNewCell.colSpan = _fnVisbleColumns( oSettings );

				if (typeof mHtml === "string")
				{
					nNewCell.innerHTML = mHtml;
				}
				else
				{
					$(nNewCell).html( mHtml );
				}

				/* If the nTr isn't on the page at the moment - then we don't insert at the moment */
				var nTrs = $('tr', oSettings.nTBody);
				if ( $.inArray(nTr, nTrs) != -1  )
				{
					$(nNewRow).insertAfter(nTr);
				}

				oSettings.aoOpenRows.push( {
					"nTr": nNewRow,
					"nParent": nTr
				} );

				return nNewRow;
			};


			/**
			 * Change the pagination - provides the internal logic for pagination in a simple API
			 * function. With this function you can have a DataTables table go to the next,
			 * previous, first or last pages.
			 *  @param {string|int} mAction Paging action to take: "first", "previous", "next" or "last"
			 *    or page number to jump to (integer), note that page 0 is the first page.
			 *  @param {bool} [bRedraw=true] Redraw the table or not
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      oTable.fnPageChange( 'next' );
		 *    } );
			 */
			this.fnPageChange = function ( mAction, bRedraw )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				_fnPageChange( oSettings, mAction );
				_fnCalculateEnd( oSettings );

				if ( bRedraw === undefined || bRedraw )
				{
					_fnDraw( oSettings );
				}
			};


			/**
			 * Show a particular column
			 *  @param {int} iCol The column whose display should be changed
			 *  @param {bool} bShow Show (true) or hide (false) the column
			 *  @param {bool} [bRedraw=true] Redraw the table or not
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      
		 *      // Hide the second column after initialisation
		 *      oTable.fnSetColumnVis( 1, false );
		 *    } );
			 */
			this.fnSetColumnVis = function ( iCol, bShow, bRedraw )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				var i, iLen;
				var aoColumns = oSettings.aoColumns;
				var aoData = oSettings.aoData;
				var nTd, bAppend, iBefore;

				/* No point in doing anything if we are requesting what is already true */
				if ( aoColumns[iCol].bVisible == bShow )
				{
					return;
				}

				/* Show the column */
				if ( bShow )
				{
					var iInsert = 0;
					for ( i=0 ; i<iCol ; i++ )
					{
						if ( aoColumns[i].bVisible )
						{
							iInsert++;
						}
					}

					/* Need to decide if we should use appendChild or insertBefore */
					bAppend = (iInsert >= _fnVisbleColumns( oSettings ));

					/* Which coloumn should we be inserting before? */
					if ( !bAppend )
					{
						for ( i=iCol ; i<aoColumns.length ; i++ )
						{
							if ( aoColumns[i].bVisible )
							{
								iBefore = i;
								break;
							}
						}
					}

					for ( i=0, iLen=aoData.length ; i<iLen ; i++ )
					{
						if ( aoData[i].nTr !== null )
						{
							if ( bAppend )
							{
								aoData[i].nTr.appendChild(
									aoData[i]._anHidden[iCol]
								);
							}
							else
							{
								aoData[i].nTr.insertBefore(
									aoData[i]._anHidden[iCol],
									_fnGetTdNodes( oSettings, i )[iBefore] );
							}
						}
					}
				}
				else
				{
					/* Remove a column from display */
					for ( i=0, iLen=aoData.length ; i<iLen ; i++ )
					{
						if ( aoData[i].nTr !== null )
						{
							nTd = _fnGetTdNodes( oSettings, i )[iCol];
							aoData[i]._anHidden[iCol] = nTd;
							nTd.parentNode.removeChild( nTd );
						}
					}
				}

				/* Clear to set the visible flag */
				aoColumns[iCol].bVisible = bShow;

				/* Redraw the header and footer based on the new column visibility */
				_fnDrawHead( oSettings, oSettings.aoHeader );
				if ( oSettings.nTFoot )
				{
					_fnDrawHead( oSettings, oSettings.aoFooter );
				}

				/* If there are any 'open' rows, then we need to alter the colspan for this col change */
				for ( i=0, iLen=oSettings.aoOpenRows.length ; i<iLen ; i++ )
				{
					oSettings.aoOpenRows[i].nTr.colSpan = _fnVisbleColumns( oSettings );
				}

				/* Do a redraw incase anything depending on the table columns needs it 
				 * (built-in: scrolling) 
				 */
				if ( bRedraw === undefined || bRedraw )
				{
					_fnAdjustColumnSizing( oSettings );
					_fnDraw( oSettings );
				}

				_fnSaveState( oSettings );
			};


			/**
			 * Get the settings for a particular table for external manipulation
			 *  @returns {object} DataTables settings object. See
			 *    {@link DataTable.models.oSettings}
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      var oSettings = oTable.fnSettings();
		 *      
		 *      // Show an example parameter from the settings
		 *      alert( oSettings._iDisplayStart );
		 *    } );
			 */
			this.fnSettings = function()
			{
				return _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
			};


			/**
			 * Sort the table by a particular column
			 *  @param {int} iCol the data index to sort on. Note that this will not match the
			 *    'display index' if you have hidden data entries
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      
		 *      // Sort immediately with columns 0 and 1
		 *      oTable.fnSort( [ [0,'asc'], [1,'asc'] ] );
		 *    } );
			 */
			this.fnSort = function( aaSort )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				oSettings.aaSorting = aaSort;
				_fnSort( oSettings );
			};


			/**
			 * Attach a sort listener to an element for a given column
			 *  @param {node} nNode the element to attach the sort listener to
			 *  @param {int} iColumn the column that a click on this node will sort on
			 *  @param {function} [fnCallback] callback function when sort is run
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      
		 *      // Sort on column 1, when 'sorter' is clicked on
		 *      oTable.fnSortListener( document.getElementById('sorter'), 1 );
		 *    } );
			 */
			this.fnSortListener = function( nNode, iColumn, fnCallback )
			{
				_fnSortAttachListener( _fnSettingsFromNode( this[DataTable.ext.iApiIndex] ), nNode, iColumn,
					fnCallback );
			};


			/**
			 * Update a table cell or row - this method will accept either a single value to
			 * update the cell with, an array of values with one element for each column or
			 * an object in the same format as the original data source. The function is
			 * self-referencing in order to make the multi column updates easier.
			 *  @param {object|array|string} mData Data to update the cell/row with
			 *  @param {node|int} mRow TR element you want to update or the aoData index
			 *  @param {int} [iColumn] The column to update (not used of mData is an array or object)
			 *  @param {bool} [bRedraw=true] Redraw the table or not
			 *  @param {bool} [bAction=true] Perform pre-draw actions or not
			 *  @returns {int} 0 on success, 1 on error
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      oTable.fnUpdate( 'Example update', 0, 0 ); // Single cell
		 *      oTable.fnUpdate( ['a', 'b', 'c', 'd', 'e'], 1, 0 ); // Row
		 *    } );
			 */
			this.fnUpdate = function( mData, mRow, iColumn, bRedraw, bAction )
			{
				var oSettings = _fnSettingsFromNode( this[DataTable.ext.iApiIndex] );
				var i, iLen, sDisplay;
				var iRow = (typeof mRow === 'object') ?
					_fnNodeToDataIndex(oSettings, mRow) : mRow;

				if ( $.isArray(mData) && iColumn === undefined )
				{
					/* Array update - update the whole row */
					oSettings.aoData[iRow]._aData = mData.slice();

					/* Flag to the function that we are recursing */
					for ( i=0 ; i<oSettings.aoColumns.length ; i++ )
					{
						this.fnUpdate( _fnGetCellData( oSettings, iRow, i ), iRow, i, false, false );
					}
				}
				else if ( $.isPlainObject(mData) && iColumn === undefined )
				{
					/* Object update - update the whole row - assume the developer gets the object right */
					oSettings.aoData[iRow]._aData = $.extend( true, {}, mData );

					for ( i=0 ; i<oSettings.aoColumns.length ; i++ )
					{
						this.fnUpdate( _fnGetCellData( oSettings, iRow, i ), iRow, i, false, false );
					}
				}
				else
				{
					/* Individual cell update */
					_fnSetCellData( oSettings, iRow, iColumn, mData );
					sDisplay = _fnGetCellData( oSettings, iRow, iColumn, 'display' );

					var oCol = oSettings.aoColumns[iColumn];
					if ( oCol.fnRender !== null )
					{
						sDisplay = _fnRender( oSettings, iRow, iColumn );
						if ( oCol.bUseRendered )
						{
							_fnSetCellData( oSettings, iRow, iColumn, sDisplay );
						}
					}

					if ( oSettings.aoData[iRow].nTr !== null )
					{
						/* Do the actual HTML update */
						_fnGetTdNodes( oSettings, iRow )[iColumn].innerHTML = sDisplay;
					}
				}

				/* Modify the search index for this row (strictly this is likely not needed, since fnReDraw
				 * will rebuild the search array - however, the redraw might be disabled by the user)
				 */
				var iDisplayIndex = $.inArray( iRow, oSettings.aiDisplay );
				oSettings.asDataSearch[iDisplayIndex] = _fnBuildSearchRow(
					oSettings,
					_fnGetRowData( oSettings, iRow, 'filter', _fnGetColumns( oSettings, 'bSearchable' ) )
				);

				/* Perform pre-draw actions */
				if ( bAction === undefined || bAction )
				{
					_fnAdjustColumnSizing( oSettings );
				}

				/* Redraw the table */
				if ( bRedraw === undefined || bRedraw )
				{
					_fnReDraw( oSettings );
				}
				return 0;
			};


			/**
			 * Provide a common method for plug-ins to check the version of DataTables being used, in order
			 * to ensure compatibility.
			 *  @param {string} sVersion Version string to check for, in the format "X.Y.Z". Note that the
			 *    formats "X" and "X.Y" are also acceptable.
			 *  @returns {boolean} true if this version of DataTables is greater or equal to the required
			 *    version, or false if this version of DataTales is not suitable
			 *  @method
			 *  @dtopt API
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      alert( oTable.fnVersionCheck( '1.9.0' ) );
		 *    } );
			 */
			this.fnVersionCheck = DataTable.ext.fnVersionCheck;


			/*
			 * This is really a good bit rubbish this method of exposing the internal methods
			 * publicly... - To be fixed in 2.0 using methods on the prototype
			 */


			/**
			 * Create a wrapper function for exporting an internal functions to an external API.
			 *  @param {string} sFunc API function name
			 *  @returns {function} wrapped function
			 *  @memberof DataTable#oApi
			 */
			function _fnExternApiFunc (sFunc)
			{
				return function() {
					var aArgs = [_fnSettingsFromNode(this[DataTable.ext.iApiIndex])].concat(
						Array.prototype.slice.call(arguments) );
					return DataTable.ext.oApi[sFunc].apply( this, aArgs );
				};
			}


			/**
			 * Reference to internal functions for use by plug-in developers. Note that these
			 * methods are references to internal functions and are considered to be private.
			 * If you use these methods, be aware that they are liable to change between versions
			 * (check the upgrade notes).
			 *  @namespace
			 */
			this.oApi = {
				"_fnExternApiFunc": _fnExternApiFunc,
				"_fnInitialise": _fnInitialise,
				"_fnInitComplete": _fnInitComplete,
				"_fnLanguageCompat": _fnLanguageCompat,
				"_fnAddColumn": _fnAddColumn,
				"_fnColumnOptions": _fnColumnOptions,
				"_fnAddData": _fnAddData,
				"_fnCreateTr": _fnCreateTr,
				"_fnGatherData": _fnGatherData,
				"_fnBuildHead": _fnBuildHead,
				"_fnDrawHead": _fnDrawHead,
				"_fnDraw": _fnDraw,
				"_fnReDraw": _fnReDraw,
				"_fnAjaxUpdate": _fnAjaxUpdate,
				"_fnAjaxParameters": _fnAjaxParameters,
				"_fnAjaxUpdateDraw": _fnAjaxUpdateDraw,
				"_fnServerParams": _fnServerParams,
				"_fnAddOptionsHtml": _fnAddOptionsHtml,
				"_fnFeatureHtmlTable": _fnFeatureHtmlTable,
				"_fnScrollDraw": _fnScrollDraw,
				"_fnAdjustColumnSizing": _fnAdjustColumnSizing,
				"_fnFeatureHtmlFilter": _fnFeatureHtmlFilter,
				"_fnFilterComplete": _fnFilterComplete,
				"_fnFilterCustom": _fnFilterCustom,
				"_fnFilterColumn": _fnFilterColumn,
				"_fnFilter": _fnFilter,
				"_fnBuildSearchArray": _fnBuildSearchArray,
				"_fnBuildSearchRow": _fnBuildSearchRow,
				"_fnFilterCreateSearch": _fnFilterCreateSearch,
				"_fnDataToSearch": _fnDataToSearch,
				"_fnSort": _fnSort,
				"_fnSortAttachListener": _fnSortAttachListener,
				"_fnSortingClasses": _fnSortingClasses,
				"_fnFeatureHtmlPaginate": _fnFeatureHtmlPaginate,
				"_fnPageChange": _fnPageChange,
				"_fnFeatureHtmlInfo": _fnFeatureHtmlInfo,
				"_fnUpdateInfo": _fnUpdateInfo,
				"_fnFeatureHtmlLength": _fnFeatureHtmlLength,
				"_fnFeatureHtmlProcessing": _fnFeatureHtmlProcessing,
				"_fnProcessingDisplay": _fnProcessingDisplay,
				"_fnVisibleToColumnIndex": _fnVisibleToColumnIndex,
				"_fnColumnIndexToVisible": _fnColumnIndexToVisible,
				"_fnNodeToDataIndex": _fnNodeToDataIndex,
				"_fnVisbleColumns": _fnVisbleColumns,
				"_fnCalculateEnd": _fnCalculateEnd,
				"_fnConvertToWidth": _fnConvertToWidth,
				"_fnCalculateColumnWidths": _fnCalculateColumnWidths,
				"_fnScrollingWidthAdjust": _fnScrollingWidthAdjust,
				"_fnGetWidestNode": _fnGetWidestNode,
				"_fnGetMaxLenString": _fnGetMaxLenString,
				"_fnStringToCss": _fnStringToCss,
				"_fnDetectType": _fnDetectType,
				"_fnSettingsFromNode": _fnSettingsFromNode,
				"_fnGetDataMaster": _fnGetDataMaster,
				"_fnGetTrNodes": _fnGetTrNodes,
				"_fnGetTdNodes": _fnGetTdNodes,
				"_fnEscapeRegex": _fnEscapeRegex,
				"_fnDeleteIndex": _fnDeleteIndex,
				"_fnReOrderIndex": _fnReOrderIndex,
				"_fnColumnOrdering": _fnColumnOrdering,
				"_fnLog": _fnLog,
				"_fnClearTable": _fnClearTable,
				"_fnSaveState": _fnSaveState,
				"_fnLoadState": _fnLoadState,
				"_fnCreateCookie": _fnCreateCookie,
				"_fnReadCookie": _fnReadCookie,
				"_fnDetectHeader": _fnDetectHeader,
				"_fnGetUniqueThs": _fnGetUniqueThs,
				"_fnScrollBarWidth": _fnScrollBarWidth,
				"_fnApplyToChildren": _fnApplyToChildren,
				"_fnMap": _fnMap,
				"_fnGetRowData": _fnGetRowData,
				"_fnGetCellData": _fnGetCellData,
				"_fnSetCellData": _fnSetCellData,
				"_fnGetObjectDataFn": _fnGetObjectDataFn,
				"_fnSetObjectDataFn": _fnSetObjectDataFn,
				"_fnApplyColumnDefs": _fnApplyColumnDefs,
				"_fnBindAction": _fnBindAction,
				"_fnExtend": _fnExtend,
				"_fnCallbackReg": _fnCallbackReg,
				"_fnCallbackFire": _fnCallbackFire,
				"_fnJsonString": _fnJsonString,
				"_fnRender": _fnRender,
				"_fnNodeToColumnIndex": _fnNodeToColumnIndex,
				"_fnInfoMacros": _fnInfoMacros,
				"_fnBrowserDetect": _fnBrowserDetect,
				"_fnGetColumns": _fnGetColumns
			};

			$.extend( DataTable.ext.oApi, this.oApi );

			for ( var sFunc in DataTable.ext.oApi )
			{
				if ( sFunc )
				{
					this[sFunc] = _fnExternApiFunc(sFunc);
				}
			}


			var _that = this;
			this.each(function() {
				var i=0, iLen, j, jLen, k, kLen;
				var sId = this.getAttribute( 'id' );
				var bInitHandedOff = false;
				var bUsePassedData = false;


				/* Sanity check */
				if ( this.nodeName.toLowerCase() != 'table' )
				{
					_fnLog( null, 0, "Attempted to initialise DataTables on a node which is not a "+
						"table: "+this.nodeName );
					return;
				}

				/* Check to see if we are re-initialising a table */
				for ( i=0, iLen=DataTable.settings.length ; i<iLen ; i++ )
				{
					/* Base check on table node */
					if ( DataTable.settings[i].nTable == this )
					{
						if ( oInit === undefined || oInit.bRetrieve )
						{
							return DataTable.settings[i].oInstance;
						}
						else if ( oInit.bDestroy )
						{
							DataTable.settings[i].oInstance.fnDestroy();
							break;
						}
						else
						{
							_fnLog( DataTable.settings[i], 0, "Cannot reinitialise DataTable.\n\n"+
								"To retrieve the DataTables object for this table, pass no arguments or see "+
								"the docs for bRetrieve and bDestroy" );
							return;
						}
					}

					/* If the element we are initialising has the same ID as a table which was previously
					 * initialised, but the table nodes don't match (from before) then we destroy the old
					 * instance by simply deleting it. This is under the assumption that the table has been
					 * destroyed by other methods. Anyone using non-id selectors will need to do this manually
					 */
					if ( DataTable.settings[i].sTableId == this.id )
					{
						DataTable.settings.splice( i, 1 );
						break;
					}
				}

				/* Ensure the table has an ID - required for accessibility */
				if ( sId === null || sId === "" )
				{
					sId = "DataTables_Table_"+(DataTable.ext._oExternConfig.iNextUnique++);
					this.id = sId;
				}

				/* Create the settings object for this table and set some of the default parameters */
				var oSettings = $.extend( true, {}, DataTable.models.oSettings, {
					"nTable":        this,
					"oApi":          _that.oApi,
					"oInit":         oInit,
					"sDestroyWidth": $(this).width(),
					"sInstance":     sId,
					"sTableId":      sId
				} );
				DataTable.settings.push( oSettings );

				// Need to add the instance after the instance after the settings object has been added
				// to the settings array, so we can self reference the table instance if more than one
				oSettings.oInstance = (_that.length===1) ? _that : $(this).dataTable();

				/* Setting up the initialisation object */
				if ( !oInit )
				{
					oInit = {};
				}

				// Backwards compatibility, before we apply all the defaults
				if ( oInit.oLanguage )
				{
					_fnLanguageCompat( oInit.oLanguage );
				}

				oInit = _fnExtend( $.extend(true, {}, DataTable.defaults), oInit );

				// Map the initialisation options onto the settings object
				_fnMap( oSettings.oFeatures, oInit, "bPaginate" );
				_fnMap( oSettings.oFeatures, oInit, "bLengthChange" );
				_fnMap( oSettings.oFeatures, oInit, "bFilter" );
				_fnMap( oSettings.oFeatures, oInit, "bSort" );
				_fnMap( oSettings.oFeatures, oInit, "bInfo" );
				_fnMap( oSettings.oFeatures, oInit, "bProcessing" );
				_fnMap( oSettings.oFeatures, oInit, "bAutoWidth" );
				_fnMap( oSettings.oFeatures, oInit, "bSortClasses" );
				_fnMap( oSettings.oFeatures, oInit, "bServerSide" );
				_fnMap( oSettings.oFeatures, oInit, "bDeferRender" );
				_fnMap( oSettings.oScroll, oInit, "sScrollX", "sX" );
				_fnMap( oSettings.oScroll, oInit, "sScrollXInner", "sXInner" );
				_fnMap( oSettings.oScroll, oInit, "sScrollY", "sY" );
				_fnMap( oSettings.oScroll, oInit, "bScrollCollapse", "bCollapse" );
				_fnMap( oSettings.oScroll, oInit, "bScrollInfinite", "bInfinite" );
				_fnMap( oSettings.oScroll, oInit, "iScrollLoadGap", "iLoadGap" );
				_fnMap( oSettings.oScroll, oInit, "bScrollAutoCss", "bAutoCss" );
				_fnMap( oSettings, oInit, "asStripeClasses" );
				_fnMap( oSettings, oInit, "asStripClasses", "asStripeClasses" ); // legacy
				_fnMap( oSettings, oInit, "fnServerData" );
				_fnMap( oSettings, oInit, "fnFormatNumber" );
				_fnMap( oSettings, oInit, "sServerMethod" );
				_fnMap( oSettings, oInit, "aaSorting" );
				_fnMap( oSettings, oInit, "aaSortingFixed" );
				_fnMap( oSettings, oInit, "aLengthMenu" );
				_fnMap( oSettings, oInit, "sPaginationType" );
				_fnMap( oSettings, oInit, "sAjaxSource" );
				_fnMap( oSettings, oInit, "sAjaxDataProp" );
				_fnMap( oSettings, oInit, "iCookieDuration" );
				_fnMap( oSettings, oInit, "sCookiePrefix" );
				_fnMap( oSettings, oInit, "sDom" );
				_fnMap( oSettings, oInit, "bSortCellsTop" );
				_fnMap( oSettings, oInit, "iTabIndex" );
				_fnMap( oSettings, oInit, "oSearch", "oPreviousSearch" );
				_fnMap( oSettings, oInit, "aoSearchCols", "aoPreSearchCols" );
				_fnMap( oSettings, oInit, "iDisplayLength", "_iDisplayLength" );
				_fnMap( oSettings, oInit, "bJQueryUI", "bJUI" );
				_fnMap( oSettings, oInit, "fnCookieCallback" );
				_fnMap( oSettings, oInit, "fnStateLoad" );
				_fnMap( oSettings, oInit, "fnStateSave" );
				_fnMap( oSettings.oLanguage, oInit, "fnInfoCallback" );

				/* Callback functions which are array driven */
				_fnCallbackReg( oSettings, 'aoDrawCallback',       oInit.fnDrawCallback,      'user' );
				_fnCallbackReg( oSettings, 'aoServerParams',       oInit.fnServerParams,      'user' );
				_fnCallbackReg( oSettings, 'aoStateSaveParams',    oInit.fnStateSaveParams,   'user' );
				_fnCallbackReg( oSettings, 'aoStateLoadParams',    oInit.fnStateLoadParams,   'user' );
				_fnCallbackReg( oSettings, 'aoStateLoaded',        oInit.fnStateLoaded,       'user' );
				_fnCallbackReg( oSettings, 'aoRowCallback',        oInit.fnRowCallback,       'user' );
				_fnCallbackReg( oSettings, 'aoRowCreatedCallback', oInit.fnCreatedRow,        'user' );
				_fnCallbackReg( oSettings, 'aoHeaderCallback',     oInit.fnHeaderCallback,    'user' );
				_fnCallbackReg( oSettings, 'aoFooterCallback',     oInit.fnFooterCallback,    'user' );
				_fnCallbackReg( oSettings, 'aoInitComplete',       oInit.fnInitComplete,      'user' );
				_fnCallbackReg( oSettings, 'aoPreDrawCallback',    oInit.fnPreDrawCallback,   'user' );

				if ( oSettings.oFeatures.bServerSide && oSettings.oFeatures.bSort &&
					oSettings.oFeatures.bSortClasses )
				{
					/* Enable sort classes for server-side processing. Safe to do it here, since server-side
					 * processing must be enabled by the developer
					 */
					_fnCallbackReg( oSettings, 'aoDrawCallback', _fnSortingClasses, 'server_side_sort_classes' );
				}
				else if ( oSettings.oFeatures.bDeferRender )
				{
					_fnCallbackReg( oSettings, 'aoDrawCallback', _fnSortingClasses, 'defer_sort_classes' );
				}

				if ( oInit.bJQueryUI )
				{
					/* Use the JUI classes object for display. You could clone the oStdClasses object if 
					 * you want to have multiple tables with multiple independent classes 
					 */
					$.extend( oSettings.oClasses, DataTable.ext.oJUIClasses );

					if ( oInit.sDom === DataTable.defaults.sDom && DataTable.defaults.sDom === "lfrtip" )
					{
						/* Set the DOM to use a layout suitable for jQuery UI's theming */
						oSettings.sDom = '<"H"lfr>t<"F"ip>';
					}
				}
				else
				{
					$.extend( oSettings.oClasses, DataTable.ext.oStdClasses );
				}
				$(this).addClass( oSettings.oClasses.sTable );

				/* Calculate the scroll bar width and cache it for use later on */
				if ( oSettings.oScroll.sX !== "" || oSettings.oScroll.sY !== "" )
				{
					oSettings.oScroll.iBarWidth = _fnScrollBarWidth();
				}

				if ( oSettings.iInitDisplayStart === undefined )
				{
					/* Display start point, taking into account the save saving */
					oSettings.iInitDisplayStart = oInit.iDisplayStart;
					oSettings._iDisplayStart = oInit.iDisplayStart;
				}

				/* Must be done after everything which can be overridden by a cookie! */
				if ( oInit.bStateSave )
				{
					oSettings.oFeatures.bStateSave = true;
					_fnLoadState( oSettings, oInit );
					_fnCallbackReg( oSettings, 'aoDrawCallback', _fnSaveState, 'state_save' );
				}

				if ( oInit.iDeferLoading !== null )
				{
					oSettings.bDeferLoading = true;
					var tmp = $.isArray( oInit.iDeferLoading );
					oSettings._iRecordsDisplay = tmp ? oInit.iDeferLoading[0] : oInit.iDeferLoading;
					oSettings._iRecordsTotal = tmp ? oInit.iDeferLoading[1] : oInit.iDeferLoading;
				}

				if ( oInit.aaData !== null )
				{
					bUsePassedData = true;
				}

				/* Language definitions */
				if ( oInit.oLanguage.sUrl !== "" )
				{
					/* Get the language definitions from a file - because this Ajax call makes the language
					 * get async to the remainder of this function we use bInitHandedOff to indicate that 
					 * _fnInitialise will be fired by the returned Ajax handler, rather than the constructor
					 */
					oSettings.oLanguage.sUrl = oInit.oLanguage.sUrl;
					$.getJSON( oSettings.oLanguage.sUrl, null, function( json ) {
						_fnLanguageCompat( json );
						$.extend( true, oSettings.oLanguage, oInit.oLanguage, json );
						_fnInitialise( oSettings );
					} );
					bInitHandedOff = true;
				}
				else
				{
					$.extend( true, oSettings.oLanguage, oInit.oLanguage );
				}


				/*
				 * Stripes
				 */
				if ( oInit.asStripeClasses === null )
				{
					oSettings.asStripeClasses =[
						oSettings.oClasses.sStripeOdd,
						oSettings.oClasses.sStripeEven
					];
				}

				/* Remove row stripe classes if they are already on the table row */
				iLen=oSettings.asStripeClasses.length;
				oSettings.asDestroyStripes = [];
				if (iLen)
				{
					var bStripeRemove = false;
					var anRows = $(this).children('tbody').children('tr:lt(' + iLen + ')');
					for ( i=0 ; i<iLen ; i++ )
					{
						if ( anRows.hasClass( oSettings.asStripeClasses[i] ) )
						{
							bStripeRemove = true;

							/* Store the classes which we are about to remove so they can be re-added on destroy */
							oSettings.asDestroyStripes.push( oSettings.asStripeClasses[i] );
						}
					}

					if ( bStripeRemove )
					{
						anRows.removeClass( oSettings.asStripeClasses.join(' ') );
					}
				}

				/*
				 * Columns
				 * See if we should load columns automatically or use defined ones
				 */
				var anThs = [];
				var aoColumnsInit;
				var nThead = this.getElementsByTagName('thead');
				if ( nThead.length !== 0 )
				{
					_fnDetectHeader( oSettings.aoHeader, nThead[0] );
					anThs = _fnGetUniqueThs( oSettings );
				}

				/* If not given a column array, generate one with nulls */
				if ( oInit.aoColumns === null )
				{
					aoColumnsInit = [];
					for ( i=0, iLen=anThs.length ; i<iLen ; i++ )
					{
						aoColumnsInit.push( null );
					}
				}
				else
				{
					aoColumnsInit = oInit.aoColumns;
				}

				/* Add the columns */
				for ( i=0, iLen=aoColumnsInit.length ; i<iLen ; i++ )
				{
					/* Short cut - use the loop to check if we have column visibility state to restore */
					if ( oInit.saved_aoColumns !== undefined && oInit.saved_aoColumns.length == iLen )
					{
						if ( aoColumnsInit[i] === null )
						{
							aoColumnsInit[i] = {};
						}
						aoColumnsInit[i].bVisible = oInit.saved_aoColumns[i].bVisible;
					}

					_fnAddColumn( oSettings, anThs ? anThs[i] : null );
				}

				/* Apply the column definitions */
				_fnApplyColumnDefs( oSettings, oInit.aoColumnDefs, aoColumnsInit, function (iCol, oDef) {
					_fnColumnOptions( oSettings, iCol, oDef );
				} );


				/*
				 * Sorting
				 * Check the aaSorting array
				 */
				for ( i=0, iLen=oSettings.aaSorting.length ; i<iLen ; i++ )
				{
					if ( oSettings.aaSorting[i][0] >= oSettings.aoColumns.length )
					{
						oSettings.aaSorting[i][0] = 0;
					}
					var oColumn = oSettings.aoColumns[ oSettings.aaSorting[i][0] ];

					/* Add a default sorting index */
					if ( oSettings.aaSorting[i][2] === undefined )
					{
						oSettings.aaSorting[i][2] = 0;
					}

					/* If aaSorting is not defined, then we use the first indicator in asSorting */
					if ( oInit.aaSorting === undefined && oSettings.saved_aaSorting === undefined )
					{
						oSettings.aaSorting[i][1] = oColumn.asSorting[0];
					}

					/* Set the current sorting index based on aoColumns.asSorting */
					for ( j=0, jLen=oColumn.asSorting.length ; j<jLen ; j++ )
					{
						if ( oSettings.aaSorting[i][1] == oColumn.asSorting[j] )
						{
							oSettings.aaSorting[i][2] = j;
							break;
						}
					}
				}

				/* Do a first pass on the sorting classes (allows any size changes to be taken into
				 * account, and also will apply sorting disabled classes if disabled
				 */
				_fnSortingClasses( oSettings );


				/*
				 * Final init
				 * Cache the header, body and footer as required, creating them if needed
				 */

				/* Browser support detection */
				_fnBrowserDetect( oSettings );

				// Work around for Webkit bug 83867 - store the caption-side before removing from doc
				var captions = $(this).children('caption').each( function () {
					this._captionSide = $(this).css('caption-side');
				} );

				var thead = $(this).children('thead');
				if ( thead.length === 0 )
				{
					thead = [ document.createElement( 'thead' ) ];
					this.appendChild( thead[0] );
				}
				oSettings.nTHead = thead[0];

				var tbody = $(this).children('tbody');
				if ( tbody.length === 0 )
				{
					tbody = [ document.createElement( 'tbody' ) ];
					this.appendChild( tbody[0] );
				}
				oSettings.nTBody = tbody[0];
				oSettings.nTBody.setAttribute( "role", "alert" );
				oSettings.nTBody.setAttribute( "aria-live", "polite" );
				oSettings.nTBody.setAttribute( "aria-relevant", "all" );

				var tfoot = $(this).children('tfoot');
				if ( tfoot.length === 0 && captions.length > 0 && (oSettings.oScroll.sX !== "" || oSettings.oScroll.sY !== "") )
				{
					// If we are a scrolling table, and no footer has been given, then we need to create
					// a tfoot element for the caption element to be appended to
					tfoot = [ document.createElement( 'tfoot' ) ];
					this.appendChild( tfoot[0] );
				}

				if ( tfoot.length > 0 )
				{
					oSettings.nTFoot = tfoot[0];
					_fnDetectHeader( oSettings.aoFooter, oSettings.nTFoot );
				}

				/* Check if there is data passing into the constructor */
				if ( bUsePassedData )
				{
					for ( i=0 ; i<oInit.aaData.length ; i++ )
					{
						_fnAddData( oSettings, oInit.aaData[ i ] );
					}
				}
				else
				{
					/* Grab the data from the page */
					_fnGatherData( oSettings );
				}

				/* Copy the data index array */
				oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

				/* Initialisation complete - table can be drawn */
				oSettings.bInitialised = true;

				/* Check if we need to initialise the table (it might not have been handed off to the
				 * language processor)
				 */
				if ( bInitHandedOff === false )
				{
					_fnInitialise( oSettings );
				}
			} );
			_that = null;
			return this;
		};



		/**
		 * Provide a common method for plug-ins to check the version of DataTables being used, in order
		 * to ensure compatibility.
		 *  @param {string} sVersion Version string to check for, in the format "X.Y.Z". Note that the
		 *    formats "X" and "X.Y" are also acceptable.
		 *  @returns {boolean} true if this version of DataTables is greater or equal to the required
		 *    version, or false if this version of DataTales is not suitable
		 *  @static
		 *  @dtopt API-Static
		 *
		 *  @example
		 *    alert( $.fn.dataTable.fnVersionCheck( '1.9.0' ) );
		 */
		DataTable.fnVersionCheck = function( sVersion )
		{
			/* This is cheap, but effective */
			var fnZPad = function (Zpad, count)
			{
				while(Zpad.length < count) {
					Zpad += '0';
				}
				return Zpad;
			};
			var aThis = DataTable.ext.sVersion.split('.');
			var aThat = sVersion.split('.');
			var sThis = '', sThat = '';

			for ( var i=0, iLen=aThat.length ; i<iLen ; i++ )
			{
				sThis += fnZPad( aThis[i], 3 );
				sThat += fnZPad( aThat[i], 3 );
			}

			return parseInt(sThis, 10) >= parseInt(sThat, 10);
		};


		/**
		 * Check if a TABLE node is a DataTable table already or not.
		 *  @param {node} nTable The TABLE node to check if it is a DataTable or not (note that other
		 *    node types can be passed in, but will always return false).
		 *  @returns {boolean} true the table given is a DataTable, or false otherwise
		 *  @static
		 *  @dtopt API-Static
		 *
		 *  @example
		 *    var ex = document.getElementById('example');
		 *    if ( ! $.fn.DataTable.fnIsDataTable( ex ) ) {
	 *      $(ex).dataTable();
	 *    }
		 */
		DataTable.fnIsDataTable = function ( nTable )
		{
			var o = DataTable.settings;

			for ( var i=0 ; i<o.length ; i++ )
			{
				if ( o[i].nTable === nTable || o[i].nScrollHead === nTable || o[i].nScrollFoot === nTable )
				{
					return true;
				}
			}

			return false;
		};


		/**
		 * Get all DataTable tables that have been initialised - optionally you can select to
		 * get only currently visible tables.
		 *  @param {boolean} [bVisible=false] Flag to indicate if you want all (default) or
		 *    visible tables only.
		 *  @returns {array} Array of TABLE nodes (not DataTable instances) which are DataTables
		 *  @static
		 *  @dtopt API-Static
		 *
		 *  @example
		 *    var table = $.fn.dataTable.fnTables(true);
		 *    if ( table.length > 0 ) {
	 *      $(table).dataTable().fnAdjustColumnSizing();
	 *    }
		 */
		DataTable.fnTables = function ( bVisible )
		{
			var out = [];

			jQuery.each( DataTable.settings, function (i, o) {
				if ( !bVisible || (bVisible === true && $(o.nTable).is(':visible')) )
				{
					out.push( o.nTable );
				}
			} );

			return out;
		};


		/**
		 * Version string for plug-ins to check compatibility. Allowed format is
		 * a.b.c.d.e where: a:int, b:int, c:int, d:string(dev|beta), e:int. d and
		 * e are optional
		 *  @member
		 *  @type string
		 *  @default Version number
		 */
		DataTable.version = "1.9.4";

		/**
		 * Private data store, containing all of the settings objects that are created for the
		 * tables on a given page.
		 *
		 * Note that the <i>DataTable.settings</i> object is aliased to <i>jQuery.fn.dataTableExt</i>
		 * through which it may be accessed and manipulated, or <i>jQuery.fn.dataTable.settings</i>.
		 *  @member
		 *  @type array
		 *  @default []
		 *  @private
		 */
		DataTable.settings = [];

		/**
		 * Object models container, for the various models that DataTables has available
		 * to it. These models define the objects that are used to hold the active state
		 * and configuration of the table.
		 *  @namespace
		 */
		DataTable.models = {};


		/**
		 * DataTables extension options and plug-ins. This namespace acts as a collection "area"
		 * for plug-ins that can be used to extend the default DataTables behaviour - indeed many
		 * of the build in methods use this method to provide their own capabilities (sorting methods
		 * for example).
		 *
		 * Note that this namespace is aliased to jQuery.fn.dataTableExt so it can be readily accessed
		 * and modified by plug-ins.
		 *  @namespace
		 */
		DataTable.models.ext = {
			/**
			 * Plug-in filtering functions - this method of filtering is complimentary to the default
			 * type based filtering, and a lot more comprehensive as it allows you complete control
			 * over the filtering logic. Each element in this array is a function (parameters
			 * described below) that is called for every row in the table, and your logic decides if
			 * it should be included in the filtered data set or not.
			 *   <ul>
			 *     <li>
			 *       Function input parameters:
			 *       <ul>
			 *         <li>{object} DataTables settings object: see {@link DataTable.models.oSettings}.</li>
			 *         <li>{array|object} Data for the row to be processed (same as the original format
			 *           that was passed in as the data source, or an array from a DOM data source</li>
			 *         <li>{int} Row index in aoData ({@link DataTable.models.oSettings.aoData}), which can
			 *           be useful to retrieve the TR element if you need DOM interaction.</li>
			 *       </ul>
			 *     </li>
			 *     <li>
			 *       Function return:
			 *       <ul>
			 *         <li>{boolean} Include the row in the filtered result set (true) or not (false)</li>
			 *       </ul>
			 *     </il>
			 *   </ul>
			 *  @type array
			 *  @default []
			 *
			 *  @example
			 *    // The following example shows custom filtering being applied to the fourth column (i.e.
			 *    // the aData[3] index) based on two input values from the end-user, matching the data in
			 *    // a certain range.
			 *    $.fn.dataTableExt.afnFiltering.push(
			 *      function( oSettings, aData, iDataIndex ) {
		 *        var iMin = document.getElementById('min').value * 1;
		 *        var iMax = document.getElementById('max').value * 1;
		 *        var iVersion = aData[3] == "-" ? 0 : aData[3]*1;
		 *        if ( iMin == "" && iMax == "" ) {
		 *          return true;
		 *        }
		 *        else if ( iMin == "" && iVersion < iMax ) {
		 *          return true;
		 *        }
		 *        else if ( iMin < iVersion && "" == iMax ) {
		 *          return true;
		 *        }
		 *        else if ( iMin < iVersion && iVersion < iMax ) {
		 *          return true;
		 *        }
		 *        return false;
		 *      }
			 *    );
			 */
			"afnFiltering": [],


			/**
			 * Plug-in sorting functions - this method of sorting is complimentary to the default type
			 * based sorting that DataTables does automatically, allowing much greater control over the
			 * the data that is being used to sort a column. This is useful if you want to do sorting
			 * based on live data (for example the contents of an 'input' element) rather than just the
			 * static string that DataTables knows of. The way these plug-ins work is that you create
			 * an array of the values you wish to be sorted for the column in question and then return
			 * that array. Which pre-sorting function is run here depends on the sSortDataType parameter
			 * that is used for the column (if any). This is the corollary of <i>ofnSearch</i> for sort
			 * data.
			 *   <ul>
			 *     <li>
			 *       Function input parameters:
			 *       <ul>
			 *         <li>{object} DataTables settings object: see {@link DataTable.models.oSettings}.</li>
			 *         <li>{int} Target column index</li>
			 *       </ul>
			 *     </li>
			 *     <li>
			 *       Function return:
			 *       <ul>
			 *         <li>{array} Data for the column to be sorted upon</li>
			 *       </ul>
			 *     </il>
			 *   </ul>
			 *
			 * Note that as of v1.9, it is typically preferable to use <i>mData</i> to prepare data for
			 * the different uses that DataTables can put the data to. Specifically <i>mData</i> when
			 * used as a function will give you a 'type' (sorting, filtering etc) that you can use to
			 * prepare the data as required for the different types. As such, this method is deprecated.
			 *  @type array
			 *  @default []
			 *  @deprecated
			 *
			 *  @example
			 *    // Updating the cached sorting information with user entered values in HTML input elements
			 *    jQuery.fn.dataTableExt.afnSortData['dom-text'] = function ( oSettings, iColumn )
			 *    {
		 *      var aData = [];
		 *      $( 'td:eq('+iColumn+') input', oSettings.oApi._fnGetTrNodes(oSettings) ).each( function () {
		 *        aData.push( this.value );
		 *      } );
		 *      return aData;
		 *    }
			 */
			"afnSortData": [],


			/**
			 * Feature plug-ins - This is an array of objects which describe the feature plug-ins that are
			 * available to DataTables. These feature plug-ins are accessible through the sDom initialisation
			 * option. As such, each feature plug-in must describe a function that is used to initialise
			 * itself (fnInit), a character so the feature can be enabled by sDom (cFeature) and the name
			 * of the feature (sFeature). Thus the objects attached to this method must provide:
			 *   <ul>
			 *     <li>{function} fnInit Initialisation of the plug-in
			 *       <ul>
			 *         <li>
			 *           Function input parameters:
			 *           <ul>
			 *             <li>{object} DataTables settings object: see {@link DataTable.models.oSettings}.</li>
			 *           </ul>
			 *         </li>
			 *         <li>
			 *           Function return:
			 *           <ul>
			 *             <li>{node|null} The element which contains your feature. Note that the return
			 *                may also be void if your plug-in does not require to inject any DOM elements
			 *                into DataTables control (sDom) - for example this might be useful when
			 *                developing a plug-in which allows table control via keyboard entry.</li>
			 *           </ul>
			 *         </il>
			 *       </ul>
			 *     </li>
			 *     <li>{character} cFeature Character that will be matched in sDom - case sensitive</li>
			 *     <li>{string} sFeature Feature name</li>
			 *   </ul>
			 *  @type array
			 *  @default []
			 *
			 *  @example
			 *    // How TableTools initialises itself.
			 *    $.fn.dataTableExt.aoFeatures.push( {
		 *      "fnInit": function( oSettings ) {
		 *        return new TableTools( { "oDTSettings": oSettings } );
		 *      },
		 *      "cFeature": "T",
		 *      "sFeature": "TableTools"
		 *    } );
			 */
			"aoFeatures": [],


			/**
			 * Type detection plug-in functions - DataTables utilises types to define how sorting and
			 * filtering behave, and types can be either  be defined by the developer (sType for the
			 * column) or they can be automatically detected by the methods in this array. The functions
			 * defined in the array are quite simple, taking a single parameter (the data to analyse)
			 * and returning the type if it is a known type, or null otherwise.
			 *   <ul>
			 *     <li>
			 *       Function input parameters:
			 *       <ul>
			 *         <li>{*} Data from the column cell to be analysed</li>
			 *       </ul>
			 *     </li>
			 *     <li>
			 *       Function return:
			 *       <ul>
			 *         <li>{string|null} Data type detected, or null if unknown (and thus pass it
			 *           on to the other type detection functions.</li>
			 *       </ul>
			 *     </il>
			 *   </ul>
			 *  @type array
			 *  @default []
			 *
			 *  @example
			 *    // Currency type detection plug-in:
			 *    jQuery.fn.dataTableExt.aTypes.push(
			 *      function ( sData ) {
		 *        var sValidChars = "0123456789.-";
		 *        var Char;
		 *        
		 *        // Check the numeric part
		 *        for ( i=1 ; i<sData.length ; i++ ) {
		 *          Char = sData.charAt(i); 
		 *          if (sValidChars.indexOf(Char) == -1) {
		 *            return null;
		 *          }
		 *        }
		 *        
		 *        // Check prefixed by currency
		 *        if ( sData.charAt(0) == '$' || sData.charAt(0) == '&pound;' ) {
		 *          return 'currency';
		 *        }
		 *        return null;
		 *      }
			 *    );
			 */
			"aTypes": [],


			/**
			 * Provide a common method for plug-ins to check the version of DataTables being used,
			 * in order to ensure compatibility.
			 *  @type function
			 *  @param {string} sVersion Version string to check for, in the format "X.Y.Z". Note
			 *    that the formats "X" and "X.Y" are also acceptable.
			 *  @returns {boolean} true if this version of DataTables is greater or equal to the
			 *    required version, or false if this version of DataTales is not suitable
			 *
			 *  @example
			 *    $(document).ready(function() {
		 *      var oTable = $('#example').dataTable();
		 *      alert( oTable.fnVersionCheck( '1.9.0' ) );
		 *    } );
			 */
			"fnVersionCheck": DataTable.fnVersionCheck,


			/**
			 * Index for what 'this' index API functions should use
			 *  @type int
			 *  @default 0
			 */
			"iApiIndex": 0,


			/**
			 * Pre-processing of filtering data plug-ins - When you assign the sType for a column
			 * (or have it automatically detected for you by DataTables or a type detection plug-in),
			 * you will typically be using this for custom sorting, but it can also be used to provide
			 * custom filtering by allowing you to pre-processing the data and returning the data in
			 * the format that should be filtered upon. This is done by adding functions this object
			 * with a parameter name which matches the sType for that target column. This is the
			 * corollary of <i>afnSortData</i> for filtering data.
			 *   <ul>
			 *     <li>
			 *       Function input parameters:
			 *       <ul>
			 *         <li>{*} Data from the column cell to be prepared for filtering</li>
			 *       </ul>
			 *     </li>
			 *     <li>
			 *       Function return:
			 *       <ul>
			 *         <li>{string|null} Formatted string that will be used for the filtering.</li>
			 *       </ul>
			 *     </il>
			 *   </ul>
			 *
			 * Note that as of v1.9, it is typically preferable to use <i>mData</i> to prepare data for
			 * the different uses that DataTables can put the data to. Specifically <i>mData</i> when
			 * used as a function will give you a 'type' (sorting, filtering etc) that you can use to
			 * prepare the data as required for the different types. As such, this method is deprecated.
			 *  @type object
			 *  @default {}
			 *  @deprecated
			 *
			 *  @example
			 *    $.fn.dataTableExt.ofnSearch['title-numeric'] = function ( sData ) {
		 *      return sData.replace(/\n/g," ").replace( /<.*?>/g, "" );
		 *    }
			 */
			"ofnSearch": {},


			/**
			 * Container for all private functions in DataTables so they can be exposed externally
			 *  @type object
			 *  @default {}
			 */
			"oApi": {},


			/**
			 * Storage for the various classes that DataTables uses
			 *  @type object
			 *  @default {}
			 */
			"oStdClasses": {},


			/**
			 * Storage for the various classes that DataTables uses - jQuery UI suitable
			 *  @type object
			 *  @default {}
			 */
			"oJUIClasses": {},


			/**
			 * Pagination plug-in methods - The style and controls of the pagination can significantly
			 * impact on how the end user interacts with the data in your table, and DataTables allows
			 * the addition of pagination controls by extending this object, which can then be enabled
			 * through the <i>sPaginationType</i> initialisation parameter. Each pagination type that
			 * is added is an object (the property name of which is what <i>sPaginationType</i> refers
			 * to) that has two properties, both methods that are used by DataTables to update the
			 * control's state.
			 *   <ul>
			 *     <li>
			 *       fnInit -  Initialisation of the paging controls. Called only during initialisation
			 *         of the table. It is expected that this function will add the required DOM elements
			 *         to the page for the paging controls to work. The element pointer
			 *         'oSettings.aanFeatures.p' array is provided by DataTables to contain the paging
			 *         controls (note that this is a 2D array to allow for multiple instances of each
			 *         DataTables DOM element). It is suggested that you add the controls to this element
			 *         as children
			 *       <ul>
			 *         <li>
			 *           Function input parameters:
			 *           <ul>
			 *             <li>{object} DataTables settings object: see {@link DataTable.models.oSettings}.</li>
			 *             <li>{node} Container into which the pagination controls must be inserted</li>
			 *             <li>{function} Draw callback function - whenever the controls cause a page
			 *               change, this method must be called to redraw the table.</li>
			 *           </ul>
			 *         </li>
			 *         <li>
			 *           Function return:
			 *           <ul>
			 *             <li>No return required</li>
			 *           </ul>
			 *         </il>
			 *       </ul>
			 *     </il>
			 *     <li>
			 *       fnInit -  This function is called whenever the paging status of the table changes and is
			 *         typically used to update classes and/or text of the paging controls to reflex the new
			 *         status.
			 *       <ul>
			 *         <li>
			 *           Function input parameters:
			 *           <ul>
			 *             <li>{object} DataTables settings object: see {@link DataTable.models.oSettings}.</li>
			 *             <li>{function} Draw callback function - in case you need to redraw the table again
			 *               or attach new event listeners</li>
			 *           </ul>
			 *         </li>
			 *         <li>
			 *           Function return:
			 *           <ul>
			 *             <li>No return required</li>
			 *           </ul>
			 *         </il>
			 *       </ul>
			 *     </il>
			 *   </ul>
			 *  @type object
			 *  @default {}
			 *
			 *  @example
			 *    $.fn.dataTableExt.oPagination.four_button = {
		 *      "fnInit": function ( oSettings, nPaging, fnCallbackDraw ) {
		 *        nFirst = document.createElement( 'span' );
		 *        nPrevious = document.createElement( 'span' );
		 *        nNext = document.createElement( 'span' );
		 *        nLast = document.createElement( 'span' );
		 *        
		 *        nFirst.appendChild( document.createTextNode( oSettings.oLanguage.oPaginate.sFirst ) );
		 *        nPrevious.appendChild( document.createTextNode( oSettings.oLanguage.oPaginate.sPrevious ) );
		 *        nNext.appendChild( document.createTextNode( oSettings.oLanguage.oPaginate.sNext ) );
		 *        nLast.appendChild( document.createTextNode( oSettings.oLanguage.oPaginate.sLast ) );
		 *        
		 *        nFirst.className = "paginate_button first";
		 *        nPrevious.className = "paginate_button previous";
		 *        nNext.className="paginate_button next";
		 *        nLast.className = "paginate_button last";
		 *        
		 *        nPaging.appendChild( nFirst );
		 *        nPaging.appendChild( nPrevious );
		 *        nPaging.appendChild( nNext );
		 *        nPaging.appendChild( nLast );
		 *        
		 *        $(nFirst).click( function () {
		 *          oSettings.oApi._fnPageChange( oSettings, "first" );
		 *          fnCallbackDraw( oSettings );
		 *        } );
		 *        
		 *        $(nPrevious).click( function() {
		 *          oSettings.oApi._fnPageChange( oSettings, "previous" );
		 *          fnCallbackDraw( oSettings );
		 *        } );
		 *        
		 *        $(nNext).click( function() {
		 *          oSettings.oApi._fnPageChange( oSettings, "next" );
		 *          fnCallbackDraw( oSettings );
		 *        } );
		 *        
		 *        $(nLast).click( function() {
		 *          oSettings.oApi._fnPageChange( oSettings, "last" );
		 *          fnCallbackDraw( oSettings );
		 *        } );
		 *        
		 *        $(nFirst).bind( 'selectstart', function () { return false; } );
		 *        $(nPrevious).bind( 'selectstart', function () { return false; } );
		 *        $(nNext).bind( 'selectstart', function () { return false; } );
		 *        $(nLast).bind( 'selectstart', function () { return false; } );
		 *      },
		 *      
		 *      "fnUpdate": function ( oSettings, fnCallbackDraw ) {
		 *        if ( !oSettings.aanFeatures.p ) {
		 *          return;
		 *        }
		 *        
		 *        // Loop over each instance of the pager
		 *        var an = oSettings.aanFeatures.p;
		 *        for ( var i=0, iLen=an.length ; i<iLen ; i++ ) {
		 *          var buttons = an[i].getElementsByTagName('span');
		 *          if ( oSettings._iDisplayStart === 0 ) {
		 *            buttons[0].className = "paginate_disabled_previous";
		 *            buttons[1].className = "paginate_disabled_previous";
		 *          }
		 *          else {
		 *            buttons[0].className = "paginate_enabled_previous";
		 *            buttons[1].className = "paginate_enabled_previous";
		 *          }
		 *          
		 *          if ( oSettings.fnDisplayEnd() == oSettings.fnRecordsDisplay() ) {
		 *            buttons[2].className = "paginate_disabled_next";
		 *            buttons[3].className = "paginate_disabled_next";
		 *          }
		 *          else {
		 *            buttons[2].className = "paginate_enabled_next";
		 *            buttons[3].className = "paginate_enabled_next";
		 *          }
		 *        }
		 *      }
		 *    };
			 */
			"oPagination": {},


			/**
			 * Sorting plug-in methods - Sorting in DataTables is based on the detected type of the
			 * data column (you can add your own type detection functions, or override automatic
			 * detection using sType). With this specific type given to the column, DataTables will
			 * apply the required sort from the functions in the object. Each sort type must provide
			 * two mandatory methods, one each for ascending and descending sorting, and can optionally
			 * provide a pre-formatting method that will help speed up sorting by allowing DataTables
			 * to pre-format the sort data only once (rather than every time the actual sort functions
			 * are run). The two sorting functions are typical Javascript sort methods:
			 *   <ul>
			 *     <li>
			 *       Function input parameters:
			 *       <ul>
			 *         <li>{*} Data to compare to the second parameter</li>
			 *         <li>{*} Data to compare to the first parameter</li>
			 *       </ul>
			 *     </li>
			 *     <li>
			 *       Function return:
			 *       <ul>
			 *         <li>{int} Sorting match: <0 if first parameter should be sorted lower than
			 *           the second parameter, ===0 if the two parameters are equal and >0 if
			 *           the first parameter should be sorted height than the second parameter.</li>
			 *       </ul>
			 *     </il>
			 *   </ul>
			 *  @type object
			 *  @default {}
			 *
			 *  @example
			 *    // Case-sensitive string sorting, with no pre-formatting method
			 *    $.extend( $.fn.dataTableExt.oSort, {
		 *      "string-case-asc": function(x,y) {
		 *        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
		 *      },
		 *      "string-case-desc": function(x,y) {
		 *        return ((x < y) ? 1 : ((x > y) ? -1 : 0));
		 *      }
		 *    } );
			 *
			 *  @example
			 *    // Case-insensitive string sorting, with pre-formatting
			 *    $.extend( $.fn.dataTableExt.oSort, {
		 *      "string-pre": function(x) {
		 *        return x.toLowerCase();
		 *      },
		 *      "string-asc": function(x,y) {
		 *        return ((x < y) ? -1 : ((x > y) ? 1 : 0));
		 *      },
		 *      "string-desc": function(x,y) {
		 *        return ((x < y) ? 1 : ((x > y) ? -1 : 0));
		 *      }
		 *    } );
			 */
			"oSort": {},


			/**
			 * Version string for plug-ins to check compatibility. Allowed format is
			 * a.b.c.d.e where: a:int, b:int, c:int, d:string(dev|beta), e:int. d and
			 * e are optional
			 *  @type string
			 *  @default Version number
			 */
			"sVersion": DataTable.version,


			/**
			 * How should DataTables report an error. Can take the value 'alert' or 'throw'
			 *  @type string
			 *  @default alert
			 */
			"sErrMode": "alert",


			/**
			 * Store information for DataTables to access globally about other instances
			 *  @namespace
			 *  @private
			 */
			"_oExternConfig": {
				/* int:iNextUnique - next unique number for an instance */
				"iNextUnique": 0
			}
		};




		/**
		 * Template object for the way in which DataTables holds information about
		 * search information for the global filter and individual column filters.
		 *  @namespace
		 */
		DataTable.models.oSearch = {
			/**
			 * Flag to indicate if the filtering should be case insensitive or not
			 *  @type boolean
			 *  @default true
			 */
			"bCaseInsensitive": true,

			/**
			 * Applied search term
			 *  @type string
			 *  @default <i>Empty string</i>
			 */
			"sSearch": "",

			/**
			 * Flag to indicate if the search term should be interpreted as a
			 * regular expression (true) or not (false) and therefore and special
			 * regex characters escaped.
			 *  @type boolean
			 *  @default false
			 */
			"bRegex": false,

			/**
			 * Flag to indicate if DataTables is to use its smart filtering or not.
			 *  @type boolean
			 *  @default true
			 */
			"bSmart": true
		};




		/**
		 * Template object for the way in which DataTables holds information about
		 * each individual row. This is the object format used for the settings
		 * aoData array.
		 *  @namespace
		 */
		DataTable.models.oRow = {
			/**
			 * TR element for the row
			 *  @type node
			 *  @default null
			 */
			"nTr": null,

			/**
			 * Data object from the original data source for the row. This is either
			 * an array if using the traditional form of DataTables, or an object if
			 * using mData options. The exact type will depend on the passed in
			 * data from the data source, or will be an array if using DOM a data
			 * source.
			 *  @type array|object
			 *  @default []
			 */
			"_aData": [],

			/**
			 * Sorting data cache - this array is ostensibly the same length as the
			 * number of columns (although each index is generated only as it is
			 * needed), and holds the data that is used for sorting each column in the
			 * row. We do this cache generation at the start of the sort in order that
			 * the formatting of the sort data need be done only once for each cell
			 * per sort. This array should not be read from or written to by anything
			 * other than the master sorting methods.
			 *  @type array
			 *  @default []
			 *  @private
			 */
			"_aSortData": [],

			/**
			 * Array of TD elements that are cached for hidden rows, so they can be
			 * reinserted into the table if a column is made visible again (or to act
			 * as a store if a column is made hidden). Only hidden columns have a
			 * reference in the array. For non-hidden columns the value is either
			 * undefined or null.
			 *  @type array nodes
			 *  @default []
			 *  @private
			 */
			"_anHidden": [],

			/**
			 * Cache of the class name that DataTables has applied to the row, so we
			 * can quickly look at this variable rather than needing to do a DOM check
			 * on className for the nTr property.
			 *  @type string
			 *  @default <i>Empty string</i>
			 *  @private
			 */
			"_sRowStripe": ""
		};



		/**
		 * Template object for the column information object in DataTables. This object
		 * is held in the settings aoColumns array and contains all the information that
		 * DataTables needs about each individual column.
		 *
		 * Note that this object is related to {@link DataTable.defaults.columns}
		 * but this one is the internal data store for DataTables's cache of columns.
		 * It should NOT be manipulated outside of DataTables. Any configuration should
		 * be done through the initialisation options.
		 *  @namespace
		 */
		DataTable.models.oColumn = {
			/**
			 * A list of the columns that sorting should occur on when this column
			 * is sorted. That this property is an array allows multi-column sorting
			 * to be defined for a column (for example first name / last name columns
			 * would benefit from this). The values are integers pointing to the
			 * columns to be sorted on (typically it will be a single integer pointing
			 * at itself, but that doesn't need to be the case).
			 *  @type array
			 */
			"aDataSort": null,

			/**
			 * Define the sorting directions that are applied to the column, in sequence
			 * as the column is repeatedly sorted upon - i.e. the first value is used
			 * as the sorting direction when the column if first sorted (clicked on).
			 * Sort it again (click again) and it will move on to the next index.
			 * Repeat until loop.
			 *  @type array
			 */
			"asSorting": null,

			/**
			 * Flag to indicate if the column is searchable, and thus should be included
			 * in the filtering or not.
			 *  @type boolean
			 */
			"bSearchable": null,

			/**
			 * Flag to indicate if the column is sortable or not.
			 *  @type boolean
			 */
			"bSortable": null,

			/**
			 * <code>Deprecated</code> When using fnRender, you have two options for what
			 * to do with the data, and this property serves as the switch. Firstly, you
			 * can have the sorting and filtering use the rendered value (true - default),
			 * or you can have the sorting and filtering us the original value (false).
			 *
			 * Please note that this option has now been deprecated and will be removed
			 * in the next version of DataTables. Please use mRender / mData rather than
			 * fnRender.
			 *  @type boolean
			 *  @deprecated
			 */
			"bUseRendered": null,

			/**
			 * Flag to indicate if the column is currently visible in the table or not
			 *  @type boolean
			 */
			"bVisible": null,

			/**
			 * Flag to indicate to the type detection method if the automatic type
			 * detection should be used, or if a column type (sType) has been specified
			 *  @type boolean
			 *  @default true
			 *  @private
			 */
			"_bAutoType": true,

			/**
			 * Developer definable function that is called whenever a cell is created (Ajax source,
			 * etc) or processed for input (DOM source). This can be used as a compliment to mRender
			 * allowing you to modify the DOM element (add background colour for example) when the
			 * element is available.
			 *  @type function
			 *  @param {element} nTd The TD node that has been created
			 *  @param {*} sData The Data for the cell
			 *  @param {array|object} oData The data for the whole row
			 *  @param {int} iRow The row index for the aoData data store
			 *  @default null
			 */
			"fnCreatedCell": null,

			/**
			 * Function to get data from a cell in a column. You should <b>never</b>
			 * access data directly through _aData internally in DataTables - always use
			 * the method attached to this property. It allows mData to function as
			 * required. This function is automatically assigned by the column
			 * initialisation method
			 *  @type function
			 *  @param {array|object} oData The data array/object for the array
			 *    (i.e. aoData[]._aData)
			 *  @param {string} sSpecific The specific data type you want to get -
			 *    'display', 'type' 'filter' 'sort'
			 *  @returns {*} The data for the cell from the given row's data
			 *  @default null
			 */
			"fnGetData": null,

			/**
			 * <code>Deprecated</code> Custom display function that will be called for the
			 * display of each cell in this column.
			 *
			 * Please note that this option has now been deprecated and will be removed
			 * in the next version of DataTables. Please use mRender / mData rather than
			 * fnRender.
			 *  @type function
			 *  @param {object} o Object with the following parameters:
			 *  @param {int}    o.iDataRow The row in aoData
			 *  @param {int}    o.iDataColumn The column in question
			 *  @param {array}  o.aData The data for the row in question
			 *  @param {object} o.oSettings The settings object for this DataTables instance
			 *  @returns {string} The string you which to use in the display
			 *  @default null
			 *  @deprecated
			 */
			"fnRender": null,

			/**
			 * Function to set data for a cell in the column. You should <b>never</b>
			 * set the data directly to _aData internally in DataTables - always use
			 * this method. It allows mData to function as required. This function
			 * is automatically assigned by the column initialisation method
			 *  @type function
			 *  @param {array|object} oData The data array/object for the array
			 *    (i.e. aoData[]._aData)
			 *  @param {*} sValue Value to set
			 *  @default null
			 */
			"fnSetData": null,

			/**
			 * Property to read the value for the cells in the column from the data
			 * source array / object. If null, then the default content is used, if a
			 * function is given then the return from the function is used.
			 *  @type function|int|string|null
			 *  @default null
			 */
			"mData": null,

			/**
			 * Partner property to mData which is used (only when defined) to get
			 * the data - i.e. it is basically the same as mData, but without the
			 * 'set' option, and also the data fed to it is the result from mData.
			 * This is the rendering method to match the data method of mData.
			 *  @type function|int|string|null
			 *  @default null
			 */
			"mRender": null,

			/**
			 * Unique header TH/TD element for this column - this is what the sorting
			 * listener is attached to (if sorting is enabled.)
			 *  @type node
			 *  @default null
			 */
			"nTh": null,

			/**
			 * Unique footer TH/TD element for this column (if there is one). Not used
			 * in DataTables as such, but can be used for plug-ins to reference the
			 * footer for each column.
			 *  @type node
			 *  @default null
			 */
			"nTf": null,

			/**
			 * The class to apply to all TD elements in the table's TBODY for the column
			 *  @type string
			 *  @default null
			 */
			"sClass": null,

			/**
			 * When DataTables calculates the column widths to assign to each column,
			 * it finds the longest string in each column and then constructs a
			 * temporary table and reads the widths from that. The problem with this
			 * is that "mmm" is much wider then "iiii", but the latter is a longer
			 * string - thus the calculation can go wrong (doing it properly and putting
			 * it into an DOM object and measuring that is horribly(!) slow). Thus as
			 * a "work around" we provide this option. It will append its value to the
			 * text that is found to be the longest string for the column - i.e. padding.
			 *  @type string
			 */
			"sContentPadding": null,

			/**
			 * Allows a default value to be given for a column's data, and will be used
			 * whenever a null data source is encountered (this can be because mData
			 * is set to null, or because the data source itself is null).
			 *  @type string
			 *  @default null
			 */
			"sDefaultContent": null,

			/**
			 * Name for the column, allowing reference to the column by name as well as
			 * by index (needs a lookup to work by name).
			 *  @type string
			 */
			"sName": null,

			/**
			 * Custom sorting data type - defines which of the available plug-ins in
			 * afnSortData the custom sorting will use - if any is defined.
			 *  @type string
			 *  @default std
			 */
			"sSortDataType": 'std',

			/**
			 * Class to be applied to the header element when sorting on this column
			 *  @type string
			 *  @default null
			 */
			"sSortingClass": null,

			/**
			 * Class to be applied to the header element when sorting on this column -
			 * when jQuery UI theming is used.
			 *  @type string
			 *  @default null
			 */
			"sSortingClassJUI": null,

			/**
			 * Title of the column - what is seen in the TH element (nTh).
			 *  @type string
			 */
			"sTitle": null,

			/**
			 * Column sorting and filtering type
			 *  @type string
			 *  @default null
			 */
			"sType": null,

			/**
			 * Width of the column
			 *  @type string
			 *  @default null
			 */
			"sWidth": null,

			/**
			 * Width of the column when it was first "encountered"
			 *  @type string
			 *  @default null
			 */
			"sWidthOrig": null
		};



		/**
		 * Initialisation options that can be given to DataTables at initialisation
		 * time.
		 *  @namespace
		 */
		DataTable.defaults = {
			/**
			 * An array of data to use for the table, passed in at initialisation which
			 * will be used in preference to any data which is already in the DOM. This is
			 * particularly useful for constructing tables purely in Javascript, for
			 * example with a custom Ajax call.
			 *  @type array
			 *  @default null
			 *  @dtopt Option
			 *
			 *  @example
			 *    // Using a 2D array data source
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "aaData": [
		 *          ['Trident', 'Internet Explorer 4.0', 'Win 95+', 4, 'X'],
		 *          ['Trident', 'Internet Explorer 5.0', 'Win 95+', 5, 'C'],
		 *        ],
		 *        "aoColumns": [
		 *          { "sTitle": "Engine" },
		 *          { "sTitle": "Browser" },
		 *          { "sTitle": "Platform" },
		 *          { "sTitle": "Version" },
		 *          { "sTitle": "Grade" }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using an array of objects as a data source (mData)
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "aaData": [
		 *          {
		 *            "engine":   "Trident",
		 *            "browser":  "Internet Explorer 4.0",
		 *            "platform": "Win 95+",
		 *            "version":  4,
		 *            "grade":    "X"
		 *          },
		 *          {
		 *            "engine":   "Trident",
		 *            "browser":  "Internet Explorer 5.0",
		 *            "platform": "Win 95+",
		 *            "version":  5,
		 *            "grade":    "C"
		 *          }
		 *        ],
		 *        "aoColumns": [
		 *          { "sTitle": "Engine",   "mData": "engine" },
		 *          { "sTitle": "Browser",  "mData": "browser" },
		 *          { "sTitle": "Platform", "mData": "platform" },
		 *          { "sTitle": "Version",  "mData": "version" },
		 *          { "sTitle": "Grade",    "mData": "grade" }
		 *        ]
		 *      } );
		 *    } );
			 */
			"aaData": null,


			/**
			 * If sorting is enabled, then DataTables will perform a first pass sort on
			 * initialisation. You can define which column(s) the sort is performed upon,
			 * and the sorting direction, with this variable. The aaSorting array should
			 * contain an array for each column to be sorted initially containing the
			 * column's index and a direction string ('asc' or 'desc').
			 *  @type array
			 *  @default [[0,'asc']]
			 *  @dtopt Option
			 *
			 *  @example
			 *    // Sort by 3rd column first, and then 4th column
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aaSorting": [[2,'asc'], [3,'desc']]
		 *      } );
		 *    } );
			 *
			 *    // No initial sorting
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aaSorting": []
		 *      } );
		 *    } );
			 */
			"aaSorting": [[0,'asc']],


			/**
			 * This parameter is basically identical to the aaSorting parameter, but
			 * cannot be overridden by user interaction with the table. What this means
			 * is that you could have a column (visible or hidden) which the sorting will
			 * always be forced on first - any sorting after that (from the user) will
			 * then be performed as required. This can be useful for grouping rows
			 * together.
			 *  @type array
			 *  @default null
			 *  @dtopt Option
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aaSortingFixed": [[0,'asc']]
		 *      } );
		 *    } )
			 */
			"aaSortingFixed": null,


			/**
			 * This parameter allows you to readily specify the entries in the length drop
			 * down menu that DataTables shows when pagination is enabled. It can be
			 * either a 1D array of options which will be used for both the displayed
			 * option and the value, or a 2D array which will use the array in the first
			 * position as the value, and the array in the second position as the
			 * displayed options (useful for language strings such as 'All').
			 *  @type array
			 *  @default [ 10, 25, 50, 100 ]
			 *  @dtopt Option
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Setting the default display length as well as length menu
			 *    // This is likely to be wanted if you remove the '10' option which
			 *    // is the iDisplayLength default.
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "iDisplayLength": 25,
		 *        "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
		 *      } );
		 *    } );
			 */
			"aLengthMenu": [ 10, 25, 50, 100 ],


			/**
			 * The aoColumns option in the initialisation parameter allows you to define
			 * details about the way individual columns behave. For a full list of
			 * column options that can be set, please see
			 * {@link DataTable.defaults.columns}. Note that if you use aoColumns to
			 * define your columns, you must have an entry in the array for every single
			 * column that you have in your table (these can be null if you don't which
			 * to specify any options).
			 *  @member
			 */
			"aoColumns": null,

			/**
			 * Very similar to aoColumns, aoColumnDefs allows you to target a specific
			 * column, multiple columns, or all columns, using the aTargets property of
			 * each object in the array. This allows great flexibility when creating
			 * tables, as the aoColumnDefs arrays can be of any length, targeting the
			 * columns you specifically want. aoColumnDefs may use any of the column
			 * options available: {@link DataTable.defaults.columns}, but it _must_
			 * have aTargets defined in each object in the array. Values in the aTargets
			 * array may be:
			 *   <ul>
			 *     <li>a string - class name will be matched on the TH for the column</li>
			 *     <li>0 or a positive integer - column index counting from the left</li>
			 *     <li>a negative integer - column index counting from the right</li>
			 *     <li>the string "_all" - all columns (i.e. assign a default)</li>
			 *   </ul>
			 *  @member
			 */
			"aoColumnDefs": null,


			/**
			 * Basically the same as oSearch, this parameter defines the individual column
			 * filtering state at initialisation time. The array must be of the same size
			 * as the number of columns, and each element be an object with the parameters
			 * "sSearch" and "bEscapeRegex" (the latter is optional). 'null' is also
			 * accepted and the default will be used.
			 *  @type array
			 *  @default []
			 *  @dtopt Option
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoSearchCols": [
		 *          null,
		 *          { "sSearch": "My filter" },
		 *          null,
		 *          { "sSearch": "^[0-9]", "bEscapeRegex": false }
		 *        ]
		 *      } );
		 *    } )
			 */
			"aoSearchCols": [],


			/**
			 * An array of CSS classes that should be applied to displayed rows. This
			 * array may be of any length, and DataTables will apply each class
			 * sequentially, looping when required.
			 *  @type array
			 *  @default null <i>Will take the values determined by the oClasses.sStripe*
			 *    options</i>
			 *  @dtopt Option
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "asStripeClasses": [ 'strip1', 'strip2', 'strip3' ]
		 *      } );
		 *    } )
			 */
			"asStripeClasses": null,


			/**
			 * Enable or disable automatic column width calculation. This can be disabled
			 * as an optimisation (it takes some time to calculate the widths) if the
			 * tables widths are passed in using aoColumns.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "bAutoWidth": false
		 *      } );
		 *    } );
			 */
			"bAutoWidth": true,


			/**
			 * Deferred rendering can provide DataTables with a huge speed boost when you
			 * are using an Ajax or JS data source for the table. This option, when set to
			 * true, will cause DataTables to defer the creation of the table elements for
			 * each row until they are needed for a draw - saving a significant amount of
			 * time.
			 *  @type boolean
			 *  @default false
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      var oTable = $('#example').dataTable( {
		 *        "sAjaxSource": "sources/arrays.txt",
		 *        "bDeferRender": true
		 *      } );
		 *    } );
			 */
			"bDeferRender": false,


			/**
			 * Replace a DataTable which matches the given selector and replace it with
			 * one which has the properties of the new initialisation object passed. If no
			 * table matches the selector, then the new DataTable will be constructed as
			 * per normal.
			 *  @type boolean
			 *  @default false
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "sScrollY": "200px",
		 *        "bPaginate": false
		 *      } );
		 *      
		 *      // Some time later....
		 *      $('#example').dataTable( {
		 *        "bFilter": false,
		 *        "bDestroy": true
		 *      } );
		 *    } );
			 */
			"bDestroy": false,


			/**
			 * Enable or disable filtering of data. Filtering in DataTables is "smart" in
			 * that it allows the end user to input multiple words (space separated) and
			 * will match a row containing those words, even if not in the order that was
			 * specified (this allow matching across multiple columns). Note that if you
			 * wish to use filtering in DataTables this must remain 'true' - to remove the
			 * default filtering input box and retain filtering abilities, please use
			 * {@link DataTable.defaults.sDom}.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "bFilter": false
		 *      } );
		 *    } );
			 */
			"bFilter": true,


			/**
			 * Enable or disable the table information display. This shows information
			 * about the data that is currently visible on the page, including information
			 * about filtered data if that action is being performed.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "bInfo": false
		 *      } );
		 *    } );
			 */
			"bInfo": true,


			/**
			 * Enable jQuery UI ThemeRoller support (required as ThemeRoller requires some
			 * slightly different and additional mark-up from what DataTables has
			 * traditionally used).
			 *  @type boolean
			 *  @default false
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bJQueryUI": true
		 *      } );
		 *    } );
			 */
			"bJQueryUI": false,


			/**
			 * Allows the end user to select the size of a formatted page from a select
			 * menu (sizes are 10, 25, 50 and 100). Requires pagination (bPaginate).
			 *  @type boolean
			 *  @default true
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "bLengthChange": false
		 *      } );
		 *    } );
			 */
			"bLengthChange": true,


			/**
			 * Enable or disable pagination.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "bPaginate": false
		 *      } );
		 *    } );
			 */
			"bPaginate": true,


			/**
			 * Enable or disable the display of a 'processing' indicator when the table is
			 * being processed (e.g. a sort). This is particularly useful for tables with
			 * large amounts of data where it can take a noticeable amount of time to sort
			 * the entries.
			 *  @type boolean
			 *  @default false
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "bProcessing": true
		 *      } );
		 *    } );
			 */
			"bProcessing": false,


			/**
			 * Retrieve the DataTables object for the given selector. Note that if the
			 * table has already been initialised, this parameter will cause DataTables
			 * to simply return the object that has already been set up - it will not take
			 * account of any changes you might have made to the initialisation object
			 * passed to DataTables (setting this parameter to true is an acknowledgement
			 * that you understand this). bDestroy can be used to reinitialise a table if
			 * you need.
			 *  @type boolean
			 *  @default false
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      initTable();
		 *      tableActions();
		 *    } );
			 *
			 *    function initTable ()
			 *    {
		 *      return $('#example').dataTable( {
		 *        "sScrollY": "200px",
		 *        "bPaginate": false,
		 *        "bRetrieve": true
		 *      } );
		 *    }
			 *
			 *    function tableActions ()
			 *    {
		 *      var oTable = initTable();
		 *      // perform API operations with oTable 
		 *    }
			 */
			"bRetrieve": false,


			/**
			 * Indicate if DataTables should be allowed to set the padding / margin
			 * etc for the scrolling header elements or not. Typically you will want
			 * this.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bScrollAutoCss": false,
		 *        "sScrollY": "200px"
		 *      } );
		 *    } );
			 */
			"bScrollAutoCss": true,


			/**
			 * When vertical (y) scrolling is enabled, DataTables will force the height of
			 * the table's viewport to the given height at all times (useful for layout).
			 * However, this can look odd when filtering data down to a small data set,
			 * and the footer is left "floating" further down. This parameter (when
			 * enabled) will cause DataTables to collapse the table's viewport down when
			 * the result set will fit within the given Y height.
			 *  @type boolean
			 *  @default false
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "sScrollY": "200",
		 *        "bScrollCollapse": true
		 *      } );
		 *    } );
			 */
			"bScrollCollapse": false,


			/**
			 * Enable infinite scrolling for DataTables (to be used in combination with
			 * sScrollY). Infinite scrolling means that DataTables will continually load
			 * data as a user scrolls through a table, which is very useful for large
			 * dataset. This cannot be used with pagination, which is automatically
			 * disabled. Note - the Scroller extra for DataTables is recommended in
			 * in preference to this option.
			 *  @type boolean
			 *  @default false
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bScrollInfinite": true,
		 *        "bScrollCollapse": true,
		 *        "sScrollY": "200px"
		 *      } );
		 *    } );
			 */
			"bScrollInfinite": false,


			/**
			 * Configure DataTables to use server-side processing. Note that the
			 * sAjaxSource parameter must also be given in order to give DataTables a
			 * source to obtain the required data for each draw.
			 *  @type boolean
			 *  @default false
			 *  @dtopt Features
			 *  @dtopt Server-side
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "bServerSide": true,
		 *        "sAjaxSource": "xhr.php"
		 *      } );
		 *    } );
			 */
			"bServerSide": false,


			/**
			 * Enable or disable sorting of columns. Sorting of individual columns can be
			 * disabled by the "bSortable" option for each column.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "bSort": false
		 *      } );
		 *    } );
			 */
			"bSort": true,


			/**
			 * Allows control over whether DataTables should use the top (true) unique
			 * cell that is found for a single column, or the bottom (false - default).
			 * This is useful when using complex headers.
			 *  @type boolean
			 *  @default false
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bSortCellsTop": true
		 *      } );
		 *    } );
			 */
			"bSortCellsTop": false,


			/**
			 * Enable or disable the addition of the classes 'sorting_1', 'sorting_2' and
			 * 'sorting_3' to the columns which are currently being sorted on. This is
			 * presented as a feature switch as it can increase processing time (while
			 * classes are removed and added) so for large data sets you might want to
			 * turn this off.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "bSortClasses": false
		 *      } );
		 *    } );
			 */
			"bSortClasses": true,


			/**
			 * Enable or disable state saving. When enabled a cookie will be used to save
			 * table display information such as pagination information, display length,
			 * filtering and sorting. As such when the end user reloads the page the
			 * display display will match what thy had previously set up.
			 *  @type boolean
			 *  @default false
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "bStateSave": true
		 *      } );
		 *    } );
			 */
			"bStateSave": false,


			/**
			 * Customise the cookie and / or the parameters being stored when using
			 * DataTables with state saving enabled. This function is called whenever
			 * the cookie is modified, and it expects a fully formed cookie string to be
			 * returned. Note that the data object passed in is a Javascript object which
			 * must be converted to a string (JSON.stringify for example).
			 *  @type function
			 *  @param {string} sName Name of the cookie defined by DataTables
			 *  @param {object} oData Data to be stored in the cookie
			 *  @param {string} sExpires Cookie expires string
			 *  @param {string} sPath Path of the cookie to set
			 *  @returns {string} Cookie formatted string (which should be encoded by
			 *    using encodeURIComponent())
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function () {
		 *      $('#example').dataTable( {
		 *        "fnCookieCallback": function (sName, oData, sExpires, sPath) {
		 *          // Customise oData or sName or whatever else here
		 *          return sName + "="+JSON.stringify(oData)+"; expires=" + sExpires +"; path=" + sPath;
		 *        }
		 *      } );
		 *    } );
			 */
			"fnCookieCallback": null,


			/**
			 * This function is called when a TR element is created (and all TD child
			 * elements have been inserted), or registered if using a DOM source, allowing
			 * manipulation of the TR element (adding classes etc).
			 *  @type function
			 *  @param {node} nRow "TR" element for the current row
			 *  @param {array} aData Raw data array for this row
			 *  @param {int} iDataIndex The index of this row in aoData
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
		 *          // Bold the grade for all 'A' grade browsers
		 *          if ( aData[4] == "A" )
		 *          {
		 *            $('td:eq(4)', nRow).html( '<b>A</b>' );
		 *          }
		 *        }
		 *      } );
		 *    } );
			 */
			"fnCreatedRow": null,


			/**
			 * This function is called on every 'draw' event, and allows you to
			 * dynamically modify any aspect you want about the created DOM.
			 *  @type function
			 *  @param {object} oSettings DataTables settings object
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "fnDrawCallback": function( oSettings ) {
		 *          alert( 'DataTables has redrawn the table' );
		 *        }
		 *      } );
		 *    } );
			 */
			"fnDrawCallback": null,


			/**
			 * Identical to fnHeaderCallback() but for the table footer this function
			 * allows you to modify the table footer on every 'draw' even.
			 *  @type function
			 *  @param {node} nFoot "TR" element for the footer
			 *  @param {array} aData Full table data (as derived from the original HTML)
			 *  @param {int} iStart Index for the current display starting point in the
			 *    display array
			 *  @param {int} iEnd Index for the current display ending point in the
			 *    display array
			 *  @param {array int} aiDisplay Index array to translate the visual position
			 *    to the full data array
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "fnFooterCallback": function( nFoot, aData, iStart, iEnd, aiDisplay ) {
		 *          nFoot.getElementsByTagName('th')[0].innerHTML = "Starting index is "+iStart;
		 *        }
		 *      } );
		 *    } )
			 */
			"fnFooterCallback": null,


			/**
			 * When rendering large numbers in the information element for the table
			 * (i.e. "Showing 1 to 10 of 57 entries") DataTables will render large numbers
			 * to have a comma separator for the 'thousands' units (e.g. 1 million is
			 * rendered as "1,000,000") to help readability for the end user. This
			 * function will override the default method DataTables uses.
			 *  @type function
			 *  @member
			 *  @param {int} iIn number to be formatted
			 *  @returns {string} formatted string for DataTables to show the number
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "fnFormatNumber": function ( iIn ) {
		 *          if ( iIn &lt; 1000 ) {
		 *            return iIn;
		 *          } else {
		 *            var 
		 *              s=(iIn+""), 
		 *              a=s.split(""), out="", 
		 *              iLen=s.length;
		 *            
		 *            for ( var i=0 ; i&lt;iLen ; i++ ) {
		 *              if ( i%3 === 0 &amp;&amp; i !== 0 ) {
		 *                out = "'"+out;
		 *              }
		 *              out = a[iLen-i-1]+out;
		 *            }
		 *          }
		 *          return out;
		 *        };
		 *      } );
		 *    } );
			 */
			"fnFormatNumber": function ( iIn ) {
				if ( iIn < 1000 )
				{
					// A small optimisation for what is likely to be the majority of use cases
					return iIn;
				}

				var s=(iIn+""), a=s.split(""), out="", iLen=s.length;

				for ( var i=0 ; i<iLen ; i++ )
				{
					if ( i%3 === 0 && i !== 0 )
					{
						out = this.oLanguage.sInfoThousands+out;
					}
					out = a[iLen-i-1]+out;
				}
				return out;
			},


			/**
			 * This function is called on every 'draw' event, and allows you to
			 * dynamically modify the header row. This can be used to calculate and
			 * display useful information about the table.
			 *  @type function
			 *  @param {node} nHead "TR" element for the header
			 *  @param {array} aData Full table data (as derived from the original HTML)
			 *  @param {int} iStart Index for the current display starting point in the
			 *    display array
			 *  @param {int} iEnd Index for the current display ending point in the
			 *    display array
			 *  @param {array int} aiDisplay Index array to translate the visual position
			 *    to the full data array
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "fnHeaderCallback": function( nHead, aData, iStart, iEnd, aiDisplay ) {
		 *          nHead.getElementsByTagName('th')[0].innerHTML = "Displaying "+(iEnd-iStart)+" records";
		 *        }
		 *      } );
		 *    } )
			 */
			"fnHeaderCallback": null,


			/**
			 * The information element can be used to convey information about the current
			 * state of the table. Although the internationalisation options presented by
			 * DataTables are quite capable of dealing with most customisations, there may
			 * be times where you wish to customise the string further. This callback
			 * allows you to do exactly that.
			 *  @type function
			 *  @param {object} oSettings DataTables settings object
			 *  @param {int} iStart Starting position in data for the draw
			 *  @param {int} iEnd End position in data for the draw
			 *  @param {int} iMax Total number of rows in the table (regardless of
			 *    filtering)
			 *  @param {int} iTotal Total number of rows in the data set, after filtering
			 *  @param {string} sPre The string that DataTables has formatted using it's
			 *    own rules
			 *  @returns {string} The string to be displayed in the information element.
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $('#example').dataTable( {
		 *      "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
		 *        return iStart +" to "+ iEnd;
		 *      }
		 *    } );
			 */
			"fnInfoCallback": null,


			/**
			 * Called when the table has been initialised. Normally DataTables will
			 * initialise sequentially and there will be no need for this function,
			 * however, this does not hold true when using external language information
			 * since that is obtained using an async XHR call.
			 *  @type function
			 *  @param {object} oSettings DataTables settings object
			 *  @param {object} json The JSON object request from the server - only
			 *    present if client-side Ajax sourced data is used
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "fnInitComplete": function(oSettings, json) {
		 *          alert( 'DataTables has finished its initialisation.' );
		 *        }
		 *      } );
		 *    } )
			 */
			"fnInitComplete": null,


			/**
			 * Called at the very start of each table draw and can be used to cancel the
			 * draw by returning false, any other return (including undefined) results in
			 * the full draw occurring).
			 *  @type function
			 *  @param {object} oSettings DataTables settings object
			 *  @returns {boolean} False will cancel the draw, anything else (including no
			 *    return) will allow it to complete.
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "fnPreDrawCallback": function( oSettings ) {
		 *          if ( $('#test').val() == 1 ) {
		 *            return false;
		 *          }
		 *        }
		 *      } );
		 *    } );
			 */
			"fnPreDrawCallback": null,


			/**
			 * This function allows you to 'post process' each row after it have been
			 * generated for each table draw, but before it is rendered on screen. This
			 * function might be used for setting the row class name etc.
			 *  @type function
			 *  @param {node} nRow "TR" element for the current row
			 *  @param {array} aData Raw data array for this row
			 *  @param {int} iDisplayIndex The display index for the current table draw
			 *  @param {int} iDisplayIndexFull The index of the data in the full list of
			 *    rows (after filtering)
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
		 *          // Bold the grade for all 'A' grade browsers
		 *          if ( aData[4] == "A" )
		 *          {
		 *            $('td:eq(4)', nRow).html( '<b>A</b>' );
		 *          }
		 *        }
		 *      } );
		 *    } );
			 */
			"fnRowCallback": null,


			/**
			 * This parameter allows you to override the default function which obtains
			 * the data from the server ($.getJSON) so something more suitable for your
			 * application. For example you could use POST data, or pull information from
			 * a Gears or AIR database.
			 *  @type function
			 *  @member
			 *  @param {string} sSource HTTP source to obtain the data from (sAjaxSource)
			 *  @param {array} aoData A key/value pair object containing the data to send
			 *    to the server
			 *  @param {function} fnCallback to be called on completion of the data get
			 *    process that will draw the data on the page.
			 *  @param {object} oSettings DataTables settings object
			 *  @dtopt Callbacks
			 *  @dtopt Server-side
			 *
			 *  @example
			 *    // POST data to server
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bProcessing": true,
		 *        "bServerSide": true,
		 *        "sAjaxSource": "xhr.php",
		 *        "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
		 *          oSettings.jqXHR = $.ajax( {
		 *            "dataType": 'json', 
		 *            "type": "POST", 
		 *            "url": sSource, 
		 *            "data": aoData, 
		 *            "success": fnCallback
		 *          } );
		 *        }
		 *      } );
		 *    } );
			 */
			"fnServerData": function ( sUrl, aoData, fnCallback, oSettings ) {
				oSettings.jqXHR = $.ajax( {
					"url":  sUrl,
					"data": aoData,
					"success": function (json) {
						if ( json.sError ) {
							oSettings.oApi._fnLog( oSettings, 0, json.sError );
						}

						$(oSettings.oInstance).trigger('xhr', [oSettings, json]);
						fnCallback( json );
					},
					"dataType": "json",
					"cache": false,
					"type": oSettings.sServerMethod,
					"error": function (xhr, error, thrown) {
						if ( error == "parsererror" ) {
							oSettings.oApi._fnLog( oSettings, 0, "DataTables warning: JSON data from "+
								"server could not be parsed. This is caused by a JSON formatting error." );
						}
					}
				} );
			},


			/**
			 * It is often useful to send extra data to the server when making an Ajax
			 * request - for example custom filtering information, and this callback
			 * function makes it trivial to send extra information to the server. The
			 * passed in parameter is the data set that has been constructed by
			 * DataTables, and you can add to this or modify it as you require.
			 *  @type function
			 *  @param {array} aoData Data array (array of objects which are name/value
			 *    pairs) that has been constructed by DataTables and will be sent to the
			 *    server. In the case of Ajax sourced data with server-side processing
			 *    this will be an empty array, for server-side processing there will be a
			 *    significant number of parameters!
			 *  @returns {undefined} Ensure that you modify the aoData array passed in,
			 *    as this is passed by reference.
			 *  @dtopt Callbacks
			 *  @dtopt Server-side
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bProcessing": true,
		 *        "bServerSide": true,
		 *        "sAjaxSource": "scripts/server_processing.php",
		 *        "fnServerParams": function ( aoData ) {
		 *          aoData.push( { "name": "more_data", "value": "my_value" } );
		 *        }
		 *      } );
		 *    } );
			 */
			"fnServerParams": null,


			/**
			 * Load the table state. With this function you can define from where, and how, the
			 * state of a table is loaded. By default DataTables will load from its state saving
			 * cookie, but you might wish to use local storage (HTML5) or a server-side database.
			 *  @type function
			 *  @member
			 *  @param {object} oSettings DataTables settings object
			 *  @return {object} The DataTables state object to be loaded
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bStateSave": true,
		 *        "fnStateLoad": function (oSettings) {
		 *          var o;
		 *          
		 *          // Send an Ajax request to the server to get the data. Note that
		 *          // this is a synchronous request.
		 *          $.ajax( {
		 *            "url": "/state_load",
		 *            "async": false,
		 *            "dataType": "json",
		 *            "success": function (json) {
		 *              o = json;
		 *            }
		 *          } );
		 *          
		 *          return o;
		 *        }
		 *      } );
		 *    } );
			 */
			"fnStateLoad": function ( oSettings ) {
				var sData = this.oApi._fnReadCookie( oSettings.sCookiePrefix+oSettings.sInstance );
				var oData;

				try {
					oData = (typeof $.parseJSON === 'function') ?
						$.parseJSON(sData) : eval( '('+sData+')' );
				} catch (e) {
					oData = null;
				}

				return oData;
			},


			/**
			 * Callback which allows modification of the saved state prior to loading that state.
			 * This callback is called when the table is loading state from the stored data, but
			 * prior to the settings object being modified by the saved state. Note that for
			 * plug-in authors, you should use the 'stateLoadParams' event to load parameters for
			 * a plug-in.
			 *  @type function
			 *  @param {object} oSettings DataTables settings object
			 *  @param {object} oData The state object that is to be loaded
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    // Remove a saved filter, so filtering is never loaded
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bStateSave": true,
		 *        "fnStateLoadParams": function (oSettings, oData) {
		 *          oData.oSearch.sSearch = "";
		 *        }
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Disallow state loading by returning false
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bStateSave": true,
		 *        "fnStateLoadParams": function (oSettings, oData) {
		 *          return false;
		 *        }
		 *      } );
		 *    } );
			 */
			"fnStateLoadParams": null,


			/**
			 * Callback that is called when the state has been loaded from the state saving method
			 * and the DataTables settings object has been modified as a result of the loaded state.
			 *  @type function
			 *  @param {object} oSettings DataTables settings object
			 *  @param {object} oData The state object that was loaded
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    // Show an alert with the filtering value that was saved
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bStateSave": true,
		 *        "fnStateLoaded": function (oSettings, oData) {
		 *          alert( 'Saved filter was: '+oData.oSearch.sSearch );
		 *        }
		 *      } );
		 *    } );
			 */
			"fnStateLoaded": null,


			/**
			 * Save the table state. This function allows you to define where and how the state
			 * information for the table is stored - by default it will use a cookie, but you
			 * might want to use local storage (HTML5) or a server-side database.
			 *  @type function
			 *  @member
			 *  @param {object} oSettings DataTables settings object
			 *  @param {object} oData The state object to be saved
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bStateSave": true,
		 *        "fnStateSave": function (oSettings, oData) {
		 *          // Send an Ajax request to the server with the state object
		 *          $.ajax( {
		 *            "url": "/state_save",
		 *            "data": oData,
		 *            "dataType": "json",
		 *            "method": "POST"
		 *            "success": function () {}
		 *          } );
		 *        }
		 *      } );
		 *    } );
			 */
			"fnStateSave": function ( oSettings, oData ) {
				this.oApi._fnCreateCookie(
					oSettings.sCookiePrefix+oSettings.sInstance,
					this.oApi._fnJsonString(oData),
					oSettings.iCookieDuration,
					oSettings.sCookiePrefix,
					oSettings.fnCookieCallback
				);
			},


			/**
			 * Callback which allows modification of the state to be saved. Called when the table
			 * has changed state a new state save is required. This method allows modification of
			 * the state saving object prior to actually doing the save, including addition or
			 * other state properties or modification. Note that for plug-in authors, you should
			 * use the 'stateSaveParams' event to save parameters for a plug-in.
			 *  @type function
			 *  @param {object} oSettings DataTables settings object
			 *  @param {object} oData The state object to be saved
			 *  @dtopt Callbacks
			 *
			 *  @example
			 *    // Remove a saved filter, so filtering is never saved
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bStateSave": true,
		 *        "fnStateSaveParams": function (oSettings, oData) {
		 *          oData.oSearch.sSearch = "";
		 *        }
		 *      } );
		 *    } );
			 */
			"fnStateSaveParams": null,


			/**
			 * Duration of the cookie which is used for storing session information. This
			 * value is given in seconds.
			 *  @type int
			 *  @default 7200 <i>(2 hours)</i>
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "iCookieDuration": 60*60*24; // 1 day
		 *      } );
		 *    } )
			 */
			"iCookieDuration": 7200,


			/**
			 * When enabled DataTables will not make a request to the server for the first
			 * page draw - rather it will use the data already on the page (no sorting etc
			 * will be applied to it), thus saving on an XHR at load time. iDeferLoading
			 * is used to indicate that deferred loading is required, but it is also used
			 * to tell DataTables how many records there are in the full table (allowing
			 * the information element and pagination to be displayed correctly). In the case
			 * where a filtering is applied to the table on initial load, this can be
			 * indicated by giving the parameter as an array, where the first element is
			 * the number of records available after filtering and the second element is the
			 * number of records without filtering (allowing the table information element
			 * to be shown correctly).
			 *  @type int | array
			 *  @default null
			 *  @dtopt Options
			 *
			 *  @example
			 *    // 57 records available in the table, no filtering applied
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bServerSide": true,
		 *        "sAjaxSource": "scripts/server_processing.php",
		 *        "iDeferLoading": 57
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // 57 records after filtering, 100 without filtering (an initial filter applied)
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bServerSide": true,
		 *        "sAjaxSource": "scripts/server_processing.php",
		 *        "iDeferLoading": [ 57, 100 ],
		 *        "oSearch": {
		 *          "sSearch": "my_filter"
		 *        }
		 *      } );
		 *    } );
			 */
			"iDeferLoading": null,


			/**
			 * Number of rows to display on a single page when using pagination. If
			 * feature enabled (bLengthChange) then the end user will be able to override
			 * this to a custom setting using a pop-up menu.
			 *  @type int
			 *  @default 10
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "iDisplayLength": 50
		 *      } );
		 *    } )
			 */
			"iDisplayLength": 10,


			/**
			 * Define the starting point for data display when using DataTables with
			 * pagination. Note that this parameter is the number of records, rather than
			 * the page number, so if you have 10 records per page and want to start on
			 * the third page, it should be "20".
			 *  @type int
			 *  @default 0
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "iDisplayStart": 20
		 *      } );
		 *    } )
			 */
			"iDisplayStart": 0,


			/**
			 * The scroll gap is the amount of scrolling that is left to go before
			 * DataTables will load the next 'page' of data automatically. You typically
			 * want a gap which is big enough that the scrolling will be smooth for the
			 * user, while not so large that it will load more data than need.
			 *  @type int
			 *  @default 100
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bScrollInfinite": true,
		 *        "bScrollCollapse": true,
		 *        "sScrollY": "200px",
		 *        "iScrollLoadGap": 50
		 *      } );
		 *    } );
			 */
			"iScrollLoadGap": 100,


			/**
			 * By default DataTables allows keyboard navigation of the table (sorting, paging,
			 * and filtering) by adding a tabindex attribute to the required elements. This
			 * allows you to tab through the controls and press the enter key to activate them.
			 * The tabindex is default 0, meaning that the tab follows the flow of the document.
			 * You can overrule this using this parameter if you wish. Use a value of -1 to
			 * disable built-in keyboard navigation.
			 *  @type int
			 *  @default 0
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "iTabIndex": 1
		 *      } );
		 *    } );
			 */
			"iTabIndex": 0,


			/**
			 * All strings that DataTables uses in the user interface that it creates
			 * are defined in this object, allowing you to modified them individually or
			 * completely replace them all as required.
			 *  @namespace
			 */
			"oLanguage": {
				/**
				 * Strings that are used for WAI-ARIA labels and controls only (these are not
				 * actually visible on the page, but will be read by screenreaders, and thus
				 * must be internationalised as well).
				 *  @namespace
				 */
				"oAria": {
					/**
					 * ARIA label that is added to the table headers when the column may be
					 * sorted ascending by activing the column (click or return when focused).
					 * Note that the column header is prefixed to this string.
					 *  @type string
					 *  @default : activate to sort column ascending
					 *  @dtopt Language
					 *
					 *  @example
					 *    $(document).ready( function() {
				 *      $('#example').dataTable( {
				 *        "oLanguage": {
				 *          "oAria": {
				 *            "sSortAscending": " - click/return to sort ascending"
				 *          }
				 *        }
				 *      } );
				 *    } );
					 */
					"sSortAscending": ": activate to sort column ascending",

					/**
					 * ARIA label that is added to the table headers when the column may be
					 * sorted descending by activing the column (click or return when focused).
					 * Note that the column header is prefixed to this string.
					 *  @type string
					 *  @default : activate to sort column ascending
					 *  @dtopt Language
					 *
					 *  @example
					 *    $(document).ready( function() {
				 *      $('#example').dataTable( {
				 *        "oLanguage": {
				 *          "oAria": {
				 *            "sSortDescending": " - click/return to sort descending"
				 *          }
				 *        }
				 *      } );
				 *    } );
					 */
					"sSortDescending": ": activate to sort column descending"
				},

				/**
				 * Pagination string used by DataTables for the two built-in pagination
				 * control types ("two_button" and "full_numbers")
				 *  @namespace
				 */
				"oPaginate": {
					/**
					 * Text to use when using the 'full_numbers' type of pagination for the
					 * button to take the user to the first page.
					 *  @type string
					 *  @default First
					 *  @dtopt Language
					 *
					 *  @example
					 *    $(document).ready( function() {
				 *      $('#example').dataTable( {
				 *        "oLanguage": {
				 *          "oPaginate": {
				 *            "sFirst": "First page"
				 *          }
				 *        }
				 *      } );
				 *    } );
					 */
					"sFirst": "First",


					/**
					 * Text to use when using the 'full_numbers' type of pagination for the
					 * button to take the user to the last page.
					 *  @type string
					 *  @default Last
					 *  @dtopt Language
					 *
					 *  @example
					 *    $(document).ready( function() {
				 *      $('#example').dataTable( {
				 *        "oLanguage": {
				 *          "oPaginate": {
				 *            "sLast": "Last page"
				 *          }
				 *        }
				 *      } );
				 *    } );
					 */
					"sLast": "Last",


					/**
					 * Text to use for the 'next' pagination button (to take the user to the
					 * next page).
					 *  @type string
					 *  @default Next
					 *  @dtopt Language
					 *
					 *  @example
					 *    $(document).ready( function() {
				 *      $('#example').dataTable( {
				 *        "oLanguage": {
				 *          "oPaginate": {
				 *            "sNext": "Next page"
				 *          }
				 *        }
				 *      } );
				 *    } );
					 */
					"sNext": "Next",


					/**
					 * Text to use for the 'previous' pagination button (to take the user to
					 * the previous page).
					 *  @type string
					 *  @default Previous
					 *  @dtopt Language
					 *
					 *  @example
					 *    $(document).ready( function() {
				 *      $('#example').dataTable( {
				 *        "oLanguage": {
				 *          "oPaginate": {
				 *            "sPrevious": "Previous page"
				 *          }
				 *        }
				 *      } );
				 *    } );
					 */
					"sPrevious": "Previous"
				},

				/**
				 * This string is shown in preference to sZeroRecords when the table is
				 * empty of data (regardless of filtering). Note that this is an optional
				 * parameter - if it is not given, the value of sZeroRecords will be used
				 * instead (either the default or given value).
				 *  @type string
				 *  @default No data available in table
				 *  @dtopt Language
				 *
				 *  @example
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sEmptyTable": "No data available in table"
			 *        }
			 *      } );
			 *    } );
				 */
				"sEmptyTable": "No data available in table",


				/**
				 * This string gives information to the end user about the information that
				 * is current on display on the page. The _START_, _END_ and _TOTAL_
				 * variables are all dynamically replaced as the table display updates, and
				 * can be freely moved or removed as the language requirements change.
				 *  @type string
				 *  @default Showing _START_ to _END_ of _TOTAL_ entries
				 *  @dtopt Language
				 *
				 *  @example
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sInfo": "Got a total of _TOTAL_ entries to show (_START_ to _END_)"
			 *        }
			 *      } );
			 *    } );
				 */
				"sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",


				/**
				 * Display information string for when the table is empty. Typically the
				 * format of this string should match sInfo.
				 *  @type string
				 *  @default Showing 0 to 0 of 0 entries
				 *  @dtopt Language
				 *
				 *  @example
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sInfoEmpty": "No entries to show"
			 *        }
			 *      } );
			 *    } );
				 */
				"sInfoEmpty": "Showing 0 to 0 of 0 entries",


				/**
				 * When a user filters the information in a table, this string is appended
				 * to the information (sInfo) to give an idea of how strong the filtering
				 * is. The variable _MAX_ is dynamically updated.
				 *  @type string
				 *  @default (filtered from _MAX_ total entries)
				 *  @dtopt Language
				 *
				 *  @example
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sInfoFiltered": " - filtering from _MAX_ records"
			 *        }
			 *      } );
			 *    } );
				 */
				"sInfoFiltered": "(filtered from _MAX_ total entries)",


				/**
				 * If can be useful to append extra information to the info string at times,
				 * and this variable does exactly that. This information will be appended to
				 * the sInfo (sInfoEmpty and sInfoFiltered in whatever combination they are
				 * being used) at all times.
				 *  @type string
				 *  @default <i>Empty string</i>
				 *  @dtopt Language
				 *
				 *  @example
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sInfoPostFix": "All records shown are derived from real information."
			 *        }
			 *      } );
			 *    } );
				 */
				"sInfoPostFix": "",


				/**
				 * DataTables has a build in number formatter (fnFormatNumber) which is used
				 * to format large numbers that are used in the table information. By
				 * default a comma is used, but this can be trivially changed to any
				 * character you wish with this parameter.
				 *  @type string
				 *  @default ,
				 *  @dtopt Language
				 *
				 *  @example
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sInfoThousands": "'"
			 *        }
			 *      } );
			 *    } );
				 */
				"sInfoThousands": ",",


				/**
				 * Detail the action that will be taken when the drop down menu for the
				 * pagination length option is changed. The '_MENU_' variable is replaced
				 * with a default select list of 10, 25, 50 and 100, and can be replaced
				 * with a custom select box if required.
				 *  @type string
				 *  @default Show _MENU_ entries
				 *  @dtopt Language
				 *
				 *  @example
				 *    // Language change only
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sLengthMenu": "Display _MENU_ records"
			 *        }
			 *      } );
			 *    } );
				 *
				 *  @example
				 *    // Language and options change
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sLengthMenu": 'Display <select>'+
			 *            '<option value="10">10</option>'+
			 *            '<option value="20">20</option>'+
			 *            '<option value="30">30</option>'+
			 *            '<option value="40">40</option>'+
			 *            '<option value="50">50</option>'+
			 *            '<option value="-1">All</option>'+
			 *            '</select> records'
			 *        }
			 *      } );
			 *    } );
				 */
				"sLengthMenu": "Show _MENU_ entries",


				/**
				 * When using Ajax sourced data and during the first draw when DataTables is
				 * gathering the data, this message is shown in an empty row in the table to
				 * indicate to the end user the the data is being loaded. Note that this
				 * parameter is not used when loading data by server-side processing, just
				 * Ajax sourced data with client-side processing.
				 *  @type string
				 *  @default Loading...
				 *  @dtopt Language
				 *
				 *  @example
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sLoadingRecords": "Please wait - loading..."
			 *        }
			 *      } );
			 *    } );
				 */
				"sLoadingRecords": "Loading...",


				/**
				 * Text which is displayed when the table is processing a user action
				 * (usually a sort command or similar).
				 *  @type string
				 *  @default Processing...
				 *  @dtopt Language
				 *
				 *  @example
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sProcessing": "DataTables is currently busy"
			 *        }
			 *      } );
			 *    } );
				 */
				"sProcessing": "Processing...",


				/**
				 * Details the actions that will be taken when the user types into the
				 * filtering input text box. The variable "_INPUT_", if used in the string,
				 * is replaced with the HTML text box for the filtering input allowing
				 * control over where it appears in the string. If "_INPUT_" is not given
				 * then the input box is appended to the string automatically.
				 *  @type string
				 *  @default Search:
				 *  @dtopt Language
				 *
				 *  @example
				 *    // Input text box will be appended at the end automatically
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sSearch": "Filter records:"
			 *        }
			 *      } );
			 *    } );
				 *
				 *  @example
				 *    // Specify where the filter should appear
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sSearch": "Apply filter _INPUT_ to table"
			 *        }
			 *      } );
			 *    } );
				 */
				"sSearch": "Search:",


				/**
				 * All of the language information can be stored in a file on the
				 * server-side, which DataTables will look up if this parameter is passed.
				 * It must store the URL of the language file, which is in a JSON format,
				 * and the object has the same properties as the oLanguage object in the
				 * initialiser object (i.e. the above parameters). Please refer to one of
				 * the example language files to see how this works in action.
				 *  @type string
				 *  @default <i>Empty string - i.e. disabled</i>
				 *  @dtopt Language
				 *
				 *  @example
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sUrl": "http://www.sprymedia.co.uk/dataTables/lang.txt"
			 *        }
			 *      } );
			 *    } );
				 */
				"sUrl": "",


				/**
				 * Text shown inside the table records when the is no information to be
				 * displayed after filtering. sEmptyTable is shown when there is simply no
				 * information in the table at all (regardless of filtering).
				 *  @type string
				 *  @default No matching records found
				 *  @dtopt Language
				 *
				 *  @example
				 *    $(document).ready( function() {
			 *      $('#example').dataTable( {
			 *        "oLanguage": {
			 *          "sZeroRecords": "No records to display"
			 *        }
			 *      } );
			 *    } );
				 */
				"sZeroRecords": "No matching records found"
			},


			/**
			 * This parameter allows you to have define the global filtering state at
			 * initialisation time. As an object the "sSearch" parameter must be
			 * defined, but all other parameters are optional. When "bRegex" is true,
			 * the search string will be treated as a regular expression, when false
			 * (default) it will be treated as a straight string. When "bSmart"
			 * DataTables will use it's smart filtering methods (to word match at
			 * any point in the data), when false this will not be done.
			 *  @namespace
			 *  @extends DataTable.models.oSearch
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "oSearch": {"sSearch": "Initial search"}
		 *      } );
		 *    } )
			 */
			"oSearch": $.extend( {}, DataTable.models.oSearch ),


			/**
			 * By default DataTables will look for the property 'aaData' when obtaining
			 * data from an Ajax source or for server-side processing - this parameter
			 * allows that property to be changed. You can use Javascript dotted object
			 * notation to get a data source for multiple levels of nesting.
			 *  @type string
			 *  @default aaData
			 *  @dtopt Options
			 *  @dtopt Server-side
			 *
			 *  @example
			 *    // Get data from { "data": [...] }
			 *    $(document).ready( function() {
		 *      var oTable = $('#example').dataTable( {
		 *        "sAjaxSource": "sources/data.txt",
		 *        "sAjaxDataProp": "data"
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Get data from { "data": { "inner": [...] } }
			 *    $(document).ready( function() {
		 *      var oTable = $('#example').dataTable( {
		 *        "sAjaxSource": "sources/data.txt",
		 *        "sAjaxDataProp": "data.inner"
		 *      } );
		 *    } );
			 */
			"sAjaxDataProp": "aaData",


			/**
			 * You can instruct DataTables to load data from an external source using this
			 * parameter (use aData if you want to pass data in you already have). Simply
			 * provide a url a JSON object can be obtained from. This object must include
			 * the parameter 'aaData' which is the data source for the table.
			 *  @type string
			 *  @default null
			 *  @dtopt Options
			 *  @dtopt Server-side
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "sAjaxSource": "http://www.sprymedia.co.uk/dataTables/json.php"
		 *      } );
		 *    } )
			 */
			"sAjaxSource": null,


			/**
			 * This parameter can be used to override the default prefix that DataTables
			 * assigns to a cookie when state saving is enabled.
			 *  @type string
			 *  @default SpryMedia_DataTables_
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "sCookiePrefix": "my_datatable_",
		 *      } );
		 *    } );
			 */
			"sCookiePrefix": "SpryMedia_DataTables_",


			/**
			 * This initialisation variable allows you to specify exactly where in the
			 * DOM you want DataTables to inject the various controls it adds to the page
			 * (for example you might want the pagination controls at the top of the
			 * table). DIV elements (with or without a custom class) can also be added to
			 * aid styling. The follow syntax is used:
			 *   <ul>
			 *     <li>The following options are allowed:
			 *       <ul>
			 *         <li>'l' - Length changing</li
			 *         <li>'f' - Filtering input</li>
			 *         <li>'t' - The table!</li>
			 *         <li>'i' - Information</li>
			 *         <li>'p' - Pagination</li>
			 *         <li>'r' - pRocessing</li>
			 *       </ul>
			 *     </li>
			 *     <li>The following constants are allowed:
			 *       <ul>
			 *         <li>'H' - jQueryUI theme "header" classes ('fg-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix')</li>
			 *         <li>'F' - jQueryUI theme "footer" classes ('fg-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix')</li>
			 *       </ul>
			 *     </li>
			 *     <li>The following syntax is expected:
			 *       <ul>
			 *         <li>'&lt;' and '&gt;' - div elements</li>
			 *         <li>'&lt;"class" and '&gt;' - div with a class</li>
			 *         <li>'&lt;"#id" and '&gt;' - div with an ID</li>
			 *       </ul>
			 *     </li>
			 *     <li>Examples:
			 *       <ul>
			 *         <li>'&lt;"wrapper"flipt&gt;'</li>
			 *         <li>'&lt;lf&lt;t&gt;ip&gt;'</li>
			 *       </ul>
			 *     </li>
			 *   </ul>
			 *  @type string
			 *  @default lfrtip <i>(when bJQueryUI is false)</i> <b>or</b>
			 *    <"H"lfr>t<"F"ip> <i>(when bJQueryUI is true)</i>
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "sDom": '&lt;"top"i&gt;rt&lt;"bottom"flp&gt;&lt;"clear"&gt;'
		 *      } );
		 *    } );
			 */
			"sDom": "lfrtip",


			/**
			 * DataTables features two different built-in pagination interaction methods
			 * ('two_button' or 'full_numbers') which present different page controls to
			 * the end user. Further methods can be added using the API (see below).
			 *  @type string
			 *  @default two_button
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "sPaginationType": "full_numbers"
		 *      } );
		 *    } )
			 */
			"sPaginationType": "two_button",


			/**
			 * Enable horizontal scrolling. When a table is too wide to fit into a certain
			 * layout, or you have a large number of columns in the table, you can enable
			 * x-scrolling to show the table in a viewport, which can be scrolled. This
			 * property can be any CSS unit, or a number (in which case it will be treated
			 * as a pixel measurement).
			 *  @type string
			 *  @default <i>blank string - i.e. disabled</i>
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "sScrollX": "100%",
		 *        "bScrollCollapse": true
		 *      } );
		 *    } );
			 */
			"sScrollX": "",


			/**
			 * This property can be used to force a DataTable to use more width than it
			 * might otherwise do when x-scrolling is enabled. For example if you have a
			 * table which requires to be well spaced, this parameter is useful for
			 * "over-sizing" the table, and thus forcing scrolling. This property can by
			 * any CSS unit, or a number (in which case it will be treated as a pixel
			 * measurement).
			 *  @type string
			 *  @default <i>blank string - i.e. disabled</i>
			 *  @dtopt Options
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "sScrollX": "100%",
		 *        "sScrollXInner": "110%"
		 *      } );
		 *    } );
			 */
			"sScrollXInner": "",


			/**
			 * Enable vertical scrolling. Vertical scrolling will constrain the DataTable
			 * to the given height, and enable scrolling for any data which overflows the
			 * current viewport. This can be used as an alternative to paging to display
			 * a lot of data in a small area (although paging and scrolling can both be
			 * enabled at the same time). This property can be any CSS unit, or a number
			 * (in which case it will be treated as a pixel measurement).
			 *  @type string
			 *  @default <i>blank string - i.e. disabled</i>
			 *  @dtopt Features
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "sScrollY": "200px",
		 *        "bPaginate": false
		 *      } );
		 *    } );
			 */
			"sScrollY": "",


			/**
			 * Set the HTTP method that is used to make the Ajax call for server-side
			 * processing or Ajax sourced data.
			 *  @type string
			 *  @default GET
			 *  @dtopt Options
			 *  @dtopt Server-side
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "bServerSide": true,
		 *        "sAjaxSource": "scripts/post.php",
		 *        "sServerMethod": "POST"
		 *      } );
		 *    } );
			 */
			"sServerMethod": "GET"
		};



		/**
		 * Column options that can be given to DataTables at initialisation time.
		 *  @namespace
		 */
		DataTable.defaults.columns = {
			/**
			 * Allows a column's sorting to take multiple columns into account when
			 * doing a sort. For example first name / last name columns make sense to
			 * do a multi-column sort over the two columns.
			 *  @type array
			 *  @default null <i>Takes the value of the column index automatically</i>
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [
		 *          { "aDataSort": [ 0, 1 ], "aTargets": [ 0 ] },
		 *          { "aDataSort": [ 1, 0 ], "aTargets": [ 1 ] },
		 *          { "aDataSort": [ 2, 3, 4 ], "aTargets": [ 2 ] }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [
		 *          { "aDataSort": [ 0, 1 ] },
		 *          { "aDataSort": [ 1, 0 ] },
		 *          { "aDataSort": [ 2, 3, 4 ] },
		 *          null,
		 *          null
		 *        ]
		 *      } );
		 *    } );
			 */
			"aDataSort": null,


			/**
			 * You can control the default sorting direction, and even alter the behaviour
			 * of the sort handler (i.e. only allow ascending sorting etc) using this
			 * parameter.
			 *  @type array
			 *  @default [ 'asc', 'desc' ]
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [
		 *          { "asSorting": [ "asc" ], "aTargets": [ 1 ] },
		 *          { "asSorting": [ "desc", "asc", "asc" ], "aTargets": [ 2 ] },
		 *          { "asSorting": [ "desc" ], "aTargets": [ 3 ] }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [
		 *          null,
		 *          { "asSorting": [ "asc" ] },
		 *          { "asSorting": [ "desc", "asc", "asc" ] },
		 *          { "asSorting": [ "desc" ] },
		 *          null
		 *        ]
		 *      } );
		 *    } );
			 */
			"asSorting": [ 'asc', 'desc' ],


			/**
			 * Enable or disable filtering on the data in this column.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ 
		 *          { "bSearchable": false, "aTargets": [ 0 ] }
		 *        ] } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          { "bSearchable": false },
		 *          null,
		 *          null,
		 *          null,
		 *          null
		 *        ] } );
		 *    } );
			 */
			"bSearchable": true,


			/**
			 * Enable or disable sorting on this column.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ 
		 *          { "bSortable": false, "aTargets": [ 0 ] }
		 *        ] } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          { "bSortable": false },
		 *          null,
		 *          null,
		 *          null,
		 *          null
		 *        ] } );
		 *    } );
			 */
			"bSortable": true,


			/**
			 * <code>Deprecated</code> When using fnRender() for a column, you may wish
			 * to use the original data (before rendering) for sorting and filtering
			 * (the default is to used the rendered data that the user can see). This
			 * may be useful for dates etc.
			 *
			 * Please note that this option has now been deprecated and will be removed
			 * in the next version of DataTables. Please use mRender / mData rather than
			 * fnRender.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Columns
			 *  @deprecated
			 */
			"bUseRendered": true,


			/**
			 * Enable or disable the display of this column.
			 *  @type boolean
			 *  @default true
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ 
		 *          { "bVisible": false, "aTargets": [ 0 ] }
		 *        ] } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          { "bVisible": false },
		 *          null,
		 *          null,
		 *          null,
		 *          null
		 *        ] } );
		 *    } );
			 */
			"bVisible": true,


			/**
			 * Developer definable function that is called whenever a cell is created (Ajax source,
			 * etc) or processed for input (DOM source). This can be used as a compliment to mRender
			 * allowing you to modify the DOM element (add background colour for example) when the
			 * element is available.
			 *  @type function
			 *  @param {element} nTd The TD node that has been created
			 *  @param {*} sData The Data for the cell
			 *  @param {array|object} oData The data for the whole row
			 *  @param {int} iRow The row index for the aoData data store
			 *  @param {int} iCol The column index for aoColumns
			 *  @dtopt Columns
			 *
			 *  @example
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ {
		 *          "aTargets": [3],
		 *          "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
		 *            if ( sData == "1.7" ) {
		 *              $(nTd).css('color', 'blue')
		 *            }
		 *          }
		 *        } ]
		 *      });
		 *    } );
			 */
			"fnCreatedCell": null,


			/**
			 * <code>Deprecated</code> Custom display function that will be called for the
			 * display of each cell in this column.
			 *
			 * Please note that this option has now been deprecated and will be removed
			 * in the next version of DataTables. Please use mRender / mData rather than
			 * fnRender.
			 *  @type function
			 *  @param {object} o Object with the following parameters:
			 *  @param {int}    o.iDataRow The row in aoData
			 *  @param {int}    o.iDataColumn The column in question
			 *  @param {array}  o.aData The data for the row in question
			 *  @param {object} o.oSettings The settings object for this DataTables instance
			 *  @param {object} o.mDataProp The data property used for this column
			 *  @param {*}      val The current cell value
			 *  @returns {string} The string you which to use in the display
			 *  @dtopt Columns
			 *  @deprecated
			 */
			"fnRender": null,


			/**
			 * The column index (starting from 0!) that you wish a sort to be performed
			 * upon when this column is selected for sorting. This can be used for sorting
			 * on hidden columns for example.
			 *  @type int
			 *  @default -1 <i>Use automatically calculated column index</i>
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ 
		 *          { "iDataSort": 1, "aTargets": [ 0 ] }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          { "iDataSort": 1 },
		 *          null,
		 *          null,
		 *          null,
		 *          null
		 *        ]
		 *      } );
		 *    } );
			 */
			"iDataSort": -1,


			/**
			 * This parameter has been replaced by mData in DataTables to ensure naming
			 * consistency. mDataProp can still be used, as there is backwards compatibility
			 * in DataTables for this option, but it is strongly recommended that you use
			 * mData in preference to mDataProp.
			 *  @name DataTable.defaults.columns.mDataProp
			 */


			/**
			 * This property can be used to read data from any JSON data source property,
			 * including deeply nested objects / properties. mData can be given in a
			 * number of different ways which effect its behaviour:
			 *   <ul>
			 *     <li>integer - treated as an array index for the data source. This is the
			 *       default that DataTables uses (incrementally increased for each column).</li>
			 *     <li>string - read an object property from the data source. Note that you can
			 *       use Javascript dotted notation to read deep properties / arrays from the
			 *       data source.</li>
			 *     <li>null - the sDefaultContent option will be used for the cell (null
			 *       by default, so you will need to specify the default content you want -
			 *       typically an empty string). This can be useful on generated columns such
			 *       as edit / delete action columns.</li>
			 *     <li>function - the function given will be executed whenever DataTables
			 *       needs to set or get the data for a cell in the column. The function
			 *       takes three parameters:
			 *       <ul>
			 *         <li>{array|object} The data source for the row</li>
			 *         <li>{string} The type call data requested - this will be 'set' when
			 *           setting data or 'filter', 'display', 'type', 'sort' or undefined when
			 *           gathering data. Note that when <i>undefined</i> is given for the type
			 *           DataTables expects to get the raw data for the object back</li>
			 *         <li>{*} Data to set when the second parameter is 'set'.</li>
			 *       </ul>
			 *       The return value from the function is not required when 'set' is the type
			 *       of call, but otherwise the return is what will be used for the data
			 *       requested.</li>
			 *    </ul>
			 *
			 * Note that prior to DataTables 1.9.2 mData was called mDataProp. The name change
			 * reflects the flexibility of this property and is consistent with the naming of
			 * mRender. If 'mDataProp' is given, then it will still be used by DataTables, as
			 * it automatically maps the old name to the new if required.
			 *  @type string|int|function|null
			 *  @default null <i>Use automatically calculated column index</i>
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Read table data from objects
			 *    $(document).ready( function() {
		 *      var oTable = $('#example').dataTable( {
		 *        "sAjaxSource": "sources/deep.txt",
		 *        "aoColumns": [
		 *          { "mData": "engine" },
		 *          { "mData": "browser" },
		 *          { "mData": "platform.inner" },
		 *          { "mData": "platform.details.0" },
		 *          { "mData": "platform.details.1" }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using mData as a function to provide different information for
			 *    // sorting, filtering and display. In this case, currency (price)
			 *    $(document).ready( function() {
		 *      var oTable = $('#example').dataTable( {
		 *        "aoColumnDefs": [ {
		 *          "aTargets": [ 0 ],
		 *          "mData": function ( source, type, val ) {
		 *            if (type === 'set') {
		 *              source.price = val;
		 *              // Store the computed dislay and filter values for efficiency
		 *              source.price_display = val=="" ? "" : "$"+numberFormat(val);
		 *              source.price_filter  = val=="" ? "" : "$"+numberFormat(val)+" "+val;
		 *              return;
		 *            }
		 *            else if (type === 'display') {
		 *              return source.price_display;
		 *            }
		 *            else if (type === 'filter') {
		 *              return source.price_filter;
		 *            }
		 *            // 'sort', 'type' and undefined all just use the integer
		 *            return source.price;
		 *          }
		 *        } ]
		 *      } );
		 *    } );
			 */
			"mData": null,


			/**
			 * This property is the rendering partner to mData and it is suggested that
			 * when you want to manipulate data for display (including filtering, sorting etc)
			 * but not altering the underlying data for the table, use this property. mData
			 * can actually do everything this property can and more, but this parameter is
			 * easier to use since there is no 'set' option. Like mData is can be given
			 * in a number of different ways to effect its behaviour, with the addition of
			 * supporting array syntax for easy outputting of arrays (including arrays of
			 * objects):
			 *   <ul>
			 *     <li>integer - treated as an array index for the data source. This is the
			 *       default that DataTables uses (incrementally increased for each column).</li>
			 *     <li>string - read an object property from the data source. Note that you can
			 *       use Javascript dotted notation to read deep properties / arrays from the
			 *       data source and also array brackets to indicate that the data reader should
			 *       loop over the data source array. When characters are given between the array
			 *       brackets, these characters are used to join the data source array together.
			 *       For example: "accounts[, ].name" would result in a comma separated list with
			 *       the 'name' value from the 'accounts' array of objects.</li>
			 *     <li>function - the function given will be executed whenever DataTables
			 *       needs to set or get the data for a cell in the column. The function
			 *       takes three parameters:
			 *       <ul>
			 *         <li>{array|object} The data source for the row (based on mData)</li>
			 *         <li>{string} The type call data requested - this will be 'filter', 'display',
			 *           'type' or 'sort'.</li>
			 *         <li>{array|object} The full data source for the row (not based on mData)</li>
			 *       </ul>
			 *       The return value from the function is what will be used for the data
			 *       requested.</li>
			 *    </ul>
			 *  @type string|int|function|null
			 *  @default null <i>Use mData</i>
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Create a comma separated list from an array of objects
			 *    $(document).ready( function() {
		 *      var oTable = $('#example').dataTable( {
		 *        "sAjaxSource": "sources/deep.txt",
		 *        "aoColumns": [
		 *          { "mData": "engine" },
		 *          { "mData": "browser" },
		 *          {
		 *            "mData": "platform",
		 *            "mRender": "[, ].name"
		 *          }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Use as a function to create a link from the data source
			 *    $(document).ready( function() {
		 *      var oTable = $('#example').dataTable( {
		 *        "aoColumnDefs": [
		 *        {
		 *          "aTargets": [ 0 ],
		 *          "mData": "download_link",
		 *          "mRender": function ( data, type, full ) {
		 *            return '<a href="'+data+'">Download</a>';
		 *          }
		 *        ]
		 *      } );
		 *    } );
		 */
			"mRender": null,


			/**
			 * Change the cell type created for the column - either TD cells or TH cells. This
			 * can be useful as TH cells have semantic meaning in the table body, allowing them
			 * to act as a header for a row (you may wish to add scope='row' to the TH elements).
			 *  @type string
			 *  @default td
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Make the first column use TH cells
			 *    $(document).ready( function() {
		 *      var oTable = $('#example').dataTable( {
		 *        "aoColumnDefs": [ {
		 *          "aTargets": [ 0 ],
		 *          "sCellType": "th"
		 *        } ]
		 *      } );
		 *    } );
			 */
			"sCellType": "td",


			/**
			 * Class to give to each cell in this column.
			 *  @type string
			 *  @default <i>Empty string</i>
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ 
		 *          { "sClass": "my_class", "aTargets": [ 0 ] }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          { "sClass": "my_class" },
		 *          null,
		 *          null,
		 *          null,
		 *          null
		 *        ]
		 *      } );
		 *    } );
			 */
			"sClass": "",

			/**
			 * When DataTables calculates the column widths to assign to each column,
			 * it finds the longest string in each column and then constructs a
			 * temporary table and reads the widths from that. The problem with this
			 * is that "mmm" is much wider then "iiii", but the latter is a longer
			 * string - thus the calculation can go wrong (doing it properly and putting
			 * it into an DOM object and measuring that is horribly(!) slow). Thus as
			 * a "work around" we provide this option. It will append its value to the
			 * text that is found to be the longest string for the column - i.e. padding.
			 * Generally you shouldn't need this, and it is not documented on the
			 * general DataTables.net documentation
			 *  @type string
			 *  @default <i>Empty string<i>
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          null,
		 *          null,
		 *          null,
		 *          {
		 *            "sContentPadding": "mmm"
		 *          }
		 *        ]
		 *      } );
		 *    } );
			 */
			"sContentPadding": "",


			/**
			 * Allows a default value to be given for a column's data, and will be used
			 * whenever a null data source is encountered (this can be because mData
			 * is set to null, or because the data source itself is null).
			 *  @type string
			 *  @default null
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ 
		 *          {
		 *            "mData": null,
		 *            "sDefaultContent": "Edit",
		 *            "aTargets": [ -1 ]
		 *          }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          null,
		 *          null,
		 *          null,
		 *          {
		 *            "mData": null,
		 *            "sDefaultContent": "Edit"
		 *          }
		 *        ]
		 *      } );
		 *    } );
			 */
			"sDefaultContent": null,


			/**
			 * This parameter is only used in DataTables' server-side processing. It can
			 * be exceptionally useful to know what columns are being displayed on the
			 * client side, and to map these to database fields. When defined, the names
			 * also allow DataTables to reorder information from the server if it comes
			 * back in an unexpected order (i.e. if you switch your columns around on the
			 * client-side, your server-side code does not also need updating).
			 *  @type string
			 *  @default <i>Empty string</i>
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ 
		 *          { "sName": "engine", "aTargets": [ 0 ] },
		 *          { "sName": "browser", "aTargets": [ 1 ] },
		 *          { "sName": "platform", "aTargets": [ 2 ] },
		 *          { "sName": "version", "aTargets": [ 3 ] },
		 *          { "sName": "grade", "aTargets": [ 4 ] }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          { "sName": "engine" },
		 *          { "sName": "browser" },
		 *          { "sName": "platform" },
		 *          { "sName": "version" },
		 *          { "sName": "grade" }
		 *        ]
		 *      } );
		 *    } );
			 */
			"sName": "",


			/**
			 * Defines a data source type for the sorting which can be used to read
			 * real-time information from the table (updating the internally cached
			 * version) prior to sorting. This allows sorting to occur on user editable
			 * elements such as form inputs.
			 *  @type string
			 *  @default std
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [
		 *          { "sSortDataType": "dom-text", "aTargets": [ 2, 3 ] },
		 *          { "sType": "numeric", "aTargets": [ 3 ] },
		 *          { "sSortDataType": "dom-select", "aTargets": [ 4 ] },
		 *          { "sSortDataType": "dom-checkbox", "aTargets": [ 5 ] }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [
		 *          null,
		 *          null,
		 *          { "sSortDataType": "dom-text" },
		 *          { "sSortDataType": "dom-text", "sType": "numeric" },
		 *          { "sSortDataType": "dom-select" },
		 *          { "sSortDataType": "dom-checkbox" }
		 *        ]
		 *      } );
		 *    } );
			 */
			"sSortDataType": "std",


			/**
			 * The title of this column.
			 *  @type string
			 *  @default null <i>Derived from the 'TH' value for this column in the
			 *    original HTML table.</i>
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ 
		 *          { "sTitle": "My column title", "aTargets": [ 0 ] }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          { "sTitle": "My column title" },
		 *          null,
		 *          null,
		 *          null,
		 *          null
		 *        ]
		 *      } );
		 *    } );
			 */
			"sTitle": null,


			/**
			 * The type allows you to specify how the data for this column will be sorted.
			 * Four types (string, numeric, date and html (which will strip HTML tags
			 * before sorting)) are currently available. Note that only date formats
			 * understood by Javascript's Date() object will be accepted as type date. For
			 * example: "Mar 26, 2008 5:03 PM". May take the values: 'string', 'numeric',
			 * 'date' or 'html' (by default). Further types can be adding through
			 * plug-ins.
			 *  @type string
			 *  @default null <i>Auto-detected from raw data</i>
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ 
		 *          { "sType": "html", "aTargets": [ 0 ] }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          { "sType": "html" },
		 *          null,
		 *          null,
		 *          null,
		 *          null
		 *        ]
		 *      } );
		 *    } );
			 */
			"sType": null,


			/**
			 * Defining the width of the column, this parameter may take any CSS value
			 * (3em, 20px etc). DataTables apples 'smart' widths to columns which have not
			 * been given a specific width through this interface ensuring that the table
			 * remains readable.
			 *  @type string
			 *  @default null <i>Automatic</i>
			 *  @dtopt Columns
			 *
			 *  @example
			 *    // Using aoColumnDefs
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumnDefs": [ 
		 *          { "sWidth": "20%", "aTargets": [ 0 ] }
		 *        ]
		 *      } );
		 *    } );
			 *
			 *  @example
			 *    // Using aoColumns
			 *    $(document).ready( function() {
		 *      $('#example').dataTable( {
		 *        "aoColumns": [ 
		 *          { "sWidth": "20%" },
		 *          null,
		 *          null,
		 *          null,
		 *          null
		 *        ]
		 *      } );
		 *    } );
			 */
			"sWidth": null
		};



		/**
		 * DataTables settings object - this holds all the information needed for a
		 * given table, including configuration, data and current application of the
		 * table options. DataTables does not have a single instance for each DataTable
		 * with the settings attached to that instance, but rather instances of the
		 * DataTable "class" are created on-the-fly as needed (typically by a
		 * $().dataTable() call) and the settings object is then applied to that
		 * instance.
		 *
		 * Note that this object is related to {@link DataTable.defaults} but this
		 * one is the internal data store for DataTables's cache of columns. It should
		 * NOT be manipulated outside of DataTables. Any configuration should be done
		 * through the initialisation options.
		 *  @namespace
		 *  @todo Really should attach the settings object to individual instances so we
		 *    don't need to create new instances on each $().dataTable() call (if the
		 *    table already exists). It would also save passing oSettings around and
		 *    into every single function. However, this is a very significant
		 *    architecture change for DataTables and will almost certainly break
		 *    backwards compatibility with older installations. This is something that
		 *    will be done in 2.0.
		 */
		DataTable.models.oSettings = {
			/**
			 * Primary features of DataTables and their enablement state.
			 *  @namespace
			 */
			"oFeatures": {

				/**
				 * Flag to say if DataTables should automatically try to calculate the
				 * optimum table and columns widths (true) or not (false).
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bAutoWidth": null,

				/**
				 * Delay the creation of TR and TD elements until they are actually
				 * needed by a driven page draw. This can give a significant speed
				 * increase for Ajax source and Javascript source data, but makes no
				 * difference at all fro DOM and server-side processing tables.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bDeferRender": null,

				/**
				 * Enable filtering on the table or not. Note that if this is disabled
				 * then there is no filtering at all on the table, including fnFilter.
				 * To just remove the filtering input use sDom and remove the 'f' option.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bFilter": null,

				/**
				 * Table information element (the 'Showing x of y records' div) enable
				 * flag.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bInfo": null,

				/**
				 * Present a user control allowing the end user to change the page size
				 * when pagination is enabled.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bLengthChange": null,

				/**
				 * Pagination enabled or not. Note that if this is disabled then length
				 * changing must also be disabled.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bPaginate": null,

				/**
				 * Processing indicator enable flag whenever DataTables is enacting a
				 * user request - typically an Ajax request for server-side processing.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bProcessing": null,

				/**
				 * Server-side processing enabled flag - when enabled DataTables will
				 * get all data from the server for every draw - there is no filtering,
				 * sorting or paging done on the client-side.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bServerSide": null,

				/**
				 * Sorting enablement flag.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bSort": null,

				/**
				 * Apply a class to the columns which are being sorted to provide a
				 * visual highlight or not. This can slow things down when enabled since
				 * there is a lot of DOM interaction.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bSortClasses": null,

				/**
				 * State saving enablement flag.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bStateSave": null
			},


			/**
			 * Scrolling settings for a table.
			 *  @namespace
			 */
			"oScroll": {
				/**
				 * Indicate if DataTables should be allowed to set the padding / margin
				 * etc for the scrolling header elements or not. Typically you will want
				 * this.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bAutoCss": null,

				/**
				 * When the table is shorter in height than sScrollY, collapse the
				 * table container down to the height of the table (when true).
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bCollapse": null,

				/**
				 * Infinite scrolling enablement flag. Now deprecated in favour of
				 * using the Scroller plug-in.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type boolean
				 */
				"bInfinite": null,

				/**
				 * Width of the scrollbar for the web-browser's platform. Calculated
				 * during table initialisation.
				 *  @type int
				 *  @default 0
				 */
				"iBarWidth": 0,

				/**
				 * Space (in pixels) between the bottom of the scrolling container and
				 * the bottom of the scrolling viewport before the next page is loaded
				 * when using infinite scrolling.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type int
				 */
				"iLoadGap": null,

				/**
				 * Viewport width for horizontal scrolling. Horizontal scrolling is
				 * disabled if an empty string.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type string
				 */
				"sX": null,

				/**
				 * Width to expand the table to when using x-scrolling. Typically you
				 * should not need to use this.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type string
				 *  @deprecated
				 */
				"sXInner": null,

				/**
				 * Viewport height for vertical scrolling. Vertical scrolling is disabled
				 * if an empty string.
				 * Note that this parameter will be set by the initialisation routine. To
				 * set a default use {@link DataTable.defaults}.
				 *  @type string
				 */
				"sY": null
			},

			/**
			 * Language information for the table.
			 *  @namespace
			 *  @extends DataTable.defaults.oLanguage
			 */
			"oLanguage": {
				/**
				 * Information callback function. See
				 * {@link DataTable.defaults.fnInfoCallback}
				 *  @type function
				 *  @default null
				 */
				"fnInfoCallback": null
			},

			/**
			 * Browser support parameters
			 *  @namespace
			 */
			"oBrowser": {
				/**
				 * Indicate if the browser incorrectly calculates width:100% inside a
				 * scrolling element (IE6/7)
				 *  @type boolean
				 *  @default false
				 */
				"bScrollOversize": false
			},

			/**
			 * Array referencing the nodes which are used for the features. The
			 * parameters of this object match what is allowed by sDom - i.e.
			 *   <ul>
			 *     <li>'l' - Length changing</li>
			 *     <li>'f' - Filtering input</li>
			 *     <li>'t' - The table!</li>
			 *     <li>'i' - Information</li>
			 *     <li>'p' - Pagination</li>
			 *     <li>'r' - pRocessing</li>
			 *   </ul>
			 *  @type array
			 *  @default []
			 */
			"aanFeatures": [],

			/**
			 * Store data information - see {@link DataTable.models.oRow} for detailed
			 * information.
			 *  @type array
			 *  @default []
			 */
			"aoData": [],

			/**
			 * Array of indexes which are in the current display (after filtering etc)
			 *  @type array
			 *  @default []
			 */
			"aiDisplay": [],

			/**
			 * Array of indexes for display - no filtering
			 *  @type array
			 *  @default []
			 */
			"aiDisplayMaster": [],

			/**
			 * Store information about each column that is in use
			 *  @type array
			 *  @default []
			 */
			"aoColumns": [],

			/**
			 * Store information about the table's header
			 *  @type array
			 *  @default []
			 */
			"aoHeader": [],

			/**
			 * Store information about the table's footer
			 *  @type array
			 *  @default []
			 */
			"aoFooter": [],

			/**
			 * Search data array for regular expression searching
			 *  @type array
			 *  @default []
			 */
			"asDataSearch": [],

			/**
			 * Store the applied global search information in case we want to force a
			 * research or compare the old search to a new one.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @namespace
			 *  @extends DataTable.models.oSearch
			 */
			"oPreviousSearch": {},

			/**
			 * Store the applied search for each column - see
			 * {@link DataTable.models.oSearch} for the format that is used for the
			 * filtering information for each column.
			 *  @type array
			 *  @default []
			 */
			"aoPreSearchCols": [],

			/**
			 * Sorting that is applied to the table. Note that the inner arrays are
			 * used in the following manner:
			 * <ul>
			 *   <li>Index 0 - column number</li>
			 *   <li>Index 1 - current sorting direction</li>
			 *   <li>Index 2 - index of asSorting for this column</li>
			 * </ul>
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type array
			 *  @todo These inner arrays should really be objects
			 */
			"aaSorting": null,

			/**
			 * Sorting that is always applied to the table (i.e. prefixed in front of
			 * aaSorting).
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type array|null
			 *  @default null
			 */
			"aaSortingFixed": null,

			/**
			 * Classes to use for the striping of a table.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type array
			 *  @default []
			 */
			"asStripeClasses": null,

			/**
			 * If restoring a table - we should restore its striping classes as well
			 *  @type array
			 *  @default []
			 */
			"asDestroyStripes": [],

			/**
			 * If restoring a table - we should restore its width
			 *  @type int
			 *  @default 0
			 */
			"sDestroyWidth": 0,

			/**
			 * Callback functions array for every time a row is inserted (i.e. on a draw).
			 *  @type array
			 *  @default []
			 */
			"aoRowCallback": [],

			/**
			 * Callback functions for the header on each draw.
			 *  @type array
			 *  @default []
			 */
			"aoHeaderCallback": [],

			/**
			 * Callback function for the footer on each draw.
			 *  @type array
			 *  @default []
			 */
			"aoFooterCallback": [],

			/**
			 * Array of callback functions for draw callback functions
			 *  @type array
			 *  @default []
			 */
			"aoDrawCallback": [],

			/**
			 * Array of callback functions for row created function
			 *  @type array
			 *  @default []
			 */
			"aoRowCreatedCallback": [],

			/**
			 * Callback functions for just before the table is redrawn. A return of
			 * false will be used to cancel the draw.
			 *  @type array
			 *  @default []
			 */
			"aoPreDrawCallback": [],

			/**
			 * Callback functions for when the table has been initialised.
			 *  @type array
			 *  @default []
			 */
			"aoInitComplete": [],


			/**
			 * Callbacks for modifying the settings to be stored for state saving, prior to
			 * saving state.
			 *  @type array
			 *  @default []
			 */
			"aoStateSaveParams": [],

			/**
			 * Callbacks for modifying the settings that have been stored for state saving
			 * prior to using the stored values to restore the state.
			 *  @type array
			 *  @default []
			 */
			"aoStateLoadParams": [],

			/**
			 * Callbacks for operating on the settings object once the saved state has been
			 * loaded
			 *  @type array
			 *  @default []
			 */
			"aoStateLoaded": [],

			/**
			 * Cache the table ID for quick access
			 *  @type string
			 *  @default <i>Empty string</i>
			 */
			"sTableId": "",

			/**
			 * The TABLE node for the main table
			 *  @type node
			 *  @default null
			 */
			"nTable": null,

			/**
			 * Permanent ref to the thead element
			 *  @type node
			 *  @default null
			 */
			"nTHead": null,

			/**
			 * Permanent ref to the tfoot element - if it exists
			 *  @type node
			 *  @default null
			 */
			"nTFoot": null,

			/**
			 * Permanent ref to the tbody element
			 *  @type node
			 *  @default null
			 */
			"nTBody": null,

			/**
			 * Cache the wrapper node (contains all DataTables controlled elements)
			 *  @type node
			 *  @default null
			 */
			"nTableWrapper": null,

			/**
			 * Indicate if when using server-side processing the loading of data
			 * should be deferred until the second draw.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type boolean
			 *  @default false
			 */
			"bDeferLoading": false,

			/**
			 * Indicate if all required information has been read in
			 *  @type boolean
			 *  @default false
			 */
			"bInitialised": false,

			/**
			 * Information about open rows. Each object in the array has the parameters
			 * 'nTr' and 'nParent'
			 *  @type array
			 *  @default []
			 */
			"aoOpenRows": [],

			/**
			 * Dictate the positioning of DataTables' control elements - see
			 * {@link DataTable.model.oInit.sDom}.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type string
			 *  @default null
			 */
			"sDom": null,

			/**
			 * Which type of pagination should be used.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type string
			 *  @default two_button
			 */
			"sPaginationType": "two_button",

			/**
			 * The cookie duration (for bStateSave) in seconds.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type int
			 *  @default 0
			 */
			"iCookieDuration": 0,

			/**
			 * The cookie name prefix.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type string
			 *  @default <i>Empty string</i>
			 */
			"sCookiePrefix": "",

			/**
			 * Callback function for cookie creation.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type function
			 *  @default null
			 */
			"fnCookieCallback": null,

			/**
			 * Array of callback functions for state saving. Each array element is an
			 * object with the following parameters:
			 *   <ul>
			 *     <li>function:fn - function to call. Takes two parameters, oSettings
			 *       and the JSON string to save that has been thus far created. Returns
			 *       a JSON string to be inserted into a json object
			 *       (i.e. '"param": [ 0, 1, 2]')</li>
			 *     <li>string:sName - name of callback</li>
			 *   </ul>
			 *  @type array
			 *  @default []
			 */
			"aoStateSave": [],

			/**
			 * Array of callback functions for state loading. Each array element is an
			 * object with the following parameters:
			 *   <ul>
			 *     <li>function:fn - function to call. Takes two parameters, oSettings
			 *       and the object stored. May return false to cancel state loading</li>
			 *     <li>string:sName - name of callback</li>
			 *   </ul>
			 *  @type array
			 *  @default []
			 */
			"aoStateLoad": [],

			/**
			 * State that was loaded from the cookie. Useful for back reference
			 *  @type object
			 *  @default null
			 */
			"oLoadedState": null,

			/**
			 * Source url for AJAX data for the table.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type string
			 *  @default null
			 */
			"sAjaxSource": null,

			/**
			 * Property from a given object from which to read the table data from. This
			 * can be an empty string (when not server-side processing), in which case
			 * it is  assumed an an array is given directly.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type string
			 */
			"sAjaxDataProp": null,

			/**
			 * Note if draw should be blocked while getting data
			 *  @type boolean
			 *  @default true
			 */
			"bAjaxDataGet": true,

			/**
			 * The last jQuery XHR object that was used for server-side data gathering.
			 * This can be used for working with the XHR information in one of the
			 * callbacks
			 *  @type object
			 *  @default null
			 */
			"jqXHR": null,

			/**
			 * Function to get the server-side data.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type function
			 */
			"fnServerData": null,

			/**
			 * Functions which are called prior to sending an Ajax request so extra
			 * parameters can easily be sent to the server
			 *  @type array
			 *  @default []
			 */
			"aoServerParams": [],

			/**
			 * Send the XHR HTTP method - GET or POST (could be PUT or DELETE if
			 * required).
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type string
			 */
			"sServerMethod": null,

			/**
			 * Format numbers for display.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type function
			 */
			"fnFormatNumber": null,

			/**
			 * List of options that can be used for the user selectable length menu.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type array
			 *  @default []
			 */
			"aLengthMenu": null,

			/**
			 * Counter for the draws that the table does. Also used as a tracker for
			 * server-side processing
			 *  @type int
			 *  @default 0
			 */
			"iDraw": 0,

			/**
			 * Indicate if a redraw is being done - useful for Ajax
			 *  @type boolean
			 *  @default false
			 */
			"bDrawing": false,

			/**
			 * Draw index (iDraw) of the last error when parsing the returned data
			 *  @type int
			 *  @default -1
			 */
			"iDrawError": -1,

			/**
			 * Paging display length
			 *  @type int
			 *  @default 10
			 */
			"_iDisplayLength": 10,

			/**
			 * Paging start point - aiDisplay index
			 *  @type int
			 *  @default 0
			 */
			"_iDisplayStart": 0,

			/**
			 * Paging end point - aiDisplay index. Use fnDisplayEnd rather than
			 * this property to get the end point
			 *  @type int
			 *  @default 10
			 *  @private
			 */
			"_iDisplayEnd": 10,

			/**
			 * Server-side processing - number of records in the result set
			 * (i.e. before filtering), Use fnRecordsTotal rather than
			 * this property to get the value of the number of records, regardless of
			 * the server-side processing setting.
			 *  @type int
			 *  @default 0
			 *  @private
			 */
			"_iRecordsTotal": 0,

			/**
			 * Server-side processing - number of records in the current display set
			 * (i.e. after filtering). Use fnRecordsDisplay rather than
			 * this property to get the value of the number of records, regardless of
			 * the server-side processing setting.
			 *  @type boolean
			 *  @default 0
			 *  @private
			 */
			"_iRecordsDisplay": 0,

			/**
			 * Flag to indicate if jQuery UI marking and classes should be used.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type boolean
			 */
			"bJUI": null,

			/**
			 * The classes to use for the table
			 *  @type object
			 *  @default {}
			 */
			"oClasses": {},

			/**
			 * Flag attached to the settings object so you can check in the draw
			 * callback if filtering has been done in the draw. Deprecated in favour of
			 * events.
			 *  @type boolean
			 *  @default false
			 *  @deprecated
			 */
			"bFiltered": false,

			/**
			 * Flag attached to the settings object so you can check in the draw
			 * callback if sorting has been done in the draw. Deprecated in favour of
			 * events.
			 *  @type boolean
			 *  @default false
			 *  @deprecated
			 */
			"bSorted": false,

			/**
			 * Indicate that if multiple rows are in the header and there is more than
			 * one unique cell per column, if the top one (true) or bottom one (false)
			 * should be used for sorting / title by DataTables.
			 * Note that this parameter will be set by the initialisation routine. To
			 * set a default use {@link DataTable.defaults}.
			 *  @type boolean
			 */
			"bSortCellsTop": null,

			/**
			 * Initialisation object that is used for the table
			 *  @type object
			 *  @default null
			 */
			"oInit": null,

			/**
			 * Destroy callback functions - for plug-ins to attach themselves to the
			 * destroy so they can clean up markup and events.
			 *  @type array
			 *  @default []
			 */
			"aoDestroyCallback": [],


			/**
			 * Get the number of records in the current record set, before filtering
			 *  @type function
			 */
			"fnRecordsTotal": function ()
			{
				if ( this.oFeatures.bServerSide ) {
					return parseInt(this._iRecordsTotal, 10);
				} else {
					return this.aiDisplayMaster.length;
				}
			},

			/**
			 * Get the number of records in the current record set, after filtering
			 *  @type function
			 */
			"fnRecordsDisplay": function ()
			{
				if ( this.oFeatures.bServerSide ) {
					return parseInt(this._iRecordsDisplay, 10);
				} else {
					return this.aiDisplay.length;
				}
			},

			/**
			 * Set the display end point - aiDisplay index
			 *  @type function
			 *  @todo Should do away with _iDisplayEnd and calculate it on-the-fly here
			 */
			"fnDisplayEnd": function ()
			{
				if ( this.oFeatures.bServerSide ) {
					if ( this.oFeatures.bPaginate === false || this._iDisplayLength == -1 ) {
						return this._iDisplayStart+this.aiDisplay.length;
					} else {
						return Math.min( this._iDisplayStart+this._iDisplayLength,
							this._iRecordsDisplay );
					}
				} else {
					return this._iDisplayEnd;
				}
			},

			/**
			 * The DataTables object for this table
			 *  @type object
			 *  @default null
			 */
			"oInstance": null,

			/**
			 * Unique identifier for each instance of the DataTables object. If there
			 * is an ID on the table node, then it takes that value, otherwise an
			 * incrementing internal counter is used.
			 *  @type string
			 *  @default null
			 */
			"sInstance": null,

			/**
			 * tabindex attribute value that is added to DataTables control elements, allowing
			 * keyboard navigation of the table and its controls.
			 */
			"iTabIndex": 0,

			/**
			 * DIV container for the footer scrolling table if scrolling
			 */
			"nScrollHead": null,

			/**
			 * DIV container for the footer scrolling table if scrolling
			 */
			"nScrollFoot": null
		};

		/**
		 * Extension object for DataTables that is used to provide all extension options.
		 *
		 * Note that the <i>DataTable.ext</i> object is available through
		 * <i>jQuery.fn.dataTable.ext</i> where it may be accessed and manipulated. It is
		 * also aliased to <i>jQuery.fn.dataTableExt</i> for historic reasons.
		 *  @namespace
		 *  @extends DataTable.models.ext
		 */
		DataTable.ext = $.extend( true, {}, DataTable.models.ext );

		$.extend( DataTable.ext.oStdClasses, {
			"sTable": "dataTable",

			/* Two buttons buttons */
			"sPagePrevEnabled": "paginate_enabled_previous",
			"sPagePrevDisabled": "paginate_disabled_previous",
			"sPageNextEnabled": "paginate_enabled_next",
			"sPageNextDisabled": "paginate_disabled_next",
			"sPageJUINext": "",
			"sPageJUIPrev": "",

			/* Full numbers paging buttons */
			"sPageButton": "paginate_button",
			"sPageButtonActive": "paginate_active",
			"sPageButtonStaticDisabled": "paginate_button paginate_button_disabled",
			"sPageFirst": "first",
			"sPagePrevious": "previous",
			"sPageNext": "next",
			"sPageLast": "last",

			/* Striping classes */
			"sStripeOdd": "odd",
			"sStripeEven": "even",

			/* Empty row */
			"sRowEmpty": "dataTables_empty",

			/* Features */
			"sWrapper": "dataTables_wrapper",
			"sFilter": "dataTables_filter",
			"sInfo": "dataTables_info",
			"sPaging": "dataTables_paginate paging_", /* Note that the type is postfixed */
			"sLength": "dataTables_length",
			"sProcessing": "dataTables_processing",

			/* Sorting */
			"sSortAsc": "sorting_asc",
			"sSortDesc": "sorting_desc",
			"sSortable": "sorting", /* Sortable in both directions */
			"sSortableAsc": "sorting_asc_disabled",
			"sSortableDesc": "sorting_desc_disabled",
			"sSortableNone": "sorting_disabled",
			"sSortColumn": "sorting_", /* Note that an int is postfixed for the sorting order */
			"sSortJUIAsc": "",
			"sSortJUIDesc": "",
			"sSortJUI": "",
			"sSortJUIAscAllowed": "",
			"sSortJUIDescAllowed": "",
			"sSortJUIWrapper": "",
			"sSortIcon": "",

			/* Scrolling */
			"sScrollWrapper": "dataTables_scroll",
			"sScrollHead": "dataTables_scrollHead",
			"sScrollHeadInner": "dataTables_scrollHeadInner",
			"sScrollBody": "dataTables_scrollBody",
			"sScrollFoot": "dataTables_scrollFoot",
			"sScrollFootInner": "dataTables_scrollFootInner",

			/* Misc */
			"sFooterTH": "",
			"sJUIHeader": "",
			"sJUIFooter": ""
		} );


		$.extend( DataTable.ext.oJUIClasses, DataTable.ext.oStdClasses, {
			/* Two buttons buttons */
			"sPagePrevEnabled": "fg-button ui-button ui-state-default ui-corner-left",
			"sPagePrevDisabled": "fg-button ui-button ui-state-default ui-corner-left ui-state-disabled",
			"sPageNextEnabled": "fg-button ui-button ui-state-default ui-corner-right",
			"sPageNextDisabled": "fg-button ui-button ui-state-default ui-corner-right ui-state-disabled",
			"sPageJUINext": "ui-icon ui-icon-circle-arrow-e",
			"sPageJUIPrev": "ui-icon ui-icon-circle-arrow-w",

			/* Full numbers paging buttons */
			"sPageButton": "fg-button ui-button ui-state-default",
			"sPageButtonActive": "fg-button ui-button ui-state-default ui-state-disabled",
			"sPageButtonStaticDisabled": "fg-button ui-button ui-state-default ui-state-disabled",
			"sPageFirst": "first ui-corner-tl ui-corner-bl",
			"sPageLast": "last ui-corner-tr ui-corner-br",

			/* Features */
			"sPaging": "dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi "+
			"ui-buttonset-multi paging_", /* Note that the type is postfixed */

			/* Sorting */
			"sSortAsc": "ui-state-default",
			"sSortDesc": "ui-state-default",
			"sSortable": "ui-state-default",
			"sSortableAsc": "ui-state-default",
			"sSortableDesc": "ui-state-default",
			"sSortableNone": "ui-state-default",
			"sSortJUIAsc": "css_right ui-icon ui-icon-triangle-1-n",
			"sSortJUIDesc": "css_right ui-icon ui-icon-triangle-1-s",
			"sSortJUI": "css_right ui-icon ui-icon-carat-2-n-s",
			"sSortJUIAscAllowed": "css_right ui-icon ui-icon-carat-1-n",
			"sSortJUIDescAllowed": "css_right ui-icon ui-icon-carat-1-s",
			"sSortJUIWrapper": "DataTables_sort_wrapper",
			"sSortIcon": "DataTables_sort_icon",

			/* Scrolling */
			"sScrollHead": "dataTables_scrollHead ui-state-default",
			"sScrollFoot": "dataTables_scrollFoot ui-state-default",

			/* Misc */
			"sFooterTH": "ui-state-default",
			"sJUIHeader": "fg-toolbar ui-toolbar ui-widget-header ui-corner-tl ui-corner-tr ui-helper-clearfix",
			"sJUIFooter": "fg-toolbar ui-toolbar ui-widget-header ui-corner-bl ui-corner-br ui-helper-clearfix"
		} );

		/*
		 * Variable: oPagination
		 * Purpose:  
		 * Scope:    jQuery.fn.dataTableExt
		 */
		$.extend( DataTable.ext.oPagination, {
			/*
			 * Variable: two_button
			 * Purpose:  Standard two button (forward/back) pagination
			 * Scope:    jQuery.fn.dataTableExt.oPagination
			 */
			"two_button": {
				/*
				 * Function: oPagination.two_button.fnInit
				 * Purpose:  Initialise dom elements required for pagination with forward/back buttons only
				 * Returns:  -
				 * Inputs:   object:oSettings - dataTables settings object
				 *           node:nPaging - the DIV which contains this pagination control
				 *           function:fnCallbackDraw - draw function which must be called on update
				 */
				"fnInit": function ( oSettings, nPaging, fnCallbackDraw )
				{
					var oLang = oSettings.oLanguage.oPaginate;
					var oClasses = oSettings.oClasses;
					var fnClickHandler = function ( e ) {
						if ( oSettings.oApi._fnPageChange( oSettings, e.data.action ) )
						{
							fnCallbackDraw( oSettings );
						}
					};

					var sAppend = (!oSettings.bJUI) ?
					'<a class="'+oSettings.oClasses.sPagePrevDisabled+'" tabindex="'+oSettings.iTabIndex+'" role="button">'+oLang.sPrevious+'</a>'+
					'<a class="'+oSettings.oClasses.sPageNextDisabled+'" tabindex="'+oSettings.iTabIndex+'" role="button">'+oLang.sNext+'</a>'
						:
					'<a class="'+oSettings.oClasses.sPagePrevDisabled+'" tabindex="'+oSettings.iTabIndex+'" role="button"><span class="'+oSettings.oClasses.sPageJUIPrev+'"></span></a>'+
					'<a class="'+oSettings.oClasses.sPageNextDisabled+'" tabindex="'+oSettings.iTabIndex+'" role="button"><span class="'+oSettings.oClasses.sPageJUINext+'"></span></a>';
					$(nPaging).append( sAppend );

					var els = $('a', nPaging);
					var nPrevious = els[0],
						nNext = els[1];

					oSettings.oApi._fnBindAction( nPrevious, {action: "previous"}, fnClickHandler );
					oSettings.oApi._fnBindAction( nNext,     {action: "next"},     fnClickHandler );

					/* ID the first elements only */
					if ( !oSettings.aanFeatures.p )
					{
						nPaging.id = oSettings.sTableId+'_paginate';
						nPrevious.id = oSettings.sTableId+'_previous';
						nNext.id = oSettings.sTableId+'_next';

						nPrevious.setAttribute('aria-controls', oSettings.sTableId);
						nNext.setAttribute('aria-controls', oSettings.sTableId);
					}
				},

				/*
				 * Function: oPagination.two_button.fnUpdate
				 * Purpose:  Update the two button pagination at the end of the draw
				 * Returns:  -
				 * Inputs:   object:oSettings - dataTables settings object
				 *           function:fnCallbackDraw - draw function to call on page change
				 */
				"fnUpdate": function ( oSettings, fnCallbackDraw )
				{
					if ( !oSettings.aanFeatures.p )
					{
						return;
					}

					var oClasses = oSettings.oClasses;
					var an = oSettings.aanFeatures.p;
					var nNode;

					/* Loop over each instance of the pager */
					for ( var i=0, iLen=an.length ; i<iLen ; i++ )
					{
						nNode = an[i].firstChild;
						if ( nNode )
						{
							/* Previous page */
							nNode.className = ( oSettings._iDisplayStart === 0 ) ?
								oClasses.sPagePrevDisabled : oClasses.sPagePrevEnabled;

							/* Next page */
							nNode = nNode.nextSibling;
							nNode.className = ( oSettings.fnDisplayEnd() == oSettings.fnRecordsDisplay() ) ?
								oClasses.sPageNextDisabled : oClasses.sPageNextEnabled;
						}
					}
				}
			},


			/*
			 * Variable: iFullNumbersShowPages
			 * Purpose:  Change the number of pages which can be seen
			 * Scope:    jQuery.fn.dataTableExt.oPagination
			 */
			"iFullNumbersShowPages": 5,

			/*
			 * Variable: full_numbers
			 * Purpose:  Full numbers pagination
			 * Scope:    jQuery.fn.dataTableExt.oPagination
			 */
			"full_numbers": {
				/*
				 * Function: oPagination.full_numbers.fnInit
				 * Purpose:  Initialise dom elements required for pagination with a list of the pages
				 * Returns:  -
				 * Inputs:   object:oSettings - dataTables settings object
				 *           node:nPaging - the DIV which contains this pagination control
				 *           function:fnCallbackDraw - draw function which must be called on update
				 */
				"fnInit": function ( oSettings, nPaging, fnCallbackDraw )
				{
					var oLang = oSettings.oLanguage.oPaginate;
					var oClasses = oSettings.oClasses;
					var fnClickHandler = function ( e ) {
						if ( oSettings.oApi._fnPageChange( oSettings, e.data.action ) )
						{
							fnCallbackDraw( oSettings );
						}
					};

					$(nPaging).append(
						'<a  tabindex="'+oSettings.iTabIndex+'" class="'+oClasses.sPageButton+" "+oClasses.sPageFirst+'">'+oLang.sFirst+'</a>'+
						'<a  tabindex="'+oSettings.iTabIndex+'" class="'+oClasses.sPageButton+" "+oClasses.sPagePrevious+'">'+oLang.sPrevious+'</a>'+
						'<span></span>'+
						'<a tabindex="'+oSettings.iTabIndex+'" class="'+oClasses.sPageButton+" "+oClasses.sPageNext+'">'+oLang.sNext+'</a>'+
						'<a tabindex="'+oSettings.iTabIndex+'" class="'+oClasses.sPageButton+" "+oClasses.sPageLast+'">'+oLang.sLast+'</a>'
					);
					var els = $('a', nPaging);
					var nFirst = els[0],
						nPrev = els[1],
						nNext = els[2],
						nLast = els[3];

					oSettings.oApi._fnBindAction( nFirst, {action: "first"},    fnClickHandler );
					oSettings.oApi._fnBindAction( nPrev,  {action: "previous"}, fnClickHandler );
					oSettings.oApi._fnBindAction( nNext,  {action: "next"},     fnClickHandler );
					oSettings.oApi._fnBindAction( nLast,  {action: "last"},     fnClickHandler );

					/* ID the first elements only */
					if ( !oSettings.aanFeatures.p )
					{
						nPaging.id = oSettings.sTableId+'_paginate';
						nFirst.id =oSettings.sTableId+'_first';
						nPrev.id =oSettings.sTableId+'_previous';
						nNext.id =oSettings.sTableId+'_next';
						nLast.id =oSettings.sTableId+'_last';
					}
				},

				/*
				 * Function: oPagination.full_numbers.fnUpdate
				 * Purpose:  Update the list of page buttons shows
				 * Returns:  -
				 * Inputs:   object:oSettings - dataTables settings object
				 *           function:fnCallbackDraw - draw function to call on page change
				 */
				"fnUpdate": function ( oSettings, fnCallbackDraw )
				{
					if ( !oSettings.aanFeatures.p )
					{
						return;
					}

					var iPageCount = DataTable.ext.oPagination.iFullNumbersShowPages;
					var iPageCountHalf = Math.floor(iPageCount / 2);
					var iPages = Math.ceil((oSettings.fnRecordsDisplay()) / oSettings._iDisplayLength);
					var iCurrentPage = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength) + 1;
					var sList = "";
					var iStartButton, iEndButton, i, iLen;
					var oClasses = oSettings.oClasses;
					var anButtons, anStatic, nPaginateList, nNode;
					var an = oSettings.aanFeatures.p;
					var fnBind = function (j) {
						oSettings.oApi._fnBindAction( this, {"page": j+iStartButton-1}, function(e) {
							/* Use the information in the element to jump to the required page */
							oSettings.oApi._fnPageChange( oSettings, e.data.page );
							fnCallbackDraw( oSettings );
							e.preventDefault();
						} );
					};

					/* Pages calculation */
					if ( oSettings._iDisplayLength === -1 )
					{
						iStartButton = 1;
						iEndButton = 1;
						iCurrentPage = 1;
					}
					else if (iPages < iPageCount)
					{
						iStartButton = 1;
						iEndButton = iPages;
					}
					else if (iCurrentPage <= iPageCountHalf)
					{
						iStartButton = 1;
						iEndButton = iPageCount;
					}
					else if (iCurrentPage >= (iPages - iPageCountHalf))
					{
						iStartButton = iPages - iPageCount + 1;
						iEndButton = iPages;
					}
					else
					{
						iStartButton = iCurrentPage - Math.ceil(iPageCount / 2) + 1;
						iEndButton = iStartButton + iPageCount - 1;
					}


					/* Build the dynamic list */
					for ( i=iStartButton ; i<=iEndButton ; i++ )
					{
						sList += (iCurrentPage !== i) ?
						'<a tabindex="'+oSettings.iTabIndex+'" class="'+oClasses.sPageButton+'">'+oSettings.fnFormatNumber(i)+'</a>' :
						'<a tabindex="'+oSettings.iTabIndex+'" class="'+oClasses.sPageButtonActive+'">'+oSettings.fnFormatNumber(i)+'</a>';
					}

					/* Loop over each instance of the pager */
					for ( i=0, iLen=an.length ; i<iLen ; i++ )
					{
						nNode = an[i];
						if ( !nNode.hasChildNodes() )
						{
							continue;
						}

						/* Build up the dynamic list first - html and listeners */
						$('span:eq(0)', nNode)
							.html( sList )
							.children('a').each( fnBind );

						/* Update the permanent button's classes */
						anButtons = nNode.getElementsByTagName('a');
						anStatic = [
							anButtons[0], anButtons[1],
							anButtons[anButtons.length-2], anButtons[anButtons.length-1]
						];

						$(anStatic).removeClass( oClasses.sPageButton+" "+oClasses.sPageButtonActive+" "+oClasses.sPageButtonStaticDisabled );
						$([anStatic[0], anStatic[1]]).addClass(
							(iCurrentPage==1) ?
								oClasses.sPageButtonStaticDisabled :
								oClasses.sPageButton
						);
						$([anStatic[2], anStatic[3]]).addClass(
							(iPages===0 || iCurrentPage===iPages || oSettings._iDisplayLength===-1) ?
								oClasses.sPageButtonStaticDisabled :
								oClasses.sPageButton
						);
					}
				}
			}
		} );

		$.extend( DataTable.ext.oSort, {
			/*
			 * text sorting
			 */
			"string-pre": function ( a )
			{
				if ( typeof a != 'string' ) {
					a = (a !== null && a.toString) ? a.toString() : '';
				}
				return a.toLowerCase();
			},

			"string-asc": function ( x, y )
			{
				return ((x < y) ? -1 : ((x > y) ? 1 : 0));
			},

			"string-desc": function ( x, y )
			{
				return ((x < y) ? 1 : ((x > y) ? -1 : 0));
			},


			/*
			 * html sorting (ignore html tags)
			 */
			"html-pre": function ( a )
			{
				return a.replace( /<.*?>/g, "" ).toLowerCase();
			},

			"html-asc": function ( x, y )
			{
				return ((x < y) ? -1 : ((x > y) ? 1 : 0));
			},

			"html-desc": function ( x, y )
			{
				return ((x < y) ? 1 : ((x > y) ? -1 : 0));
			},


			/*
			 * date sorting
			 */
			"date-pre": function ( a )
			{
				var x = Date.parse( a );

				if ( isNaN(x) || x==="" )
				{
					x = Date.parse( "01/01/1970 00:00:00" );
				}
				return x;
			},

			"date-asc": function ( x, y )
			{
				return x - y;
			},

			"date-desc": function ( x, y )
			{
				return y - x;
			},


			/*
			 * numerical sorting
			 */
			"numeric-pre": function ( a )
			{
				return (a=="-" || a==="") ? 0 : a*1;
			},

			"numeric-asc": function ( x, y )
			{
				return x - y;
			},

			"numeric-desc": function ( x, y )
			{
				return y - x;
			}
		} );


		$.extend( DataTable.ext.aTypes, [
			/*
			 * Function: -
			 * Purpose:  Check to see if a string is numeric
			 * Returns:  string:'numeric' or null
			 * Inputs:   mixed:sText - string to check
			 */
			function ( sData )
			{
				/* Allow zero length strings as a number */
				if ( typeof sData === 'number' )
				{
					return 'numeric';
				}
				else if ( typeof sData !== 'string' )
				{
					return null;
				}

				var sValidFirstChars = "0123456789-";
				var sValidChars = "0123456789.";
				var Char;
				var bDecimal = false;

				/* Check for a valid first char (no period and allow negatives) */
				Char = sData.charAt(0);
				if (sValidFirstChars.indexOf(Char) == -1)
				{
					return null;
				}

				/* Check all the other characters are valid */
				for ( var i=1 ; i<sData.length ; i++ )
				{
					Char = sData.charAt(i);
					if (sValidChars.indexOf(Char) == -1)
					{
						return null;
					}

					/* Only allowed one decimal place... */
					if ( Char == "." )
					{
						if ( bDecimal )
						{
							return null;
						}
						bDecimal = true;
					}
				}

				return 'numeric';
			},

			/*
			 * Function: -
			 * Purpose:  Check to see if a string is actually a formatted date
			 * Returns:  string:'date' or null
			 * Inputs:   string:sText - string to check
			 */
			function ( sData )
			{
				var iParse = Date.parse(sData);
				if ( (iParse !== null && !isNaN(iParse)) || (typeof sData === 'string' && sData.length === 0) )
				{
					return 'date';
				}
				return null;
			},

			/*
			 * Function: -
			 * Purpose:  Check to see if a string should be treated as an HTML string
			 * Returns:  string:'html' or null
			 * Inputs:   string:sText - string to check
			 */
			function ( sData )
			{
				if ( typeof sData === 'string' && sData.indexOf('<') != -1 && sData.indexOf('>') != -1 )
				{
					return 'html';
				}
				return null;
			}
		] );


		// jQuery aliases
		$.fn.DataTable = DataTable;
		$.fn.dataTable = DataTable;
		$.fn.dataTableSettings = DataTable.settings;
		$.fn.dataTableExt = DataTable.ext;


		// Information about events fired by DataTables - for documentation.
		/**
		 * Draw event, fired whenever the table is redrawn on the page, at the same point as
		 * fnDrawCallback. This may be useful for binding events or performing calculations when
		 * the table is altered at all.
		 *  @name DataTable#draw
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} o DataTables settings object {@link DataTable.models.oSettings}
		 */

		/**
		 * Filter event, fired when the filtering applied to the table (using the build in global
		 * global filter, or column filters) is altered.
		 *  @name DataTable#filter
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} o DataTables settings object {@link DataTable.models.oSettings}
		 */

		/**
		 * Page change event, fired when the paging of the table is altered.
		 *  @name DataTable#page
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} o DataTables settings object {@link DataTable.models.oSettings}
		 */

		/**
		 * Sort event, fired when the sorting applied to the table is altered.
		 *  @name DataTable#sort
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} o DataTables settings object {@link DataTable.models.oSettings}
		 */

		/**
		 * DataTables initialisation complete event, fired when the table is fully drawn,
		 * including Ajax data loaded, if Ajax data is required.
		 *  @name DataTable#init
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} oSettings DataTables settings object
		 *  @param {object} json The JSON object request from the server - only
		 *    present if client-side Ajax sourced data is used</li></ol>
		 */

		/**
		 * State save event, fired when the table has changed state a new state save is required.
		 * This method allows modification of the state saving object prior to actually doing the
		 * save, including addition or other state properties (for plug-ins) or modification
		 * of a DataTables core property.
		 *  @name DataTable#stateSaveParams
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} oSettings DataTables settings object
		 *  @param {object} json The state information to be saved
		 */

		/**
		 * State load event, fired when the table is loading state from the stored data, but
		 * prior to the settings object being modified by the saved state - allowing modification
		 * of the saved state is required or loading of state for a plug-in.
		 *  @name DataTable#stateLoadParams
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} oSettings DataTables settings object
		 *  @param {object} json The saved state information
		 */

		/**
		 * State loaded event, fired when state has been loaded from stored data and the settings
		 * object has been modified by the loaded data.
		 *  @name DataTable#stateLoaded
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} oSettings DataTables settings object
		 *  @param {object} json The saved state information
		 */

		/**
		 * Processing event, fired when DataTables is doing some kind of processing (be it,
		 * sort, filter or anything else). Can be used to indicate to the end user that
		 * there is something happening, or that something has finished.
		 *  @name DataTable#processing
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} oSettings DataTables settings object
		 *  @param {boolean} bShow Flag for if DataTables is doing processing or not
		 */

		/**
		 * Ajax (XHR) event, fired whenever an Ajax request is completed from a request to
		 * made to the server for new data (note that this trigger is called in fnServerData,
		 * if you override fnServerData and which to use this event, you need to trigger it in
		 * you success function).
		 *  @name DataTable#xhr
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} o DataTables settings object {@link DataTable.models.oSettings}
		 *  @param {object} json JSON returned from the server
		 */

		/**
		 * Destroy event, fired when the DataTable is destroyed by calling fnDestroy or passing
		 * the bDestroy:true parameter in the initialisation object. This can be used to remove
		 * bound events, added DOM nodes, etc.
		 *  @name DataTable#destroy
		 *  @event
		 *  @param {event} e jQuery event object
		 *  @param {object} o DataTables settings object {@link DataTable.models.oSettings}
		 */
	}));

}(window, document));
/*! Copyright (c) 2011 Piotr Rochala (http://rocha.la)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.3
 *
 */
(function ($) {

  $.fn.extend({
    slimScroll: function (options) {

      var defaults = {
        // width in pixels of the visible scroll area
        width: 'auto',
        // height in pixels of the visible scroll area
        height: '250px',
        // width in pixels of the scrollbar and rail
        size: '7px',
        // scrollbar color, accepts any hex/color value
        color: '#000',
        // scrollbar position - left/right
        position: 'right',
        // distance in pixels between the side edge and the scrollbar
        distance: '1px',
        // default scroll position on load - top / bottom / $('selector')
        start: 'top',
        // sets scrollbar opacity
        opacity: .4,
        // enables always-on mode for the scrollbar
        alwaysVisible: false,
        // check if we should hide the scrollbar when user is hovering over
        disableFadeOut: false,
        // sets visibility of the rail
        railVisible: false,
        // sets rail color
        railColor: '#333',
        // sets rail opacity
        railOpacity: .2,
        // whether  we should use jQuery UI Draggable to enable bar dragging
        railDraggable: true,
        // defautlt CSS class of the slimscroll rail
        railClass: 'slimScrollRail',
        // defautlt CSS class of the slimscroll bar
        barClass: 'slimScrollBar',
        // defautlt CSS class of the slimscroll wrapper
        wrapperClass: 'slimScrollDiv',
        // check if mousewheel should scroll the window if we reach top/bottom
        allowPageScroll: false,
        // scroll amount applied to each mouse wheel step
        wheelStep: 20,
        // scroll amount applied when user is using gestures
        touchScrollStep: 200,
        // sets border radius
        borderRadius: '7px',
        // sets border radius of the rail
        railBorderRadius: '7px'
      };

      var o = $.extend(defaults, options);

      // do it for every element that matches selector
      this.each(function () {

        var isOverPanel, isOverBar, isDragg, queueHide, touchDif,
                barHeight, percentScroll, lastScroll,
                divS = '<div></div>',
                minBarHeight = 30,
                releaseScroll = false;

        // used in event handlers and for better minification
        var me = $(this);

        // ensure we are not binding it again
        if (me.parent().hasClass(o.wrapperClass))
        {
          // start from last bar position
          var offset = me.scrollTop();

          // find bar and rail
          bar = me.parent().find('.' + o.barClass);
          rail = me.parent().find('.' + o.railClass);

          getBarHeight();

          // check if we should scroll existing instance
          if ($.isPlainObject(options))
          {
            // Pass height: auto to an existing slimscroll object to force a resize after contents have changed
            if ('height' in options && options.height == 'auto') {
              me.parent().css('height', 'auto');
              me.css('height', 'auto');
              var height = me.parent().parent().height();
              me.parent().css('height', height);
              me.css('height', height);
            }

            if ('scrollTo' in options)
            {
              // jump to a static point
              offset = parseInt(o.scrollTo);
            }
            else if ('scrollBy' in options)
            {
              // jump by value pixels
              offset += parseInt(o.scrollBy);
            }
            else if ('destroy' in options)
            {
              // remove slimscroll elements
              bar.remove();
              rail.remove();
              me.unwrap();
              return;
            }

            // scroll content by the given offset
            scrollContent(offset, false, true);
          }

          return;
        }
        else if ($.isPlainObject(options))
        {
          if ('destroy' in options)
          {
            return;
          }
        }

        // optionally set height to the parent's height
        o.height = (o.height == 'auto') ? me.parent().height() : o.height;

        // wrap content
        var wrapper = $(divS)
                .addClass(o.wrapperClass)
                .css({
                  position: 'relative',
                  overflow: 'hidden',
                  width: o.width,
                  height: o.height
                });

        // update style for the div
        me.css({
          overflow: 'hidden',
          width: o.width,
          height: o.height,
          //Fix for IE10
          "-ms-touch-action": "none"
        });

        // create scrollbar rail
        var rail = $(divS)
                .addClass(o.railClass)
                .css({
                  width: o.size,
                  height: '100%',
                  position: 'absolute',
                  top: 0,
                  display: (o.alwaysVisible && o.railVisible) ? 'block' : 'none',
                  'border-radius': o.railBorderRadius,
                  background: o.railColor,
                  opacity: o.railOpacity,
                  zIndex: 90
                });

        // create scrollbar
        var bar = $(divS)
                .addClass(o.barClass)
                .css({
                  background: o.color,
                  width: o.size,
                  position: 'absolute',
                  top: 0,
                  opacity: o.opacity,
                  display: o.alwaysVisible ? 'block' : 'none',
                  'border-radius': o.borderRadius,
                  BorderRadius: o.borderRadius,
                  MozBorderRadius: o.borderRadius,
                  WebkitBorderRadius: o.borderRadius,
                  zIndex: 99
                });

        // set position
        var posCss = (o.position == 'right') ? {right: o.distance} : {left: o.distance};
        rail.css(posCss);
        bar.css(posCss);

        // wrap it
        me.wrap(wrapper);

        // append to parent div
        me.parent().append(bar);
        me.parent().append(rail);

        // make it draggable and no longer dependent on the jqueryUI
        if (o.railDraggable) {
          bar.bind("mousedown", function (e) {
            var $doc = $(document);
            isDragg = true;
            t = parseFloat(bar.css('top'));
            pageY = e.pageY;

            $doc.bind("mousemove.slimscroll", function (e) {
              currTop = t + e.pageY - pageY;
              bar.css('top', currTop);
              scrollContent(0, bar.position().top, false);// scroll content
            });

            $doc.bind("mouseup.slimscroll", function (e) {
              isDragg = false;
              hideBar();
              $doc.unbind('.slimscroll');
            });
            return false;
          }).bind("selectstart.slimscroll", function (e) {
            e.stopPropagation();
            e.preventDefault();
            return false;
          });
        }

        // on rail over
        rail.hover(function () {
          showBar();
        }, function () {
          hideBar();
        });

        // on bar over
        bar.hover(function () {
          isOverBar = true;
        }, function () {
          isOverBar = false;
        });

        // show on parent mouseover
        me.hover(function () {
          isOverPanel = true;
          showBar();
          hideBar();
        }, function () {
          isOverPanel = false;
          hideBar();
        });

        if (window.navigator.msPointerEnabled) {          
          // support for mobile
          me.bind('MSPointerDown', function (e, b) {
            if (e.originalEvent.targetTouches.length)
            {
              // record where touch started
              touchDif = e.originalEvent.targetTouches[0].pageY;
            }
          });

          me.bind('MSPointerMove', function (e) {
            // prevent scrolling the page if necessary
            e.originalEvent.preventDefault();
            if (e.originalEvent.targetTouches.length)
            {
              // see how far user swiped
              var diff = (touchDif - e.originalEvent.targetTouches[0].pageY) / o.touchScrollStep;
              // scroll content
              scrollContent(diff, true);
              touchDif = e.originalEvent.targetTouches[0].pageY;
              
            }
          });
        } else {
          // support for mobile
          me.bind('touchstart', function (e, b) {
            if (e.originalEvent.touches.length)
            {
              // record where touch started
              touchDif = e.originalEvent.touches[0].pageY;
            }
          });

          me.bind('touchmove', function (e) {
            // prevent scrolling the page if necessary
            if (!releaseScroll)
            {
              e.originalEvent.preventDefault();
            }
            if (e.originalEvent.touches.length)
            {
              // see how far user swiped
              var diff = (touchDif - e.originalEvent.touches[0].pageY) / o.touchScrollStep;
              // scroll content
              scrollContent(diff, true);
              touchDif = e.originalEvent.touches[0].pageY;
            }
          });
        }

        // set up initial height
        getBarHeight();

        // check start position
        if (o.start === 'bottom')
        {
          // scroll content to bottom
          bar.css({top: me.outerHeight() - bar.outerHeight()});
          scrollContent(0, true);
        }
        else if (o.start !== 'top')
        {
          // assume jQuery selector
          scrollContent($(o.start).position().top, null, true);

          // make sure bar stays hidden
          if (!o.alwaysVisible) {
            bar.hide();
          }
        }

        // attach scroll events
        attachWheel();

        function _onWheel(e)
        {
          // use mouse wheel only when mouse is over
          if (!isOverPanel) {
            return;
          }

          var e = e || window.event;

          var delta = 0;
          if (e.wheelDelta) {
            delta = -e.wheelDelta / 120;
          }
          if (e.detail) {
            delta = e.detail / 3;
          }

          var target = e.target || e.srcTarget || e.srcElement;
          if ($(target).closest('.' + o.wrapperClass).is(me.parent())) {
            // scroll content
            scrollContent(delta, true);
          }

          // stop window scroll
          if (e.preventDefault && !releaseScroll) {
            e.preventDefault();
          }
          if (!releaseScroll) {
            e.returnValue = false;
          }
        }

        function scrollContent(y, isWheel, isJump)
        {
          releaseScroll = false;
          var delta = y;
          var maxTop = me.outerHeight() - bar.outerHeight();

          if (isWheel)
          {
            // move bar with mouse wheel
            delta = parseInt(bar.css('top')) + y * parseInt(o.wheelStep) / 100 * bar.outerHeight();

            // move bar, make sure it doesn't go out
            delta = Math.min(Math.max(delta, 0), maxTop);

            // if scrolling down, make sure a fractional change to the
            // scroll position isn't rounded away when the scrollbar's CSS is set
            // this flooring of delta would happened automatically when
            // bar.css is set below, but we floor here for clarity
            delta = (y > 0) ? Math.ceil(delta) : Math.floor(delta);

            // scroll the scrollbar
            bar.css({top: delta + 'px'});
          }

          // calculate actual scroll amount
          percentScroll = parseInt(bar.css('top')) / (me.outerHeight() - bar.outerHeight());
          delta = percentScroll * (me[0].scrollHeight - me.outerHeight());

          if (isJump)
          {
            delta = y;
            var offsetTop = delta / me[0].scrollHeight * me.outerHeight();
            offsetTop = Math.min(Math.max(offsetTop, 0), maxTop);
            bar.css({top: offsetTop + 'px'});
          }

          // scroll content
          me.scrollTop(delta);

          // fire scrolling event
          me.trigger('slimscrolling', ~~delta);

          // ensure bar is visible
          showBar();

          // trigger hide when scroll is stopped
          hideBar();
        }

        function attachWheel()
        {
          if (window.addEventListener)
          {
            this.addEventListener('DOMMouseScroll', _onWheel, false);
            this.addEventListener('mousewheel', _onWheel, false);
          }
          else
          {
            document.attachEvent("onmousewheel", _onWheel)
          }
        }

        function getBarHeight()
        {
          // calculate scrollbar height and make sure it is not too small
          barHeight = Math.max((me.outerHeight() / me[0].scrollHeight) * me.outerHeight(), minBarHeight);
          bar.css({height: barHeight + 'px'});

          // hide scrollbar if content is not long enough
          var display = barHeight == me.outerHeight() ? 'none' : 'block';
          bar.css({display: display});
        }

        function showBar()
        {
          // recalculate bar height
          getBarHeight();
          clearTimeout(queueHide);

          // when bar reached top or bottom
          if (percentScroll == ~~percentScroll)
          {
            //release wheel
            releaseScroll = o.allowPageScroll;

            // publish approporiate event
            if (lastScroll != percentScroll)
            {
              var msg = (~~percentScroll == 0) ? 'top' : 'bottom';
              me.trigger('slimscroll', msg);
            }
          }
          else
          {
            releaseScroll = false;
          }
          lastScroll = percentScroll;

          // show only when required
          if (barHeight >= me.outerHeight()) {
            //allow window scroll
            releaseScroll = true;
            return;
          }
          bar.stop(true, true).fadeIn('fast');
          if (o.railVisible) {
            rail.stop(true, true).fadeIn('fast');
          }
        }

        function hideBar()
        {
          // only hide when options allow it
          if (!o.alwaysVisible)
          {
            queueHide = setTimeout(function () {
              if (!(o.disableFadeOut && isOverPanel) && !isOverBar && !isDragg)
              {
                bar.fadeOut('slow');
                rail.fadeOut('slow');
              }
            }, 1000);
          }
        }

      });

      // maintain chainability
      return this;
    }
  });

  $.fn.extend({
    slimscroll: $.fn.slimScroll
  });

})(jQuery);

/*! AdminLTE app.js
 * ================
 * Main JS application file for AdminLTE v2. This file
 * should be included in all pages. It controls some layout
 * options and implements exclusive AdminLTE plugins.
 *
 * @Author  Almsaeed Studio
 * @Support <http://www.almsaeedstudio.com>
 * @Email   <support@almsaeedstudio.com>
 * @version 2.3.0
 * @license MIT <http://opensource.org/licenses/MIT>
 */

//Make sure jQuery has been loaded before app.js
if (typeof jQuery === "undefined") {
  throw new Error("AdminLTE requires jQuery");
}

/* AdminLTE
 *
 * @type Object
 * @description $.AdminLTE is the main object for the template's app.
 *              It's used for implementing functions and options related
 *              to the template. Keeping everything wrapped in an object
 *              prevents conflict with other plugins and is a better
 *              way to organize our code.
 */
$.AdminLTE = {};

/* --------------------
 * - AdminLTE Options -
 * --------------------
 * Modify these options to suit your implementation
 */
$.AdminLTE.options = {
  //Add slimscroll to navbar menus
  //This requires you to load the slimscroll plugin
  //in every page before app.js
  navbarMenuSlimscroll: true,
  navbarMenuSlimscrollWidth: "3px", //The width of the scroll bar
  navbarMenuHeight: "200px", //The height of the inner menu
  //General animation speed for JS animated elements such as box collapse/expand and
  //sidebar treeview slide up/down. This options accepts an integer as milliseconds,
  //'fast', 'normal', or 'slow'
  animationSpeed: 500,
  //Sidebar push menu toggle button selector
  sidebarToggleSelector: "[data-toggle='offcanvas']",
  //Activate sidebar push menu
  sidebarPushMenu: true,
  //Activate sidebar slimscroll if the fixed layout is set (requires SlimScroll Plugin)
  sidebarSlimScroll: true,
  //Enable sidebar expand on hover effect for sidebar mini
  //This option is forced to true if both the fixed layout and sidebar mini
  //are used together
  sidebarExpandOnHover: false,
  //BoxRefresh Plugin
  enableBoxRefresh: true,
  //Bootstrap.js tooltip
  enableBSToppltip: true,
  BSTooltipSelector: "[data-toggle='tooltip']",
  //Enable Fast Click. Fastclick.js creates a more
  //native touch experience with touch devices. If you
  //choose to enable the plugin, make sure you load the script
  //before AdminLTE's app.js
  enableFastclick: true,
  //Control Sidebar Options
  enableControlSidebar: true,
  controlSidebarOptions: {
    //Which button should trigger the open/close event
    toggleBtnSelector: "[data-toggle='control-sidebar']",
    //The sidebar selector
    selector: ".control-sidebar",
    //Enable slide over content
    slide: true
  },
  //Box Widget Plugin. Enable this plugin
  //to allow boxes to be collapsed and/or removed
  enableBoxWidget: true,
  //Box Widget plugin options
  boxWidgetOptions: {
    boxWidgetIcons: {
      //Collapse icon
      collapse: 'fa-minus',
      //Open icon
      open: 'fa-plus',
      //Remove icon
      remove: 'fa-times'
    },
    boxWidgetSelectors: {
      //Remove button selector
      remove: '[data-widget="remove"]',
      //Collapse button selector
      collapse: '[data-widget="collapse"]'
    }
  },
  //Direct Chat plugin options
  directChat: {
    //Enable direct chat by default
    enable: true,
    //The button to open and close the chat contacts pane
    contactToggleSelector: '[data-widget="chat-pane-toggle"]'
  },
  //Define the set of colors to use globally around the website
  colors: {
    lightBlue: "#3c8dbc",
    red: "#f56954",
    green: "#00a65a",
    aqua: "#00c0ef",
    yellow: "#f39c12",
    blue: "#0073b7",
    navy: "#001F3F",
    teal: "#39CCCC",
    olive: "#3D9970",
    lime: "#01FF70",
    orange: "#FF851B",
    fuchsia: "#F012BE",
    purple: "#8E24AA",
    maroon: "#D81B60",
    black: "#222222",
    gray: "#d2d6de"
  },
  //The standard screen sizes that bootstrap uses.
  //If you change these in the variables.less file, change
  //them here too.
  screenSizes: {
    xs: 480,
    sm: 768,
    md: 992,
    lg: 1200
  }
};

/* ------------------
 * - Implementation -
 * ------------------
 * The next block of code implements AdminLTE's
 * functions and plugins as specified by the
 * options above.
 */
$(function () {
  "use strict";

  //Fix for IE page transitions
  $("body").removeClass("hold-transition");

  //Extend options if external options exist
  if (typeof AdminLTEOptions !== "undefined") {
    $.extend(true,
            $.AdminLTE.options,
            AdminLTEOptions);
  }

  //Easy access to options
  var o = $.AdminLTE.options;

  //Set up the object
  _init();

  //Activate the layout maker
  $.AdminLTE.layout.activate();

  //Enable sidebar tree view controls
  $.AdminLTE.tree('.sidebar');

  //Enable control sidebar
  if (o.enableControlSidebar) {
    $.AdminLTE.controlSidebar.activate();
  }

  //Add slimscroll to navbar dropdown
  if (o.navbarMenuSlimscroll && typeof $.fn.slimscroll != 'undefined') {
    $(".navbar .menu").slimscroll({
      height: o.navbarMenuHeight,
      alwaysVisible: false,
      size: o.navbarMenuSlimscrollWidth
    }).css("width", "100%");
  }

  //Activate sidebar push menu
  if (o.sidebarPushMenu) {
    $.AdminLTE.pushMenu.activate(o.sidebarToggleSelector);
  }

  //Activate Bootstrap tooltip
  if (o.enableBSToppltip) {
    $('body').tooltip({
      selector: o.BSTooltipSelector
    });
  }

  //Activate box widget
  if (o.enableBoxWidget) {
    $.AdminLTE.boxWidget.activate();
  }

  //Activate fast click
  if (o.enableFastclick && typeof FastClick != 'undefined') {
    FastClick.attach(document.body);
  }

  //Activate direct chat widget
  if (o.directChat.enable) {
    $(document).on('click', o.directChat.contactToggleSelector, function () {
      var box = $(this).parents('.direct-chat').first();
      box.toggleClass('direct-chat-contacts-open');
    });
  }

  /*
   * INITIALIZE BUTTON TOGGLE
   * ------------------------
   */
  $('.btn-group[data-toggle="btn-toggle"]').each(function () {
    var group = $(this);
    $(this).find(".btn").on('click', function (e) {
      group.find(".btn.active").removeClass("active");
      $(this).addClass("active");
      e.preventDefault();
    });

  });
});

/* ----------------------------------
 * - Initialize the AdminLTE Object -
 * ----------------------------------
 * All AdminLTE functions are implemented below.
 */
function _init() {
  'use strict';
  /* Layout
   * ======
   * Fixes the layout height in case min-height fails.
   *
   * @type Object
   * @usage $.AdminLTE.layout.activate()
   *        $.AdminLTE.layout.fix()
   *        $.AdminLTE.layout.fixSidebar()
   */
  $.AdminLTE.layout = {
    activate: function () {
      var _this = this;
      _this.fix();
      _this.fixSidebar();
      $(window, ".wrapper").resize(function () {
        _this.fix();
        _this.fixSidebar();
      });
    },
    fix: function () {
      //Get window height and the wrapper height
      var neg = $('.main-header').outerHeight() + $('.main-footer').outerHeight();
      var window_height = $(window).height();
      var sidebar_height = $(".sidebar").height();
      //Set the min-height of the content and sidebar based on the
      //the height of the document.
      if ($("body").hasClass("fixed")) {
        $(".content-wrapper, .right-side").css('min-height', window_height - $('.main-footer').outerHeight());
      } else {
        var postSetWidth;
        if (window_height >= sidebar_height) {
          $(".content-wrapper, .right-side").css('min-height', window_height - neg);
          postSetWidth = window_height - neg;
        } else {
          $(".content-wrapper, .right-side").css('min-height', sidebar_height);
          postSetWidth = sidebar_height;
        }

        //Fix for the control sidebar height
        var controlSidebar = $($.AdminLTE.options.controlSidebarOptions.selector);
        if (typeof controlSidebar !== "undefined") {
          if (controlSidebar.height() > postSetWidth)
            $(".content-wrapper, .right-side").css('min-height', controlSidebar.height());
        }

      }
    },
    fixSidebar: function () {
      //Make sure the body tag has the .fixed class
      if (!$("body").hasClass("fixed")) {
        if (typeof $.fn.slimScroll != 'undefined') {
          $(".sidebar").slimScroll({destroy: true}).height("auto");
        }
        return;
      } else if (typeof $.fn.slimScroll == 'undefined' && window.console) {
        window.console.error("Error: the fixed layout requires the slimscroll plugin!");
      }
      //Enable slimscroll for fixed layout
      if ($.AdminLTE.options.sidebarSlimScroll) {
        if (typeof $.fn.slimScroll != 'undefined') {
          //Destroy if it exists
          $(".sidebar").slimScroll({destroy: true}).height("auto");
          //Add slimscroll
          $(".sidebar").slimscroll({
            height: ($(window).height() - $(".main-header").height()) + "px",
            color: "rgba(0,0,0,0.2)",
            size: "3px"
          });
        }
      }
    }
  };

  /* PushMenu()
   * ==========
   * Adds the push menu functionality to the sidebar.
   *
   * @type Function
   * @usage: $.AdminLTE.pushMenu("[data-toggle='offcanvas']")
   */
  $.AdminLTE.pushMenu = {
    activate: function (toggleBtn) {
      //Get the screen sizes
      var screenSizes = $.AdminLTE.options.screenSizes;

      //Enable sidebar toggle
      $(toggleBtn).on('click', function (e) {
        e.preventDefault();

        //Enable sidebar push menu
        if ($(window).width() > (screenSizes.sm - 1)) {
          if ($("body").hasClass('sidebar-collapse')) {
            $("body").removeClass('sidebar-collapse').trigger('expanded.pushMenu');
          } else {
            $("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
          }
        }
        //Handle sidebar push menu for small screens
        else {
          if ($("body").hasClass('sidebar-open')) {
            $("body").removeClass('sidebar-open').removeClass('sidebar-collapse').trigger('collapsed.pushMenu');
          } else {
            $("body").addClass('sidebar-open').trigger('expanded.pushMenu');
          }
        }
      });

      $(".content-wrapper").click(function () {
        //Enable hide menu when clicking on the content-wrapper on small screens
        if ($(window).width() <= (screenSizes.sm - 1) && $("body").hasClass("sidebar-open")) {
          $("body").removeClass('sidebar-open');
        }
      });

      //Enable expand on hover for sidebar mini
      if ($.AdminLTE.options.sidebarExpandOnHover
              || ($('body').hasClass('fixed')
                      && $('body').hasClass('sidebar-mini'))) {
        this.expandOnHover();
      }
    },
    expandOnHover: function () {
      var _this = this;
      var screenWidth = $.AdminLTE.options.screenSizes.sm - 1;
      //Expand sidebar on hover
      $('.main-sidebar').hover(function () {
        if ($('body').hasClass('sidebar-mini')
                && $("body").hasClass('sidebar-collapse')
                && $(window).width() > screenWidth) {
          _this.expand();
        }
      }, function () {
        if ($('body').hasClass('sidebar-mini')
                && $('body').hasClass('sidebar-expanded-on-hover')
                && $(window).width() > screenWidth) {
          _this.collapse();
        }
      });
    },
    expand: function () {
      $("body").removeClass('sidebar-collapse').addClass('sidebar-expanded-on-hover');
    },
    collapse: function () {
      if ($('body').hasClass('sidebar-expanded-on-hover')) {
        $('body').removeClass('sidebar-expanded-on-hover').addClass('sidebar-collapse');
      }
    }
  };

  /* Tree()
   * ======
   * Converts the sidebar into a multilevel
   * tree view menu.
   *
   * @type Function
   * @Usage: $.AdminLTE.tree('.sidebar')
   */
  $.AdminLTE.tree = function (menu) {
    var _this = this;
    var animationSpeed = $.AdminLTE.options.animationSpeed;
    $(document).on('click', menu + ' li a', function (e) {
      //Get the clicked link and the next element
      var $this = $(this);
      var checkElement = $this.next();

      //Check if the next element is a menu and is visible
      if ((checkElement.is('.treeview-menu')) && (checkElement.is(':visible'))) {
        //Close the menu
        checkElement.slideUp(animationSpeed, function () {
          checkElement.removeClass('menu-open');
          //Fix the layout in case the sidebar stretches over the height of the window
          //_this.layout.fix();
        });
        checkElement.parent("li").removeClass("active");
      }
      //If the menu is not visible
      else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
        //Get the parent menu
        var parent = $this.parents('ul').first();
        //Close all open menus within the parent
        var ul = parent.find('ul:visible').slideUp(animationSpeed);
        //Remove the menu-open class from the parent
        ul.removeClass('menu-open');
        //Get the parent li
        var parent_li = $this.parent("li");

        //Open the target menu and add the menu-open class
        checkElement.slideDown(animationSpeed, function () {
          //Add the class active to the parent li
          checkElement.addClass('menu-open');
          parent.find('li.active').removeClass('active');
          parent_li.addClass('active');
          //Fix the layout in case the sidebar stretches over the height of the window
          _this.layout.fix();
        });
      }
      //if this isn't a link, prevent the page from being redirected
      if (checkElement.is('.treeview-menu')) {
        e.preventDefault();
      }
    });
  };

  /* ControlSidebar
   * ==============
   * Adds functionality to the right sidebar
   *
   * @type Object
   * @usage $.AdminLTE.controlSidebar.activate(options)
   */
  $.AdminLTE.controlSidebar = {
    //instantiate the object
    activate: function () {
      //Get the object
      var _this = this;
      //Update options
      var o = $.AdminLTE.options.controlSidebarOptions;
      //Get the sidebar
      var sidebar = $(o.selector);
      //The toggle button
      var btn = $(o.toggleBtnSelector);

      //Listen to the click event
      btn.on('click', function (e) {
        e.preventDefault();
        //If the sidebar is not open
        if (!sidebar.hasClass('control-sidebar-open')
                && !$('body').hasClass('control-sidebar-open')) {
          //Open the sidebar
          _this.open(sidebar, o.slide);
        } else {
          _this.close(sidebar, o.slide);
        }
      });

      //If the body has a boxed layout, fix the sidebar bg position
      var bg = $(".control-sidebar-bg");
      _this._fix(bg);

      //If the body has a fixed layout, make the control sidebar fixed
      if ($('body').hasClass('fixed')) {
        _this._fixForFixed(sidebar);
      } else {
        //If the content height is less than the sidebar's height, force max height
        if ($('.content-wrapper, .right-side').height() < sidebar.height()) {
          _this._fixForContent(sidebar);
        }
      }
    },
    //Open the control sidebar
    open: function (sidebar, slide) {
      //Slide over content
      if (slide) {
        sidebar.addClass('control-sidebar-open');
      } else {
        //Push the content by adding the open class to the body instead
        //of the sidebar itself
        $('body').addClass('control-sidebar-open');
      }
    },
    //Close the control sidebar
    close: function (sidebar, slide) {
      if (slide) {
        sidebar.removeClass('control-sidebar-open');
      } else {
        $('body').removeClass('control-sidebar-open');
      }
    },
    _fix: function (sidebar) {
      var _this = this;
      if ($("body").hasClass('layout-boxed')) {
        sidebar.css('position', 'absolute');
        sidebar.height($(".wrapper").height());
        $(window).resize(function () {
          _this._fix(sidebar);
        });
      } else {
        sidebar.css({
          'position': 'fixed',
          'height': 'auto'
        });
      }
    },
    _fixForFixed: function (sidebar) {
      sidebar.css({
        'position': 'fixed',
        'max-height': '100%',
        'overflow': 'auto',
        'padding-bottom': '50px'
      });
    },
    _fixForContent: function (sidebar) {
      $(".content-wrapper, .right-side").css('min-height', sidebar.height());
    }
  };

  /* BoxWidget
   * =========
   * BoxWidget is a plugin to handle collapsing and
   * removing boxes from the screen.
   *
   * @type Object
   * @usage $.AdminLTE.boxWidget.activate()
   *        Set all your options in the main $.AdminLTE.options object
   */
  $.AdminLTE.boxWidget = {
    selectors: $.AdminLTE.options.boxWidgetOptions.boxWidgetSelectors,
    icons: $.AdminLTE.options.boxWidgetOptions.boxWidgetIcons,
    animationSpeed: $.AdminLTE.options.animationSpeed,
    activate: function (_box) {
      var _this = this;
      if (!_box) {
        _box = document; // activate all boxes per default
      }
      //Listen for collapse event triggers
      $(_box).on('click', _this.selectors.collapse, function (e) {
        e.preventDefault();
        _this.collapse($(this));
      });

      //Listen for remove event triggers
      $(_box).on('click', _this.selectors.remove, function (e) {
        e.preventDefault();
        _this.remove($(this));
      });
    },
    collapse: function (element) {
      var _this = this;
      //Find the box parent
      var box = element.parents(".box").first();
      //Find the body and the footer
      var box_content = box.find("> .box-body, > .box-footer, > form  >.box-body, > form > .box-footer");
      if (!box.hasClass("collapsed-box")) {
        //Convert minus into plus
        element.children(":first")
                .removeClass(_this.icons.collapse)
                .addClass(_this.icons.open);
        //Hide the content
        box_content.slideUp(_this.animationSpeed, function () {
          box.addClass("collapsed-box");
        });
      } else {
        //Convert plus into minus
        element.children(":first")
                .removeClass(_this.icons.open)
                .addClass(_this.icons.collapse);
        //Show the content
        box_content.slideDown(_this.animationSpeed, function () {
          box.removeClass("collapsed-box");
        });
      }
    },
    remove: function (element) {
      //Find the box parent
      var box = element.parents(".box").first();
      box.slideUp(this.animationSpeed);
    }
  };
}

/* ------------------
 * - Custom Plugins -
 * ------------------
 * All custom plugins are defined below.
 */

/*
 * BOX REFRESH BUTTON
 * ------------------
 * This is a custom plugin to use with the component BOX. It allows you to add
 * a refresh button to the box. It converts the box's state to a loading state.
 *
 * @type plugin
 * @usage $("#box-widget").boxRefresh( options );
 */
(function ($) {

  "use strict";

  $.fn.boxRefresh = function (options) {

    // Render options
    var settings = $.extend({
      //Refresh button selector
      trigger: ".refresh-btn",
      //File source to be loaded (e.g: ajax/src.php)
      source: "",
      //Callbacks
      onLoadStart: function (box) {
        return box;
      }, //Right after the button has been clicked
      onLoadDone: function (box) {
        return box;
      } //When the source has been loaded

    }, options);

    //The overlay
    var overlay = $('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');

    return this.each(function () {
      //if a source is specified
      if (settings.source === "") {
        if (window.console) {
          window.console.log("Please specify a source first - boxRefresh()");
        }
        return;
      }
      //the box
      var box = $(this);
      //the button
      var rBtn = box.find(settings.trigger).first();

      //On trigger click
      rBtn.on('click', function (e) {
        e.preventDefault();
        //Add loading overlay
        start(box);

        //Perform ajax call
        box.find(".box-body").load(settings.source, function () {
          done(box);
        });
      });
    });

    function start(box) {
      //Add overlay and loading img
      box.append(overlay);

      settings.onLoadStart.call(box);
    }

    function done(box) {
      //Remove overlay and loading img
      box.find(overlay).remove();

      settings.onLoadDone.call(box);
    }

  };

})(jQuery);

/*
 * EXPLICIT BOX ACTIVATION
 * -----------------------
 * This is a custom plugin to use with the component BOX. It allows you to activate
 * a box inserted in the DOM after the app.js was loaded.
 *
 * @type plugin
 * @usage $("#box-widget").activateBox();
 */
(function ($) {

  'use strict';

  $.fn.activateBox = function () {
    $.AdminLTE.boxWidget.activate(this);
  };

})(jQuery);

/*
 * TODO LIST CUSTOM PLUGIN
 * -----------------------
 * This plugin depends on iCheck plugin for checkbox and radio inputs
 *
 * @type plugin
 * @usage $("#todo-widget").todolist( options );
 */
(function ($) {

  'use strict';

  $.fn.todolist = function (options) {
    // Render options
    var settings = $.extend({
      //When the user checks the input
      onCheck: function (ele) {
        return ele;
      },
      //When the user unchecks the input
      onUncheck: function (ele) {
        return ele;
      }
    }, options);

    return this.each(function () {

      if (typeof $.fn.iCheck != 'undefined') {
        $('input', this).on('ifChecked', function () {
          var ele = $(this).parents("li").first();
          ele.toggleClass("done");
          settings.onCheck.call(ele);
        });

        $('input', this).on('ifUnchecked', function () {
          var ele = $(this).parents("li").first();
          ele.toggleClass("done");
          settings.onUncheck.call(ele);
        });
      } else {
        $('input', this).on('change', function () {
          var ele = $(this).parents("li").first();
          ele.toggleClass("done");
          if ($('input', ele).is(":checked")) {
            settings.onCheck.call(ele);
          } else {
            settings.onUncheck.call(ele);
          }
        });
      }
    });
  };
}(jQuery));
/* Set the defaults for DataTables initialisation */
$.extend( true, $.fn.dataTable.defaults, {
	"sDom": "<'row'<'col-md-6 col-sm-12'l><'col-md-12 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
	"sPaginationType": "bootstrap",
	"oLanguage": {
		"sLengthMenu": "_MENU_ records"
	}
} );


/* Default class modification */
$.extend( $.fn.dataTableExt.oStdClasses, {
	"sWrapper": "dataTables_wrapper form-inline"
} );


/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
	return {
		"iStart":         oSettings._iDisplayStart,
		"iEnd":           oSettings.fnDisplayEnd(),
		"iLength":        oSettings._iDisplayLength,
		"iTotal":         oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
		"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
	};
};


/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
	"bootstrap": {
		"fnInit": function( oSettings, nPaging, fnDraw ) {
			var oLang = oSettings.oLanguage.oPaginate;
			var fnClickHandler = function ( e ) {
				e.preventDefault();
				if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
					fnDraw( oSettings );
				}
			};

			/**
			 // pagination with prev, next link captions
			 $(nPaging).append(
			 '<ul class="pagination">'+
			 '<li class="prev disabled"><a href="#"><i class="icon-angle-left"></i>'+oLang.sPrevious+'</a></li>'+
			 '<li class="next disabled"><a href="#">'+oLang.sNext+'<i class="icon-angle-right"></i></a></li>'+
			 '</ul>'
			 );
			 **/
				// pagination with prev, next link icons
			$(nPaging).append(
				'<ul class="pagination">'+
				'<li class="prev disabled"><a href="#" title="'+oLang.sPrevious+'"><i class="fa fa-angle-left"></i></a></li>'+
				'<li class="next disabled"><a href="#" title="'+oLang.sNext+'"><i class="fa fa-angle-right"></i></a></li>'+
				'</ul>'
			);

			var els = $('a', nPaging);
			$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
			$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
		},

		"fnUpdate": function ( oSettings, fnDraw ) {
			var iListLength = 5;
			var oPaging = oSettings.oInstance.fnPagingInfo();
			var an = oSettings.aanFeatures.p;
			var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

			if ( oPaging.iTotalPages < iListLength) {
				iStart = 1;
				iEnd = oPaging.iTotalPages;
			}
			else if ( oPaging.iPage <= iHalf ) {
				iStart = 1;
				iEnd = iListLength;
			} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
				iStart = oPaging.iTotalPages - iListLength + 1;
				iEnd = oPaging.iTotalPages;
			} else {
				iStart = oPaging.iPage - iHalf + 1;
				iEnd = iStart + iListLength - 1;
			}

			for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
				// Remove the middle elements
				$('li:gt(0)', an[i]).filter(':not(:last)').remove();

				// Add the new list items and their event handlers
				for ( j=iStart ; j<=iEnd ; j++ ) {
					sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
					$('<li '+sClass+'><a href="#">'+j+'</a></li>')
						.insertBefore( $('li:last', an[i])[0] )
						.bind('click', function (e) {
							e.preventDefault();
							oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
							fnDraw( oSettings );
						} );
				}

				// Add / remove disabled classes from the static elements
				if ( oPaging.iPage === 0 ) {
					$('li:first', an[i]).addClass('disabled');
				} else {
					$('li:first', an[i]).removeClass('disabled');
				}

				if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
					$('li:last', an[i]).addClass('disabled');
				} else {
					$('li:last', an[i]).removeClass('disabled');
				}
			}
		}
	}
} );


/*
 * TableTools Bootstrap compatibility
 * Required TableTools 2.1+
 */
if ( $.fn.DataTable.TableTools ) {
	// Set the classes that TableTools uses to something suitable for Bootstrap
	$.extend( true, $.fn.DataTable.TableTools.classes, {
		"container": "DTTT btn-group",
		"buttons": {
			"normal": "btn default",
			"disabled": "disabled"
		},
		"collection": {
			"container": "DTTT_dropdown dropdown-menu",
			"buttons": {
				"normal": "",
				"disabled": "disabled"
			}
		},
		"print": {
			"info": "DTTT_print_info modal"
		},
		"select": {
			"row": "active"
		}
	} );

	// Have the collection use a bootstrap compatible dropdown
	$.extend( true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
		"collection": {
			"container": "ul",
			"button": "li",
			"liner": "a"
		}
	} );
}
;(function () {
	'use strict';

	/**
	 * @preserve FastClick: polyfill to remove click delays on browsers with touch UIs.
	 *
	 * @codingstandard ftlabs-jsv2
	 * @copyright The Financial Times Limited [All Rights Reserved]
	 * @license MIT License (see LICENSE.txt)
	 */

	/*jslint browser:true, node:true*/
	/*global define, Event, Node*/


	/**
	 * Instantiate fast-clicking listeners on the specified layer.
	 *
	 * @constructor
	 * @param {Element} layer The layer to listen on
	 * @param {Object} [options={}] The options to override the defaults
	 */
	function FastClick(layer, options) {
		var oldOnClick;

		options = options || {};

		/**
		 * Whether a click is currently being tracked.
		 *
		 * @type boolean
		 */
		this.trackingClick = false;


		/**
		 * Timestamp for when click tracking started.
		 *
		 * @type number
		 */
		this.trackingClickStart = 0;


		/**
		 * The element being tracked for a click.
		 *
		 * @type EventTarget
		 */
		this.targetElement = null;


		/**
		 * X-coordinate of touch start event.
		 *
		 * @type number
		 */
		this.touchStartX = 0;


		/**
		 * Y-coordinate of touch start event.
		 *
		 * @type number
		 */
		this.touchStartY = 0;


		/**
		 * ID of the last touch, retrieved from Touch.identifier.
		 *
		 * @type number
		 */
		this.lastTouchIdentifier = 0;


		/**
		 * Touchmove boundary, beyond which a click will be cancelled.
		 *
		 * @type number
		 */
		this.touchBoundary = options.touchBoundary || 10;


		/**
		 * The FastClick layer.
		 *
		 * @type Element
		 */
		this.layer = layer;

		/**
		 * The minimum time between tap(touchstart and touchend) events
		 *
		 * @type number
		 */
		this.tapDelay = options.tapDelay || 200;

		/**
		 * The maximum time for a tap
		 *
		 * @type number
		 */
		this.tapTimeout = options.tapTimeout || 700;

		if (FastClick.notNeeded(layer)) {
			return;
		}

		// Some old versions of Android don't have Function.prototype.bind
		function bind(method, context) {
			return function() { return method.apply(context, arguments); };
		}


		var methods = ['onMouse', 'onClick', 'onTouchStart', 'onTouchMove', 'onTouchEnd', 'onTouchCancel'];
		var context = this;
		for (var i = 0, l = methods.length; i < l; i++) {
			context[methods[i]] = bind(context[methods[i]], context);
		}

		// Set up event handlers as required
		if (deviceIsAndroid) {
			layer.addEventListener('mouseover', this.onMouse, true);
			layer.addEventListener('mousedown', this.onMouse, true);
			layer.addEventListener('mouseup', this.onMouse, true);
		}

		layer.addEventListener('click', this.onClick, true);
		layer.addEventListener('touchstart', this.onTouchStart, false);
		layer.addEventListener('touchmove', this.onTouchMove, false);
		layer.addEventListener('touchend', this.onTouchEnd, false);
		layer.addEventListener('touchcancel', this.onTouchCancel, false);

		// Hack is required for browsers that don't support Event#stopImmediatePropagation (e.g. Android 2)
		// which is how FastClick normally stops click events bubbling to callbacks registered on the FastClick
		// layer when they are cancelled.
		if (!Event.prototype.stopImmediatePropagation) {
			layer.removeEventListener = function(type, callback, capture) {
				var rmv = Node.prototype.removeEventListener;
				if (type === 'click') {
					rmv.call(layer, type, callback.hijacked || callback, capture);
				} else {
					rmv.call(layer, type, callback, capture);
				}
			};

			layer.addEventListener = function(type, callback, capture) {
				var adv = Node.prototype.addEventListener;
				if (type === 'click') {
					adv.call(layer, type, callback.hijacked || (callback.hijacked = function(event) {
						if (!event.propagationStopped) {
							callback(event);
						}
					}), capture);
				} else {
					adv.call(layer, type, callback, capture);
				}
			};
		}

		// If a handler is already declared in the element's onclick attribute, it will be fired before
		// FastClick's onClick handler. Fix this by pulling out the user-defined handler function and
		// adding it as listener.
		if (typeof layer.onclick === 'function') {

			// Android browser on at least 3.2 requires a new reference to the function in layer.onclick
			// - the old one won't work if passed to addEventListener directly.
			oldOnClick = layer.onclick;
			layer.addEventListener('click', function(event) {
				oldOnClick(event);
			}, false);
			layer.onclick = null;
		}
	}

	/**
	* Windows Phone 8.1 fakes user agent string to look like Android and iPhone.
	*
	* @type boolean
	*/
	var deviceIsWindowsPhone = navigator.userAgent.indexOf("Windows Phone") >= 0;

	/**
	 * Android requires exceptions.
	 *
	 * @type boolean
	 */
	var deviceIsAndroid = navigator.userAgent.indexOf('Android') > 0 && !deviceIsWindowsPhone;


	/**
	 * iOS requires exceptions.
	 *
	 * @type boolean
	 */
	var deviceIsIOS = /iP(ad|hone|od)/.test(navigator.userAgent) && !deviceIsWindowsPhone;


	/**
	 * iOS 4 requires an exception for select elements.
	 *
	 * @type boolean
	 */
	var deviceIsIOS4 = deviceIsIOS && (/OS 4_\d(_\d)?/).test(navigator.userAgent);


	/**
	 * iOS 6.0-7.* requires the target element to be manually derived
	 *
	 * @type boolean
	 */
	var deviceIsIOSWithBadTarget = deviceIsIOS && (/OS [6-7]_\d/).test(navigator.userAgent);

	/**
	 * BlackBerry requires exceptions.
	 *
	 * @type boolean
	 */
	var deviceIsBlackBerry10 = navigator.userAgent.indexOf('BB10') > 0;

	/**
	 * Determine whether a given element requires a native click.
	 *
	 * @param {EventTarget|Element} target Target DOM element
	 * @returns {boolean} Returns true if the element needs a native click
	 */
	FastClick.prototype.needsClick = function(target) {
		switch (target.nodeName.toLowerCase()) {

		// Don't send a synthetic click to disabled inputs (issue #62)
		case 'button':
		case 'select':
		case 'textarea':
			if (target.disabled) {
				return true;
			}

			break;
		case 'input':

			// File inputs need real clicks on iOS 6 due to a browser bug (issue #68)
			if ((deviceIsIOS && target.type === 'file') || target.disabled) {
				return true;
			}

			break;
		case 'label':
		case 'iframe': // iOS8 homescreen apps can prevent events bubbling into frames
		case 'video':
			return true;
		}

		return (/\bneedsclick\b/).test(target.className);
	};


	/**
	 * Determine whether a given element requires a call to focus to simulate click into element.
	 *
	 * @param {EventTarget|Element} target Target DOM element
	 * @returns {boolean} Returns true if the element requires a call to focus to simulate native click.
	 */
	FastClick.prototype.needsFocus = function(target) {
		switch (target.nodeName.toLowerCase()) {
		case 'textarea':
			return true;
		case 'select':
			return !deviceIsAndroid;
		case 'input':
			switch (target.type) {
			case 'button':
			case 'checkbox':
			case 'file':
			case 'image':
			case 'radio':
			case 'submit':
				return false;
			}

			// No point in attempting to focus disabled inputs
			return !target.disabled && !target.readOnly;
		default:
			return (/\bneedsfocus\b/).test(target.className);
		}
	};


	/**
	 * Send a click event to the specified element.
	 *
	 * @param {EventTarget|Element} targetElement
	 * @param {Event} event
	 */
	FastClick.prototype.sendClick = function(targetElement, event) {
		var clickEvent, touch;

		// On some Android devices activeElement needs to be blurred otherwise the synthetic click will have no effect (#24)
		if (document.activeElement && document.activeElement !== targetElement) {
			document.activeElement.blur();
		}

		touch = event.changedTouches[0];

		// Synthesise a click event, with an extra attribute so it can be tracked
		clickEvent = document.createEvent('MouseEvents');
		clickEvent.initMouseEvent(this.determineEventType(targetElement), true, true, window, 1, touch.screenX, touch.screenY, touch.clientX, touch.clientY, false, false, false, false, 0, null);
		clickEvent.forwardedTouchEvent = true;
		targetElement.dispatchEvent(clickEvent);
	};

	FastClick.prototype.determineEventType = function(targetElement) {

		//Issue #159: Android Chrome Select Box does not open with a synthetic click event
		if (deviceIsAndroid && targetElement.tagName.toLowerCase() === 'select') {
			return 'mousedown';
		}

		return 'click';
	};


	/**
	 * @param {EventTarget|Element} targetElement
	 */
	FastClick.prototype.focus = function(targetElement) {
		var length;

		// Issue #160: on iOS 7, some input elements (e.g. date datetime month) throw a vague TypeError on setSelectionRange. These elements don't have an integer value for the selectionStart and selectionEnd properties, but unfortunately that can't be used for detection because accessing the properties also throws a TypeError. Just check the type instead. Filed as Apple bug #15122724.
		if (deviceIsIOS && targetElement.setSelectionRange && targetElement.type.indexOf('date') !== 0 && targetElement.type !== 'time' && targetElement.type !== 'month') {
			length = targetElement.value.length;
			targetElement.setSelectionRange(length, length);
		} else {
			targetElement.focus();
		}
	};


	/**
	 * Check whether the given target element is a child of a scrollable layer and if so, set a flag on it.
	 *
	 * @param {EventTarget|Element} targetElement
	 */
	FastClick.prototype.updateScrollParent = function(targetElement) {
		var scrollParent, parentElement;

		scrollParent = targetElement.fastClickScrollParent;

		// Attempt to discover whether the target element is contained within a scrollable layer. Re-check if the
		// target element was moved to another parent.
		if (!scrollParent || !scrollParent.contains(targetElement)) {
			parentElement = targetElement;
			do {
				if (parentElement.scrollHeight > parentElement.offsetHeight) {
					scrollParent = parentElement;
					targetElement.fastClickScrollParent = parentElement;
					break;
				}

				parentElement = parentElement.parentElement;
			} while (parentElement);
		}

		// Always update the scroll top tracker if possible.
		if (scrollParent) {
			scrollParent.fastClickLastScrollTop = scrollParent.scrollTop;
		}
	};


	/**
	 * @param {EventTarget} targetElement
	 * @returns {Element|EventTarget}
	 */
	FastClick.prototype.getTargetElementFromEventTarget = function(eventTarget) {

		// On some older browsers (notably Safari on iOS 4.1 - see issue #56) the event target may be a text node.
		if (eventTarget.nodeType === Node.TEXT_NODE) {
			return eventTarget.parentNode;
		}

		return eventTarget;
	};


	/**
	 * On touch start, record the position and scroll offset.
	 *
	 * @param {Event} event
	 * @returns {boolean}
	 */
	FastClick.prototype.onTouchStart = function(event) {
		var targetElement, touch, selection;

		// Ignore multiple touches, otherwise pinch-to-zoom is prevented if both fingers are on the FastClick element (issue #111).
		if (event.targetTouches.length > 1) {
			return true;
		}

		targetElement = this.getTargetElementFromEventTarget(event.target);
		touch = event.targetTouches[0];

		if (deviceIsIOS) {

			// Only trusted events will deselect text on iOS (issue #49)
			selection = window.getSelection();
			if (selection.rangeCount && !selection.isCollapsed) {
				return true;
			}

			if (!deviceIsIOS4) {

				// Weird things happen on iOS when an alert or confirm dialog is opened from a click event callback (issue #23):
				// when the user next taps anywhere else on the page, new touchstart and touchend events are dispatched
				// with the same identifier as the touch event that previously triggered the click that triggered the alert.
				// Sadly, there is an issue on iOS 4 that causes some normal touch events to have the same identifier as an
				// immediately preceeding touch event (issue #52), so this fix is unavailable on that platform.
				// Issue 120: touch.identifier is 0 when Chrome dev tools 'Emulate touch events' is set with an iOS device UA string,
				// which causes all touch events to be ignored. As this block only applies to iOS, and iOS identifiers are always long,
				// random integers, it's safe to to continue if the identifier is 0 here.
				if (touch.identifier && touch.identifier === this.lastTouchIdentifier) {
					event.preventDefault();
					return false;
				}

				this.lastTouchIdentifier = touch.identifier;

				// If the target element is a child of a scrollable layer (using -webkit-overflow-scrolling: touch) and:
				// 1) the user does a fling scroll on the scrollable layer
				// 2) the user stops the fling scroll with another tap
				// then the event.target of the last 'touchend' event will be the element that was under the user's finger
				// when the fling scroll was started, causing FastClick to send a click event to that layer - unless a check
				// is made to ensure that a parent layer was not scrolled before sending a synthetic click (issue #42).
				this.updateScrollParent(targetElement);
			}
		}

		this.trackingClick = true;
		this.trackingClickStart = event.timeStamp;
		this.targetElement = targetElement;

		this.touchStartX = touch.pageX;
		this.touchStartY = touch.pageY;

		// Prevent phantom clicks on fast double-tap (issue #36)
		if ((event.timeStamp - this.lastClickTime) < this.tapDelay) {
			event.preventDefault();
		}

		return true;
	};


	/**
	 * Based on a touchmove event object, check whether the touch has moved past a boundary since it started.
	 *
	 * @param {Event} event
	 * @returns {boolean}
	 */
	FastClick.prototype.touchHasMoved = function(event) {
		var touch = event.changedTouches[0], boundary = this.touchBoundary;

		if (Math.abs(touch.pageX - this.touchStartX) > boundary || Math.abs(touch.pageY - this.touchStartY) > boundary) {
			return true;
		}

		return false;
	};


	/**
	 * Update the last position.
	 *
	 * @param {Event} event
	 * @returns {boolean}
	 */
	FastClick.prototype.onTouchMove = function(event) {
		if (!this.trackingClick) {
			return true;
		}

		// If the touch has moved, cancel the click tracking
		if (this.targetElement !== this.getTargetElementFromEventTarget(event.target) || this.touchHasMoved(event)) {
			this.trackingClick = false;
			this.targetElement = null;
		}

		return true;
	};


	/**
	 * Attempt to find the labelled control for the given label element.
	 *
	 * @param {EventTarget|HTMLLabelElement} labelElement
	 * @returns {Element|null}
	 */
	FastClick.prototype.findControl = function(labelElement) {

		// Fast path for newer browsers supporting the HTML5 control attribute
		if (labelElement.control !== undefined) {
			return labelElement.control;
		}

		// All browsers under test that support touch events also support the HTML5 htmlFor attribute
		if (labelElement.htmlFor) {
			return document.getElementById(labelElement.htmlFor);
		}

		// If no for attribute exists, attempt to retrieve the first labellable descendant element
		// the list of which is defined here: http://www.w3.org/TR/html5/forms.html#category-label
		return labelElement.querySelector('button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea');
	};


	/**
	 * On touch end, determine whether to send a click event at once.
	 *
	 * @param {Event} event
	 * @returns {boolean}
	 */
	FastClick.prototype.onTouchEnd = function(event) {
		var forElement, trackingClickStart, targetTagName, scrollParent, touch, targetElement = this.targetElement;

		if (!this.trackingClick) {
			return true;
		}

		// Prevent phantom clicks on fast double-tap (issue #36)
		if ((event.timeStamp - this.lastClickTime) < this.tapDelay) {
			this.cancelNextClick = true;
			return true;
		}

		if ((event.timeStamp - this.trackingClickStart) > this.tapTimeout) {
			return true;
		}

		// Reset to prevent wrong click cancel on input (issue #156).
		this.cancelNextClick = false;

		this.lastClickTime = event.timeStamp;

		trackingClickStart = this.trackingClickStart;
		this.trackingClick = false;
		this.trackingClickStart = 0;

		// On some iOS devices, the targetElement supplied with the event is invalid if the layer
		// is performing a transition or scroll, and has to be re-detected manually. Note that
		// for this to function correctly, it must be called *after* the event target is checked!
		// See issue #57; also filed as rdar://13048589 .
		if (deviceIsIOSWithBadTarget) {
			touch = event.changedTouches[0];

			// In certain cases arguments of elementFromPoint can be negative, so prevent setting targetElement to null
			targetElement = document.elementFromPoint(touch.pageX - window.pageXOffset, touch.pageY - window.pageYOffset) || targetElement;
			targetElement.fastClickScrollParent = this.targetElement.fastClickScrollParent;
		}

		targetTagName = targetElement.tagName.toLowerCase();
		if (targetTagName === 'label') {
			forElement = this.findControl(targetElement);
			if (forElement) {
				this.focus(targetElement);
				if (deviceIsAndroid) {
					return false;
				}

				targetElement = forElement;
			}
		} else if (this.needsFocus(targetElement)) {

			// Case 1: If the touch started a while ago (best guess is 100ms based on tests for issue #36) then focus will be triggered anyway. Return early and unset the target element reference so that the subsequent click will be allowed through.
			// Case 2: Without this exception for input elements tapped when the document is contained in an iframe, then any inputted text won't be visible even though the value attribute is updated as the user types (issue #37).
			if ((event.timeStamp - trackingClickStart) > 100 || (deviceIsIOS && window.top !== window && targetTagName === 'input')) {
				this.targetElement = null;
				return false;
			}

			this.focus(targetElement);
			this.sendClick(targetElement, event);

			// Select elements need the event to go through on iOS 4, otherwise the selector menu won't open.
			// Also this breaks opening selects when VoiceOver is active on iOS6, iOS7 (and possibly others)
			if (!deviceIsIOS || targetTagName !== 'select') {
				this.targetElement = null;
				event.preventDefault();
			}

			return false;
		}

		if (deviceIsIOS && !deviceIsIOS4) {

			// Don't send a synthetic click event if the target element is contained within a parent layer that was scrolled
			// and this tap is being used to stop the scrolling (usually initiated by a fling - issue #42).
			scrollParent = targetElement.fastClickScrollParent;
			if (scrollParent && scrollParent.fastClickLastScrollTop !== scrollParent.scrollTop) {
				return true;
			}
		}

		// Prevent the actual click from going though - unless the target node is marked as requiring
		// real clicks or if it is in the whitelist in which case only non-programmatic clicks are permitted.
		if (!this.needsClick(targetElement)) {
			event.preventDefault();
			this.sendClick(targetElement, event);
		}

		return false;
	};


	/**
	 * On touch cancel, stop tracking the click.
	 *
	 * @returns {void}
	 */
	FastClick.prototype.onTouchCancel = function() {
		this.trackingClick = false;
		this.targetElement = null;
	};


	/**
	 * Determine mouse events which should be permitted.
	 *
	 * @param {Event} event
	 * @returns {boolean}
	 */
	FastClick.prototype.onMouse = function(event) {

		// If a target element was never set (because a touch event was never fired) allow the event
		if (!this.targetElement) {
			return true;
		}

		if (event.forwardedTouchEvent) {
			return true;
		}

		// Programmatically generated events targeting a specific element should be permitted
		if (!event.cancelable) {
			return true;
		}

		// Derive and check the target element to see whether the mouse event needs to be permitted;
		// unless explicitly enabled, prevent non-touch click events from triggering actions,
		// to prevent ghost/doubleclicks.
		if (!this.needsClick(this.targetElement) || this.cancelNextClick) {

			// Prevent any user-added listeners declared on FastClick element from being fired.
			if (event.stopImmediatePropagation) {
				event.stopImmediatePropagation();
			} else {

				// Part of the hack for browsers that don't support Event#stopImmediatePropagation (e.g. Android 2)
				event.propagationStopped = true;
			}

			// Cancel the event
			event.stopPropagation();
			event.preventDefault();

			return false;
		}

		// If the mouse event is permitted, return true for the action to go through.
		return true;
	};


	/**
	 * On actual clicks, determine whether this is a touch-generated click, a click action occurring
	 * naturally after a delay after a touch (which needs to be cancelled to avoid duplication), or
	 * an actual click which should be permitted.
	 *
	 * @param {Event} event
	 * @returns {boolean}
	 */
	FastClick.prototype.onClick = function(event) {
		var permitted;

		// It's possible for another FastClick-like library delivered with third-party code to fire a click event before FastClick does (issue #44). In that case, set the click-tracking flag back to false and return early. This will cause onTouchEnd to return early.
		if (this.trackingClick) {
			this.targetElement = null;
			this.trackingClick = false;
			return true;
		}

		// Very odd behaviour on iOS (issue #18): if a submit element is present inside a form and the user hits enter in the iOS simulator or clicks the Go button on the pop-up OS keyboard the a kind of 'fake' click event will be triggered with the submit-type input element as the target.
		if (event.target.type === 'submit' && event.detail === 0) {
			return true;
		}

		permitted = this.onMouse(event);

		// Only unset targetElement if the click is not permitted. This will ensure that the check for !targetElement in onMouse fails and the browser's click doesn't go through.
		if (!permitted) {
			this.targetElement = null;
		}

		// If clicks are permitted, return true for the action to go through.
		return permitted;
	};


	/**
	 * Remove all FastClick's event listeners.
	 *
	 * @returns {void}
	 */
	FastClick.prototype.destroy = function() {
		var layer = this.layer;

		if (deviceIsAndroid) {
			layer.removeEventListener('mouseover', this.onMouse, true);
			layer.removeEventListener('mousedown', this.onMouse, true);
			layer.removeEventListener('mouseup', this.onMouse, true);
		}

		layer.removeEventListener('click', this.onClick, true);
		layer.removeEventListener('touchstart', this.onTouchStart, false);
		layer.removeEventListener('touchmove', this.onTouchMove, false);
		layer.removeEventListener('touchend', this.onTouchEnd, false);
		layer.removeEventListener('touchcancel', this.onTouchCancel, false);
	};


	/**
	 * Check whether FastClick is needed.
	 *
	 * @param {Element} layer The layer to listen on
	 */
	FastClick.notNeeded = function(layer) {
		var metaViewport;
		var chromeVersion;
		var blackberryVersion;
		var firefoxVersion;

		// Devices that don't support touch don't need FastClick
		if (typeof window.ontouchstart === 'undefined') {
			return true;
		}

		// Chrome version - zero for other browsers
		chromeVersion = +(/Chrome\/([0-9]+)/.exec(navigator.userAgent) || [,0])[1];

		if (chromeVersion) {

			if (deviceIsAndroid) {
				metaViewport = document.querySelector('meta[name=viewport]');

				if (metaViewport) {
					// Chrome on Android with user-scalable="no" doesn't need FastClick (issue #89)
					if (metaViewport.content.indexOf('user-scalable=no') !== -1) {
						return true;
					}
					// Chrome 32 and above with width=device-width or less don't need FastClick
					if (chromeVersion > 31 && document.documentElement.scrollWidth <= window.outerWidth) {
						return true;
					}
				}

			// Chrome desktop doesn't need FastClick (issue #15)
			} else {
				return true;
			}
		}

		if (deviceIsBlackBerry10) {
			blackberryVersion = navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/);

			// BlackBerry 10.3+ does not require Fastclick library.
			// https://github.com/ftlabs/fastclick/issues/251
			if (blackberryVersion[1] >= 10 && blackberryVersion[2] >= 3) {
				metaViewport = document.querySelector('meta[name=viewport]');

				if (metaViewport) {
					// user-scalable=no eliminates click delay.
					if (metaViewport.content.indexOf('user-scalable=no') !== -1) {
						return true;
					}
					// width=device-width (or less than device-width) eliminates click delay.
					if (document.documentElement.scrollWidth <= window.outerWidth) {
						return true;
					}
				}
			}
		}

		// IE10 with -ms-touch-action: none or manipulation, which disables double-tap-to-zoom (issue #97)
		if (layer.style.msTouchAction === 'none' || layer.style.touchAction === 'manipulation') {
			return true;
		}

		// Firefox version - zero for other browsers
		firefoxVersion = +(/Firefox\/([0-9]+)/.exec(navigator.userAgent) || [,0])[1];

		if (firefoxVersion >= 27) {
			// Firefox 27+ does not have tap delay if the content is not zoomable - https://bugzilla.mozilla.org/show_bug.cgi?id=922896

			metaViewport = document.querySelector('meta[name=viewport]');
			if (metaViewport && (metaViewport.content.indexOf('user-scalable=no') !== -1 || document.documentElement.scrollWidth <= window.outerWidth)) {
				return true;
			}
		}

		// IE11: prefixed -ms-touch-action is no longer supported and it's recomended to use non-prefixed version
		// http://msdn.microsoft.com/en-us/library/windows/apps/Hh767313.aspx
		if (layer.style.touchAction === 'none' || layer.style.touchAction === 'manipulation') {
			return true;
		}

		return false;
	};


	/**
	 * Factory method for creating a FastClick object
	 *
	 * @param {Element} layer The layer to listen on
	 * @param {Object} [options={}] The options to override the defaults
	 */
	FastClick.attach = function(layer, options) {
		return new FastClick(layer, options);
	};


	if (typeof define === 'function' && typeof define.amd === 'object' && define.amd) {

		// AMD. Register as an anonymous module.
		define(function() {
			return FastClick;
		});
	} else if (typeof module !== 'undefined' && module.exports) {
		module.exports = FastClick.attach;
		module.exports.FastClick = FastClick;
	} else {
		window.FastClick = FastClick;
	}
}());

/**
 * Created by Administrator on 9/29/2015.
 */

//# sourceMappingURL=dashboard.js.map
