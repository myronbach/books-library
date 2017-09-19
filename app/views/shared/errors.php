<?php if(\core\Flash::instance()->hasMessage()):?>

    <?php foreach(\core\Flash::instance()->getMessage() as $msg):?>
    <div class="w3-panel w3-red w3-display-container">
  <span onclick="this.parentElement.style.display='none'"
        class="w3-button w3-red w3-large w3-display-topright">&times;</span>
        <p><?= $msg['message']?></p>
    </div>
    <?php endforeach;?>

<?php endif; ?>

