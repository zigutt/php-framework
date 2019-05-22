<link rel="stylesheet" href="/myfw/public/css/header.css">
<div class="header">
  <a href="#card" class="logo"><?=$fullname?></a>
  <div class="header-right">
    <a <?php if($page == 'Profile') echo("class='active'");?> href="/myfw/user/<?=$id?>">Profile card</a>
    <a <?php if($page == 'Contact') echo("class='active'");?> href="/myfw/contact/<?=$id?>">Contact</a>
  </div>
</div>