<div>
	Index View
	<br />
	<ul>
		<?php
			if (isset($this->users)) {
				for ($i=0; $i<sizeof($this->users); $i++) {		
		?>
		<li>
			<a href="?url=index/details/<?= $this->users[$i]['UserId']; ?>">
				<?= $this->users[$i]['UserId'] . ' - ' . $this->users[$i]['UserName']; ?>
			</a>
			<button data-value="<?= $this->users[$i]['UserId']; ?>">Ajax Details</button>
		</li>
		<?php
				}
			}
		?>
	</ul>
</div>