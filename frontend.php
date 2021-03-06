<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();
?>
<html><head><body>
<?php
echo"Hello, ". $_SESSION['name']."!" . "<br>";
echo"Your email address is " . $_SESSION['email']."." ."<br>";
?>
<br><table><tr><td>
<b>Folders:</b><br>
<select id="folderList" size="15" style="width: 280px" ondblclick="makeSendPayload(this.value)">
</select>
</td><td>
<b>Files:</b><br>
<select id="fileList" size="15" style="width: 280px">
</select>
</td></tr></table><br>
<script type="text/javascript">

function httpPost(url, payload, cb) {
   var request = new XMLHttpRequest();
   request.onreadystatechange = function() { // Anonymous function
      if(request.readyState == 4) {
         if(request.status == 200)
            cb(request.responseText);
         else{
            if(request.status == 0 && request.statusText.length == 0)
               alert("Request blocked by same-origin policy");
            else
               alert("Server returned status " + request.status +
                  ", " + request.statusText);
         }
      }
   }
   request.open('post', url, true);
   request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   request.send(payload);
}

function cb(response) { // take whatever server says, parse it
   // alert("The back end server replied: " + response);
   var parsedvalue = JSON.parse(response);
   addOptions(parsedvalue);
}

function addOptions(jsonobj) {
   var folder = document.getElementById("folderList");
   var flist = jsonobj.folders;
   var back = document.createElement("option");
   back.text = "..";
   var temp = jsonobj.dir;
   back.value = temp.substring(0, temp.lastIndexOf("/"));
   // alert(temp);
   // alert(back.value);
   folder.add(back);

   for(var i in flist){
      var option = document.createElement("option");
      var tmp = flist[i];
      var tmp2 = tmp.split("/").pop();
      option.text = tmp2;
      option.value = tmp;
      folder.add(option);
   }

   var files = document.getElementById("fileList");
   var filist = jsonobj.files;
   for(var i in filist){
      var option = document.createElement("option");
      var tmp = filist[i];
      tmp = tmp.split("/").pop();
      option.text = tmp;
      files.add(option);
   }
   
}

function makeSendPayload(select){
   var folder = document.getElementById("folderList");
   var length = folder.size;
   for(var i = 0; i<length; i++){
      folder.remove(folder.i);
   }

   var files = document.getElementById("fileList");
   length = files.size;
   for(var i = 0; i<length; i++){
      files.remove(files.i);
   }

   httpPost("backend.php", select, cb);
}

httpPost("backend.php", null, cb);

</script>

<form name  = "logoutForm" action = "index.php" method = "post">
   <input type = "submit" name = "exit" value = "Logout" />
</form>

</body></head></html>
