/**
 * JCEMediaBox 1.0.8
 *
 * @version 		$Id: jcemediabox.js 569 2010-04-19 03:58:02Z happynoodleboy $
 * @package 		JCEMediaBox
 * @copyright 	Copyright (C) 2006-2009 Ryan Demmer. All rights reserved.
 * @copyright	Copyright 2009, Moxiecode Systems AB
 * @license 		http://www.gnu.org/copyleft/lgpl.html GNU/LGPL
 *
 */
(function() {
    window.JCEMediaBox = {
        /**
         * Global Options Object
         */
        options: {
            popup: {
                width: '',
                height: '',
                legacy: 0,
                overlay: 1,
                overlayopacity: 0.8,
                overlaycolor: '#000000',
                resize: 0,
                icons: 1,
                fadespeed: 500,
                scalespeed: 500,
                hideobjects: 1,
                scrolling: 'fixed',
                //protect				: 1,
                labels: {
                    'close': 'Close',
                    'next': 'Next',
                    'previous': 'Previous',
                    'numbers': '{$current} of {$total}',
                    'cancel': 'Cancel'
                }
            },
            tooltip: {
                speed: 150,
                offsets: {
                    x: 16,
                    y: 16
                },
                position: 'br',
                opacity: 0.8,
                background: '#000000',
                color: '#ffffff'
            },
            base: '/',
            pngfix: false,
            pngfixclass: '',
            theme: 'standard',
            themecustom: '',
            themepath: 'plugins/system/jcemediabox/themes',
            imgpath: 'plugins/system/jcemediabox/img'
        },
        init: function(options) {
            this.extend(this.options, options);
            // Clear IE6 background cache
            if (this.isIE6) 
                try {
                    document.execCommand("BackgroundImageCache", false, true);
                } catch (e) {
                };
            this.ready();
        },
        /**
         * Function to determine if DOM is ready.
         * Based on JQuery 'bindReady' function - http://jquery.com/
         * Copyright (c) 2009 John Resig
         */
        ready: function() {
            // Mozilla, Opera and webkit nightlies currently support this event
            if (document.addEventListener) {
                // Use the handy event callback
                document.addEventListener("DOMContentLoaded", function() {
                    document.removeEventListener("DOMContentLoaded", arguments.callee, false);
                    return JCEMediaBox._init();
                }, false);
                
                // If IE event model is used
            } else if (document.attachEvent) {
                // ensure firing before onload,
                // maybe late but safe also for iframes
                document.attachEvent("onreadystatechange", function() {
                    if (document.readyState === "complete") {
                        document.detachEvent("onreadystatechange", arguments.callee);
                        return JCEMediaBox._init();
                    }
                });
                
                // If IE and not an iframe
                // continually check to see if the document is ready
                if (document.documentElement.doScroll && window == window.top) {
					(function() {
						if (JCEMediaBox.domLoaded) 
							return;
						
						try {
							// If IE is used, use the trick by Diego Perini
							// http://javascript.nwbox.com/IEContentLoaded/
							document.documentElement.doScroll("left");
						} catch (error) {
							setTimeout(arguments.callee, 0);
							return;
						}
						
						// and execute any waiting functions
						return JCEMediaBox._init();
					})();
				}
            }
            
            // A fallback to window.onload, that will always work
            JCEMediaBox.Event.add(window, "load", function() {
                return JCEMediaBox._init();
            });
        },
        
        /**
         * Get the Site Base URL
         * @method getSite
         * @return {String} Site Base URL
         */
        getSite: function() {
            var base = this.options.base;
            
            if (base) {
                // Get document location
                var site = document.location.href;
                // Split into port (http) and location
                var parts = site.split(':\/\/');
                
                var port = parts[0];
                var url = parts[1];
                
                // Get url part before base
                if (url.indexOf(base) != -1) {
                    url = url.substr(0, url.indexOf(base));
                    // Get url part before first slash
                } else {
                    url = url.substr(0, url.indexOf('/')) || url;
                }
                // Return full url
                return port + '://' + url + base;
            }
            // Can't get site URL!
            return null;
        },
        
        /**
         * Private internal function
         * Initialize JCEMediaBox
         */
        _init: function() {
            if (this.domLoaded) 
                return;
            
            this.domLoaded = true;
            
            var t = this, d = document, na = navigator, ua = na.userAgent;
            /**
             * Constant that is true if the browser is Opera.
             *
             * @property isOpera
             * @type Boolean
             * @final
             */
            t.isOpera = window.opera && opera.buildNumber;
            
            /**
             * Constant that is true if the browser is WebKit (Safari/Chrome).
             *
             * @property isWebKit
             * @type Boolean
             * @final
             */
            t.isWebKit = /WebKit/.test(ua);
            
            /**
             * Constant that is true if the browser is IE.
             *
             * @property isIE
             * @type Boolean
             * @final
             */
            t.isIE = !t.isWebKit && !t.isOpera && (/MSIE/gi).test(ua) && (/Explorer/gi).test(na.appName);
            
            /**
             * Constant that is true if the browser is IE 6 or older.
             *
             * @property isIE6
             * @type Boolean
             * @final
             */
            t.isIE6 = t.isIE && /MSIE [56]/.test(ua);
            
            /**
             * Constant that is true if the browser is IE 7.
             *
             * @property isIE7
             * @type Boolean
             * @final
             */
            t.isIE7 = t.isIE && /MSIE [7]/.test(ua);
            
            /**
             * Get the Site URL
             * @property site
             * @type String
             */
            this.site = this.getSite();
            // Can't get reliable site URL
            if (!this.site) 
                return false;
            
            // Initialize Popup / Tooltip creation	
            this.Popup.init();
            this.ToolTip.init();
        },
        /**
         * Performs an iteration of all items in a collection such as an object or array. This method will execure the
         * callback function for each item in the collection, if the callback returns false the iteration will terminate.
         * The callback has the following format: cb(value, key_or_index).
         *
         * @method each
         * @param {Object} o Collection to iterate.
         * @param {function} cb Callback function to execute for each item.
         * @param {Object} s Optional scope to execute the callback in.
         * @copyright	Copyright 2009, Moxiecode Systems AB
         */
        each: function(o, cb, s) {
            var n, l;
            
            if (!o) 
                return 0;
            
            s = s || o;
            
            if (o.length !== undefined) {
                // Indexed arrays, needed for Safari
                for (n = 0, l = o.length; n < l; n++) {
                    if (cb.call(s, o[n], n, o) === false) 
                        return 0;
                }
            } else {
                // Hashtables
                for (n in o) {
                    if (o.hasOwnProperty(n)) {
                        if (cb.call(s, o[n], n, o) === false) 
                            return 0;
                    }
                }
            }
            
            return 1;
        },
        /**
         * Extends an object with the specified other object(s).
         *
         * @method extend
         * @param {Object} o Object to extend with new items.
         * @param {Object} e..n Object(s) to extend the specified object with.
         * @return {Object} o New extended object, same reference as the input object.
         * @copyright	Copyright 2009, Moxiecode Systems AB
         */
        extend: function(o, e) {
            var t = JCEMediaBox, i, l, a = arguments;
            
            for (i = 1, l = a.length; i < l; i++) {
                e = a[i];
                
                t.each(e, function(v, n) {
                    if (v !== undefined) 
                        o[n] = v;
                });
            }
            
            return o;
        },
        
        /**
         * Removes whitespace from the beginning and end of a string.
         *
         * @method trim
         * @param {String} s String to remove whitespace from.
         * @return {String} New string with removed whitespace.
         * @copyright	Copyright 2009, Moxiecode Systems AB
         */
        trim: function(s) {
            return (s ? '' + s : '').replace(/^\s*|\s*$/g, '');
        },
        
        /**
         * DOM functions
         */
        DOM: {
            /**
             * Get an Element by ID
             * @param {Object} s ID
             */
            get: function(s) {
                if (typeof(s) == 'string') 
                    return document.getElementById(s);
                
                return s;
            },
            
            /**
             * Return elements matching a simple selector, eg: a, a[id], a.classname
             * @param {Object} p Selector
             * @param {Object} o Parent Element
             */
            select: function(p, o) {
                var t = this, r = [], s, parts, at, tag, each = JCEMediaBox.each;
                o = o || document;
                // Return all elements
                if (p == '*') {
                    return o.getElementsByTagName(p);
                }
                // Use native support if available
                if (o.querySelectorAll) {
                    return o.querySelectorAll(p);
                }
                
                /**
                 * Internal inArray function
                 * @param {Object} a Array to check
                 * @param {Object} s Key to check for
                 */
                function inArray(a, v) {
                    var i, l;
                    
                    if (a) {
                        for (i = 0, l = a.length; i < l; i++) {
                            if (a[i] === v) 
                                return true;
                        }
                    }
                    
                    return false;
                }
                
                // Split selector
                s = p.split(',');
                each(s, function(selectors) {
                    parts = JCEMediaBox.trim(selectors).split('.');
                    // Element
                    tag = parts[0] || '*';
                    // Class
                    cl = parts[1] || '';
                    // Handle attributes
                    if (/\[(.*?)\]/.test(tag)) {
                        tag = tag.replace(/(.*?)\[(.*?)\]/, function(a, b, c) {
                            at = c;
                            return b;
                        });
                    }
                    // Get all elements for the given parent and tag
                    var elements = o.getElementsByTagName(tag);
                    
                    // If class or attribute
                    if (cl || at) {
                        each(elements, function(el) {
                            // If class
                            if (cl) {
                                if (t.hasClass(el, cl)) {
                                    if (!inArray(r, el)) {
                                        r.push(el);
                                    }
                                }
                            }
                            // If attribute
                            if (at) {
                                if (el.getAttribute(at)) {
                                    if (!inArray(r, el)) {
                                        r.push(el);
                                    }
                                }
                            }
                        });
                    } else {
                        r = elements;
                    }
                });
                return r;
            },
            
            /**
             * Check if an element has a specific class
             * @param {Object} el Element
             * @param {Object} c Class
             */
            hasClass: function(el, c) {
                return new RegExp(c).test(el.className);
            },
            
            /**
             * Add a class to an element
             * @param {Object} el Element
             * @param {Object} c Class
             */
            addClass: function(el, c) {
                if (!this.hasClass(el, c)) {
                    el.className = JCEMediaBox.trim(el.className + ' ' + c);
                }
            },
            
            /**
             * Remove a class from an element
             * @param {Object} el Element
             * @param {Object} c Class to remove
             */
            removeClass: function(el, c) {
                if (this.hasClass(el, c)) {
                    var s = el.className;
                    var re = new RegExp("(^|\\s+)" + c + "(\\s+|$)", "g");
                    var v = s.replace(re, ' ');
                    v = v.replace(/^\s|\s$/g, '');
                    el.className = v;
                }
            },
            
            /**
             * Show an element
             * @param {Object} el Element to show
             */
            show: function(el) {
                el.style.display = 'block';
            },
            
            /**
             * Hide and element
             * @param {Object} el Element to hide
             */
            hide: function(el) {
                el.style.display = 'none';
            },
            
            /**
             * Remove an element
             * @param {Object} el Element to remove
             */
            remove: function(el) {
                var p = el.parentNode || document.body;
                p.removeChild(el);
            },
            
            /**
             * Set or retrieve a style
             * @param {Object} el Target Element
             * @param {Object} s Style to set / get
             * @param {Object} v Value to set
             */
            style: function(n, na, v) {
                var isIE = JCEMediaBox.isIE, r, s;
                
                // Camelcase it, if needed
                na = na.replace(/-(\D)/g, function(a, b) {
                    return b.toUpperCase();
                });
                
                s = n.style;
                
                // Get value
                if (typeof v == 'undefined') {
                
                    if (na == 'float') 
                        na = isIE ? 'styleFloat' : 'cssFloat';
                    
                    r = s[na];
                    
                    if (document.defaultView && !r) {
                        if (/float/i.test(na)) 
                            na = 'float';
                        
                        // Remove camelcase
                        na = na.replace(/[A-Z]/g, function(a) {
                            return '-' + a;
                        }).toLowerCase();
                        
                        try {
                            r = document.defaultView.getComputedStyle(n, null).getPropertyValue(na);
                        } catch (e) {
                        }
                    }
                    
                    if (n.currentStyle && !r) 
                        r = n.currentStyle[na];
                    
                    return r;
                    
                } else {
                
                    switch (na) {
                        case 'opacity':
                            v = parseFloat(v);
                            // IE specific opacity
                            if (isIE) {
                                s.filter = v === '' ? '' : "alpha(opacity=" + (v * 100) + ")";
                                
                                if (!n.currentStyle || !n.currentStyle.hasLayout) 
                                    s.display = 'inline-block';
                            }
                            s[na] = v;
                            break;
                        case 'float':
                            na = isIE ? 'styleFloat' : 'cssFloat';
                            break;
                        default:
                            if (v && /(margin|padding|width|height|top|bottom|left|right)/.test(na)) {
                                // Add pixel value if number
                                v = /^[\-0-9\.]+$/.test(v) ? v + 'px' : v;
                            }
                            break;
                    }
                    s[na] = v;
                }
            },
            
            /**
             * Set styles
             * @param {Object} el Target Element
             * @param {Object} props Object of style key/values
             */
            styles: function(el, props) {
                var t = this;
                JCEMediaBox.each(props, function(v, s) {
                    return t.style(el, s, v);
                });
            },
            
            /**
             * Set an Element attribute
             * @param {Object} el
             * @param {Object} s
             * @param {Object} v
             */
            attribute: function(el, s, v) {
                if (typeof v == 'undefined') {
                    if (s == 'class') {
                        return el.className;
                    }
                    v = el.getAttribute(s);
                    // Remove anonymous function from events
                    if (/^on/.test(s)) {
                        v = v.replace(/^function\s+anonymous\(\)\s+\{\s+(.*)\s+\}$/, '$1');
                    }
                    // Fix Hspace
                    if (s == 'hspace' && v == -1) {
                        v = '';
                    }
                    return v;
                }
                // Remove attribute if no value
                if (v === '') {
                    el.removeAttribute(s);
                }
                
                switch (s) {
                    case 'style':
                        if (typeof v == 'object') {
                            this.styles(el, v);
                        } else {
                            el.style.cssText = v;
                        }
                        break;
                    case 'class':
                        el.className = v || '';
                        break;
                    default:
                        el.setAttribute(s, v);
                        break;
                }
            },
            
            /**
             * Set Attributes on an Element
             * @param {Object} el Target Element
             * @param {Object} attribs Attributes Object
             */
            attributes: function(el, attribs) {
                var t = this;
                JCEMediaBox.each(attribs, function(v, s) {
                    t.attribute(el, s, v);
                });
            },
            
            /**
             * Create an Element
             * @param {Object} el Element to create
             * @param {Object} attribs Attributes
             * @param {Object} styles Styles
             * @param {Object} html HTML
             */
            create: function(el, attribs, html) {
                var o = document.createElement(el);
                this.attributes(o, attribs);
                if (typeof html != 'undefined') {
                    o.innerHTML = html;
                }
                
                return o;
            },
            
            /**
             * Add an element to another
             * @param {Object} n Element to add to
             * @param {Object} o Element to add. Will be created if string
             * @param {Object} a Optional attributes
             * @param {Object} h Optional HTML
             */
            add: function(n, o, a, h) {
                if (typeof o == 'string') {
                    a = a ||
                    {};
                    o = this.create(o, a, h);
                }
                n.appendChild(o);
                
                return o;
            },
            
            /**
             * Add an element before the passed in element
             * @param {Object} n Element to insert into
             * @param {Object} o Element to insert
             * @param {Object} c Element to insert before
             */
            addBefore: function(n, o, c) {
                if (typeof c == 'undefined') {
                    c = n.firstChild;
                }
                n.insertBefore(o, c);
            },
            
            /**
             * IE6 PNG Fix
             * @param {Object} el Element to fix
             */
            png: function(el) {
                var s;
                // Image Elements
                if (el.nodeName == 'IMG') {
                    s = el.src;
                    if (/\.png$/i.test(s)) {
                        this.attribute(el, 'src', JCEMediaBox.site + 'plugins/system/jcemediabox/img/blank.gif');
                        this.style(el, 'filter', "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + s + "')");
                    }
                    // Background-image styles
                } else {
                    s = this.style(el, 'background-image');
                    if (/\.png/i.test(s)) {
                        var bg = /url\("(.*)"\)/.exec(s)[1];
                        this.styles(el, {
                            'background-image': 'none',
                            'filter': "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + bg + "', sizingMethod='image')"
                        });
                    }
                }
            }
        },
        /**
         * Event Functions
         */
        Event: {
            events: [],
            /**
             * Add an Event handler
             * @param {Object} o Target Element
             * @param {Object} n Event name
             * @param {Object} f Callback function
             * @param {Object} s Scope
             * @copyright	Copyright 2009, Moxiecode Systems AB
             */
            add: function(o, n, f, s) {
                var t = this;
                
                // Setup event callback
                cb = function(e) {
                    // Is all events disabled
                    if (t.disabled) 
                        return;
                    
                    e = e || window.event;
                    
                    // Patch in target, preventDefault and stopPropagation in IE it's W3C valid
                    if (e && JCEMediaBox.isIE) {
                        if (!e.target) {
                            e.target = e.srcElement || document;
                        }
                        
                        if (!e.relatedTarget && e.fromElement) {
                            e.relatedTarget = e.fromElement == e.target ? e.toElement : e.fromElement;
                        }
                        
                        // Patch in preventDefault, stopPropagation methods for W3C compatibility
                        JCEMediaBox.extend(e, {
                            preventDefault: function() {
                                this.returnValue = false;
                            },
                            
                            stopPropagation: function() {
                                this.cancelBubble = true;
                            }
                        });
                    }
                    if (e && JCEMediaBox.isWebKit) {
                        if (e.target.nodeType == 3) {
                            e.target = e.target.parentNode;
                        }
                    }
                    
                    if (!s) 
                        return f(e);
                    
                    return f.call(s, e);
                };
                // Internal function to add an event to an object
                function _add(o, n, f) {
                    if (o.attachEvent) {
                        o.attachEvent('on' + n, f);
                    } else 
                        if (o.addEventListener) {
                            o.addEventListener(n, f, false);
                        } else {
                            o['on' + n] = f;
                        }
                }
                
                t.events.push({
                    obj: o,
                    name: n,
                    func: f,
                    cfunc: cb,
                    scope: s
                });
                
                // Add event
                _add(o, n, cb);
            },
            /**
             * Removes the specified event handler by name and function from a element or collection of elements.
             *
             * @method remove
             * @param {String/Element/Array} o Element ID string or HTML element or an array of elements or ids to remove handler from.
             * @param {String} n Event handler name like for example: "click"
             * @param {function} f Function to remove.
             * @return {bool/Array} Bool state if true if the handler was removed or an array with states if multiple elements where passed in.
             * @copyright	Copyright 2009, Moxiecode Systems AB
             */
            remove: function(o, n, f) {
                var t = this, a = t.events, s = false, r;
                
                JCEMediaBox.each(a, function(e, i) {
                    if (e.obj == o && e.name == n && (!f || (e.func == f || e.cfunc == f))) {
                        a.splice(i, 1);
                        t._remove(o, n, e.cfunc);
                        s = true;
                        return false;
                    }
                });
                
                return s;
            },
            /**
             * Internal function to remove an Event
             * @param {Object} o
             * @param {Object} n
             * @param {Object} f
             * @copyright	Copyright 2009, Moxiecode Systems AB
             */
            _remove: function(o, n, f) {
                if (o) {
                    try {
                        if (o.detachEvent) 
                            o.detachEvent('on' + n, f);
                        else 
                            if (o.removeEventListener) 
                                o.removeEventListener(n, f, false);
                            else 
                                o['on' + n] = null;
                    } catch (ex) {
                        // Might fail with permission denined on IE so we just ignore that
                    }
                }
            },
            /**
             * Cancels an event for both bubbeling and the default browser behavior.
             *
             * @method cancel
             * @param {Event} e Event object to cancel.
             * @return {Boolean} Always false.
             * @copyright Copyright 2009, Moxiecode Systems AB
             */
            cancel: function(e) {
                if (!e) 
                    return false;
                
                this.stop(e);
                
                return this.prevent(e);
            },
            
            /**
             * Stops propogation/bubbeling of an event.
             *
             * @method stop
             * @param {Event} e Event to cancel bubbeling on.
             * @return {Boolean} Always false.
             * @copyright	Copyright 2009, Moxiecode Systems AB
             */
            stop: function(e) {
                if (e.stopPropagation) 
                    e.stopPropagation();
                else 
                    e.cancelBubble = true;
                
                return false;
            },
            
            /**
             * Prevent default browser behvaior of an event.
             *
             * @method prevent
             * @param {Event} e Event to prevent default browser behvaior of an event.
             * @return {Boolean} Always false.
             * @copyright	Copyright 2009, Moxiecode Systems AB
             */
            prevent: function(e) {
                if (e.preventDefault) 
                    e.preventDefault();
                else 
                    e.returnValue = false;
                
                return false;
            },
            
            /**
             * Destroys the instance.
             *
             * @method destroy
             * @copyright	Copyright 2009, Moxiecode Systems AB
             */
            destroy: function() {
                var t = this;
                
                JCEMediaBox.each(t.events, function(e, i) {
                    t._remove(e.obj, e.name, e.cfunc);
                    e.obj = e.cfunc = null;
                });
                
                t.events = [];
                t = null;
            },
            
            /**
             * Adds an unload handler to the document. This handler will be executed when the document gets unloaded.
             * This method is useful for dealing with browser memory leaks where it might be vital to remove DOM references etc.
             *
             * @method addUnload
             * @param {function} f Function to execute before the document gets unloaded.
             * @param {Object} s Optional scope to execute the function in.
             * @return {function} Returns the specified unload handler function.
             * @copyright	Copyright 2009, Moxiecode Systems AB
             */
            addUnload: function(f, s) {
                var t = this;
                
                f = {
                    func: f,
                    scope: s || this
                };
                
                if (!t.unloads) {
                    function unload() {
                        var li = t.unloads, o, n;
                        
                        if (li) {
                            // Call unload handlers
                            for (n in li) {
                                o = li[n];
                                
                                if (o && o.func) 
                                    o.func.call(o.scope, 1); // Send in one arg to distinct unload and user destroy
                            }
                            
                            // Detach unload function
                            if (window.detachEvent) {
                                window.detachEvent('onbeforeunload', fakeUnload);
                                window.detachEvent('onunload', unload);
                            } else 
                                if (window.removeEventListener) 
                                    window.removeEventListener('unload', unload, false);
                            
                            // Destroy references
                            t.unloads = o = li = w = unload = 0;
                            
                            // Run garbarge collector on IE
                            if (window.CollectGarbage) 
                                CollectGarbage();
                        }
                    };
                    
                    function fakeUnload() {
                        var d = document;
                        
                        // Is there things still loading, then do some magic
                        if (d.readyState == 'interactive') {
                            function stop() {
                                // Prevent memory leak
                                d.detachEvent('onstop', stop);
                                
                                // Call unload handler
                                if (unload) 
                                    unload();
                                
                                d = 0;
                            };
                            
                            // Fire unload when the currently loading page is stopped
                            if (d) 
                                d.attachEvent('onstop', stop);
                            
                            // Remove onstop listener after a while to prevent the unload function
                            // to execute if the user presses cancel in an onbeforeunload
                            // confirm dialog and then presses the browser stop button
                            window.setTimeout(function() {
                                if (d) 
                                    d.detachEvent('onstop', stop);
                            }, 0);
                        }
                    };
                    
                    // Attach unload handler
                    if (window.attachEvent) {
                        window.attachEvent('onunload', unload);
                        window.attachEvent('onbeforeunload', fakeUnload);
                    } else 
                        if (window.addEventListener) 
                            window.addEventListener('unload', unload, false);
                    
                    // Setup initial unload handler array
                    t.unloads = [f];
                } else 
                    t.unloads.push(f);
                
                return f;
            },
            
            /**
             * Removes the specified function form the unload handler list.
             *
             * @method removeUnload
             * @param {function} f Function to remove from unload handler list.
             * @return {function} Removed function name or null if it wasn't found.
             */
            removeUnload: function(f) {
                var u = this.unloads, r = null;
                
                JCEMediaBox.each(u, function(o, i) {
                    if (o && o.func == f) {
                        u.splice(i, 1);
                        r = f;
                        return false;
                    }
                });
                
                return r;
            }
        },
        Dimensions: {
            /**
             * Get client window width
             */
            getWidth: function() {
                return document.documentElement.clientWidth || document.body.clientWidth || this.innerWidth || 0;
            },
            /**
             * Get client window height
             */
            getHeight: function() {
                return document.documentElement.clientHeight || document.body.clientHeight || this.innerHeight || 0;
            },
            /**
             * Get client window scroll height
             */
            getScrollHeight: function() {
                return document.documentElement.scrollHeight || document.body.scrollHeight || 0;
            },
            /**
             * Get client window scroll width
             */
            getScrollWidth: function() {
                return document.documentElement.scrollWidth || document.body.scrollWidth || 0;
            },
            /**
             * Get client window scroll top
             */
            getScrollTop: function() {
                return document.documentElement.scrollTop || this.pageYOffset || document.body.scrollTop || 0;
            },
            /**
             * Get the page scrollbar width
             */
            getScrollbarWidth: function() {
                var each = JCEMediaBox.each, DOM = JCEMediaBox.DOM;
                
                if (this.scrollbarWidth) {
                    return this.scrollbarWidth;
                }
                
                var outer = DOM.add(document.body, 'div', {
                    'style': {
                        position: 'absolute',
                        visibility: 'hidden',
                        width: 200,
                        height: 200,
                        border: 0,
                        margin: 0,
                        padding: 0,
                        overflow: 'hidden'
                    }
                });
                
                var inner = DOM.add(outer, 'div', {
                    'style': {
                        width: '100%',
                        height: 200,
                        border: 0,
                        margin: 0,
                        padding: 0
                    }
                });
                
                var w1 = parseInt(inner.offsetWidth);
                outer.style.overflow = 'scroll';
                var w2 = parseInt(inner.offsetWidth);
                if (w1 == w2) {
                    w2 = parseInt(outer.clientWidth);
                }
                document.body.removeChild(outer);
                this.scrollbarWidth = (w1 - w2);
                
                return this.scrollbarWidth;
            },
            /**
             * Get the outerwidth of an element
             * @param {Object} n Element
             */
            outerWidth: function(n) {
                var v = 0, x = 0;
                
                x = n.offsetWidth;
                
                if (!x) {
                    JCEMediaBox.each(['padding-left', 'padding-right', 'border-left', 'border-right', 'width'], function(s) {
                        v = parseFloat(JCEMediaBox.DOM.style(n, s));
                        v = /[0-9]/.test(v) ? v : 0;
                        x = x + v;
                    });
                }
                return x;
            },
            /**
             * Get the outerheight of an Element
             * @param {Object} n Element
             */
            outerHeight: function(n) {
                var v = 0, x = 0;
                
                x = n.offsetHeight;
                
                if (!x) {
                    JCEMediaBox.each(['padding-top', 'padding-bottom', 'border-top', 'border-bottom', 'height'], function(s) {
                        v = parseFloat(JCEMediaBox.DOM.style(n, s));
                        v = /[0-9]/.test(v) ? v : 0;
                        x = x + v;
                    });
                }
                return x;
            }
        },
        
        /**
         * FX Functions
         * @param {Object} t
         * @param {Object} b
         * @param {Object} c
         * @param {Object} d
         */
        FX: {
            animate: function(el, props, speed, cb) {
                var DOM = JCEMediaBox.DOM;
                var options = {
                    speed: speed || 100,
                    callback: cb ||
                    function() {
                    }
                };
                
                var styles = {};
                
                JCEMediaBox.each(props, function(v, s) {
                    // Find start value
                    sv = parseFloat(DOM.style(el, s));
                    styles[s] = [sv, v];
                });
                new JCEMediaBox.fx(el, options).custom(styles);
                return true;
            }
        }
    };
    
    /**
     * XHR Functions
     * Based on XHR.js
     * copyright (c) 2007 Valerio Proietti, <http://mad4milk.net>
     */
    JCEMediaBox.XHR = function(options, scope) {
        this.options = {
            method: 'GET',
            async: true,
            headers: {},
            data: null,
            encoding: 'utf-8',
            success: function() {},
            error: function() {}
        };
        // Set options
        JCEMediaBox.extend(this.options, options);
        // optional scope for callback functions
        this.scope = scope || this;
    };
    JCEMediaBox.XHR.prototype = {
        /**
         * Set transport method
         */
        setTransport: function() {
            this.transport = (window.XMLHttpRequest) ? new XMLHttpRequest() : (JCEMediaBox.isIE ? new ActiveXObject('Microsoft.XMLHTTP') : false);
        },
        /**
         * Process return
         */
        onStateChange: function() {
            if (this.transport.readyState != 4 || !this.running) {
                return;
            }
            
            this.running = false;
            var status = 0;
            
            if ((this.transport.status >= 200) && (this.transport.status < 300)) {
                var s = this.transport.responseText;
                var x = this.transport.responseXML;
                
                this.options.success.call(this.scope, s, x);
            } else {
                this.options.error.call(this.scope, this.transport, this.options);
            }
            // Clean up
            this.transport.onreadystatechange = function() {};
            this.transport = null;
        },
        /**
         * Send request
         * @param {Object} url URL
         * @param {Object} options Request options
         * @param {Object} s Scope
         */
        send: function(url) {
            var t = this, extend = JCEMediaBox.extend;
            if (this.running) {
                return this;
            }
            this.running = true;
            // Set request transport method
            this.setTransport();
            // store request method as uppercase (GET|POST)
            var method = this.options.method.toUpperCase();
            // Set URL Encoded / POST header options
            if (this.options.urlEncoded && method == 'POST') {
                var encoding = (this.options.encoding) ? '; charset=' + this.options.encoding : '';
                extend(this.options.headers, {
                    'Content-type': 'application/x-www-form-urlencoded' + encoding
                });
            }
            // Open transport
            this.transport.open(method, url, this.options.async);
            // Set readystatechange function
            this.transport.onreadystatechange = function() {
                return t.onStateChange();
            };
            
            if ((this.options.method == 'post') && this.transport.overrideMimeType) {
                extend(this.options.headers, {
                    'Connection': 'close'
                });
            }
            // set headers
            for (var type in this.options.headers) {
                try {
                    this.transport.setRequestHeader(type, this.options.headers[type]);
                } catch (e) {};
            }
            // send request
            this.transport.send(this.options.data);
        }
    },    /**
     * Core Fx Functions
     * @param {Object} el Element to animate
     * @param {Object} props A set of styles to animate
     * @param {String} speed Speed of animation in milliseconds
     * @param {Object} cb Optional Callback when the animation finishes
     */
    JCEMediaBox.fx = function(el, options) {
        this.element = el;
        this.callback = options.callback;
        this.speed = options.speed;
        this.wait = true;
        this.fps = 50;
        this.now = {};
    };
    /**
     * Based on Moo.Fx.Base and Moo.Fx.Styles
     * @copyright (c) 2006 Valerio Proietti (http://mad4milk.net). MIT-style license.
     */
    JCEMediaBox.fx.prototype = {
        step: function() {
            var time = new Date().getTime();
            if (time < this.time + this.speed) {
                this.cTime = time - this.time;
                this.setNow();
                
            } else {
                var t = this;
                this.clearTimer();
                this.now = this.to;
                
                setTimeout(function() {
                    t.callback.call(t.element, t);
                }, 10);
            }
            this.increase();
        },
        
        setNow: function() {
            for (p in this.from) {
                this.now[p] = this.compute(this.from[p], this.to[p]);
            }
        },
        
        compute: function(from, to) {
            var change = to - from;
            return this.transition(this.cTime, from, change, this.speed);
        },
        
        clearTimer: function() {
            clearInterval(this.timer);
            this.timer = null;
            return this;
        },
        
        start: function(from, to) {
            var t = this;
            if (!this.wait) 
                this.clearTimer();
				
            if (this.timer) 
                return;
            
            this.from = from;
            this.to = to;
            this.time = new Date().getTime();
            this.timer = setInterval(function() {
                return t.step();
            }, Math.round(1000 / this.fps));
            return this;
        },
        
        custom: function(o) {
            if (this.timer && this.wait) 
                return;
            var from = {};
            var to = {};
            for (property in o) {
                from[property] = o[property][0];
                to[property] = o[property][1];
            }
            return this.start(from, to);
        },
        
        increase: function() {
            for (var p in this.now) {
                this.setStyle(this.element, p, this.now[p])
            }
        },
        
        transition: function(t, b, c, d) {
            return -c * Math.cos(t / d * (Math.PI / 2)) + c + b;
        },
        
        setStyle: function(e, p, v) {
            JCEMediaBox.DOM.style(e, p, v);
        }
    },    /**
     * Core Tooltip Object
     * Create and display tooltips
     * Based on Mootools Tips Class
     * copyright (c) 2007 Valerio Proietti, <http://mad4milk.net>
     */
    JCEMediaBox.ToolTip = {
        /**
         * Initialise the tooltip
         * @param {Object} elements
         * @param {Object} options
         */
        init: function() {
            var t = this, each = JCEMediaBox.each, DOM = JCEMediaBox.DOM, Event = JCEMediaBox.Event;
            
            // Load tooltip theme
            var theme = JCEMediaBox.options.theme == 'custom' ? JCEMediaBox.options.themecustom : JCEMediaBox.options.theme;
            
            this.tooltiptheme = '';
            
            new JCEMediaBox.XHR({
                success: function(text, xml) {
                    var re = /<!-- THEME START -->([\s\S]*?)<!-- THEME END -->/;
                    if (re.test(text)) {
                        text = re.exec(text)[1];
                    }
                    t.tooltiptheme = text;
                }
            }).send(JCEMediaBox.site + JCEMediaBox.options.themepath + '/' + theme + '/tooltip.html');
            
            /**
             * Private internal function to exclude children of element in event
             * @param {Object} el 	Element with event
             * @param {Object} e 	Event object
             * @param {Object} fn 	Callback function
             */
            function _withinElement(el, e, fn) {
                // Get target
                var p = e.relatedTarget;
                // If element is not target and target not within element...
                while (p && p != el) {
                    try {
                        p = p.parentNode;
                    } catch (e) {
                        p = el;
                    }
                }
                
                if (p != el) {
                    return fn.call(this);
                }
                return false;
            }
            // Add events to each found tooltip element
            each(DOM.select('.jcetooltip, .jce_tooltip'), function(el) {
                Event.add(el, 'mouseover', function(e) {
                    _withinElement(el, e, function() {
                        return t.start(el);
                    });
                });
                Event.add(el, 'mouseout', function(e) {
                    _withinElement(el, e, function() {
                        return t.end(el);
                    });
                });
                Event.add(el, 'mousemove', function(e) {
                    return t.locate(e);
                });
            });
        },
        
        /**
         * Create the tooltip div
         */
        create: function() {
            if (!this.toolTip) {
                var DOM = JCEMediaBox.DOM;
                this.toolTip = DOM.add(document.body, 'div', {
                    'style': {
                        'opacity': 0
                    },
                    'class': 'jcemediabox-tooltip'
                }, this.tooltiptheme);
            }
        },
        
        /**
         * Show the tooltip and build the tooltip text
         * @param {Object} e  Event
         * @param {Object} el Target Element
         */
        start: function(el) {
            var t = this, DOM = JCEMediaBox.DOM;
            if (!this.tooltiptheme) 
                return false;
            // Create tooltip if it doesn't exist
            this.create();
            
            // Get tooltip text from title
            var text = el.title || '', title = '';
            // Split tooltip text ie: title::text
            if (/::/.test(text)) {
                var parts = text.split('::');
                title = JCEMediaBox.trim(parts[0]);
                text = JCEMediaBox.trim(parts[1]);
            }
            // Inherit parent classes
            var cls = el.className.replace(/(jce_?)tooltip/gi, '');
            // Store original title and remove
            this.toolTip.title = el.title;
            
            DOM.attribute(el, 'title', '');
            
            var h = '';
            // Set tooltip title html
            if (title) {
                h += '<h4>' + title + '</h4>';
            }
            // Set tooltip text html
            if (text) {
                h += '<p>' + text + '</p>';
            }
            
            // Set tooltip html
            var tn = DOM.get('jcemediabox-tooltip-text');
            // Use simple tooltip
            if (typeof tn == 'undefined') {
                this.toolTip.className = 'jcemediabox-tooltip-simple';
                this.toolTip.innerHTML = h;
            } else {
                tn.innerHTML = h;
            }
            // Set visible
            DOM.style(t.toolTip, 'visibility', 'visible');
            // Fade in tooltip
            JCEMediaBox.FX.animate(t.toolTip, {
                'opacity': JCEMediaBox.options.tooltip.opacity
            }, JCEMediaBox.options.tooltip.speed);
        },
        
        /**
         * Fade Out and hide the tooltip
         * Restore the original element title
         * @param {Object} el Element
         */
        end: function(el) {
            var t = this, DOM = JCEMediaBox.DOM;
            if (!this.tooltiptheme) 
                return false;
            // Restore title
            DOM.attribute(el, 'title', this.toolTip.title);
            // Fade out tooltip and hide
            
            DOM.styles(this.toolTip, {
                'visibility': 'hidden',
                'opacity': 0
            });
        },
        
        /**
         * Position the tooltip
         * @param {Object} e Event trigger
         */
        locate: function(e) {
            if (!this.tooltiptheme) 
                return false;
				
            this.create();
            
            var o = JCEMediaBox.options.tooltip.offsets;
            var page = {
                'x': e.pageX || e.clientX + document.documentElement.scrollLeft,
                'y': e.pageY || e.clientY + document.documentElement.scrollTop
            };
            var tip = {
                'x': this.toolTip.offsetWidth,
                'y': this.toolTip.offsetHeight
            };
            var pos = {
                'x': page.x + o.x,
                'y': page.y + o.y
            };
            
            var ah = 0;
            
            switch (JCEMediaBox.options.tooltip.position) {
                case 'tl':
                    pos.x = (page.x - tip.x) - o.x;
                    pos.y = (page.y - tip.y) - (ah + o.y);
                    break;
                case 'tr':
                    pos.x = page.x + o.x;
                    pos.y = (page.y - tip.y) - (ah + o.y);
                    break;
                case 'tc':
                    pos.x = (page.x - Math.round((tip.x / 2))) + o.x;
                    pos.y = (page.y - tip.y) - (ah + o.y);
                    break;
                case 'bl':
                    pos.x = (page.x - tip.x) - o.x;
                    pos.y = (page.y + Math.round((tip.y / 2))) - (ah + o.y);
                    break;
                case 'br':
                    pos.x = page.x + o.x;
                    pos.y = page.y + o.y;
                    break;
                case 'bc':
                    pos.x = (page.x - (tip.x / 2)) + o.x;
                    pos.y = page.y + ah + o.y;
                    break;
            }
            JCEMediaBox.DOM.styles(this.toolTip, {
                top: pos.y,
                left: pos.x
            });
        },
        /**
         * Position the tooltip
         * @param {Object} element
         */
        position: function(element) {
        }
    },    /**
     * Core Popup Object
     * Creates and displays a media popup
     */
    JCEMediaBox.Popup = {
        /**
         * List of default addon media types
         */
		addons: {
            'flash': {},
            'image': {},
            'html': {}
        },
		/**
		 * Extend the addons object with a new addon
		 * @param {String} n Addon name
		 * @param {Object} o Addon object
		 */
        setAddons: function(n, o) {
            JCEMediaBox.extend(this.addons[n], o);
        },
		/**
		 * Return an addon object by name or all addons
		 * @param {String} n Addon name
		 */
        getAddons: function(n) {
            if (n) {
                return this.addons[n];
            }
            return this.addons;
        },
		/**
		 * Get / Test an addon object
		 * @param {Object} v
		 * @param {Object} n
		 */
        getAddon: function(v, n) {
            var t = this, cp = false, r, each = JCEMediaBox.each;
            
            addons = this.getAddons(n);
            
            each(this.addons, function(o, s) {
                each(o, function(fn) {
                    r = fn.call(this, v);
                    if (typeof r != 'undefined') {
                        cp = r;
                    }
                });
            });
            return cp;
        },
        /**
         * Clean an event removing anonymous function etc.
         * @param {String} s Event content
         * Copyright 2009, Moxiecode Systems AB
         */
        cleanEvent: function(s) {
            return s.replace(/^function\s+anonymous\(\)\s+\{\s+(.*)\s+\}$/, '$1');
        },
        /**
         * Get a popup parameter object
         * @param {String} s Parameter string
         */
        params: function(s) {
            var a = [], x = [];
            
            if (s instanceof Array) {
                x = s;
            } else {
                if (s.indexOf('&') != -1) {
                    x = s.split(/&(amp;)?/g);
                } else {
                    x = s.split(/;/g);
                }
            }
            
            JCEMediaBox.each(x, function(n, i) {
                if (n) {
                    n = n.replace(/^([^\[]+)(\[|=|:)([^\]]*)(\]?)$/, function(a, b, c, d) {
                        if (d) {
                            if (!/[^0-9]/.test(d)) {
                                return '"' + b + '":' + parseInt(d);
                            }
                            return '"' + b + '":"' + d + '"';
                        }
                        return '';
                    });
                    if (n) {
                        a.push(n);
                    }
                }
            });
            return eval('({' + a.join(',') + '})');
        },
        /**
         * Gets the raw data of a cookie by name.
         * Copyright 2009, Moxiecode Systems AB
         *
         * @method get
         * @param {String} n Name of cookie to retrive.
         * @return {String} Cookie data string.
         */
        getCookie: function(n) {
            var c = document.cookie, e, p = n + "=", b;
            
            // Strict mode
            if (!c) 
                return;
            
            b = c.indexOf("; " + p);
            
            if (b == -1) {
				b = c.indexOf(p);
				
				if (b != 0) 
					return null;
			} else {
				b += 2;
			}
            
            e = c.indexOf(";", b);
            
            if (e == -1) 
                e = c.length;
            
            return unescape(c.substring(b + p.length, e));
        },
        
        /**
         * Sets a raw cookie string.
         * Copyright 2009, Moxiecode Systems AB
         *
         * @method set
         * @param {String} n Name of the cookie.
         * @param {String} v Raw cookie data.
         * @param {Date} e Optional date object for the expiration of the cookie.
         * @param {String} p Optional path to restrict the cookie to.
         * @param {String} d Optional domain to restrict the cookie to.
         * @param {String} s Is the cookie secure or not.
         */
        setCookie: function(n, v, e, p, d, s) {
            document.cookie = n + "=" + escape(v) +
            ((e) ? "; expires=" + e.toGMTString() : "") +
            ((p) ? "; path=" + escape(p) : "") +
            ((d) ? "; domain=" + d : "") +
            ((s) ? "; secure" : "");
        },
        
        /**
         * Convert legacy popups to new format
         */
        convert: function() {
            var t = this, each = JCEMediaBox.each, DOM = JCEMediaBox.DOM;
            each(DOM.select('a[href]'), function(el) {
                // Only JCE Popup links
                if (/com_jce/.test(el.href)) {
                    var p, s, r = [];
                    var oc = DOM.attribute('onclick');
                    s = oc.replace(/&amp;/g, '&').replace(/&#39;/g, "'").split("'");
                    p = t.params(s[0]);
                    
                    img = p['img'] || '';
                    title = p['title'] || '';
                    
                    if (img) {
                        if (!/http:\/\//.test(img)) {
                            if (img.charAt(0) == '/') {
                                img = img.substr(1);
                            }
                            img = t.site.replace(/http:\/\/([^\/]+)/, '') + img;
                        }
                        DOM.attributes(el, {
                            'href': img,
                            'title': title.replace(/_/, ' '),
                            'onclick': ''
                        });
                        
                        DOM.addClass(el, 'jcepopup');
                    }
                }
            });
        },
        
        /**
         * Translate popup labels
         * @param {String} s Theme HTML
         */
        translate: function(s) {
            var t = this;
            if (!s) {
                s = this.popup.theme;
            }
            s = s.replace(/\{#(\w+?)\}/g, function(a, b) {
                return JCEMediaBox.options.popup.labels[b];
            });
            return s;
        },
        
        /**
         * Returns a styles object from a parameter
         * @param {Object} o
         */
        styles: function(o) {
            var v, s, x = [];
            if (!o) 
                return {};
            
            JCEMediaBox.each(o.split(';'), function(s, i) {
                s = s.replace(/(.*):(.*)/, function(a, b, c) {
                    return "'" + b + "':'" + c + "'";
                });
                x.push(s);
            });
            return eval('({' + x.join(',') + '})');
        },
        
        /**
         * Get the file type from the url, type attribute or className
         * @param {Object} el
         */
        getType: function(el) {
            var o = {}, type;
            
            // Media types
            if (/(director|windowsmedia|mplayer|quicktime|real|divx|flash)/.test(el.type)) {
                type = /(director|windowsmedia|mplayer|quicktime|real|divx|flash)/.exec(el.type)[1];
            }
            
            o = this.getAddon(el.src);
            
            if (o && o.type) {
                type = o.type;
            }
            
            return type || el.type || 'iframe';
        },
        
        /**
         * Determine media type and properties
         * @param {Object} c
         */
        mediatype: function(c) {
            var ci, cb, mt;
            
            c = /(director|windowsmedia|mplayer|quicktime|real|divx|flash)/.exec(c);
            
            switch (c[1]) {
                case 'director':
                case 'application/x-director':
                    ci = '166b1bca-3f9c-11cf-8075-444553540000';
                    cb = 'http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=8,5,1,0';
                    mt = 'application/x-director';
                    break;
                case 'windowsmedia':
                case 'mplayer':
                case 'application/x-mplayer2':
                    ci = '6bf52a52-394a-11d3-b153-00c04f79faa6';
                    cb = 'http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701';
                    mt = 'application/x-mplayer2';
                    break;
                case 'quicktime':
                case 'video/quicktime':
                    ci = '02bf25d5-8c17-4b23-bc80-d3488abddc6b';
                    cb = 'http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0';
                    mt = 'video/quicktime';
                    break;
                case 'real':
                case 'realaudio':
                case 'audio/x-pn-realaudio-plugin':
                    ci = 'cfcdaa03-8be4-11cf-b84b-0020afbbccfa';
                    cb = '';
                    mt = 'audio/x-pn-realaudio-plugin';
                    break;
                case 'divx':
                case 'video/divx':
                    ci = '67dabfbf-d0ab-41fa-9c46-cc0f21721616';
                    cb = 'http://go.divx.com/plugin/DivXBrowserPlugin.cab';
                    mt = 'video/divx';
                    break;
                default:
                case 'flash':
                case 'application/x-shockwave-flash':
                    ci = 'd27cdb6e-ae6d-11cf-96b8-444553540000';
                    cb = 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,124,0';
                    mt = 'application/x-shockwave-flash';
                    break;
            }
            return {
                'classid': ci,
                'codebase': cb,
                'mediatype': mt
            };
        },
        
        /**
         * Determine whether the url is local
         * @param {Object} s
         */
        islocal: function(s) {
            if (/^(\w+):\/\//.test(s)) {
                return new RegExp('^(' + JCEMediaBox.site + ')').test(s);
            } else {
                return true;
            }
        },
        
        /**
         * Get the width of the container frame
         */
        frameWidth: function() {
            var t = this, w = 0, el = this.frame;
            
            JCEMediaBox.each(['left', 'right'], function(s) {
                w = w + parseFloat(JCEMediaBox.DOM.style(el, 'padding-' + s));
            });
            return parseFloat(this.frame.clientWidth - w);
        },
        
        /**
         * Get the height of the container frame
         */
        frameHeight: function() {
            var t = this, h = 0, el = this.frame, DIM = JCEMediaBox.Dimensions;
            
            JCEMediaBox.each(['top', 'bottom'], function(s) {
                h = h + parseFloat(JCEMediaBox.DOM.style(el, 'padding-' + s));
            });
            
            h = h + ((JCEMediaBox.isIE6 || JCEMediaBox.isIE7) ? DIM.getScrollbarWidth() : 0);
            
            return parseInt(DIM.getHeight()) - h;
        },
        
        /**
         * Get the width of the usable window
         */
        width: function() {
            return this.frameWidth() - JCEMediaBox.Dimensions.getScrollbarWidth();
        },
        
        /**
         * Get the height of the usable window less info divs
         */
        height: function() {
            var h = 0, t = this, each = JCEMediaBox.each, DOM = JCEMediaBox.DOM, DIM = JCEMediaBox.Dimensions;
            each(['top', 'bottom'], function(s) {
                var el = t['info-' + s];
                if (el) {
                    h = h + parseInt(DIM.outerHeight(el));
                }
            });
            
            return this.frameHeight() - h;
        },
        
        /**
         * Print the page contents (TODO)
         */
        printPage: function() {
            return false;
        },
        
        /**
         * Create a popup zoom icon
         * @param {Object} el Popup link element
         */
        zoom: function(el) {
            var t = this, DOM = JCEMediaBox.DOM, extend = JCEMediaBox.extend, each = JCEMediaBox.each, s, m, x, y;
            var child = el.firstChild;
            // Create basic zoom element			
            var zoom = DOM.create('span');
            
            // If child is an image (thumbnail)
            if (child && child.nodeName == 'IMG') {
                var align = child.getAttribute('align');
                var vspace = child.getAttribute('vspace');
                var hspace = child.getAttribute('hspace');
                
                var w = child.getAttribute('width') || child.style.width || 0;
                var h = child.getAttribute('height') || child.style.height || 0;
                
                var styles = {
                    'width': w,
                    'height': h
                };
                
                // Transfer margin, padding and border
                each(['top', 'right', 'bottom', 'left'], function(pos) {
                    // Set margin
                    styles['margin-' + pos] = DOM.style(child, 'margin-' + pos);
                    // Set padding
                    styles['padding-' + pos] = DOM.style(child, 'padding-' + pos);
                    // Set border
                    each(['width', 'style', 'color'], function(prop) {
                        styles['border-' + pos + '-' + prop] = DOM.style(child, 'border-' + pos + '-' + prop);
                    });
                });
                
                // Correct from deprecated align attribute
                if (/\w+/.test(align)) {
                    extend(styles, {
                        'float': /left|right/.test(align) ? align : '',
                        'text-align': /top|middle|bottom/.test(align) ? align : ''
                    });
                }
                // Correct from deprecated vspace attribute
                if (vspace > 0) {
                    extend(styles, {
                        'margin-top': parseInt(vspace),
                        'margin-bottom': parseInt(vspace)
                    });
                }
                // Correct from deprecated hspace attribute
                if (hspace > 0) {
                    extend(styles, {
                        'margin-left': parseInt(hspace),
                        'margin-right': parseInt(hspace)
                    });
                }
                
                // Add style alignment
                extend(styles, {
                    'float': DOM.style(child, 'float'),
                    'text-align': child.style.textAlign
                });
                
                /**
                 * Private Internal function
                 * Build and place the icon
                 * @param {Object} el The Parent Link Element
                 * @param {Object} zoom The Zoom Element
                 * @param {Object} zoom The Child Element (Image)
                 * @param {Object} styles Computed Styles object
                 */
                function _buildIcon(el, zoom, child, styles) {
                    var pos, w = styles.width || 0, h = styles.height || 0;
                    // Clone image as span element					
                    var span = DOM.add(el, 'span', {
                        'class': 'jcemediabox-zoom-span',
                        'style': child.style.cssText
                    });
                    
                    // Set styles
                    DOM.styles(span, styles);
                    
                    // Move the image into the parent SPAN
                    DOM.add(span, child);
                    // Move the zoom icon into the parent SPAN
                    DOM.add(span, zoom);
                    
                    // Remove attributes that may affect layout
                    each(['style', 'align', 'border', 'hspace', 'vspace'], function(v, i) {
                        child.removeAttribute(v);
                    });
                    
                    // Add zoom-image class
                    DOM.addClass(zoom, 'jcemediabox-zoom-image');
                    // Get icon position
                    pos = el.className.match(/icon-(top-right|top-left|bottom-right|bottom-left|left|right|center|centre)/);
                    if (pos) {
                        pos = pos[1];
                        pos = (/^(left|right)/.test(pos)) ? 'bottom ' + pos : pos.replace(/-/, ' ')
                    } else {
                        pos = 'bottom right';
                    }
                    
                    var top = -h, left = 0;
                    
                    // Set explicit positions for IE6 when zoom icon is png
                    if (JCEMediaBox.isIE6 && /\.png/i.test(DOM.style(zoom, 'background-image'))) {
                        var zw = parseFloat(DOM.style(zoom, 'width'));
                        var zh = parseFloat(DOM.style(zoom, 'height'));
                        
                        if (/(bottom)/.test(pos)) 
                            top = -zh;
                        if (/(right)/.test(pos)) 
                            left = w - zw;
                        
                        DOM.style(zoom, 'left', left);
                        
                        DOM.style(el, 'position', 'static');
                        DOM.png(zoom);
                    }
                    
                    // Position zoom image span
                    DOM.styles(zoom, {
                        'top': top,
                        'background-position': pos
                    });
                    
                    // Remove styles from image
                    DOM.styles(child, {
                        'margin': 0,
                        'padding': 0,
                        'float': 'none',
                        'border': 'none'
                    });
                }
                // No dimensions? Try and find using new Image
                if (/^(0|auto)/.test(w) || /^(0|auto)/.test(h)) {
                    x = new Image();
                    x.src = child.src;
                    x.onload = function() {
                        extend(styles, {
                            width: parseInt(x.width),
                            height: parseInt(x.height)
                        });
                        _buildIcon(el, zoom, child, styles);
                    }
                } else {
                    _buildIcon(el, zoom, child, styles);
                }
            } else {
                DOM.addClass(zoom, 'jcemediabox-zoom-link');
                if (DOM.hasClass(el, 'icon-left')) {
                    DOM.addBefore(el, zoom);
                } else {
                    DOM.add(el, zoom);
                }
                // IE7 won't accept display:inherit
                if (JCEMediaBox.isIE7) {
                    DOM.style(zoom, 'display', 'inline-block');
                }
            }
            // Return zoom icon element
            return zoom;
        },
        
        /**
         * Process autopopups
         */
        auto: function() {
            var t = this;
            JCEMediaBox.each(this.popups, function(el, i) {
                if (el.auto) {
                    if (el.auto == 'autopopup-single') {
                        var cookie = t.getCookie('jceutilities_autopopup_' + el.id);
                        if (!cookie) {
                            t.setCookie('jceutilities_autopopup_' + el.id, 1);
                            t.start(el);
                        }
                    } else 
                        if (el.auto == 'autopopup-multiple') {
                            t.start(el);
                        }
                }
            });
        },
        
		/**
		 * Initilise popup and create global jcepopup variable
		 */
        init: function() {
            window.jcepopup = this;
            this.create();
        },
        
        /**
         * Create a popup from identifiable link or area elements
         * Load the popup theme
         */
        create: function() {
            var t = this, auto = false, each = JCEMediaBox.each, DOM = JCEMediaBox.DOM, Event = JCEMediaBox.Event;
            this.popups = [], this.popuptheme = '';
            
            // Converts a legacy (window) popup into an inline popup
            if (JCEMediaBox.options.popup.legacy == 1) {
                t.convert();
            }
            // Iterate through all found popup links		
            each(DOM.select('a.jcebox, a.jcelightbox, a.jcepopup, area.jcebox, area.jcelightbox, area.jcepopup'), function(el, i) {
                // Simplify class identifier for css
                if (/(jcelightbox|jcebox)/.test(el.className)) {
                    DOM.removeClass(el, 'jcelightbox');
                    DOM.removeClass(el, 'jcebox');
                    DOM.addClass(el, 'jcepopup');
                }
                
                if (!DOM.hasClass(el, 'nopopup')) {
                    // Create zoom icon
                    if (JCEMediaBox.options.popup.icons == 1 && el.nodeName == 'A' && !/(noicon|icon-none|noshow)/.test(el.className) && el.style.display != 'none') {
                        var zoom = t.zoom(el);
                    }
                    // Hide popup link if specified in class
                    if (DOM.hasClass(el, 'noshow')) {
                        DOM.hide(el);
                    }
                    
                    var group = '', p = '';
                    
                    // Auto popup on page load
                    if (!auto && el.id) {
                        //auto = el.hasClass('autopopup');
                        if (c = el.className.match(/autopopup-(single|multiple)/)) {
                            auto = c[0];
                        }
                    }
                    
                    // Fix title and rel and move parameters
                    var title = el.title || '';
                    var rel = el.rel || '';
                    // Process title attribute
                    if (title && /(\w+\[.*\])/.test(title)) {
                        // get parameters
                        p = t.params(title);
                        DOM.attribute(el, 'title', p.title || '');
                        group = p.group || '';
                    }
                    // Process rel attribute
                    if (rel && /(\w+\[.*\])/.test(rel)) {
                        var args = [];
                        rel = rel.replace(/\b((\w+)\[(.*?)\])(;?)/g, function(a, b, c) {
                            args.push(b);
                            return '';
                        });
                        
                        // get parameters
                        p = t.params(args);
                        DOM.attribute(el, 'rel', rel || p.rel || '');
                        group = p.group || '';
                        
                    } else {
                        var rx = 'alternate|stylesheet|start|next|prev|contents|index|glossary|copyright|chapter|section|subsection|appendix|help|bookmark|nofollow|licence|tag|friend';
                        var lb = '(lightbox(\[(.*?)\])?)';
                        var lt = '(lyte(box|frame|show)(\[(.*?)\])?)';
                        
                        group = rel.replace(new RegExp('\s*(' + rx + '|' + lb + '|' + lt + ')\s*'), '', 'gi');
                    }
                    
                    var src = el.href;
                    
                    // Legacy width/height values
                    src = src.replace(/b(w|h)=([0-9]+)/g, function(s, k, v) {
                        k = (k == 'w') ? 'width' : 'height';
                        
                        return k + '=' + v;
                    });
                    
                    // Get AREA parameters from URL if not set
                    if (el.nodeName == 'AREA') {
                        if (!p) {
                            p = t.params(src);
                        }
                        // Set AREA group
                        group = group || 'AREA_ELEMENT';
                    }
                    
                    // Popup object
                    var o = {
                        'src': src,
                        'title': p.title || title,
                        'group': DOM.hasClass(el, 'nogroup') ? '' : group,
                        'type': p.type || el.type || '',
                        'params': p ||
                        {},
                        'id': el.id || '',
                        'auto': auto
                    };
                    // Remove type
                    el.href = el.href.replace(/&type=(ajax|text\/html|text\/xml)/, '');
                    // Add to global popups array
                    t.popups.push(o);
                    // Add click event to link
                    Event.add(el, 'click', function(e) {
                        Event.cancel(e);
                        return t.start(o, i);
                    });
                    
                    // Reset auto popup value
                    auto = false;
                }
            });
            
            // Load the popup theme	
            var theme = JCEMediaBox.options.theme == 'custom' ? JCEMediaBox.options.themecustom : JCEMediaBox.options.theme;
            
            new JCEMediaBox.XHR({
                success: function(text, xml) {
                    var re = /<!-- THEME START -->([\s\S]*?)<!-- THEME END -->/;
                    if (re.test(text)) {
                        text = re.exec(text)[1];
                    }
                    t.popuptheme = text;
                    // Process auto popups
                    t.auto();
                }
            }).send(JCEMediaBox.site + JCEMediaBox.options.themepath + '/' + theme + '/popup.html');
        },
        
        /**
         * Public popup method
         * @param {String} url Popup URL
         * @param {String} title Popup Title
         * @param {String} group Popup Group
         * @param {String} type Popup Type, eg: image, flash, ajax
         * @param {Object} params Popup Parameters Object
         */
        open: function(url, title, group, type, params) {
            var link = {
                'src': url,
                'title': title,
                'group': group,
                'type': type,
                'params': params
            };
            return this.start(link);
        },
        
        /**
         * Start a popup
         * @param {Object} o The popup link object
         * @param {Object} i The popup index
         */
        start: function(p, i) {
            var t = this, n = 0, x = 0, items = [], each = JCEMediaBox.each;
            
            // build popup window
            if (this.build()) {
                if (p.group) {
                    each(this.popups, function(o, x) {
                        if (o.group == p.group) {
                            items.push(o);
                            if (i && x == i) {
                                n = items.indexOf(o);
                            }
                        }
                    });
                    // Triggered popup
                    if (!p.auto && typeof i == 'undefined') {
                        items.push(p);
                        n = items.length - 1;
                    }
                } else {
                    items.push(p);
                }
                return this.show(items, n);
            }
        },
        
        /**
         * Build Popup structure
         */
        build: function() {
            var t = this, each = JCEMediaBox.each, DOM = JCEMediaBox.DOM, Event = JCEMediaBox.Event;
            // Create main page object
            this.page = DOM.add(document.body, 'div', {
                id: 'jcemediabox-popup-page'
            });
            
            if (JCEMediaBox.options.popup.overlay == 1) {
                // Create overlay
                this.overlay = DOM.add(this.page, 'div', {
                    id: 'jcemediabox-popup-overlay',
                    style: {
                        'opacity': 0,
                        'background-color': JCEMediaBox.options.popup.overlaycolor
                    }
                });
            }
            
            // Cancel if no theme
            if (!this.popuptheme) {
                return false;
            }
            // Remove comments
            this.popuptheme = this.popuptheme.replace(/<!--(.*?)-->/g, '');
            // Translate
            this.popuptheme = this.translate(this.popuptheme);
            // Create Frame
            this.frame = DOM.add(this.page, 'div', {
                id: 'jcemediabox-popup-frame'
            }, '<div id="jcemediabox-popup-body">' + this.popuptheme + '</div>');
            
            // Create all Popup structure objects
            each(DOM.select('*[id]', this.frame), function(el) {
                var s = el.id.replace('jcemediabox-popup-', '');
                t[s] = el;
                DOM.hide(el);
            });
            
            // Add close function to frame on click
            Event.add(this.frame, 'click', function(e) {
                if (e.target && e.target == t.frame) {
                    t.close();
                }
            });
            
            // Setup Close link event
            if (this.closelink) {
                Event.add(this.closelink, 'click', function() {
                    return t.close();
                });
            }
            // Setup Cancel link event
            if (this.cancellink) {
                Event.add(this.cancellink, 'click', function() {
                    return t.close();
                });
            }
            // Setup Next link event
            if (this.next) {
                Event.add(this.next, 'click', function() {
                    return t.nextItem();
                });
            }
            // Setup Previous link event
            if (this.prev) {
                Event.add(this.prev, 'click', function() {
                    return t.previousItem();
                });
            }
            if (this.numbers) {
                this.numbers.tmpHTML = this.numbers.innerHTML;
            }
            
            if (this.print) {
                Event.add(this.print, 'click', function() {
                    return t.printPage();
                });
            }
            // PNG Fix
            if (JCEMediaBox.isIE6) {
                DOM.png(this.body);
                each(DOM.select('*', this.body), function(el) {
                    // Exclude loaded content
                    if (DOM.attribute(el, 'id') == 'jcemediabox-popup-content') {
                        return;
                    }
                    DOM.png(el);
                });
            }
            return true;
        },
        
        /**
         * Show the popup window
         * @param {Array} items Array of popup objects
         * @param {Int} n Index of current popup
         */
        show: function(items, n) {
            var t = this, DOM = JCEMediaBox.DOM, DIM = JCEMediaBox.Dimensions;
            this.items = items;
            this.bind(true);
            
            // Show popup
            DOM.show(this.body);
            // Get top position
            var top = (DIM.getHeight() - DIM.outerHeight(this.body)) / 2;
            
            // Set top position
            DOM.style(this.body, 'top', top);
            // Changes if IE6 or scrollpopup
            if (JCEMediaBox.isIE6 || JCEMediaBox.options.popup.scrolling == 'scroll') {
                DOM.style(this.page, 'position', 'absolute');
                DOM.style(this.overlay, 'height', DIM.getScrollHeight());
                DOM.style(this.body, 'top', DIM.getScrollTop() + top);
            }
            // Fade in overlay
            if (JCEMediaBox.options.popup.overlay == 1 && this.overlay) {
                DOM.show(this.overlay);
                JCEMediaBox.FX.animate(this.overlay, {
                    'opacity': JCEMediaBox.options.popup.overlayopacity
                }, JCEMediaBox.options.popup.fadespeed);
            }
            return this.change(n);
        },
        
        /**
         * Create event / key bindings
         * @param {Boolean} open Whether popup is opened or closed
         */
        bind: function(open) {
            var t = this, isIE6 = JCEMediaBox.isIE6, each = JCEMediaBox.each, DOM = JCEMediaBox.DOM, Event = JCEMediaBox.Event;
            
            if (isIE6) {
                each(DOM.select('select'), function(el) {
                    if (open) {
                        el.tmpStyle = el.style.visibility || '';
                    }
                    el.style.visibility = open ? 'hidden' : el.tmpStyle;
                });
            }
            if (JCEMediaBox.options.popup.hideobjects) {
                each(DOM.select('object, embed'), function(el) {
                    if (el.id == 'jcemediabox-popup-object') 
                        return;
                    if (open) {
                        el.tmpStyle = el.style.visibility || '';
                    }
                    el.style.visibility = open ? 'hidden' : el.tmpStyle;
                });
            }
            var scroll = JCEMediaBox.options.popup.scrollpopup;
            if (open) {
                Event.add(document, 'keydown', function(e) {
                    t.listener(e);
                });
                if (isIE6) {
                    Event.add(window, 'scroll', function(e) {
                        DOM.style(t.overlay, 'height', JCEMediaBox.Dimensions.getScrollHeight());
                    });
                    Event.add(window, 'scroll', function(e) {
                        DOM.style(t.overlay, 'width', JCEMediaBox.Dimensions.getScrollWidth());
                    });
                }
            } else {
                if (isIE6 || !scroll) {
                    Event.remove(window, 'scroll');
                    Event.remove(window, 'resize');
                }
                Event.remove(document, 'keydown');
            }
        },
        
        /**
         * Keyboard listener
         * @param {Object} e Event
         */
        listener: function(e) {
            switch (e.keyCode) {
                case 27:
                    this.close();
                    break;
                case 37:
                    this.previousItem();
                    break;
                case 39:
                    this.nextItem();
                    break;
            }
        },
        
        /**
         * Process a popup in the group queue
         * @param {Object} n Queue position
         */
        queue: function(n) {
            var t = this, s = JCEMediaBox.options.popup.fadespeed, ss = JCEMediaBox.options.popup.scalespeed;
            // Optional element
            var changed = false;
            
            JCEMediaBox.each(['top', 'bottom'], function(s) {
                var el = t['info-' + s];
                if (el) {
                    var v = JCEMediaBox.Dimensions.outerHeight(el);
                    var style = {};
                    style['top'] = s == 'top' ? v : -v;
                    JCEMediaBox.DOM.style(el, 'z-index', -1);
                    JCEMediaBox.FX.animate(el, style, ss, function() {
                        if (!changed) {
                            changed = true;
                            JCEMediaBox.FX.animate(t.content, {
                                'opacity': 0
                            }, JCEMediaBox.options.popup.fadespeed, function() {
                                return t.change(n);
                            });
                        }
                    });
                }
            });
        },
        
        /**
         * Process the next popup in the group
         */
        nextItem: function() {
            if (this.items.length == 1) 
                return false;
            var n = this.index + 1;
            
            if (n < 0 || n >= this.items.length) {
                return false;
            }
            return this.queue(n);
        },
        
        /**
         * Process the previous popup in the group
         */
        previousItem: function() {
            if (this.items.length == 1) 
                return false;
            var n = this.index - 1;
            
            if (n < 0 || n >= this.items.length) {
                return false;
            }
            return this.queue(n);
        },
        
        /**
         * Set the popup information (caption, title, numbers)
         */
        info: function() {
            var each = JCEMediaBox.each, DOM = JCEMediaBox.DOM, Event = JCEMediaBox.Event;
            // Optional Element Caption/Title
            
            if (this.caption) {
                var title = this.active.caption || this.active.title || '', text = '';
                
                var ex = '([-!#$%&\'\*\+\\./0-9=?A-Z^_`a-z{|}~]+@[-!#$%&\'\*\+\\/0-9=?A-Z^_`a-z{|}~]+\.[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+)';
                var ux = '((news|telnet|nttp|file|http|ftp|https)://[-!#$%&\'\*\+\\/0-9=?A-Z^_`a-z{|}~]+\.[-!#$%&\'\*\+\\./0-9=?A-Z^_`a-z{|}~]+)';
                
                function processRe(h) {
                    h = h.replace(new RegExp(ex, 'g'), '<a href="mailto:$1" target="_blank" title="$1">$1</a>');
                    h = h.replace(new RegExp(ux, 'g'), '<a href="$1" target="_blank" title="$1">$1</a>');
                    
                    return h;
                }
                
                if (/::/.test(title)) {
                    var parts = title.split('::');
                    title = JCEMediaBox.trim(parts[0]);
                    text = JCEMediaBox.trim(parts[1]);
                }
                var h = '';
                if (title) {
                    h += '<h4>' + title + '</h4>';
                }
                if (text) {
                    h += '<p>' + text + '</p>';
                }
                this.caption.innerHTML = h;
                // Lazy layout fix
                if (h == '') {
                    this.caption.innerHTML = '&nbsp;';
                }
                
                // Process e-mail and urls
                each(DOM.select('*', this.caption), function(el) {
                    if (el.nodeName != 'A') {
                        each(el.childNodes, function(n, i) {
                            if (n.nodeType == 3) {
                                var s = n.innerText || n.textContent || n.data || null;
                                if (s && /(@|:\/\/)/.test(s)) {
                                    if (s = processRe(s)) {
                                        n.parentNode.innerHTML = s;
                                    }
                                }
                            }
                        });
                    }
                });
            }
            // Optional Element
            var t = this, html = '', len = this.items.length;
            
            if (this.numbers && len > 1) {
                var html = this.numbers.tmpHTML || '{$numbers}';
                
                if (/\{\$numbers\}/.test(html)) {
                    this.numbers.innerHTML = '';
                    for (var i = 0; i < len; i++) {
                        var n = i + 1;
                        // Craete Numbers link
                        var link = DOM.add(this.numbers, 'a', {
                            'href': 'javascript:;',
                            'title': this.items[i].title || n,
                            'class': (this.index == i) ? 'active' : ''
                        }, n);
                        // add click event
                        Event.add(link, 'click', function(e) {
                            var x = parseInt(e.target.innerHTML) - 1;
                            if (t.index == x) {
                                return false;
                            }
                            return t.queue(x);
                        });
                    }
                }
                
                if (/\{\$(current|total)\}/.test(html)) {
                    this.numbers.innerHTML = html.replace('{$current}', this.index + 1).replace('{$total}', len);
                }
            } else {
                this.numbers.innerHTML = '';
            }
            each(['top', 'bottom'], function(v, i) {
                var el = t['info-' + v];
                if (el) {
                    el.style.visibility = 'hidden';
                    DOM.show(el);
                    each(DOM.select('*[id]', el), function(s) {
                        DOM.show(s);
                    });
                }
            });
            // Show / Hide Previous and Next buttons
            DOM.hide(this.next);
            DOM.hide(this.prev);
            
            if (len > 1) {
                if (this.prev) {
                    if (this.index > 0) {
                        DOM.show(this.prev);
                    } else {
                        DOM.hide(this.prev);
                    }
                }
                if (this.next) {
                    if (this.index < len - 1) {
                        DOM.show(this.next);
                    } else {
                        DOM.hide(this.next);
                    }
                }
            }
        },
        
        /**
         * Change the popup
         * @param {Integer} n Popup number
         */
        change: function(n) {
            var t = this, extend = JCEMediaBox.extend, each = JCEMediaBox.each, DOM = JCEMediaBox.DOM, isIE = JCEMediaBox.isIE;
            
            var p = {}, s, o, w, h;
            if (n < 0 || n >= this.items.length) {
                return false;
            }
            this.index = n;
            this.active = {};
            
            // Show Container
            DOM.show(this.container);
            // Show Loader
            if (this.loader) {
                DOM.show(this.loader);
            }
            // Show Cancel
            if (this.cancellink) {
                DOM.show(this.cancellink);
            }
            // Remove object
            if (this.object) {
                this.object = null;
            }
            
            this.content.innerHTML = '';
            
            o = this.items[n];
            
            // Get parameters from addon
            extend(p, this.getAddon(o.src, o.type));
            // Get set parameters
            extend(p, o.params);
            
            extend(this.active, {
                'src': p.src || o.src,
                'title': o.title,
                'caption': p.caption || '',
                'type': p.type || this.getType(o),
                'params': p ||
                {},
                'width': p.width || JCEMediaBox.options.popup.width || 0,
                'height': p.height || JCEMediaBox.options.popup.height || 0
            });
            
            // Setup info
            this.info();
            
            switch (this.active.type) {
                case 'image':
                    if (this.print && this.options.print) {
                        this.print.style.visibility = 'visible';
                    }
                    
                    this.img = new Image();
                    this.img.onload = function() {
                        return t.setup();
                    };
                    this.img.src = this.active.src;
                    break;
                case 'flash':
                case 'director':
                case 'shockwave':
                case 'mplayer':
                case 'windowsmedia':
                case 'quicktime':
                case 'realaudio':
                case 'real':
                case 'divx':
                    if (this.print) {
                        this.print.style.visibility = 'hidden';
                    }
                    
                    p.src = this.active.src;
                    var base = /:\/\//.test(p.src) ? '' : this.site;
                    this.object = '';
                    
                    w = this.width();
                    h = this.height();
                    
                    var mt = this.mediatype(this.active.type);
                    
                    if (this.active.type == 'flash') {
                        p.wmode = 'transparent';
                        p.base = base;
                    }
                    if (/(mplayer|windowsmedia)/i.test(this.active.type)) {
                        p.baseurl = base;
                        if (isIE) {
                            p.url = p.src;
                            delete p.src;
                        }
                    }
                    // delete some parameters
                    delete p.title;
                    delete p.group;
                    
                    // Set width/height
                    p.width = this.active.width = p.width || w;
                    p.height = this.active.height = p.height || h;
                    
                    var flash = /flash/i.test(this.active.type);
                    
                    // Create single object for IE / Flash
                    
                    if (flash || isIE) {
                        this.object = '<object id="jcemediabox-popup-object"';
                        // Add type and data attribute
                        if (flash && !isIE) {
                            this.object += ' type="' + mt.mediatype + '" data="' + p.src + '"'
                        } else {
                            this.object += ' classid="clsid:' + mt.classid + '"';
                            if (mt.codebase) {
                                this.object += ' codebase="' + mt.codebase + '"';
                            }
                        }
                        
                        for (n in p) {
                            if (p[n] !== '') {
                                if (/(id|name|width|height|style)$/.test(n)) {
                                    t.object += ' ' + n + '="' + decodeURIComponent(p[n]) + '"';
                                }
                            }
                        }
                        // Close object
                        this.object += '>';
                        // Create param elements
                        for (n in p) {
                            if (p[n] !== '' && !/(id|name|width|height|style|type)/.test(n)) {
                                t.object += '<param name="' + n + '" value="' + decodeURIComponent(p[n]) + '" />';
                            }
                        }
                        // Add closing object element
                        this.object += '</object>';
                    // Use embed for non-IE browsers
                    } else {
                        this.object = '<embed type="' + mt.mediatype + '"';
                        for (n in p) {
                            if (p[n] !== '') {
                                t.object += ' ' + n + '="' + decodeURIComponent(p[n]) + '"';
                            }
                        }
                        this.object += '></embed>';
                    }
                    
                    // set global media type
                    this.active.type = 'media';
                    
                    this.setup();
                    break;
                case 'ajax':
                case 'text/html':
                case 'text/xml':
                    if (this.print && this.options.print) {
                        this.print.style.visibility = 'visible';
                    }
                    
                    this.active.width = this.active.width || this.width();
                    this.active.height = this.active.height || this.height();
                    
                    if (this.islocal(this.active.src)) {
                        if (!/tmpl=component/i.test(this.active.src)) {
                            this.active.src += /\?/.test(this.active.src) ? '&tmpl=component' : '?tmpl=component';
                        }
                        this.active.type = 'ajax';
                    } else {
                        this.active.type = 'iframe';
                        this.setup();
                    }
                    
                    styles = extend(this.styles(p.styles), {
                        display: 'none'
                    });
                    // Create ajax container
                    this.ajax = DOM.add(this.content, 'div', {
                        id: 'jcemediabox-popup-ajax',
                        'style': styles
                    });
                    
                    // Corrective stuff for IE6 and IE7
                    if (JCEMediaBox.isIE6) {
                        DOM.style(this.ajax, 'margin-right', JCEMediaBox.Dimensions.getScrollbarWidth());
                    }
                    
                    if (JCEMediaBox.isIE7) {
                        DOM.style(this.ajax, 'padding-right', JCEMediaBox.Dimensions.getScrollbarWidth());
                    }
                    this.active.src = this.active.src.replace(/\&type=(ajax|text\/html|text\/xml)/, '');
                    // Get data
                    new JCEMediaBox.XHR({
                        method: 'POST',
                        success: function(text, xml) {
                            var data = text, html = data, re = /<body[^>]*>([\s\S]*?)<\/body>/;
                            if (re.test(data)) {
                                html = re.exec(data)[1];
                            }
                            
                            t.ajax.innerHTML = html;
                            
                            if (t.loader) {
                                DOM.show(t.loader);
                            }
                            each(DOM.select('a', t.content), function(el) {
                                JCEMediaBox.Event.add(el, 'click', function() {
                                    if (el.href && el.href.indexOf('#') == -1) {
                                        t.close();
                                    }
                                });
                            });
                            // setup
                            return t.setup();
                        }
                    }).send(this.active.src);
                    break;
                case 'iframe':
                default:
                    if (this.print) {
                        this.print.style.visibility = 'hidden';
                    }
                    
                    if (this.islocal(this.active.src)) {
                        if (!/tmpl=component/i.test(this.active.src)) {
                            this.active.src += /\?/.test(this.active.src) ? '&tmpl=component' : '?tmpl=component';
                        }
                    }
                    
                    this.active.width = this.active.width || this.width();
                    this.active.height = this.active.height || this.height();
                    
                    this.active.type = 'iframe';
                    this.setup();
                    break;
            }
            return false;
        },
        /**
         * Proportional resizing method
         * @param {Object} w
         * @param {Object} h
         * @param {Object} x
         * @param {Object} y
         */
        resize: function(w, h, x, y) {
            if (w > x) {
                h = h * (x / w);
                w = x;
                if (h > y) {
                    w = w * (y / h);
                    h = y;
                }
            } else 
                if (h > y) {
                    w = w * (y / h);
                    h = y;
                    if (w > x) {
                        h = h * (x / w);
                        w = x;
                    }
                }
            w = Math.round(w);
            h = Math.round(h);
            
            return {
                width: Math.round(w),
                height: Math.round(h)
            };
        },
        
        /**
         * Pre-animation setup. Resize images, set width / height
         */
        setup: function() {
            var t = this, DOM = JCEMediaBox.DOM, Event = JCEMediaBox.Event, w, h;
            
            w = this.active.width;
            h = this.active.height;
            
            // Get image dimensions and resize if necessary
            if (this.active.type == 'image') {
                var x = this.img.width;
                var y = this.img.height;
                
                w = w || x;
                h = h || y;
                
                if (w != x || h != y) {
                    var dim = this.resize(x, y, w, h);
                    w = dim.width;
                    h = dim.height;
                }
            }
            
            // Resize to fit screen
            if (JCEMediaBox.options.popup.resize == 1 || JCEMediaBox.options.popup.scrolling == 'fixed') {
                var x = this.width();
                var y = this.height();
                
                var dim = this.resize(w, h, x, y);
                
                w = dim.width;
                h = dim.height;
            }
            
            DOM.styles(this.content, {
                width: w,
                height: h
            });
            DOM.hide(this.content);
            if (this.active.type == 'image') {
                this.content.innerHTML = '<img id="jcemediabox-popup-img" src="' + this.active.src + '" title="' + this.active.title + '" width="' + w + '" height="' + h + '" />';
            }
            
            // Animate box
            return this.animate();
        },
        /**
         * Animate the Popup
         */
        animate: function() {
            var t = this, each = JCEMediaBox.each, DOM = JCEMediaBox.DOM, FX = JCEMediaBox.FX, DIM = JCEMediaBox.Dimensions;
            var ss = JCEMediaBox.options.popup.scalespeed, fs = JCEMediaBox.options.popup.fadespeed;
            
            var cw = DIM.outerWidth(this.content);
            var ch = DIM.outerHeight(this.content);
            var ih = 0;
            each(['top', 'bottom'], function(v, i) {
                var el = t['info-' + v];
                if (el) {
                    ih = ih + DIM.outerHeight(el);
                }
            });
            
            var st = DOM.style(this.page, 'position') == 'fixed' ? 0 : DIM.getScrollTop();
            var top = st + (this.frameHeight() / 2) - ((ch + ih) / 2);
            
            DOM.style(this.content, 'opacity', 0);
            
            // Animate width
            FX.animate(this.body, {
                'height': ch,
                'top': top,
                'width': cw
            }, ss, function() {
                // Hide loader
                if (t.loader) {
                    DOM.hide(t.loader);
                }
                // If media
                if (t.active.type == 'media' && t.object) {
                    t.content.innerHTML = t.object;
                }
                DOM.show(t.content);
                if (t.active.type == 'ajax') {
                    DOM.show(t.ajax);
                }
                t.content.focus();
                // Iframe
                if (t.active.type == 'iframe') {
                    // Create IFrame
                    t.iframe = DOM.add(t.content, 'iframe', {
                        id: 'jcemediabox-popup-iframe',
                        frameBorder: 0,
                        allowTransparency: true,
                        scrolling: t.active.params.scrolling || 'auto',
                        'style': {
                            width: t.active.width,
                            height: t.active.height
                        }
                    });
                    // Set src
                    t.iframe.setAttribute('src', t.active.src);
                }
                /**
                 * Private internal function
                 * Show info areas of popup
                 */
                function showInfo() {
                    // Set Information
                    var itop = t['info-top'];
                    if (itop) {
                        each(DOM.select('*[id]', itop), function(el) {
                            if (/jcemediabox-popup-(next|prev)/.test(DOM.attribute(el, 'id'))) {
                                return;
                            }
                            DOM.show(el);
                        });
                        
                        var h = DIM.outerHeight(itop);
                        DOM.styles(itop, {
                            'z-index': -1,
                            'top': h,
                            'visibility': 'visible'
                        });
                        
                        FX.animate(itop, {
                            'top': 0
                        }, ss, function() {
                            itop.style.zIndex = 0;
                        });
                    }
                    
                    var ibottom = t['info-bottom'];
                    if (ibottom) {
                        each(DOM.select('*[id]', ibottom), function(el) {
                            if (/jcemediabox-popup-(next|prev)/.test(DOM.attribute(el, 'id'))) {
                                return;
                            }
                            DOM.show(el);
                        });
                        
                        var h = DIM.outerHeight(ibottom);
                        
                        DOM.styles(ibottom, {
                            'z-index': -1,
                            'top': -h,
                            'visibility': 'visible'
                        });
                        
                        FX.animate(ibottom, {
                            'top': 0
                        }, ss, function() {
                            ibottom.style.zIndex = 0;
                        });
                    }
                    
                    if (t.closelink) {
                        DOM.show(t.closelink);
                    }
                }
                // Animate fade in (not for IE if media)
                if ((JCEMediaBox.isIE && t.active.type == 'media') || JCEMediaBox.isIE6) {
                    DOM.style(t.content, 'opacity', 1);
                    showInfo();
                } else {
                    FX.animate(t.content, {
                        'opacity': 1
                    }, fs, function() {
                        showInfo();
                    });
                }
            });
        },
        
        /**
         * Close the popup window. Destroy all objects
         */
        close: function() {
            var t = this, each = JCEMediaBox.each, DOM = JCEMediaBox.DOM;
            // Destroy objects
            each(['img', 'object', 'iframe', 'ajax'], function(i, v) {
                t[v] = null;
            });
            // Hide closelink
            if (this.closelink) {
                DOM.hide(this.closelink);
            }
            // Empty content div
            this.content.innerHTML = '';
            // Hide info div
            each(['top', 'bottom'], function(i, v) {
                if (t['info-' + v]) {
                    DOM.hide(t['info-' + v]);
                }
            });
            DOM.remove(this.frame);
            
            // Fade out overlay
            
            if (this.overlay) {
                if (JCEMediaBox.isIE6) {
                    // Remove event bindings
                    this.bind();
                    // Remove body, ie: popup
                    DOM.remove(this.page);
                } else {
                    JCEMediaBox.FX.animate(this.overlay, {
                        'opacity': 0
                    }, JCEMediaBox.options.popup.fadespeed, function() {
                        t.bind();
                        DOM.remove(t.page);
                    });
                }
            } else {
                DOM.remove(this.page);
            }
            return false;
        }
    }
})();
// Cleanup events
JCEMediaBox.Event.addUnload(function() {
    JCEMediaBox.Event.destroy();
});