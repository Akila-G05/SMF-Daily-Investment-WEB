let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
arrowParent.classList.toggle("showMenu");
    });
}
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
});



// Sample data
const data = {
    labels: ['Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5'],
    datasets: [{
      label: 'Dataset',
      data: [100, 50, 70, 150, 120],
      backgroundColor: 'rgba(0, 123, 255, 0.2)',
      borderColor: 'rgba(0, 123, 255, 1)',
      borderWidth: 2,
      pointRadius: 4,
      pointBackgroundColor: 'rgba(0, 123, 255, 1)',
      pointBorderColor: '#fff',
      pointHoverRadius: 6,
      pointHoverBackgroundColor: 'rgba(0, 123, 255, 1)',
      pointHoverBorderColor: '#fff'
    }]
  };

  // Create the chart
  const ctx = document.getElementById('line-chart').getContext('2d');
  const chart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
      responsive: true,
      scales: {
        x: {
          display: true,
          title: {
            display: true,
          }
        },
        y: {
          display: true,
          title: {
            display: true,
          }
        }
      }
    }
  });



function changeView(){

    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");

}

function signUp(){

  var uname = document.getElementById("uname");
  var email = document.getElementById("email");
  var pw = document.getElementById("pw");
  var repw = document.getElementById("repw");
  var bid = document.getElementById("bid");
  var mobile = document.getElementById("mobile");
  var gender = document.getElementById("gender");
  var rcode = document.getElementById("rcode");

  var f = new FormData();
  f.append("u",uname.value);
  f.append("e",email.value);
  f.append("pw",pw.value);
  f.append("repw",repw.value);
  f.append("bid",bid.value);
  f.append("m",mobile.value);
  f.append("g",gender.value);
  f.append("rc",rcode.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location = "index.php";
      }else{
        document.getElementById("msg").innerHTML=t;
        document.getElementById("msgdiv").className="d-block";
      }

    }
  }

  r.open("POST","signUpProcess.php",true);
  r.send(f);

}

function signIn(){
    
  var email = document.getElementById("email");
  var password = document.getElementById("pw");

  var r = new XMLHttpRequest();

  var f = new FormData();
  f.append("e",email.value);
  f.append("p",password.value);

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;

      if(t == "Success"){
        window.location = "dashboard.php";
      }else if(t == "Success2"){
        window.location = "dashboard.php";
      }else{
        document.getElementById("msg").innerHTML=t;
        document.getElementById("msgdiv").className="d-block";
      }

    }
  };

  r.open("POST","signInProcess.php",true);
  r.send(f);

}

var fm;
function forgotPw(){
    
  var email = document.getElementById("email").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
      if(r.readyState == 4 && r.status == 200){
          var t = r.responseText;
          if(t == "Success"){
              var m = document.getElementById("forgotPasswordModal");
              bm = new bootstrap.Modal(m);
              bm.show();
          }else{
              document.getElementById("msg2").innerHTML=t;
              document.getElementById("msgdiv2").className="d-block";;
          }
      }
  }

  r.open("GET","forgotPasswordProcess.php?e="+email,true);
  r.send();

}

function ShowPassword(){

  var i = document.getElementById("npi");
  var eye = document.getElementById("e1");

  if(i.type=="password"){
      i.type="text";
      eye.className = "bi bi-eye-fill";
  }else{
      i.type="password";
      eye.className ="bi bi-eye-slash-fill";
  }

}

function ShowPassword2(){
  
  var i = document.getElementById("rnp");
  var eye = document.getElementById("e2");

  if(i.type=="password"){
      i.type="text";
      eye.className = "bi bi-eye-fill";
  }else{
      i.type="password";
      eye.className ="bi bi-eye-slash-fill";
  }

}

function resetpw(){

  var email = document.getElementById("email");
  var np = document.getElementById("npi");
  var rnp = document.getElementById("rnp");
  var vcode = document.getElementById("vc");

  var f = new FormData();
  f.append("e",email.value);
  f.append("n",np.value);
  f.append("r",rnp.value);
  f.append("v",vcode.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "success"){

          bm.hide();
          alert("Password reset Success");

      }else{
          alert(t);
      }
    }
  }

  r.open("POST","resetPasswordProcess.php",true);
  r.send(f);

} 

function signout(){

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
          window.location= "index.php";
      }
  }
  }

  r.open("GET","signoutProcess.php",true);
  r.send();

}

var pam;
function pkgModal(id){

  var m = document.getElementById("pkgModal" + id);
  var pam = new bootstrap.Modal(m);
  pam.show();

}

function uploadImage(){

  var file = document.getElementById("uploadimg");

  file.onchange = function(){
      var file1 = this.files[0];
      var url = window.URL.createObjectURL(file1);
      view.src = url;
  }

}

function payNow(id){

  var ptype = document.getElementById("ptype" + id);
  var image = document.getElementById("uploadimg");

  var f = new FormData();
  f.append("id",id);
  f.append("ptype",ptype.value);

  if(image.files.length == 1){

    f.append("image",image.files[0]);

  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      alert(t);

      if(t = "Success"){
        window.location.reload();
      }

    }
  }

  r.open("POST","payPkgProcess.php",true);
  r.send(f);

}



function adminSignin(){

  var e = document.getElementById("email");
  var p = document.getElementById("pw");

  var f = new FormData();
  f.append("e",e.value);
  f.append("p",p.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location = "adminPannel.php";
      }else{
        alert(t);
      }

    }
  }

  r.open("POST","adminSigninProcess.php",true);
  r.send(f);

}

function changeImage(){

  var view = document.getElementById("viewImg");
  var file1 = document.getElementById("profileimg");

  file1.onchange = function(){
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);
    view.src = url;
  }

}

function updateProfile(){

  var uname = document.getElementById("uname");
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var city = document.getElementById("city");
  var country = document.getElementById("country");
  var pcode = document.getElementById("pcode");
  var image = document.getElementById("profileimg");

  var f = new FormData();

  f.append("un",uname.value);
  f.append("m",mobile.value);
  f.append("l1",line1.value);
  f.append("c",city.value);
  f.append("country",country.value);
  f.append("pc",pcode.value);

  if(image.files.length == 1){

    confirm("Are you sure? You don't want to update Profile Image."); 

    f.append("image",image.files[0]);

  }

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }else{
        alert(t);
      }
    }
  }

  r.open("POST","updateProfileProcess.php",true);
  r.send(f);

}

function withdraw(){

  var amount = document.getElementById("amount").value;
  
  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }else {
        alert(t);
      }

    }
  }

  r.open("GET","withdrawProcess.php?amount="+amount,true);
  r.send();

}

function deleteWithdraw(id){

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }else {
        alert(t);
      }

    }
  }

  r.open("GET","deleteWithdrawProcess.php?id="+id,true);
  r.send();

}

function transfer(){

  var e = document.getElementById("email");
  var b = document.getElementById("bid");
  var a = document.getElementById("amount");

  var f = new FormData();
  f.append("e",e.value);
  f.append("b",b.value);
  f.append("a",a.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }else{
        alert(t);
      }

    }
  }

  r.open("POST","fundTransferProcess.php",true);
  r.send(f);

}

function deleteFundTransfer(id){

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }else {
        alert(t);
      }

    }
  }

  r.open("GET","deleteFundTransferProcess.php?id="+id,true);
  r.send();

}

function changeUserStatus(email){

  var s = document.getElementById("status");

  var f = new FormData();
  f.append("s",s.value);
  f.append("e",email);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }else{
        alert(t);
      }

    }
  }

  r.open("POST","changeUserStatusProcess.php",true);
  r.send(f);

}

function findusers(x){

  var txt = document.getElementById("text").value;

  var f = new FormData();
  f.append("txt",txt);
  f.append("page",x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      
      document.getElementById("result").innerHTML = t;
      
    }
  }

  r.open("POST","findUsersProcess.php",true);
  r.send(f);

}

var dpm;
function deletePkgModal(id){

  var m = document.getElementById("deletePkgModal" + id);
  dpm = new bootstrap.Modal(m);
  dpm.show();

}

function deletePkg(id){

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      
      if(t == "Success"){
        alert("Package removed.")
        window.location.reload();
      }else{
        alert(t);
      }

    }
  }

  r.open("GET","deletePkgProcess.php?id="+id,true);
  r.send();

}

var apm;
function openAddPkgModel(id){

  var m = document.getElementById("addPkgModal" + id);
  apm = new bootstrap.Modal(m);
  apm.show();

}

function addNewPkg(){

  var pn = document.getElementById("pname").value;
  var p = document.getElementById("price").value;
  var fee = document.getElementById("fee").value;

  var f = new FormData();
  f.append("pn",pn);
  f.append("p",p);
  f.append("fee",fee);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      
      if(t == "Success"){
        alert("Package Aded.")
        window.location.reload();
      }else{
        alert(t);
      }
      
    }
  }

  r.open("POST","addNewPkgProcess.php",true);
  r.send(f);

}

function confirmWStatus(id){

  var s = document.getElementById("status");

  var f = new FormData();
  f.append("id", id);
  f.append("s",s.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      
      if(t == "Successdone"){
        alert("Confirmed")
        window.location.reload();
      }else if(t == "done"){
        window.location.reload();
      }else{
        alert(t);
      }

    }
  }

  r.open("POST","confirmWStatusProcess.php",true);
  r.send(f);

}

function confirmFtStatus(id){

  var s = document.getElementById("status");

  var f = new FormData();
  f.append("id",id);
  f.append("s",s.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;

      if(t == "Successdone"){
        window.location.reload();
      }else if(t == "done"){
        window.location.reload();
      }else{
        alert(t);
      }

    }
  }

  r.open("POST","confirmFtStatusProcess.php",true);
  r.send(f);

}








function confirmPStatus(id){

  var s = document.getElementById("status" + id);

  var f = new FormData();
  f.append("id", id);
  f.append("s",s.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;

      if(t == "0"){
        window.location.reload();

      }else if(t == "1"){

        alert("Confirm");
        window.location.reload();

      }else if(t == "2"){
        window.location.reload();
        alert("Failed");
      
      }else{
        alert(t);
      }
      
    }
  }

  r.open("POST","confirmPStatusProcess.php",true);
  r.send(f);

}


var fapm;
function changeAdminPwModel(){

  var m = document.getElementById("forgotAdminPasswordModal");
  fapm = new bootstrap.Modal(m);

  var email = document.getElementById("email").value;
  var pw = document.getElementById("pw").value;

  var f = new FormData();
  f.append("e",email);
  f.append("p",pw);

  var r = new XMLHttpRequest();
  
  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        fapm.show();
      }else{
        alert(t);
      }

    }
  }
  
  r.open("POST","sendAdminPwVCode.php",true);
  r.send(f);

}

function changeAdminPw(){

  var vc = document.getElementById("vcode");
  var np = document.getElementById("np");
  var rp = document.getElementById("rp");

  var f = new FormData();
  f.append("vc", vc.value);
  f.append("np", np.value);
  f.append("rp", rp.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState = 4){
      var t  = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }else{
        alert(t);
      }

    }
  }

  r.open("POST","changeAdminPwProcess.php", true);
  r.send(f);

}

var dum;
function deleteUserModal(email){

  var m = document.getElementById("deleteUserModal" + email);
  dum = new bootstrap.Modal(m);
  dum.show();

}

function deleteUser(email){
  
  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        alert("User Deleted");
        dum.hide();
        window.location.reload();
      }else{
        alert(t);
      }
      
    }
  }

  r.open("GET","deleteUserProcess.php?email="+email,true);
  r.send();

}

function changeWalletBalance(email){

  var balance = document.getElementById("balance" + email).value;

  var f = new FormData();
  f.append("balance", balance);
  f.append("email", email);

  var result = confirm("Are you sure you want to proceed?");

  if (result === true) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
      if(r.readyState == 4 && r.status == 200){
        var t = r.responseText;
        
        if(t == "Success"){
          window.location.reload();
        }else{
          alert(t);
        }

      }
    }

    r.open("POST","changeWalletBalanceProcess.php",true);
    r.send(f);
  }else{
    window.location.reload();
  }

}

function loadType(){

  var cid = document.getElementById("category").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      var t = r.responseText;
      // alert(t);
      document.getElementById("type").innerHTML = t;

    }
  }

  r.open("GET", "loadBillType.php?c=" + cid, true);
  r.send();

}

function convert(lkr){

  var amount = document.getElementById("amount").value;

  var converted = amount / lkr;

  document.getElementById("usd").value = converted.toFixed(2);

}

function payBill(){

  var cid = document.getElementById("category").value;
  var type = document.getElementById("type").value;
  var number = document.getElementById("number").value;
  var name = document.getElementById("name").value;
  var amount = document.getElementById("amount").value;
  var usd = document.getElementById("usd").value;

  var f = new FormData();
  f.append("cid", cid);
  f.append("type", type);
  f.append("number", number);
  f.append("name", name);
  f.append("amount", amount);
  f.append("usd", usd);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t = "Success"){
        
        window.location.reload();
      }else{
        alert(t);
      }

    }
  }

  r.open("POST","payBillProcess.php",true);
  r.send(f);


}

function deletePayBill(id){

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        alert("Deleted");
        window.location.reload();
      }else{
        alert(t);
      }
      
    }
  }

  r.open("GET","deleteBillProcess.php?id="+id,true);
  r.send();
  
}

function chageBillStatusProcess(id){

  var status = document.getElementById("bStatus" + id).value;

  var f = new FormData();
  f.append("s", status);
  f.append("id", id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }else{
        alert(t);
      }

    }
  }

  r.open("POST","changeBillStatusProcess.php",true);
  r.send(f);


}

function chageBillTypeStatusProcess(id){

  var status = document.getElementById("bTStatus" + id).value;

  var f = new FormData();
  f.append("s", status);
  f.append("id", id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }else{
        alert(t);
      }

    }
  }

  r.open("POST","changeBillTypeStatusProcess.php",true);
  r.send(f);

}

function deleteBillType(id){

  var r = new XMLHttpRequest();

  var result = confirm("Are you sure you want to proceed?");

  if (result === true) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
      if(r.readyState == 4 && r.status == 200){
        var t = r.responseText;
        
        if(t == "Success"){
          alert("Deleted");
          window.location.reload();
        }else{
          alert(t);
        }
        
      }
    }

    r.open("GET","deleteBillTypeProcess.php?id="+id,true);
    r.send();

  }
  
}

function findBill(x){

  var txt = document.getElementById("text").value;

  var f = new FormData();
  f.append("txt",txt);
  f.append("page",x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4){
      var t = r.responseText;
      
      document.getElementById("result").innerHTML = t;
      
    }
  }

  r.open("POST","findUsersProcess.php",true);
  r.send(f);

}

function changeUsdValue(){

  var lkr = document.getElementById("lkr").value;

  var r = new XMLHttpRequest();

  r.onreadystatechange = function(){
    if(r.readyState == 4 && r.status == 200){
      var t = r.responseText;
      
      if(t == "Success"){
        window.location.reload();
      }else{
        alert(t);
      }
      
    }
  }

  r.open("GET","changeUsdValueProcess.php?lkr="+lkr,true);
  r.send();

}

function changePkgBalance(id){

  var balance = document.getElementById("balance" + id).value;

  var f = new FormData();
  f.append("balance", balance);
  f.append("id", id);

  var result = confirm("Are you sure you want to proceed?");

  if (result === true) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
      if(r.readyState == 4 && r.status == 200){
        var t = r.responseText;
        
        if(t == "Success"){
          window.location.reload();
        }else{
          alert(t);
        }

      }
    }

    r.open("POST","changePkgBalanceProcess.php",true);
    r.send(f);
  }else{
    window.location.reload();
  }

}