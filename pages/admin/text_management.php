<?php
if (isset($_POST['text']))
{
  
}
else {
  echo '<form action="index.php?page=text_management" method="post">
    <textarea name="text" style="width:95%;height:200px;border: 1px solid #5970B2; resize:none;"></textarea>
    <input id="bouton_submit" type="image" style="margin-left:5px;width:100%;height:28px;background:none;box-shadow: none;" style="width:39px;height:28px;" width="100%" height="100%" src="./images/ok.png" />
  </form>';
}