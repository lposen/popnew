<?php
if (strrpos($_SERVER['REQUEST_URI'],'impact')) {
  header ("location: impact.html");
}
else if (strrpos($_SERVER['REQUEST_URI'],'sidebar')){
  header ("location: sidebar.html");
}
else {
  header ("location: blank.html");
}
?>