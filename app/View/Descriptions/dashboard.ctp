<div class="allDash">

    <div class="row">

        <?php
            echo $this->Html->link('<i class="fa fa-plus"></i> <i class="fa fa-user"></i>', 
                array('controller' => 'users', 'action' => 'add'), 
                array('escape' => false, 'id' => 'dashNewUser', 'class' => 'pull-left btn btn-info', 
                'data-original-title' => 'Add New User', 'data-placement' => 'bottom', 'data-toggle' => 'tooltip') );

        ?>

        <?php
            echo $this->Html->link('<i class="fa fa-plus"></i> <i class="fa fa-list"></i>', 
                array('controller' => 'descriptions', 'action' => 'add'), 
                array('escape' => false, 'id' => 'dashNewDesc', 'class' => 'pull-right btn btn-info', 
                'data-original-title' => 'Add New Description', 'data-placement' => 'bottom', 'data-toggle' => 'tooltip') );
        ?>

    </div>

    <div class="row">

        <h1 class="sectionHeading"><i class="fa fa-home"></i> Dashboard</h1>

    </div>

    <div class="row">

        <?php echo $this->Session->flash(); ?>

    </div>

    <div class="row"> <!--RECENT NEWS UPDATES FOR USERS-->

        <div class="col-lg-12">

            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>
                An <strong>FAQ</strong> will be available in the next release of the system, which will explain to both new and old users the
                flow and status changes of a submitted job description!
            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-4">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-refresh"></i> Recently Pending Descriptions</h3> <!--give a link to the description-->
                </div>
                <div class="panel-body">

                    <ul class="dashList">
                    <?php foreach ($pending as $pend): ?>
                        <li>
                        <?php echo $this->Html->link( '<i class="fa fa-pencil"></i> ' . $pend['Description']['title'], 
                        array('controller' => 'descriptions', 'action' => 'edit', $pend['Description']['id']), array('escape' => false) ); ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    
                </div>

                <div class="panel-footer">
                    
                    <?php
                        echo $this->Html->link('Pending Descriptions <i class="fa fa-chevron-right"></i>', 
                            array('controller' => 'descriptions', 'action' => 'index'), 
                            array('escape' => false, 'class' => 'btn btn-info', 'style' => 'width: 100%; border-radius: 2px;') );
                    ?>

                </div>

            </div>

        </div>

        <div class="col-md-4">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-check"></i> Recently Approved Descriptions</h3> <!--give a link to the description-->
                </div>
                <div class="panel-body">

                    <ul class="dashList">
                    <?php foreach ($approved as $approve): ?>
                        <li>
                        <?php echo $this->Html->link( '<i class="fa fa-pencil"></i> ' . $approve['Description']['title'], 
                        array('controller' => 'descriptions', 'action' => 'edit', $approve['Description']['id']), array('escape' => false) ); ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    
                </div>

                <div class="panel-footer">
                    
                    <?php
                        echo $this->Html->link('Approved Descriptions <i class="fa fa-chevron-right"></i>', 
                            array('controller' => 'descriptions', 'action' => 'index'), 
                            array('escape' => false, 'class' => 'btn btn-success', 'style' => 'width: 100%; border-radius: 2px;') );
                    ?>

                </div>

            </div>
            
        </div>

        <div class="col-md-4">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-times"></i> Recently Denied Descriptions</h3> <!--give a link to the description-->
                </div>
                <div class="panel-body">

                    <ul class="dashList">
                    <?php foreach ($denied as $deny): ?>
                        <li>
                        <?php echo $this->Html->link( '<i class="fa fa-pencil"></i> ' . $deny['Description']['title'], 
                        array('controller' => 'descriptions', 'action' => 'edit', $deny['Description']['id']), array('escape' => false) ); ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    
                </div>

                <div class="panel-footer">
                    
                    <?php
                        echo $this->Html->link('Denied Descriptions <i class="fa fa-chevron-right"></i>', 
                            array('controller' => 'descriptions', 'action' => 'index'), 
                            array('escape' => false, 'class' => 'btn btn-danger', 'style' => 'width: 100%; border-radius: 2px;') );
                    ?>

                </div>

            </div>
            
        </div>

    </div> <!--END FIRST ROW-->

    <div class="row">

        <div class="col-md-4">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-users"></i> New Employers</h3> <!--give a link to the description-->
                </div>
                <div class="panel-body">

                    <ul class="dashList">
                    <?php foreach ($users as $user): ?>
                        <li>
                        <?php echo $this->Html->link( $user['User']['first_name'] . ' ' . $user['User']['last_name'] , 
                        array('controller' => 'users', 'action' => 'edit', $user['User']['id']) ); ?>
                         of the <?php echo $user['Department']['name']; ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    
                </div>

            </div>
            
        </div>

        <div class="col-md-4">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-book"></i> Recently Added Contacts</h3> <!--give a link to the description-->
                </div>
                <div class="panel-body">

                    <ul class="dashList">
                    <?php foreach ($contacts as $contact): ?>
                        <li>
                        <?php echo $contact['Contact']['name'] . ' at ' . '<strong>' . $contact['Contact']['email'] . '</strong>'; ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    
                </div>
            </div>
            
        </div>

        <div class="col-md-4">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Real Time Statistics</h3> <!--give a link to the description-->
                </div>
                <div class="panel-body">

                    <ul class="dashList">
                        <li>Total Pending Descriptions: <?php echo $countPending; ?> </li>
                        <li>Total Approved Descriptions: <?php echo $countApproved; ?> </li>
                        <li>Total Denied Descriptions: <?php echo $countDenied; ?> </li>
                        <li>Posted Jobs: <?php echo $countPosted; ?> </li>
                        <li>Registered Employers: <?php echo $countEmployers; ?> </li>
                    </ul>
                    
                </div>
            </div>
            
        </div>


    </div> <!--END SECOND ROW-->


</div>