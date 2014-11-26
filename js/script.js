
/**
 * to add items to shopping cart
 * @param id
 */
function cart(id)
{
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("cart").innerHTML='';
        }
    }
    xmlhttp.open("POST","cart.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id);
}


/**
 * mouse over effect to items
 */
$(document).ready(function(){
    $("#over").css("border", "1px solid #fff");

    $("#over").mouseover(function(){
        $(this).css({"border":"1px solid #f1f1f1", "boxShadow":"1px 1px 3px #f1f1f1"});
    });

    $("#over").mouseout(function(){
        $(this).css({"border":"1px solid #fff", "boxShadow":"0px 0px 0px"});
    });
});