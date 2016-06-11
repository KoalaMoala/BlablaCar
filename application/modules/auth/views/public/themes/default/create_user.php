<h1><?php echo lang('create_user_heading');?></h1>
<p><?php echo lang('create_user_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_user");?>

      <p>
            First Name <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            Last Name <br />
            <?php echo form_input($last_name);?>
      </p>

      <?php
      if($identity_column!=='email') {
          echo '<p>';
          echo 'UserName';
          echo '<br />';
          echo form_error('identity');
          echo form_input($identity);
          echo '</p>';
      }
      ?>

      <p>
            Company <br />
            <?php echo form_input($company);?>
      </p>

      <p>
            Email <br />
            <?php echo form_input($email);?>
      </p>

      <p>
            Phone <br />
            <?php echo form_input($phone);?>
      </p>

      <p>
            Password <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            Confirm Password <br />
            <?php echo form_input($password_confirm);?>
      </p>


      <p><?php echo form_submit('submit', 'Create account');?></p>

<?php echo form_close();?>
