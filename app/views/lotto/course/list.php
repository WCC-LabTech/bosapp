
<table border="1">

<th>Course Title</th>
<th>CRN</th>
<th>Status</th>
<th>labaide</th>
<!-- <th></th><th></th><th></th><th></th><th></th> -->

<?php

	foreach ($courses as $course){
		echo "<tr>";
		echo "<td>".$course->course_title."</td>";
		echo "<td>".$course->crn."</td>";
		echo "<td>".$course->status_code."</td>";
		echo "<td>".$course->labaides."</td>";
		echo "</tr>";
	}

?>

</table>

<!--

<form>
	<table border = "3">
		<input type="hidden" name="id" value="<?= $course->id ?>"/>
		<tr>
			<td> Building </td><td> <input type="text" name="id" value="<?= $course->building ?>"/> </td>
		</tr>
		<tr>
			<td> Course Number </td><td> <input type="text" name="id" value="<?= $course->course_number ?>"/> </td>
		</tr>
		<tr>
			<td> Credit Hours </td><td> <input type="text" name="id" value="<?= $course->credit_hours ?>"/> </td>
		</tr>

		<tr>
			<td> Days in the week </td><td> <input type="text" name="id" value="<?= $course->days_in_week ?>"/> </td>
		</tr>
		<tr>
			<td> End Date </td><td> <input type="text" name="id" value="<?= $course->end_date ?>"/> </td>
		</tr>
		<tr>
			<td> End Time </td><td> <input type="text" name="id" value="<?= $course->end_time ?>"/> </td>
		</tr>
		<tr>
			<td> Instructor </td><td> <input type="text" name="id" value="<?= $course->instructor ?>"/> </td>
		</tr>
		<tr>
			<td> Part of Term </td><td> <input type="text" name="id" value="<?= $course->part_of_term ?>"/> </td>
		</tr>
		<tr>
			<td> Room Number </td><td> <input type="text" name="id" value="<?= $course->room_number ?>"/> </td>
		</tr>
		<tr>
			<td> Section </td><td> <input type="text" name="id" value="<?= $course->section ?>"/> </td>
		</tr>
		<tr>
			<td> Start Date </td><td> <input type="text" name="id" value="<?= $course->start_date ?>"/> </td>
		</tr>
		<tr>
			<td> Start Time </td><td> <input type="text" name="id" value="<?= $course->start_time ?>"/> </td>
		</tr>
		<tr>
			<td> Subject Code </td><td> <input type="text" name="id" value="<?= $course->subject_code ?>"/> </td>
		</tr>
		<tr>
			<td> Term Code </td><td> <input type="text" name="id" value="<?= $course->term_code ?>"/> </td>
		</tr>
	</table>
</form>

-->