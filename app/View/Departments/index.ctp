
<h1>SEOkin Departments</h1>

<table>
    <tr>
        <th>Name</th>
        <th>Code</th>
        <th>Days Open</th>
        <th>Opening Time</th>
        <th>Closing Time</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

<?php foreach ($depts as $dept): ?>
    <tr>
        <td><?php echo $dept['Department']['name']; ?></td>
        <td><?php echo $dept['Department']['code']; ?></td>
        <td><?php echo $dept['Department']['days_open']; ?></td>
        <td><?php echo $dept['Department']['opening_time']; ?></td>
        <td><?php echo $dept['Department']['closing_time']; ?></td>
    </tr>
<?php endforeach; ?>

</table>