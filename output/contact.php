<link rel="stylesheet" href="/myfw/public/css/contact.css">
<div class="container">
  <form action="/myfw/contact/<?=$id?>" method="post">

    <label for="fname">First Name</label>
    <input type="text" id="fname" name="fullname" placeholder="Your fullname..">

    <label for="email">E-Mail</label>
    <input type="text" id="email" name="email" placeholder="Your email..">

    <label for="subject">Subject</label>
    <textarea id="subject" name="message" placeholder="<?="Dear, " . $fullname ?>" style="height:200px"></textarea>

    <input type="submit" value="Submit">

  </form>
</div>