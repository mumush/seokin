<div class="allDescriptions">

    <h1 class="sectionHeading"><i class="fa fa-list"></i> Job Postings</h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Title</th>
                <th>Department</th>
                <th>Wage</th>
                <th>User</th>
                <th>Contact Email</th>
                <th>Action</th>
                <th>Edit</th>
            </tr>

            <?php foreach ($descriptions as $desc): ?>

                <tr>
                    <td><?php echo $desc['Description']['title']; ?></td>
                    <td><?php echo $desc['Department']['name']; ?></td>
                    <td><?php echo $desc['Description']['wage']; ?></td>
                    <td><?php echo $desc['User']['first_name'] . ' ' . $desc['User']['last_name']; ?></td>
                    <td><?php echo $desc['Contact']['email']; ?></td>
                    <td>
                        
                        <?php 

                            if( $desc['Description']['is_posted'] == 1 ) {

                                echo $this->Html->link('<i class="fa fa-minus"></i> Remove Job', 
                                array('controller' => 'descriptions', 'action' => 'unpost', $desc['Description']['id']), array('escape' => false, 'class' => 'btn btn-danger') );

                            }
                            if( $desc['Description']['is_posted'] == 0 ) {

                                echo $this->Html->link('<i class="fa fa-plus"></i> Post Job', 
                                array('controller' => 'descriptions', 'action' => 'repost', $desc['Description']['id']), array('escape' => false, 'class' => 'btn btn-success') );

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