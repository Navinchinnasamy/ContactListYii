<?php if ($contacts !== null) {?>
<table  width="100%" border="1" cellpadding="2">
	<tr><td colspan="9" align="center"><font color="#0033CC" size="10px">Contacts List</font></td></tr>
	<tr>
            <th width="4%" bgcolor="#9BDEFF" align="center">S.No</th>
            <th width="9%" bgcolor="#9BDEFF" align="left">First Name</th>
            <th width="9%" bgcolor="#9BDEFF" align="left">Last Name</th>
            <th width="16%" bgcolor="#9BDEFF" align="left">E-Mail</th>
            <th width="8%" bgcolor="#9BDEFF" align="center">Date of Birth</th>
            <th width="6%" bgcolor="#9BDEFF" align="left">Gender</th>
            <th width="8%" bgcolor="#9BDEFF" align="left">City</th>
            <th width="9%" bgcolor="#9BDEFF" align="left">State</th>
            <th width="5%" bgcolor="#9BDEFF" align="center">ZIP</th>
            <th width="20%" bgcolor="#9BDEFF" align="left">Hobbies</th>
            <th width="6%" bgcolor="#9BDEFF" align="left">Status</th>
 	</tr>
	<?php $i = 1; foreach($contacts as $row): ?>
	<tr>
            <td align="center">
                <?php echo $i++; ?>
            </td>
            <td align="left">
                <?php echo ucfirst($row->first_name); ?>
            </td>
            <td align="left">
                <?php echo ucfirst($row->last_name); ?>
            </td>
            <td align="left">
                <?php echo $row->email; ?>
            </td>
            <td align="center">
                <?php echo $row->dob; ?>
            </td>
            <td align="left">
                <?php echo $row->gender; ?>
            </td>
            <td align="left">
                <?php echo ucfirst($row->city); ?>
            </td>
            <td align="left">
                <?php echo $row->state; ?>
            </td>	
            <td align="center">
                <?php echo $row->zip; ?>
            </td>	
            <td align="left">
                <?php echo $row->hobbies; ?>
            </td>	
            <td align="left">
                <?php echo ucfirst($row->status); ?>
            </td>
       	</tr>
     <?php endforeach; ?>
<?php } else { ?>
	<tr>
		<td colspan="11"><font color="#FF3300" size="10px">No Record's Found</font></td>
	</tr>
<?php }?>
</table>