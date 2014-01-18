
<h1>SEOkin Descriptions</h1>

<table>
    <tr>
        <th>Title</th>
        <th>Wage</th>
        <th>User</th>
        <th>Department</th>
        <th>Contact Name</th>
        <th>Contact Email</th>
        <th>Status</th>
        <th>Approve/Deny</th>
        <th>Edit</th>

    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

<?php foreach ($descriptions as $desc): ?>
    <tr>
        <td><?php echo $desc['Description']['title']; ?></td>
        <td><?php echo $desc['Description']['wage']; ?></td>
        <td><?php echo $desc['User']['first_name'] . ' ' . $desc['User']['last_name']; ?></td>
        <td><?php echo $desc['Department']['name']; ?></td>
        <td><?php echo $desc['Contact']['name']; ?></td>
        <td><?php echo $desc['Contact']['email']; ?></td>
        <td>
            <?php
                if( $desc['Description']['status_id'] == 1 ) {
                    echo 'Pending';
                }
                if( $desc['Description']['status_id'] == 2 ) {
                    echo 'Approved';
                }
                if( $desc['Description']['status_id'] == 3 ) {
                    echo 'Denied';
                }
            ?>
        </td>

        <td>

        <?php

            if( $desc['Description']['status_id'] == 1 ) {
                echo $this->Html->link('Approve', array('controller' => 'descriptions', 'action' => 'approve', $desc['Description']['id']) ) 
                . '/ ' .
                $this->Html->link('Deny', array('controller' => 'descriptions', 'action' => 'deny', $desc['Description']['id']) );
            }

            if( $desc['Description']['status_id'] == 2 ) {
                echo 'Approved icon here';
            }

            if( $desc['Description']['status_id'] == 3 ) {

                echo 'Denied icon here';
            }

        ?>

        </td>
        <td>
            <?php echo $this->Html->link('Edit', array('controller' => 'descriptions', 'action' => 'edit', $desc['Description']['id']) ); ?>
        </td>

    </tr>
<?php endforeach; ?>

</table>