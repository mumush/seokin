
<h1>SEOkin Users</h1>

<table>
    <tr>
        <th>Title</th>
        <th>Wage</th>
        <th>User ID</th>
        <th>Department ID</th>
        <th>Status ID</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

<?php foreach ($descriptions as $desc): ?>
    <tr>
        <td><?php echo $desc['Description']['title']; ?></td>
        <td><?php echo $desc['Description']['wage']; ?></td>
        <td><?php echo $desc['Description']['user_id']; ?></td>
        <td><?php echo $desc['Description']['department_id']; ?></td>
        <td><?php echo $desc['Description']['status_id']; ?></td>
    </tr>
<?php endforeach; ?>

</table>