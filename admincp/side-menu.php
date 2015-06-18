<?php
 $cpage = basename($_SERVER['PHP_SELF']);

	
?>	


<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="">
	<tr align="left">
		<td  height="19" valign="top" class="error" align="left">
		<?php
         if ( $cpage == "main.php" )  
	      {
		?>
            Home
		<?php
		  }
	     else
		  {
		 ?>
          <a href="main.php">Home</a>
          <?php
		  }
		  ?>
          </td>
	</tr>
        <tr align="left">
            <td  height="19" valign="top" class="error" >
            <?php
             if ( $cpage == "manage-country.php" || $cpage == "add_country.php" || $cpage == "edit_country.php")  
              {
            ?>
                Manage Country
            <?php
              }
             else
              {
             ?>
                <a href="manage-country.php">Manage Country</a>
              <?php
              }
              ?>
            </td>
        </tr>
        <tr align="left">
            <td  height="19" valign="top" class="error" >
            <?php
             if ( $cpage == "manage-organization.php" || $cpage == "add_organization.php" || $cpage == "edit_organization.php")  
              {
            ?>
                Manage Organization
            <?php
              }
             else
              {
             ?>
                <a href="manage-organization.php">Manage Organization</a>
              <?php
              }
              ?>
            </td>
        </tr>
   	 	<tr align="left">
            <td  height="19" valign="top" class="error" >
            <?php
             if ( $cpage == "manage-visualization-type.php" || $cpage == "add_visualization_type.php" || $cpage == "edit_visualization_type.php")  
              {
            ?>
                Manage Visualization Type
            <?php
              }
             else
              {
             ?>
                <a href="manage-visualization-type.php">Manage Visualization Type</a>
              <?php
              }
              ?>
            </td>
        </tr>
        <tr align="left">
            <td  height="19" valign="top" class="error" >
            <?php
             if ( $cpage == "manage-group.php" || $cpage == "add_group.php" || $cpage == "edit_group.php")  
              {
            ?>
                Manage Group
            <?php
              }
             else
              {
             ?>
                <a href="manage-group.php">Manage Group</a>
              <?php
              }
              ?>
            </td>
        </tr>
        <tr align="left">
            <td  height="19" valign="top" class="error" >
            <?php
             if ( $cpage == "manage-layers-level.php" || $cpage == "add_layers_level.php" || $cpage == "edit_layers_level.php")  
              {
            ?>
            
              Manage layers level
          <?php
              }
             else
              {
             ?>
                <a href="manage-layers-level.php">Manage layers level</a>
              <?php
              }
              ?>
            </td>
        </tr>
        <tr align="left">
            <td  height="19" valign="top" class="error" >
            <?php
             if ( $cpage == "manage-user.php" || $cpage == "add_user.php" || $cpage == "edit_user.php" || $cpage == "manage-user-country.php" || $cpage == "manage-user-group.php")  
              {
            ?>
                Manage user
            <?php
              }
             else
              {
             ?>
                <a href="manage-user.php">Manage user</a>
              <?php
              }
              ?>
            </td>
        </tr>
        <tr align="left">
            <td  height="19" valign="top" class="error" >
            <?php
             if ( $cpage == "manage-layers.php" || $cpage == "add_layers.php" || $cpage == "edit_layers.php" )  
              {
            ?>
                Manage layers
            <?php
              }
             else
              {
             ?>
                <a href="manage-layers.php">Manage layers</a>
              <?php
              }
              ?>
            </td>
        </tr>
       <tr align="left">
		
	</tr>
       <tr align="left">
		 <td height="19" valign="top" class="error">
         <?php
         if ( $cpage == "change-password.php" )  
	      {
		?>
           Change Password
		<?php
		  }
	     else
		  {
		 ?>
        	<a href="change-password.php">Change Password</a> 
          <?php
		  }
		  ?>
         </td>
	</tr>
	<tr align="left">
		 <td height="19" valign="top" class="error"><a href="logout.php">Logout</a> </td>
	</tr>
	
	<tr>
		 <td height="37" valign="top">&nbsp;</td>
	</tr>
</table>
