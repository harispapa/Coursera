"use strict";

// Set a namespace and a nested namespace creator function:
let myapp = {};
myapp.addNamespace = function (namespace){
  let currentName;
  let parent = this;
  let names = namespace.split(".");
  for (let i in names){
      currentName = names[i];
      parent[currentName] = parent[currentName] || {};
      parent = parent[currentName];
  }
  return this;
}.bind(myapp) // Use the bind method to make sure this method doesn't override.

// Create namespace method name:
/*
myapp.addNamespace("products").addNamespace("customers").addNamespace("utility.$")
     .addNamespace("utility.events").addNamespace("utility.storage").addNamespace("eventHandlers")
     .addNamespace("taskList"); */