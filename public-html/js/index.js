var uploadField = document.getElementById("file");

uploadField.onchange = function() {
    if(this.files[0].size > 5242880){
       alert("Cannot upload file larger than 5MB");
       this.value = "";
    };
};