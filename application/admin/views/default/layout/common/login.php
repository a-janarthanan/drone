<script language="javascript">
	function chk_login() {
		var username = document.getElementById("username").value;
		if(username == ''){
			alert("Please Enter Name");
			return false;
		}
		
		var password = document.getElementById("password").value;
		if(password == ''){
			alert("Please Enter Password");
			return false;
		}
		return true;
	}
</script>

<div id="content-login">

	<?php  if($msg == 'invalid'){  ?>
		<span class="message information" style="top:7px;"><strong>Username</strong> and/or <strong>Password</strong> are wrong</span>
	<?php } elseif($msg == 'valid'){  ?>
		<span class="message information" style="top:7px;"><strong>You have logged out successfully.</strong></span>
	<?php } ?>
	<!--<div class="logo"></div>-->
	
	<h2 class="header-login" style="text-transform:none;">Login   (Username : admin ;  Password : admin) </h2>
	
	<?php			 
		$attributes = array('name'=>'frmlogin','id'=>'box-login','onSubmit'=>'return chk_login(this);');
		echo form_open('home/login',$attributes);
	?>
		<p>
			<label class="req"> username </label>
			<br/>
			<input type="text" name="username" value="" id="username" />
		</p>
		<p>
			<label class="req"> password </label>
			<br/>
			<input type="password" name="password" value="" id="password" />
		</p>
		<!--<p class="fl">
			<input type="checkbox" name="remember" value="1" id="remember"/>
			<label class="rem"> Remember me </label>
		</p>-->
		<p class="fr">
			
			<input type="submit" name="Login" value="Login" class="button themed" id="login"/>
            <input type="reset" value="Reset" class="button black" />
		</p>
		
		<div class="clear"></div>
	</form>
    <?php echo anchor('home/forgot_password','Forgot password?',' title="Forgot password?" class="forgot"');?>
	
</div>