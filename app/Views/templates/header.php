    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarResponsive">

    <ul class="navbar-nav ml-auto">
         <!-- page search -->
         
         <li class="nav-item active">
            <?php                            
                echo anchor(site_url('Affichage'), ' ','class="fa fa-check-circle-o fa-3x text-success""'); 
            ?>
           <span class="sr-only">(current)</span>
      </li>
      
       <li class="nav-item active">
            <?php                            
                echo anchor(site_url('MyReservations'), ' ','class="nav-link fa fa-search fa-2x text-success"'); 
            ?>
           <span class="sr-only">(current)</span>
      </li>
      
     
      <li class="nav-item">
        <?php                               
            echo anchor(site_url('Administration'), ' ','class="nav-link fa fa-bookmark fa-2x text-success"'); 

        ?>
      </li>

      <li class="nav-item"> 
        <?php

            echo anchor(site_url('Auth/deconnexion'), ' ','class="nav-link fa fa-sign-in fa-2x text-success"'); 
        ?>
      </li>
      
      

      <i class="bi bi-bookmark-check"></i>

    </ul>
  </div>
</nav>
<br><br><br><br>