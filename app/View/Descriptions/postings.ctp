<div class="allDescriptions">

    <div class="row">

        <?php echo $this->Session->flash(); ?>

    </div>

    <h1 class="sectionHeading"><i class="fa fa-list-alt"></i> Job Postings</h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Title</th>
                <th>Department</th>
                <th>Job Number</th>
                <th>User</th>
                <th>Contact Name</th>
                <?php if ( $accessLevel == 1 ) {echo '<th>Action</th>';} ?>
                <?php if ( $accessLevel == 2 ) {echo '<th>Posted</th>';} ?>
                <th>Edit</th>
            </tr>

            <?php foreach ($descriptions as $desc): ?>

                <tr>
                    <td><?php echo $desc['Description']['title']; ?></td>
                    <td><?php echo $desc['Department']['name']; ?></td>
                    <td><?php echo $desc['Description']['id']; ?></td>
                    <td><?php echo $desc['User']['first_name'] . ' ' . $desc['User']['last_name']; ?></td>
                    <td><?php echo $desc['Contact']['name']; ?></td>
                    <?php
                        if( $accessLevel == 1 ) {

                            if( $desc['Description']['is_posted'] == 1 ) {

                                echo '<td>';
                                echo $this->Html->link('<i class="fa fa-minus"></i> Remove Job', 
                                array('controller' => 'descriptions', 'action' => 'unpost', $desc['Description']['id']), 
                                array('escape' => false, 'class' => 'btn btn-danger') );
                                echo '</td>';

                            }
                            if( $desc['Description']['is_posted'] == 0 ) {

                                echo '<td>';
                                echo $this->Html->link('<i class="fa fa-plus"></i> Post Job', 
                                array('controller' => 'descriptions', 'action' => 'repost', $desc['Description']['id']), 
                                array('escape' => false, 'class' => 'btn btn-success') );
                                echo '</td>';

                            }
                        }
                        else {

                            if( $desc['Description']['is_posted'] == 1 ) {
                                echo '<td style="text-align: center;"><i class="fa fa-check fa-2x"></i></td>';
                            }
                            if( $desc['Description']['is_posted'] == 0 ) {
                                echo '<td style="text-align: center;"><i class="fa fa-times fa-2x"></i></td>';
                            }

                        }
                    ?>

                    </td>
                    <td>
                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Edit', 
                        array('controller' => 'descriptions', 'action' => 'edit', $desc['Description']['id']), array('escape' => false, 'class' => 'btn btn-info') ); ?>
                    </td>

                </tr>

            <?php endforeach; ?>

        </table>
    </div>

</div>