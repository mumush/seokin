<div class="allUsers">

<?php

    if( $accessLevel == 1 ) { ?>

        <div class="row">

            <?php
                echo $this->Html->link('<i class="fa fa-plus"></i>', 
                    array('controller' => 'users', 'action' => 'add'), 
                    array('escape' => false, 'id' => 'newUser', 'class' => 'pull-right btn btn-info',
                    'data-original-title' => 'New User', 'data-placement' => 'bottom', 'data-toggle' => 'tooltip') );
            ?>

        </div>
    <?php
    } 
?>

    <h1 class="sectionHeading"><i class="fa fa-users"></i> Employers of the<br /> <?php echo $users[0]['Department']['name']?></h1>

    <?php echo $this->Session->flash(); ?>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Department</th>
                <?php 
                    if( $accessLevel == 1 ) {

                        echo '<th>Access Level</th>';

                        echo '<th>Action</th>';
                    }
                    if( $accessLevel == 2 ) {

                        echo '<th>Email</th>';
                        echo '<th>Access Level</th>';                     

                    }
                ?>
            </tr>

            <?php foreach ($users as $user): ?>

                    <tr>
                        <td><?php echo $user['User']['username']; ?></td>
                        <td><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name']; ?></td>
                        <td><?php echo $user['Department']['name']; ?></td>
                        <?php

                            if( $accessLevel == 1 ) {

                                echo '<td>';

                                if( $user['User']['access_id'] == 1 ) {

                                    echo $this->Html->link('<i class="fa fa-arrow-down"></i> Demote', 
                                        array('action' => 'demote', $user['User']['id']), array('escape' => false, 'class' => 'btn btn-warning') );

                                }
                                if( $user['User']['access_id'] == 2 ) {

                                    echo $this->Html->link('<i class="fa fa-arrow-up"></i> Promote', 
                                        array('action' => 'promote', $user['User']['id']), array('escape' => false, 'class' => 'btn btn-success') );
                                }

                                echo '</td><td>';

                                echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Edit', 
                                    array('action' => 'edit', $user['User']['id']), array('escape' => false, 'class' => 'btn btn-info') );

                                echo ' ';

                                echo $this->Html->link('Delete', array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-danger') );

                                echo '</td>';

                            }

                            if( $accessLevel == 2 ) {

                                echo '<td>' . $user['User']['email'] . '</td>' ;

                                if( $user['User']['access_id'] == 1 ) {

                                    echo '<td>Admin</td>';

                                }
                                if( $user['User']['access_id'] == 2 ) {

                                    echo '<td>Employer</td>';

                                }

                            }
                        ?>

                    </tr>

            <?php endforeach; ?>

        </table>
    </div>

</div>