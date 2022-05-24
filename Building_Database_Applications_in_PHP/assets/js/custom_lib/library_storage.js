// Create a storage Prototype object:
let storagePrototype = {
    get:function(){
        let str =  localStorage.getItem(this.key) || "";
        return (str === "")? [] : str.split("-");
    },
    set:function(arr){
        if(Array.isArray(arr)){
            let str = arr.join("-");
            localStorage.setItem(this.key,str);
        }
    },
    clear: function(){
        localStorage.setItem(this.key,"");
    }
};

// Create a factory function to build the storage object:
let getTaskStorage = function(key) {
    let storage = Object.create(storagePrototype);
    storage.key = key; // Set the key of the record
    return storage;    // Return Object reference.
};