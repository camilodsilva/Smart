<div>
	Detail View
	<br />
    <?php
        if (isset($this->user)) {	
    ?>

    <label for="user_id">User Id</label>
    <input type="text" value="<?= $this->user[0]['UserId']; ?>">
    <br />

    <label for="user_id">User Name</label>
    <input type="text" value="<?= $this->user[0]['UserName']; ?>">
    <br />

    <label for="user_id">User Email</label>
    <input type="text" value="<?= $this->user[0]['UserEmail']; ?>">
    <br />
    
    <?php
        }
    ?>

    <a href="?url=index/index"><< Back</a>
</div>