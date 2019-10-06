<?php
// Message Editor / Composer View
?>
			<div class="container-fluid">
				<div class="row">
 					<div class="col-md-3">
					    <?php 
                            // Load account selector controller
                            require ('./_inc/controller/accounts.editor.inc.php'); 
                        ?>
 					</div>
  					<div class="col-md-9">
						<?php 
                            // Load Send Message Form controller
                            require ('./_inc/controller/sendMessageForm.editor.inc.php'); 
                        ?>
 					</div>
				</div>
				<script src="../_js/formGlobal.js"></script>
			</div>
