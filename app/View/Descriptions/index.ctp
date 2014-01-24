<div class="allDescriptions">

<h1 class="sectionHeading"><i class="fa fa-list"></i> Pending Descriptions</h1>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Department</th>
            <th>Wage</th>
            <th>User</th>
            <th>Contact Email</th>
            <th>Approve/Deny</th>
            <th>Edit</th>
        </tr>

        <?php foreach ($descriptions as $desc):

            if( $desc['Description']['status_id'] == 1 ) { ?>

                <tr>
                    <td><?php echo $desc['Description']['title']; ?></td>
                    <td><?php echo $desc['Department']['name']; ?></td>
                    <td><?php echo $desc['Description']['wage']; ?></td>
                    <td><?php echo $desc['User']['first_name'] . ' ' . $desc['User']['last_name']; ?></td>
                    <td><?php echo $desc['Contact']['email']; ?></td>
                    <td>

                    <?php

                        echo $this->Html->link('Approve', array('controller' => 'descriptions', 'action' => 'approve', $desc['Description']['id']), array('class' => 'btn btn-success') ) 
                        . ' ' .
                        $this->Html->link('Deny', array('controller' => 'descriptions', 'action' => 'deny', $desc['Description']['id']), array('class' => 'btn btn-danger') );

                    ?>

                    </td>
                    <td>
                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Edit', 
                        array('controller' => 'descriptions', 'action' => 'edit', $desc['Description']['id']), array('escape' => false, 'class' => 'btn btn-info') ); ?>
                    </td>

                </tr>

                <?php

            }

        endforeach; ?>

    </table>
</div>


<h1 class="sectionHeading"><i class="fa fa-times"></i> Denied Descriptions</h1>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Department</th>
            <th>Wage</th>
            <th>User</th>
            <th>Contact Email</th>
            <th>Edit</th>
        </tr>

        <?php foreach ($descriptions as $desc):

            if( $desc['Description']['status_id'] == 3 ) { ?>

                <tr>
                    <td><?php echo $desc['Description']['title']; ?></td>
                    <td><?php echo $desc['Department']['name']; ?></td>
                    <td><?php echo $desc['Description']['wage']; ?></td>
                    <td><?php echo $desc['User']['first_name'] . ' ' . $desc['User']['last_name']; ?></td>
                    <td><?php echo $desc['Contact']['email']; ?></td>
                    <td>
                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Edit', 
                        array('controller' => 'descriptions', 'action' => 'edit', $desc['Description']['id']), array('escape' => false, 'class' => 'btn btn-info') ); ?>
                    </td>

                </tr>

                <?php

            }

        endforeach; ?>

    </table>
</div>


<h1 class="sectionHeading"><i class="fa fa-check"></i> Approved Descriptions</h1>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Title</th>
            <th>Department</th>
            <th>Wage</th>
            <th>User</th>
            <th>Contact Email</th>
            <th>Posted</th>
            <th>Edit</th>
        </tr>

        <?php foreach ($descriptions as $desc):

            if( $desc['Description']['status_id'] == 2 ) { ?>

                <tr>
                    <td><?php echo $desc['Description']['title']; ?></td>
                    <td><?php echo $desc['Department']['name']; ?></td>
                    <td><?php echo $desc['Description']['wage']; ?></td>
                    <td><?php echo $desc['User']['first_name'] . ' ' . $desc['User']['last_name']; ?></td>
                    <td><?php echo $desc['Contact']['email']; ?></td>
                    <td style="text-align: center;">
                        <?php 

                        if( $desc['Description']['is_posted'] == 1 ) {
                            echo '<i class="fa fa-check fa-2x"></i>';
                        }
                        else {
                            echo '<i class="fa fa-times fa-2x"></i>';
                        }

                        ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link('<i class="fa fa-pencil-square-o"></i> Edit', 
                        array('controller' => 'descriptions', 'action' => 'edit', $desc['Description']['id']), array('escape' => false, 'class' => 'btn btn-info') ); ?>
                    </td>

                </tr>

                <?php

            }

        endforeach; ?>

    </table>
</div>


</div>
