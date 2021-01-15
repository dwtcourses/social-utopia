<?php
// Application Home Page
?>
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-sm-1 main_left_nav">
			<p><a data-toggle="collapse" href="#left_editor">Message Editor</a></p>
			<p><a data-toggle="collapse" href="#left_timeline">Social Media Timelines</a></p>
		</div>
		<div id="left_container_parent" class="col">
			<div class="collapse show" id="left_editor" data-parent="#left_container_parent">
				<div class="container-fluid">
					<div class="row">
						<div class="col">
							<?php
							// Load account selector controller
							require('./_inc/controller/accounts.editor.inc.php');
							?>
						</div>
					</div>
					<div class="row msgEditorViewContainer">
						<div class="col">
							<?php
							// Load Send Message Form controller
							require('./_inc/controller/sendMessageForm.editor.inc.php');
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="collapse" id="left_timeline" data-parent="#left_container_parent">
				<div class="container-fluid">
					<div class="timelinesContainer row" id="timelinesContainer"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Load from handling JavaScript -->
<script src="./_js/formGlobal.js"></script>