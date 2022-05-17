/**
 * This library creates an object literal named evt with methods named attach, detach, preventDefault.
 * @type {{detach: evt.detach, attach: evt.attach, preventDefault: evt.preventDefault}}
 */
let evt = {
  attach : function (node, eventName, func) {
      if (node.addEventListener) node.addEventListener(eventName, func);
      else node.attachEvent("on" + eventName, func);
  },
  detach : function (node, eventName, func) {
      if (node.removeEventListener) node.removeEventListener(eventName, func);
      else node.detachEvent("on" + eventName, func);
  },
  preventDefault: function (e) {
      e = e || window.event;
      if (e.preventDefault) e.preventDefault(); // For most browsers.
      else e.returnValue = false;               // For older browsers.
  }
};