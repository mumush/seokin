
<h1>SEOkin Users</h1>

<table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Access ID</th>
        <th>Department ID</th>
        <th>Edit User</th>
        <th>Delete User</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

<?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['username']; ?></td>
        <td><?php echo $user['User']['first_name']; ?></td>
        <td><?php echo $user['User']['last_name']; ?></td>
        <td><?php echo $user['User']['access_id']; ?></td>
        <td><?php echo $user['User']['department_id']; ?></td>
        <td>
            
            <?php
                echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id']) );
            ?>

        </td>
        <td>

            <?php
                echo $this->Html->link('Delete', array('action' => 'delete', $user['User']['id']) );
            ?>

        </td>
    </tr>
<?php endforeach; ?>

</table>