// console.log(" web school")
// console.table(["elzero ", "mustafa" , "sara" , "ahmad" ,"alaa"])
// console.log("ali ghanem")
// console.log(typeof "ali ghanem");
// console.log(typeof 5000);
// console.log(typeof 382.99);
// let theTitle = "elzero",theDescriptions= "elzero web school",theDate="25/10"
// let container=`
// <div class="card">
//     <h3>${theTitle}</h3>
//     <p>${theDescriptions}</p>
//     <span>${theDate}</span>
// </div>

// `
// document.write(container)
// let a = "10";
// let b = 20;
// console.log(a + b);
// console.log("hello world");
// let a = 100;
// let b = 2_00.5;
// let st ="Elzero web school";
// console.log(a.slice(0,6));
// console.log(a.)
// (a<10)? console.log(10):(a >= 10 && a<=40 )? console.log("10 to 40");
// let st ="elzero web school ";
// if(st.includes("w")){
//     console.log("good")
// } 
// let myArray = [ 10 , 20 , 30 , 100 ];
// console.log(myArray.sort());
// let myFriends = [1 , 2 , "osama" , "ahmed" , "sayed", "ali"];
// let onlyNames = ["ali"];

// for (let i = 0; i < myFriends.length; i++ ){
//     if (typeof myFriends[i] === "string"){
//         onlyNames.push(myFriends[i])
//     }
// }
// console.log("hello")
// console.log(onlyNames)
// function show-toggle-menubar({
//     document.getElementsByClassName("toggle-menu").style
// })

function Message() {
    document.getElementById('Message').style.display = "none";
}

var toggle = document.getElementById('link');
var show =0;
function show_toggle(){
    if(show == 1)
    {
        toggle.style.display="none"
        show = 0;
    }
    else{
        toggle.style.display="flex" ;
        toggle.style.position="absolute" ;
        toggle.style.top="80%" ;
        toggle.style.left="0" ;
        toggle.style.width="100%";
        toggle.style.color="red" ;
        toggle.style.flexDirection="column";
        toggle.style.backgroundColor="grey";
        show = 1;
    }
}
var beauty=document.getElementById("store");
var pharma=document.getElementById("ph");
var certification=document.getElementById("certification")
var submit=document.getElementById("submit")
var sign=document.getElementById("sign")
var cart= document.getElementById("cart")
var test= document.getElementById("test")
var carte= document.getElementById("carte")
var carte2= document.getElementById("carte2")
var carte3= document.getElementById("carte3")
// var companyremove= document.getElementById("companyremove")

function insert(){
    certification.style.right="0";
    certification.style.width="208px";
    certification.style.top="64%";
    submit.style.bottom="90%";
    sign.style.top="20%";
}
function light(){
    cart.style.color="white";
    cart.style.scale="1.3"
    setTimeout(function(){ 
    cart.style.scale="1.0";
    },450);
};

function gohome(){
    window.open("index.html")
}
function remove1(){
    carte.style.display="none";
}
function remove2(){
    carte2.style.display="none";
}
function remove3(){
    carte3.style.display="none";
}
function deleteRow(btn){
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
function goedit(){
    window.open("admin-edit-medicine.html")
}