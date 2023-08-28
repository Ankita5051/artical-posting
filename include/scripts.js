//console.log("hiii");
const sbtn=document.getElementById("s-btn");
const sform=document.getElementById("signup");
const bcontaint=document.getElementById("banner-containt");
//console.log(sbtn);
sbtn.onclick=()=>{
 sform.style.display="block";
 bcontaint.style.display="none";
 login.style.display="none";
};

const lbtn=document.getElementById("l-btn");
const login=document.getElementById("login");

lbtn.onclick=()=>{
login.style.display="block";
sform.style.display="none";
bcontaint.style.display="none";
};

let current_url=window.location.href;
var urlPath=current_url.split("/");
var l=urlPath.length;

function edit_profile(){
    let current_url=window.location.href;
var urlPath=current_url.split("/");
var l=urlPath.length;
    urlPath[l-1]="home.php";
    window.location.href=urlPath.join("/");
    console.log(window.location.href);
}

function request(n){
    let current_url=window.location.href;
var urlPath=current_url.split("/");
var l=urlPath.length;
   urlPath[l-1]="include/update.php?action="+1+"&id="+n;
   window.location.href=urlPath.join("/");
    console.log(window.location.href);
};

function unfollow(n){
    let current_url=window.location.href;
var urlPath=current_url.split("/");
var l=urlPath.length;
   urlPath[l-1]="include/update.php?action="+0+"&id="+n;
   window.location.href=urlPath.join("/");
    console.log(window.location.href);
  };


  function cancel(n){
    let current_url=window.location.href;
var urlPath=current_url.split("/");
var l=urlPath.length;
   urlPath[l-1]="include/update.php?action="+2+"&id="+n;
   window.location.href=urlPath.join("/");
    console.log(window.location.href); 
  }

  function confirm(n){
    let current_url=window.location.href;
var urlPath=current_url.split("/");
var l=urlPath.length;
   urlPath[l-1]="include/update.php?action="+3+"&id="+n;
   window.location.href=urlPath.join("/");
    console.log(window.location.href); 
  }

 