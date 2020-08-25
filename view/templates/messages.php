<?php foreach(get_errors() as $error){ ?>
  <p class="alert alert-danger"><span><?php print hsc($error); ?></span></p>
<?php } ?>
<?php foreach(get_messages() as $message){ ?>
  <p class="alert alert-success"><span><?php print hsc($message); ?></span></p>
<?php } ?>