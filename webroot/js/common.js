function PreviewImage(str,str1){
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById(str).files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById(str1).src = oFREvent.target.result;
        };
    }
$(document).ready(function(){
	setTimeout(function(){$("#flashMessage").fadeOut()},3500);
	});